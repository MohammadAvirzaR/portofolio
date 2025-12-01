<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\JobApiController;
use App\Http\Controllers\Api\ApplicationApiController;


// Public endpoints - tidak perlu authentication
Route::get('/public/jobs', [JobApiController::class, 'publicIndex']);
Route::get('/jobs/{id}', [JobApiController::class, 'show']);

// Authentication endpoints
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected endpoints - perlu authentication dengan Sanctum
Route::middleware('auth:sanctum')->group(function () {
    // Auth routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Application routes untuk user
    Route::post('/jobs/{jobId}/apply', [ApplicationApiController::class, 'apply']);
    Route::get('/my-applications', [ApplicationApiController::class, 'myApplications']);
    Route::get('/applications/{id}', [ApplicationApiController::class, 'show']);

    // Admin only routes - perlu middleware is.admin
    Route::middleware('is.admin')->group(function () {
        // Job management
        Route::get('/jobs', [JobApiController::class, 'index']);
        Route::post('/jobs', [JobApiController::class, 'store']);
        Route::put('/jobs/{id}', [JobApiController::class, 'update']);
        Route::delete('/jobs/{id}', [JobApiController::class, 'destroy']);

        // Application management
        Route::get('/applications', [ApplicationApiController::class, 'index']);
        Route::patch('/applications/{id}/status', [ApplicationApiController::class, 'updateStatus']);
    });
});
