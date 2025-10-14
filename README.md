# 🚀 First Laravel - Simple Dashboard Application

> **Aplikasi Laravel sederhana untuk memahami struktur dan konsep dasar Laravel framework**

[![Laravel](https://img.shields.io/badge/Laravel-12.x-red.svg)](https://laravel.com/)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net/)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

## 📖 Deskripsi

Ini adalah aplikasi Laravel pembelajaran yang dibuat untuk memahami struktur dan cara kerja Laravel framework. Aplikasi ini menampilkan dashboard sederhana dengan statistik dan UI yang clean.

## ✨ Fitur

-   🏠 **Home Page** - Landing page dengan dashboard overview
-   📊 **Dashboard** - Halaman dashboard dengan statistik cards
-   🎨 **Responsive Design** - UI yang responsive menggunakan CSS Grid
-   🔧 **Clean Architecture** - Mengikuti konvensi Laravel MVC

## 🏗️ Struktur Aplikasi

### 📁 Direktori Utama

```
📦 first-laravel/
├── 🎯 app/                          # Core aplikasi
│   ├── Http/
│   │   └── Controllers/             # Controllers (kosong - menggunakan closure routes)
│   ├── Models/
│   │   └── User.php                 # User model (default Laravel)
│   └── Providers/
│       └── AppServiceProvider.php   # Service provider utama
├── ⚙️ config/                       # File konfigurasi
│   ├── app.php                      # Konfigurasi aplikasi
│   ├── database.php                 # Konfigurasi database
│   └── ...                          # Konfigurasi lainnya
├── 🗄️ database/                     # Database related files
│   ├── migrations/                  # Schema database
│   ├── seeders/                     # Data seeder
│   └── factories/                   # Model factories
├── 🌐 public/                       # Web accessible files
│   ├── index.php                    # Entry point aplikasi
│   ├── css/                         # Public CSS
│   └── build/                       # Compiled assets
├── 📄 resources/                    # Views dan assets
│   ├── views/                       # Blade templates
│   │   ├── Home.blade.php           # Home page template
│   │   └── Dashboard.blade.php      # Dashboard template
│   ├── css/                         # Source CSS
│   └── js/                          # Source JavaScript
├── 🛣️ routes/
│   ├── web.php                      # Web routes
│   └── console.php                  # Console routes
└── 🧪 tests/                        # Test files
    ├── Feature/                     # Feature tests
    └── Unit/                        # Unit tests
```

### 🎯 Routes yang Tersedia

| Method | URI | Action | Description |
|--------|-----|--------|-------------|
| GET | `/` | Closure | Home page dengan dashboard overview |
| GET | `/dashboard` | Closure | Dashboard dengan statistik cards |

## 🚀 Cara Menjalankan

### Prasyarat

-   PHP 8.2 atau lebih tinggi
-   Composer
-   Node.js & NPM (untuk asset compilation)

### Instalasi

1. **Clone repository**

    ```bash
    git clone https://github.com/CaturSetyono/first-laravel.git
    cd first-laravel
    ```

2. **Install dependencies**

    ```bash
    composer install
    npm install
    ```

3. **Setup environment**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Jalankan aplikasi**

    ```bash
    php artisan serve
    ```

5. **Akses aplikasi**
    - Home: http://localhost:8000
    - Dashboard: http://localhost:8000/dashboard

## 🎨 UI/UX Features

### Home Page (`/`)

-   **Navigation Bar** dengan branding "Admin Dashboard"
-   **Welcome Section** dengan gradient background
-   **Statistics Cards** menampilkan:
    -   Total Users: 2,543 (↑ 12.5%)
    -   Active Projects: 12 (↑ 3 new)
    -   Total Revenue: $45,678 (↑ 8.2%)
    -   Completion Rate: 94.2% (↑ 2.1%)

### Dashboard Page (`/dashboard`)

-   Interface yang sama dengan Home page
-   Menampilkan metrics dan statistik bisnis
-   Design responsive dengan CSS Grid
-   Color scheme modern dengan Inter font

## 🧠 Konsep Laravel yang Diimplementasikan

### 1. **Routing**

```php
// routes/web.php
Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});
```

### 2. **Blade Templating**

-   Menggunakan file `.blade.php` untuk views
-   Template engine Laravel untuk rendering HTML
-   Lokasi: `resources/views/`

### 3. **MVC Pattern**

-   **Model**: `app/Models/User.php` (default)
-   **View**: `resources/views/*.blade.php`
-   **Controller**: Saat ini menggunakan closure di routes

### 4. **Asset Management**

-   CSS: `resources/css/app.css`
-   JavaScript: `resources/js/app.js`
-   Compiled assets: `public/build/`

## 📚 Pembelajaran Laravel

### Konsep yang Sudah Diimplementasikan ✅

-   [x] Basic Routing
-   [x] Blade Templates
-   [x] View Rendering
-   [x] Asset Structure
-   [x] Laravel Project Structure

### Next Steps untuk Pengembangan 🎯

-   [ ] **Controllers**: Pindahkan logic dari routes ke controllers
-   [ ] **Database**: Setup database dan migrations
-   [ ] **Models**: Buat models untuk data management
-   [ ] **Forms**: Implementasi form handling dan validation
-   [ ] **Authentication**: Sistem login/register
-   [ ] **CRUD Operations**: Create, Read, Update, Delete
-   [ ] **API Routes**: RESTful API endpoints
-   [ ] **Middleware**: Authentication dan authorization
-   [ ] **Testing**: Unit dan feature tests

## 🛠️ Development Commands

```bash
# Menjalankan development server
php artisan serve

# Menjalankan tests
php artisan test

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Generate key
php artisan key:generate

# Database operations
php artisan migrate
php artisan db:seed

# Make commands
php artisan make:controller ControllerName
php artisan make:model ModelName
php artisan make:migration migration_name

# Update README otomatis
composer update-readme
```

## 🔧 Teknologi yang Digunakan

-   **Backend**: Laravel 12.x, PHP 8.2+
-   **Frontend**: Blade Templates, Vanilla CSS, JavaScript
-   **Database**: SQLite (default), MySQL/PostgreSQL support
-   **Build Tools**: Vite, NPM
-   **Testing**: PHPUnit
-   **Code Quality**: Laravel Pint

## 🤖 Auto-Update README System

Aplikasi ini dilengkapi dengan sistem otomatis untuk update README setiap kali ada perubahan:

### � Fitur Auto-Update

-   **Deteksi Otomatis**: Scan struktur project dan update dokumentasi
-   **Git Hook Integration**: Auto-update saat commit
-   **Manual Update**: Command `composer update-readme`

### 📋 Yang Diupdate Otomatis

-   ✅ **Routes Table**: Deteksi routes baru dan update tabel
-   ✅ **Features Checklist**: Update status fitur yang sudah diimplementasikan
-   ✅ **Project Structure**: Scan controllers, models, views, migrations
-   ✅ **Timestamp**: Update waktu modifikasi terakhir

### 🛠️ Cara Menggunakan

```bash
# Update manual
composer update-readme

# Atau jalankan langsung
php readme-updater.php

# Auto-update aktif saat git commit (via pre-commit hook)
git commit -m "Your changes"
```

### ⚙️ Konfigurasi

File `readme-updater.php` berisi logika untuk:

-   Scan routes dari `routes/web.php`
-   Deteksi controllers di `app/Http/Controllers/`
-   Scan models di `app/Models/`
-   Deteksi views di `resources/views/`
-   Check migrations di `database/migrations/`

## �📝 Catatan Pengembangan

### Versi Saat Ini: v1.0.0

-   ✅ Basic routing setup
-   ✅ Home dan Dashboard views
-   ✅ Responsive UI design
-   ✅ Clean project structure
-   ✅ Auto-update README system
-   ✅ Responsive UI design
-   ✅ Clean project structure

### Update History

-   **14 Oktober 2025**: Initial project setup dengan basic routing dan views

## 🤝 Kontribusi

Ini adalah project pembelajaran, jadi feel free untuk:

-   Menambahkan fitur baru
-   Memperbaiki bug
-   Meningkatkan dokumentasi
-   Menambahkan tests

## 📄 License

Aplikasi ini menggunakan [MIT License](LICENSE).

---

**Dibuat dengan ❤️ untuk pembelajaran Laravel framework**

> **Tips**: Gunakan `php artisan serve` untuk menjalankan aplikasi dan mulai eksplorasi!
