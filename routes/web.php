<?php

use App\Http\Controllers\AnswerController;
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
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Request;

// Auth
Route::controller(AuthController::class)->group(function () {
    Route::get('/acesso', 'loginForm')->name('loginForm');
    Route::get('/cadastro', 'registerForm')->name('registerForm');
    Route::post('/login', 'login')->name('login');
    Route::get('/sair', 'logout')->name('logout');
});

// Forum
Route::middleware('auth')->group(function () {

    // home
    Route::controller(HomeController::class)->group(function () {
        Route::get('/', 'home')->name('home');
    });

    // users
    Route::resource('perfil', UserController::class)->names('users')->parameter('perfil', 'user');
    Route::post('perfil', [UserController::class, 'store'])->name('users.store')->withoutMiddleware('auth');

    // topics
    Route::resource('topicos', TopicController::class)->names('topics')->parameter('topicos', 'topic');

    //answers
    Route::resource('respostas', AnswerController::class)->names('answers')->parameter('respostas', 'answer');
    Route::controller(AnswerController::class)->name('answers.')->prefix('respostas')->group(function () {
        Route::post('/like', 'like')->name('like');
    });
});

Route::get('/test', function (LoginRequest $r) {
    return response('ok!');
});
