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
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// admin dan user
Route::middleware('auth')->group(function () {
Route::get('/admin/dashboard', [AdminController::class, 'index']);
Route::get('/home', [UserController::class, 'index']);
});