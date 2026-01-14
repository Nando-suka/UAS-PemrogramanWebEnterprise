<?php

namespace App\Http\Middleware;

use App\Services\JWTService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JWTMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get token from Authorization header
        $token = $request->header('Authorization');
        
        if (!$token) {
            return response()->json([
                'success' => false,
                'message' => 'Token not provided'
            ], 401);
        }
        
        // Remove "Bearer " prefix
        $token = str_replace('Bearer ', '', $token);
        
        // Verify token
        try {
            $decoded = JWTService::decodeToken($token);
            
            // Add decoded token data to request
            $request->merge(['jwt_payload' => $decoded]);
            
            return $next($request);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired token',
                'error' => $e->getMessage()
            ], 401);
        }
    }
}