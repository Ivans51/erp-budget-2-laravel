<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceJsonResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Only apply to API routes
        if ($request->is('api/*')) {
            // Force JSON Accept header for API requests
            $request->headers->set('Accept', 'application/json');

            $response = $next($request);

            // Ensure the response is JSON
            if (!$response->headers->has('Content-Type') ||
                !str_contains($response->headers->get('Content-Type'), 'application/json')) {
                $response->headers->set('Content-Type', 'application/json');
            }

            return $response;
        }

        // For non-API routes, just pass through
        return $next($request);
    }
}
