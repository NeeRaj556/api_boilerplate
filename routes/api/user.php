<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['jwt.auth', 'role:user'])->get('/admin', function () {
    return "User only";
});
