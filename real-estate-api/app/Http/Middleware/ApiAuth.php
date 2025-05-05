<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiAuth
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');
        
        // Replace this with your actual API token validation logic
        $validToken = env('API_TOKEN');
        
        if (!$token || $token !== "Bearer {$validToken}") {
            return response()->json([
                'error' => 'Unauthorized'
            ], 401);
        }

        return $next($request);
    }
}
