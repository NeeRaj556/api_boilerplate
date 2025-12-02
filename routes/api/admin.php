<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['jwt.auth', 'role:admin'])->get('/admin', function () {
    return "Admin only";
});
