<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserAlatController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KelolaRentalController;
use App\Http\Controllers\AdminAlatController;
use App\Http\Controllers\KelolaUserController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\RiwayatRentalController;
use App\Http\Controllers\SewaController;
use App\Http\Middleware\AdminOnly;


/*
|--------------------------------------------------------------------------
| Route publik (bisa dibuka tanpa login)
|--------------------------------------------------------------------------
*/

// Halaman welcome
Route::get('/', function () {
    return view('welcome');
});

// Halaman Home + katalog (tujuan menu navbar)
Route::get('/home', [UserController::class, 'index'])->name('home');
Route::get('/katalog', [UserAlatController::class, 'index'])->name('katalog.index');
Route::get('/daftar_alat', [UserAlatController::class, 'index'])->name('daftar.alat');

// Auth routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| Route user (harus login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Profil
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    // Keranjang dan checkout (checkout memakai Auth::user())
    Route::resource('keranjang', KeranjangController::class);
    Route::post('/sewa/checkout', [SewaController::class, 'checkout'])->name('sewa.checkout');

    // Riwayat
    Route::get('/riwayat', [RiwayatRentalController::class, 'index'])->name('riwayat.index');
    Route::get('/riwayat/{riwayat}', [RiwayatRentalController::class, 'show'])->name('riwayat.show');
});


/*
|--------------------------------------------------------------------------
| Route admin (harus login DAN role admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', AdminOnly::class])->group(function () {
    Route::get('/admin', function () {
        return redirect()->route('admin.alat.index');
    })->name('admin');
});

Route::middleware(['auth', AdminOnly::class])->prefix('admin')->name('admin.')->group(function () {
    // Kelola alat
    Route::resource('alat', AdminAlatController::class);

    // Kelola rental
    Route::get('/kelola_rental', [KelolaRentalController::class, 'index'])->name('kelola_rental.index');
    Route::get('/kelola_rental/{id}', [KelolaRentalController::class, 'show'])->name('kelola_rental.show');
    Route::patch('/kelola_rental/{id}/setuju', [KelolaRentalController::class, 'setuju'])->name('kelola_rental.setuju');
    Route::patch('/kelola_rental/{id}/tolak', [KelolaRentalController::class, 'tolak'])->name('kelola_rental.tolak');
    Route::patch('/kelola_rental/{id}/selesai', [KelolaRentalController::class, 'selesai'])->name('kelola_rental.selesai');
    Route::patch('/kelola_rental/{id}/update-status', [KelolaRentalController::class, 'updateStatus'])->name('kelola_rental.update_status');

    // Kelola user
    Route::resource('kelola_user', KelolaUserController::class);
});
