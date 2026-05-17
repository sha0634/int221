<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $portfolio->title }} - Holistic Portfolio</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-blush: #FDECE3;
            --bg-cream: #FFFDFB;
            --text-dark: #1F2421;
            --text-muted: #6B7280;
            --accent-green: #A0C850;
            --accent-pink: #F592AB;
            --accent-blue: #7FB3D5;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            color: var(--text-dark);
            line-height: 1.6;
            background-color: var(--bg-cream);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* Top Navbar */
        .navbar {
            background-color: var(--bg-blush);
            padding: 1.5rem 0;
        }

        .navbar-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-logo {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            text-decoration: none;
            color: var(--text-dark);
            letter-spacing: 0.05em;
        }

        .navbar-logo span {
            color: var(--accent-pink);
        }

        .navbar-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .navbar-link {
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            border-bottom: 2px solid transparent;
            transition: all 0.2s ease;
        }

        .navbar-link:hover {
            color: var(--accent-pink);
            border-color: var(--accent-pink);
        }

        .navbar-socials {
            display: flex;
            gap: 1.25rem;
            align-items: center;
        }

        .social-icon-btn {
            color: var(--accent-pink);
            opacity: 0.75;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .social-icon-btn:hover {
            opacity: 1;
            transform: scale(1.1);
        }

        /* Hero Section */
        .hero {
            background-color: var(--bg-blush);
            padding: 4rem 0 6rem 0;
            position: relative;
            overflow: hidden;
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 150px;
            height: 150px;
            background: radial-gradient(circle, rgba(245, 146, 171, 0.15) 0%, transparent 70%);
            pointer-events: none;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1fr 1.1fr;
            gap: 4rem;
            align-items: center;
        }

        /* Floating Frame Portrait */
        .hero-left {
            position: relative;
            display: flex;
            justify-content: center;
        }

        .portrait-wrapper {
            position: relative;
            width: 440px;
            height: 440px;
        }

        .portrait-frame {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 6px solid #ffffff;
            box-shadow: 0 20px 40px rgba(0,0,0,0.06);
            overflow: hidden;
            position: relative;
        }

        .portrait-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }

        .portrait-frame img:hover {
            transform: scale(1.03);
        }

        /* Centered translucent Play Button */
        .play-button-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 76px;
            height: 76px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.45);
            backdrop-filter: blur(6px);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            pointer-events: none;
            z-index: 5;
        }

        .play-button-overlay svg {
            width: 24px;
            height: 24px;
            fill: var(--accent-pink);
            margin-left: 4px;
        }

        /* Decorative Floating Badges */
        .badge-hash {
            position: absolute;
            top: 40px;
            right: 0;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background-color: var(--accent-green);
            border: 4px solid #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            font-weight: 700;
            color: #ffffff;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            transform: rotate(-10deg);
            z-index: 10;
        }

        .badge-bell {
            position: absolute;
            top: 130px;
            right: -25px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: var(--accent-pink);
            border: 4px solid #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            z-index: 10;
        }

        .hero-right {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .hero-right h1 {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            font-weight: 600;
            line-height: 1.15;
            color: var(--text-dark);
        }

        .hero-right .subheading {
            font-size: 1.15rem;
            color: var(--text-muted);
            line-height: 1.6;
        }

        .hero-bullets {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-top: 1rem;
        }

        .bullet-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
        }

        .bullet-icon {
            font-size: 1.25rem;
            line-height: 1.2;
            flex-shrink: 0;
        }
        
        .bullet-icon.pink { color: var(--accent-pink); }
        .bullet-icon.blue { color: var(--accent-blue); }

        .bullet-text strong {
            font-weight: 700;
            color: var(--text-dark);
            text-decoration: underline;
            text-underline-offset: 4px;
            text-decoration-color: var(--accent-pink);
            margin-right: 0.25rem;
        }

        .bullet-text p {
            display: inline;
            color: var(--text-muted);
        }

        /* Video / Projects Grid Section */
        .projects-section {
            padding: 7rem 0;
            background-color: var(--bg-cream);
        }

        .section-header {
            text-align: center;
            max-width: 800px;
            margin: 0 auto 4.5rem auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }

        .section-badge {
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.15em;
            color: var(--text-muted);
            border: 1px solid var(--text-muted);
            padding: 0.4rem 1.2rem;
            border-radius: 50px;
            text-transform: uppercase;
        }

        .section-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2.75rem;
            font-weight: 600;
            line-height: 1.2;
            color: var(--text-dark);
        }

        .section-header h2 span {
            color: var(--accent-green);
            position: relative;
        }

        .section-header .subtitle {
            color: var(--text-muted);
            font-size: 1.05rem;
        }

        .section-icon-divider {
            color: var(--accent-pink);
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        /* Dashed Cream Cards Grid */
        .projects-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2.5rem;
        }

        .project-card {
            background-color: var(--bg-cream);
            border: 1.5px dashed #E2D3CA;
            border-radius: 24px;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
            transition: all 0.3s ease;
        }

        .project-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(226, 211, 202, 0.25);
            border-color: var(--accent-pink);
        }

        .card-img-container {
            width: 100%;
            height: 280px;
            border-radius: 18px;
            overflow: hidden;
            position: relative;
        }

        .card-img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }

        .project-card:hover .card-img-container img {
            transform: scale(1.02);
        }

        .project-category {
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }
        
        .project-category.pink { color: var(--accent-pink); }
        .project-category.green { color: var(--accent-green); }

        .project-card h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        /* Bullet details inside cards */
        .card-bullets {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: center;
            margin-top: auto;
        }

        .card-bullet {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.85rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .card-bullet span {
            color: var(--accent-pink);
        }

        /* YouTube Promo Banner */
        .promo-banner {
            background-size: cover;
            background-position: center;
            position: relative;
            padding: 8rem 0;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .promo-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(31, 36, 33, 0.75);
            z-index: 1;
        }

        .promo-content {
            position: relative;
            z-index: 2;
            max-width: 700px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.5rem;
            color: #ffffff;
        }

        .promo-icon {
            width: 76px;
            height: 76px;
            background-color: #ffffff;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            color: var(--accent-green);
        }

        .promo-content h2 {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            font-weight: 600;
            line-height: 1.2;
        }

        .promo-content h2 span {
            color: var(--accent-pink);
        }

        .promo-content p {
            font-size: 1.1rem;
            color: #E2E8F0;
            opacity: 0.9;
        }

        .promo-btn {
            background-color: var(--accent-green);
            color: var(--text-dark);
            text-decoration: none;
            font-weight: 600;
            padding: 0.85rem 2.2rem;
            border-radius: 50px;
            font-size: 0.9rem;
            letter-spacing: 0.05em;
            transition: all 0.2s ease;
            box-shadow: 0 10px 20px rgba(160, 200, 80, 0.3);
            border: 2px solid transparent;
        }

        .promo-btn:hover {
            background-color: #ffffff;
            color: var(--text-dark);
            box-shadow: 0 10px 25px rgba(255, 255, 255, 0.4);
            transform: translateY(-2px);
        }

        /* Contact Section */
        .contact-section {
            background-color: var(--bg-blush);
            padding: 6rem 0;
        }

        .contact-card {
            background-color: var(--bg-cream);
            border-radius: 30px;
            padding: 4rem 3rem;
            max-width: 760px;
            margin: 0 auto;
            box-shadow: 0 20px 40px rgba(226, 211, 202, 0.3);
        }

        .contact-title {
            text-align: center;
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 600;
            margin-bottom: 2.5rem;
            color: var(--text-dark);
        }

        .contact-form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .form-group label {
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
            font-family: 'Playfair Display', serif;
            font-style: italic;
        }

        .form-control {
            padding: 1rem;
            border: 1.5px solid #E2D3CA;
            border-radius: 12px;
            background-color: var(--bg-cream);
            font-size: 0.95rem;
            color: var(--text-dark);
            outline: none;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: var(--accent-pink);
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(245, 146, 171, 0.1);
        }

        .submit-btn {
            background-color: var(--text-dark);
            color: #ffffff;
            border: none;
            padding: 1.1rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: 1rem;
        }

        .submit-btn:hover {
            background-color: var(--accent-pink);
            color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 10px 20px rgba(245, 146, 171, 0.2);
        }

        /* Footer */
        .footer {
            background-color: var(--text-dark);
            color: #ffffff;
            padding: 4rem 0;
            text-align: center;
        }

        .footer-logo {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            margin-bottom: 1.5rem;
        }

        .footer-logo span {
            color: var(--accent-pink);
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 2.5rem;
            list-style: none;
            margin-bottom: 2rem;
        }

        .footer-link {
            color: #E2E8F0;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.2s ease;
        }

        .footer-link:hover {
            color: var(--accent-pink);
        }

        .footer p {
            font-size: 0.85rem;
            color: #94A3B8;
            opacity: 0.8;
        }

        @media (max-width: 968px) {
            .hero-grid {
                grid-template-columns: 1fr;
                gap: 3rem;
                text-align: center;
            }
            .hero-left {
                order: -1;
            }
            .portrait-wrapper {
                width: 320px;
                height: 320px;
            }
            .badge-hash {
                width: 54px;
                height: 54px;
                font-size: 1.6rem;
            }
            .badge-bell {
                width: 40px;
                height: 40px;
                right: -10px;
            }
            .projects-grid {
                grid-template-columns: 1fr;
            }
            .form-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <!-- Top Navigation Bar -->
    <nav class="navbar">
        <div class="container navbar-inner">
            <a href="#" class="navbar-logo">
                #{{ strtoupper($portfolio->title ?? 'Emma') }}<span>.</span>
            </a>
            
            <ul class="navbar-links">
                <li><a href="#" class="navbar-link" data-editable="social_links.custom_texts.nav_1">{{ $portfolio->social_links['custom_texts']['nav_1'] ?? 'My Vlog' }}</a></li>
                <li><a href="#" class="navbar-link" data-editable="social_links.custom_texts.nav_2">{{ $portfolio->social_links['custom_texts']['nav_2'] ?? 'My Story' }}</a></li>
                <li><a href="#" class="navbar-link" data-editable="social_links.custom_texts.nav_3">{{ $portfolio->social_links['custom_texts']['nav_3'] ?? 'Collaboration' }}</a></li>
                <li><a href="#" class="navbar-link" data-editable="social_links.custom_texts.nav_4">{{ $portfolio->social_links['custom_texts']['nav_4'] ?? 'Socials' }}</a></li>
                <li><a href="#contact" class="navbar-link" data-editable="social_links.custom_texts.nav_5">{{ $portfolio->social_links['custom_texts']['nav_5'] ?? 'Contacts' }}</a></li>
            </ul>

            <div class="navbar-socials">
                <a href="#" class="social-icon-btn">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.163a3.003 3.003 0 0 0-2.11-2.11C19.518 3.545 12 3.545 12 3.545s-7.518 0-9.388.507a3.003 3.003 0 0 0-2.11 2.11C0 8.033 0 12 0 12s0 3.967.502 5.837a3.003 3.003 0 0 0 2.11 2.11C4.482 20.455 12 20.455 12 20.455s7.518 0 9.388-.507a3.003 3.003 0 0 0 2.11-2.11C24 15.967 24 12 24 12s0-3.967-.502-5.837zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                </a>
                <a href="#" class="social-icon-btn">
                    <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557a9.83 9.83 0 0 1-2.828.775 4.932 4.932 0 0 0 2.165-2.724 9.864 9.864 0 0 1-3.127 1.195 4.916 4.916 0 0 0-3.594-1.555c-3.179 0-5.515 2.966-4.797 6.045A13.978 13.978 0 0 1 1.671 3.149a4.93 4.93 0 0 0 1.523 6.574 4.903 4.903 0 0 1-2.229-.616c-.054 2.281 1.581 4.415 3.949 4.89a4.935 4.935 0 0 1-2.224.084 4.928 4.928 0 0 0 4.6 3.417A9.867 9.867 0 0 1 0 19.54a13.94 13.94 0 0 0 7.548 2.212c9.142 0 14.307-7.721 13.995-14.646A10.025 10.025 0 0 0 24 4.557z"/></svg>
                </a>
                <a href="#" class="social-icon-btn">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1V12h3v3h-3v6.8c4.56-.93 8-4.96 8-9.8z"/></svg>
                </a>
                <a href="#" class="social-icon-btn">
                    <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.03 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.17-2.86-.6-4.12-1.3-.1 1.87-.01 3.73-.01 5.6 0 2.22-.51 4.56-2.09 6.16-1.68 1.77-4.19 2.5-6.56 2.25-2.75-.24-5.32-2.02-6.39-4.57-1.22-2.73-.77-6.19 1.18-8.49 1.67-2.03 4.4-2.92 6.96-2.24v4.13c-1.39-.41-2.97-.04-4 1 .86 1.95 3.32 2.5 4.88 1.18.52-.51.81-1.22.82-1.93.02-3.13.01-6.27.01-9.4z"/></svg>
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Header Section -->
    <header class="hero">
        <div class="container hero-grid">
            <div class="hero-left">
                <div class="portrait-wrapper">
                    <div class="portrait-frame">
                        <img src="{{ $portfolio->avatar ?? 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=600&h=600&q=80' }}" data-editable-img="avatar">
                        <!-- Play Button Overlay -->
                        <div class="play-button-overlay">
                            <svg viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </div>
                    <!-- Badges -->
                    <div class="badge-hash">#</div>
                    <div class="badge-bell">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    </div>
                </div>
            </div>

            <div class="hero-right">
                <h1 data-editable="title">Welcome to {{ $portfolio->title ?? 'Emma Holistic' }}</h1>
                <div class="subheading" data-editable="bio">
                    {{ $portfolio->bio ?? 'Through nourishing recipes, mindful movement, and sustainable practices, I share my journey of balanced and healthy living.' }}
                </div>
                
                <div class="hero-bullets">
                    <div class="bullet-item">
                        <span class="bullet-icon pink">🌸</span>
                        <div class="bullet-text">
                            <strong data-editable="social_links.custom_texts.bullet_1_title">{{ $portfolio->social_links['custom_texts']['bullet_1_title'] ?? 'Explore:' }}</strong>
                            <p data-editable="social_links.custom_texts.bullet_1_desc">{{ $portfolio->social_links['custom_texts']['bullet_1_desc'] ?? 'Learn how to live healthier with my curated content designed to uplift and empower you.' }}</p>
                        </div>
                    </div>
                    <div class="bullet-item">
                        <span class="bullet-icon blue">🌸</span>
                        <div class="bullet-text">
                            <strong data-editable="social_links.custom_texts.bullet_2_title">{{ $portfolio->social_links['custom_texts']['bullet_2_title'] ?? 'Learn:' }}</strong>
                            <p data-editable="social_links.custom_texts.bullet_2_desc">{{ $portfolio->social_links['custom_texts']['bullet_2_desc'] ?? 'Access in-depth tutorials, tips, and guides tailored to help you live your happiest life.' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Selected Video Content Grid -->
    <section class="projects-section">
        <div class="container">
            <div class="section-header">
                <span class="section-icon-divider">🌸</span>
                <span class="section-badge" data-editable="social_links.custom_texts.projects_badge">{{ $portfolio->social_links['custom_texts']['projects_badge'] ?? 'Video Content' }}</span>
                <h2 data-editable="social_links.custom_texts.projects_title">{{ $portfolio->social_links['custom_texts']['projects_title'] ?? 'Discover the New You: Health, Beauty, Lifestyle - Subscribe' }}</h2>
                <p class="subtitle" data-editable="social_links.custom_texts.projects_desc">{{ $portfolio->social_links['custom_texts']['projects_desc'] ?? 'Integrate the holistic approach to your routine with me.' }}</p>
            </div>

            <div class="projects-grid">
                @if($portfolio->projects && count($portfolio->projects) > 0)
                    @foreach($portfolio->projects as $index => $project)
                        <div class="project-card">
                            <div class="card-img-container">
                                <img src="{{ $project['image'] ?? 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=600&h=400&q=80' }}" data-editable-img="projects.{{ $index }}.image">
                                <!-- Translucent Play Button overlay -->
                                <div class="play-button-overlay">
                                    <svg viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                </div>
                            </div>
                            <span class="project-category {{ $index % 2 === 0 ? 'pink' : 'green' }}">{{ $index % 2 === 0 ? 'Beauty' : 'Lifestyle' }}</span>
                            <h3 data-editable="projects.{{ $index }}.title">{{ $project['title'] }}</h3>
                            
                            <!-- Custom formatted bullet points inside card description -->
                            <div class="card-bullets" data-editable="projects.{{ $index }}.description">
                                @php
                                    $bullets = explode('•', $project['description']);
                                @endphp
                                @foreach($bullets as $bullet)
                                    @if(trim($bullet))
                                        <div class="card-bullet">
                                            <span>🌸</span> {{ trim($bullet) }}
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Fallback placeholder cards if no projects exist yet -->
                    <div class="project-card">
                        <div class="card-img-container">
                            <img src="https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?auto=format&fit=crop&w=600&h=400&q=80">
                            <div class="play-button-overlay"><svg viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg></div>
                        </div>
                        <span class="project-category pink">Beauty</span>
                        <h3>Feel Beautiful Inside and Out</h3>
                        <div class="card-bullets">
                            <div class="card-bullet"><span>🌸</span> Tutorials</div>
                            <div class="card-bullet"><span>🌸</span> Unpacking</div>
                            <div class="card-bullet"><span>🌸</span> Honest Reviews</div>
                        </div>
                    </div>

                    <div class="project-card">
                        <div class="card-img-container">
                            <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=600&h=400&q=80">
                            <div class="play-button-overlay"><svg viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg></div>
                        </div>
                        <span class="project-category green">Lifestyle</span>
                        <h3>Holistic Approach in Everything</h3>
                        <div class="card-bullets">
                            <div class="card-bullet"><span>🌸</span> Amazon Picks</div>
                            <div class="card-bullet"><span>🌸</span> Everyday Life</div>
                            <div class="card-bullet"><span>🌸</span> Useful Tips</div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- YouTube Call to Action Banner -->
    <section class="promo-banner" style="background-image: url('{{ $portfolio->banner ?? 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?auto=format&fit=crop&w=1200&h=600&q=80' }}');">
        <div class="promo-content">
            <div class="promo-icon">
                <svg width="34" height="34" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
            </div>
            <h2 data-editable="social_links.custom_texts.promo_title">{{ $portfolio->social_links['custom_texts']['promo_title'] ?? 'Subscribe to My YouTube Channel' }}</h2>
            <p data-editable="social_links.custom_texts.promo_desc">{{ $portfolio->social_links['custom_texts']['promo_desc'] ?? "Don't miss out on the latest yoga routines, beauty tips, and lifestyle inspiration." }}</p>
            <a href="#" class="promo-btn" data-editable="social_links.custom_texts.promo_btn">{{ $portfolio->social_links['custom_texts']['promo_btn'] ?? 'Subscribe Now' }}</a>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="contact-section" id="contact">
        <div class="container">
            <div class="contact-card">
                <h2 class="contact-title" data-editable="social_links.custom_texts.contact_title">{{ $portfolio->social_links['custom_texts']['contact_title'] ?? "Let's Collaborate" }}</h2>
                
                @if(session('success'))
                    <div style="background: #ECFDF5; border: 1px solid #10B981; color: #065F46; padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem; text-align: center; font-weight: 500;">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('portfolio.inquiry', $portfolio->slug) }}" method="POST" class="contact-form">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Your Name</label>
                            <input type="text" name="client_name" required class="form-control" placeholder="Jane Doe" {{ ($isEditing ?? false) ? 'disabled' : '' }}>
                        </div>
                        <div class="form-group">
                            <label>Your Email</label>
                            <input type="email" name="client_email" required class="form-control" placeholder="jane@example.com" {{ ($isEditing ?? false) ? 'disabled' : '' }}>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Subject</label>
                        <input type="text" name="subject" required class="form-control" placeholder="Collaboration / Inquiry" {{ ($isEditing ?? false) ? 'disabled' : '' }}>
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea name="message" rows="5" required class="form-control" placeholder="Write your message here..." {{ ($isEditing ?? false) ? 'disabled' : '' }}></textarea>
                    </div>
                    
                    <button type="submit" class="submit-btn" {{ ($isEditing ?? false) ? 'disabled' : '' }}>
                        {{ ($isEditing ?? false) ? 'Inquiry Form (Disabled in Editor)' : 'Send Message' }}
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-logo">
                #{{ strtoupper($portfolio->title ?? 'Emma') }}<span>.</span>
            </div>
            <ul class="footer-links">
                <li><a href="#" class="footer-link" data-editable="social_links.custom_texts.nav_1">{{ $portfolio->social_links['custom_texts']['nav_1'] ?? 'My Vlog' }}</a></li>
                <li><a href="#" class="footer-link" data-editable="social_links.custom_texts.nav_2">{{ $portfolio->social_links['custom_texts']['nav_2'] ?? 'My Story' }}</a></li>
                <li><a href="#" class="footer-link" data-editable="social_links.custom_texts.nav_3">{{ $portfolio->social_links['custom_texts']['nav_3'] ?? 'Collaboration' }}</a></li>
                <li><a href="#" class="footer-link" data-editable="social_links.custom_texts.nav_4">{{ $portfolio->social_links['custom_texts']['nav_4'] ?? 'Socials' }}</a></li>
            </ul>
            <p>&copy; {{ date('Y') }} {{ $portfolio->title ?? 'Emma' }}. <span data-editable="social_links.custom_texts.copyright">{{ $portfolio->social_links['custom_texts']['copyright'] ?? 'All rights reserved.' }}</span></p>
        </div>
    </footer>

</body>
</html>
