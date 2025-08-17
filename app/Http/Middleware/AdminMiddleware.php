<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user || $user->is_admin != 1) {
                return response()->json(['error' => 'Unauthorized. Admins only.'], 403);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Token invalid or missing'], 401);
        }

        return $next($request);
    }
}
