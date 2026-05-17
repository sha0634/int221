<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Creator Dashboard - Folio.</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,600;1,600&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-body: #E5E9F2; /* Soft blue-gray background matching the image aesthetic */
            --bg-card: #ffffff;
            --text-dark: #111827;
            --text-muted: #6B7280;
            --primary: #111827;
            --accent: #E67E22;
            --gradient-1: linear-gradient(135deg, #4F46E5 0%, #3B82F6 100%);
            --gradient-2: linear-gradient(135deg, #E67E22 0%, #F59E0B 100%);
            --gradient-3: linear-gradient(135deg, #10B981 0%, #34D399 100%);
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
            padding-left: 1rem;
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
        }

        .nav-link:hover, .nav-link.active {
            color: var(--primary);
            background: #F9FAFB;
        }

        .nav-link svg {
            width: 20px;
            height: 20px;
        }

        .user-profile-card {
            background: #F9FAFB;
            border-radius: 16px;
            padding: 1rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-top: auto;
            border: 1px solid #E5E7EB;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--gradient-2);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .user-info h4 {
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .user-info span {
            font-size: 0.75rem;
            color: var(--accent);
            font-weight: 600;
            text-transform: uppercase;
        }

        /* MAIN CONTENT */
        .main-content {
            flex: 1;
            padding: 0;
            overflow-y: auto;
            background: #FAFBFC;
        }

        .main-content-inner {
            padding: 2rem;
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

        .header-actions {
            display: flex;
            gap: 1rem;
        }

        .icon-btn {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: #ffffff;
            border: 1px solid #E5E7EB;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-dark);
            cursor: pointer;
            transition: all 0.2s;
        }

        .icon-btn:hover {
            background: #F3F4F6;
        }

        /* Top Stats Row */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        .stat-card {
            border-radius: 16px;
            padding: 1.5rem;
            color: white;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .stat-card.blue { background: var(--gradient-1); }
        .stat-card.orange { background: var(--gradient-2); }
        .stat-card.green { background: var(--gradient-3); }

        .stat-card-title {
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.5rem;
            opacity: 0.9;
        }

        .stat-card-value {
            font-size: 2rem;
            font-weight: 700;
        }

        .stat-card-trend {
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .stat-icon {
            position: absolute;
            right: -10px;
            bottom: -10px;
            width: 80px;
            height: 80px;
            opacity: 0.2;
        }

        /* Section Headings */
        .section-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 1.25rem;
            color: var(--primary);
        }

        /* Middle Grid (Analytics & Profile Strength) */
        .middle-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        .bento-box {
            background: #ffffff;
            border-radius: 20px;
            padding: 1.5rem;
            border: 1px solid #E5E7EB;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
        }

        .analytics-chart-placeholder {
            height: 200px;
            display: flex;
            align-items: flex-end;
            gap: 10px;
            padding-top: 20px;
        }

        .bar {
            flex: 1;
            background: #E5E7EB;
            border-radius: 6px 6px 0 0;
            transition: height 0.3s ease;
        }
        .bar.active { background: #3B82F6; }

        .profile-strength-circle {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 12px solid #F3F4F6;
            border-top-color: var(--accent);
            border-right-color: var(--accent);
            margin: 0 auto 1.5rem auto;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 700;
            transform: rotate(-45deg);
        }
        .profile-strength-circle span {
            transform: rotate(45deg);
        }

        /* Inquiries Table */
        .inquiries-list {
            background: #ffffff;
            border-radius: 20px;
            border: 1px solid #E5E7EB;
            overflow: hidden;
        }

        .inquiry-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid #F3F4F6;
        }
        .inquiry-item:last-child { border-bottom: none; }

        .inquiry-client {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .client-avatar {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: #F3F4F6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: var(--text-muted);
        }

        .badge {
            padding: 0.25rem 0.75rem;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .badge-new { background: #DBEAFE; color: #1D4ED8; }
        .badge-ongoing { background: #FEF3C7; color: #B45309; }

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

        .right-panel-card h3 {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .balance-amount {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }
        .activity-item:last-child { margin-bottom: 0; }

        .activity-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: #E0E7FF;
            color: #4F46E5;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .tag-pill {
            display: inline-block;
            padding: 0.4rem 0.8rem;
            background: #F3F4F6;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 500;
            margin: 0.2rem;
            color: var(--text-dark);
        }

        /* Logout Form hidden styling */
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
                <a href="#" class="nav-link active" id="nav-summary" onclick="switchCreatorTab('summary')">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Summary
                </a>
                <a href="#" class="nav-link" id="nav-contracts" onclick="switchCreatorTab('contracts')">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Contracts & Billing
                </a>
                <a href="{{ route('creator.analytics') }}" class="nav-link">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    Analytics
                </a>
                <a href="{{ route('creator.inquiries.index') }}" class="nav-link">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                    Inquiries
                </a>
                <a href="{{ route('creator.portfolio.index') }}" class="nav-link">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    Portfolio
                </a>
                <a href="#" class="nav-link" onclick="document.getElementById('logout-form').submit(); return false;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Sign Out
                </a>
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
            <!-- Flash success/error alerts -->
            @if(session('success'))
                <div style="margin: 2rem 2rem 0; padding: 1rem 1.5rem; background: #ECFDF5; border: 1px solid #A7F3D0; color: #065F46; border-radius: 12px; font-weight: 600; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem;">
                    <span>✅</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div id="tab-content-summary" class="main-content-inner tab-pane">
            <div class="header">
                <h1>Creator Dashboard</h1>
                <div class="header-actions">
                    <button class="icon-btn"><svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg></button>
                    <button class="icon-btn"><svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg></button>
                </div>
            </div>

            <div class="stats-grid">
                <div class="stat-card blue">
                    <div class="stat-card-title">Profile Views</div>
                    <div class="stat-card-value">{{ number_format($totalViews) }}</div>
                    <div class="stat-card-trend">{{ $viewsTrend }} this week</div>
                    <svg class="stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                </div>
                <div class="stat-card orange">
                    <div class="stat-card-title">Search Appearances</div>
                    <div class="stat-card-value">{{ number_format($searchAppearances) }}</div>
                    <div class="stat-card-trend">↑ 100% active</div>
                    <svg class="stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <div class="stat-card green">
                    <div class="stat-card-title">Inquiry Conversion</div>
                    <div class="stat-card-value">{{ $inquiryConversion }}%</div>
                    <div class="stat-card-trend">Replies active</div>
                    <svg class="stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path></svg>
                </div>
            </div>

            <div class="middle-grid">
                <div class="bento-box">
                    <h2 class="section-title">Traffic Overview</h2>
                    <p style="color: var(--text-muted); font-size: 0.875rem; margin-bottom: 1rem;">See how your portfolio traffic grows over the week.</p>
                    <div class="analytics-chart-placeholder">
                        @php
                            $maxVal = max(1, collect($viewsByDay)->pluck('count')->max());
                        @endphp
                        @foreach($viewsByDay as $dayData)
                            <div class="bar" style="height: {{ max(6, round(($dayData['count'] / $maxVal) * 100)) }}%;" title="{{ $dayData['count'] }} views on {{ $dayData['day'] }}"></div>
                        @endforeach
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-top: 10px; font-size: 0.75rem; color: var(--text-muted);">
                        @foreach($viewsByDay as $dayData)
                            <span style="flex: 1; text-align: center;">{{ $dayData['day'] }}</span>
                        @endforeach
                    </div>
                </div>

                <div class="bento-box" style="text-align: center;">
                    <h2 class="section-title">Profile Strength</h2>
                    <div class="profile-strength-circle">
                        <span>{{ $profileStrength }}%</span>
                    </div>
                    @if($profileStrength === 100)
                        <p style="font-size: 0.875rem; font-weight: 600; margin-bottom: 0.5rem;">Maximum Strength!</p>
                        <p style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 1rem;">Your portfolio is 100% complete and fully optimized.</p>
                    @else
                        <p style="font-size: 0.875rem; font-weight: 600; margin-bottom: 0.5rem;">Almost there!</p>
                        <p style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 1rem;">Complete all sections to achieve maximum strength.</p>
                    @endif
                    <a href="{{ route('creator.portfolio.index') }}" style="display: inline-block; background: var(--bg-body); color: var(--primary); text-decoration: none; border: none; padding: 0.5rem 1rem; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 0.875rem;">Manage Portfolio</a>
                </div>
            </div>

            <h2 class="section-title">Active Inquiries</h2>
            <div class="inquiries-list">
                @forelse($inquiries as $inquiry)
                    <a href="{{ route('creator.inquiries.show', $inquiry->id) }}" style="text-decoration: none; color: inherit; display: block;">
                        <div class="inquiry-item" style="transition: background 0.2s;" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='none';">
                            <div class="inquiry-client">
                                <div class="client-avatar">{{ substr($inquiry->client_name, 0, 2) }}</div>
                                <div>
                                    <h4 style="font-size: 0.9rem; font-weight: 600;">{{ $inquiry->client_name }}</h4>
                                    <p style="font-size: 0.8rem; color: var(--text-muted);">{{ $inquiry->subject }}</p>
                                </div>
                            </div>
                            <div style="font-size: 0.875rem; color: var(--text-muted);">{{ $inquiry->created_at->format('M d, Y') }}</div>
                            @if($inquiry->status === 'new')
                                <span class="badge badge-new">New Message</span>
                            @else
                                <span class="badge badge-ongoing" style="background: #E6FDF5; color: #10B981;">Replied</span>
                            @endif
                        </div>
                    </a>
                @empty
                    <div style="text-align: center; padding: 2.5rem 1rem; color: var(--text-muted); font-size: 0.9rem;">
                        No active inquiries found.
                    </div>
                @endforelse
            </div>
            </div>
            
            <!-- Contracts Tab Content -->
            <div id="tab-content-contracts" class="main-content-inner tab-pane" style="display: none;">
                <div class="header">
                    <h1>Contracts & Client Billing</h1>
                    <p style="color: var(--text-muted); font-size: 0.95rem; margin-top: 0.25rem;">Review client-drafted agreements, authorize work scopes, and generate milestone invoices.</p>
                </div>

                <div style="background: white; border-radius: 20px; border: 1px solid #E5E7EB; padding: 2.25rem; margin-top: 1.5rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);">
                    <h2 class="section-title" style="margin-top: 0; margin-bottom: 1.25rem;">Active & Pending Agreements</h2>
                    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                        @forelse($contracts as $contract)
                            <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #F3F4F6; padding-bottom: 1.5rem; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1.5rem;">
                                <div style="display: flex; align-items: center; gap: 1.25rem; min-width: 280px; flex: 1;">
                                    <div style="width: 56px; height: 56px; border-radius: 14px; background: #EEF2F6; color: var(--accent); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1.5rem; flex-shrink: 0; border: 1.5px solid #E2E8F0;">
                                        📄
                                    </div>
                                    <div>
                                        <h3 style="font-size: 1.15rem; font-weight: 700; color: var(--text-dark); margin-bottom: 0.25rem;">{{ $contract->title }}</h3>
                                        <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 0.4rem; line-height: 1.3;">{{ $contract->description ?? 'No extra scope description provided.' }}</p>
                                        <div style="display: flex; gap: 0.5rem; align-items: center;">
                                            <span style="font-size: 0.725rem; background: #DBEAFE; color: #1E40AF; padding: 0.2rem 0.5rem; border-radius: 6px; font-weight: 700;">
                                                Client: {{ $contract->client_email }}
                                            </span>
                                            <span style="font-size: 0.725rem; background: #F3F4F6; color: #374151; padding: 0.2rem 0.5rem; border-radius: 6px; font-weight: 700;">
                                                Ref ID: #CON-{{ str_pad($contract->id, 4, '0', STR_PAD_LEFT) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Budget -->
                                <div style="min-width: 140px;">
                                    <div style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted); margin-bottom: 0.15rem;">Contract Value</div>
                                    <div style="font-size: 1.25rem; font-weight: 900; color: var(--accent);">${{ number_format($contract->amount, 2) }}</div>
                                </div>

                                <!-- Status Badge -->
                                <div style="min-width: 130px;">
                                    @if($contract->status === 'active')
                                        <span style="display: inline-flex; align-items: center; gap: 0.35rem; font-size: 0.8rem; background: #ECFDF5; color: #065F46; padding: 0.35rem 0.75rem; border-radius: 9999px; font-weight: 700; border: 1px solid #A7F3D0;">
                                            <span style="width: 8px; height: 8px; border-radius: 50%; background: #10B981;"></span>
                                            Signed & Active
                                        </span>
                                    @elseif($contract->status === 'pending')
                                        <span style="display: inline-flex; align-items: center; gap: 0.35rem; font-size: 0.8rem; background: #FFFBEB; color: #92400E; padding: 0.35rem 0.75rem; border-radius: 9999px; font-weight: 700; border: 1px solid #FDE68A;">
                                            <span style="width: 8px; height: 8px; border-radius: 50%; background: #F59E0B;"></span>
                                            Awaiting Signature
                                        </span>
                                    @else
                                        <span style="display: inline-flex; align-items: center; gap: 0.35rem; font-size: 0.8rem; background: #F3F4F6; color: #374151; padding: 0.35rem 0.75rem; border-radius: 9999px; font-weight: 700;">
                                            {{ ucfirst($contract->status) }}
                                        </span>
                                    @endif
                                </div>

                                <!-- Actions -->
                                <div style="display: flex; gap: 0.75rem; align-items: center;">
                                    @if($contract->status === 'pending')
                                        <button class="btn-primary-full" style="width: auto; background: var(--accent); padding: 0.65rem 1.25rem; font-size: 0.85rem; border-radius: 10px; border: none; color: white; font-weight: 700; cursor: pointer; display: flex; align-items: center; gap: 0.4rem;" onclick="openCreatorSignatureModal({{ $contract->id }}, '{{ addslashes($contract->title) }}', '{{ number_format($contract->amount, 2) }}')">
                                            Sign Contract 🖋️
                                        </button>
                                    @elseif($contract->status === 'active')
                                        <button class="btn-primary-full" style="width: auto; background: #10B981; padding: 0.65rem 1.25rem; font-size: 0.85rem; border-radius: 10px; border: none; color: white; font-weight: 700; cursor: pointer; display: flex; align-items: center; gap: 0.4rem;" onclick="openInvoiceGenerationModal({{ $contract->id }}, '{{ addslashes($contract->title) }}')">
                                            Request Payment 💵
                                        </button>
                                    @else
                                        <button class="icon-btn" style="width: auto; padding: 0.65rem 1rem; font-size: 0.85rem; border-radius: 10px; background: #F9FAFB; border: 1.5px solid #E2E8F0;" onclick="alert('Downloading contract copy...')">
                                            View Copy
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div style="background: white; border-radius: 16px; border: 1px dashed #D1D5DB; padding: 4rem; text-align: center; color: var(--text-muted); margin: 1rem 0;">
                                <svg style="width: 56px; height: 56px; margin: 0 auto 1.25rem; opacity: 0.5;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                <p style="font-weight: 700; font-size: 1.1rem; color: var(--text-dark); margin-bottom: 0.35rem;">No Active Agreements</p>
                                <p style="font-size: 0.9rem;">Once clients draft custom contracts for your portfolio, they will appear here for your signature.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div style="background: white; border-radius: 20px; border: 1px solid #E5E7EB; padding: 2.25rem; margin-top: 2rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);">
                    <h2 class="section-title" style="margin-top: 0; margin-bottom: 1.25rem;">Milestone Invoice Statements</h2>
                    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                        @forelse($invoices as $invoice)
                            <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #F3F4F6; padding-bottom: 1.5rem; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1.5rem;">
                                <div style="display: flex; align-items: center; gap: 1.25rem; min-width: 260px; flex: 1;">
                                    <div style="width: 56px; height: 56px; border-radius: 14px; background: #F8FAFC; color: #64748B; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1.5rem; flex-shrink: 0; border: 1.5px solid #E2E8F0;">
                                        💵
                                    </div>
                                    <div>
                                        <h3 style="font-size: 1.15rem; font-weight: 700; color: var(--text-dark); margin-bottom: 0.25rem;">{{ $invoice->title }}</h3>
                                        <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 0.4rem; line-height: 1.3;">Milestone Deliverable &bull; Sent to {{ $invoice->client_email }}</p>
                                        <div style="display: flex; gap: 0.5rem; align-items: center;">
                                            <span style="font-size: 0.725rem; background: #F1F5F9; color: #475569; padding: 0.2rem 0.5rem; border-radius: 6px; font-weight: 700;">
                                                Inv ID: #INV-{{ str_pad($invoice->id, 5, '0', STR_PAD_LEFT) }}
                                            </span>
                                            @if($invoice->contract)
                                                <span style="font-size: 0.725rem; background: #EEF2F6; color: var(--accent); padding: 0.2rem 0.5rem; border-radius: 6px; font-weight: 700;">
                                                    Contract: #CON-{{ str_pad($invoice->contract->id, 4, '0', STR_PAD_LEFT) }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Amount -->
                                <div style="min-width: 140px;">
                                    <div style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted); margin-bottom: 0.15rem;">Invoice Amount</div>
                                    <div style="font-size: 1.25rem; font-weight: 900; color: var(--primary);">${{ number_format($invoice->amount, 2) }}</div>
                                </div>

                                <!-- Status Badge -->
                                <div style="min-width: 130px;">
                                    @if($invoice->status === 'paid')
                                        <span style="display: inline-flex; align-items: center; gap: 0.35rem; font-size: 0.8rem; background: #ECFDF5; color: #065F46; padding: 0.35rem 0.75rem; border-radius: 9999px; font-weight: 700; border: 1px solid #A7F3D0;">
                                            Settled & Paid
                                        </span>
                                    @else
                                        <span style="display: inline-flex; align-items: center; gap: 0.35rem; font-size: 0.8rem; background: #FFFBEB; color: #92400E; padding: 0.35rem 0.75rem; border-radius: 9999px; font-weight: 700; border: 1px solid #FDE68A;">
                                            Awaiting Payment
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div style="background: white; border-radius: 16px; border: 1px dashed #D1D5DB; padding: 4rem; text-align: center; color: var(--text-muted); margin: 1rem 0;">
                                <svg style="width: 56px; height: 56px; margin: 0 auto 1.25rem; opacity: 0.5;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                <p style="font-weight: 700; font-size: 1.1rem; color: var(--text-dark); margin-bottom: 0.35rem;">No Invoices Dispatched</p>
                                <p style="font-size: 0.9rem;">Once you sign an active contract, you can generate payment requests / invoices for completed milestones here.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </main>

        <!-- Right Panel (Quick Hub) -->
        <aside class="right-panel">
            <h2 class="section-title">Quick Hub</h2>
            
            <div class="right-panel-card">
                <h3>Portfolio Summary</h3>
                <div class="balance-amount">{{ $projectsCount }}</div>
                <p style="font-size: 0.875rem; color: var(--text-muted); margin-bottom: 1rem;">Active projects uploaded</p>
                <a href="{{ route('creator.portfolio.index') }}" style="display: block; width: 100%; text-align: center; text-decoration: none; padding: 0.75rem; background: var(--primary); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">Manage Work</a>
            </div>

            <div class="right-panel-card">
                <h3>Tagged Skills</h3>
                <div style="margin-top: 1rem; display: flex; flex-wrap: wrap; gap: 0.5rem;">
                    @foreach($skills as $skill)
                        <span class="tag-pill" style="margin: 0;">{{ $skill }}</span>
                    @endforeach
                </div>
            </div>

            <div class="right-panel-card" style="background: transparent; border: none; padding: 0;">
                <h3 style="margin-bottom: 1rem;">Testimonial Tracker</h3>
                <div class="activity-item">
                    <div class="activity-icon"><svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg></div>
                    <div>
                        <h4 style="font-size: 0.875rem;">5 Published</h4>
                        <p style="font-size: 0.75rem; color: var(--text-muted);">On your live portfolio</p>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon" style="background: #FEF3C7; color: #B45309;"><svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                    <div>
                        <h4 style="font-size: 0.875rem;">2 Pending</h4>
                        <p style="font-size: 0.75rem; color: var(--text-muted);">Requests sent to clients</p>
                    </div>
                </div>
            </div>
        </aside>
    </div>

    <!-- Creator Signature Modal -->
    <div id="creator-signature-modal" style="display: none; position: fixed; inset: 0; background: rgba(0, 0, 0, 0.45); z-index: 9999; backdrop-filter: blur(4px); align-items: center; justify-content: center; padding: 1.5rem;">
        <div style="background: white; width: 100%; max-width: 520px; border-radius: 20px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.2); border: 1px solid #E5E7EB; overflow: hidden;">
            <div style="padding: 1.5rem; border-bottom: 1px solid #F3F4F6; display: flex; justify-content: space-between; align-items: center; background: #FAFBFC;">
                <h3 style="font-size: 1.15rem; font-weight: 700; color: var(--text-dark);">Review & Sign Client Contract</h3>
                <button onclick="closeCreatorSignatureModal()" style="border: none; background: transparent; font-size: 1.75rem; cursor: pointer; color: var(--text-muted); font-weight: 400; line-height: 1; transition: color 0.2s;" onmouseover="this.style.color='#000'" onmouseout="this.style.color='var(--text-muted)'">&times;</button>
            </div>
            <form id="creator-signature-form" method="POST" style="margin: 0;">
                @csrf
                <div style="padding: 1.5rem;">
                    <div style="margin-bottom: 1.25rem;">
                        <span style="font-size: 0.8rem; text-transform: uppercase; color: var(--text-muted); font-weight: 700;">Agreement Scope Title</span>
                        <h4 id="cre-contract-title" style="font-size: 1.1rem; font-weight: 700; color: var(--text-dark); margin-top: 0.15rem;">UX/UI Design Retainer Contract</h4>
                    </div>
                    <div style="margin-bottom: 1.5rem; background: #F8FAFC; border: 1.5px solid #E2E8F0; padding: 1rem; border-radius: 12px;">
                        <span style="font-size: 0.8rem; text-transform: uppercase; color: var(--text-muted); font-weight: 700;">Financial Scope</span>
                        <div id="cre-contract-amount" style="font-size: 1.5rem; font-weight: 900; color: var(--accent); margin-top: 0.25rem;">$2,500.00 USD</div>
                    </div>
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; font-size: 0.85rem; font-weight: 700; color: var(--text-dark); margin-bottom: 0.5rem;">Draw or Type Your Professional Signature</label>
                        <div style="border: 2px dashed #CBD5E1; border-radius: 12px; background: #FAFBFC; padding: 1rem; display: flex; align-items: center; justify-content: center; color: var(--text-muted); font-size: 0.9rem; font-style: italic; position: relative;">
                            <input type="text" placeholder="Type name to sign (e.g. {{ Auth::user()->name }})" required style="width: 100%; max-width: 320px; background: white; border: 1.5px solid #CBD5E1; border-radius: 8px; padding: 0.5rem 0.75rem; text-align: center; font-size: 1.1rem; font-family: 'Playfair Display', serif;" />
                        </div>
                    </div>
                    <p style="font-size: 0.75rem; color: var(--text-muted); line-height: 1.3;">By clicking the button below, you confirm that you accept all scope descriptions, deliverables deadlines, and financial structures defined within this creative agreement.</p>
                </div>
                <div style="padding: 1.5rem; border-top: 1px solid #F3F4F6; background: #FAFBFC; display: flex; justify-content: flex-end; gap: 0.75rem;">
                    <button type="button" class="icon-btn" style="width: auto; background: white; padding: 0.65rem 1rem; border: 1.5px solid #E2E8F0;" onclick="closeCreatorSignatureModal()">Cancel</button>
                    <button type="submit" class="btn-primary-full" style="width: auto; background: var(--accent); padding: 0.65rem 1.5rem; border: none; color: white; font-weight: 700; cursor: pointer;">Sign Agreement</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Generate Milestone Invoice Modal -->
    <div id="invoice-generation-modal" style="display: none; position: fixed; inset: 0; background: rgba(0, 0, 0, 0.45); z-index: 9999; backdrop-filter: blur(4px); align-items: center; justify-content: center; padding: 1.5rem;">
        <div style="background: white; width: 100%; max-width: 520px; border-radius: 20px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.2); border: 1px solid #E5E7EB; overflow: hidden;">
            <div style="padding: 1.5rem; border-bottom: 1px solid #F3F4F6; display: flex; justify-content: space-between; align-items: center; background: #FAFBFC;">
                <h3 style="font-size: 1.15rem; font-weight: 700; color: var(--text-dark); display: flex; align-items: center; gap: 0.5rem;">
                    <span>Request Milestone Payment</span>
                    <span>💵</span>
                </h3>
                <button onclick="closeInvoiceGenerationModal()" style="border: none; background: transparent; font-size: 1.75rem; cursor: pointer; color: var(--text-muted); font-weight: 400; line-height: 1; transition: color 0.2s;" onmouseover="this.style.color='#000'" onmouseout="this.style.color='var(--text-muted)'">&times;</button>
            </div>
            <form action="{{ route('creator.invoices.store') }}" method="POST" style="margin: 0;">
                @csrf
                <input type="hidden" name="contract_id" id="inv-contract-id" />
                <div style="padding: 1.5rem; display: flex; flex-direction: column; gap: 1rem;">
                    <div>
                        <span style="font-size: 0.8rem; text-transform: uppercase; color: var(--text-muted); font-weight: 700;">Reference Agreement</span>
                        <h4 id="inv-contract-title" style="font-size: 1.05rem; font-weight: 700; color: var(--text-dark); margin-top: 0.15rem;">Web Design Retainer</h4>
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.85rem; font-weight: 700; color: var(--text-dark); margin-bottom: 0.35rem;">Milestone Invoice Title</label>
                        <input type="text" name="title" placeholder="e.g. Milestone 1 - Homepage Concepts Complete" required style="width: 100%; border: 1.5px solid #CBD5E1; border-radius: 10px; padding: 0.65rem 0.85rem; font-size: 0.875rem;" />
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.85rem; font-weight: 700; color: var(--text-dark); margin-bottom: 0.35rem;">Requested Amount ($ USD)</label>
                        <input type="number" name="amount" step="0.01" min="0" placeholder="e.g. 1500.00" required style="width: 100%; border: 1.5px solid #CBD5E1; border-radius: 10px; padding: 0.65rem 0.85rem; font-size: 0.875rem;" />
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.85rem; font-weight: 700; color: var(--text-dark); margin-bottom: 0.35rem;">Milestone Due Date</label>
                        <input type="date" name="due_date" required style="width: 100%; border: 1.5px solid #CBD5E1; border-radius: 10px; padding: 0.65rem 0.85rem; font-size: 0.875rem;" />
                    </div>
                    <p style="font-size: 0.75rem; color: var(--text-muted); line-height: 1.35;">Once generated, this milestone invoice will instantly be routed to the client's dashboard where they can pay and settle the balance securely via Stripe.</p>
                </div>
                <div style="padding: 1.5rem; border-top: 1px solid #F3F4F6; background: #FAFBFC; display: flex; justify-content: flex-end; gap: 0.75rem;">
                    <button type="button" class="icon-btn" style="width: auto; background: white; padding: 0.65rem 1rem; border: 1.5px solid #E2E8F0;" onclick="closeInvoiceGenerationModal()">Cancel</button>
                    <button type="submit" class="btn-primary-full" style="width: auto; background: var(--primary); padding: 0.65rem 1.5rem; border: none; color: white; font-weight: 700; cursor: pointer;">Submit Request</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function switchCreatorTab(tabName) {
            // Hide all tab panes
            document.querySelectorAll('.tab-pane').forEach(pane => {
                pane.style.display = 'none';
            });
            
            // Show target tab pane
            if (tabName === 'summary') {
                document.getElementById('tab-content-summary').style.display = 'block';
            } else if (tabName === 'contracts') {
                document.getElementById('tab-content-contracts').style.display = 'block';
            }
            
            // Update active sidebar nav styling
            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('active');
            });
            
            if (tabName === 'summary') {
                document.getElementById('nav-summary').classList.add('active');
            } else if (tabName === 'contracts') {
                document.getElementById('nav-contracts').classList.add('active');
            }
        }

        // Creator Signature Modal Controllers
        function openCreatorSignatureModal(contractId, title, amount) {
            document.getElementById('creator-signature-form').action = `/creator/contracts/${contractId}/sign`;
            document.getElementById('cre-contract-title').innerText = title;
            document.getElementById('cre-contract-amount').innerText = '$' + amount + ' USD';
            document.getElementById('creator-signature-modal').style.display = 'flex';
        }
        
        function closeCreatorSignatureModal() {
            document.getElementById('creator-signature-modal').style.display = 'none';
        }

        // Invoice Generation Modal Controllers
        function openInvoiceGenerationModal(contractId, title) {
            document.getElementById('inv-contract-id').value = contractId;
            document.getElementById('inv-contract-title').innerText = title;
            document.getElementById('invoice-generation-modal').style.display = 'flex';
        }

        function closeInvoiceGenerationModal() {
            document.getElementById('invoice-generation-modal').style.display = 'none';
        }

        // Close on click outside
        document.getElementById('creator-signature-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeCreatorSignatureModal();
            }
        });

        document.getElementById('invoice-generation-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeInvoiceGenerationModal();
            }
        });
    </script>
    
    @include('layouts.chatbot')
</body>
</html>
