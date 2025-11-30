<?php

use App\Http\Controllers\V1\Auth\LoginController;
use App\Http\Controllers\V1\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public API test route (no authentication required)
Route::get('/test', function () {
    return response()->json([
        'message' => 'Vue.js can communicate with Laravel API',
        'timestamp' => now()->toISOString(),
        'status' => 'success'
    ]);
});

// API Version 1 Routes
Route::prefix('v1')->group(function () {

    // Public routes (no authentication required)
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/register', [RegisterController::class, 'register']);

    // Protected routes (authentication required)
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [LoginController::class, 'logout']);
        Route::get('/me', [LoginController::class, 'me']);

        // Example of authenticated user route
        Route::get('/user', function (Request $request) {
            return response()->json([
                'success' => true,
                'data' => [
                    'user' => $request->user(),
                ],
            ]);
        });

        // Example authenticated route for Vue components
        Route::get('/profile', function (Request $request) {
            return response()->json([
                'message' => 'Authenticated route accessible to Vue components',
                'user' => $request->user()
            ]);
        });
    });
});
