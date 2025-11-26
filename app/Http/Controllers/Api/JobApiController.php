<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * @OA\Tag(
 *     name="Jobs",
 *     description="API endpoints untuk job postings"
 * )
 */
class JobApiController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/public/jobs",
     *     summary="Get all jobs (public, tanpa auth)",
     *     tags={"Jobs"},
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number",
     *         required=false,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Items per page",
     *         required=false,
     *         @OA\Schema(type="integer", example=10)
     *     ),
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Search by title or description",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="location",
     *         in="query",
     *         description="Filter by location",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of jobs",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array", @OA\Items(
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="title", type="string"),
     *                 @OA\Property(property="company", type="string"),
     *                 @OA\Property(property="location", type="string"),
     *                 @OA\Property(property="salary", type="string"),
     *                 @OA\Property(property="type", type="string")
     *             )),
     *             @OA\Property(property="current_page", type="integer"),
     *             @OA\Property(property="total", type="integer")
     *         )
     *     )
     * )
     */
    public function publicIndex(Request $request)
    {
        $query = Job::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('company', 'like', "%{$search}%");
            });
        }

        if ($request->has('location')) {
            $query->where('location', 'like', "%{$request->location}%");
        }

        $perPage = $request->input('per_page', 10);
        $jobs = $query->latest()->paginate($perPage);

        return response()->json($jobs);
    }

    /**
     * @OA\Get(
     *     path="/api/jobs",
     *     summary="Get all jobs (protected, untuk admin)",
     *     tags={"Jobs"},
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
     *         description="List of jobs",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Job"))
     *         )
     *     ),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function index(Request $request)
    {
        $query = Job::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('company', 'like', "%{$search}%");
            });
        }

        if ($request->has('location')) {
            $query->where('location', 'like', "%{$request->location}%");
        }

        $perPage = $request->input('per_page', 15);
        $jobs = $query->latest()->paginate($perPage);

        return response()->json($jobs);
    }

    /**
     * @OA\Get(
     *     path="/api/jobs/{id}",
     *     summary="Get job detail",
     *     tags={"Jobs"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Job ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Job detail",
     *         @OA\JsonContent(ref="#/components/schemas/Job")
     *     ),
     *     @OA\Response(response=404, description="Job not found")
     * )
     */
    public function show($id)
    {
        $job = Job::findOrFail($id);
        return response()->json($job);
    }

    /**
     * @OA\Post(
     *     path="/api/jobs",
     *     summary="Create new job (admin only)",
     *     tags={"Jobs"},
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title","company","location","type","description"},
     *             @OA\Property(property="title", type="string", example="Software Engineer"),
     *             @OA\Property(property="company", type="string", example="Tech Corp"),
     *             @OA\Property(property="location", type="string", example="Jakarta"),
     *             @OA\Property(property="salary", type="string", example="10-15 juta"),
     *             @OA\Property(property="type", type="string", example="full-time"),
     *             @OA\Property(property="description", type="string", example="Job description here"),
     *             @OA\Property(property="requirements", type="string", example="Requirements here")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Job created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Job")
     *     ),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=403, description="Forbidden - Admin only")
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'salary' => 'nullable|string|max:255',
            'type' => 'required|string|max:50',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
        ]);

        $job = Job::create($validated);

        return response()->json($job, 201);
    }

    /**
     * @OA\Put(
     *     path="/api/jobs/{id}",
     *     summary="Update job (admin only)",
     *     tags={"Jobs"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Job ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="company", type="string"),
     *             @OA\Property(property="location", type="string"),
     *             @OA\Property(property="salary", type="string"),
     *             @OA\Property(property="type", type="string"),
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="requirements", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Job updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Job")
     *     ),
     *     @OA\Response(response=404, description="Job not found"),
     *     @OA\Response(response=403, description="Forbidden - Admin only")
     * )
     */
    public function update(Request $request, $id)
    {
        $job = Job::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'company' => 'sometimes|required|string|max:255',
            'location' => 'sometimes|required|string|max:255',
            'salary' => 'nullable|string|max:255',
            'type' => 'sometimes|required|string|max:50',
            'description' => 'sometimes|required|string',
            'requirements' => 'nullable|string',
        ]);

        $job->update($validated);

        return response()->json($job);
    }

    /**
     * @OA\Delete(
     *     path="/api/jobs/{id}",
     *     summary="Delete job (admin only)",
     *     tags={"Jobs"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Job ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Job deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Job deleted successfully")
     *         )
     *     ),
     *     @OA\Response(response=404, description="Job not found"),
     *     @OA\Response(response=403, description="Forbidden - Admin only")
     * )
     */
    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();

        return response()->json([
            'message' => 'Job deleted successfully',
        ]);
    }
}
