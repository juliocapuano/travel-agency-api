<?php

use App\Http\Controllers\API\V1\Admin\RoleController as SecRoleController;
use App\Http\Controllers\API\V1\Admin\TourController as SecTourController;
use App\Http\Controllers\API\V1\Admin\TravelController as SecTravelController;
use App\Http\Controllers\API\V1\Admin\UserController as SecUserController;
use App\Http\Controllers\API\V1\Auth\AuthController;
use App\Http\Controllers\API\V1\Public\TourController;
use App\Http\Controllers\API\V1\Public\TravelController;
use Illuminate\Support\Facades\Route;

/* API Routes */

// AUTH
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth:sanctum');

// ADMIN  // Secure area
Route::prefix('secure')
    ->name('secure.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('users', SecUserController::class);
        Route::apiResource('roles', SecRoleController::class);
        Route::prefix('travels/{travel}')
            ->name('travels.')
            ->scopeBindings()
            ->group(function () {
                Route::apiResource('tours', SecTourController::class);
            });

        Route::apiResource('travels', SecTravelController::class);
    });

// Public

Route::get('travels', [TravelController::class, 'index'])->name('travels');
Route::get('travels/{travel:slug}/tours', [TourController::class, 'index'])
    ->name('travels.tours')
    ->scopeBindings();

Route::fallback(function () {
    return Response::json([
        'message' => 'No valid Endpoint',
    ], 404);
});
