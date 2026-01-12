<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Protected routes for authenticated users
Route::middleware(['jwt.auth'])->group(function () {

    // General profile endpoint (works for all roles)
    Route::get('/profile', [ProfileController::class, 'getProfile']);

    Route::middleware(['role:candidate'])->group(function () {
        Route::put('/candidate/profile', [ProfileController::class, 'updateCandidateProfile']);

        // Resume management
        Route::post('/candidate/resume', [ProfileController::class, 'uploadResume']);
        Route::get('/candidate/resume', [ProfileController::class, 'getResume']);
        Route::delete('/candidate/resume', [ProfileController::class, 'deleteResume']);

        Route::get('/candidate/skills', [ProfileController::class, 'getSkills']);
        Route::post('/candidate/skills', [ProfileController::class, 'addSkill']);
        Route::put('/candidate/skills/{id}', [ProfileController::class, 'updateSkill']);
        Route::delete('/candidate/skills/{id}', [ProfileController::class, 'deleteSkill']);

        Route::get('/candidate/projects', [ProfileController::class, 'getProjects']);
        Route::post('/candidate/projects', [ProfileController::class, 'addProject']);
        Route::put('/candidate/projects/{id}', [ProfileController::class, 'updateProject']);
        Route::delete('/candidate/projects/{id}', [ProfileController::class, 'deleteProject']);
    });

    Route::middleware(['role:employer'])->group(function () {
        Route::put('/employer/profile', [ProfileController::class, 'updateEmployerProfile']);
    });
});
