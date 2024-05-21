<?php

use App\Http\Controllers\DiscordController;
use Illuminate\Support\Facades\Route;

Route::get('/home', [DiscordController::class, 'index'])
    ->name('api.home');

Route::group(['prefix' => 'discord'], function () {
    Route::get('/get-token/{code}', [DiscordController::class, 'getUserToken'])
        ->name('api.discord.get-token');

    Route::get('/get-user-data', [DiscordController::class, 'getUserData'])
        ->name('api.discord.get-user-data');
});