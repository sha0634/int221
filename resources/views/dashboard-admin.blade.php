<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - Folio.</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,600;1,600&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-body: #E5E9F2;
            --bg-card: #ffffff;
            --text-dark: #111827;
            --text-muted: #6B7280;
            --primary: #111827;
            --accent: #E67E22;
            --gradient-1: linear-gradient(135deg, #4338CA 0%, #6366F1 100%);
            --gradient-2: linear-gradient(135deg, #059669 0%, #10B981 100%);
            --gradient-3: linear-gradient(135deg, #BE123C 0%, #F43F5E 100%);
            --gradient-4: linear-gradient(135deg, #D97706 0%, #F59E0B 100%);
            --sidebar-width: 250px;
            --right-panel-width: 320px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-dark);
            min-height: 100vh;
        }

        .dashboard-app {
            background: var(--bg-card);
            width: 100%;
            height: 100vh;
            display: flex;
            overflow: hidden;
            position: relative;
        }

        /* SIDEBAR */
        .sidebar {
            width: var(--sidebar-width);
            background: #ffffff;
            border-right: 1px solid #F3F4F6;
            padding: 2rem 1.5rem;
            display: flex;
            flex-direction: column;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: -0.05em;
            color: var(--primary);
            text-decoration: none;
            margin-bottom: 3rem;
            padding-left: 0.5rem;
            display: flex;
            align-items: center;
        }
        .logo-dot { color: var(--accent); }

        .nav-links {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            flex: 1;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.875rem 1rem;
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            border-radius: 12px;
            transition: all 0.2s ease;
            cursor: pointer;
            border: none;
            background: transparent;
            width: 100%;
            text-align: left;
            outline: none;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--primary);
            background: #F9FAFB;
        }

        .nav-link.active {
            background: #EEF2FF;
            color: #4F46E5;
        }

        .nav-link svg { width: 20px; height: 20px; }

        .user-profile-card {
            background: #111827;
            color: white;
            border-radius: 16px;
            padding: 1rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-top: auto;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .user-info h4 { font-size: 0.875rem; font-weight: 600; margin-bottom: 0.25rem; color: white; }
        .user-info span { font-size: 0.75rem; color: #9CA3AF; font-weight: 600; text-transform: uppercase; }

        /* MAIN CONTENT */
        .main-content {
            flex: 1;
            padding: 0;
            overflow-y: auto;
            background: #FAFBFC;
        }

        .main-content-inner {
            padding: 2.5rem 3rem;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2.5rem;
        }

        .header h1 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--primary);
        }

        /* Top Stats Row */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            margin-bottom: 2.5rem;
        }

        @media (max-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .stat-card {
            border-radius: 16px;
            padding: 1.5rem;
            color: white;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
        }

        .stat-card.blue { background: var(--gradient-1); }
        .stat-card.green { background: var(--gradient-2); }
        .stat-card.orange { background: var(--gradient-4); }
        .stat-card.red { background: var(--gradient-3); }

        .stat-card-title {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.5rem;
            opacity: 0.9;
        }

        .stat-card-value {
            font-size: 1.75rem;
            font-weight: 700;
        }

        .stat-icon {
            position: absolute;
            right: -10px;
            bottom: -10px;
            width: 70px;
            height: 70px;
            opacity: 0.2;
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 1.25rem;
            color: var(--primary);
        }

        .middle-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        .bento-box {
            background: #ffffff;
            border-radius: 20px;
            padding: 2rem;
            border: 1px solid #E5E7EB;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
            margin-bottom: 2rem;
        }

        .badge {
            padding: 0.25rem 0.5rem;
            border-radius: 6px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            display: inline-block;
        }
        .badge-success { background: #D1FAE5; color: #065F46; }
        .badge-warning { background: #FEF3C7; color: #92400E; }
        .badge-danger { background: #FEE2E2; color: #991B1B; }

        /* Tables styling */
        .admin-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
            font-size: 0.9rem;
        }
        .admin-table th {
            text-align: left;
            padding: 0.85rem 1rem;
            background: #F9FAFB;
            color: var(--text-muted);
            font-weight: 700;
            border-bottom: 2px solid #E5E7EB;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
        }
        .admin-table td {
            padding: 1rem;
            border-bottom: 1px solid #E5E7EB;
            color: var(--text-dark);
            vertical-align: middle;
        }
        .admin-table tr:hover {
            background: #FAFBFC;
        }

        /* RIGHT PANEL */
        .right-panel {
            width: var(--right-panel-width);
            background: #ffffff;
            border-left: 1px solid #F3F4F6;
            padding: 2.5rem 2rem;
            overflow-y: auto;
        }

        .right-panel-card {
            background: #F9FAFB;
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid #E5E7EB;
        }

        .system-status {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }
        .status-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #10B981;
            box-shadow: 0 0 0 4px #D1FAE5;
        }
        .status-text { font-weight: 600; font-size: 0.875rem; }

        .logout-form { display: none; }
    </style>
</head>
<body>
    <div class="dashboard-app">
        <!-- Sidebar -->
        <aside class="sidebar">
            <a href="/" class="logo">
                Folio<span class="logo-dot">.</span>
            </a>
            
            <nav class="nav-links">
                <button class="nav-link active" onclick="switchTab('overview', this)">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Overview
                </button>
                <button class="nav-link" onclick="switchTab('users', this)">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    Users Directory
                </button>
                <button class="nav-link" onclick="switchTab('portfolios', this)">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    Portfolios Workspace
                </button>
                <button class="nav-link" onclick="switchTab('inquiries', this)">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    Inquiry Threads
                </button>
                <button class="nav-link" onclick="switchTab('contracts', this)">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Contracts Ledger
                </button>
                <button class="nav-link" onclick="switchTab('invoices', this)">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Invoices & Revenue
                </button>
                <button class="nav-link" onclick="document.getElementById('logout-form').submit(); return false;" style="margin-top: 1rem; border-top: 1px solid #E5E7EB; border-radius: 0; padding-top: 1.5rem;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Sign Out
                </button>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="logout-form">
                    @csrf
                </form>
            </nav>

            <div class="user-profile-card">
                <div class="avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                <div class="user-info">
                    <h4>{{ Auth::user()->name }}</h4>
                    <span>{{ Auth::user()->role }}</span>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="main-content-inner">
                <!-- Dynamic Platform Alerts -->
                @if(session('success'))
                    <div style="background: #DEF7EC; border: 1px solid #31C48D; color: #03543F; padding: 1rem 1.5rem; border-radius: 12px; font-weight: 600; font-size: 0.9rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                        <span>✅</span> {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div style="background: #FDE8E8; border: 1px solid #F8B4B4; color: #9B1C1C; padding: 1rem 1.5rem; border-radius: 12px; font-weight: 600; font-size: 0.9rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                        <span>❌</span> {{ session('error') }}
                    </div>
                @endif

                <div class="header">
                    <h1>Admin Control Panel</h1>
                    <span style="font-weight: 700; background: #EEF2FF; color: #4F46E5; padding: 0.5rem 1rem; border-radius: 12px; font-size: 0.85rem; border: 1px solid rgba(0,0,0,0.05);">
                        🔐 Master Database Access
                    </span>
                </div>

                <!-- TAB 1: Overview Content -->
                <div id="tab-content-overview" class="tab-pane">
                    <div class="stats-grid">
                        <div class="stat-card blue">
                            <div class="stat-card-title">Total Users</div>
                            <div class="stat-card-value">{{ $totalUsersCount }}</div>
                            <svg class="stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <div class="stat-card green">
                            <div class="stat-card-title">Settled Revenue</div>
                            <div class="stat-card-value">${{ number_format($totalRevenue, 2) }}</div>
                            <svg class="stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div class="stat-card orange">
                            <div class="stat-card-title">Outstanding Milestones</div>
                            <div class="stat-card-value">${{ number_format($outstandingRevenue, 2) }}</div>
                            <svg class="stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div class="stat-card red">
                            <div class="stat-card-title">Inquiry Threads</div>
                            <div class="stat-card-value">{{ $totalInquiriesCount }}</div>
                            <svg class="stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                    </div>

                    <div class="middle-grid" style="grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));">
                        <!-- Bento Registration Distribution -->
                        <div class="bento-box">
                            <h2 class="section-title">👤 User Registrations</h2>
                            <p style="color: var(--text-muted); font-size: 0.85rem; margin-bottom: 1.5rem;">Global active platform users breakdown by role permissions.</p>
                            <div style="display: flex; flex-direction: column; gap: 1rem;">
                                <div style="display: flex; justify-content: space-between; align-items: center; background: #F8FAFC; padding: 0.85rem 1.25rem; border-radius: 12px;">
                                    <span style="font-weight: 700; color: #4338CA;">🎨 Creators / Portfolios</span>
                                    <span style="font-weight: 800; font-size: 1.1rem; color: var(--text-dark);">{{ $creatorsCount }}</span>
                                </div>
                                <div style="display: flex; justify-content: space-between; align-items: center; background: #F8FAFC; padding: 0.85rem 1.25rem; border-radius: 12px;">
                                    <span style="font-weight: 700; color: #059669;">🏢 Business Clients</span>
                                    <span style="font-weight: 800; font-size: 1.1rem; color: var(--text-dark);">{{ $clientsCount }}</span>
                                </div>
                                <div style="display: flex; justify-content: space-between; align-items: center; background: #F8FAFC; padding: 0.85rem 1.25rem; border-radius: 12px;">
                                    <span style="font-weight: 700; color: #D97706;">🛡️ Platform Administrators</span>
                                    <span style="font-weight: 800; font-size: 1.1rem; color: var(--text-dark);">{{ $adminsCount }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Bento Portfolio Publishing -->
                        <div class="bento-box">
                            <h2 class="section-title">📂 Portfolio Directory Stats</h2>
                            <p style="color: var(--text-muted); font-size: 0.85rem; margin-bottom: 1.5rem;">Current portfolio items and their visual publishing state.</p>
                            <div style="display: flex; flex-direction: column; gap: 1rem;">
                                <div style="display: flex; justify-content: space-between; align-items: center; background: #FFFBEB; padding: 0.85rem 1.25rem; border-radius: 12px; border-left: 4px solid var(--accent);">
                                    <span style="font-weight: 700; color: #B45309;">🌐 Live Published</span>
                                    <span style="font-weight: 800; font-size: 1.1rem; color: var(--text-dark);">{{ $livePortfoliosCount }}</span>
                                </div>
                                <div style="display: flex; justify-content: space-between; align-items: center; background: #F9FAFB; padding: 0.85rem 1.25rem; border-radius: 12px; border-left: 4px solid #9CA3AF;">
                                    <span style="font-weight: 700; color: #4B5563;">📝 Work Drafts</span>
                                    <span style="font-weight: 800; font-size: 1.1rem; color: var(--text-dark);">{{ $draftPortfoliosCount }}</span>
                                </div>
                                <div style="display: flex; justify-content: space-between; align-items: center; background: #ECFDF5; padding: 0.85rem 1.25rem; border-radius: 12px; border-left: 4px solid #10B981;">
                                    <span style="font-weight: 700; color: #065F46;">📈 Total Platform Views</span>
                                    <span style="font-weight: 800; font-size: 1.1rem; color: var(--text-dark);">{{ $totalViews }} views</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TAB 2: Users Directory -->
                <div id="tab-content-users" class="tab-pane" style="display: none;">
                    <div class="bento-box">
                        <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #E5E7EB; padding-bottom: 1rem; margin-bottom: 1rem;">
                            <div>
                                <h2 class="section-title" style="margin-bottom: 0.25rem;">Platform Users</h2>
                                <p style="color: var(--text-muted); font-size: 0.85rem;">Browse and manage all registered user profile accounts in the database.</p>
                            </div>
                            <span class="badge badge-success" style="font-size: 0.8rem; padding: 0.4rem 0.8rem;">{{ $totalUsersCount }} Profiles</span>
                        </div>
                        <div style="overflow-x: auto;">
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email Address</th>
                                        <th>Platform Role</th>
                                        <th>Created Date</th>
                                        <th>Account Status</th>
                                        <th>Moderation Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td style="font-weight: 700; display: flex; align-items: center; gap: 0.75rem;">
                                                <div style="width: 32px; height: 32px; border-radius: 50%; background: #EEF2FF; color: #4F46E5; display: flex; align-items: center; justify-content: center; font-size: 0.85rem; font-weight: 900;">
                                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                                </div>
                                                {{ $user->name }}
                                            </td>
                                            <td style="font-family: monospace; color: #374151;">{{ $user->email }}</td>
                                            <td>
                                                @if($user->role === 'admin')
                                                    <span class="badge" style="background: #F3E8FF; color: #6B21A8;">Admin</span>
                                                @elseif($user->role === 'creator')
                                                    <span class="badge" style="background: #DBEAFE; color: #1E40AF;">Creator</span>
                                                @else
                                                    <span class="badge badge-success">Client</span>
                                                @endif
                                            </td>
                                            <td style="color: var(--text-muted); font-size: 0.85rem;">{{ $user->created_at->format('M d, Y H:i') }}</td>
                                            <td>
                                                @if($user->is_suspended)
                                                    <span class="badge badge-danger">Suspended</span>
                                                @else
                                                    <span class="badge badge-success">Active</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($user->id === auth()->id())
                                                    <span style="font-size: 0.8rem; color: var(--text-muted); font-weight: 700;">Admin Self</span>
                                                @else
                                                    <form action="{{ route('admin.users.toggle-suspension', $user->id) }}" method="POST" style="margin: 0; display: inline-block;">
                                                        @csrf
                                                        @if($user->is_suspended)
                                                            <button type="submit" style="padding: 0.35rem 0.75rem; background: #10B981; color: white; border: none; border-radius: 6px; font-size: 0.75rem; font-weight: 700; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#059669'" onmouseout="this.style.background='#10B981'">
                                                                Re-activate ✅
                                                            </button>
                                                        @else
                                                            <button type="submit" style="padding: 0.35rem 0.75rem; background: #EF4444; color: white; border: none; border-radius: 6px; font-size: 0.75rem; font-weight: 700; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#DC2626'" onmouseout="this.style.background='#EF4444'" onclick="return confirm('Are you sure you want to suspend this user account? The user will be instantly logged out and blocked from logging in.')">
                                                                Suspend 🚫
                                                            </button>
                                                        @endif
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- TAB 3: Portfolios Workspace -->
                <div id="tab-content-portfolios" class="tab-pane" style="display: none;">
                    <div class="bento-box">
                        <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #E5E7EB; padding-bottom: 1rem; margin-bottom: 1rem;">
                            <div>
                                <h2 class="section-title" style="margin-bottom: 0.25rem;">Creator Portfolios</h2>
                                <p style="color: var(--text-muted); font-size: 0.85rem;">Manage active styles, custom domain keywords, and live link properties.</p>
                            </div>
                            <span class="badge badge-warning" style="font-size: 0.8rem; padding: 0.4rem 0.8rem; background: #FEF3C7; color: #D97706;">{{ $totalPortfoliosCount }} Portfolios</span>
                        </div>
                        <div style="overflow-x: auto;">
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th>Creator Profile</th>
                                        <th>Design Template</th>
                                        <th>Theme Color</th>
                                        <th>Skills</th>
                                        <th>Domain Keywords</th>
                                        <th>Status</th>
                                        <th>Direct Link</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($portfolios as $p)
                                        <tr>
                                            <td style="font-weight: 700;">{{ $p->title }}</td>
                                            <td style="text-transform: capitalize; font-weight: 600;">
                                                <span class="badge" style="background: #F1F5F9; color: #475569;">{{ $p->template_name ?: 'Default' }}</span>
                                            </td>
                                            <td>
                                                <div style="display: flex; align-items: center; gap: 0.5rem;">
                                                    <span style="display: inline-block; width: 14px; height: 14px; border-radius: 4px; background: {{ $p->theme_color ?: '#000000' }}; border: 1px solid #E2E8F0;"></span>
                                                    <code style="font-size: 0.8rem;">{{ $p->theme_color ?: '#000000' }}</code>
                                                </div>
                                            </td>
                                            <td>
                                                <div style="display: flex; gap: 0.25rem; flex-wrap: wrap;">
                                                    @if(is_array($p->skills))
                                                        @foreach(array_slice($p->skills, 0, 3) as $s)
                                                            <span style="font-size: 0.7rem; background: #F3F4F6; padding: 0.15rem 0.35rem; border-radius: 4px; font-weight: 700; color: #374151;">{{ $s }}</span>
                                                        @endforeach
                                                        @if(count($p->skills) > 3)
                                                            <span style="font-size: 0.7rem; background: #FEF2F2; padding: 0.15rem 0.35rem; border-radius: 4px; font-weight: 700; color: var(--accent);">+{{ count($p->skills) - 3 }}</span>
                                                        @endif
                                                    @else
                                                        <span style="color: var(--text-muted); font-size: 0.75rem;">None</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="display: flex; gap: 0.25rem; flex-wrap: wrap;">
                                                    @if(is_array($p->keywords) && count($p->keywords) > 0)
                                                        @foreach(array_slice($p->keywords, 0, 3) as $k)
                                                            <span style="font-size: 0.7rem; background: #FFF5F5; padding: 0.15rem 0.35rem; border-radius: 4px; font-weight: 700; color: var(--accent);">#{{ $k }}</span>
                                                        @endforeach
                                                        @if(count($p->keywords) > 3)
                                                            <span style="font-size: 0.7rem; background: #FFF5F5; padding: 0.15rem 0.35rem; border-radius: 4px; font-weight: 700; color: var(--accent);">+{{ count($p->keywords) - 3 }}</span>
                                                        @endif
                                                    @else
                                                        <span style="color: var(--text-muted); font-size: 0.75rem;">None</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                @if($p->is_live)
                                                    <span class="badge badge-success">Live Published</span>
                                                @else
                                                    <span class="badge" style="background: #F3F4F6; color: #6B7280;">Draft</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="/portfolio/{{ $p->slug }}" target="_blank" style="padding: 0.35rem 0.75rem; background: var(--primary); color: white; border-radius: 6px; font-size: 0.75rem; text-decoration: none; font-weight: 600; display: inline-block;">View 🔗</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- TAB 4: Inquiries Conversations -->
                <div id="tab-content-inquiries" class="tab-pane" style="display: none;">
                    <div class="bento-box">
                        <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #E5E7EB; padding-bottom: 1rem; margin-bottom: 1rem;">
                            <div>
                                <h2 class="section-title" style="margin-bottom: 0.25rem;">Collaboration Inquiries</h2>
                                <p style="color: var(--text-muted); font-size: 0.85rem;">Review message conversations established between clients and creative portfolios.</p>
                            </div>
                            <span class="badge badge-danger" style="font-size: 0.8rem; padding: 0.4rem 0.8rem;">{{ $totalInquiriesCount }} Inquiries</span>
                        </div>
                        <div style="overflow-x: auto;">
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th>Sender / Client</th>
                                        <th>Creator Target</th>
                                        <th>Subject</th>
                                        <th>Message Preview</th>
                                        <th>Thread Status</th>
                                        <th>Date Sent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($inquiries as $inq)
                                        <tr>
                                            <td>
                                                <div style="font-weight: 700;">{{ $inq->client_name }}</div>
                                                <code style="font-size: 0.75rem; color: var(--text-muted);">{{ $inq->client_email }}</code>
                                            </td>
                                            <td style="font-weight: 600; color: var(--primary);">
                                                {{ $inq->portfolio ? $inq->portfolio->title : 'Deleted Portfolio' }}
                                            </td>
                                            <td style="font-weight: 700;">{{ $inq->subject }}</td>
                                            <td style="font-size: 0.8rem; color: #4B5563; max-width: 260px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                {{ $inq->message }}
                                            </td>
                                            <td>
                                                @if($inq->status === 'new')
                                                    <span class="badge badge-warning">New Message</span>
                                                @else
                                                    <span class="badge badge-success">Replied / Chatting</span>
                                                @endif
                                            </td>
                                            <td style="font-size: 0.85rem; color: var(--text-muted);">{{ $inq->created_at->format('M d, Y H:i') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- TAB 5: Contracts Ledger -->
                <div id="tab-content-contracts" class="tab-pane" style="display: none;">
                    <div class="bento-box">
                        <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #E5E7EB; padding-bottom: 1rem; margin-bottom: 1rem;">
                            <div>
                                <h2 class="section-title" style="margin-bottom: 0.25rem;">Contracts Ledger</h2>
                                <p style="color: var(--text-muted); font-size: 0.85rem;">Overview of professional service agreement contracts across the website.</p>
                            </div>
                            <span class="badge" style="font-size: 0.8rem; padding: 0.4rem 0.8rem; background: #DBEAFE; color: #1E40AF;">{{ $totalContractsCount }} Contracts</span>
                        </div>
                        <div style="overflow-x: auto;">
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th>Agreement Title</th>
                                        <th>Client Email</th>
                                        <th>Target Creator</th>
                                        <th>Contract Amount</th>
                                        <th>Status Badge</th>
                                        <th>Signature Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($contracts as $c)
                                        <tr>
                                            <td style="font-weight: 700;">{{ $c->title }}</td>
                                            <td style="font-family: monospace;">{{ $c->client_email }}</td>
                                            <td style="font-weight: 600;">{{ $c->portfolio ? $c->portfolio->title : 'N/A' }}</td>
                                            <td style="font-weight: 800; color: #059669; font-size: 0.95rem;">${{ number_format($c->amount, 2) }}</td>
                                            <td>
                                                @if($c->status === 'active')
                                                    <span class="badge badge-success">Active Signed</span>
                                                @elseif($c->status === 'pending')
                                                    <span class="badge badge-warning">Awaiting Signature</span>
                                                @else
                                                    <span class="badge" style="background: #F3F4F6; color: #6B7280;">Completed</span>
                                                @endif
                                            </td>
                                            <td style="color: var(--text-muted); font-size: 0.85rem;">
                                                {{ $c->signed_at ? $c->signed_at->format('M d, Y H:i') : 'Unsigned' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- TAB 6: Invoices & Milestone Revenue -->
                <div id="tab-content-invoices" class="tab-pane" style="display: none;">
                    <div class="bento-box">
                        <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #E5E7EB; padding-bottom: 1rem; margin-bottom: 1rem;">
                            <div>
                                <h2 class="section-title" style="margin-bottom: 0.25rem;">Milestones & Invoices Ledger</h2>
                                <p style="color: var(--text-muted); font-size: 0.85rem;">Track billing, payment status, settled revenues, and outstanding collections.</p>
                            </div>
                            <span class="badge badge-success" style="font-size: 0.8rem; padding: 0.4rem 0.8rem;">{{ $totalInvoicesCount }} Invoices</span>
                        </div>
                        <div style="overflow-x: auto;">
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th>Milestone Invoice</th>
                                        <th>Client Target</th>
                                        <th>Agreement Link</th>
                                        <th>Milestone Amount</th>
                                        <th>Due Date</th>
                                        <th>Payment Status</th>
                                        <th>Date Cleared</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($invoices as $i)
                                        <tr>
                                            <td style="font-weight: 700;">{{ $i->title }}</td>
                                            <td style="font-family: monospace;">{{ $i->client_email }}</td>
                                            <td style="font-weight: 600; color: var(--text-muted);">{{ $i->contract ? $i->contract->title : 'Direct' }}</td>
                                            <td style="font-weight: 800; color: var(--primary); font-size: 0.95rem;">${{ number_format($i->amount, 2) }}</td>
                                            <td style="font-size: 0.85rem; font-weight: 600;">{{ $i->due_date ? $i->due_date->format('M d, Y') : 'Immediate' }}</td>
                                            <td>
                                                @if($i->status === 'paid')
                                                    <span class="badge badge-success">Paid Settled</span>
                                                @else
                                                    <span class="badge badge-danger">Unpaid / Awaiting</span>
                                                @endif
                                            </td>
                                            <td style="color: var(--text-muted); font-size: 0.85rem;">
                                                {{ $i->paid_at ? $i->paid_at->format('M d, Y H:i') : 'Awaiting Settlement' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </main>

        <!-- Right Panel (Quick Hub) -->
        <aside class="right-panel">
            <h2 class="section-title">System Status</h2>
            <div class="right-panel-card">
                <div class="system-status">
                    <div class="status-dot"></div>
                    <div class="status-text">All systems operational</div>
                </div>
                <p style="font-size: 0.75rem; color: var(--text-muted);">Last checked: Just now</p>
            </div>

            <h2 class="section-title">Operational Hub</h2>
            <div class="right-panel-card" style="padding: 1.25rem; display: flex; flex-direction: column; gap: 1rem;">
                <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #E5E7EB; padding-bottom: 0.75rem;">
                    <div>
                        <h4 style="font-size: 0.85rem; font-weight: 700;">Database Engine</h4>
                        <span style="font-size: 0.75rem; color: var(--text-muted);">Active SQLite Connection</span>
                    </div>
                    <span style="font-size: 0.725rem; font-weight: 800; background: #ECFDF5; color: #047857; padding: 0.25rem 0.5rem; border-radius: 6px;">OK</span>
                </div>
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <h4 style="font-size: 0.85rem; font-weight: 700;">Admin Session</h4>
                        <span style="font-size: 0.75rem; color: var(--text-muted);">Authenticated Secure</span>
                    </div>
                    <span style="font-size: 0.725rem; font-weight: 800; background: #EEF2FF; color: #4F46E5; padding: 0.25rem 0.5rem; border-radius: 6px;">SECURE</span>
                </div>
            </div>
        </aside>
    </div>

    <!-- Responsive Tab Switches Script -->
    <script>
        function switchTab(tabId, btn) {
            // Hide all tab panes
            document.querySelectorAll('.tab-pane').forEach(pane => {
                pane.style.display = 'none';
            });
            
            // Show selected tab pane
            document.getElementById(`tab-content-${tabId}`).style.display = 'block';
            
            // Deactivate all sidebar nav buttons
            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('active');
            });
            
            // Activate current button
            btn.classList.add('active');
        }
    </script>
    
    @include('layouts.chatbot')
</body>
</html>
