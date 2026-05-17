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

        .icon-btn:hover { background: #F3F4F6; }

        /* Top Stats Row */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
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

        /* Activity List */
        .activity-list {
            background: #ffffff;
            border-radius: 20px;
            border: 1px solid #E5E7EB;
            overflow: hidden;
        }

        .activity-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #F3F4F6;
        }
        .activity-row:last-child { border-bottom: none; }

        .activity-info h4 { font-size: 0.875rem; font-weight: 600; }
        .activity-info p { font-size: 0.75rem; color: var(--text-muted); }

        .badge {
            padding: 0.25rem 0.5rem;
            border-radius: 6px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
        }
        .badge-success { background: #D1FAE5; color: #065F46; }
        .badge-warning { background: #FEF3C7; color: #92400E; }
        .badge-danger { background: #FEE2E2; color: #991B1B; }

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
                <a href="#" class="nav-link active">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Overview
                </a>
                <a href="#" class="nav-link">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    Users
                </a>
                <a href="#" class="nav-link">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Transactions
                </a>
                <a href="#" class="nav-link">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Platform Settings
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
                    <h1>Admin Control Panel</h1>
                    <div class="header-actions">
                        <button class="icon-btn"><svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg></button>
                    </div>
                </div>

                <div class="stats-grid">
                    <div class="stat-card blue">
                        <div class="stat-card-title">Total Users</div>
                        <div class="stat-card-value">12,450</div>
                        <svg class="stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <div class="stat-card green">
                        <div class="stat-card-title">Active Projects</div>
                        <div class="stat-card-value">1,842</div>
                        <svg class="stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                    </div>
                    <div class="stat-card orange">
                        <div class="stat-card-title">Revenue (30d)</div>
                        <div class="stat-card-value">$45,200</div>
                        <svg class="stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div class="stat-card red">
                        <div class="stat-card-title">Pending Reports</div>
                        <div class="stat-card-value">14</div>
                        <svg class="stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                </div>

                <div class="middle-grid">
                    <div class="bento-box">
                        <h2 class="section-title">Registration Trends</h2>
                        <div style="height: 200px; display: flex; align-items: flex-end; gap: 15px; padding-top: 20px;">
                            <!-- Placeholder Chart -->
                            <div style="flex:1; background:#E0E7FF; height:40%; border-radius:6px 6px 0 0;"></div>
                            <div style="flex:1; background:#E0E7FF; height:60%; border-radius:6px 6px 0 0;"></div>
                            <div style="flex:1; background:#E0E7FF; height:30%; border-radius:6px 6px 0 0;"></div>
                            <div style="flex:1; background:#E0E7FF; height:80%; border-radius:6px 6px 0 0;"></div>
                            <div style="flex:1; background:#4F46E5; height:100%; border-radius:6px 6px 0 0;"></div>
                            <div style="flex:1; background:#E0E7FF; height:50%; border-radius:6px 6px 0 0;"></div>
                        </div>
                    </div>

                    <div class="activity-list">
                        <h2 class="section-title" style="padding: 1.5rem 1.5rem 0 1.5rem;">Recent Signups</h2>
                        <div class="activity-row">
                            <div class="activity-info">
                                <h4>Jane Doe</h4>
                                <p>Creator Account</p>
                            </div>
                            <span class="badge badge-success">Active</span>
                        </div>
                        <div class="activity-row">
                            <div class="activity-info">
                                <h4>Acme Corp</h4>
                                <p>Client Account</p>
                            </div>
                            <span class="badge badge-success">Active</span>
                        </div>
                        <div class="activity-row">
                            <div class="activity-info">
                                <h4>Spam Bot</h4>
                                <p>Creator Account</p>
                            </div>
                            <span class="badge badge-danger">Banned</span>
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

            <h2 class="section-title">Action Items</h2>
            <div class="right-panel-card" style="padding: 1rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; border-bottom: 1px solid #E5E7EB; padding-bottom: 0.5rem;">
                    <div>
                        <h4 style="font-size: 0.875rem;">Identity Verifications</h4>
                        <p style="font-size: 0.75rem; color: var(--text-muted);">8 pending review</p>
                    </div>
                    <button style="padding: 0.25rem 0.75rem; background: var(--primary); color: white; border: none; border-radius: 6px; font-size: 0.75rem; cursor: pointer;">Review</button>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <h4 style="font-size: 0.875rem;">Dispute Resolution</h4>
                        <p style="font-size: 0.75rem; color: var(--text-muted);">2 active disputes</p>
                    </div>
                    <button style="padding: 0.25rem 0.75rem; background: #EF4444; color: white; border: none; border-radius: 6px; font-size: 0.75rem; cursor: pointer;">Resolve</button>
                </div>
            </div>
        </aside>
    </div>
</body>
</html>
