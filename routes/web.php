<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;  
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

// Halaman Home
Route::get('/', function () {
    return view('welcome');
});

// auth routs
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

<<<<<<< HEAD
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// admin dan user
Route::middleware('auth')->group(function () {
Route::get('/admin/dashboard', [AdminController::class, 'index']);
Route::get('/home', [UserController::class, 'index']);
});
=======
// Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
>>>>>>> 3d7ad5e5ae32ed8ea3711bb1500a395067167db4
