<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiAuthentication
{
    public function handle(Request $request, Closure $next)
    {
        // Allow OPTIONS requests for CORS
        if ($request->isMethod('OPTIONS')) {
            return $next($request);
        }

        // Get the API token from headers
        $token = $request->header('X-API-TOKEN');

        // For now, we'll use a simple token check
        // In production, you should use Laravel's built-in authentication
        $validToken = config('app.api_token');

        if (!$token || $token !== $validToken) {
            return response()->json([
                'error' => 'Unauthorized'
            ], 401);
        }

        return $next($request);
    }
}
