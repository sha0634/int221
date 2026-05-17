<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $portfolio->title }} - Interior Design Portfolio</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    @php
        $theme = $portfolio->theme_color ?? 'default';
        $accentPink = '#D81B60'; // Default pink-red
        
        if ($theme === 'dracula') {
            $accentPink = '#D4AF37'; // Champagne gold
        } elseif ($theme === 'monokai') {
            $accentPink = '#8A9A86'; // Sage green
        }
    @endphp
    <style>
        :root {
            --bg-dark: #121212;
            --bg-card: #1C1C1C;
            --bg-light: #ffffff;
            --text-light: #ffffff;
            --text-muted: #A0A0A0;
            --accent-pink: {{ $accentPink }};
            --font-serif: 'Playfair Display', serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            color: #333333;
            background-color: var(--bg-light);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* Top Header */
        .main-header {
            background-color: var(--bg-dark);
            padding: 1.5rem 0;
            position: relative;
            z-index: 10;
        }

        .header-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            color: var(--text-light);
        }

        .logo-circle {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: 2px dashed var(--accent-pink);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent-pink);
            font-size: 0.95rem;
            font-weight: 700;
        }

        .brand-text h1 {
            font-size: 1.15rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            line-height: 1.1;
        }

        .brand-text p {
            font-size: 0.65rem;
            color: var(--text-muted);
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 2rem;
            list-style: none;
        }

        .nav-link {
            text-decoration: none;
            color: var(--text-light);
            opacity: 0.85;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .nav-link:hover {
            color: var(--accent-pink);
            opacity: 1;
        }

        .portfolio-btn {
            border: 1.5px solid var(--text-light);
            color: var(--text-light);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.8rem;
            padding: 0.6rem 1.8rem;
            border-radius: 30px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            transition: all 0.2s ease;
        }

        .portfolio-btn:hover {
            background-color: var(--text-light);
            color: var(--bg-dark);
        }

        /* Hero Boutique Section */
        .hero {
            background-color: var(--bg-dark);
            background-image: linear-gradient(rgba(18, 18, 18, 0.8), rgba(18, 18, 18, 0.9)), url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1200&h=600&q=80');
            background-size: cover;
            background-position: center;
            padding: 8rem 0 10rem 0;
            position: relative;
            text-align: center;
            overflow: hidden;
        }

        /* Velvet Chair Floating Asset */
        .floating-chair {
            position: absolute;
            bottom: -30px;
            left: 2%;
            width: 320px;
            z-index: 5;
            pointer-events: none;
        }

        .floating-lamp {
            position: absolute;
            top: 0;
            left: 30%;
            width: 140px;
            z-index: 4;
            pointer-events: none;
        }

        .hero-content {
            position: relative;
            z-index: 6;
            max-width: 800px;
            margin: 0 auto;
            color: var(--text-light);
        }

        .hero-content h2 {
            font-family: var(--font-serif);
            font-size: 6rem;
            font-weight: 700;
            line-height: 1;
            margin-bottom: 1.5rem;
            letter-spacing: -0.01em;
        }

        .hero-content p {
            font-size: 1.25rem;
            color: var(--text-muted);
            margin-bottom: 3rem;
            font-weight: 300;
        }

        .hero-buttons {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 2rem;
        }

        .btn-primary {
            background-color: var(--accent-pink);
            color: var(--text-light);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 1rem 2.2rem;
            border-radius: 30px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            box-shadow: 0 10px 20px rgba(216, 27, 96, 0.3);
            transition: all 0.2s ease;
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 25px rgba(216, 27, 96, 0.4);
        }

        .btn-outline {
            border: 1.5px solid rgba(255, 255, 255, 0.4);
            color: var(--text-light);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 1rem 2.2rem;
            border-radius: 30px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s ease;
            background: none;
        }

        .btn-outline:hover {
            border-color: var(--text-light);
            background-color: rgba(255, 255, 255, 0.05);
        }

        .btn-outline svg {
            width: 18px;
            height: 18px;
            fill: currentColor;
        }

        /* Waves divider */
        .hero-waves {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
            transform: rotate(180deg);
            z-index: 3;
        }

        .hero-waves svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 80px;
        }

        .hero-waves .shape-fill {
            fill: var(--bg-light);
        }

        /* Section layout */
        .section-box {
            padding: 7rem 0;
            background-color: var(--bg-light);
        }

        .section-label {
            font-family: var(--font-serif);
            font-size: 0.95rem;
            font-style: italic;
            color: var(--accent-pink);
            margin-bottom: 0.5rem;
            display: block;
        }

        /* Services section */
        .services-grid {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 5rem;
        }

        .services-left h2 {
            font-family: var(--font-serif);
            font-size: 3rem;
            font-weight: 700;
            color: #1A1A1A;
            margin-bottom: 1.5rem;
            line-height: 1.1;
        }

        .services-left p {
            font-size: 1.05rem;
            color: #666666;
            margin-bottom: 2rem;
        }

        .accent-bar {
            width: 60px;
            height: 3px;
            background-color: var(--accent-pink);
            margin-bottom: 1rem;
        }

        .services-right {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2.5rem;
        }

        .service-card {
            background-color: #FDFDFD;
            border: 1px solid #F0F0F0;
            border-radius: 16px;
            padding: 2.2rem 1.8rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            transition: all 0.2s ease;
        }

        .service-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            border-color: var(--accent-pink);
        }

        .service-icon-circle {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background-color: #FAF4F6;
            color: var(--accent-pink);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .service-card h3 {
            font-size: 1.2rem;
            font-weight: 700;
            color: #1A1A1A;
        }

        .service-card p {
            font-size: 0.9rem;
            color: #666666;
            line-height: 1.6;
        }

        /* About Section (02 / About Me) */
        .about-section {
            background-color: #FCFCFC;
            border-top: 1px solid #F3F3F3;
            border-bottom: 1px solid #F3F3F3;
            padding: 7rem 0;
        }

        .about-grid {
            display: grid;
            grid-template-columns: 1.1fr 1fr;
            gap: 5rem;
            align-items: center;
        }

        .about-left {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            align-items: flex-start;
        }

        .about-left h2 {
            font-family: var(--font-serif);
            font-size: 2.8rem;
            font-weight: 700;
            color: #1A1A1A;
            line-height: 1.15;
        }

        .about-left .desc {
            font-size: 1rem;
            color: #666666;
            line-height: 1.7;
        }

        .about-right {
            display: flex;
            justify-content: center;
            position: relative;
        }

        .about-portrait-box {
            width: 100%;
            max-width: 440px;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.05);
        }

        .about-portrait-box img {
            width: 100%;
            display: block;
            object-fit: cover;
        }

        /* Brand discounts bar */
        .discounts-section {
            background-color: var(--bg-dark);
            color: var(--text-light);
            padding: 6rem 0;
        }

        .discounts-grid {
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 5rem;
            align-items: center;
        }

        .discounts-left h2 {
            font-family: var(--font-serif);
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 1rem;
        }

        .discounts-left p {
            color: var(--text-muted);
            font-size: 1rem;
        }

        .discounts-logos {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }

        .logo-box {
            background-color: var(--bg-card);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            padding: 2rem 1.5rem;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }

        .logo-icon-svg {
            width: 40px;
            height: 40px;
            color: var(--accent-pink);
        }

        .logo-box span {
            font-family: var(--font-serif);
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            color: var(--text-muted);
        }

        /* Recent Projects (04) */
        .projects-section {
            padding: 7rem 0;
            background-color: var(--bg-light);
        }

        .projects-header {
            margin-bottom: 4rem;
        }

        .projects-header h2 {
            font-family: var(--font-serif);
            font-size: 3rem;
            font-weight: 700;
            color: #1A1A1A;
            margin-bottom: 0.5rem;
        }

        .projects-header p {
            font-size: 1.05rem;
            color: #666666;
            max-width: 700px;
        }

        .projects-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
        }

        .project-item-card {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .project-img-box {
            width: 100%;
            height: 340px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.03);
        }

        .project-img-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .project-item-card:hover .project-img-box img {
            transform: scale(1.02);
        }

        .project-item-card h3 {
            font-size: 1.4rem;
            font-weight: 700;
            color: #1A1A1A;
        }

        .project-item-card p {
            font-size: 0.95rem;
            color: #666666;
            line-height: 1.6;
        }

        /* Contact minimal form */
        .contact-section {
            padding: 7rem 0;
            background-color: #FAF6F7;
            border-top: 1.5px solid #F3ECEF;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 5rem;
        }

        .contact-info h2 {
            font-family: var(--font-serif);
            font-size: 3rem;
            font-weight: 700;
            color: #1A1A1A;
            margin-bottom: 1.5rem;
        }

        .contact-info p {
            font-size: 1.05rem;
            color: #666666;
            margin-bottom: 2rem;
        }

        .contact-info-link {
            font-family: var(--font-serif);
            font-size: 1.25rem;
            color: var(--accent-pink);
            text-decoration: none;
            font-weight: 600;
        }

        .contact-form-box {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .contact-row-inputs {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }

        .boutique-input {
            width: 100%;
            background: none;
            border: none;
            border-bottom: 1.5px solid #D6C2C7;
            padding: 0.75rem 0;
            font-size: 1rem;
            outline: none;
            color: #1A1A1A;
            transition: all 0.2s ease;
        }

        .boutique-input:focus {
            border-color: var(--accent-pink);
        }

        .boutique-form-btn {
            background-color: var(--accent-pink);
            color: var(--text-light);
            border: none;
            padding: 1.1rem 2.5rem;
            font-weight: 600;
            font-size: 0.9rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            cursor: pointer;
            border-radius: 30px;
            box-shadow: 0 10px 20px rgba(216, 27, 96, 0.2);
            transition: all 0.2s ease;
            margin-top: 1rem;
            align-self: flex-start;
        }

        .boutique-form-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 25px rgba(216, 27, 96, 0.3);
        }

        /* Footer */
        .footer {
            background-color: var(--bg-dark);
            color: var(--text-light);
            padding: 4rem 0;
            text-align: center;
        }

        .footer-logo {
            font-family: var(--font-serif);
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .footer-logo span {
            color: var(--accent-pink);
        }

        .footer p {
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        @media (max-width: 968px) {
            .hero-grid, .services-grid, .about-grid, .discounts-grid, .contact-grid {
                grid-template-columns: 1fr;
                gap: 3.5rem;
            }
            .projects-row {
                grid-template-columns: 1fr;
            }
            .floating-chair {
                display: none;
            }
            .floating-lamp {
                display: none;
            }
            .hero-content h2 {
                font-size: 4rem;
            }
            .nav-links {
                display: none;
            }
        }

        @media (max-width: 640px) {
            .services-right {
                grid-template-columns: 1fr;
            }
            .contact-row-inputs {
                grid-template-columns: 1fr;
            }
            .hero-buttons {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>

    <!-- Header bar -->
    <header class="main-header">
        <div class="container header-inner">
            <a href="#" class="brand-logo">
                <div class="logo-circle" data-editable="social_links.custom_texts.logo_circle">{{ $portfolio->social_links['custom_texts']['logo_circle'] ?? 'M' }}</div>
                <div class="brand-text">
                    <h1>{{ $portfolio->title ?? 'Mary Dench' }}</h1>
                    <p data-editable="social_links.custom_texts.logo_bio">{{ $portfolio->social_links['custom_texts']['logo_bio'] ?? 'interior design' }}</p>
                </div>
            </a>

            <ul class="nav-links">
                <li><a href="#" class="nav-link" data-editable="social_links.custom_texts.nav_1">{{ $portfolio->social_links['custom_texts']['nav_1'] ?? 'About me' }}</a></li>
                <li><a href="#services" class="nav-link" data-editable="social_links.custom_texts.nav_2">{{ $portfolio->social_links['custom_texts']['nav_2'] ?? 'Services' }}</a></li>
                <li><a href="#discounts" class="nav-link" data-editable="social_links.custom_texts.nav_3">{{ $portfolio->social_links['custom_texts']['nav_3'] ?? 'Discounts' }}</a></li>
                <li><a href="#projects" class="nav-link" data-editable="social_links.custom_texts.nav_4">{{ $portfolio->social_links['custom_texts']['nav_4'] ?? 'Portfolio' }}</a></li>
                <li><a href="#contact" class="nav-link" data-editable="social_links.custom_texts.nav_5">{{ $portfolio->social_links['custom_texts']['nav_5'] ?? 'Contact me' }}</a></li>
                <li><a href="#projects" class="portfolio-btn" data-editable="social_links.custom_texts.nav_6">{{ $portfolio->social_links['custom_texts']['nav_6'] ?? 'Portfolio' }}</a></li>
            </ul>
        </div>
    </header>

    <!-- Hero boutique Concrete/Armchair section -->
    <section class="hero">

        <div class="container hero-content">
            <h2 data-editable="title">{{ $portfolio->title ?? 'Mary Dench' }}</h2>
            <p data-editable="bio">{{ $portfolio->bio ?? 'Professional interior designer in New York.' }}</p>
            
            <div class="hero-buttons">
                <a href="#contact" class="btn-primary" data-editable="social_links.custom_texts.hero_cta_1">{{ $portfolio->social_links['custom_texts']['hero_cta_1'] ?? 'Request a Quote' }}</a>
                <a href="#" class="btn-outline" style="display: inline-flex; align-items: center; gap: 0.5rem;">
                    <svg viewBox="0 0 24 24" style="width:16px; height:16px;"><path fill="currentColor" d="M8 5v14l11-7z"/></svg>
                    <span data-editable="social_links.custom_texts.hero_cta_2">{{ $portfolio->social_links['custom_texts']['hero_cta_2'] ?? 'Promo Video' }}</span>
                </a>
            </div>
        </div>

        <!-- Custom smooth wave divider -->
        <div class="hero-waves">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120 " preserveAspectRatio="none">
                <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" class="shape-fill"></path>
            </svg>
        </div>
    </section>

    <!-- Services Section (01) -->
    <section class="section-box" id="services">
        <div class="container services-grid">
            <div class="services-left">
                <span class="section-label" data-editable="social_links.custom_texts.services_label">{{ $portfolio->social_links['custom_texts']['services_label'] ?? '01 / Services' }}</span>
                <div class="accent-bar"></div>
                <h2 data-editable="social_links.custom_texts.services_title">{{ $portfolio->social_links['custom_texts']['services_title'] ?? 'Services' }}</h2>
                <p data-editable="social_links.custom_texts.services_desc">{{ $portfolio->social_links['custom_texts']['services_desc'] ?? 'My main goal is to make every square foot in your home beautiful and functional.' }}</p>
            </div>

            <div class="services-right">
                <div class="service-card">
                    <div class="service-icon-circle">
                        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1m-1.5-5.05h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"/></svg>
                    </div>
                    <h3 data-editable="social_links.custom_texts.service_1_title">{{ $portfolio->social_links['custom_texts']['service_1_title'] ?? 'Bedroom' }}</h3>
                    <p data-editable="social_links.custom_texts.service_1_desc">{{ $portfolio->social_links['custom_texts']['service_1_desc'] ?? 'A comfortable space styled precisely for your deep relaxation and mindfulness.' }}</p>
                </div>
                <div class="service-card">
                    <div class="service-icon-circle">
                        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
                    </div>
                    <h3 data-editable="social_links.custom_texts.service_2_title">{{ $portfolio->social_links['custom_texts']['service_2_title'] ?? 'Living Room' }}</h3>
                    <p data-editable="social_links.custom_texts.service_2_desc">{{ $portfolio->social_links['custom_texts']['service_2_desc'] ?? 'Enjoy cozy, beautiful evenings with your friends and family in open layouts.' }}</p>
                </div>
                <div class="service-card">
                    <div class="service-icon-circle">
                        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18a3.75 3.75 0 00.495-7.467 5.99 5.99 0 00-1.925 3.546 5.974 5.974 0 01-2.133-1A3.75 3.75 0 0012 18z"/></svg>
                    </div>
                    <h3 data-editable="social_links.custom_texts.service_3_title">{{ $portfolio->social_links['custom_texts']['service_3_title'] ?? 'Kitchen' }}</h3>
                    <p data-editable="social_links.custom_texts.service_3_desc">{{ $portfolio->social_links['custom_texts']['service_3_desc'] ?? 'Modern, dynamic, and highly functional spaces tailored to luxury gourmet prep.' }}</p>
                </div>
                <div class="service-card">
                    <div class="service-icon-circle">
                        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/></svg>
                    </div>
                    <h3 data-editable="social_links.custom_texts.service_4_title">{{ $portfolio->social_links['custom_texts']['service_4_title'] ?? 'Bathroom' }}</h3>
                    <p data-editable="social_links.custom_texts.service_4_desc">{{ $portfolio->social_links['custom_texts']['service_4_desc'] ?? 'Premium custom fixtures and warm vanity styles creating a spa-like retreat.' }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Me Section (02) -->
    <section class="about-section">
        <div class="container about-grid">
            <div class="about-left">
                <span class="section-label" data-editable="social_links.custom_texts.about_label">{{ $portfolio->social_links['custom_texts']['about_label'] ?? '02 / About Me' }}</span>
                <div class="accent-bar"></div>
                <h2 data-editable="social_links.custom_texts.about_title">{{ $portfolio->social_links['custom_texts']['about_title'] ?? "Hi, I'm Mary" }}</h2>
                <div class="desc" data-editable="about_text">
                    {!! $portfolio->about_text ? nl2br(e($portfolio->about_text)) : "Hi, I'm Mary and I'm an interior designer in New York. I carefully create spaces it's a real pleasure to live in. I have been working in this area for 5 years now, and create projects mainly in the minimalism, modern, boho styles. Click directly on any text on this page to edit and customize." !!}
                </div>
                <a href="#contact" class="btn-primary" data-editable="social_links.custom_texts.about_btn">{{ $portfolio->social_links['custom_texts']['about_btn'] ?? 'Learn More' }}</a>
            </div>

            <div class="about-right">
                <div class="about-portrait-box">
                    <img src="{{ $portfolio->avatar ?? '/p11.png' }}" data-editable-img="avatar">
                </div>
            </div>
        </div>
    </section>

    <!-- Discounts Section (03) -->
    <section class="discounts-section" id="discounts">
        <div class="container discounts-grid">
            <div class="discounts-left">
                <span class="section-label" data-editable="social_links.custom_texts.discounts_label">{{ $portfolio->social_links['custom_texts']['discounts_label'] ?? '03 / Discounts' }}</span>
                <div class="accent-bar"></div>
                <h2 data-editable="social_links.custom_texts.discounts_title">{{ $portfolio->social_links['custom_texts']['discounts_title'] ?? 'Exclusive Discounts' }}</h2>
                <p data-editable="social_links.custom_texts.discounts_desc">{{ $portfolio->social_links['custom_texts']['discounts_desc'] ?? 'I have direct strategic agreements on special pricing discounts with these premium manufacturers:' }}</p>
            </div>

            <div class="discounts-logos">
                <div class="logo-box">
                    <svg class="logo-icon-svg" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1"/></svg>
                    <span data-editable="social_links.custom_texts.brand_1">{{ $portfolio->social_links['custom_texts']['brand_1'] ?? 'Home Furniture Authentic' }}</span>
                </div>
                <div class="logo-box">
                    <svg class="logo-icon-svg" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12.75 30.3v-7.5h7.5M3 16.5v-7.5h7.5M16.5 12h-7.5v7.5M21 21H3"/></svg>
                    <span data-editable="social_links.custom_texts.brand_2">{{ $portfolio->social_links['custom_texts']['brand_2'] ?? 'Furniture 1982, NYC' }}</span>
                </div>
                <div class="logo-box">
                    <svg class="logo-icon-svg" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"/></svg>
                    <span data-editable="social_links.custom_texts.brand_3">{{ $portfolio->social_links['custom_texts']['brand_3'] ?? 'Royal Throne Furniture' }}</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Recent Projects (04) -->
    <section class="projects-section" id="projects">
        <div class="container">
            <div class="projects-header">
                <span class="section-label" data-editable="social_links.custom_texts.projects_label">{{ $portfolio->social_links['custom_texts']['projects_label'] ?? '04 / Recent Projects' }}</span>
                <div class="accent-bar"></div>
                <h2 data-editable="social_links.custom_texts.projects_title">{{ $portfolio->social_links['custom_texts']['projects_title'] ?? 'Recent Projects' }}</h2>
                <p data-editable="social_links.custom_texts.projects_desc">{{ $portfolio->social_links['custom_texts']['projects_desc'] ?? 'Below are real projects carried out under my coordination. Do you want the same beauty at your place? Get in touch with me below.' }}</p>
            </div>

            <div class="projects-row">
                @if($portfolio->projects && count($portfolio->projects) > 0)
                    @foreach($portfolio->projects as $index => $project)
                        @if($index < 2) {{-- Skip lamp/chair custom slots --}}
                        <div class="project-item-card">
                            <div class="project-img-box">
                                <img src="{{ $project['image'] ?? '/b12.png' }}" data-editable-img="projects.{{ $index }}.image">
                            </div>
                            <h3 data-editable="projects.{{ $index }}.title">{{ $project['title'] }}</h3>
                            <p data-editable="projects.{{ $index }}.description">{{ $project['description'] }}</p>
                        </div>
                        @endif
                    @endforeach
                @else
                    <div class="project-item-card">
                        <div class="project-img-box">
                            <img src="/b12.png">
                        </div>
                        <h3>Minimalist Loft</h3>
                        <p>A beautiful concrete-accent penthouse design with high-fidelity industrial decor details.</p>
                    </div>
                    <div class="project-item-card">
                        <div class="project-img-box">
                            <img src="/b13.png">
                        </div>
                        <h3>Modern Eco Kitchen</h3>
                        <p>Custom wood cabinetry and zero-impact green sustainable materials layout.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Contact section -->
    <section class="contact-section" id="contact">
        <div class="container contact-grid">
            <div class="contact-info">
                <h2 data-editable="social_links.custom_texts.contact_title">{{ $portfolio->social_links['custom_texts']['contact_title'] ?? 'Request a Quote' }}</h2>
                <p data-editable="social_links.custom_texts.contact_desc">{{ $portfolio->social_links['custom_texts']['contact_desc'] ?? 'Ready to redesign your kitchen, bedroom, or living room space? Send me a quick description of your layout and I will get back to you within 24 hours.' }}</p>
                <a href="mailto:{{ $portfolio->social_links['custom_texts']['contact_email'] ?? 'mary@marydench.com' }}" class="contact-info-link" data-editable="social_links.custom_texts.contact_email">{{ $portfolio->social_links['custom_texts']['contact_email'] ?? 'mary@marydench.com' }}</a>
            </div>

            <div class="contact-form">
                @if(session('success'))
                    <div style="background: #FAFAFA; border: 1.5px solid var(--accent-pink); color: var(--accent-pink); padding: 1rem; border-radius: 8px; margin-bottom: 2rem; font-weight: 600;">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('portfolio.inquiry', $portfolio->slug) }}" method="POST" class="contact-form-box">
                    @csrf
                    <div class="contact-row-inputs">
                        <input type="text" name="client_name" required placeholder="Name" class="boutique-input" {{ ($isEditing ?? false) ? 'disabled' : '' }}>
                        <input type="email" name="client_email" required placeholder="Email" class="boutique-input" {{ ($isEditing ?? false) ? 'disabled' : '' }}>
                    </div>
                    <input type="text" name="subject" required placeholder="Subject" class="boutique-input" {{ ($isEditing ?? false) ? 'disabled' : '' }}>
                    <textarea name="message" rows="3" required placeholder="Message details" class="boutique-input" {{ ($isEditing ?? false) ? 'disabled' : '' }}></textarea>
                    
                    <button type="submit" class="boutique-form-btn" {{ ($isEditing ?? false) ? 'disabled' : '' }}>
                        {{ ($isEditing ?? false) ? 'Form (Disabled in Editor)' : 'Send Message' }}
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-logo">
                {{ $portfolio->title ?? 'Mary Dench' }}<span>.</span>
            </div>
            <p>&copy; {{ date('Y') }} {{ $portfolio->title ?? 'Mary Dench' }}. <span data-editable="social_links.custom_texts.copyright">{{ $portfolio->social_links['custom_texts']['copyright'] ?? 'All rights reserved.' }}</span></p>
        </div>
    </footer>

</body>
</html>
