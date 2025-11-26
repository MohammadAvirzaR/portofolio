<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * @OA\Tag(
 *     name="Applications",
 *     description="API endpoints untuk job applications"
 * )
 */
class ApplicationApiController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/jobs/{jobId}/apply",
     *     summary="Apply for a job",
     *     tags={"Applications"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="jobId",
     *         in="path",
     *         description="Job ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"cover_letter","cv"},
     *                 @OA\Property(property="cover_letter", type="string", example="I am interested in this position..."),
     *                 @OA\Property(property="cv", type="string", format="binary", description="CV file (PDF, max 2MB)")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Application submitted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Application submitted successfully"),
     *             @OA\Property(property="application", type="object", ref="#/components/schemas/Application")
     *         )
     *     ),
     *     @OA\Response(response=404, description="Job not found"),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function apply(Request $request, $jobId)
    {
        $job = Job::findOrFail($jobId);

        $validated = $request->validate([
            'cover_letter' => 'required|string',
            'cv' => 'required|file|mimes:pdf|max:2048',
        ]);

        // Check if user already applied
        $existingApplication = Application::where('user_id', $request->user()->id)
            ->where('job_id', $jobId)
            ->first();

        if ($existingApplication) {
            return response()->json([
                'message' => 'You have already applied for this job',
            ], 422);
        }

        // Upload CV
        $cvPath = null;
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cv', 'public');
        }

        $application = Application::create([
            'user_id' => $request->user()->id,
            'job_id' => $jobId,
            'cover_letter' => $validated['cover_letter'],
            'cv_path' => $cvPath,
            'status' => 'pending',
        ]);

        // Load relationships
        $application->load(['user', 'job']);

        return response()->json([
            'message' => 'Application submitted successfully',
            'application' => $application,
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/applications",
     *     summary="Get all applications (admin only)",
     *     tags={"Applications"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number",
     *         required=false,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Filter by status",
     *         required=false,
     *         @OA\Schema(type="string", enum={"pending","reviewed","accepted","rejected"})
     *     ),
     *     @OA\Parameter(
     *         name="job_id",
     *         in="query",
     *         description="Filter by job ID",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of applications",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Application"))
     *         )
     *     ),
     *     @OA\Response(response=401, description="Unauthenticated"),
     *     @OA\Response(response=403, description="Forbidden - Admin only")
     * )
     */
    public function index(Request $request)
    {
        $query = Application::with(['user', 'job']);

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('job_id')) {
            $query->where('job_id', $request->job_id);
        }

        $perPage = $request->input('per_page', 15);
        $applications = $query->latest()->paginate($perPage);

        return response()->json($applications);
    }

    /**
     * @OA\Get(
     *     path="/api/my-applications",
     *     summary="Get current user's applications",
     *     tags={"Applications"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number",
     *         required=false,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of user's applications",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Application"))
     *         )
     *     ),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function myApplications(Request $request)
    {
        $perPage = $request->input('per_page', 15);
        $applications = Application::with(['job'])
            ->where('user_id', $request->user()->id)
            ->latest()
            ->paginate($perPage);

        return response()->json($applications);
    }

    /**
     * @OA\Patch(
     *     path="/api/applications/{id}/status",
     *     summary="Update application status (admin only)",
     *     tags={"Applications"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Application ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"status"},
     *             @OA\Property(property="status", type="string", enum={"pending","reviewed","accepted","rejected"}),
     *             @OA\Property(property="admin_notes", type="string", example="Good candidate")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Application status updated",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Application status updated successfully"),
     *             @OA\Property(property="application", type="object", ref="#/components/schemas/Application")
     *         )
     *     ),
     *     @OA\Response(response=404, description="Application not found"),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=403, description="Forbidden - Admin only")
     * )
     */
    public function updateStatus(Request $request, $id)
    {
        $application = Application::with(['user', 'job'])->findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:pending,reviewed,accepted,rejected',
            'admin_notes' => 'nullable|string',
        ]);

        $application->update($validated);

        return response()->json([
            'message' => 'Application status updated successfully',
            'application' => $application,
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/applications/{id}",
     *     summary="Get application detail",
     *     tags={"Applications"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Application ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Application detail",
     *         @OA\JsonContent(ref="#/components/schemas/Application")
     *     ),
     *     @OA\Response(response=404, description="Application not found"),
     *     @OA\Response(response=403, description="Forbidden")
     * )
     */
    public function show(Request $request, $id)
    {
        $application = Application::with(['user', 'job'])->findOrFail($id);

        // Only admin or the applicant can view the application
        if ($request->user()->role !== 'admin' && $application->user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'Forbidden',
            ], 403);
        }

        return response()->json($application);
    }
}
