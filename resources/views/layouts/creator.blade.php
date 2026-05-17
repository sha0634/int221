<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creator Dashboard - Folio</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,600;1,600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #111827;
            --accent: #E67E22;
            --accent-hover: #D35400;
            --bg-main: #E5E9F2;
            --text-dark: #111827;
            --text-muted: #6B7280;
            --sidebar-width: 250px;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }
        body {
            background-color: var(--bg-main);
            color: var(--text-dark);
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            background: white;
            border-right: 1px solid #F3F4F6;
            padding: 2rem 1.5rem;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            z-index: 50;
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
        .logo-dot {
            color: #E67E22;
        }
        .nav-links {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            list-style: none;
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
        .nav-link.active {
            font-weight: 600;
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
        .user-profile-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #E67E22 0%, #F59E0B 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.2rem;
        }
        .user-profile-info h4 {
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
            color: var(--text-dark);
        }
        .user-profile-info span {
            font-size: 0.75rem;
            color: var(--text-muted);
        }
        
        /* Main Content */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .header {
            background: white;
            border-bottom: 1px solid #E2E8F0;
            padding: 1.5rem 3rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .header-title {
            font-size: 1.5rem;
            font-weight: 700;
        }
        .btn-logout {
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            font-weight: 500;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-logout:hover {
            color: #EF4444;
        }
        .content {
            padding: 3rem;
            flex: 1;
        }
        
        /* Shared components */
        .bento-box {
            background: white;
            border-radius: 20px;
            border: 1px solid #E2E8F0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
            margin-bottom: 2rem;
        }
        
        /* Form & utility elements */
        .section-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--primary);
        }
    </style>
    @yield('styles')
</head>
<body>

    <aside class="sidebar">
        <a href="{{ route('dashboard') }}" class="logo" style="text-decoration: none;">
            Folio<span class="logo-dot">.</span>
        </a>
        
        <div class="nav-links">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Summary
            </a>
            <a href="{{ route('creator.analytics') }}" class="nav-link {{ request()->routeIs('creator.analytics') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                Analytics
            </a>
            <a href="{{ route('creator.portfolio.index') }}" class="nav-link {{ request()->routeIs('creator.portfolio.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                My Portfolio
            </a>
            <a href="{{ route('creator.inquiries.index') }}" class="nav-link {{ request()->routeIs('creator.inquiries.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                Inquiries
            </a>
        </div>

        <div class="user-profile-card">
            <div class="user-profile-avatar">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="user-profile-info">
                <h4>{{ Auth::user()->name }}</h4>
                <span>{{ Auth::user()->role }}</span>
            </div>
        </div>
    </aside>

    <div class="main-wrapper">
        <header class="header">
            <h1 class="header-title">@yield('header_title', 'Dashboard')</h1>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Logout
                </button>
            </form>
        </header>
        
        <main class="content">
            @yield('content')
        </main>
    </div>

    @yield('scripts')
</body>
</html>
