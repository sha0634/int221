<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Client Dashboard - Folio.</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,600;1,600&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-body: #E5E9F2;
            --bg-card: #ffffff;
            --text-dark: #111827;
            --text-muted: #6B7280;
            --primary: #111827;
            --accent: #E67E22;
            --gradient-1: linear-gradient(135deg, #1D4ED8 0%, #60A5FA 100%);
            --gradient-2: linear-gradient(135deg, #047857 0%, #34D399 100%);
            --gradient-3: linear-gradient(135deg, #7C3AED 0%, #A78BFA 100%);
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
            background: var(--gradient-1);
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
        .stat-card.green { background: var(--gradient-2); }
        .stat-card.purple { background: var(--gradient-3); }

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

        /* Creators Grid */
        .creators-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        .creator-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 1.5rem;
            border: 1px solid #E5E7EB;
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: all 0.2s ease;
        }

        .creator-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
        }

        .creator-avatar {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            background: #F3F4F6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: var(--text-muted);
            font-size: 1.5rem;
        }

        .creator-info { flex: 1; }
        .creator-info h4 { font-size: 1rem; font-weight: 700; margin-bottom: 0.25rem; }
        .creator-info p { font-size: 0.875rem; color: var(--text-muted); margin-bottom: 0.5rem; }
        
        .status-dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #10B981;
            margin-right: 0.5rem;
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

        .btn-primary-full {
            width: 100%;
            padding: 1rem;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.2s ease;
        }
        .btn-primary-full:hover { background: #000000; }

        .message-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid #E5E7EB;
        }
        .message-item:last-child { border-bottom: none; padding-bottom: 0; }

        .msg-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #DBEAFE;
            color: #1D4ED8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 700;
            flex-shrink: 0;
        }

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
                <a href="#" class="nav-link active" onclick="switchTab('dashboard', this); return false;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Dashboard
                </a>
                <a href="#" class="nav-link" onclick="switchTab('discover', this); return false;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    Discover Network
                </a>
                <a href="#" class="nav-link" onclick="switchTab('my-creators', this); return false;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    My Creators
                </a>
                <a href="#" class="nav-link" onclick="switchTab('contracts', this); return false;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Contracts
                </a>
                <a href="#" class="nav-link" onclick="switchTab('billing', this); return false;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    Billing
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
            <div class="main-content-inner">
                
                <!-- TAB 1: Dashboard Overview -->
                <div id="tab-content-dashboard" class="tab-pane">
                    <div class="header">
                        <h1>Client Dashboard</h1>
                        <div class="header-actions">
                            <button class="icon-btn"><svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg></button>
                        </div>
                    </div>

                    @if(session('success'))
                        <div style="background: #ECFDF5; border: 1.5px solid #10B981; color: #065F46; padding: 1.25rem 1.5rem; border-radius: 14px; margin-bottom: 2rem; font-weight: 600; display: flex; align-items: center; gap: 0.75rem; box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.1);">
                            <span style="font-size: 1.25rem;">✓</span>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="stats-grid">
                        <div class="stat-card blue">
                            <div class="stat-card-title">Inquiries Sent</div>
                            <div class="stat-card-value">{{ $totalInquiries }}</div>
                            <svg class="stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <div class="stat-card green">
                            <div class="stat-card-title">Creators Contacted</div>
                            <div class="stat-card-value">{{ $creatorsCount }}</div>
                            <svg class="stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <div class="stat-card purple">
                            <div class="stat-card-title">Replies Received</div>
                            <div class="stat-card-value">{{ $repliesCount }}</div>
                            <svg class="stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                    </div>

                    <h2 class="section-title">My Creators</h2>
                    <div class="creators-grid">
                        @forelse($creators as $creator)
                            <div class="creator-card" style="cursor: pointer; position: relative;" onclick="window.location.href='{{ route('portfolio.show', $creator->slug) }}'">
                                <div class="creator-avatar" style="background: var(--primary); color: white; font-weight: 700;">
                                    {{ strtoupper(substr($creator->title ?? $creator->user->name ?? 'CR', 0, 2)) }}
                                </div>
                                <div class="creator-info">
                                    <h4>{{ $creator->title ?? $creator->user->name }}</h4>
                                    <p style="margin-bottom: 0.25rem;">{{ Str::limit($creator->bio ?? 'Creative Professional', 40) }}</p>
                                    <span style="font-size: 0.75rem; font-weight: 600;">
                                        @php
                                            $latestInq = $inquiries->where('portfolio_id', $creator->id)->first();
                                            $creatorStatus = $latestInq ? $latestInq->status : 'new';
                                        @endphp
                                        @if($creatorStatus === 'replied')
                                            <span class="status-dot" style="background: #10B981;"></span>Replied &bull; Click to View
                                        @else
                                            <span class="status-dot" style="background: #3B82F6;"></span>Sent &bull; Click to View
                                        @endif
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div style="grid-column: span 2; background: white; border-radius: 16px; border: 1px dashed #D1D5DB; padding: 3rem; text-align: center; color: var(--text-muted);">
                                <svg style="width: 48px; height: 48px; margin: 0 auto 1rem; opacity: 0.5;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                <p style="font-weight: 600; font-size: 1rem; color: var(--text-dark); margin-bottom: 0.25rem;">No Creators Contacted Yet</p>
                                <p style="font-size: 0.875rem;">Your contacted creator connections will appear here.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- TAB 2: Dedicated My Creators Directory -->
                <div id="tab-content-my-creators" class="tab-pane" style="display: none;">
                    <div class="header">
                        <h1>My Collaborating Creators</h1>
                        <p style="color: var(--text-muted); font-size: 0.95rem; margin-top: 0.25rem;">Explore, communicate, and manage your partnerships with active creators in the network.</p>
                    </div>

                    <div style="background: white; border-radius: 20px; border: 1px solid #E5E7EB; padding: 2.25rem; margin-top: 1.5rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                            @forelse($creators as $creator)
                                <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #F3F4F6; padding-bottom: 1.5rem; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1.5rem; transition: all 0.2s;" onmouseover="this.style.borderColor='var(--accent)'" onmouseout="this.style.borderColor='#F3F4F6'">
                                    <div style="display: flex; align-items: center; gap: 1.25rem; min-width: 250px;">
                                        <div style="width: 56px; height: 56px; border-radius: 14px; background: var(--primary); color: white; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1.25rem; flex-shrink: 0; box-shadow: 0 4px 12px -2px rgba(17, 24, 39, 0.15);">
                                            {{ strtoupper(substr($creator->title ?? $creator->user->name ?? 'CR', 0, 2)) }}
                                        </div>
                                        <div>
                                            <h3 style="font-size: 1.15rem; font-weight: 700; color: var(--text-dark); margin-bottom: 0.25rem;">{{ $creator->title ?? $creator->user->name }}</h3>
                                            <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 0.4rem; line-height: 1.3;">{{ $creator->bio ?? 'Creative Partner' }}</p>
                                            <span style="font-size: 0.725rem; background: #EEF2F6; color: #475569; padding: 0.2rem 0.5rem; border-radius: 6px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.02em;">
                                                Theme: {{ ucfirst($creator->template_name) }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Middle: Collaborating Status & Inquiry Info -->
                                    <div style="min-width: 200px;">
                                        @php
                                            $collabInquiries = $inquiries->where('portfolio_id', $creator->id);
                                            $collabCount = $collabInquiries->count();
                                            $collabLatest = $collabInquiries->first();
                                        @endphp
                                        <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.35rem;">
                                            <span class="status-dot" style="background: #10B981; width: 10px; height: 10px; margin-right: 0;"></span>
                                            <span style="font-size: 0.9rem; font-weight: 700; color: var(--text-dark);">Active Collaboration</span>
                                        </div>
                                        <p style="font-size: 0.8rem; color: var(--text-muted);">{{ $collabCount }} Inquiry threads sent &bull; Last updated {{ $collabLatest ? $collabLatest->updated_at->diffForHumans() : 'N/A' }}</p>
                                    </div>

                                    <!-- Right: Action Buttons -->
                                    <div style="display: flex; gap: 0.75rem; align-items: center;">
                                        @if($collabLatest)
                                            <button class="btn-primary-full" style="width: auto; background: var(--primary); padding: 0.65rem 1.25rem; font-size: 0.85rem; display: flex; align-items: center; gap: 0.4rem; border-radius: 10px;" onclick="openConversation({{ $collabLatest->id }})">
                                                <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                                Chat Thread
                                            </button>
                                        @endif
                                        <a href="{{ route('portfolio.show', $creator->slug) }}" class="icon-btn" style="width: auto; padding: 0.65rem 1rem; font-size: 0.85rem; text-decoration: none; display: flex; align-items: center; gap: 0.4rem; border-radius: 10px; border: 1.5px solid #E2E8F0; background: white;" target="_blank">
                                            View Portfolio
                                            <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <div style="background: white; border-radius: 16px; border: 1px dashed #D1D5DB; padding: 4rem; text-align: center; color: var(--text-muted); margin: 1rem 0;">
                                    <svg style="width: 56px; height: 56px; margin: 0 auto 1.25rem; opacity: 0.5;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                    <p style="font-weight: 700; font-size: 1.1rem; color: var(--text-dark); margin-bottom: 0.35rem;">No Active Creators Found</p>
                                    <p style="font-size: 0.9rem;">Start collaborating by searching and sending inquiries to creators in our network.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- TAB 3: Contracts Directory -->
                <div id="tab-content-contracts" class="tab-pane" style="display: none;">
                    <div class="header">
                        <h1>Client Contracts</h1>
                        <p style="color: var(--text-muted); font-size: 0.95rem; margin-top: 0.25rem;">Manage ongoing project scopes, sign proposals, and track agreements with active creators.</p>
                    </div>

                    <div style="background: white; border-radius: 20px; border: 1px solid #E5E7EB; padding: 2.25rem; margin-top: 1.5rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                            @forelse($contracts as $contract)
                                <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #F3F4F6; padding-bottom: 1.5rem; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1.5rem;">
                                    <div style="display: flex; align-items: center; gap: 1.25rem; min-width: 280px; flex: 1;">
                                        <div style="width: 56px; height: 56px; border-radius: 14px; background: #EEF2F6; color: var(--primary); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1.5rem; flex-shrink: 0; border: 1.5px solid #E2E8F0;">
                                            📄
                                        </div>
                                        <div>
                                            <h3 style="font-size: 1.15rem; font-weight: 700; color: var(--text-dark); margin-bottom: 0.25rem;">{{ $contract->title }}</h3>
                                            <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 0.4rem; line-height: 1.3;">{{ $contract->description ?? 'No extra scope description provided.' }}</p>
                                            <div style="display: flex; gap: 0.5rem; align-items: center;">
                                                <span style="font-size: 0.725rem; background: #DBEAFE; color: #1E40AF; padding: 0.2rem 0.5rem; border-radius: 6px; font-weight: 700;">
                                                    Creator: {{ $contract->portfolio->title ?? 'Platform Creator' }}
                                                </span>
                                                <span style="font-size: 0.725rem; background: #F3F4F6; color: #374151; padding: 0.2rem 0.5rem; border-radius: 6px; font-weight: 700;">
                                                    Ref ID: #CON-{{ str_pad($contract->id, 4, '0', STR_PAD_LEFT) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Contract Budget & Amount -->
                                    <div style="min-width: 140px;">
                                        <div style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted); margin-bottom: 0.15rem;">Contract Value</div>
                                        <div style="font-size: 1.25rem; font-weight: 900; color: var(--primary);">${{ number_format($contract->amount, 2) }}</div>
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

                                    <!-- Contract Action Buttons -->
                                    <div style="display: flex; gap: 0.75rem; align-items: center;">
                                        @if($contract->status === 'pending')
                                            <button class="btn-primary-full" style="width: auto; background: var(--accent); padding: 0.65rem 1.25rem; font-size: 0.85rem; border-radius: 10px; display: flex; align-items: center; gap: 0.4rem;" onclick="openSignatureModal({{ $contract->id }}, '{{ addslashes($contract->title) }}', '{{ number_format($contract->amount, 2) }}')">
                                                Review & Sign
                                            </button>
                                        @else
                                            <button class="icon-btn" style="width: auto; padding: 0.65rem 1rem; font-size: 0.85rem; border-radius: 10px; background: #F9FAFB; border: 1.5px solid #E2E8F0;" onclick="alert('Downloading contract PDF...')">
                                                Download PDF
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div style="background: white; border-radius: 16px; border: 1px dashed #D1D5DB; padding: 4rem; text-align: center; color: var(--text-muted); margin: 1rem 0;">
                                    <svg style="width: 56px; height: 56px; margin: 0 auto 1.25rem; opacity: 0.5;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    <p style="font-weight: 700; font-size: 1.1rem; color: var(--text-dark); margin-bottom: 0.35rem;">No Contracts Drafted Yet</p>
                                    <p style="font-size: 0.9rem;">Once your creative partner sets up a custom scope agreement, it will appear here for your signature.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- TAB 4: Billing Directory -->
                <div id="tab-content-billing" class="tab-pane" style="display: none;">
                    <div class="header">
                        <h1>Billing & Invoices</h1>
                        <p style="color: var(--text-muted); font-size: 0.95rem; margin-top: 0.25rem;">Track, manage, and process payments securely for active milestones and completed deliverables.</p>
                    </div>

                    <!-- Billing Metrics Grid -->
                    @php
                        $totalBilled = $invoices->sum('amount');
                        $totalPaid = $invoices->where('status', 'paid')->sum('amount');
                        $totalUnpaid = $invoices->where('status', 'unpaid')->sum('amount');
                    @endphp
                    <div class="stats-grid" style="margin-top: 1.5rem; margin-bottom: 1.5rem;">
                        <div class="stat-card blue">
                            <div class="stat-card-title">Total Invoiced</div>
                            <div class="stat-card-value">${{ number_format($totalBilled, 2) }}</div>
                            <svg class="stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <div class="stat-card green">
                            <div class="stat-card-title">Paid / Settled</div>
                            <div class="stat-card-value">${{ number_format($totalPaid, 2) }}</div>
                            <svg class="stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div class="stat-card purple" style="background: #FFFBEB; border-color: #FDE68A;">
                            <div class="stat-card-title" style="color: #92400E;">Awaiting Payment</div>
                            <div class="stat-card-value" style="color: #B45309;">${{ number_format($totalUnpaid, 2) }}</div>
                            <svg class="stat-icon" style="color: #D97706;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>

                    <div style="background: white; border-radius: 20px; border: 1px solid #E5E7EB; padding: 2.25rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                        <h2 class="section-title" style="margin-top: 0; margin-bottom: 1.25rem;">Invoice Statement</h2>
                        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                            @forelse($invoices as $invoice)
                                <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #F3F4F6; padding-bottom: 1.5rem; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1.5rem;">
                                    <div style="display: flex; align-items: center; gap: 1.25rem; min-width: 260px; flex: 1;">
                                        <div style="width: 56px; height: 56px; border-radius: 14px; background: #F8FAFC; color: #64748B; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1.5rem; flex-shrink: 0; border: 1.5px solid #E2E8F0;">
                                            💵
                                        </div>
                                        <div>
                                            <h3 style="font-size: 1.15rem; font-weight: 700; color: var(--text-dark); margin-bottom: 0.25rem;">{{ $invoice->title }}</h3>
                                            <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 0.4rem; line-height: 1.3;">Milestone Deliverable Fee &bull; Due {{ $invoice->due_date->format('M d, Y') }}</p>
                                            <div style="display: flex; gap: 0.5rem; align-items: center;">
                                                <span style="font-size: 0.725rem; background: #F1F5F9; color: #475569; padding: 0.2rem 0.5rem; border-radius: 6px; font-weight: 700;">
                                                    Inv ID: #INV-{{ str_pad($invoice->id, 5, '0', STR_PAD_LEFT) }}
                                                </span>
                                                @if($invoice->contract)
                                                    <span style="font-size: 0.725rem; background: #EEF2F6; color: var(--primary); padding: 0.2rem 0.5rem; border-radius: 6px; font-weight: 700;">
                                                        Ref Contract: #CON-{{ str_pad($invoice->contract->id, 4, '0', STR_PAD_LEFT) }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Invoice Total -->
                                    <div style="min-width: 140px;">
                                        <div style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted); margin-bottom: 0.15rem;">Amount Due</div>
                                        <div style="font-size: 1.25rem; font-weight: 900; color: var(--text-dark);">${{ number_format($invoice->amount, 2) }}</div>
                                    </div>

                                    <!-- Invoice Status pill -->
                                    <div style="min-width: 120px;">
                                        @if($invoice->status === 'paid')
                                            <span style="display: inline-flex; align-items: center; gap: 0.35rem; font-size: 0.8rem; background: #ECFDF5; color: #065F46; padding: 0.35rem 0.75rem; border-radius: 9999px; font-weight: 700; border: 1px solid #A7F3D0;">
                                                <span style="width: 8px; height: 8px; border-radius: 50%; background: #10B981;"></span>
                                                Settled
                                            </span>
                                        @else
                                            <span style="display: inline-flex; align-items: center; gap: 0.35rem; font-size: 0.8rem; background: #FFFBEB; color: #92400E; padding: 0.35rem 0.75rem; border-radius: 9999px; font-weight: 700; border: 1px solid #FDE68A;">
                                                <span style="width: 8px; height: 8px; border-radius: 50%; background: #F59E0B;"></span>
                                                Unpaid
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Invoice Action buttons -->
                                    <div style="display: flex; gap: 0.75rem; align-items: center;">
                                        @if($invoice->status === 'unpaid')
                                            <button class="btn-primary-full" style="width: auto; background: var(--primary); padding: 0.65rem 1.25rem; font-size: 0.85rem; border-radius: 10px; display: flex; align-items: center; gap: 0.4rem;" onclick="openPaymentModal({{ $invoice->id }}, '{{ addslashes($invoice->title) }}', '{{ number_format($invoice->amount, 2) }}')">
                                                Pay Now
                                            </button>
                                        @else
                                            <button class="icon-btn" style="width: auto; padding: 0.65rem 1rem; font-size: 0.85rem; border-radius: 10px; background: #F9FAFB; border: 1.5px solid #E2E8F0;" onclick="alert('Loading invoice receipt PDF...')">
                                                Receipt
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div style="background: white; border-radius: 16px; border: 1px dashed #D1D5DB; padding: 4rem; text-align: center; color: var(--text-muted); margin: 1rem 0;">
                                    <svg style="width: 56px; height: 56px; margin: 0 auto 1.25rem; opacity: 0.5;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                    <p style="font-weight: 700; font-size: 1.1rem; color: var(--text-dark); margin-bottom: 0.35rem;">No Invoices Statement</p>
                                    <p style="font-size: 0.9rem;">Once your creative agreements generate active billable milestones, invoices will be listed here.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- TAB 2: Discover Network Directory -->
                <div id="tab-content-discover" class="tab-pane" style="display: none;">
                    <div class="header">
                        <h1>Discover Creative Network</h1>
                        <p style="color: var(--text-muted); font-size: 0.95rem; margin-top: 0.25rem;">Browse, filter, and connect with premium creative professionals and designers on the website.</p>
                    </div>

                    <!-- Search & Filter Controls -->
                    <div style="background: white; border-radius: 20px; border: 1px solid #E5E7EB; padding: 1.5rem; margin-top: 1.5rem; display: flex; flex-direction: column; gap: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                        <div style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
                            <div style="position: relative; flex: 1; min-width: 260px; display: flex; align-items: center;">
                                <span style="position: absolute; left: 1rem; color: var(--text-muted); font-size: 1.1rem; line-height: 1;">🔍</span>
                                <input type="text" id="discover-search" onkeyup="filterDiscoverNetwork()" placeholder="Search creators by name, bio, role, or skills..." style="width: 100%; padding: 0.75rem 1rem 0.75rem 2.5rem; border: 1.5px solid #E5E7EB; border-radius: 12px; font-size: 0.95rem; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='#E5E7EB'" />
                            </div>
                        </div>

                        <!-- Skill filter pills -->
                        <div style="display: flex; gap: 0.5rem; flex-wrap: wrap; align-items: center; border-top: 1px solid #F3F4F6; padding-top: 1rem;">
                            <span style="font-size: 0.85rem; color: var(--text-muted); font-weight: 700; margin-right: 0.5rem;">Popular Skills:</span>
                            <button class="skill-filter-pill active" onclick="toggleSkillFilter('', this)" style="background: var(--primary); color: white; border: none; padding: 0.35rem 0.85rem; border-radius: 9999px; font-size: 0.8rem; font-weight: 700; cursor: pointer; transition: all 0.2s;">All</button>
                            @php
                                // Extract all seeded skills across all live portfolios
                                $allSkillsList = [];
                                foreach ($allPortfolios as $ap) {
                                    if (is_array($ap->skills)) {
                                        $allSkillsList = array_merge($allSkillsList, $ap->skills);
                                    }
                                }
                                $uniqueSkills = array_unique(array_filter($allSkillsList));
                                // Take top 8 unique skills
                                $uniqueSkills = array_slice($uniqueSkills, 0, 8);
                            @endphp
                            @foreach($uniqueSkills as $skill)
                                <button class="skill-filter-pill" onclick="toggleSkillFilter('{{ strtolower($skill) }}', this)" style="background: #F3F4F6; color: #4B5563; border: none; padding: 0.35rem 0.85rem; border-radius: 9999px; font-size: 0.8rem; font-weight: 700; cursor: pointer; transition: all 0.2s;">{{ $skill }}</button>
                            @endforeach
                        </div>

                        <!-- Domain Keywords filter pills -->
                        <div style="display: flex; gap: 0.5rem; flex-wrap: wrap; align-items: center; border-top: 1px dashed #E5E7EB; padding-top: 0.75rem;">
                            <span style="font-size: 0.85rem; color: var(--text-muted); font-weight: 700; margin-right: 0.5rem;">Domain / Niche Keywords:</span>
                            <button class="keyword-filter-pill active" onclick="toggleKeywordFilter('', this)" style="background: var(--accent); color: white; border: none; padding: 0.35rem 0.85rem; border-radius: 9999px; font-size: 0.8rem; font-weight: 700; cursor: pointer; transition: all 0.2s;">All Domains</button>
                            @php
                                // Extract all unique keywords across all live portfolios
                                $allKeywordsList = [];
                                foreach ($allPortfolios as $ap) {
                                    if (is_array($ap->keywords)) {
                                        $allKeywordsList = array_merge($allKeywordsList, $ap->keywords);
                                    }
                                }
                                $uniqueKeywords = array_unique(array_filter($allKeywordsList));
                                // Take top 10 unique keywords
                                $uniqueKeywords = array_slice($uniqueKeywords, 0, 10);
                            @endphp
                            @foreach($uniqueKeywords as $kw)
                                <button class="keyword-filter-pill" onclick="toggleKeywordFilter('{{ strtolower($kw) }}', this)" style="background: #F3F4F6; color: #4B5563; border: none; padding: 0.35rem 0.85rem; border-radius: 9999px; font-size: 0.8rem; font-weight: 700; cursor: pointer; transition: all 0.2s;">#{{ $kw }}</button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Bento-Style Creator Directory Grid -->
                    <div class="discover-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 1.5rem; margin-top: 1.5rem;">
                        @forelse($allPortfolios as $ap)
                            @php
                                // Identify redesign templates
                                $styleLabel = 'Default Template';
                                $styleClass = 'default';
                                $styleColor = '#4B5563';
                                $styleBg = '#F3F4F6';
                                
                                if ($ap->design_template === 'modern') {
                                    $styleLabel = 'Emma Holistic (Warm Blush)';
                                    $styleClass = 'holistic';
                                    $styleColor = '#B45309';
                                    $styleBg = '#FEF3C7';
                                } elseif ($ap->design_template === 'minimal') {
                                    $styleLabel = 'Adam Smith (Slate)';
                                    $styleClass = 'architect';
                                    $styleColor = '#065F46';
                                    $styleBg = '#D1FAE5';
                                } elseif ($ap->design_template === 'developer') {
                                    $styleLabel = 'Mary Dench (Boutique)';
                                    $styleClass = 'interior';
                                    $styleColor = '#1E40AF';
                                    $styleBg = '#DBEAFE';
                                }
                                
                                 $skillsJson = is_array($ap->skills) ? json_encode(array_map('strtolower', $ap->skills)) : '[]';
                                 $keywordsJson = is_array($ap->keywords) ? json_encode(array_map('strtolower', $ap->keywords)) : '[]';
                             @endphp
                             <div class="discover-card-item" data-name="{{ strtolower($ap->title) }}" data-bio="{{ strtolower($ap->bio) }}" data-template="{{ $styleClass }}" data-skills="{{ $skillsJson }}" data-keywords="{{ $keywordsJson }}" style="background: white; border-radius: 20px; border: 1px solid #E5E7EB; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); display: flex; flex-direction: column; transition: all 0.25s;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 20px -8px rgba(0,0,0,0.1)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.05)';">
                                 <div style="height: 100px; background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%); opacity: 0.85; position: relative; display: flex; align-items: center; padding: 1rem;">
                                     <span style="position: absolute; right: 1rem; top: 1rem; font-size: 0.725rem; font-weight: 800; text-transform: uppercase; background: {{ $styleBg }}; color: {{ $styleColor }}; padding: 0.3rem 0.65rem; border-radius: 8px; border: 1px solid rgba(0,0,0,0.05);">
                                         {{ $styleLabel }}
                                     </span>
                                 </div>
                                 <div style="padding: 1.5rem; flex: 1; display: flex; flex-direction: column; margin-top: -38px; position: relative;">
                                     <div style="width: 68px; height: 68px; border-radius: 18px; background: white; border: 4px solid white; box-shadow: 0 8px 16px -4px rgba(0,0,0,0.15); display: flex; align-items: center; justify-content: center; font-weight: 900; font-size: 1.5rem; color: var(--primary); margin-bottom: 0.75rem;">
                                         {{ strtoupper(substr($ap->title, 0, 2)) }}
                                     </div>
                                     <h3 style="font-size: 1.25rem; font-weight: 800; color: var(--text-dark); margin-bottom: 0.35rem;">{{ $ap->title }}</h3>
                                     <p style="font-size: 0.875rem; color: var(--text-muted); margin-bottom: 1rem; line-height: 1.4; flex: 1;">{{ $ap->bio }}</p>
                                     
                                     @if(is_array($ap->skills) && count($ap->skills) > 0)
                                         <div style="display: flex; gap: 0.4rem; flex-wrap: wrap; margin-bottom: 0.65rem;">
                                             @foreach(array_slice($ap->skills, 0, 4) as $s)
                                                 <span style="font-size: 0.725rem; font-weight: 700; color: #475569; background: #F1F5F9; padding: 0.2rem 0.5rem; border-radius: 6px;">{{ $s }}</span>
                                             @endforeach
                                             @if(count($ap->skills) > 4)
                                                 <span style="font-size: 0.725rem; font-weight: 700; color: var(--accent); background: #FEF2F2; padding: 0.2rem 0.5rem; border-radius: 6px;">+{{ count($ap->skills) - 4 }}</span>
                                             @endif
                                         </div>
                                     @endif

                                     @if(is_array($ap->keywords) && count($ap->keywords) > 0)
                                         <div style="display: flex; gap: 0.35rem; flex-wrap: wrap; margin-bottom: 1.25rem;">
                                             @foreach($ap->keywords as $k)
                                                 <span style="font-size: 0.725rem; font-weight: 700; color: var(--accent); background: #FFF5F5; padding: 0.15rem 0.45rem; border-radius: 6px;">#{{ $k }}</span>
                                             @endforeach
                                         </div>
                                     @endif
                                     
                                     <div style="display: flex; gap: 0.75rem; border-top: 1px solid #F3F4F6; padding-top: 1.25rem;">
                                         <button class="btn-primary-full" onclick="openCollaborateModal({{ $ap->id }}, '{{ addslashes($ap->title) }}', '{{ $ap->slug }}')" style="flex: 1; padding: 0.65rem 1rem; font-size: 0.85rem; border-radius: 10px; background: var(--primary); color: white; display: flex; align-items: center; justify-content: center; gap: 0.4rem;">
                                             ✉️ Collaborate
                                         </button>
                                         <a href="{{ route('portfolio.show', $ap->slug) }}" target="_blank" style="text-decoration: none; display: flex; align-items: center; justify-content: center; width: 42px; height: 42px; border-radius: 10px; border: 1.5px solid #E2E8F0; color: #4B5563; background: white; transition: all 0.2s;" onmouseover="this.style.background='#F9FAFB'" onmouseout="this.style.background='white'">
                                             🔗
                                         </a>
                                     </div>
                                </div>
                            </div>
                        @empty
                            <div style="grid-column: 1 / -1; background: white; border-radius: 16px; border: 1px dashed #D1D5DB; padding: 4rem; text-align: center; color: var(--text-muted);">
                                <svg style="width: 56px; height: 56px; margin: 0 auto 1.25rem; opacity: 0.5;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                <p style="font-weight: 700; font-size: 1.1rem; color: var(--text-dark); margin-bottom: 0.35rem;">No Creators Found</p>
                                <p style="font-size: 0.9rem;">Once creators publish their portfolios, they will appear in this directory network.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </main>

        <!-- Right Panel (Quick Hub) -->
        <aside class="right-panel">
            <h2 class="section-title">Discover</h2>
            
            <button class="btn-primary-full" style="margin-bottom: 2rem;" onclick="window.location.href='/'">
                Search Talent Network
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </button>

            <div style="margin-bottom: 2.5rem; display: flex; flex-direction: column; gap: 0.75rem;">
                @foreach($discoverPortfolios as $dp)
                    <a href="{{ route('portfolio.show', $dp->slug) }}" style="text-decoration: none; color: inherit; display: block;">
                        <div class="creator-card" style="padding: 1rem; border: 1px solid #E5E7EB; border-radius: 14px; background: white; transition: all 0.2s; display: flex; align-items: center; gap: 0.75rem;">
                            <div class="creator-avatar" style="width: 38px; height: 38px; font-size: 0.875rem; background: #DBEAFE; color: #1D4ED8; border-radius: 8px; flex-shrink: 0; font-weight: 700;">
                                {{ strtoupper(substr($dp->title, 0, 2)) }}
                            </div>
                            <div class="creator-info" style="flex: 1; min-width: 0;">
                                <h4 style="font-size: 0.875rem; font-weight: 700; color: var(--text-dark); margin-bottom: 0.15rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $dp->title }}</h4>
                                <p style="font-size: 0.75rem; margin-bottom: 0; color: var(--text-muted); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $dp->bio }}</p>
                            </div>
                            <span style="font-size: 1rem; color: var(--accent); font-weight: 900;">&rarr;</span>
                        </div>
                    </a>
                @endforeach
            </div>

            <h2 class="section-title">Recent Inquiries</h2>
            <div class="right-panel-card" style="padding: 1rem;">
                @forelse($inquiries as $inq)
                    <div class="message-item" style="cursor: pointer;" onclick="openConversation({{ $inq->id }})">
                        <div class="msg-avatar">
                            {{ strtoupper(substr($inq->portfolio->title ?? 'CR', 0, 2)) }}
                        </div>
                        <div style="flex: 1; min-width: 0;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.15rem;">
                                <h4 style="font-size: 0.875rem; font-weight: 700; color: var(--text-dark); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $inq->portfolio->title ?? 'Creator' }}</h4>
                                @if($inq->status === 'replied')
                                    <span style="background: #D1FAE5; color: #065F46; font-size: 0.65rem; padding: 0.15rem 0.4rem; border-radius: 9999px; font-weight: 700; text-transform: uppercase;">Reply</span>
                                @else
                                    <span style="background: #DBEAFE; color: #1E40AF; font-size: 0.65rem; padding: 0.15rem 0.4rem; border-radius: 9999px; font-weight: 700; text-transform: uppercase;">Sent</span>
                                @endif
                            </div>
                            <p style="font-size: 0.8rem; font-weight: 600; color: var(--text-dark); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-bottom: 0.15rem;">{{ $inq->subject }}</p>
                            <p style="font-size: 0.725rem; color: var(--text-muted); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                @if($inq->replies && count($inq->replies) > 0)
                                    @php $lastReply = end($inq->replies); @endphp
                                    {{ $lastReply['sender'] === 'creator' ? 'Reply: ' : 'You: ' }}{{ $lastReply['message'] }}
                                @else
                                    You: {{ $inq->message }}
                                @endif
                            </p>
                        </div>
                    </div>
                @empty
                    <p style="font-size: 0.8rem; color: var(--text-muted); text-align: center; padding: 1rem 0;">No inquiries sent yet.</p>
                @endforelse
            </div>
        </aside>
    </div>

    <!-- Dynamic Thread Modal -->
    <div id="conversation-modal" style="display: none; position: fixed; inset: 0; background: rgba(0, 0, 0, 0.45); z-index: 9999; backdrop-filter: blur(4px); align-items: center; justify-content: center; padding: 1.5rem;">
        <div style="background: white; width: 100%; max-width: 620px; border-radius: 20px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.2); display: flex; flex-direction: column; max-height: 85vh; overflow: hidden; border: 1px solid #E5E7EB;">
            <!-- Modal Header -->
            <div style="padding: 1.5rem; border-bottom: 1px solid #F3F4F6; display: flex; justify-content: space-between; align-items: center; background: #FAFBFC;">
                <div>
                    <h3 id="modal-subject" style="font-size: 1.15rem; font-weight: 700; color: var(--text-dark);">Subject Line</h3>
                    <p id="modal-creator-name" style="font-size: 0.85rem; color: var(--accent); font-weight: 700; margin-top: 0.2rem;">To: Creator Title</p>
                </div>
                <button onclick="closeModal()" style="border: none; background: transparent; font-size: 1.75rem; cursor: pointer; color: var(--text-muted); font-weight: 400; line-height: 1; transition: color 0.2s;" onmouseover="this.style.color='#000'" onmouseout="this.style.color='var(--text-muted)'">&times;</button>
            </div>
            
            <!-- Messages thread -->
            <div id="modal-thread" style="padding: 1.5rem; overflow-y: auto; flex: 1; display: flex; flex-direction: column; gap: 1.25rem; background: #F9FAFB;">
                <!-- Dynamically populated -->
            </div>
            
            <!-- Reply form -->
            <form id="modal-reply-form" method="POST" style="padding: 1.5rem; border-top: 1px solid #F3F4F6; background: white; margin-bottom: 0;">
                @csrf
                <div style="display: flex; gap: 0.75rem; align-items: center;">
                    <textarea name="message" rows="2" placeholder="Type a follow-up message..." required style="flex: 1; border: 1.5px solid #E5E7EB; border-radius: 12px; padding: 0.75rem 1rem; font-size: 0.875rem; resize: none; outline: none; transition: border-color 0.2s; font-family: inherit;" onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='#E5E7EB'"></textarea>
                    <button type="submit" class="btn-primary-full" style="width: auto; padding: 0.75rem 1.5rem; height: 100%; border-radius: 12px;">Send</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Contract Signature Modal -->
    <div id="signature-modal" style="display: none; position: fixed; inset: 0; background: rgba(0, 0, 0, 0.45); z-index: 9999; backdrop-filter: blur(4px); align-items: center; justify-content: center; padding: 1.5rem;">
        <div style="background: white; width: 100%; max-width: 520px; border-radius: 20px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.2); border: 1px solid #E5E7EB; overflow: hidden;">
            <div style="padding: 1.5rem; border-bottom: 1px solid #F3F4F6; display: flex; justify-content: space-between; align-items: center; background: #FAFBFC;">
                <h3 style="font-size: 1.15rem; font-weight: 700; color: var(--text-dark);">Review & Sign Scope Agreement</h3>
                <button onclick="closeSignatureModal()" style="border: none; background: transparent; font-size: 1.75rem; cursor: pointer; color: var(--text-muted); font-weight: 400; line-height: 1; transition: color 0.2s;" onmouseover="this.style.color='#000'" onmouseout="this.style.color='var(--text-muted)'">&times;</button>
            </div>
            <form id="signature-form" method="POST" style="margin: 0;">
                @csrf
                <div style="padding: 1.5rem;">
                    <div style="margin-bottom: 1.25rem;">
                        <span style="font-size: 0.8rem; text-transform: uppercase; color: var(--text-muted); font-weight: 700;">Agreement Title</span>
                        <h4 id="sig-contract-title" style="font-size: 1.1rem; font-weight: 700; color: var(--text-dark); margin-top: 0.15rem;">UX/UI Design Retainer Contract</h4>
                    </div>
                    <div style="margin-bottom: 1.5rem; background: #F8FAFC; border: 1.5px solid #E2E8F0; padding: 1rem; border-radius: 12px;">
                        <span style="font-size: 0.8rem; text-transform: uppercase; color: var(--text-muted); font-weight: 700;">Financial Scope</span>
                        <div id="sig-contract-amount" style="font-size: 1.5rem; font-weight: 900; color: var(--primary); margin-top: 0.25rem;">$2,500.00 USD</div>
                    </div>
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; font-size: 0.85rem; font-weight: 700; color: var(--text-dark); margin-bottom: 0.5rem;">Draw or Type Your Digital Signature</label>
                        <div style="border: 2px dashed #CBD5E1; border-radius: 12px; background: #FAFBFC; padding: 1rem; display: flex; align-items: center; justify-content: center; color: var(--text-muted); font-size: 0.9rem; font-style: italic; position: relative;">
                            <input type="text" placeholder="Type name to sign (e.g. {{ Auth::user()->name }})" required style="width: 100%; max-width: 320px; background: white; border: 1.5px solid #CBD5E1; border-radius: 8px; padding: 0.5rem 0.75rem; text-align: center; font-size: 1.1rem; font-family: 'Playfair Display', serif;" />
                        </div>
                    </div>
                    <p style="font-size: 0.75rem; color: var(--text-muted); line-height: 1.3;">By clicking the button below, you confirm that you accept all scope descriptions, deliverables deadlines, and financial structures defined within this creative agreement.</p>
                </div>
                <div style="padding: 1.5rem; border-top: 1px solid #F3F4F6; background: #FAFBFC; display: flex; justify-content: flex-end; gap: 0.75rem;">
                    <button type="button" class="icon-btn" style="width: auto; background: white; padding: 0.65rem 1rem; border: 1.5px solid #E2E8F0;" onclick="closeSignatureModal()">Cancel</button>
                    <button type="submit" class="btn-primary-full" style="width: auto; background: var(--accent); padding: 0.65rem 1.5rem;">Sign Agreement</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Invoice Payment Modal -->
    <div id="payment-modal" style="display: none; position: fixed; inset: 0; background: rgba(0, 0, 0, 0.45); z-index: 9999; backdrop-filter: blur(4px); align-items: center; justify-content: center; padding: 1.5rem;">
        <div style="background: white; width: 100%; max-width: 520px; border-radius: 20px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.2); border: 1px solid #E5E7EB; overflow: hidden;">
            <div style="padding: 1.5rem; border-bottom: 1px solid #F3F4F6; display: flex; justify-content: space-between; align-items: center; background: #FAFBFC;">
                <h3 style="font-size: 1.15rem; font-weight: 700; color: var(--text-dark);">Secure Invoice Payment</h3>
                <button onclick="closePaymentModal()" style="border: none; background: transparent; font-size: 1.75rem; cursor: pointer; color: var(--text-muted); font-weight: 400; line-height: 1; transition: color 0.2s;" onmouseover="this.style.color='#000'" onmouseout="this.style.color='var(--text-muted)'">&times;</button>
            </div>
            <form id="payment-form" method="POST" style="margin: 0;">
                @csrf
                <div style="padding: 1.5rem;">
                    <div style="margin-bottom: 1.25rem;">
                        <span style="font-size: 0.8rem; text-transform: uppercase; color: var(--text-muted); font-weight: 700;">Paying Milestone Invoice</span>
                        <h4 id="pay-invoice-title" style="font-size: 1.1rem; font-weight: 700; color: var(--text-dark); margin-top: 0.15rem;">Brand Identity Deposit Invoice</h4>
                    </div>
                    <div style="margin-bottom: 1.5rem; background: #F8FAFC; border: 1.5px solid #E2E8F0; padding: 1rem; border-radius: 12px; display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <span style="font-size: 0.8rem; text-transform: uppercase; color: var(--text-muted); font-weight: 700;">Amount Outstanding</span>
                            <div id="pay-invoice-amount" style="font-size: 1.5rem; font-weight: 900; color: var(--primary); margin-top: 0.15rem;">$2,250.00 USD</div>
                        </div>
                        <span style="background: #FFFBEB; color: #D97706; padding: 0.25rem 0.5rem; border-radius: 6px; font-size: 0.75rem; font-weight: 700;">Secured by Stripe</span>
                    </div>

                    <!-- Payment card UI -->
                    <div style="display: flex; flex-direction: column; gap: 0.85rem; margin-bottom: 1.25rem;">
                        <div>
                            <label style="display: block; font-size: 0.8rem; font-weight: 700; color: var(--text-dark); margin-bottom: 0.35rem;">Cardholder Name</label>
                            <input type="text" value="{{ Auth::user()->name }}" required style="width: 100%; border: 1.5px solid #E5E7EB; border-radius: 10px; padding: 0.65rem 0.85rem; font-size: 0.875rem;" />
                        </div>
                        <div>
                            <label style="display: block; font-size: 0.8rem; font-weight: 700; color: var(--text-dark); margin-bottom: 0.35rem;">Card Number</label>
                            <div style="position: relative; display: flex; align-items: center;">
                                <input type="text" placeholder="4111 2222 3333 4444" required style="width: 100%; border: 1.5px solid #E5E7EB; border-radius: 10px; padding: 0.65rem 0.85rem 0.65rem 2.5rem; font-size: 0.875rem;" />
                                <span style="position: absolute; left: 0.75rem; font-size: 1.1rem;">💳</span>
                            </div>
                        </div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.85rem;">
                            <div>
                                <label style="display: block; font-size: 0.8rem; font-weight: 700; color: var(--text-dark); margin-bottom: 0.35rem;">Expiry Date</label>
                                <input type="text" placeholder="MM / YY" required style="width: 100%; border: 1.5px solid #E5E7EB; border-radius: 10px; padding: 0.65rem 0.85rem; font-size: 0.875rem; text-align: center;" />
                            </div>
                            <div>
                                <label style="display: block; font-size: 0.8rem; font-weight: 700; color: var(--text-dark); margin-bottom: 0.35rem;">CVV Code</label>
                                <input type="text" placeholder="123" required style="width: 100%; border: 1.5px solid #E5E7EB; border-radius: 10px; padding: 0.65rem 0.85rem; font-size: 0.875rem; text-align: center;" />
                            </div>
                        </div>
                    </div>
                </div>
                <div style="padding: 1.5rem; border-top: 1px solid #F3F4F6; background: #FAFBFC; display: flex; justify-content: flex-end; gap: 0.75rem;">
                    <button type="button" class="icon-btn" style="width: auto; background: white; padding: 0.65rem 1rem; border: 1.5px solid #E2E8F0;" onclick="closePaymentModal()">Cancel</button>
                    <button type="submit" class="btn-primary-full" style="width: auto; background: var(--primary); padding: 0.65rem 1.5rem;">Settle Payment</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Creator Collaboration Inquiry Modal -->
    <div id="collab-modal" style="display: none; position: fixed; inset: 0; background: rgba(0, 0, 0, 0.45); z-index: 9999; backdrop-filter: blur(4px); align-items: center; justify-content: center; padding: 1.5rem;">
        <div style="background: white; width: 100%; max-width: 520px; border-radius: 20px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.2); border: 1px solid #E5E7EB; overflow: hidden;">
            <div style="padding: 1.5rem; border-bottom: 1px solid #F3F4F6; display: flex; justify-content: space-between; align-items: center; background: #FAFBFC;">
                <h3 id="collab-creator-title" style="font-size: 1.15rem; font-weight: 700; color: var(--text-dark);">Collaborate with Creator</h3>
                <button onclick="closeCollaborateModal()" style="border: none; background: transparent; font-size: 1.75rem; cursor: pointer; color: var(--text-muted); font-weight: 400; line-height: 1; transition: color 0.2s;" onmouseover="this.style.color='#000'" onmouseout="this.style.color='var(--text-muted)'">&times;</button>
            </div>
            <form id="collab-form" method="POST" style="margin: 0;">
                @csrf
                <input type="hidden" name="client_name" value="{{ Auth::user()->name }}" />
                <input type="hidden" name="client_email" value="{{ Auth::user()->email }}" />
                
                <div style="padding: 1.5rem; display: flex; flex-direction: column; gap: 1rem;">
                    <div>
                        <label style="display: block; font-size: 0.85rem; font-weight: 700; color: var(--text-dark); margin-bottom: 0.35rem;">Subject / Project Scope Name</label>
                        <input type="text" name="subject" placeholder="e.g. Brand Identity Relaunch Collaboration" required style="width: 100%; border: 1.5px solid #E5E7EB; border-radius: 10px; padding: 0.65rem 0.85rem; font-size: 0.875rem;" />
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.85rem; font-weight: 700; color: var(--text-dark); margin-bottom: 0.35rem;">Inquiry Message</label>
                        <textarea name="message" rows="5" placeholder="Hi! I came across your live portfolio on Folio. I would love to collaborate with you on our upcoming brand relaunch project. Let me know your availability and rates!" required style="width: 100%; border: 1.5px solid #E5E7EB; border-radius: 10px; padding: 0.65rem 0.85rem; font-size: 0.875rem; resize: none; font-family: inherit;"></textarea>
                    </div>
                    <p style="font-size: 0.75rem; color: var(--text-muted); line-height: 1.35;">By submitting this inquiry, a secure discussion channel will be opened in your 'My Creators' workspace and the creator dashboard will be notified instantly.</p>
                </div>
                <div style="padding: 1.5rem; border-top: 1px solid #F3F4F6; background: #FAFBFC; display: flex; justify-content: flex-end; gap: 0.75rem;">
                    <button type="button" class="icon-btn" style="width: auto; background: white; padding: 0.65rem 1rem; border: 1.5px solid #E2E8F0;" onclick="closeCollaborateModal()">Cancel</button>
                    <button type="submit" class="btn-primary-full" style="width: auto; background: var(--primary); padding: 0.65rem 1.5rem;">Send Inquiry</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal and dynamic rendering script -->
    <script>
        const inquiriesData = @json($inquiries);

        function openConversation(inquiryId) {
            const inquiry = inquiriesData.find(i => i.id === inquiryId);
            if (!inquiry) return;
            
            document.getElementById('modal-subject').innerText = inquiry.subject;
            document.getElementById('modal-creator-name').innerText = "Creator: " + (inquiry.portfolio ? inquiry.portfolio.title : "Creative Professional");
            
            // Set up form action
            document.getElementById('modal-reply-form').action = `/client/inquiries/${inquiry.id}/reply`;
            
            const threadContainer = document.getElementById('modal-thread');
            threadContainer.innerHTML = '';
            
            // Render original client message
            const origDate = new Date(inquiry.created_at).toLocaleString();
            let threadHtml = `
                <div style="align-self: flex-end; max-width: 80%; background: var(--primary); color: white; padding: 1rem 1.25rem; border-radius: 16px 16px 2px 16px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                    <div style="font-size: 0.7rem; opacity: 0.8; margin-bottom: 0.25rem; font-weight: 600;">You &bull; ${origDate}</div>
                    <div style="font-size: 0.875rem; line-height: 1.4; white-space: pre-wrap;">${inquiry.message}</div>
                </div>
            `;
            
            // Render replies
            if (inquiry.replies && inquiry.replies.length > 0) {
                inquiry.replies.forEach(reply => {
                    const isClient = reply.sender === 'client';
                    const senderName = isClient ? 'You' : (inquiry.portfolio ? inquiry.portfolio.title : 'Creator');
                    const bg = isClient ? 'var(--primary)' : '#FFFFFF';
                    const color = isClient ? '#FFFFFF' : 'var(--text-dark)';
                    const border = isClient ? 'none' : '1px solid #E5E7EB';
                    const align = isClient ? 'flex-end' : 'flex-start';
                    const radius = isClient ? '16px 16px 2px 16px' : '16px 16px 16px 2px';
                    const replyDate = new Date(reply.created_at).toLocaleString();
                    
                    threadHtml += `
                        <div style="align-self: ${align}; max-width: 80%; background: ${bg}; color: ${color}; border: ${border}; padding: 1rem 1.25rem; border-radius: ${radius}; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                            <div style="font-size: 0.7rem; opacity: 0.8; margin-bottom: 0.25rem; font-weight: 600; color: ${isClient ? '#FFFFFF' : 'var(--text-muted)'};">${senderName} &bull; ${replyDate}</div>
                            <div style="font-size: 0.875rem; line-height: 1.4; white-space: pre-wrap;">${reply.message}</div>
                        </div>
                    `;
                });
            }
            
            threadContainer.innerHTML = threadHtml;
            
            // Display Modal
            const modal = document.getElementById('conversation-modal');
            modal.style.display = 'flex';
            
            // Scroll to bottom
            setTimeout(() => {
                threadContainer.scrollTop = threadContainer.scrollHeight;
            }, 50);
        }

        function closeModal() {
            document.getElementById('conversation-modal').style.display = 'none';
        }

        // Close modal on click outside content
        document.getElementById('conversation-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Dynamic Tab Switcher
        function switchTab(tabId, el) {
            // Deactivate all nav links
            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('active');
            });
            
            // Activate current link
            el.classList.add('active');
            
            // Hide all tab content panes
            document.getElementById('tab-content-dashboard').style.display = 'none';
            document.getElementById('tab-content-my-creators').style.display = 'none';
            document.getElementById('tab-content-discover').style.display = 'none';
            document.getElementById('tab-content-contracts').style.display = 'none';
            document.getElementById('tab-content-billing').style.display = 'none';
            
            // Show selected tab pane
            document.getElementById('tab-content-' + tabId).style.display = 'block';
        }

        // Signature Modal Helpers
        function openSignatureModal(contractId, title, amount) {
            document.getElementById('sig-contract-title').innerText = title;
            document.getElementById('sig-contract-amount').innerText = '$' + amount + ' USD';
            document.getElementById('signature-form').action = `/client/contracts/${contractId}/sign`;
            document.getElementById('signature-modal').style.display = 'flex';
        }
        function closeSignatureModal() {
            document.getElementById('signature-modal').style.display = 'none';
        }
        
        // Payment Modal Helpers
        function openPaymentModal(invoiceId, title, amount) {
            document.getElementById('pay-invoice-title').innerText = title;
            document.getElementById('pay-invoice-amount').innerText = '$' + amount + ' USD';
            document.getElementById('payment-form').action = `/client/invoices/${invoiceId}/pay`;
            document.getElementById('payment-modal').style.display = 'flex';
        }
        function closePaymentModal() {
            document.getElementById('payment-modal').style.display = 'none';
        }

        // Collaboration Inquiry Modal Helpers
        function openCollaborateModal(portfolioId, title, slug) {
            document.getElementById('collab-creator-title').innerText = "Collaborate with " + title;
            document.getElementById('collab-form').action = `/portfolio/${slug}/inquiry`;
            document.getElementById('collab-modal').style.display = 'flex';
        }
        function closeCollaborateModal() {
            document.getElementById('collab-modal').style.display = 'none';
        }
        
        // Discover Real-Time Searching & Filtering
        function filterDiscoverNetwork() {
            const query = document.getElementById('discover-search').value.toLowerCase();
            const cards = document.querySelectorAll('.discover-card-item');
            
            // Get active skill filter
            const activeSkillButton = document.querySelector('.skill-filter-pill.active');
            const activeSkill = activeSkillButton ? activeSkillButton.textContent.toLowerCase().trim() : 'all';
            
            // Get active keyword filter
            const activeKeywordButton = document.querySelector('.keyword-filter-pill.active');
            const activeKeywordRaw = activeKeywordButton ? activeKeywordButton.textContent.toLowerCase().trim() : 'all domains';
            const activeKeyword = activeKeywordRaw.replace('#', '');
            const isAllDomains = activeKeywordRaw.includes('all');
            
            cards.forEach(card => {
                const name = card.getAttribute('data-name');
                const bio = card.getAttribute('data-bio');
                
                const skillsJson = card.getAttribute('data-skills');
                const skills = JSON.parse(skillsJson || '[]');
                
                const keywordsJson = card.getAttribute('data-keywords');
                const keywords = JSON.parse(keywordsJson || '[]');
                
                // Matches query: check name, bio, skills, and domain keywords
                const matchesQuery = name.includes(query) || bio.includes(query) || skills.some(s => s.includes(query)) || keywords.some(k => k.includes(query));
                
                // Matches active skill
                const matchesSkill = activeSkill === 'all' || skills.includes(activeSkill);
                
                // Matches active domain keyword
                const matchesKeyword = isAllDomains || keywords.includes(activeKeyword);
                
                if (matchesQuery && matchesSkill && matchesKeyword) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        }
        
        function toggleSkillFilter(skill, btn) {
            // Toggle active styling
            document.querySelectorAll('.skill-filter-pill').forEach(pill => {
                pill.classList.remove('active');
                pill.style.background = '#F3F4F6';
                pill.style.color = '#4B5563';
            });
            
            btn.classList.add('active');
            btn.style.background = 'var(--primary)';
            btn.style.color = 'white';
            
            filterDiscoverNetwork();
        }
        
        function toggleKeywordFilter(keyword, btn) {
            // Toggle active styling
            document.querySelectorAll('.keyword-filter-pill').forEach(pill => {
                pill.classList.remove('active');
                pill.style.background = '#F3F4F6';
                pill.style.color = '#4B5563';
            });
            
            btn.classList.add('active');
            btn.style.background = 'var(--accent)';
            btn.style.color = 'white';
            
            filterDiscoverNetwork();
        }
        
        // Modal click-outside triggers
        document.getElementById('signature-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeSignatureModal();
            }
        });
        document.getElementById('payment-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closePaymentModal();
            }
        });
        document.getElementById('collab-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeCollaborateModal();
            }
        });
    </script>
</body>
</html>
