<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Folio.</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,600;1,600&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #fafafa;
            --text-color: #111827;
            --primary: #111827;
            --secondary: #4B5563;
            --accent: #E67E22;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            min-height: 100vh;
        }

        header {
            background: #ffffff;
            border-bottom: 1px solid #E5E7EB;
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: -0.05em;
            color: var(--primary);
            text-decoration: none;
        }

        .logo-dot { color: var(--accent); }

        .btn-logout {
            background: #F3F4F6;
            color: var(--primary);
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-logout:hover {
            background: #E5E7EB;
        }

        main {
            max-width: 1200px;
            margin: 0 auto;
            padding: 4rem 2rem;
        }

        .welcome-section {
            background: #ffffff;
            padding: 3rem;
            border-radius: 24px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            border: 1px solid #E5E7EB;
            text-align: center;
        }

        .welcome-section h1 {
            font-size: 2.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            letter-spacing: -0.02em;
        }

        .role-badge {
            display: inline-block;
            padding: 0.5rem 1.5rem;
            background: rgba(37, 99, 235, 0.1);
            color: #2563EB;
            border-radius: 9999px;
            font-weight: 600;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 2rem;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .card {
            background: #ffffff;
            padding: 2rem;
            border-radius: 16px;
            border: 1px solid #E5E7EB;
            text-align: left;
        }

        .card h3 {
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
        }

        .card p {
            color: var(--secondary);
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <header>
        <a href="/" class="logo">Folio<span class="logo-dot">.</span></a>
        
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">Sign Out</button>
        </form>
    </header>

    <main>
        <div class="welcome-section">
            <h1>Welcome back, {{ Auth::user()->name }}</h1>
            <div class="role-badge">{{ Auth::user()->role }}</div>
            
            <p style="color: var(--secondary); max-width: 600px; margin: 0 auto; font-size: 1.1rem; line-height: 1.6;">
                You're successfully logged into your account. From here you can manage your settings, view your active projects, and configure your profile.
            </p>
        </div>

        <div class="dashboard-grid">
            <div class="card">
                <h3>Profile Settings</h3>
                <p>Update your personal information and email preferences.</p>
            </div>
            <div class="card">
                <h3>Security</h3>
                <p>Manage your password and active sessions securely.</p>
            </div>
            <div class="card">
                <h3>Billing & Plans</h3>
                <p>View your current subscription and payment methods.</p>
            </div>
        </div>
    </main>
</body>
</html>
