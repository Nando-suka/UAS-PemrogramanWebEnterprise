<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public API routes
Route::prefix('v1')->group(function () {
    
    // Authentication endpoints
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    
    // JWT Token management
    Route::post('/token/verify', [AuthController::class, 'verifyToken']);
    Route::post('/token/refresh', [AuthController::class, 'refreshToken']);
    
    // Protected routes (require JWT token)
    Route::middleware('auth:api')->group(function () {
        Route::get('/user', function (Request $request) {
            return response()->json([
                'success' => true,
                'data' => $request->user()
            ]);
        });
        
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});

// Health check
Route::get('/health', function () {
    return response()->json([
        'status' => 'healthy',
        'timestamp' => now()->toDateTimeString(),
        'jwt_algorithm' => 'HS256 (SHA-256)',
        'token_expiry' => '30 minutes'
    ]);
});