# Proyek Web SIA - Sistem Informasi Akademik

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## 📋 Tentang Project

Project Laravel ini adalah Sistem Informasi Akademik yang mencakup berbagai fitur manajemen transaksi dan master data. Dibangun dengan Laravel 12.33.0 dan AdminLTE untuk interface yang modern dan responsif.

## ✨ Fitur Utama

### 1. **Query Builder Examples**
- Berbagai contoh penggunaan Query Builder
- Operasi CRUD dasar
- Aggregate functions
- Join operations

### 2. **Katalog Buku**
- CRUD lengkap untuk buku
- Relasi dengan pengarang dan kota
- Pencarian dan filtering

### 3. **Sistem Penjualan Online**
- Transaksi penjualan sederhana
- Auto-reduce stock
- Multi-item per transaksi
- Struk pembayaran

### 4. **Sistem Transaksi dengan Pelanggan (POS)**
- Master data pelanggan
- Shopping cart dengan AJAX
- Single Page Application (SPA)
- Real-time calculation
- Track kasir/user
- Print receipt

### 5. **Master Data**
- Jenis Barang
- Barang (dengan stok)
- Pelanggan
- Pengarang & Buku

## 🛠️ Tech Stack

- **Framework:** Laravel 12.33.0
- **PHP:** 8.4.10
- **Database:** MySQL
- **UI:** AdminLTE + Bootstrap 5
- **Icons:** Bootstrap Icons + FontAwesome
- **JavaScript:** jQuery 3.6.0 + AJAX
- **Server:** XAMPP

## 📦 Database Structure

### Tables:
- `users` - User authentication
- `pelanggan` - Customer data
- `jenis_barang` - Product categories
- `barang` - Products with stock
- `kota` - Cities
- `pengarang` - Authors
- `buku` - Books
- `jual` - Sales transactions
- `detail_jual` - Transaction details

## 🚀 Installation

```bash
# Clone repository
git clone https://github.com/lana-techn/Proyek-Web-SIA.git

# Install dependencies
composer install
npm install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure database in .env
DB_DATABASE=proyek_web
DB_USERNAME=root
DB_PASSWORD=

# Run migrations
php artisan migrate

# Seed database with sample data
php artisan db:seed

# Run development server
php artisan serve
```

## 📊 Database Seeding

### Quick Setup on New Device

Gunakan seeder otomatis untuk setup database lengkap dengan satu command:

```bash
# Fresh database + seeding all sample data
php artisan migrate:fresh --seed

# Atau hanya seeding tanpa fresh
php artisan db:seed --class=DataSeeder
```

### Data yang di-seed:

```
✅ Jenis Barang: 8 kategori (Elektronik, Pakaian, Makanan, etc)
✅ Barang: 20 produk dengan stock dan harga
✅ Pelanggan: 5 customer dengan data lengkap
✅ Kota: 5 kota di Indonesia
✅ Pengarang: 5 author buku Indonesia
✅ Buku: 7 buku dengan ISBN dan detail
```

### DataSeeder Details:

- **File:** `database/seeders/DataSeeder.php`
- **Backup Data:** `database_backup.json` (JSON export dari database)
- **Status:** Tested & verified ✅

### Untuk Migrasi ke Device Baru:

1. Clone repository
2. Copy `.env` dan configure database
3. Run: `php artisan migrate:fresh --seed`
4. Database siap dengan semua sample data!

## 👤 Default Users

```
Admin User:
Email: admin@panuntun.com
Password: password

Test User:
Email: test@example.com
Password: password
```

## 📊 Sample Data

Setelah seeding, database akan memiliki:
- 2 Users
- 8 Jenis Barang
- 20 Barang
- 5 Pelanggan
- 5 Kota
- 5 Pengarang
- 7 Buku

## 🎨 Features Preview

### Transaction Flow (POS System):
1. `/jual` - Daftar transaksi
2. `/jual/create` - Form pelanggan (AJAX lookup)
3. Shopping cart - Tambah barang dinamis
4. Submit - Auto reduce stock
5. Print receipt

### Query Builder Examples:
- `/db/bacaDb1` - Basic select
- `/db/bacaDb2` - Where conditions
- `/db/aggregate` - Count, sum, avg, etc.
- `/db/selectData` - Advanced queries

## 📝 License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 👨‍💻 Developer

Developed for academic purposes - Proyek Web SIA
