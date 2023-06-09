<?php

use App\Http\Controllers\API\V1\RoleController;
use App\Http\Controllers\API\V1\TourController;
use App\Http\Controllers\API\V1\TravelController;
use App\Http\Controllers\API\V1\UserController;
use Illuminate\Support\Facades\Route;

/* API Routes */

Route::apiResource('users', UserController::class);
Route::apiResource('roles', RoleController::class);

Route::prefix('travels/{travel}')
    ->name('travels.')
    ->scopeBindings()
    ->group(function () {
        Route::apiResource('tours', TourController::class);
    });
Route::apiResource('travels', TravelController::class);

Route::fallback(function () {
    return Response::json([
        'message' => 'No valid Endpoint',
    ], 404);
});
