<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Forum\HomeController;


// Auth
Route::controller(AuthController::class)->group(function () {
    Route::get('/acesso', 'loginForm')->name('loginForm');
    Route::get('/cadastro', 'registerForm')->name('registerForm');
});

// Forum
Route::controller(HomeController::class)->middleware('auth')->group(function () {

    Route::get('/', 'home')->name('home');
});
