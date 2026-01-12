<?php

use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ReferenceDataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

require __DIR__ . '/api/auth.php';
require __DIR__ . '/api/admin.php';
require __DIR__ . '/api/user.php';

Route::post('/password/forgot', [PasswordController::class, 'sendResetLink']);
Route::post('/password/reset',  [PasswordController::class, 'resetPassword']);

// Public Reference Data Routes (No Authentication Required - Only Active Records)
Route::prefix('reference-data')->group(function () {
    Route::get('/', [ReferenceDataController::class, 'index']);
    Route::get('/education-levels', [ReferenceDataController::class, 'educationLevels']);
    Route::get('/employment-types', [ReferenceDataController::class, 'employmentTypes']);
    Route::get('/work-modes', [ReferenceDataController::class, 'workModes']);
    Route::get('/industries', [ReferenceDataController::class, 'industries']);
    Route::get('/job-categories', [ReferenceDataController::class, 'jobCategories']);
    Route::get('/skills', [ReferenceDataController::class, 'skills']);
    Route::get('/company-sizes', [ReferenceDataController::class, 'companySizes']);
});
