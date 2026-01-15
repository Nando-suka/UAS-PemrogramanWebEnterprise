<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\JurnalController;
use Illuminate\Support\Facades\Route;

// Entry page (root)
Route::get('/', function () {
    return view('entry');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    
    // Register
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');

    // Register v2 (desain baru)
    Route::get('/register-v2', function () {
        return view('auth.register-v2');
    })->name('register.v2');
    
    // Forgot Password
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPassword'])->name('forgot.password');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('forgot.password.post');
    
    // Reset Password
    Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetPassword'])->name('reset.password');
    Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('reset.password.post');
});

// Protected Routes (butuh login)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// menambhakan route untuk testing api
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Jurnal Routes
    Route::prefix('jurnal')->group(function () {
        Route::get('/daily', [JurnalController::class, 'daily'])->name('jurnal.daily');
        Route::get('/weekly', [JurnalController::class, 'weekly'])->name('jurnal.weekly');
        Route::get('/monthly', [JurnalController::class, 'monthly'])->name('jurnal.monthly');
    });
    
    Route::get('/api-test', function () {
        return view('dashboard.api-test');
    })->name('api.test');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/database-user', function () {
    return view('Database-User.databaseUser');
})->name('database.user');

Route::get('/Report', function () {
    return view('Report.report');
})->name('report');

// Route untuk index.blade-copy.php
Route::middleware('auth')->group(function () {
    Route::get('/dashboard-copy', [DashboardController::class, 'indexCopy'])->name('dashboard.copy');
});

/*
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Database User routes
    Route::get('/database-user', [DatabaseUserController::class, 'index'])->name('database.user');
    Route::get('/database-user/update', [DatabaseUserController::class, 'update'])->name('database.user.update');
    Route::get('/database-user/read-password', [DatabaseUserController::class, 'readPassword'])->name('database.user.read.password');
});*/