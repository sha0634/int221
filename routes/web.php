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
        // Suspension Check
        if (auth()->user()->is_suspended) {
            auth()->logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            return redirect()->route('login')->withErrors([
                'email' => 'Your account has been suspended by an administrator. Please contact support.'
            ]);
        }

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

            // Real Daily Chart (Last 7 Days)
            $viewsByDay = [];
            if ($portfolio) {
                for ($i = 6; $i >= 0; $i--) {
                    $carbonDate = now()->subDays($i);
                    $dateStr = $carbonDate->format('Y-m-d');
                    $count = $portfolio->views()->whereDate('created_at', $dateStr)->count();
                    $viewsByDay[] = [
                        'day' => $carbonDate->format('D'),
                        'count' => $count
                    ];
                }
            } else {
                $viewsByDay = [
                    ['day' => 'Mon', 'count' => 0],
                    ['day' => 'Tue', 'count' => 0],
                    ['day' => 'Wed', 'count' => 0],
                    ['day' => 'Thu', 'count' => 0],
                    ['day' => 'Fri', 'count' => 0],
                    ['day' => 'Sat', 'count' => 0],
                    ['day' => 'Sun', 'count' => 0],
                ];
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
            
            $searchAppearances = $portfolio ? $portfolio->search_appearances : 0;
            $inquiriesCount = $portfolio ? $portfolio->inquiries()->count() : 0;
            $inquiryConversion = $totalViews > 0 ? round(($inquiriesCount / $totalViews) * 100, 1) : 0.0;

            // Query Contracts & Invoices associated with this creator
            $contracts = $portfolio ? \App\Models\Contract::where('portfolio_id', $portfolio->id)->latest()->get() : collect();
            $invoices = $portfolio ? \App\Models\Invoice::where('portfolio_id', $portfolio->id)->latest()->get() : collect();

            return view('dashboard-creator', compact(
                'inquiries', 
                'totalViews', 
                'viewsThisWeek', 
                'viewsTrend', 
                'viewsByDay', 
                'profileStrength',
                'skills',
                'projectsCount',
                'searchAppearances',
                'inquiriesCount',
                'inquiryConversion',
                'contracts',
                'invoices'
            ));
        } elseif ($role === 'client') {
            $email = auth()->user()->email;
            
            // 1. Fetch inquiries sent by this client
            $inquiries = \App\Models\Inquiry::where('client_email', $email)
                ->with('portfolio')
                ->latest()
                ->get();
                
            // 2. Calculate dynamic stats
            $totalInquiries = $inquiries->count();
            
            // Unique creators contacted (portfolios)
            $contactedPortfolioIds = $inquiries->pluck('portfolio_id')->unique();
            $creatorsCount = $contactedPortfolioIds->count();
            
            // Portfolios/creators contacted
            $creators = \App\Models\Portfolio::whereIn('id', $contactedPortfolioIds)
                ->with('user')
                ->get();
                
            // Replies received count (inquiries with replied status)
            $repliesCount = $inquiries->where('status', 'replied')->count();
            
            // 3. Discover Portfolios: All live portfolios
            $discoverPortfolios = \App\Models\Portfolio::where('is_live', true)
                ->latest()
                ->take(6)
                ->get();
                
            $allPortfolios = \App\Models\Portfolio::where('is_live', true)
                ->with('user')
                ->latest()
                ->get();

            // Increment Search Appearances in database
            if ($allPortfolios->count() > 0) {
                \App\Models\Portfolio::whereIn('id', $allPortfolios->pluck('id'))->increment('search_appearances');
            }

            // 4. Fetch Contracts & Invoices (Billing) for this client
            $contracts = \App\Models\Contract::where('client_email', $email)
                ->with('portfolio')
                ->latest()
                ->get();
                
            $invoices = \App\Models\Invoice::where('client_email', $email)
                ->with(['portfolio', 'contract'])
                ->latest()
                ->get();

            return view('dashboard-client', compact(
                'inquiries',
                'totalInquiries',
                'creatorsCount',
                'creators',
                'repliesCount',
                'discoverPortfolios',
                'allPortfolios',
                'contracts',
                'invoices'
            ));
        } elseif ($role === 'admin') {
            // 1. Users
            $users = \App\Models\User::latest()->get();
            $totalUsersCount = $users->count();
            $creatorsCount = $users->where('role', 'creator')->count();
            $clientsCount = $users->where('role', 'client')->count();
            $adminsCount = $users->where('role', 'admin')->count();
            
            // 2. Portfolios
            $portfolios = \App\Models\Portfolio::with('user')->latest()->get();
            $totalPortfoliosCount = $portfolios->count();
            $livePortfoliosCount = $portfolios->where('is_live', true)->count();
            $draftPortfoliosCount = $portfolios->where('is_live', false)->count();
            
            // 3. Contracts
            $contracts = \App\Models\Contract::with('portfolio')->latest()->get();
            $totalContractsCount = $contracts->count();
            $totalContractValue = $contracts->sum('amount');
            $activeContractsValue = $contracts->where('status', 'active')->sum('amount');
            
            // 4. Invoices (Billing & Revenue)
            $invoices = \App\Models\Invoice::with(['portfolio', 'contract'])->latest()->get();
            $totalInvoicesCount = $invoices->count();
            $totalRevenue = $invoices->where('status', 'paid')->sum('amount');
            $outstandingRevenue = $invoices->where('status', 'unpaid')->sum('amount');
            
            // 5. Inquiries
            $inquiries = \App\Models\Inquiry::with('portfolio')->latest()->get();
            $totalInquiriesCount = $inquiries->count();
            
            // 6. Global Traffic (Portfolio Views)
            $totalViews = \App\Models\PortfolioView::count();
            
            return view('dashboard-admin', compact(
                'users', 'totalUsersCount', 'creatorsCount', 'clientsCount', 'adminsCount',
                'portfolios', 'totalPortfoliosCount', 'livePortfoliosCount', 'draftPortfoliosCount',
                'contracts', 'totalContractsCount', 'totalContractValue', 'activeContractsValue',
                'invoices', 'totalInvoicesCount', 'totalRevenue', 'outstandingRevenue',
                'inquiries', 'totalInquiriesCount', 'totalViews'
            ));
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

    // Client Inquiries Management
    Route::post('/client/inquiries/{inquiry}/reply', function (\Illuminate\Http\Request $request, $id) {
        $inquiry = \App\Models\Inquiry::findOrFail($id);
        
        // Ensure the logged-in client is the owner of this inquiry
        if ($inquiry->client_email !== auth()->user()->email) {
            abort(403);
        }
        
        $request->validate([
            'message' => 'required|string',
        ]);
        
        $replies = $inquiry->replies ?? [];
        $replies[] = [
            'sender' => 'client',
            'message' => $request->message,
            'created_at' => now()->toIso8601String(),
        ];
        
        $inquiry->update([
            'replies' => $replies,
            'status' => 'new', // Reset status so the creator knows they have a new message
        ]);
        
        return back()->with('success', 'Your follow-up reply was submitted successfully!');
    })->name('client.inquiries.reply');

    // Client Contracts signing
    Route::post('/client/contracts/{contract}/sign', function ($id) {
        $contract = \App\Models\Contract::findOrFail($id);
        if ($contract->client_email !== auth()->user()->email) {
            abort(403);
        }
        
        $contract->update([
            'status' => 'active',
            'signed_at' => now(),
        ]);
        
        return back()->with('success', 'Contract "' . $contract->title . '" has been signed successfully!');
    })->name('client.contracts.sign');

    // Client Contract Drafting
    Route::post('/client/contracts/draft', function (\Illuminate\Http\Request $request) {
        $request->validate([
            'portfolio_id' => 'required|exists:portfolios,id',
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string',
        ]);
        
        $contract = \App\Models\Contract::create([
            'client_email' => auth()->user()->email,
            'portfolio_id' => $request->portfolio_id,
            'title' => $request->title,
            'amount' => $request->amount,
            'description' => $request->description,
            'status' => 'pending',
        ]);
        
        return back()->with('success', 'Contract "' . $contract->title . '" has been successfully drafted and sent to the creator!');
    })->name('client.contracts.draft');

    // Client Invoice payment
    Route::post('/client/invoices/{invoice}/pay', function ($id) {
        $invoice = \App\Models\Invoice::findOrFail($id);
        if ($invoice->client_email !== auth()->user()->email) {
            abort(403);
        }
        
        $invoice->update([
            'status' => 'paid',
            'paid_at' => now(),
        ]);
        
        return back()->with('success', 'Invoice "' . $invoice->title . '" has been paid successfully!');
    })->name('client.invoices.pay');

    // Creator keywords update
    Route::post('/creator/portfolio/keywords', function (\Illuminate\Http\Request $request) {
        $portfolio = auth()->user()->portfolio;
        if (!$portfolio) {
            return back()->with('error', 'Create a portfolio first!');
        }
        
        $request->validate([
            'keywords' => 'required|string',
        ]);
        
        // Split by comma
        $keywords = array_map('trim', explode(',', $request->keywords));
        $keywords = array_filter($keywords); // Remove empty items
        
        $portfolio->update([
            'keywords' => array_values($keywords)
        ]);
        
        return back()->with('success', 'Portfolio keywords updated successfully!');
    })->name('creator.portfolio.keywords');

    // Creator Contract signing
    Route::post('/creator/contracts/{contract}/sign', function ($id) {
        $contract = \App\Models\Contract::findOrFail($id);
        $portfolio = auth()->user()->portfolio;
        if (!$portfolio || $contract->portfolio_id !== $portfolio->id) {
            abort(403);
        }
        
        $contract->update([
            'status' => 'active',
            'signed_at' => now(),
        ]);
        
        return back()->with('success', 'Contract "' . $contract->title . '" has been signed and is now active!');
    })->name('creator.contracts.sign');

    // Creator Invoice generation
    Route::post('/creator/invoices/store', function (\Illuminate\Http\Request $request) {
        $request->validate([
            'contract_id' => 'required|exists:contracts,id',
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
        ]);
        
        $contract = \App\Models\Contract::findOrFail($request->contract_id);
        $portfolio = auth()->user()->portfolio;
        if (!$portfolio || $contract->portfolio_id !== $portfolio->id) {
            abort(403);
        }
        
        $invoice = \App\Models\Invoice::create([
            'contract_id' => $contract->id,
            'client_email' => $contract->client_email,
            'portfolio_id' => $portfolio->id,
            'title' => $request->title,
            'amount' => $request->amount,
            'due_date' => $request->due_date,
            'status' => 'unpaid',
        ]);
        
        return back()->with('success', 'Invoice "' . $invoice->title . '" has been successfully generated and sent to the client!');
    })->name('creator.invoices.store');

    // Admin Toggle Suspension
    Route::post('/admin/users/{user}/toggle-suspension', function ($id) {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        
        $user = \App\Models\User::findOrFail($id);
        
        // Prevent admins from suspending themselves
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot suspend your own administrator account!');
        }
        
        $user->update([
            'is_suspended' => !$user->is_suspended
        ]);
        
        $statusStr = $user->is_suspended ? 'suspended' : 're-activated';
        return back()->with('success', 'User "' . $user->name . '" has been successfully ' . $statusStr . '!');
    })->name('admin.users.toggle-suspension');
});

// Public Portfolio View
Route::get('/portfolio/{slug}', [\App\Http\Controllers\PortfolioController::class, 'show'])->name('portfolio.show');
Route::post('/portfolio/{slug}/inquiry', [\App\Http\Controllers\InquiryController::class, 'store'])->name('portfolio.inquiry');
