<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/home');
})->name('logout');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');

route::get('/login', function(){
    return view('auth/login');
}) -> name('login');

route::get('/register', function(){
    return view('auth/register');
});

Route::middleware('auth') ->group(function(){
    route::get('/admin', function(){
        return view('admin/admin');
    });
});

Route::middleware('auth') ->group(function(){

    route::get('/admin/teams', function(){
        return view('admin/form/teams');
    });
});


Route::middleware('auth') ->group(function(){
    route::get('/admin/games', function(){
        return view('admin/form/games', [Controller::class, 'get_games']);
    });
});

Route::middleware('auth') ->group(function(){
    route::get('/admin/counts', function(){
        return view('admin/form/counts');
    });
});
