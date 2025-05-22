<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\BoardingHouseController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;

// Halaman awal (welcome)
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// ==========================
// AUTHENTIKASI
// ==========================

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

// Logout (harus pakai POST dan middleware auth)
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// ==========================
// FITUR UNTUK USER LOGIN
// ==========================

Route::middleware('auth')->group(function () {
    // Dashboard berisi daftar kos
    Route::get('/dashboard', [BoardingHouseController::class, 'index'])->name('dashboard');

    // Detail kos berdasarkan slug
    Route::get('/boarding-house/{slug}', [BoardingHouseController::class, 'show'])->name('boarding-house.show');
});
