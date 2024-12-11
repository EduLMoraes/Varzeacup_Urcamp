<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
Route::resource('teams', TeamController::class);
Route::resource('games', GameController::class);


Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');
route::get('/login', function(){
    return view('auth/login');
}) -> name('login');

route::get('/register', function(){
    return view('auth/register');
});

use Illuminate\Support\Facades\Broadcast;
Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

use Illuminate\Support\Facades\Auth;
Auth::routes();

Route::middleware('auth') ->group(function(){
    Route::resource('/users', UserController::class);

    route::get('/admin/counts', function(){
        return view('admin/form/counts');
    });

    route::get('/admin/games', function(){
        return view('admin/form/games', [Controller::class, 'get_games']);
    });

    route::get('/admin/teams', function(){
        return view('admin/form/teams');
    });

    route::get('/admin', function(){
        return view('admin/admin');
    });
});

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/home');
})->name('logout');

