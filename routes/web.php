<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserAlatController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KelolaRentalController;
use App\Http\Controllers\AdminAlatController;
use App\Http\Controllers\KelolauserController;

// Halaman Home
Route::get('/', function () {
    return view('welcome');
});

// auth routs
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// admin dan user
Route::middleware('auth')->group(function () {
    Route::get('/admin', function () {
        return redirect()->route('admin.alat.index');
    })->name('admin');

    Route::get('/home', [UserController::class, 'index']);
});

Route::get('/daftar_alat', [UserAlatController::class, 'index'])->name('daftar.alat');
Route::middleware('auth')->group(function () {
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('alat', AdminAlatController::class);
});

Route::get('admin/kelola_rental', [KelolaRentalController::class, 'index'])->name('admin.kelola_rental.index');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('alat', AdminAlatController::class);
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('alat', AdminAlatController::class);
});
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
Route::resource('kelola_user', KelolauserController::class);
});

Route::get('/katalog', [UserAlatController::class, 'index'])->name('katalog.index');

