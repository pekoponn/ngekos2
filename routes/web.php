<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\BoardingHouseController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;

// Halaman awal (welcome)
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Boarding Houses Resource
    Route::get('/boarding-houses', [BoardingHouseController::class, 'index'])->name('boarding-houses.index');
    Route::get('/boarding-houses/{slug}', [BoardingHouseController::class, 'show'])->name('boarding-houses.show');
    
    // Optional Dashboard
    Route::get('/dashboard', function() {
        return redirect()->route('boarding-houses.index');
    })->name('dashboard');
});