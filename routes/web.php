<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:login');
    
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/dashboard', function () {
        $role = auth()->user()->role;
        
        if ($role === 'creator') {
            return view('dashboard-creator');
        } elseif ($role === 'client') {
            return view('dashboard-client');
        } elseif ($role === 'admin') {
            return view('dashboard-admin');
        }
        
        // Fallback
        return view('dashboard-creator');
    })->name('dashboard');
});
