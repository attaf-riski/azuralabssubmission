<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

// login
Route::get('/', [UserController::class, 'login'])->name('/');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware(['guest'])->group(function () {
    Route::get('/', [UserController::class, 'login'])->name('/');
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/login-proses', [UserController::class, 'loginProses'])->name('login-proses');
    Route::get('/register', [UserController::class, 'register'])->name('register');
    Route::post('/register-proses', [UserController::class, 'registerProses'])->name('register-proses');

    Route::get('/forgot-password', [UserController::class, 'forgotPasswordShow'])->name('forgot-password');
    Route::post('/forgot-password', [UserController::class, 'forgotPasswordProses'])->name('forgot-password.store');
    Route::get('/reset-password/{token}', [UserController::class, 'resetPassword'])->name('password.reset');
    Route::post('/reset-password', [UserController::class, 'resetPasswordProses'])->name('password.reset.store');
});

Route::group(['prefix' => 'workspace', 'middleware' => ['auth'], 'as' => 'workspace.'], function () {
    Route::get('/', [BookController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [BookController::class, 'index'])->name('dashboard');
});
