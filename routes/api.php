<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::resource('teams', TeamController::class);

Route::resource('games', GameController::class);

Route::middleware('auth')->group(function () {
    Route::resource('/users', UserController::class);
});