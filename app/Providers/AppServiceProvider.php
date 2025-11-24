<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 1. Success Response Macro
        Response::macro('success', function ($data = null, $message = 'Success', $status = 200) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $data,
            ], $status);
        });

        // 2. Error Response Macro
        Response::macro('error', function ($message = 'Error', $status = 400, $errors = []) {
            return response()->json([
                'success' => false,
                'message' => $message,
                'errors' => $errors, // Optional: validation errors or specific details
            ], $status);
        });
    }
}
