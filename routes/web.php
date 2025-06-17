<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\BoardingHouseController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;

// Halaman Categories
Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');

// Halaman About
Route::get('/about', [App\Http\Controllers\PageController::class, 'about'])->name('about');

// Halaman Kontak
Route::get('/contact', [App\Http\Controllers\PageController::class, 'contact'])->name('contact');

// Halaman awal (welcome)
Route::get("/", function () {
    return view("welcome");

})->name("welcome");


// Authentication Routes
Route::middleware("guest")->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
});

// Logout Route
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', function() {
        return redirect()->route('boarding-houses.index');
    })->name('dashboard');

    // Boarding Houses Routes
    Route::prefix('boarding-houses')->group(function () {
        Route::get("/", [BoardingHouseController::class, "index"])->name("boarding-houses.index");

        Route::get("/{slug}", [BoardingHouseController::class, "show"])->name("boarding-houses.show");

    });

    // Profile Routes
    Route::prefix('profile')->group(function () {
        Route::get("/", [ProfileController::class, "show"])->name("profile");

        Route::put("/", [ProfileController::class, "update"])->name("profile.update");

        Route::post('/avatar', [ProfileController::class, "updateAvatar"])->name("profile.avatar");

    });

    // Other authenticated routes can be added here...
});

// Public Boarding Houses Routes (if needed)
// Route::get('/boarding-houses', [BoardingHouseController::class, 'index'])->name('boarding-houses.public.index');
// Route::get('/boarding-houses/{slug}', [BoardingHouseController::class, 'show'])->name('boarding-houses.public.show');
