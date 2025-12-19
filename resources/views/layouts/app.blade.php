<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'RetroVault - Management System')</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts - Retro Theme -->
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Space+Grotesk:wght@300;400;500;600;700&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">
    <style>
        :root {
            --cream: #F5F0E8;
            --cream-dark: #E8E0D0;
            --cream-light: #FAF8F5;
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
            --olive-light: #7A8B6A;
            --terracotta: #C65D3B;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            overflow-y: auto;
            background-color: var(--cream);
            font-family: 'Space Grotesk', -apple-system, BlinkMacSystemFont, sans-serif;
            color: var(--charcoal);
        }

        h1,
        h2,
        h3,
        h4,
        h5 {
            font-family: 'DM Serif Display', serif;
        }

        /* ===== SIDEBAR RETRO STYLE ===== */
        .sidebar {
            width: 280px;
            background-color: var(--charcoal);
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            padding-top: 0;
            color: var(--cream);
            overflow-y: auto;
            border-right: 5px solid var(--mustard);
        }

        .sidebar-brand {
            background-color: var(--burgundy);
            padding: 25px 20px;
            text-align: center;
            border-bottom: 4px solid var(--mustard);
            position: relative;
        }

        .sidebar-brand::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 0;
            border-left: 15px solid transparent;
            border-right: 15px solid transparent;
            border-top: 15px solid var(--mustard);
        }

        .sidebar-brand h4 {
            font-family: 'Bebas Neue', sans-serif;
            letter-spacing: 4px;
            margin: 0;
            font-size: 1.8rem;
            color: var(--cream);
        }

        .sidebar-brand span {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 0.7rem;
            color: var(--mustard);
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .sidebar-menu {
            padding: 30px 0 20px;
        }

        .sidebar a {
            color: var(--cream-dark);
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 14px 24px;
            margin: 4px 12px;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 0.9rem;
            border-left: 4px solid transparent;
            position: relative;
        }

        .sidebar a i {
            margin-right: 14px;
            font-size: 1.15rem;
            color: var(--mustard);
            width: 24px;
            text-align: center;
        }

        .sidebar a:hover {
            background-color: rgba(212, 161, 42, 0.1);
            color: var(--mustard);
            border-left-color: var(--mustard);
        }

        .sidebar a.active {
            background-color: var(--burgundy);
            color: var(--cream);
            border-left-color: var(--mustard);
        }

        .sidebar a.active i {
            color: var(--mustard);
        }

        .sidebar hr {
            margin: 15px 20px;
            border-color: var(--charcoal-light);
            opacity: 1;
        }

        .sidebar h6 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 0.85rem;
            letter-spacing: 3px;
            text-transform: uppercase;
            padding: 10px 24px 5px;
            color: var(--mustard);
            margin: 0;
        }

        /* ===== NAVBAR RETRO STYLE ===== */
        .navbar {
            background-color: var(--cream);
            border-bottom: 4px solid var(--charcoal);
            box-shadow: none;
            margin-left: 280px;
        }

        .navbar-brand {
            color: var(--charcoal) !important;
            font-size: 1.5rem;
            font-weight: 700;
            font-family: 'Bebas Neue', sans-serif;
            letter-spacing: 3px;
        }

        .navbar-brand i {
            color: var(--burgundy);
            margin-right: 10px;
        }

        .navbar .nav-link {
            color: var(--charcoal) !important;
            font-weight: 500;
        }

        .navbar .nav-link:hover {
            color: var(--burgundy) !important;
        }

        /* ===== CONTENT WRAPPER ===== */
        .content-wrapper {
            margin-left: 280px;
            padding: 30px 40px 50px;
            min-height: 100vh;
            overflow-y: auto;
            background-color: var(--cream);
        }

        /* Page Header */
        .page-header {
            background-color: var(--cream-dark);
            border: 3px solid var(--charcoal);
            padding: 25px 30px;
            margin-bottom: 30px;
            position: relative;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: -8px;
            left: 20px;
            width: 60px;
            height: 8px;
            background-color: var(--burgundy);
        }

        .page-header h1 {
            margin: 0;
            font-size: 2rem;
            color: var(--charcoal);
        }

        .page-header .breadcrumb {
            margin: 5px 0 0;
            padding: 0;
            background: transparent;
        }

        .page-header .breadcrumb-item {
            color: var(--charcoal-light);
            font-size: 0.85rem;
        }

        .page-header .breadcrumb-item.active {
            color: var(--burgundy);
        }

        /* ===== CARDS RETRO STYLE ===== */
        .card {
            background-color: var(--cream-light);
            border: 3px solid var(--charcoal);
            border-radius: 0;
            box-shadow: 8px 8px 0 var(--charcoal);
            margin-bottom: 25px;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translate(-3px, -3px);
            box-shadow: 11px 11px 0 var(--charcoal);
        }

        .card-header {
            background-color: var(--charcoal);
            border-bottom: 4px solid var(--mustard);
            color: var(--cream);
            padding: 15px 20px;
            font-family: 'DM Serif Display', serif;
            font-size: 1.1rem;
        }

        .card-body {
            padding: 25px;
        }

        .card-footer {
            background-color: var(--cream-dark);
            border-top: 2px solid var(--charcoal);
            padding: 15px 20px;
        }

        /* ===== STAT CARDS ===== */
        .stat-card {
            border: 3px solid var(--charcoal);
            padding: 25px;
            text-align: center;
            position: relative;
            transition: all 0.3s ease;
        }

        .stat-card.burgundy {
            background-color: var(--burgundy);
            color: var(--cream);
        }

        .stat-card.teal {
            background-color: var(--teal);
            color: var(--cream);
        }

        .stat-card.mustard {
            background-color: var(--mustard);
            color: var(--charcoal);
        }

        .stat-card.olive {
            background-color: var(--olive);
            color: var(--cream);
        }

        .stat-card .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 10px;
            opacity: 0.8;
        }

        .stat-card .stat-number {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 3rem;
            letter-spacing: 2px;
        }

        .stat-card .stat-label {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-top: 5px;
        }

        /* ===== TABLES RETRO STYLE ===== */
        .table {
            background-color: var(--cream-light);
            border: 2px solid var(--charcoal);
        }

        .table thead th {
            background-color: var(--teal);
            color: var(--cream);
            border: none;
            font-family: 'Space Grotesk', sans-serif;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 15px 12px;
        }

        .table tbody tr {
            border-bottom: 1px solid var(--cream-dark);
        }

        .table tbody tr:hover {
            background-color: rgba(212, 161, 42, 0.1);
        }

        .table tbody td {
            padding: 15px 12px;
            color: var(--charcoal);
            vertical-align: middle;
            border: none;
        }

        /* ===== BUTTONS RETRO STYLE ===== */
        .btn {
            border-radius: 0;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.85rem;
            padding: 10px 20px;
            border: 2px solid var(--charcoal);
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .btn-primary {
            background-color: var(--burgundy);
            border-color: var(--charcoal);
            color: var(--cream);
        }

        .btn-primary:hover {
            background-color: var(--burgundy-dark);
            border-color: var(--charcoal);
            box-shadow: 4px 4px 0 var(--charcoal);
        }

        .btn-success {
            background-color: var(--teal);
            border-color: var(--charcoal);
            color: var(--cream);
        }

        .btn-success:hover {
            background-color: var(--teal-dark);
            border-color: var(--charcoal);
            box-shadow: 4px 4px 0 var(--charcoal);
        }

        .btn-warning {
            background-color: var(--mustard);
            border-color: var(--charcoal);
            color: var(--charcoal);
        }

        .btn-warning:hover {
            background-color: var(--mustard-dark);
            border-color: var(--charcoal);
            box-shadow: 4px 4px 0 var(--charcoal);
        }

        .btn-danger {
            background-color: var(--terracotta);
            border-color: var(--charcoal);
            color: var(--cream);
        }

        .btn-danger:hover {
            background-color: #A84D30;
            border-color: var(--charcoal);
            box-shadow: 4px 4px 0 var(--charcoal);
        }

        .btn-info {
            background-color: var(--olive);
            border-color: var(--charcoal);
            color: var(--cream);
        }

        .btn-info:hover {
            background-color: #4A5740;
            border-color: var(--charcoal);
            box-shadow: 4px 4px 0 var(--charcoal);
        }

        .btn-outline-primary {
            background-color: transparent;
            border-color: var(--burgundy);
            color: var(--burgundy);
        }

        .btn-outline-primary:hover {
            background-color: var(--burgundy);
            color: var(--cream);
        }

        /* ===== FORMS RETRO STYLE ===== */
        .form-control {
            background-color: var(--cream-light);
            border: 2px solid var(--charcoal);
            border-radius: 0;
            color: var(--charcoal);
            padding: 12px 15px;
            font-size: 0.95rem;
        }

        .form-control:focus {
            border-color: var(--burgundy);
            box-shadow: 4px 4px 0 var(--mustard);
            background-color: var(--cream);
        }

        .form-control::placeholder {
            color: #999;
        }

        .form-label {
            color: var(--charcoal);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.8rem;
            margin-bottom: 8px;
        }

        .form-select {
            background-color: var(--cream-light);
            border: 2px solid var(--charcoal);
            border-radius: 0;
            color: var(--charcoal);
            padding: 12px 15px;
        }

        .form-select:focus {
            border-color: var(--burgundy);
            box-shadow: 4px 4px 0 var(--mustard);
        }

        /* ===== BADGES ===== */
        .badge {
            border-radius: 0;
            font-weight: 600;
            letter-spacing: 1px;
            padding: 6px 12px;
        }

        .badge.bg-primary {
            background-color: var(--burgundy) !important;
        }

        .badge.bg-success {
            background-color: var(--teal) !important;
        }

        .badge.bg-warning {
            background-color: var(--mustard) !important;
            color: var(--charcoal) !important;
        }

        .badge.bg-danger {
            background-color: var(--terracotta) !important;
        }

        .badge.bg-info {
            background-color: var(--olive) !important;
        }

        /* ===== ALERTS ===== */
        .alert {
            border-radius: 0;
            border-width: 3px;
            padding: 20px 25px;
        }

        .alert-success {
            background-color: rgba(45, 106, 106, 0.15);
            border-color: var(--teal);
            color: var(--teal-dark);
        }

        .alert-danger {
            background-color: rgba(139, 41, 66, 0.15);
            border-color: var(--burgundy);
            color: var(--burgundy-dark);
        }

        .alert-warning {
            background-color: rgba(212, 161, 42, 0.15);
            border-color: var(--mustard);
            color: var(--mustard-dark);
        }

        .alert-info {
            background-color: rgba(92, 107, 77, 0.15);
            border-color: var(--olive);
            color: var(--olive);
        }

        /* ===== PAGINATION ===== */
        .pagination .page-link {
            background-color: var(--cream-light);
            border: 2px solid var(--charcoal);
            color: var(--charcoal);
            border-radius: 0;
            margin: 0 3px;
            font-weight: 600;
        }

        .pagination .page-link:hover {
            background-color: var(--cream-dark);
            border-color: var(--charcoal);
            color: var(--charcoal);
        }

        .pagination .page-item.active .page-link {
            background-color: var(--burgundy);
            border-color: var(--burgundy);
            color: var(--cream);
        }

        /* ===== MODAL ===== */
        .modal-content {
            border: 3px solid var(--charcoal);
            border-radius: 0;
            box-shadow: 10px 10px 0 var(--charcoal);
        }

        .modal-header {
            background-color: var(--charcoal);
            color: var(--cream);
            border-bottom: 4px solid var(--mustard);
        }

        .modal-title {
            font-family: 'DM Serif Display', serif;
        }

        .btn-close {
            filter: invert(1);
        }

        /* ===== FOOTER ===== */
        footer {
            text-align: center;
            margin-top: 50px;
            padding: 25px 0;
            background-color: var(--charcoal);
            color: var(--cream-dark);
            font-size: 0.85rem;
            border-top: 4px solid var(--mustard);
            margin-left: -40px;
            margin-right: -40px;
            margin-bottom: -50px;
        }

        footer strong {
            color: var(--mustard);
            font-family: 'Bebas Neue', sans-serif;
            letter-spacing: 2px;
        }

        /* ===== SCROLLBAR ===== */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: var(--cream-dark);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--burgundy);
            border: 2px solid var(--cream-dark);
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--burgundy-dark);
        }

        /* ===== DECORATIVE ELEMENTS ===== */
        .retro-divider {
            display: flex;
            align-items: center;
            margin: 30px 0;
        }

        .retro-divider::before,
        .retro-divider::after {
            content: '';
            flex: 1;
            height: 3px;
            background-color: var(--charcoal);
        }

        .retro-divider span {
            padding: 0 20px;
            font-family: 'Bebas Neue', sans-serif;
            letter-spacing: 3px;
            color: var(--burgundy);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                z-index: 1050;
                transition: transform 0.3s ease;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .navbar {
                margin-left: 0;
            }

            .content-wrapper {
                margin-left: 0;
                padding: 20px;
            }

            footer {
                margin-left: -20px;
                margin-right: -20px;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <h4><i class="bi bi-archive-fill"></i> RetroVault</h4>
            <span>Management System</span>
        </div>

        <div class="sidebar-menu">
            <h6>Main Menu</h6>
            <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">
                <i class="bi bi-house-door-fill"></i> Dashboard
            </a>

            <hr>
            <h6>Query Builder</h6>
            <a href="{{ url('db/bacaDb1') }}" class="{{ request()->is('db/bacaDb1') ? 'active' : '' }}">
                <i class="bi bi-geo-alt-fill"></i> City Data
            </a>
            <a href="{{ url('db/selectData') }}" class="{{ request()->is('db/selectData') ? 'active' : '' }}">
                <i class="bi bi-box-fill"></i> Product Data
            </a>

            <hr>
            <h6>Book Catalog</h6>
            <a href="{{ route('buku.index') }}" class="{{ request()->routeIs('buku.*') ? 'active' : '' }}">
                <i class="bi bi-book-fill"></i> Book List
            </a>

            <hr>
            <h6>Sales Management</h6>
            <a href="{{ route('penjualan.index') }}" class="{{ request()->routeIs('penjualan.index') ? 'active' : '' }}">
                <i class="bi bi-cart-fill"></i> Transactions
            </a>
            <a href="{{ route('penjualan.create') }}" class="{{ request()->routeIs('penjualan.create') ? 'active' : '' }}">
                <i class="bi bi-plus-circle-fill"></i> New Transaction
            </a>

            <hr>
            <h6>Master Data</h6>
            <a href="{{ route('jenis-barang.index') }}" class="{{ request()->routeIs('jenis-barang.*') ? 'active' : '' }}">
                <i class="bi bi-tags-fill"></i> Product Types
            </a>
            <a href="{{ route('barang.index') }}" class="{{ request()->routeIs('barang.*') ? 'active' : '' }}">
                <i class="bi bi-box-seam-fill"></i> Products
            </a>

            <hr>
            <a href="#" onclick="return confirm('Are you sure you want to logout?')">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </div>
    </div>

    <!-- Navbar (mobile toggle) -->
    <nav class="navbar navbar-expand-lg fixed-top d-lg-none">
        <div class="container-fluid">
            <button class="btn btn-outline-primary me-3" onclick="document.getElementById('sidebar').classList.toggle('show')">
                <i class="bi bi-list"></i>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="bi bi-archive-fill"></i> RetroVault
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="content-wrapper">
        <div class="container-fluid">
            @yield('content')
        </div>
        <footer>
            <p class="mb-1">&copy; {{ date('Y') }} <strong>RetroVault</strong> - Modern Retro Management System</p>
            <p class="mb-0" style="font-size: 0.75rem;">Crafted by Catur Setyono • NIM 233210009</p>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>