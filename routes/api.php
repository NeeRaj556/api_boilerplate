<?php

use App\Http\Controllers\PasswordController;
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
