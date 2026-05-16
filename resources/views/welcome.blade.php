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

        .innovator-badge {
            display: inline-flex;
            align-items: center;
            background-color: #FFF1F2;
            border: 1px solid #FFE4E6;
            padding: 0.25rem 1.75rem;
            border-radius: 9999px;
            box-shadow: 0 4px 14px rgba(225, 29, 72, 0.15);
            gap: 0.75rem;
            transform: rotate(-2deg);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .innovator-badge:hover {
            transform: translateY(-2px) rotate(0deg);
            box-shadow: 0 6px 20px rgba(225, 29, 72, 0.2);
        }

        .crown-icon {
            color: #E11D48;
        }

        .innovator-text {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-weight: 600;
            color: #E11D48;
            padding-bottom: 0.25rem;
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
                <span class="innovator-badge">
                    <svg class="crown-icon" width="0.8em" height="0.8em" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.5 18.5L3.5 5L8.5 10.5L12 3.5L15.5 10.5L20.5 5L21.5 18.5H2.5ZM3.5 20.5H20.5V22H3.5V20.5Z" />
                    </svg>
                    <span class="innovator-text">Innovator</span>
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
</body>
</html>
