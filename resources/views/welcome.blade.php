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

        /* Scroll Animations */
        .reveal-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .reveal-on-scroll.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        .delay-100 { animation-delay: 100ms; transition-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; transition-delay: 200ms; }
        .delay-300 { animation-delay: 300ms; transition-delay: 300ms; }

        /* Premium Steps Section */
        .premium-steps {
            max-width: 1200px;
            margin: 0 auto;
            padding: 8rem 2rem;
            display: flex;
            flex-direction: column;
            gap: 12rem;
            position: relative;
        }

        .step-row {
            display: flex;
            align-items: center;
            gap: 6rem;
            position: relative;
        }

        .step-row:nth-child(even) {
            flex-direction: row-reverse;
        }

        .step-number-huge {
            position: absolute;
            font-size: 24rem;
            font-weight: 700;
            color: rgba(17, 24, 39, 0.03);
            line-height: 0.8;
            z-index: -1;
            top: -6rem;
            left: -4rem;
            font-family: 'Playfair Display', serif;
            letter-spacing: -0.05em;
            transition: color 0.5s ease, transform 0.5s ease;
        }

        .step-row:nth-child(even) .step-number-huge {
            left: auto;
            right: -4rem;
        }

        .step-row:hover .step-number-huge {
            color: rgba(230, 126, 34, 0.08);
            transform: translateY(-15px);
        }

        .step-content {
            flex: 1;
            position: relative;
            z-index: 1;
        }

        .step-content h3 {
            font-size: 3rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: 1.5rem;
            letter-spacing: -0.02em;
            line-height: 1.1;
        }

        .step-content p {
            font-size: 1.25rem;
            color: #4B5563;
            line-height: 1.8;
        }

        .step-visual {
            flex: 1;
            height: 450px;
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
            border-radius: 32px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.1);
            transform: perspective(1000px) rotateY(-5deg);
            transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.6s ease;
        }

        .step-row:nth-child(even) .step-visual {
            transform: perspective(1000px) rotateY(5deg);
        }

        .step-row:hover .step-visual {
            transform: perspective(1000px) rotateY(0deg) translateY(-10px);
            box-shadow: 0 30px 60px -15px rgba(0, 0, 0, 0.2);
        }

        .step-visual img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 32px;
            transition: transform 0.5s ease;
        }
        
        .step-row:hover .step-visual img {
            transform: scale(1.05);
        }

        /* Premium Light Bento Box Features */
        .bento-section {
            padding: 10rem 2rem;
            background-color: #ffffff;
            position: relative;
            color: #111827;
            overflow: hidden;
            border-top: 1px solid #f3f4f6;
        }

        .bento-glow-1 {
            position: absolute;
            top: -20%;
            left: -10%;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.05) 0%, transparent 70%);
            pointer-events: none;
        }

        .bento-glow-2 {
            position: absolute;
            bottom: -20%;
            right: -10%;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(230, 126, 34, 0.05) 0%, transparent 70%);
            pointer-events: none;
        }

        .bento-header {
            text-align: center;
            max-width: 800px;
            margin: 0 auto 6rem auto;
            position: relative;
            z-index: 1;
        }

        .bento-header h2 {
            font-size: 4rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            letter-spacing: -0.02em;
            background: linear-gradient(135deg, #111827 0%, #4B5563 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .bento-header p {
            font-size: 1.25rem;
            color: #4B5563;
            line-height: 1.6;
        }

        .bento-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: repeat(2, 350px);
            gap: 1.5rem;
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .bento-card {
            background: #f9fafb;
            border: 1px solid #f3f4f6;
            border-radius: 32px;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02), 0 2px 4px -1px rgba(0, 0, 0, 0.02);
        }

        .bento-card:hover {
            background: #ffffff;
            border-color: #e5e7eb;
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.02);
        }

        .bento-large {
            grid-column: span 2;
            grid-row: span 2;
            justify-content: flex-end;
            background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
        }
        
        .bento-large .abstract-bg {
            position: absolute;
            top: -20%;
            right: -10%;
            width: 100%;
            height: 100%;
            background: radial-gradient(ellipse at top right, rgba(230,126,34,0.08), transparent 60%);
            z-index: 0;
            pointer-events: none;
        }

        .bento-tall {
            grid-column: span 1;
            grid-row: span 2;
        }

        .bento-card h4 {
            font-size: 1.75rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #111827;
            position: relative;
            z-index: 1;
        }

        .bento-large h4 {
            font-size: 3rem;
            margin-bottom: 1.5rem;
        }

        .bento-card p {
            color: #4B5563;
            line-height: 1.6;
            font-size: 1.1rem;
            position: relative;
            z-index: 1;
        }
        
        .bento-large p {
            font-size: 1.25rem;
            max-width: 80%;
        }

        /* Light Ultimate CTA Section */
        .ultimate-cta {
            padding: 12rem 2rem;
            background-color: #ffffff;
            color: #111827;
            text-align: center;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 90vh;
            border-top: 1px solid #f3f4f6;
        }

        .mesh-gradient-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(at 20% 30%, rgba(37, 99, 235, 0.1) 0px, transparent 50%),
                radial-gradient(at 80% 20%, rgba(230, 126, 34, 0.1) 0px, transparent 50%),
                radial-gradient(at 50% 80%, rgba(225, 29, 72, 0.1) 0px, transparent 50%);
            filter: blur(80px);
            z-index: 0;
            animation: meshFlow 15s ease-in-out infinite alternate;
        }

        @keyframes meshFlow {
            0% { transform: scale(1) rotate(0deg); }
            100% { transform: scale(1.1) rotate(5deg); }
        }

        .ultimate-cta-content {
            position: relative;
            z-index: 1;
            max-width: 1000px;
        }

        .cta-headline-massive {
            font-size: 6rem;
            font-weight: 500;
            margin-bottom: 2rem;
            letter-spacing: -0.03em;
            line-height: 1.1;
            color: #111827;
        }

        .serif-italic {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-weight: 600;
            color: #E67E22;
        }

        .cta-btn-glow {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            background: #111827;
            color: #ffffff;
            text-decoration: none;
            padding: 1.25rem 3.5rem;
            border-radius: 9999px;
            font-weight: 600;
            font-size: 1.25rem;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 10px 30px -5px rgba(17, 24, 39, 0.2);
            position: relative;
        }

        .cta-btn-glow:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 20px 40px -10px rgba(17, 24, 39, 0.3);
            background: #000000;
        }

        /* Footer */
        footer {
            background-color: #ffffff;
            padding: 4rem 2rem;
            border-top: 1px solid #E5E7EB;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 2rem;
        }

        .footer-logo {
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: -0.05em;
            color: #111827;
            text-decoration: none;
        }

        .footer-links {
            display: flex;
            gap: 2rem;
        }

        .footer-links a {
            color: #4B5563;
            text-decoration: none;
            font-size: 0.95rem;
            transition: color 0.2s ease;
        }

        .footer-links a:hover {
            color: #111827;
        }

        .footer-bottom {
            max-width: 1200px;
            margin: 2rem auto 0 auto;
            padding-top: 2rem;
            border-top: 1px solid #F3F4F6;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #9CA3AF;
            font-size: 0.875rem;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .step-row, .step-row:nth-child(even) {
                flex-direction: column;
                gap: 4rem;
                text-align: center;
            }
            .step-number-huge {
                font-size: 14rem;
                top: -3rem;
                left: 50% !important;
                right: auto !important;
                transform: translateX(-50%);
            }
            .step-row:hover .step-number-huge {
                transform: translate(-50%, -10px);
            }
            .bento-grid {
                grid-template-columns: repeat(2, 1fr);
                grid-template-rows: auto;
            }
            .bento-tall {
                grid-column: span 2;
                grid-row: span 1;
            }
            .bento-large h4 {
                font-size: 2rem;
            }
            .cta-headline-massive {
                font-size: 4rem;
            }
        }

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
            .step-content h3 {
                font-size: 2rem;
            }
            .bento-grid {
                grid-template-columns: 1fr;
            }
            .bento-large {
                grid-column: 1;
                grid-row: span 1;
            }
            .bento-tall {
                grid-column: 1;
            }
            .cta-headline-massive {
                font-size: 3rem;
            }
            .footer-content {
                flex-direction: column;
                text-align: center;
            }
            .footer-links {
                flex-wrap: wrap;
                justify-content: center;
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
        <div class="templates-header reveal-on-scroll">
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
        <div class="templates-header reveal-on-scroll">
            <h2>Your growth deserves the right foundation.</h2>
            <p>Create a website that supports, showcases, and scales your business.</p>
        </div>

        <div class="reveal-on-scroll" style="transition-delay: 200ms; width: 100%; margin-top: 3rem;">
            <div class="player fallback" style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; background-color: transparent; width: 100%; margin: 0;">
                <iframe title="vimeo-player" data-src="https://player.vimeo.com/video/1165275255?h=8863e094f0&background=1&autoplay=1&muted=1&loop=1&byline=0&title=0&controls=0" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none;" frameborder="0" referrerpolicy="strict-origin-when-cross-origin" allow="autoplay; fullscreen; picture-in-picture; clipboard-write; encrypted-media; web-share" allowfullscreen></iframe>
            </div>
        </div>
        <div class="templates-header reveal-on-scroll" style="margin-top: 5rem;">
            <h2>The simplest way to launch your presence.</h2>
            <p>Each step is carefully designed to be simple, guided, and easy to follow.</p>
        </div>
        
        <div class="premium-steps" id="how-it-works">
            <div class="step-row reveal-on-scroll">
                <div class="step-number-huge">01</div>
                <div class="step-content">
                    <h3>Select a Template</h3>
                    <p>Choose from our library of premium, high-converting designs built specifically for innovators. Our bespoke templates ensure you look like an industry leader from day one.</p>
                </div>
                <div class="step-visual">
                    <img src="{{ asset('images/step1.png') }}" alt="Template Selection Interface">
                </div>
            </div>
            
            <div class="step-row reveal-on-scroll">
                <div class="step-number-huge">02</div>
                <div class="step-content">
                    <h3>Customize & Refine</h3>
                    <p>Make it entirely your own. Add your content, tweak colors, and adjust layouts effortlessly with our powerful, intuitive no-code editor. Total creative freedom, zero technical friction.</p>
                </div>
                <div class="step-visual">
                    <img src="{{ asset('images/step2.png') }}" alt="Website Editor Interface">
                </div>
            </div>
            
            <div class="step-row reveal-on-scroll">
                <div class="step-number-huge">03</div>
                <div class="step-content">
                    <h3>Publish to the World</h3>
                    <p>Hit publish and instantly go live. Your portfolio is blazingly fast, hosted on enterprise-grade infrastructure, and structurally optimized for the highest SEO rankings.</p>
                </div>
                <div class="step-visual">
                    <img src="{{ asset('images/step3.png') }}" alt="Live Website Dashboard">
                </div>
            </div>
        </div>
    </section>

    <section class="bento-section" id="features">
        <div class="bento-glow-1"></div>
        <div class="bento-glow-2"></div>
        
        <div class="bento-header reveal-on-scroll">
            <h2>Everything you need.<br>Nothing you don't.</h2>
            <p>State-of-the-art tools packaged in a simple, beautiful interface.</p>
        </div>

        <!-- <div class="bento-grid">
            <div class="bento-card bento-large reveal-on-scroll delay-100">
                <div class="abstract-bg"></div>
                <h4>Absolute No-Code Freedom</h4>
                <p>Build stunning layouts visually. Our proprietary drag-and-drop editor gives you full creative control without writing a single line of code. Everything is fluid, intuitive, and responsive by default.</p>
            </div>
            
            <div class="bento-card bento-tall reveal-on-scroll delay-200">
                <div style="margin-bottom: auto;">
                    <svg width="48" height="48" fill="none" stroke="#E67E22" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <h4>Lightning Fast Edge Hosting</h4>
                <p>Served from the edge. Your portfolio loads instantly anywhere on earth, ensuring you never lose a visitor.</p>
            </div>
            
            <div class="bento-card reveal-on-scroll delay-100">
                <svg width="32" height="32" fill="none" stroke="#2563EB" viewBox="0 0 24 24" style="margin-bottom: 1.5rem;" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                <h4>Custom Domains</h4>
                <p>Connect your domain seamlessly to build a brand that is truly yours.</p>
            </div>
            
            <div class="bento-card reveal-on-scroll delay-200">
                <svg width="32" height="32" fill="none" stroke="#16A34A" viewBox="0 0 24 24" style="margin-bottom: 1.5rem;" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <h4>Built-in SEO</h4>
                <p>Automatically rank higher. Best-in-class structure for discovery.</p>
            </div>
        </div> -->
    </section>

    <section class="ultimate-cta">
        <div class="mesh-gradient-bg"></div>
        <div class="ultimate-cta-content reveal-on-scroll">
            <h2 class="cta-headline-massive">Ready to show up <br><span class="serif-italic">like a pro?</span></h2>
            <p class="cta-subheadline" style="color: #4B5563; font-size: 1.5rem;">Join thousands of top creators and innovators who trust Folio.</p>
            <a href="#create" class="cta-btn-glow">
                Start Building for Free
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>
    </section>

    <footer>
        <div class="footer-content">
            <a href="/" class="footer-logo">Folio<span class="logo-dot">.</span></a>
            <div class="footer-links">
                <a href="#templates">Templates</a>
                <a href="#how-it-works">How It Works</a>
                <a href="#features">Features</a>
                <a href="#contact">Contact</a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 Folio Inc. All rights reserved.</p>
            <div style="display: flex; gap: 1rem;">
                <a href="#" style="color: #9CA3AF;"><svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg></a>
                <a href="#" style="color: #9CA3AF;"><svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg></a>
            </div>
        </div>
    </footer>

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

            // Intersection Observer for Scroll Animations
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.15
            };

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        
                        const deferredIframe = entry.target.querySelector('iframe[data-src]');
                        if (deferredIframe) {
                            deferredIframe.src = deferredIframe.getAttribute('data-src');
                            deferredIframe.removeAttribute('data-src');
                            
                            // Initialize Vimeo Player and set playback rate
                            const player = new Vimeo.Player(deferredIframe);
                            player.setPlaybackRate(0.75).catch(function(error) {
                                console.warn("Could not set playback rate:", error);
                            });
                        }

                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            const scrollElements = document.querySelectorAll('.reveal-on-scroll');
            scrollElements.forEach(el => observer.observe(el));
        });
    </script>
    <script src="https://player.vimeo.com/api/player.js"></script>
</body>
</html>
