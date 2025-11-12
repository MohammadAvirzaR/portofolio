<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;
use App\Models\Job;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/projects/job-portal', function () {
    return view('projects.job-portal');
})->name('project.job-portal');

Route::get('/jobs', function () {
    $jobs = Job::where('status', 'active')->latest()->paginate(12);
    return view('jobs.index', compact('jobs'));
})->name('jobs.index');

Route::get('/jobs/{id}', [JobController::class, 'show'])->name('jobs.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'admin'])->name('admin.dashboard');

Route::get('/admin/users', function () {
    return view('admin.users');
})->middleware(['auth', 'admin'])->name('admin.users');

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::resource('jobs', JobController::class)->names([
        'index' => 'admin.jobs.index',
        'create' => 'admin.jobs.create',
        'store' => 'admin.jobs.store',
        'edit' => 'admin.jobs.edit',
        'update' => 'admin.jobs.update',
        'destroy' => 'admin.jobs.destroy',
    ]);

    Route::get('/jobs/{id}/applicants', [ApplicationController::class, 'adminJobApplicants'])
        ->name('admin.jobs.applicants');
    Route::get('/applicants', [ApplicationController::class, 'adminList'])
        ->name('admin.applicants.index');
    Route::patch('/applications/{application}/status', [ApplicationController::class, 'adminUpdateStatus'])
        ->name('applications.update-status');
    Route::delete('/applications/{application}', [ApplicationController::class, 'adminDestroy'])
        ->name('applications.destroy');
    Route::get('/applicants/export', [ApplicationController::class, 'exportApplicants'])
        ->name('admin.applicants.export');
    Route::get('/jobs/import', [ApplicationController::class, 'importForm'])
        ->name('admin.jobs.import-form');
    Route::post('/jobs/import', [ApplicationController::class, 'importJobs'])
        ->name('admin.jobs.import');
    Route::get('/jobs/template/download', [ApplicationController::class, 'downloadTemplate'])
        ->name('admin.jobs.template');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Application Routes
    Route::get('/jobs/{id}/apply', [ApplicationController::class, 'create'])
        ->name('applications.create');
    Route::post('/jobs/{id}/apply', [ApplicationController::class, 'store'])
        ->name('applications.store');
    Route::get('/my-applications', [ApplicationController::class, 'index'])
        ->name('applications.index');
    Route::get('/applications/{application}/download-cv', [ApplicationController::class, 'downloadCv'])
        ->name('applications.download-cv');
});

require __DIR__.'/auth.php';
