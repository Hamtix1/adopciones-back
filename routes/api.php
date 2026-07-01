<?php

use App\Http\Controllers\Api\V1\AnimalController;
use App\Http\Controllers\Api\V1\AnimalStatusController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\DashboardController;
use App\Http\Controllers\Api\V1\ShelterController;
use App\Http\Controllers\Api\V1\ShelterListController;
use App\Models\Municipality;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('animal-statuses', [AnimalStatusController::class, 'index']);
        Route::get('shelters/list', [ShelterListController::class, 'index']);
        Route::get('municipalities', function () {
            return response()->json(Municipality::orderBy('name')->get());
        });
        Route::get('dashboard', [DashboardController::class, 'index']);
        Route::apiResource('shelters', ShelterController::class);
        Route::apiResource('animals', AnimalController::class);
        Route::post('logout', [AuthController::class, 'logout']);
    });
});
