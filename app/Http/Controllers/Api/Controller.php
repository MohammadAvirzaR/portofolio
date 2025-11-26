<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as BaseController;

/**
 * @OA\Info(
 *     title="Job Portal API Documentation",
 *     version="1.0.0",
 *     description="API Documentation untuk Job Portal Application. Sistem ini menyediakan endpoint untuk manajemen job postings, aplikasi pekerjaan, dan autentikasi user.",
 *     @OA\Contact(
 *         email="support@jobportal.com",
 *         name="Job Portal Support"
 *     )
 * )
 *
 * @OA\Server(
 *     url="http://localhost",
 *     description="Local Development Server"
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="sanctum",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     description="Enter your bearer token in the format: Bearer {token}"
 * )
 *
 * @OA\Schema(
 *     schema="Job",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="title", type="string", example="Software Engineer"),
 *     @OA\Property(property="company", type="string", example="Tech Corp"),
 *     @OA\Property(property="location", type="string", example="Jakarta"),
 *     @OA\Property(property="salary", type="string", example="10-15 juta"),
 *     @OA\Property(property="type", type="string", example="full-time"),
 *     @OA\Property(property="description", type="string", example="Job description"),
 *     @OA\Property(property="requirements", type="string", example="Requirements"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 *
 * @OA\Schema(
 *     schema="Application",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="user_id", type="integer", example=1),
 *     @OA\Property(property="job_id", type="integer", example=1),
 *     @OA\Property(property="cover_letter", type="string", example="I am interested..."),
 *     @OA\Property(property="cv_path", type="string", example="cv/abc123.pdf"),
 *     @OA\Property(property="status", type="string", enum={"pending","reviewed","accepted","rejected"}),
 *     @OA\Property(property="admin_notes", type="string", example="Good candidate"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time"),
 *     @OA\Property(property="user", type="object",
 *         @OA\Property(property="id", type="integer"),
 *         @OA\Property(property="name", type="string"),
 *         @OA\Property(property="email", type="string")
 *     ),
 *     @OA\Property(property="job", type="object",
 *         @OA\Property(property="id", type="integer"),
 *         @OA\Property(property="title", type="string"),
 *         @OA\Property(property="company", type="string")
 *     )
 * )
 */
class Controller extends BaseController
{
    //
}
