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
            $portfolio = auth()->user()->portfolio;
            $inquiries = $portfolio ? $portfolio->inquiries()->latest()->take(5)->get() : collect();
            
            // Calculate real analytics for summary page
            $totalViews = $portfolio ? $portfolio->views()->count() : 0;
            $viewsThisWeek = $portfolio ? $portfolio->views()->where('created_at', '>=', now()->subDays(7))->count() : 0;
            $viewsPreviousWeek = $portfolio ? $portfolio->views()->whereBetween('created_at', [now()->subDays(14), now()->subDays(7)])->count() : 0;
            
            if ($viewsPreviousWeek > 0) {
                $diff = $viewsThisWeek - $viewsPreviousWeek;
                $percent = round(($diff / $viewsPreviousWeek) * 100);
                $viewsTrend = ($percent >= 0 ? '↑ ' : '↓ ') . abs($percent) . '%';
            } else {
                $viewsTrend = '↑ ' . $viewsThisWeek;
            }

            // Real Daily Chart
            $viewsByDay = [];
            if ($portfolio) {
                for ($i = 6; $i >= 0; $i--) {
                    $carbonDate = now()->subDays($i);
                    $dateStr = $carbonDate->format('Y-m-d');
                    $count = $portfolio->views()->whereDate('created_at', $dateStr)->count();
                    $viewsByDay[] = $count;
                }
            } else {
                $viewsByDay = [0, 0, 0, 0, 0, 0, 0];
            }

            // Calculate Profile Strength
            $profileStrength = 0;
            if ($portfolio) {
                if ($portfolio->title) $profileStrength += 20;
                if ($portfolio->bio) $profileStrength += 20;
                if ($portfolio->about_text) $profileStrength += 20;
                if ($portfolio->skills && count($portfolio->skills) > 0) $profileStrength += 20;
                if ($portfolio->projects && count($portfolio->projects) > 0) $profileStrength += 20;
            }

            $skills = $portfolio && $portfolio->skills ? $portfolio->skills : ['Add Skills'];
            $projectsCount = $portfolio && $portfolio->projects ? count($portfolio->projects) : 0;

            return view('dashboard-creator', compact(
                'inquiries', 
                'totalViews', 
                'viewsThisWeek', 
                'viewsTrend', 
                'viewsByDay', 
                'profileStrength',
                'skills',
                'projectsCount'
            ));
        } elseif ($role === 'client') {
            return view('dashboard-client');
        } elseif ($role === 'admin') {
            return view('dashboard-admin');
        }
        
        // Fallback
        return view('dashboard-creator', [
            'inquiries' => collect(),
            'totalViews' => 0,
            'viewsThisWeek' => 0,
            'viewsTrend' => '0%',
            'viewsByDay' => [0, 0, 0, 0, 0, 0, 0],
            'profileStrength' => 0,
            'skills' => ['Add Skills'],
            'projectsCount' => 0
        ]);
    })->name('dashboard');

    // Portfolio Management
    Route::prefix('creator/portfolio')->name('creator.portfolio.')->group(function () {
        Route::get('/', [\App\Http\Controllers\PortfolioController::class, 'index'])->name('index');
        Route::get('/templates', [\App\Http\Controllers\PortfolioController::class, 'templates'])->name('templates');
        Route::get('/editor', [\App\Http\Controllers\PortfolioController::class, 'editor'])->name('editor');
        Route::post('/save-ajax', [\App\Http\Controllers\PortfolioController::class, 'saveAjax'])->name('saveAjax');
        Route::post('/upload-image', [\App\Http\Controllers\PortfolioController::class, 'uploadImage'])->name('uploadImage');
        Route::post('/toggle-live', [\App\Http\Controllers\PortfolioController::class, 'toggleLive'])->name('toggleLive');
        
        // Wildcard parameter routes placed at the end so they do not conflict
        Route::get('/create/{template}', [\App\Http\Controllers\PortfolioController::class, 'create'])->name('create');
    });

    // Inquiries Management
    Route::prefix('creator/inquiries')->name('creator.inquiries.')->group(function () {
        Route::get('/', [\App\Http\Controllers\InquiryController::class, 'index'])->name('index');
        Route::get('/{inquiry}', [\App\Http\Controllers\InquiryController::class, 'show'])->name('show');
        Route::post('/{inquiry}/reply', [\App\Http\Controllers\InquiryController::class, 'reply'])->name('reply');
    });

    // Analytics Management
    Route::get('/creator/analytics', [\App\Http\Controllers\AnalyticsController::class, 'index'])->name('creator.analytics');
});

// Public Portfolio View
Route::get('/portfolio/{slug}', [\App\Http\Controllers\PortfolioController::class, 'show'])->name('portfolio.show');
Route::post('/portfolio/{slug}/inquiry', [\App\Http\Controllers\InquiryController::class, 'store'])->name('portfolio.inquiry');
