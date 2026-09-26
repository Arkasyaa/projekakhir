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
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\RiwayatRentalController;
use App\Http\Controllers\SewaController;



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

    Route::get('/home', [UserController::class, 'index'])->name('home');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/daftar_alat', [UserAlatController::class, 'index'])->name('daftar.alat');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
Route::get('/kelola_rental', [KelolaRentalController::class, 'index'])->name('kelola_rental.index');
Route::get('/kelola_rental/{id}', [KelolaRentalController::class, 'show'])->name('kelola_rental.show');
Route::patch('/kelola_rental/{id}/setuju', [KelolaRentalController::class, 'setuju'])->name('kelola_rental.setuju');
Route::patch('/kelola_rental/{id}/tolak', [KelolaRentalController::class, 'tolak'])->name('kelola_rental.tolak');
Route::patch('/kelola_rental/{id}/selesai', [KelolaRentalController::class, 'selesai'])->name('kelola_rental.selesai');
Route::patch('/kelola_rental/{id}/update-status', [KelolaRentalController::class, 'updateStatus'])->name('kelola_rental.update_status');
});

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
Route::resource('keranjang', KeranjangController::class);
Route::post('/sewa/checkout', [SewaController::class, 'checkout'])->name('sewa.checkout');
Route::get('/riwayat/{riwayat}', [RiwayatrentalController::class, 'show'])->name('riwayat.show');

Route::middleware('auth')->group(function () {
Route::get('/riwayat', [RiwayatRentalController::class, 'index'])->name('riwayat.index');
Route::get('/riwayat/{id}', [RiwayatRentalController::class, 'show'])->name('riwayat.show');
});
