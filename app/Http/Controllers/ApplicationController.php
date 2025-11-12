<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ApplicationsExport;

class ApplicationController extends Controller
{
    /**
     * Show apply form for a specific job
     */
    public function create($jobId)
    {
        $job = Job::findOrFail($jobId);

        // Check if user already applied
        $existingApplication = Application::where('user_id', Auth::id())
            ->where('job_posting_id', $jobId)
            ->first();

        if ($existingApplication) {
            return redirect()->route('jobs.index')
                ->with('error', 'You have already applied for this position!');
        }

        return view('applications.create', compact('job'));
    }

    /**
     * Store application with CV upload
     */
    public function store(Request $request, $jobId)
    {
        $job = Job::findOrFail($jobId);

        $validated = $request->validate([
            'cv' => 'required|file|mimes:pdf|max:5120', // Max 5MB
        ]);

        // Check duplicate application
        $existingApplication = Application::where('user_id', Auth::id())
            ->where('job_posting_id', $jobId)
            ->first();

        if ($existingApplication) {
            return redirect()->route('jobs.index')
                ->with('error', 'You have already applied for this position!');
        }

        // Store CV file
        $cvPath = $request->file('cv')->store('cv/' . Auth::id(), 'public');

        // Create application
        Application::create([
            'user_id' => Auth::id(),
            'job_posting_id' => $jobId,
            'cv_path' => $cvPath,
            'status' => 'pending',
        ]);

        return redirect()->route('applications.index')
            ->with('success', 'Application submitted successfully! We will review your CV soon.');
    }

    /**
     * Show user's applications list
     */
    public function index()
    {
        $applications = Application::where('user_id', Auth::id())
            ->with('job')
            ->latest()
            ->paginate(10);

        return view('applications.index', compact('applications'));
    }

    /**
     * Admin: Show applicants for a specific job
     */
    public function adminJobApplicants($jobId)
    {
        $job = Job::findOrFail($jobId);
        $applicants = Application::where('job_posting_id', $jobId)
            ->with('user')
            ->latest()
            ->paginate(15);

        return view('admin.applications.job-applicants', compact('job', 'applicants'));
    }

    /**
     * Admin: Show all applicants across jobs
     */
    public function adminList()
    {
        $applications = Application::with('user', 'job')
            ->latest()
            ->paginate(20);

        return view('admin.applications.index', compact('applications'));
    }

    /**
     * Admin: Update application status
     */
    public function adminUpdateStatus(Request $request, Application $application)
    {
        // Check if user is admin
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'status' => 'nullable|in:pending,accepted,rejected',
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        // Only update provided fields
        if (isset($validated['status'])) {
            $application->status = $validated['status'];
        }
        if (isset($validated['admin_notes'])) {
            $application->admin_notes = $validated['admin_notes'];
        }
        $application->save();

        return back()->with('success', 'Application updated successfully!');
    }

    /**
     * Download CV
     */
    public function downloadCv(Application $application)
    {
        // Check if user is the applicant or admin
        if (Auth::id() !== $application->user_id && Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        if (!$application->cv_path || !Storage::disk('public')->exists($application->cv_path)) {
            return back()->with('error', 'CV file not found!');
        }

        return response()->download(
            Storage::disk('public')->path($application->cv_path),
            basename($application->cv_path)
        );
    }

    /**
     * Admin: Export applicants to Excel
     */
    public function exportApplicants(Request $request)
    {
        $query = Application::with('user', 'job');

        // Filter by job if specified
        if ($request->has('job_id') && $request->job_id) {
            $query->where('job_posting_id', $request->job_id);
        }

        $applications = $query->get();

        return Excel::download(
            new ApplicationsExport($applications),
            'applicants_' . now()->format('Y-m-d_His') . '.xlsx'
        );
    }

    /**
     * Admin: Show import form
     */
    public function importForm()
    {
        return view('admin.applications.import-jobs');
    }

    /**
     * Admin: Import jobs from Excel
     */
    public function importJobs(Request $request)
    {
        $validated = $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv',
        ]);

        try {
            Excel::import(new \App\Imports\JobsImport, $request->file('file'));
            return back()->with('success', 'Jobs imported successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Import failed: ' . $e->getMessage());
        }
    }

    /**
     * Admin: Delete application
     */
    public function adminDestroy(Application $application)
    {
        // Check if user is admin
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        // Delete CV file if exists
        if ($application->cv_path && Storage::disk('public')->exists($application->cv_path)) {
            Storage::disk('public')->delete($application->cv_path);
        }

        $application->delete();

        return back()->with('success', 'Application deleted successfully!');
    }

    /**
     * Download template import jobs
     */
    public function downloadTemplate()
    {
        return Excel::download(
            new \App\Exports\JobsTemplateExport,
            'template_import_jobs.xlsx'
        );
    }
}
