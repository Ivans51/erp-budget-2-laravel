<?php

use Illuminate\Support\Facades\Route;

// Vue.js SPA catch-all route - handles all non-API routes
// This ensures Vue Router can handle client-side routing
Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');
