<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    /**
     * Display a listing of jobs (Admin)
     */
    public function index()
    {
        $jobs = Job::latest()->paginate(10);
        return view('admin.jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new job
     */
    public function create()
    {
        return view('admin.jobs.create');
    }

    /**
     * Store a newly created job
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:full-time,part-time,contract,internship',
            'job_type' => 'nullable|in:full-time,part-time,contract,internship,freelance',
            'category' => 'nullable|string|max:255',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0',
            'status' => 'required|in:active,closed',
            'deadline' => 'nullable|date',
        ]);

        // Sync job_type with type if job_type is provided
        if (isset($validated['job_type'])) {
            $validated['type'] = $validated['job_type'];
        } else {
            // Default job_type from type
            $validated['job_type'] = $validated['type'];
        }

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $validated['logo'] = $logoPath;
        }

        Job::create($validated);

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Job posted successfully!');
    }

    /**
     * Show the form for editing a job
     */
    public function edit(Job $job)
    {
        return view('admin.jobs.edit', compact('job'));
    }

    /**
     * Update the specified job
     */
    public function update(Request $request, Job $job)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:full-time,part-time,contract,internship',
            'job_type' => 'nullable|in:full-time,part-time,contract,internship,freelance',
            'category' => 'nullable|string|max:255',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0',
            'status' => 'required|in:active,closed',
            'deadline' => 'nullable|date',
        ]);

        // Sync job_type with type if job_type is provided
        if (isset($validated['job_type'])) {
            $validated['type'] = $validated['job_type'];
        } else {
            // Default job_type from type
            $validated['job_type'] = $validated['type'];
        }

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($job->logo && Storage::disk('public')->exists($job->logo)) {
                Storage::disk('public')->delete($job->logo);
            }

            $logoPath = $request->file('logo')->store('logos', 'public');
            $validated['logo'] = $logoPath;
        }

        $job->update($validated);

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Job updated successfully!');
    }

    /**
     * Remove the specified job
     */
    public function destroy(Job $job)
    {
        // Delete logo if exists
        if ($job->logo && Storage::disk('public')->exists($job->logo)) {
            Storage::disk('public')->delete($job->logo);
        }

        $job->delete();

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Job deleted successfully!');
    }

    /**
     * Show job detail (Public)
     */
    public function show($id)
    {
        $job = Job::findOrFail($id);

        // Check if user already applied
        $hasApplied = false;
        if (Auth::check()) {
            $hasApplied = Application::where('user_id', Auth::id())
                ->where('job_posting_id', $id)
                ->exists();
        }

        return view('jobs.show', compact('job', 'hasApplied'));
    }
}
