<?php

use App\Http\Controllers\DiscordController;
use Illuminate\Support\Facades\Route;

Route::get('/home', [DiscordController::class, 'index'])
    ->name('api.home');

Route::group(['prefix' => 'discord'], function () {
    Route::get('/login', [DiscordController::class, 'discordRedirectGetCode'])
        ->name('api.discord.login');

    Route::get('/callback', [DiscordController::class, 'discordAuth'])
        ->name('api.discord.callback');

    Route::get('/get-user-data', [DiscordController::class, 'getUserData'])
        ->name('api.discord.get-user-data');
});