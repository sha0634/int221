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
                <a href="#" class="nav-link active">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Dashboard
                </a>
                <a href="#" class="nav-link">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    My Creators
                </a>
                <a href="#" class="nav-link">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Contracts
                </a>
                <a href="#" class="nav-link">
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
                <div class="header">
                    <h1>Client Dashboard</h1>
                    <div class="header-actions">
                        <button class="icon-btn"><svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg></button>
                    </div>
                </div>

                <div class="stats-grid">
                    <div class="stat-card blue">
                        <div class="stat-card-title">Active Projects</div>
                        <div class="stat-card-value">3</div>
                        <svg class="stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <div class="stat-card green">
                        <div class="stat-card-title">Saved Portfolios</div>
                        <div class="stat-card-value">12</div>
                        <svg class="stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </div>
                    <div class="stat-card purple">
                        <div class="stat-card-title">Pending Invoices</div>
                        <div class="stat-card-value">1</div>
                        <svg class="stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                </div>

                <h2 class="section-title">My Creators</h2>
                <div class="creators-grid">
                    <div class="creator-card">
                        <div class="creator-avatar">ED</div>
                        <div class="creator-info">
                            <h4>Elena Designs</h4>
                            <p>Brand Identity & UI/UX</p>
                            <span style="font-size: 0.75rem; font-weight: 600;"><span class="status-dot"></span>Active Project</span>
                        </div>
                    </div>
                    <div class="creator-card">
                        <div class="creator-avatar">JD</div>
                        <div class="creator-info">
                            <h4>John Developer</h4>
                            <p>Full Stack Laravel</p>
                            <span style="font-size: 0.75rem; font-weight: 600;"><span class="status-dot" style="background:#F59E0B;"></span>Reviewing Contract</span>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Right Panel (Quick Hub) -->
        <aside class="right-panel">
            <h2 class="section-title">Discover</h2>
            
            <button class="btn-primary-full" style="margin-bottom: 2.5rem;">
                Search Talent Network
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </button>

            <h2 class="section-title">Recent Messages</h2>
            <div class="right-panel-card" style="padding: 1rem;">
                <div class="message-item">
                    <div class="msg-avatar">ED</div>
                    <div>
                        <h4 style="font-size: 0.875rem; font-weight: 600;">Elena Designs</h4>
                        <p style="font-size: 0.75rem; color: var(--text-muted); margin-top: 0.25rem;">I've uploaded the first draft of the logo concepts...</p>
                    </div>
                </div>
                <div class="message-item">
                    <div class="msg-avatar">JD</div>
                    <div>
                        <h4 style="font-size: 0.875rem; font-weight: 600;">John Developer</h4>
                        <p style="font-size: 0.75rem; color: var(--text-muted); margin-top: 0.25rem;">Sounds good, let me check the API docs and get back to you.</p>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</body>
</html>
