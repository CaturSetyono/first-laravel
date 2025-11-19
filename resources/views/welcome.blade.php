<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Pendaftaran Mahasiswa</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            opacity: 0.3;
            z-index: 0;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.1) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.4rem;
            color: white !important;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: white !important;
            transform: translateY(-1px);
        }

        .hero-section {
            position: relative;
            z-index: 1;
            padding: 100px 0;
        }

        .hero-content {
            text-align: center;
            color: white;
            max-width: 800px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            background: linear-gradient(45deg, #fff, #f0f0f0);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .hero-subtitle {
            font-size: 1.3rem;
            font-weight: 300;
            margin-bottom: 3rem;
            opacity: 0.9;
            line-height: 1.6;
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-bottom: 4rem;
            flex-wrap: wrap;
        }

        .btn-cta {
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .btn-cta::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }

        .btn-cta:hover::before {
            left: 100%;
        }

        .btn-primary-cta {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            backdrop-filter: blur(10px);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .btn-primary-cta:hover {
            background: rgba(255, 255, 255, 0.3);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .btn-outline-cta {
            background: transparent;
            color: white;
            border-color: rgba(255, 255, 255, 0.5);
        }

        .btn-outline-cta:hover {
            background: white;
            color: #667eea;
            border-color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .features-section {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 3rem;
            margin: 2rem auto;
            max-width: 1000px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            z-index: 1;
        }

        .features-title {
            text-align: center;
            color: white;
            font-size: 2.5rem;
            font-weight: 600;
            margin-bottom: 3rem;
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .feature-item:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateX(10px);
        }

        .feature-icon {
            font-size: 2.5rem;
            color: #fff;
            margin-right: 1.5rem;
            background: rgba(255, 255, 255, 0.2);
            padding: 1rem;
            border-radius: 50%;
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .feature-content h4 {
            color: white;
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 1.2rem;
        }

        .feature-content p {
            color: rgba(255, 255, 255, 0.8);
            margin: 0;
            line-height: 1.5;
        }

        .floating-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
        }

        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 50%;
            right: 10%;
            animation-delay: 2s;
        }

        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
            }

            .features-section {
                padding: 2rem;
                margin: 1rem;
            }

            .feature-item {
                flex-direction: column;
                text-align: center;
            }

            .feature-icon {
                margin-right: 0;
                margin-bottom: 1rem;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>

<body>
    <!-- Floating Shapes -->
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-graduation-cap me-2"></i>SIPMHS
            </a>
            <div class="d-flex">
                @if (Route::has('login'))
                @auth
                <a href="{{ route('dashboard') }}" class="nav-link me-3">Dashboard</a>
                @else
                <a href="{{ route('login') }}" class="nav-link me-3">Masuk</a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="nav-link">Daftar</a>
                @endif
                @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">Sistem Pendaftaran Mahasiswa</h1>
                <p class="hero-subtitle">
                    Platform digital untuk pendaftaran dan pengelolaan data mahasiswa yang mudah,
                    cepat, dan aman. Daftarkan diri Anda sekarang dan kelola profil akademik dengan praktis.
                </p>

                <div class="cta-buttons">
                    @guest
                    <a href="{{ route('register') }}" class="btn btn-cta btn-primary-cta">
                        <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-cta btn-outline-cta">
                        <i class="fas fa-sign-in-alt me-2"></i>Masuk
                    </a>
                    @else
                    <a href="{{ route('dashboard') }}" class="btn btn-cta btn-primary-cta">
                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                    </a>
                    @endguest
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="container">
        <div class="features-section">
            <h2 class="features-title">Tata Cara Pendaftaran</h2>

            <div class="row">
                <div class="col-lg-6">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="feature-content">
                            <h4>1. Buat Akun</h4>
                            <p>Daftarkan akun baru dengan email dan password yang valid untuk mengakses sistem.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-sign-in-alt"></i>
                        </div>
                        <div class="feature-content">
                            <h4>2. Login ke Sistem</h4>
                            <p>Masuk menggunakan email dan password yang telah didaftarkan sebelumnya.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-edit"></i>
                        </div>
                        <div class="feature-content">
                            <h4>3. Lengkapi Data</h4>
                            <p>Isi data profil lengkap meliputi NIM, nama, alamat, tanggal lahir, jenis kelamin, dan program studi.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="feature-content">
                            <h4>4. Kelola Profil</h4>
                            <p>Update atau hapus data profil kapan saja sesuai kebutuhan melalui dashboard mahasiswa.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>