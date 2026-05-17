<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $portfolio->title }} - Architect Portfolio</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Share+Tech+Mono&display=swap" rel="stylesheet">
    @php
        $theme = $portfolio->theme_color ?? 'default';
        $textDark = '#111111';
        $accentSage = '#7E8F7A';
        
        if ($theme === 'gray') {
            $textDark = '#374151';
            $accentSage = '#6B7280';
        } elseif ($theme === 'sand') {
            $textDark = '#2D2522';
            $accentSage = '#C6AC8F';
        }
    @endphp
    <style>
        :root {
            --bg-primary: #FAF9F6;
            --bg-white: #ffffff;
            --text-dark: {{ $textDark }};
            --text-muted: #6B7280;
            --accent-sage: {{ $accentSage }};
            --font-mono: 'Share Tech Mono', Courier, monospace;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            color: var(--text-dark);
            background-color: var(--bg-white);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2.5rem;
        }

        /* Header block */
        .main-header {
            padding: 2.5rem 0 1rem 0;
            background-color: var(--bg-white);
        }

        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1.5px solid #EAEAEA;
            padding-bottom: 2rem;
            margin-bottom: 1.5rem;
        }

        .brand-logo-group {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: var(--text-dark);
            text-decoration: none;
        }

        .logo-icon {
            width: 44px;
            height: 44px;
            color: var(--accent-sage);
        }

        .logo-text h1 {
            font-size: 1.35rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            line-height: 1.1;
        }

        .logo-text p {
            font-family: var(--font-mono);
            font-size: 0.75rem;
            color: var(--text-muted);
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .header-contact {
            display: flex;
            gap: 3rem;
        }

        .contact-item {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .contact-item span {
            font-family: var(--font-mono);
            font-size: 0.7rem;
            color: var(--text-muted);
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .contact-item a, .contact-item p {
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--text-dark);
            text-decoration: none;
        }

        /* Nav row */
        .nav-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
        }

        .nav-links {
            display: flex;
            gap: 2.5rem;
            list-style: none;
        }

        .nav-link {
            text-decoration: none;
            color: var(--text-muted);
            font-weight: 500;
            font-size: 0.9rem;
            transition: color 0.2s ease;
        }

        .nav-link:hover {
            color: var(--accent-sage);
        }

        .nav-socials {
            display: flex;
            gap: 0.5rem;
        }

        .social-box {
            width: 32px;
            height: 32px;
            background-color: #ECEFEA;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            color: var(--accent-sage);
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .social-box:hover {
            background-color: var(--accent-sage);
            color: #ffffff;
            transform: translateY(-2px);
        }

        /* Hero Architect Section */
        .hero {
            background-color: var(--bg-primary);
            padding: 5rem 0;
            position: relative;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .hero-left {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            align-items: flex-start;
        }

        .hero-left h2 {
            font-size: 4rem;
            font-weight: 800;
            line-height: 1.1;
            color: var(--text-dark);
            letter-spacing: -0.02em;
        }

        .hero-left .subtitle {
            font-family: var(--font-mono);
            font-size: 1.15rem;
            color: var(--text-muted);
            margin-bottom: 1.5rem;
        }

        .hero-btn {
            border: 1.5px solid var(--text-dark);
            background: none;
            color: var(--text-dark);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 0.9rem 2.5rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            transition: all 0.2s ease;
        }

        .hero-btn:hover {
            background-color: var(--text-dark);
            color: var(--bg-white);
        }

        .hero-right {
            display: flex;
            justify-content: flex-end;
        }

        .architect-portrait-frame {
            width: 100%;
            max-width: 440px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0,0,0,0.05);
        }

        .architect-portrait-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* Top Capabilities bar */
        .capabilities-bar {
            background-color: var(--bg-white);
            padding: 5rem 0;
            border-bottom: 1.5px solid #F0F0F0;
        }

        .capabilities-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2.5rem;
        }

        .capability-card {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .capability-icon {
            width: 40px;
            height: 40px;
            color: var(--accent-sage);
        }

        .capability-card h3 {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .capability-card h3 span {
            color: var(--accent-sage);
            margin-left: 0.25rem;
        }

        .capability-card p {
            font-size: 0.9rem;
            color: var(--text-muted);
            line-height: 1.6;
        }

        /* About Section (A Few Words) */
        .about-section {
            padding: 7rem 0;
            background-color: var(--bg-white);
        }

        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 5rem;
            align-items: center;
        }

        .about-img-box {
            width: 100%;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.06);
        }

        .about-img-box img {
            width: 100%;
            display: block;
            object-fit: cover;
        }

        .about-content {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .about-content h2 {
            font-size: 3rem;
            font-weight: 800;
            color: var(--text-dark);
            line-height: 1.15;
        }

        .about-content .sub {
            font-family: var(--font-mono);
            font-size: 1.1rem;
            color: var(--accent-sage);
        }

        .about-content .desc {
            font-size: 1.05rem;
            color: var(--text-muted);
            margin-bottom: 1.5rem;
        }

        .about-bullets-title {
            font-family: var(--font-mono);
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .about-checkmarks {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .checkmark-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--text-dark);
        }

        .checkmark-item span {
            color: var(--accent-sage);
            font-weight: 700;
        }

        /* Timeline index */
        .timeline-section {
            padding: 6rem 0;
            background-color: var(--bg-primary);
            border-top: 1px solid #EAEAEA;
            border-bottom: 1px solid #EAEAEA;
        }

        .timeline-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
        }

        .timeline-item {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .timeline-number {
            font-family: var(--font-mono);
            font-size: 0.8rem;
            color: var(--text-muted);
            letter-spacing: 0.05em;
        }

        .timeline-year {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--accent-sage);
            line-height: 1;
        }

        .timeline-title {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .timeline-title span {
            color: var(--accent-sage);
            margin-left: 0.25rem;
        }

        .timeline-desc {
            font-size: 0.85rem;
            color: var(--text-muted);
            line-height: 1.6;
        }

        /* Selected Works Grid */
        .works-section {
            padding: 7rem 0;
            background-color: var(--bg-white);
        }

        .works-header {
            margin-bottom: 4rem;
        }

        .works-header h2 {
            font-size: 3.5rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .works-header p {
            font-family: var(--font-mono);
            font-size: 1.05rem;
            color: var(--text-muted);
        }

        .works-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 3rem;
        }

        .work-card {
            background-color: var(--bg-white);
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
            transition: all 0.3s ease;
        }

        .work-card:hover {
            transform: translateY(-4px);
        }

        .work-img-frame {
            width: 100%;
            height: 320px;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.04);
        }

        .work-img-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }

        .work-card:hover .work-img-frame img {
            transform: scale(1.02);
        }

        .work-card h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .work-card p {
            font-size: 0.95rem;
            color: var(--text-muted);
            line-height: 1.6;
        }

        .work-link {
            font-family: var(--font-mono);
            font-size: 0.85rem;
            color: var(--accent-sage);
            text-decoration: none;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .work-link:hover {
            text-decoration: underline;
        }

        /* Contact Section */
        .contact-section {
            background-color: var(--bg-primary);
            padding: 7rem 0;
            border-top: 1.5px solid #F0F0F0;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 5rem;
        }

        .contact-info-panel h2 {
            font-size: 3rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 1.5rem;
        }

        .contact-info-panel p {
            font-size: 1.05rem;
            color: var(--text-muted);
            margin-bottom: 2.5rem;
        }

        .minimal-form {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }

        .minimal-input {
            width: 100%;
            background: none;
            border: none;
            border-bottom: 1.5px solid #CCCCCC;
            padding: 0.75rem 0;
            font-size: 1rem;
            outline: none;
            color: var(--text-dark);
            transition: all 0.2s ease;
        }

        .minimal-input:focus {
            border-color: var(--accent-sage);
        }

        .minimal-form button {
            background-color: var(--text-dark);
            color: var(--bg-white);
            border: none;
            padding: 1.1rem;
            font-weight: 600;
            font-size: 0.9rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: 1rem;
            align-self: flex-start;
        }

        .minimal-form button:hover {
            background-color: var(--accent-sage);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(126, 143, 122, 0.25);
        }

        /* Footer */
        .footer {
            background-color: var(--text-dark);
            color: var(--bg-white);
            padding: 4rem 0;
            text-align: center;
        }

        .footer-logo {
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            margin-bottom: 2rem;
        }

        .footer-logo span {
            color: var(--accent-sage);
        }

        .footer p {
            font-size: 0.85rem;
            color: #94A3B8;
            opacity: 0.7;
        }

        @media (max-width: 968px) {
            .hero-grid, .about-grid, .contact-grid {
                grid-template-columns: 1fr;
                gap: 3rem;
            }
            .capabilities-grid, .timeline-grid, .works-grid {
                grid-template-columns: 1fr 1fr;
            }
            .header-top {
                flex-direction: column;
                gap: 1.5rem;
                align-items: flex-start;
            }
            .header-contact {
                width: 100%;
                justify-content: space-between;
            }
            .nav-row {
                flex-direction: column;
                gap: 1.5rem;
                align-items: flex-start;
            }
            .hero-right {
                justify-content: center;
                order: -1;
            }
        }

        @media (max-width: 640px) {
            .capabilities-grid, .timeline-grid, .works-grid {
                grid-template-columns: 1fr;
            }
            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <!-- Header bar -->
    <header class="main-header">
        <div class="container">
            <div class="header-top">
                <a href="#" class="brand-logo-group">
                    <svg class="logo-icon" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"/></svg>
                    <div class="logo-text">
                        <h1>{{ $portfolio->title ?? 'Adam Smith' }}</h1>
                        <p data-editable="social_links.custom_texts.logo_bio">{{ $portfolio->social_links['custom_texts']['logo_bio'] ?? 'architect & designer' }}</p>
                    </div>
                </a>

                <div class="header-contact">
                    <div class="contact-item">
                        <span data-editable="social_links.custom_texts.hdr_contact_email_label">{{ $portfolio->social_links['custom_texts']['hdr_contact_email_label'] ?? 'Write Me' }}</span>
                        <a href="mailto:{{ $portfolio->social_links['custom_texts']['hdr_contact_email'] ?? 'adamsmith@email.com' }}" data-editable="social_links.custom_texts.hdr_contact_email">{{ $portfolio->social_links['custom_texts']['hdr_contact_email'] ?? 'adamsmith@email.com' }}</a>
                    </div>
                    <div class="contact-item">
                        <span data-editable="social_links.custom_texts.hdr_contact_phone_label">{{ $portfolio->social_links['custom_texts']['hdr_contact_phone_label'] ?? 'Call Me' }}</span>
                        <p data-editable="social_links.custom_texts.hdr_contact_phone">{{ $portfolio->social_links['custom_texts']['hdr_contact_phone'] ?? '+1 (234) 567 89 00' }}</p>
                    </div>
                </div>
            </div>

            <!-- Lower nav row -->
            <div class="nav-row">
                <ul class="nav-links">
                    <li><a href="#" class="nav-link" data-editable="social_links.custom_texts.nav_1">{{ $portfolio->social_links['custom_texts']['nav_1'] ?? 'About Me' }}</a></li>
                    <li><a href="#works" class="nav-link" data-editable="social_links.custom_texts.nav_2">{{ $portfolio->social_links['custom_texts']['nav_2'] ?? 'Featured Projects' }}</a></li>
                    <li><a href="#" class="nav-link" data-editable="social_links.custom_texts.nav_3">{{ $portfolio->social_links['custom_texts']['nav_3'] ?? 'Testimonials' }}</a></li>
                    <li><a href="#contact" class="nav-link" data-editable="social_links.custom_texts.nav_4">{{ $portfolio->social_links['custom_texts']['nav_4'] ?? 'Contact Me' }}</a></li>
                </ul>

                <div class="nav-socials">
                    <a href="#" class="social-box">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/></svg>
                    </a>
                    <a href="#" class="social-box">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1V12h3v3h-3v6.8c4.56-.93 8-4.96 8-9.8z"/></svg>
                    </a>
                    <a href="#" class="social-box">
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557a9.83 9.83 0 0 1-2.828.775 4.932 4.932 0 0 0 2.165-2.724 9.864 9.864 0 0 1-3.127 1.195 4.916 4.916 0 0 0-3.594-1.555c-3.179 0-5.515 2.966-4.797 6.045A13.978 13.978 0 0 1 1.671 3.149a4.93 4.93 0 0 0 1.523 6.574 4.903 4.903 0 0 1-2.229-.616c-.054 2.281 1.581 4.415 3.949 4.89a4.935 4.935 0 0 1-2.224.084 4.928 4.928 0 0 0 4.6 3.417A9.867 9.867 0 0 1 0 19.54a13.94 13.94 0 0 0 7.548 2.212c9.142 0 14.307-7.721 13.995-14.646A10.025 10.025 0 0 0 24 4.557z"/></svg>
                    </a>
                    <a href="#" class="social-box">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.163a3.003 3.003 0 0 0-2.11-2.11C19.518 3.545 12 3.545 12 3.545s-7.518 0-9.388.507a3.003 3.003 0 0 0-2.11 2.11C0 8.033 0 12 0 12s0 3.967.502 5.837a3.003 3.003 0 0 0 2.11 2.11C4.482 20.455 12 20.455 12 20.455s7.518 0 9.388-.507a3.003 3.003 0 0 0 2.11-2.11C24 15.967 24 12 24 12s0-3.967-.502-5.837zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                    <a href="#" class="social-box">
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero section -->
    <section class="hero">
        <div class="container hero-grid">
            <div class="hero-left">
                <h2 data-editable="title">Hello, I'm {{ $portfolio->title ?? 'Adam' }}!</h2>
                <p class="subtitle" data-editable="bio">{{ $portfolio->bio ?? 'Licensed architect in New York -' }}</p>
                <a href="#contact" class="hero-btn" data-editable="social_links.custom_texts.hero_cta">{{ $portfolio->social_links['custom_texts']['hero_cta'] ?? 'Contact Me' }}</a>
            </div>

            <div class="hero-right">
                <div class="architect-portrait-frame">
                    <img src="{{ $portfolio->avatar ?? '/p12.png' }}" data-editable-img="avatar">
                </div>
            </div>
        </div>
    </section>

    <!-- Dynamic Capabilities / Services Row -->
    <section class="capabilities-bar">
        <div class="container capabilities-grid">
            <div class="capability-card">
                <svg class="capability-icon" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25"/></svg>
                <h3 data-editable="social_links.custom_texts.cap_1_title">{{ $portfolio->social_links['custom_texts']['cap_1_title'] ?? 'Prototyping' }}<span>—</span></h3>
                <p data-editable="social_links.custom_texts.cap_1_desc">{{ $portfolio->social_links['custom_texts']['cap_1_desc'] ?? 'I create the design project for your future home, office in the AutoCAD program.' }}</p>
            </div>
            <div class="capability-card">
                <svg class="capability-icon" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/></svg>
                <h3 data-editable="social_links.custom_texts.cap_2_title">{{ $portfolio->social_links['custom_texts']['cap_2_title'] ?? 'Space Planning' }}<span>—</span></h3>
                <p data-editable="social_links.custom_texts.cap_2_desc">{{ $portfolio->social_links['custom_texts']['cap_2_desc'] ?? 'I will help you plan your existing or new space in the best possible way.' }}</p>
            </div>
            <div class="capability-card">
                <svg class="capability-icon" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9s2.015-9 4.5-9m0 18c-4.97 0-9-4.03-9-9s4.03-9 9-9 9 4.03 9 9-4.03 9-9 9z"/></svg>
                <h3 data-editable="social_links.custom_texts.cap_3_title">{{ $portfolio->social_links['custom_texts']['cap_3_title'] ?? '3D Rendering' }}<span>—</span></h3>
                <p data-editable="social_links.custom_texts.cap_3_desc">{{ $portfolio->social_links['custom_texts']['cap_3_desc'] ?? 'A 3D render will help you to visually see and approve the offered design project.' }}</p>
            </div>
            <div class="capability-card">
                <svg class="capability-icon" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1M11.25 11.25h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm3-6h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm3-6h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"/></svg>
                <h3 data-editable="social_links.custom_texts.cap_4_title">{{ $portfolio->social_links['custom_texts']['cap_4_title'] ?? 'Commercial Property' }}<span>—</span></h3>
                <p data-editable="social_links.custom_texts.cap_4_desc">{{ $portfolio->social_links['custom_texts']['cap_4_desc'] ?? 'I develop design projects and supervise the construction of commercial buildings.' }}</p>
            </div>
        </div>
    </section>

    <!-- About Section with b11.png default architect house -->
    <section class="about-section">
        <div class="container about-grid">
            <div class="about-img-box">
                <img src="{{ $portfolio->banner ?? '/b11.png' }}" data-editable-img="banner">
            </div>

            <div class="about-content">
                <h2 data-editable="social_links.custom_texts.about_header">{{ $portfolio->social_links['custom_texts']['about_header'] ?? 'A Few Words About Me' }}</h2>
                <span class="sub" data-editable="social_links.custom_texts.about_sub">{{ $portfolio->social_links['custom_texts']['about_sub'] ?? 'Architecture driven by innovations —' }}</span>
                <div class="desc" data-editable="about_text">
                    {!! $portfolio->about_text ? nl2br(e($portfolio->about_text)) : "I'm a licensed architect and interior designer located in New York and working all over the USA. I believe in standard-setting structures built with high sustainability." !!}
                </div>

                <div class="about-bullets-title" data-editable="social_links.custom_texts.skills_title_label">{{ $portfolio->social_links['custom_texts']['skills_title_label'] ?? "I'm good at:" }}</div>
                <div class="about-checkmarks">
                    @if($portfolio->skills)
                        @foreach($portfolio->skills as $skill)
                            <div class="checkmark-item">
                                <span>✓</span> {{ $skill }}
                            </div>
                        @endforeach
                    @else
                        <div class="checkmark-item"><span>✓</span> Architecture</div>
                        <div class="checkmark-item"><span>✓</span> Interior Design</div>
                        <div class="checkmark-item"><span>✓</span> Building Design</div>
                        <div class="checkmark-item"><span>✓</span> 3D Rendering</div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Experience / Milestones Timeline -->
    <section class="timeline-section">
        <div class="container timeline-grid">
            <div class="timeline-item">
                <span class="timeline-number" data-editable="social_links.custom_texts.mile_1_number">{{ $portfolio->social_links['custom_texts']['mile_1_number'] ?? '01 \ EDUCATION' }}</span>
                <span class="timeline-year" data-editable="social_links.custom_texts.mile_1_year">{{ $portfolio->social_links['custom_texts']['mile_1_year'] ?? '2000' }}</span>
                <span class="timeline-title" data-editable="social_links.custom_texts.mile_1_title">{{ $portfolio->social_links['custom_texts']['mile_1_title'] ?? 'Bachelor of Architecture' }}<span>—</span></span>
                <p class="timeline-desc" data-editable="social_links.custom_texts.mile_1_desc">{{ $portfolio->social_links['custom_texts']['mile_1_desc'] ?? 'I graduated with a Bachelor of Architecture from New York Institute of Technology.' }}</p>
            </div>
            <div class="timeline-item">
                <span class="timeline-number" data-editable="social_links.custom_texts.mile_2_number">{{ $portfolio->social_links['custom_texts']['mile_2_number'] ?? '02 \ FIRST JOB' }}</span>
                <span class="timeline-year" data-editable="social_links.custom_texts.mile_2_year">{{ $portfolio->social_links['custom_texts']['mile_2_year'] ?? '2007' }}</span>
                <span class="timeline-title" data-editable="social_links.custom_texts.mile_2_title">{{ $portfolio->social_links['custom_texts']['mile_2_title'] ?? 'Apprentice Draftsman' }}<span>—</span></span>
                <p class="timeline-desc" data-editable="social_links.custom_texts.mile_2_desc">{{ $portfolio->social_links['custom_texts']['mile_2_desc'] ?? 'For 7 years, I had been working at Cooper and Sons, one of the best studios in NY.' }}</p>
            </div>
            <div class="timeline-item">
                <span class="timeline-number" data-editable="social_links.custom_texts.mile_3_number">{{ $portfolio->social_links['custom_texts']['mile_3_number'] ?? '03 \ UPGRADE' }}</span>
                <span class="timeline-year" data-editable="social_links.custom_texts.mile_3_year">{{ $portfolio->social_links['custom_texts']['mile_3_year'] ?? '2015' }}</span>
                <span class="timeline-title" data-editable="social_links.custom_texts.mile_3_title">{{ $portfolio->social_links['custom_texts']['mile_3_title'] ?? 'Started Freelancing' }}<span>—</span></span>
                <p class="timeline-desc" data-editable="social_links.custom_texts.mile_3_desc">{{ $portfolio->social_links['custom_texts']['mile_3_desc'] ?? 'Since 2015, I have been working as a freelancer with private and corporate clients.' }}</p>
            </div>
            <div class="timeline-item">
                <span class="timeline-number" data-editable="social_links.custom_texts.mile_4_number">{{ $portfolio->social_links['custom_texts']['mile_4_number'] ?? '04 \ AWARDS' }}</span>
                <span class="timeline-year" data-editable="social_links.custom_texts.mile_4_year">{{ $portfolio->social_links['custom_texts']['mile_4_year'] ?? '2024' }}</span>
                <span class="timeline-title" data-editable="social_links.custom_texts.mile_4_title">{{ $portfolio->social_links['custom_texts']['mile_4_title'] ?? 'The Best in Modern Design' }}<span>—</span></span>
                <p class="timeline-desc" data-editable="social_links.custom_texts.mile_4_desc">{{ $portfolio->social_links['custom_texts']['mile_4_desc'] ?? 'One of my recent projects received an award from AAS Arch for the best modern design.' }}</p>
            </div>
        </div>
    </section>

    <!-- Selected Works Grid (looping projects) -->
    <section class="works-section" id="works">
        <div class="container">
            <div class="works-header">
                <h2 data-editable="social_links.custom_texts.projects_title">{{ $portfolio->social_links['custom_texts']['projects_title'] ?? 'Top Services' }}</h2>
                <p data-editable="social_links.custom_texts.projects_desc">{{ $portfolio->social_links['custom_texts']['projects_desc'] ?? 'As a licensed architect and designer, I can help you create your dream home or office.' }}</p>
            </div>

            <div class="works-grid">
                @if($portfolio->projects && count($portfolio->projects) > 0)
                    @foreach($portfolio->projects as $index => $project)
                        <div class="work-card">
                            <div class="work-img-frame">
                                <img src="{{ $project['image'] ?? '/b12.png' }}" data-editable-img="projects.{{ $index }}.image">
                            </div>
                            <h3 data-editable="projects.{{ $index }}.title">{{ $project['title'] }}</h3>
                            <p data-editable="projects.{{ $index }}.description">{{ $project['description'] }}</p>
                            <a href="#" class="work-link">View Plan &rarr;</a>
                        </div>
                    @endforeach
                @else
                    <!-- Fallback seeder matches -->
                    <div class="work-card">
                        <div class="work-img-frame">
                            <img src="/b12.png">
                        </div>
                        <h3>Residential Design</h3>
                        <p>Detailed construction blueprints and high-fidelity wood-panel facades tailored for modern living.</p>
                        <a href="#" class="work-link">View Plan &rarr;</a>
                    </div>
                    <div class="work-card">
                        <div class="work-img-frame">
                            <img src="/b13.png">
                        </div>
                        <h3>Commercial Development</h3>
                        <p>Complete project supervision and structural optimization for mixed-use corporate buildings.</p>
                        <a href="#" class="work-link">View Plan &rarr;</a>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Minimal Contact Form Section -->
    <section class="contact-section" id="contact">
        <div class="container contact-grid">
            <div class="contact-info-panel">
                <h2 data-editable="social_links.custom_texts.contact_title">{{ $portfolio->social_links['custom_texts']['contact_title'] ?? 'Get In Touch' }}</h2>
                <p data-editable="social_links.custom_texts.contact_desc">{{ $portfolio->social_links['custom_texts']['contact_desc'] ?? 'Have an upcoming design project or need professional architectural consulting? Fill out the quick details and I will reply within 24 hours.' }}</p>
                <div class="contact-item" style="margin-bottom: 1.5rem;">
                    <span data-editable="social_links.custom_texts.hdr_contact_email_label">{{ $portfolio->social_links['custom_texts']['hdr_contact_email_label'] ?? 'Write Me' }}</span>
                    <a href="mailto:{{ $portfolio->social_links['custom_texts']['hdr_contact_email'] ?? 'adamsmith@email.com' }}" style="font-weight: 700; color: var(--accent-sage);" data-editable="social_links.custom_texts.hdr_contact_email">{{ $portfolio->social_links['custom_texts']['hdr_contact_email'] ?? 'adamsmith@email.com' }}</a>
                </div>
            </div>

            <div class="contact-form-panel">
                @if(session('success'))
                    <div style="background: #FAFAFA; border: 1.5px solid var(--accent-sage); color: var(--accent-sage); padding: 1rem; border-radius: 8px; margin-bottom: 2rem; font-weight: 600;">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('portfolio.inquiry', $portfolio->slug) }}" method="POST" class="minimal-form">
                    @csrf
                    <div class="form-row">
                        <input type="text" name="client_name" required placeholder="Name" class="minimal-input" {{ ($isEditing ?? false) ? 'disabled' : '' }}>
                        <input type="email" name="client_email" required placeholder="Email" class="minimal-input" {{ ($isEditing ?? false) ? 'disabled' : '' }}>
                    </div>
                    <input type="text" name="subject" required placeholder="Subject" class="minimal-input" {{ ($isEditing ?? false) ? 'disabled' : '' }}>
                    <textarea name="message" rows="3" required placeholder="Message" class="minimal-input" {{ ($isEditing ?? false) ? 'disabled' : '' }}></textarea>
                    
                    <button type="submit" {{ ($isEditing ?? false) ? 'disabled' : '' }}>
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
                {{ $portfolio->title ?? 'Adam Smith' }}<span>.</span>
            </div>
            <p>&copy; {{ date('Y') }} {{ $portfolio->title ?? 'Adam Smith' }}. <span data-editable="social_links.custom_texts.copyright">{{ $portfolio->social_links['custom_texts']['copyright'] ?? 'All rights reserved.' }}</span></p>
        </div>
    </footer>

</body>
</html>
