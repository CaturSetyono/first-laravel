<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RetroVault - Premium Inventory Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Space+Grotesk:wght@300;400;500;600;700&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            /* Retro Color Palette */
            --cream: #F5F0E8;
            --cream-dark: #E8E0D0;
            --burgundy: #8B2942;
            --burgundy-dark: #6B1D32;
            --burgundy-light: #A83D56;
            --teal: #2D6A6A;
            --teal-dark: #1E4A4A;
            --teal-light: #3D8A8A;
            --mustard: #D4A12A;
            --mustard-dark: #B8891F;
            --mustard-light: #E8B93D;
            --charcoal: #2C2C2C;
            --charcoal-light: #3D3D3D;
            --olive: #5C6B4D;
            --terracotta: #C65D3B;
            --navy: #1E3A5F;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Space Grotesk', sans-serif;
            background-color: var(--cream);
            color: var(--charcoal);
            line-height: 1.7;
            overflow-x: hidden;
        }

        h1,
        h2,
        h3,
        h4 {
            font-family: 'DM Serif Display', serif;
        }

        .display-font {
            font-family: 'Bebas Neue', sans-serif;
            letter-spacing: 2px;
        }

        html {
            scroll-behavior: smooth;
        }

        /* ========== NAVBAR - Retro Style ========== */
        .navbar-retro {
            background-color: var(--charcoal);
            padding: 0;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            border-bottom: 4px solid var(--mustard);
        }

        .navbar-inner {
            display: flex;
            justify-content: space-between;
            align-items: stretch;
        }

        .navbar-brand-retro {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.8rem;
            color: var(--cream) !important;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 18px 30px;
            background-color: var(--burgundy);
            text-decoration: none;
            letter-spacing: 3px;
            position: relative;
            clip-path: polygon(0 0, calc(100% - 20px) 0, 100% 100%, 0 100%);
            padding-right: 50px;
        }

        .navbar-brand-retro:hover {
            background-color: var(--burgundy-light);
            color: var(--cream) !important;
        }

        .brand-icon-retro {
            width: 40px;
            height: 40px;
            background-color: var(--mustard);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--charcoal);
            font-size: 1.2rem;
            transform: rotate(-5deg);
        }

        .nav-links-retro {
            display: flex;
            align-items: stretch;
        }

        .nav-link-retro {
            color: var(--cream-dark) !important;
            font-weight: 500;
            font-size: 0.85rem;
            padding: 20px 24px !important;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            border-left: 1px solid var(--charcoal-light);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }

        .nav-link-retro:hover {
            color: var(--mustard) !important;
            background-color: var(--charcoal-light);
        }

        .btn-login-retro {
            background-color: var(--teal);
            color: var(--cream) !important;
            padding: 20px 35px !important;
            font-weight: 600;
            font-size: 0.85rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            transition: all 0.3s ease;
            clip-path: polygon(15px 0, 100% 0, 100% 100%, 0 100%);
            padding-left: 45px !important;
        }

        .btn-login-retro:hover {
            background-color: var(--teal-light);
            color: var(--cream) !important;
        }

        /* ========== HERO SECTION - Full Width Centered Design ========== */
        .hero-retro {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            margin-top: 70px;
            background: linear-gradient(135deg, var(--cream) 0%, var(--cream) 60%, var(--burgundy) 60%, var(--burgundy) 100%);
            overflow: hidden;
        }

        .hero-retro::before {
            content: '';
            position: absolute;
            top: 20%;
            left: -5%;
            width: 400px;
            height: 400px;
            border: 50px solid var(--mustard);
            border-radius: 50%;
            opacity: 0.15;
        }

        .hero-retro::after {
            content: '';
            position: absolute;
            bottom: 10%;
            right: -5%;
            width: 300px;
            height: 300px;
            background-color: var(--teal);
            opacity: 0.1;
            transform: rotate(45deg);
        }

        .hero-container {
            max-width: 1400px;
            width: 100%;
            padding: 60px 40px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .hero-content {
            position: relative;
        }

        .hero-visual {
            position: relative;
        }

        .hero-badge-retro {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background-color: var(--burgundy);
            color: var(--cream);
            padding: 14px 28px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-bottom: 30px;
            position: relative;
            z-index: 1;
            border: 3px solid var(--charcoal);
            box-shadow: 5px 5px 0 var(--charcoal);
        }

        .hero-badge-retro i {
            color: var(--mustard);
        }

        .hero-title-retro {
            font-family: 'DM Serif Display', serif;
            font-size: 4.5rem;
            font-weight: 400;
            color: var(--charcoal);
            margin-bottom: 25px;
            line-height: 1.1;
            position: relative;
            z-index: 1;
        }

        .hero-title-retro .highlight {
            color: var(--burgundy);
            font-style: italic;
            position: relative;
        }

        .hero-title-retro .highlight::after {
            content: '';
            position: absolute;
            bottom: 5px;
            left: 0;
            right: 0;
            height: 12px;
            background-color: var(--mustard);
            opacity: 0.4;
            z-index: -1;
        }

        .hero-subtitle-retro {
            font-size: 1.1rem;
            color: var(--charcoal);
            opacity: 0.8;
            max-width: 450px;
            margin-bottom: 40px;
            position: relative;
            z-index: 1;
        }

        .hero-buttons-retro {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            position: relative;
            z-index: 1;
        }

        .btn-primary-retro {
            background-color: var(--burgundy);
            color: var(--cream);
            padding: 18px 36px;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .btn-primary-retro::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-primary-retro:hover::before {
            left: 100%;
        }

        .btn-primary-retro:hover {
            background-color: var(--burgundy-dark);
            color: var(--cream);
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(139, 41, 66, 0.3);
        }

        .btn-secondary-retro {
            background-color: transparent;
            color: var(--charcoal);
            padding: 18px 36px;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s ease;
            border: 3px solid var(--charcoal);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-secondary-retro:hover {
            background-color: var(--charcoal);
            color: var(--cream);
            transform: translateY(-3px);
        }

        /* Stats Dashboard - New Card Style */
        .stats-dashboard {
            background-color: var(--cream);
            padding: 40px;
            position: relative;
            z-index: 1;
            border: 4px solid var(--charcoal);
            box-shadow: 12px 12px 0 var(--charcoal);
        }

        .stats-dashboard::before {
            content: '';
            position: absolute;
            top: -15px;
            right: -15px;
            width: 80px;
            height: 80px;
            background-color: var(--mustard);
            z-index: -1;
        }

        .stats-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 2px dashed var(--cream-dark);
        }

        .stats-title {
            font-family: 'DM Serif Display', serif;
            font-size: 1.3rem;
            color: var(--charcoal);
        }

        .stats-badge {
            background-color: var(--olive);
            color: var(--cream);
            padding: 6px 14px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 4px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 25px;
        }

        .stat-card-retro {
            padding: 20px;
            border-radius: 12px;
            position: relative;
            overflow: hidden;
        }

        .stat-card-retro.teal {
            background-color: var(--teal);
            color: var(--cream);
        }

        .stat-card-retro.mustard {
            background-color: var(--mustard);
            color: var(--charcoal);
        }

        .stat-card-retro.burgundy {
            background-color: var(--burgundy);
            color: var(--cream);
        }

        .stat-card-retro.olive {
            background-color: var(--olive);
            color: var(--cream);
        }

        .stat-card-retro::before {
            content: '';
            position: absolute;
            top: -20px;
            right: -20px;
            width: 60px;
            height: 60px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .stat-value {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2rem;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.9;
        }

        .mini-chart {
            height: 60px;
            background: linear-gradient(180deg, var(--cream-dark) 0%, var(--cream) 100%);
            border-radius: 8px;
            display: flex;
            align-items: flex-end;
            padding: 10px;
            gap: 6px;
        }

        .mini-bar {
            flex: 1;
            background-color: var(--teal);
            border-radius: 4px 4px 0 0;
            transition: height 0.5s ease;
        }

        /* ========== FEATURES SECTION - Card Grid ========== */
        .features-retro {
            padding: 120px 0;
            background-color: var(--cream-dark);
            position: relative;
        }

        .features-retro::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: repeating-linear-gradient(90deg,
                    var(--burgundy) 0px,
                    var(--burgundy) 30px,
                    var(--mustard) 30px,
                    var(--mustard) 60px,
                    var(--teal) 60px,
                    var(--teal) 90px);
        }

        .section-header-retro {
            text-align: center;
            margin-bottom: 70px;
        }

        .section-tag {
            display: inline-block;
            background-color: var(--charcoal);
            color: var(--mustard);
            padding: 10px 25px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-bottom: 20px;
            transform: rotate(-2deg);
        }

        .section-title-retro {
            font-family: 'DM Serif Display', serif;
            font-size: 3.2rem;
            margin-bottom: 15px;
            color: var(--charcoal);
        }

        .section-subtitle-retro {
            color: var(--charcoal);
            opacity: 0.7;
            max-width: 500px;
            margin: 0 auto;
            font-size: 1.05rem;
        }

        .feature-card-retro {
            background-color: var(--cream);
            padding: 40px;
            height: 100%;
            border: 3px solid var(--charcoal);
            position: relative;
            transition: all 0.4s ease;
            overflow: hidden;
        }

        .feature-card-retro::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background-color: var(--burgundy);
            transition: height 0.3s ease;
        }

        .feature-card-retro:hover::before {
            height: 100%;
        }

        .feature-card-retro:hover {
            transform: translateY(-10px) rotate(-1deg);
            box-shadow: 15px 15px 0 var(--charcoal);
        }

        .feature-card-retro:hover .feature-icon-retro,
        .feature-card-retro:hover .feature-title-retro,
        .feature-card-retro:hover .feature-desc-retro,
        .feature-card-retro:hover .feature-list-retro li {
            color: var(--cream);
            position: relative;
            z-index: 1;
        }

        .feature-card-retro:hover .feature-icon-retro {
            background-color: var(--mustard);
            color: var(--charcoal);
        }

        .feature-icon-retro {
            width: 70px;
            height: 70px;
            background-color: var(--charcoal);
            color: var(--mustard);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 25px;
            transform: rotate(-5deg);
            transition: all 0.3s ease;
        }

        .feature-title-retro {
            font-family: 'DM Serif Display', serif;
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: var(--charcoal);
            transition: color 0.3s ease;
        }

        .feature-desc-retro {
            color: var(--charcoal);
            opacity: 0.8;
            font-size: 0.95rem;
            margin-bottom: 20px;
            transition: color 0.3s ease;
        }

        .feature-list-retro {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .feature-list-retro li {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
            color: var(--charcoal);
            margin-bottom: 10px;
            transition: color 0.3s ease;
        }

        .feature-list-retro li i {
            color: var(--teal);
            font-size: 0.85rem;
        }

        .feature-card-retro:hover .feature-list-retro li i {
            color: var(--mustard);
        }

        /* ========== HOW IT WORKS - Timeline Style ========== */
        .how-retro {
            padding: 120px 0;
            background-color: var(--charcoal);
            position: relative;
            overflow: hidden;
        }

        .how-retro::before {
            content: 'PROCESS';
            position: absolute;
            top: 50%;
            left: -10%;
            transform: translateY(-50%) rotate(-90deg);
            font-family: 'Bebas Neue', sans-serif;
            font-size: 15rem;
            color: var(--charcoal-light);
            opacity: 0.3;
            letter-spacing: 20px;
        }

        .how-retro .section-title-retro,
        .how-retro .section-subtitle-retro {
            color: var(--cream);
        }

        .how-retro .section-tag {
            background-color: var(--burgundy);
        }

        .timeline-container {
            position: relative;
            padding: 40px 0;
        }

        .timeline-line {
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 4px;
            background-color: var(--mustard);
            transform: translateY(-50%);
        }

        .step-card-retro {
            text-align: center;
            position: relative;
            padding: 30px 20px;
        }

        .step-number-retro {
            width: 80px;
            height: 80px;
            background-color: var(--burgundy);
            color: var(--cream);
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            border: 4px solid var(--mustard);
            position: relative;
            z-index: 2;
            transform: rotate(5deg);
            transition: all 0.3s ease;
        }

        .step-card-retro:hover .step-number-retro {
            transform: rotate(-5deg) scale(1.1);
            background-color: var(--mustard);
            color: var(--charcoal);
        }

        .step-title-retro {
            font-family: 'DM Serif Display', serif;
            font-size: 1.4rem;
            margin-bottom: 10px;
            color: var(--cream);
        }

        .step-desc-retro {
            color: var(--cream);
            opacity: 0.7;
            font-size: 0.9rem;
        }

        /* ========== MARQUEE STATS BANNER - Infinite Scroll ========== */
        .marquee-section {
            background-color: var(--charcoal);
            padding: 0;
            position: relative;
            overflow: hidden;
            border-top: 4px solid var(--mustard);
            border-bottom: 4px solid var(--mustard);
        }

        .marquee-container {
            display: flex;
            overflow: hidden;
            position: relative;
        }

        .marquee-container::before,
        .marquee-container::after {
            content: '';
            position: absolute;
            top: 0;
            width: 100px;
            height: 100%;
            z-index: 2;
        }

        .marquee-container::before {
            left: 0;
            background: linear-gradient(90deg, var(--charcoal) 0%, transparent 100%);
        }

        .marquee-container::after {
            right: 0;
            background: linear-gradient(-90deg, var(--charcoal) 0%, transparent 100%);
        }

        .marquee-track {
            display: flex;
            animation: marquee 25s linear infinite;
        }

        .marquee-track:hover {
            animation-play-state: paused;
        }

        @keyframes marquee {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .marquee-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 30px 50px;
            white-space: nowrap;
            border-right: 1px solid var(--charcoal-light);
        }

        .marquee-icon {
            width: 50px;
            height: 50px;
            background-color: var(--burgundy);
            color: var(--cream);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            transform: rotate(-5deg);
            border: 2px solid var(--mustard);
        }

        .marquee-content {
            display: flex;
            flex-direction: column;
        }

        .marquee-number {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2.2rem;
            color: var(--mustard);
            line-height: 1;
            letter-spacing: 2px;
        }

        .marquee-label {
            color: var(--cream);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            opacity: 0.8;
        }

        /* Alternate colors for variety */
        .marquee-item:nth-child(even) .marquee-icon {
            background-color: var(--teal);
        }

        .marquee-item:nth-child(3n) .marquee-icon {
            background-color: var(--olive);
        }

        /* ========== TECH STACK / WHY CHOOSE US ========== */
        .why-us-section {
            padding: 120px 0;
            background-color: var(--cream);
            position: relative;
        }

        .why-us-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: repeating-linear-gradient(90deg,
                    var(--teal) 0px,
                    var(--teal) 30px,
                    var(--mustard) 30px,
                    var(--mustard) 60px,
                    var(--burgundy) 60px,
                    var(--burgundy) 90px);
        }

        .why-card {
            background-color: var(--cream-dark);
            padding: 40px 35px;
            border: 3px solid var(--charcoal);
            position: relative;
            transition: all 0.4s ease;
            height: 100%;
            text-align: center;
            overflow: hidden;
        }

        .why-card::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background-color: var(--burgundy);
            transition: height 0.3s ease;
        }

        .why-card:hover::before {
            height: 100%;
        }

        .why-card:hover {
            transform: translateY(-10px);
            box-shadow: 8px 8px 0 var(--charcoal);
        }

        .why-card:hover .why-icon,
        .why-card:hover .why-title,
        .why-card:hover .why-desc {
            color: var(--cream);
            position: relative;
            z-index: 1;
        }

        .why-card:hover .why-icon {
            background-color: var(--mustard);
            color: var(--charcoal);
        }

        .why-icon {
            width: 80px;
            height: 80px;
            background-color: var(--charcoal);
            color: var(--mustard);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 25px;
            transition: all 0.3s ease;
            transform: rotate(-5deg);
        }

        .why-title {
            font-family: 'DM Serif Display', serif;
            font-size: 1.4rem;
            color: var(--charcoal);
            margin-bottom: 15px;
            transition: color 0.3s ease;
        }

        .why-desc {
            color: var(--charcoal);
            opacity: 0.8;
            font-size: 0.95rem;
            line-height: 1.7;
            transition: color 0.3s ease;
        }

        /* Second row different colors */
        .why-card.teal::before {
            background-color: var(--teal);
        }

        .why-card.mustard::before {
            background-color: var(--mustard);
        }

        .why-card.olive::before {
            background-color: var(--olive);
        }

        /* About section dihapus - info dipindahkan ke footer */

        /* ========== CTA SECTION - Enhanced ========== */
        .cta-retro {
            padding: 120px 0;
            background-color: var(--teal);
            position: relative;
            overflow: hidden;
        }

        .cta-retro::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -20%;
            width: 500px;
            height: 500px;
            border: 80px solid var(--teal-light);
            border-radius: 50%;
            opacity: 0.15;
        }

        .cta-retro::after {
            content: '';
            position: absolute;
            bottom: -30%;
            right: -10%;
            width: 400px;
            height: 400px;
            background-color: var(--teal-dark);
            opacity: 0.2;
            transform: rotate(45deg);
        }

        .cta-card-retro {
            background-color: var(--cream);
            padding: 80px;
            text-align: center;
            position: relative;
            overflow: hidden;
            border: 4px solid var(--charcoal);
            box-shadow: 15px 15px 0 var(--charcoal);
        }

        .cta-card-retro::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 8px;
            background: linear-gradient(90deg, var(--burgundy) 0%, var(--mustard) 50%, var(--teal) 100%);
        }

        .cta-title-retro {
            font-family: 'DM Serif Display', serif;
            font-size: 3rem;
            color: var(--charcoal);
            margin-bottom: 15px;
            position: relative;
            z-index: 1;
        }

        .cta-subtitle-retro {
            color: var(--charcoal);
            opacity: 0.7;
            margin-bottom: 40px;
            font-size: 1.1rem;
            position: relative;
            z-index: 1;
        }

        .btn-cta-retro {
            background-color: var(--burgundy);
            color: var(--cream);
            padding: 20px 50px;
            font-weight: 700;
            font-size: 1rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 2px;
            border: none;
            position: relative;
            z-index: 1;
        }

        .btn-cta-retro:hover {
            background-color: var(--cream);
            color: var(--charcoal);
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(212, 161, 42, 0.3);
        }

        /* ========== FOOTER - Enhanced with Developer Info ========== */
        .footer-retro {
            background-color: var(--charcoal);
            padding: 0;
            border-top: 6px solid var(--mustard);
        }

        .footer-main {
            padding: 60px 0 40px;
            border-bottom: 1px solid var(--charcoal-light);
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr 1.5fr;
            gap: 50px;
        }

        .footer-brand-section {
            /* Brand column styling */
            display: flex;
            flex-direction: column;
        }

        .footer-brand-retro {
            display: flex;
            align-items: center;
            gap: 12px;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.8rem;
            color: var(--cream);
            letter-spacing: 3px;
            margin-bottom: 20px;
        }

        .footer-brand-retro .brand-icon-retro {
            width: 45px;
            height: 45px;
            font-size: 1.2rem;
        }

        .footer-desc {
            color: var(--cream);
            opacity: 0.7;
            font-size: 0.9rem;
            line-height: 1.8;
            margin-bottom: 25px;
        }

        .footer-social {
            display: flex;
            gap: 12px;
        }

        .footer-social a {
            width: 40px;
            height: 40px;
            background-color: var(--charcoal-light);
            color: var(--cream);
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .footer-social a:hover {
            background-color: var(--burgundy);
            border-color: var(--mustard);
            transform: translateY(-3px);
        }

        .footer-column h4 {
            font-family: 'Bebas Neue', sans-serif;
            color: var(--mustard);
            font-size: 1.1rem;
            letter-spacing: 2px;
            margin-bottom: 25px;
        }

        .footer-links-retro {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .footer-links-retro a {
            color: var(--cream);
            opacity: 0.7;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .footer-links-retro a:hover {
            color: var(--mustard);
            opacity: 1;
            transform: translateX(5px);
        }

        .footer-links-retro a i {
            font-size: 0.7rem;
            color: var(--burgundy);
        }

        /* Developer Info Section */
        .footer-developer {
            background-color: var(--burgundy);
            padding: 25px;
            position: relative;
        }

        .footer-developer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 6px;
            height: 100%;
            background-color: var(--mustard);
        }

        .developer-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
        }

        .developer-avatar {
            width: 60px;
            height: 60px;
            border: 3px solid var(--mustard);
            object-fit: cover;
        }

        .developer-name {
            font-family: 'DM Serif Display', serif;
            color: var(--cream);
            font-size: 1.3rem;
            margin: 0;
        }

        .developer-nim {
            font-family: 'Bebas Neue', sans-serif;
            color: var(--mustard);
            font-size: 1rem;
            letter-spacing: 2px;
        }

        .developer-details {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .developer-details span {
            color: var(--cream);
            opacity: 0.9;
            font-size: 0.8rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .developer-details i {
            color: var(--mustard);
            width: 16px;
        }

        .developer-details a {
            color: var(--cream);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .developer-details a:hover {
            color: var(--mustard);
        }

        /* Footer Bottom */
        .footer-bottom {
            padding: 25px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-copyright {
            color: var(--cream);
            opacity: 0.6;
            font-size: 0.85rem;
        }

        .footer-copyright i {
            color: var(--burgundy);
        }

        .footer-tech {
            display: flex;
            align-items: center;
            gap: 15px;
            color: var(--cream);
            opacity: 0.6;
            font-size: 0.8rem;
        }

        .footer-tech span {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 992px) {
            .hero-retro {
                background: var(--cream);
            }

            .hero-container {
                grid-template-columns: 1fr;
                gap: 50px;
                padding: 40px 20px;
            }

            .hero-title-retro {
                font-size: 3rem;
            }

            .navbar-brand-retro {
                padding: 15px 20px;
                font-size: 1.4rem;
            }

            .nav-link-retro {
                display: none;
            }

            .btn-login-retro {
                padding: 15px 25px !important;
            }

            .timeline-line {
                display: none;
            }

            .footer-grid {
                grid-template-columns: 1fr 1fr;
                gap: 30px;
            }
        }

        @media (max-width: 768px) {
            .hero-title-retro {
                font-size: 2.5rem;
            }

            .section-title-retro {
                font-size: 2.2rem;
            }

            .stat-number-retro {
                font-size: 3rem;
            }

            .cta-card-retro {
                padding: 50px 30px;
            }

            .cta-title-retro {
                font-size: 2rem;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .footer-bottom {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .how-retro::before {
                display: none;
            }

            .stats-dashboard {
                box-shadow: 8px 8px 0 var(--charcoal);
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar-retro">
        <div class="container">
            <div class="navbar-inner">
                <a class="navbar-brand-retro" href="/">
                    <div class="brand-icon-retro">
                        <i class="bi bi-archive-fill"></i>
                    </div>
                    RetroVault
                </a>
                <div class="nav-links-retro">
                    <a href="#features" class="nav-link-retro">Features</a>
                    <a href="#process" class="nav-link-retro">Process</a>
                    <a href="#testimonials" class="nav-link-retro">Reviews</a>
                    <a href="{{ route('login') }}" class="btn-login-retro">
                        <i class="bi bi-unlock-fill"></i>
                        Login Portal
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section - New Grid Layout -->
    <section class="hero-retro">
        <div class="hero-container">
            <div class="hero-content" data-aos="fade-right" data-aos-duration="800">
                <div class="hero-badge-retro">
                    <i class="bi bi-gem"></i>
                    Premium Edition 2025
                </div>
                <h1 class="hero-title-retro">
                    Smart Inventory<br>
                    <span class="highlight">Management</span> System
                </h1>
                <p class="hero-subtitle-retro">
                    Elegant solution for modern businesses. Track inventory, manage sales, and analyze performance with timeless efficiency.
                </p>
                <div class="hero-buttons-retro">
                    <a href="{{ route('login') }}" class="btn-primary-retro">
                        <i class="bi bi-arrow-right-circle-fill"></i> Get Started
                    </a>
                    <a href="#features" class="btn-secondary-retro">
                        <i class="bi bi-play-circle"></i> Learn More
                    </a>
                </div>
            </div>
            <div class="hero-visual" data-aos="fade-left" data-aos-duration="800" data-aos-delay="200">
                <div class="stats-dashboard">
                    <div class="stats-header">
                        <h3 class="stats-title">Dashboard Overview</h3>
                        <span class="stats-badge">Live Data</span>
                    </div>
                    <div class="stats-grid">
                        <div class="stat-card-retro teal">
                            <div class="stat-value">{{ number_format($totalBarang) }}</div>
                            <div class="stat-label">Products</div>
                        </div>
                        <div class="stat-card-retro mustard">
                            <div class="stat-value">{{ number_format($totalTransaksi) }}</div>
                            <div class="stat-label">Transactions</div>
                        </div>
                        <div class="stat-card-retro burgundy">
                            <div class="stat-value">Rp{{ number_format($totalPenjualan/1000000, 1) }}M</div>
                            <div class="stat-label">Revenue</div>
                        </div>
                        <div class="stat-card-retro olive">
                            <div class="stat-value">24/7</div>
                            <div class="stat-label">Uptime</div>
                        </div>
                    </div>
                    <div class="mini-chart">
                        <div class="mini-bar" style="height: 60%;"></div>
                        <div class="mini-bar" style="height: 80%;"></div>
                        <div class="mini-bar" style="height: 45%;"></div>
                        <div class="mini-bar" style="height: 90%;"></div>
                        <div class="mini-bar" style="height: 70%;"></div>
                        <div class="mini-bar" style="height: 55%;"></div>
                        <div class="mini-bar" style="height: 85%;"></div>
                        <div class="mini-bar" style="height: 65%;"></div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-retro" id="features">
        <div class="container">
            <div class="section-header-retro" data-aos="fade-up">
                <div class="section-tag">What We Offer</div>
                <h2 class="section-title-retro">Powerful Features</h2>
                <p class="section-subtitle-retro">
                    Everything you need to manage your business with style and precision
                </p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card-retro">
                        <div class="feature-icon-retro">
                            <i class="bi bi-box-seam-fill"></i>
                        </div>
                        <h3 class="feature-title-retro">Product Management</h3>
                        <p class="feature-desc-retro">
                            Complete control over your product catalog with intuitive organization tools.
                        </p>
                        <ul class="feature-list-retro">
                            <li><i class="bi bi-check2-square"></i> Add & Edit Products</li>
                            <li><i class="bi bi-check2-square"></i> Category System</li>
                            <li><i class="bi bi-check2-square"></i> Stock Tracking</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card-retro">
                        <div class="feature-icon-retro">
                            <i class="bi bi-cart-check-fill"></i>
                        </div>
                        <h3 class="feature-title-retro">Sales Transactions</h3>
                        <p class="feature-desc-retro">
                            Streamlined transaction processing with comprehensive history tracking.
                        </p>
                        <ul class="feature-list-retro">
                            <li><i class="bi bi-check2-square"></i> Digital Cashier</li>
                            <li><i class="bi bi-check2-square"></i> Receipt Printing</li>
                            <li><i class="bi bi-check2-square"></i> Sales History</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-card-retro">
                        <div class="feature-icon-retro">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <h3 class="feature-title-retro">Smart Analytics</h3>
                        <p class="feature-desc-retro">
                            Data-driven insights to help you make better business decisions.
                        </p>
                        <ul class="feature-list-retro">
                            <li><i class="bi bi-check2-square"></i> Real-time Dashboard</li>
                            <li><i class="bi bi-check2-square"></i> Best Sellers Report</li>
                            <li><i class="bi bi-check2-square"></i> Low Stock Alerts</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="how-retro" id="process">
        <div class="container">
            <div class="section-header-retro" data-aos="fade-up">
                <div class="section-tag">How It Works</div>
                <h2 class="section-title-retro">Simple Process</h2>
                <p class="section-subtitle-retro">
                    Get started in three easy steps
                </p>
            </div>
            <div class="timeline-container">
                <div class="timeline-line d-none d-lg-block"></div>
                <div class="row">
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="step-card-retro">
                            <div class="step-number-retro">01</div>
                            <h3 class="step-title-retro">Login to System</h3>
                            <p class="step-desc-retro">Access the admin portal with your secure credentials</p>
                        </div>
                    </div>
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="step-card-retro">
                            <div class="step-number-retro">02</div>
                            <h3 class="step-title-retro">Setup Products</h3>
                            <p class="step-desc-retro">Add your inventory and organize by categories</p>
                        </div>
                    </div>
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="step-card-retro">
                            <div class="step-number-retro">03</div>
                            <h3 class="step-title-retro">Start Selling</h3>
                            <p class="step-desc-retro">Process transactions and track your success</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Infinite Marquee Stats Banner -->
    <section class="marquee-section">
        <div class="marquee-container">
            <div class="marquee-track">
                <!-- First set of items -->
                <div class="marquee-item">
                    <div class="marquee-icon"><i class="bi bi-box-seam-fill"></i></div>
                    <div class="marquee-content">
                        <span class="marquee-number">{{ number_format($totalBarang) }}+</span>
                        <span class="marquee-label">Total Produk</span>
                    </div>
                </div>
                <div class="marquee-item">
                    <div class="marquee-icon"><i class="bi bi-cart-check-fill"></i></div>
                    <div class="marquee-content">
                        <span class="marquee-number">{{ number_format($totalTransaksi) }}+</span>
                        <span class="marquee-label">Transaksi</span>
                    </div>
                </div>
                <div class="marquee-item">
                    <div class="marquee-icon"><i class="bi bi-currency-dollar"></i></div>
                    <div class="marquee-content">
                        <span class="marquee-number">Rp{{ number_format($totalPenjualan/1000000, 1) }}M</span>
                        <span class="marquee-label">Total Penjualan</span>
                    </div>
                </div>
                <div class="marquee-item">
                    <div class="marquee-icon"><i class="bi bi-clock-fill"></i></div>
                    <div class="marquee-content">
                        <span class="marquee-number">24/7</span>
                        <span class="marquee-label">Online Support</span>
                    </div>
                </div>
                <div class="marquee-item">
                    <div class="marquee-icon"><i class="bi bi-shield-check"></i></div>
                    <div class="marquee-content">
                        <span class="marquee-number">99.9%</span>
                        <span class="marquee-label">Uptime</span>
                    </div>
                </div>
                <div class="marquee-item">
                    <div class="marquee-icon"><i class="bi bi-lightning-fill"></i></div>
                    <div class="marquee-content">
                        <span class="marquee-number">
                            < 1s</span>
                                <span class="marquee-label">Response Time</span>
                    </div>
                </div>
                <!-- Duplicate set for seamless loop -->
                <div class="marquee-item">
                    <div class="marquee-icon"><i class="bi bi-box-seam-fill"></i></div>
                    <div class="marquee-content">
                        <span class="marquee-number">{{ number_format($totalBarang) }}+</span>
                        <span class="marquee-label">Total Produk</span>
                    </div>
                </div>
                <div class="marquee-item">
                    <div class="marquee-icon"><i class="bi bi-cart-check-fill"></i></div>
                    <div class="marquee-content">
                        <span class="marquee-number">{{ number_format($totalTransaksi) }}+</span>
                        <span class="marquee-label">Transaksi</span>
                    </div>
                </div>
                <div class="marquee-item">
                    <div class="marquee-icon"><i class="bi bi-currency-dollar"></i></div>
                    <div class="marquee-content">
                        <span class="marquee-number">Rp{{ number_format($totalPenjualan/1000000, 1) }}M</span>
                        <span class="marquee-label">Total Penjualan</span>
                    </div>
                </div>
                <div class="marquee-item">
                    <div class="marquee-icon"><i class="bi bi-clock-fill"></i></div>
                    <div class="marquee-content">
                        <span class="marquee-number">24/7</span>
                        <span class="marquee-label">Online Support</span>
                    </div>
                </div>
                <div class="marquee-item">
                    <div class="marquee-icon"><i class="bi bi-shield-check"></i></div>
                    <div class="marquee-content">
                        <span class="marquee-number">99.9%</span>
                        <span class="marquee-label">Uptime</span>
                    </div>
                </div>
                <div class="marquee-item">
                    <div class="marquee-icon"><i class="bi bi-lightning-fill"></i></div>
                    <div class="marquee-content">
                        <span class="marquee-number">
                            < 1s</span>
                                <span class="marquee-label">Response Time</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="why-us-section" id="testimonials">
        <div class="container">
            <div class="section-header-retro" data-aos="fade-up">
                <div class="section-tag">Keunggulan Kami</div>
                <h2 class="section-title-retro">Mengapa Memilih RetroVault?</h2>
                <p class="section-subtitle-retro">
                    Solusi lengkap untuk manajemen inventory bisnis modern Anda
                </p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="why-card">
                        <div class="why-icon">
                            <i class="bi bi-speedometer2"></i>
                        </div>
                        <h3 class="why-title">Performa Cepat</h3>
                        <p class="why-desc">
                            Dibangun dengan teknologi Laravel terbaru untuk memastikan kecepatan akses dan response time yang optimal.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="why-card teal">
                        <div class="why-icon">
                            <i class="bi bi-phone"></i>
                        </div>
                        <h3 class="why-title">Responsive Design</h3>
                        <p class="why-desc">
                            Akses dari perangkat apapun - desktop, tablet, atau smartphone dengan tampilan yang selalu optimal.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="why-card mustard">
                        <div class="why-icon">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <h3 class="why-title">Analytics Real-time</h3>
                        <p class="why-desc">
                            Pantau performa bisnis dengan dashboard analitik yang memberikan insight penjualan secara real-time.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="why-card olive">
                        <div class="why-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <h3 class="why-title">Keamanan Terjamin</h3>
                        <p class="why-desc">
                            Data bisnis Anda dilindungi dengan sistem keamanan berlapis dan enkripsi standar industri.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="why-card">
                        <div class="why-icon">
                            <i class="bi bi-gear-wide-connected"></i>
                        </div>
                        <h3 class="why-title">Mudah Dikustomisasi</h3>
                        <p class="why-desc">
                            Sesuaikan sistem dengan kebutuhan bisnis Anda melalui pengaturan yang fleksibel dan intuitif.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="why-card teal">
                        <div class="why-icon">
                            <i class="bi bi-headset"></i>
                        </div>
                        <h3 class="why-title">Support 24/7</h3>
                        <p class="why-desc">
                            Tim support kami siap membantu Anda kapanpun dibutuhkan untuk memastikan bisnis berjalan lancar.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-retro">
        <div class="container">
            <div class="cta-card-retro" data-aos="zoom-in" data-aos-duration="600">
                <h2 class="cta-title-retro">Siap Memulai Perjalanan Anda?</h2>
                <p class="cta-subtitle-retro">Kelola inventaris bisnis Anda dengan lebih efisien mulai dari sekarang</p>
                <a href="{{ route('login') }}" class="btn-cta-retro">
                    <i class="bi bi-rocket-takeoff-fill"></i> Mulai Sekarang
                </a>
            </div>
        </div>
    </section>

    <!-- Footer with Developer Info -->
    <footer class="footer-retro">
        <div class="container">
            <!-- Footer Main Content -->
            <div class="footer-main">
                <div class="footer-grid">
                    <!-- Brand Column -->
                    <div class="footer-brand-section">
                        <div class="footer-brand-retro">
                            <div class="brand-icon-retro">
                                <i class="bi bi-archive-fill"></i>
                            </div>
                            RetroVault
                        </div>
                        <p class="footer-desc">
                            A modern retro inventory management system built with Laravel. Combining vintage aesthetics with powerful functionality.
                        </p>
                        <div class="footer-social">
                            <a href="https://github.com/catursetyono" target="_blank" title="GitHub">
                                <i class="bi bi-github"></i>
                            </a>
                            <a href="#" title="LinkedIn">
                                <i class="bi bi-linkedin"></i>
                            </a>
                            <a href="#" title="Instagram">
                                <i class="bi bi-instagram"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="footer-column">
                        <h4>Quick Links</h4>
                        <div class="footer-links-retro">
                            <a href="#features"><i class="bi bi-chevron-right"></i> Features</a>
                            <a href="#process"><i class="bi bi-chevron-right"></i> Process</a>
                            <a href="#testimonials"><i class="bi bi-chevron-right"></i> Reviews</a>
                            <a href="{{ route('login') }}"><i class="bi bi-chevron-right"></i> Login</a>
                        </div>
                    </div>

                    <!-- System Info -->
                    <div class="footer-column">
                        <h4>System</h4>
                        <div class="footer-links-retro">
                            <a href="{{ route('login') }}"><i class="bi bi-chevron-right"></i> Dashboard</a>
                            <a href="{{ route('login') }}"><i class="bi bi-chevron-right"></i> Products</a>
                            <a href="{{ route('login') }}"><i class="bi bi-chevron-right"></i> Transactions</a>
                            <a href="{{ route('login') }}"><i class="bi bi-chevron-right"></i> Reports</a>
                        </div>
                    </div>

                    <!-- Developer Info -->
                    <div class="footer-column">
                        <h4>Developer</h4>
                        <div class="footer-developer">
                            <div class="developer-header">
                                <img src="https://ui-avatars.com/api/?name=CS&size=60&background=D4A12A&color=2C2C2C&bold=true" alt="Developer" class="developer-avatar">
                                <div>
                                    <h5 class="developer-name">Catur Setyono</h5>
                                    <span class="developer-nim">NIM: 233210009</span>
                                </div>
                            </div>
                            <div class="developer-details">
                                <span><i class="bi bi-mortarboard-fill"></i> Sistem Informasi Akuntansi</span>
                                <span><i class="bi bi-building"></i> UTDI</span>
                                <span><i class="bi bi-calendar3"></i> Tahun {{ date('Y') }}</span>
                                <span><i class="bi bi-github"></i> <a href="https://github.com/catursetyono" target="_blank">github.com/catursetyono</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <p class="footer-copyright">
                    &copy; {{ date('Y') }} RetroVault. Crafted with <i class="bi bi-heart-fill"></i> for Final Project
                </p>
                <div class="footer-tech">
                    <span><i class="bi bi-code-slash"></i> Laravel</span>
                    <span><i class="bi bi-bootstrap"></i> Bootstrap</span>
                    <span><i class="bi bi-palette"></i> Retro Design</span>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 600,
            easing: 'ease-out-cubic',
            once: true,
            offset: 50
        });

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const offsetTop = target.offsetTop - 70;
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Animate mini chart bars on load
        window.addEventListener('load', () => {
            const bars = document.querySelectorAll('.mini-bar');
            bars.forEach((bar, index) => {
                const heights = [60, 80, 45, 90, 70, 55, 85, 65];
                setTimeout(() => {
                    bar.style.height = heights[index] + '%';
                }, index * 100);
            });
        });
    </script>
</body>

</html>