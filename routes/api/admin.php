<?php

use App\Http\Controllers\Admin\ReferenceDataController;
use Illuminate\Support\Facades\Route;

Route::middleware(['jwt.auth', 'role:admin'])->prefix('admin')->group(function () {

    // Get all reference data at once
    Route::get('/reference-data', [ReferenceDataController::class, 'index']);

    // Education Levels
    Route::get('/education-levels', [ReferenceDataController::class, 'getEducationLevels']);
    Route::post('/education-levels', [ReferenceDataController::class, 'storeEducationLevel']);
    Route::put('/education-levels/{id}', [ReferenceDataController::class, 'updateEducationLevel']);
    Route::delete('/education-levels/{id}', [ReferenceDataController::class, 'deleteEducationLevel']);

    // Employment Types
    Route::get('/employment-types', [ReferenceDataController::class, 'getEmploymentTypes']);
    Route::post('/employment-types', [ReferenceDataController::class, 'storeEmploymentType']);
    Route::put('/employment-types/{id}', [ReferenceDataController::class, 'updateEmploymentType']);
    Route::delete('/employment-types/{id}', [ReferenceDataController::class, 'deleteEmploymentType']);

    // Work Modes
    Route::get('/work-modes', [ReferenceDataController::class, 'getWorkModes']);
    Route::post('/work-modes', [ReferenceDataController::class, 'storeWorkMode']);
    Route::put('/work-modes/{id}', [ReferenceDataController::class, 'updateWorkMode']);
    Route::delete('/work-modes/{id}', [ReferenceDataController::class, 'deleteWorkMode']);

    // Industries
    Route::get('/industries', [ReferenceDataController::class, 'getIndustries']);
    Route::post('/industries', [ReferenceDataController::class, 'storeIndustry']);
    Route::put('/industries/{id}', [ReferenceDataController::class, 'updateIndustry']);
    Route::delete('/industries/{id}', [ReferenceDataController::class, 'deleteIndustry']);

    // Job Categories
    Route::get('/job-categories', [ReferenceDataController::class, 'getJobCategories']);
    Route::post('/job-categories', [ReferenceDataController::class, 'storeJobCategory']);
    Route::put('/job-categories/{id}', [ReferenceDataController::class, 'updateJobCategory']);
    Route::delete('/job-categories/{id}', [ReferenceDataController::class, 'deleteJobCategory']);

    // Skills
    Route::get('/skills', [ReferenceDataController::class, 'getSkills']);
    Route::post('/skills', [ReferenceDataController::class, 'storeSkill']);
    Route::put('/skills/{id}', [ReferenceDataController::class, 'updateSkill']);
    Route::delete('/skills/{id}', [ReferenceDataController::class, 'deleteSkill']);

    // Company Sizes
    Route::get('/company-sizes', [ReferenceDataController::class, 'getCompanySizes']);
    Route::post('/company-sizes', [ReferenceDataController::class, 'storeCompanySize']);
    Route::put('/company-sizes/{id}', [ReferenceDataController::class, 'updateCompanySize']);
    Route::delete('/company-sizes/{id}', [ReferenceDataController::class, 'deleteCompanySize']);
});
