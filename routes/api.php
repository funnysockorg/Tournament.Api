<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [TestController::class, 'index'])
    ->name('api.login');