<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BoardingHouseController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\BonusController;
use App\Http\Controllers\Api\CityController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Boarding House Routes
Route::prefix('boarding-houses')->group(function () {
    Route::get('/', [BoardingHouseController::class, 'index']);

    // ✅ Bulk insert boarding houses
    Route::post('/bulk', [BoardingHouseController::class, 'storeMultiple']);

    Route::post('/', [BoardingHouseController::class, 'store']);
    Route::get('/{id}', [BoardingHouseController::class, 'show']);
    Route::put('/{id}', [BoardingHouseController::class, 'update']);
    Route::delete('/{id}', [BoardingHouseController::class, 'destroy']);

    // Room Routes
    Route::prefix('/{boardingHouseId}/rooms')->group(function () {
        Route::post('/', [RoomController::class, 'store']);
        Route::put('/{id}', [RoomController::class, 'update']);
        Route::delete('/{id}', [RoomController::class, 'destroy']);
    });

    // Bonus Routes
    Route::prefix('/{boardingHouseId}/bonuses')->group(function () {
        Route::post('/', [BonusController::class, 'store']);
        Route::put('/{id}', [BonusController::class, 'update']);
        Route::delete('/{id}', [BonusController::class, 'destroy']);
    });
});

// City Routes
Route::prefix('cities')->group(function () {
    // Single operations
    Route::get('/', [CityController::class, 'index']);
    Route::post('/', [CityController::class, 'store']);
    Route::get('/{id}', [CityController::class, 'show']);
    Route::put('/{id}', [CityController::class, 'update']);
    Route::delete('/{id}', [CityController::class, 'destroy']);

    // Bulk operations
    Route::post('/bulk', [CityController::class, 'bulkStore']);
    Route::put('/bulk', [CityController::class, 'bulkUpdate']);
    Route::delete('/bulk', [CityController::class, 'bulkDestroy']);
});
