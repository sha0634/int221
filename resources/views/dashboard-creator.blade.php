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
                <a href="#" class="nav-link active">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Summary
                </a>
                <a href="#" class="nav-link">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    Analytics
                </a>
                <a href="#" class="nav-link">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                    Inquiries
                </a>
                <a href="#" class="nav-link">
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
            <div class="main-content-inner">
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
                    <div class="stat-card-value">1,240</div>
                    <div class="stat-card-trend">↑ 12% this week</div>
                    <svg class="stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                </div>
                <div class="stat-card orange">
                    <div class="stat-card-title">Search Appearances</div>
                    <div class="stat-card-value">342</div>
                    <div class="stat-card-trend">↑ 5% this week</div>
                    <svg class="stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <div class="stat-card green">
                    <div class="stat-card-title">Click-Through Rate</div>
                    <div class="stat-card-value">4.8%</div>
                    <div class="stat-card-trend">↑ 1.2% this week</div>
                    <svg class="stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path></svg>
                </div>
            </div>

            <div class="middle-grid">
                <div class="bento-box">
                    <h2 class="section-title">Traffic Overview</h2>
                    <p style="color: var(--text-muted); font-size: 0.875rem; margin-bottom: 1rem;">See how your portfolio traffic grows over the week.</p>
                    <div class="analytics-chart-placeholder">
                        <div class="bar" style="height: 40%;"></div>
                        <div class="bar" style="height: 60%;"></div>
                        <div class="bar" style="height: 30%;"></div>
                        <div class="bar" style="height: 80%;"></div>
                        <div class="bar active" style="height: 100%;"></div>
                        <div class="bar" style="height: 70%;"></div>
                        <div class="bar" style="height: 50%;"></div>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-top: 10px; font-size: 0.75rem; color: var(--text-muted);">
                        <span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span><span>Sat</span><span>Sun</span>
                    </div>
                </div>

                <div class="bento-box" style="text-align: center;">
                    <h2 class="section-title">Profile Strength</h2>
                    <div class="profile-strength-circle">
                        <span>85%</span>
                    </div>
                    <p style="font-size: 0.875rem; font-weight: 600; margin-bottom: 0.5rem;">Almost there!</p>
                    <p style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 1rem;">Add 2 more skills to improve your search visibility.</p>
                    <button style="background: var(--bg-body); color: var(--primary); border: none; padding: 0.5rem 1rem; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 0.875rem;">Edit Profile</button>
                </div>
            </div>

            <h2 class="section-title">Active Inquiries</h2>
            <div class="inquiries-list">
                <div class="inquiry-item">
                    <div class="inquiry-client">
                        <div class="client-avatar">SJ</div>
                        <div>
                            <h4 style="font-size: 0.9rem; font-weight: 600;">Sarah Jenkins</h4>
                            <p style="font-size: 0.8rem; color: var(--text-muted);">Brand Identity Project</p>
                        </div>
                    </div>
                    <div style="font-size: 0.875rem; color: var(--text-muted);">Sep 16, 2026</div>
                    <span class="badge badge-new">New Message</span>
                </div>
                <div class="inquiry-item">
                    <div class="inquiry-client">
                        <div class="client-avatar">MT</div>
                        <div>
                            <h4 style="font-size: 0.9rem; font-weight: 600;">Mark Thompson</h4>
                            <p style="font-size: 0.8rem; color: var(--text-muted);">Website Redesign Inquiry</p>
                        </div>
                    </div>
                    <div style="font-size: 0.875rem; color: var(--text-muted);">Sep 15, 2026</div>
                    <span class="badge badge-ongoing">Awaiting Reply</span>
                </div>
            </div>
            </div>
        </main>

        <!-- Right Panel (Quick Hub) -->
        <aside class="right-panel">
            <h2 class="section-title">Quick Hub</h2>
            
            <div class="right-panel-card">
                <h3>Portfolio Summary</h3>
                <div class="balance-amount">12</div>
                <p style="font-size: 0.875rem; color: var(--text-muted); margin-bottom: 1rem;">Active projects uploaded</p>
                <button style="width: 100%; padding: 0.75rem; background: var(--primary); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">+ Upload New Work</button>
            </div>

            <div class="right-panel-card">
                <h3>Tagged Skills</h3>
                <div style="margin-top: 1rem;">
                    <span class="tag-pill">UI/UX Design</span>
                    <span class="tag-pill">Webflow</span>
                    <span class="tag-pill">Branding</span>
                    <span class="tag-pill">Figma</span>
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
</body>
</html>
