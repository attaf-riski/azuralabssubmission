<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
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
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // book category
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    // book
    Route::get('/book', [BookController::class, 'index'])->name('book.index');
    Route::get('/book/create', [BookController::class, 'create'])->name('book.create');
    Route::post('/book/store', [BookController::class, 'store'])->name('book.store');
    Route::get('/book/edit/{id}', [BookController::class, 'edit'])->name('book.edit');
    Route::put('/book/update/{id}', [BookController::class, 'update'])->name('book.update');
    Route::delete('/book/destroy/{id}', [BookController::class, 'destroy'])->name('book.destroy');
});
