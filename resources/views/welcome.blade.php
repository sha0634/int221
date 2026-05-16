<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Folio - Show up like an Innovator</title>
    <!-- SEO Meta Tags -->
    <meta name="description" content="Create a stunning portfolio in minutes with Folio. No design skills or code required. Show up like an expert.">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@600&family=Inter:wght@400;500;600;700&family=Playfair+Display:ital,wght@1,600&display=swap" rel="stylesheet">
    <style>
        /* Base Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
            background-image: 
              linear-gradient(to right, #f0f0f0 1px, transparent 1px),
              linear-gradient(to bottom, #f0f0f0 1px, transparent 1px);
            background-size: 40px 40px;
            color: #111827;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
            position: relative;
        }

        /* Radial Glow Effect */
        .glow-background {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(230, 126, 34, 0.15) 0%, rgba(255, 255, 255, 0) 60%);
            z-index: -1;
            pointer-events: none;
        }

        /* Header & Navbar */
        header {
            position: sticky;
            top: 0;
            z-index: 50;
            /* Enhanced Glassmorphism */
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.03);
            width: 100%;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.25rem 4rem;
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: -0.05em;
            color: #000;
            display: flex;
            align-items: baseline;
            text-decoration: none;
        }

        .logo-dot {
            color: #E67E22;
            font-size: 2rem;
            line-height: 0;
            margin-left: 1px;
        }

        .nav-links {
            display: flex;
            gap: 2.5rem;
            align-items: center;
        }

        .nav-link {
            text-decoration: none;
            color: #4B5563;
            font-weight: 500;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
            transition: color 0.2s ease;
        }

        .nav-link:hover {
            color: #111827;
        }

        .nav-link svg {
            width: 16px;
            height: 16px;
            margin-top: 2px;
        }

        .btn-login {
            background-color: #111827;
            color: #ffffff;
            text-decoration: none;
            padding: 0.6rem 1.5rem;
            border-radius: 9999px;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .btn-login:hover {
            background-color: #000;
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        /* Hero Section */
        .hero {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 4rem 2rem 8rem 2rem;
            max-width: 1000px;
            margin: 0 auto;
            z-index: 1;
        }

        .headline {
            font-size: 5.5rem;
            font-weight: 500;
            line-height: 1.1;
            letter-spacing: -0.03em;
            color: #111827;
            margin-bottom: 1.5rem;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 0.5rem 1rem;
        }

        .animated-badge {
            display: inline-flex;
            align-items: center;
            background-color: var(--badge-bg);
            border: 1px solid var(--badge-border);
            padding: 0.25rem 1.75rem;
            border-radius: 9999px;
            box-shadow: 0 4px 14px var(--badge-shadow);
            transform: rotate(-2deg);
            transition: background-color 0.6s ease, border-color 0.6s ease, box-shadow 0.6s ease, transform 0.3s ease;
            justify-content: center;
        }

        .animated-badge:hover {
            transform: translateY(-2px) rotate(0deg);
            box-shadow: 0 6px 20px var(--badge-shadow-hover);
        }

        .badge-content {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .badge-content.slide-out-up {
            opacity: 0;
            transform: translateY(-15px);
        }

        .badge-content.slide-in-down {
            opacity: 0;
            transform: translateY(15px);
            transition: none;
        }

        .badge-icon {
            color: var(--badge-color);
            transition: color 0.5s ease;
            width: 0.8em;
            height: 0.8em;
        }

        .badge-text {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-weight: 600;
            color: var(--badge-color);
            padding-bottom: 0.25rem;
            transition: color 0.5s ease;
        }

        /* Badge Themes */
        .theme-innovator {
            --badge-bg: #FFF1F2;
            --badge-border: #FFE4E6;
            --badge-shadow: rgba(225, 29, 72, 0.15);
            --badge-shadow-hover: rgba(225, 29, 72, 0.2);
            --badge-color: #E11D48;
        }

        .theme-creator {
            --badge-bg: #EFF6FF;
            --badge-border: #DBEAFE;
            --badge-shadow: rgba(37, 99, 235, 0.15);
            --badge-shadow-hover: rgba(37, 99, 235, 0.2);
            --badge-color: #2563EB;
        }

        .theme-professional {
            --badge-bg: #FFF7ED;
            --badge-border: #FFEDD5;
            --badge-shadow: rgba(234, 88, 12, 0.15);
            --badge-shadow-hover: rgba(234, 88, 12, 0.2);
            --badge-color: #EA580C;
        }

        .theme-expert {
            --badge-bg: #F0FDF4;
            --badge-border: #DCFCE7;
            --badge-shadow: rgba(22, 163, 74, 0.15);
            --badge-shadow-hover: rgba(22, 163, 74, 0.2);
            --badge-color: #16A34A;
        }

        .sub-headline {
            font-size: 1.25rem;
            color: #4B5563;
            max-width: 600px;
            margin-bottom: 3rem;
            line-height: 1.6;
            font-weight: 400;
        }

        .script-text {
            font-family: 'Caveat', cursive;
            color: #E67E22;
            font-size: 1.8rem;
            margin-left: 0.25rem;
            display: inline-block;
            transform: rotate(-1deg);
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(180deg, #374151 0%, #111827 100%);
            color: #ffffff;
            text-decoration: none;
            padding: 1.125rem 2.5rem;
            border-radius: 9999px;
            font-weight: 600;
            font-size: 1.125rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(17, 24, 39, 0.2), 0 10px 15px -3px rgba(17, 24, 39, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(17, 24, 39, 0.25), 0 10px 10px -5px rgba(17, 24, 39, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.1);
            background: linear-gradient(180deg, #4B5563 0%, #1F2937 100%);
        }

        .btn-primary::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 50%;
            height: 100%;
            background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.1) 50%, rgba(255,255,255,0) 100%);
            transform: skewX(-20deg);
            animation: shine 4s infinite;
        }

        @keyframes shine {
            0% { left: -100%; }
            20% { left: 200%; }
            100% { left: 200%; }
        }

        .btn-primary svg {
            width: 20px;
            height: 20px;
            transition: transform 0.2s ease;
        }

        .btn-primary:hover svg {
            transform: translateX(4px);
        }

        /* Templates Section */
        .templates-section {
            padding-top: 6rem;
            width: 100%;
            background-color: #ffffff;
            position: relative;
            z-index: 10;
        }

        .templates-header {
            text-align: center;
            max-width: 800px;
            margin: 0 auto 4rem auto;
            padding: 0 2rem;
            position: relative;
            z-index: 20;
        }

        .templates-header h2 {
            font-size: 3rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: 1.2rem;
            letter-spacing: -0.02em;
        }

        .templates-header p {
            font-size: 1.125rem;
            color: #4B5563;
            line-height: 1.6;
        }

        /* Scroll Animation Container */
        .scroll-wrapper {
            height: 250vh; 
            position: relative;
            width: 100%;
        }

        .sticky-container {
            position: sticky;
            top: 0;
            height: 100vh;
            width: 100%;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #ffffff;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: repeat(3, 1fr);
            gap: 1rem;
            width: 90vw;
            max-width: 1400px;
            aspect-ratio: 16 / 9;
            transform-origin: center center;
            transform: scale(3.5); 
            will-change: transform;
        }

        .grid-item {
            background-color: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
        }

        .placeholder-content {
            display: none;
        }

        .placeholder-content h3 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            line-height: 1.2;
        }
        
        .placeholder-content p {
            font-size: 0.875rem;
            opacity: 0.8;
        }

        /* Specific styling for images */
        .item-1 { background: url('b11.png') center/cover; }
        .item-2 { background: url('b12.png') center/cover; }
        .item-3 { background: url('b13.png') center/cover; }
        .item-4 { background: url('b14.png') center/cover; }
        .item-6 { background: url('b16.png') center/cover; }
        .item-7 { background: url('b17.png') center/cover; }
        .item-8 { background: url('b18.png') center/cover; }
        .item-9 { background: url('b19.png') center/cover; }

        /* Creative Studio (Center Item) */
        .item-creative-studio {
            background: url('b15.png') center/cover;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2);
        }

        .creative-content {
            display: none;
        }

        .creative-content h2 {
            font-family: 'Inter', sans-serif;
            font-size: 2.2rem;
            font-weight: 300;
            letter-spacing: 0.3em;
            text-align: center;
        }

        /* Responsive Design updates for Grid */
        @media (max-width: 1024px) {
            .grid-container {
                gap: 0.75rem;
            }
            .creative-content h2 {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .templates-header h2 {
                font-size: 2.25rem;
            }
            .grid-container {
                transform: scale(2.5);
                gap: 0.5rem;
            }
            .creative-content h2 {
                font-size: 1.2rem;
            }
            .placeholder-content h3 {
                font-size: 1.2rem;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
        }

        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }
        .delay-300 { animation-delay: 300ms; }

        /* Responsive Design */
        @media (max-width: 768px) {
            .headline {
                font-size: 4.5rem;
            }
            .navbar {
                padding: 1.5rem 2rem;
            }
            .nav-links {
                display: none;
            }
            .sub-headline {
                font-size: 1.125rem;
            }
            .expert-badge {
                padding: 0.2rem 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="glow-background"></div>

    <header>
        <nav class="navbar" aria-label="Main Navigation">
            <a href="/" class="logo">
                Folio<span class="logo-dot">.</span>
            </a>
            <div class="nav-links">
                <a href="#templates" class="nav-link">
                    Templates
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </a>
                <a href="#how-it-works" class="nav-link">How It Works</a>
            </div>
            <a href="#login" class="btn-login">Login</a>
        </nav>
    </header>

    <main class="hero">
        <h1 class="headline animate-fade-in-up">
            <span style="flex-basis: 100%;">Show up</span>
            <span style="display: flex; align-items: center; gap: 0.5rem;">
                like an 
                <span id="role-badge" class="animated-badge theme-innovator">
                    <span id="badge-content" class="badge-content">
                        <svg id="badge-icon" class="badge-icon" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.5 18.5L3.5 5L8.5 10.5L12 3.5L15.5 10.5L20.5 5L21.5 18.5H2.5ZM3.5 20.5H20.5V22H3.5V20.5Z" />
                        </svg>
                        <span id="badge-text" class="badge-text">Innovator</span>
                    </span>
                </span>
            </span>
        </h1>
        <p class="sub-headline animate-fade-in-up delay-100">
            Create a stunning portfolio in minutes — <br />
            <span class="script-text">No design skills, No code.</span>
        </p>
        <div class="animate-fade-in-up delay-200">
            <a href="#create" class="btn-primary">
                Create Your Portfolio
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>
    </main>

    <section id="templates" class="templates-section">
        <div class="templates-header">
            <h2>Turn any template into your own</h2>
            <p>Browse ready-made designs and customize them easily — or get smart guidance to shape your content and layout.</p>
        </div>
        
        <div class="scroll-wrapper" id="scroll-wrapper">
            <div class="sticky-container">
                <div class="grid-container" id="grid-container">
                    <!-- 9 Grid Items -->
                    <div class="grid-item item-1">
                        <div class="placeholder-content">
                            <h3>Dance Fitness</h3>
                            <p>Feel the energy</p>
                        </div>
                    </div>
                    <div class="grid-item item-2">
                        <div class="placeholder-content">
                            <h3>Restore Your Natural Mobility</h3>
                            <p>Premium rehabilitation center</p>
                        </div>
                    </div>
                    <div class="grid-item item-3">
                        <div class="placeholder-content">
                            <h3>Train Like a Pro.</h3>
                            <p>Play like a champion.</p>
                        </div>
                    </div>
                    <div class="grid-item item-4">
                        <div class="placeholder-content">
                            <h3>Dr. Ananya Sharma</h3>
                            <p>Expert medical care, centered around your family.</p>
                        </div>
                    </div>
                    <div class="grid-item item-creative-studio">
                        <div class="creative-content">
                            <h2>C R E A T I V E &nbsp; S T U D I O</h2>
                        </div>
                    </div>
                    <div class="grid-item item-6">
                        <div class="placeholder-content">
                            <h3>Speak with Impact.</h3>
                            <p>Lead the room.</p>
                        </div>
                    </div>
                    <div class="grid-item item-7">
                        <div class="placeholder-content">
                            <h3>SparkKids</h3>
                            <p>Ignite Their Inner Artist</p>
                        </div>
                    </div>
                    <div class="grid-item item-8">
                        <div class="placeholder-content">
                            <h3>CampSizzle</h3>
                            <p>Master Cooking This Summer!</p>
                        </div>
                    </div>
                    <div class="grid-item item-9">
                        <div class="placeholder-content">
                            <h3>Summer Camp</h3>
                            <p>Where Every Child Finds a New Hobby!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="templates-section" style="padding-top: 4rem; padding-bottom: 8rem;">
        <div class="templates-header animate-fade-in-up">
            <h2>Your growth deserves the right foundation.</h2>
            <p>Create a website that supports, showcases, and scales your business.</p>
        </div>

        <div class="animate-fade-in-up" style="animation-delay: 200ms; width: 100%; margin-top: 3rem;">
            <div class="player fallback" style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; background-color: transparent; width: 100%; margin: 0;">
                <iframe title="vimeo-player" src="https://player.vimeo.com/video/1165275255?h=8863e094f0&background=1&autoplay=1&muted=1&loop=1&byline=0&title=0&controls=0" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none;" frameborder="0" referrerpolicy="strict-origin-when-cross-origin" allow="autoplay; fullscreen; picture-in-picture; clipboard-write; encrypted-media; web-share" allowfullscreen></iframe>
            </div>
        </div>
        <div class="templates-header animate-fade-in-up" style="margin-top: 5rem;">
            <h2>The simplest way to launch your presence.</h2>
            <p>Each step is carefully designed to be simple, guided, and easy to follow.</p>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const roles = [
                {
                    text: 'Innovator',
                    theme: 'theme-innovator',
                    icon: 'M2.5 18.5L3.5 5L8.5 10.5L12 3.5L15.5 10.5L20.5 5L21.5 18.5H2.5ZM3.5 20.5H20.5V22H3.5V20.5Z'
                },
                {
                    text: 'Creator',
                    theme: 'theme-creator',
                    icon: 'M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z'
                },
                {
                    text: 'Professional',
                    theme: 'theme-professional',
                    icon: 'M12 2L13.2 9.6L20 12L13.2 14.4L12 22L10.8 14.4L4 12L10.8 9.6L12 2Z'
                },
                {
                    text: 'Expert',
                    theme: 'theme-expert',
                    icon: 'M12 2L22 12L12 22L2 12L12 2Z'
                }
            ];

            let currentRoleIndex = 0;
            const badge = document.getElementById('role-badge');
            const content = document.getElementById('badge-content');
            const iconPath = document.querySelector('#badge-icon path');
            const textElement = document.getElementById('badge-text');

            setInterval(() => {
                content.classList.add('slide-out-up');
                
                setTimeout(() => {
                    content.classList.remove('slide-out-up');
                    content.classList.add('slide-in-down');
                    
                    currentRoleIndex = (currentRoleIndex + 1) % roles.length;
                    const nextRole = roles[currentRoleIndex];

                    badge.className = `animated-badge ${nextRole.theme}`;
                    iconPath.setAttribute('d', nextRole.icon);
                    textElement.textContent = nextRole.text;

                    void content.offsetWidth;
                    
                    content.classList.remove('slide-in-down');
                }, 400);
            }, 3000);

            // Scroll Animation for Templates Grid
            const scrollWrapper = document.getElementById('scroll-wrapper');
            const gridContainer = document.getElementById('grid-container');

            if (scrollWrapper && gridContainer) {
                window.addEventListener('scroll', () => {
                    const rect = scrollWrapper.getBoundingClientRect();
                    const scrollableDistance = rect.height - window.innerHeight;
                    
                    // Prevent calculation errors if elements are hidden
                    if (scrollableDistance <= 0) return;
                    
                    let progress = -rect.top / scrollableDistance;
                    progress = Math.max(0, Math.min(1, progress));
                    
                    // Check if mobile for startScale
                    const isMobile = window.innerWidth <= 768;
                    const startScale = isMobile ? 2.5 : 3.5;
                    const endScale = 1;
                    
                    const currentScale = startScale - (progress * (startScale - endScale));
                    
                    gridContainer.style.transform = `scale(${currentScale})`;
                });
                
                // Trigger once to set initial state correctly
                window.dispatchEvent(new Event('scroll'));
            }
        });
    </script>
</body>
</html>
