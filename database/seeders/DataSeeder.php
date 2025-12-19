<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Seeder ini berisi semua data dari production database
     * untuk memudahkan setup di device baru
     */
    public function run(): void
    {
        // Seed Jenis Barang
        DB::table('jenis_barang')->insert([
            [
                'id' => 1,
                'nama_jenis' => 'Elektronik',
                'kode_jenis' => 'ELK',
                'deskripsi' => 'Barang-barang elektronik seperti handphone, laptop, TV, dll',
                'aktif' => 1,
                'created_at' => '2025-11-12 03:54:27',
                'updated_at' => '2025-11-12 03:54:27',
            ],
            [
                'id' => 2,
                'nama_jenis' => 'Pakaian',
                'kode_jenis' => 'PKN',
                'deskripsi' => 'Pakaian pria, wanita, dan anak-anak',
                'aktif' => 1,
                'created_at' => '2025-11-12 03:54:27',
                'updated_at' => '2025-11-12 03:54:27',
            ],
            [
                'id' => 3,
                'nama_jenis' => 'Makanan & Minuman',
                'kode_jenis' => 'FNB',
                'deskripsi' => 'Produk makanan dan minuman',
                'aktif' => 1,
                'created_at' => '2025-11-12 03:54:27',
                'updated_at' => '2025-11-12 03:54:27',
            ],
            [
                'id' => 4,
                'nama_jenis' => 'Peralatan Rumah Tangga',
                'kode_jenis' => 'HME',
                'deskripsi' => 'Peralatan dan perlengkapan rumah tangga',
                'aktif' => 1,
                'created_at' => '2025-11-12 03:54:27',
                'updated_at' => '2025-11-12 03:54:27',
            ],
            [
                'id' => 5,
                'nama_jenis' => 'Buku & Alat Tulis',
                'kode_jenis' => 'BKS',
                'deskripsi' => 'Buku, majalah, alat tulis, dan perlengkapan kantor',
                'aktif' => 1,
                'created_at' => '2025-11-12 03:54:27',
                'updated_at' => '2025-11-12 03:54:27',
            ],
            [
                'id' => 6,
                'nama_jenis' => 'Olahraga & Outdoor',
                'kode_jenis' => 'SPT',
                'deskripsi' => 'Peralatan olahraga dan aktivitas outdoor',
                'aktif' => 1,
                'created_at' => '2025-11-12 03:54:27',
                'updated_at' => '2025-11-12 03:54:27',
            ],
            [
                'id' => 7,
                'nama_jenis' => 'Kecantikan & Kesehatan',
                'kode_jenis' => 'BTY',
                'deskripsi' => 'Produk kecantikan, perawatan, dan kesehatan',
                'aktif' => 1,
                'created_at' => '2025-11-12 03:54:27',
                'updated_at' => '2025-11-12 03:54:27',
            ],
            [
                'id' => 8,
                'nama_jenis' => 'Otomotif',
                'kode_jenis' => 'OTO',
                'deskripsi' => 'Spare part dan aksesoris kendaraan',
                'aktif' => 1,
                'created_at' => '2025-11-12 03:54:27',
                'updated_at' => '2025-11-12 03:54:27',
            ],
        ]);

        // Seed Barang (20 items)
        DB::table('barang')->insert([
            ['id' => 1001, 'jenis_barang' => 1, 'nama_barang' => 'Laptop ASUS ROG', 'satuan' => 'Unit', 'harga_pokok' => 12000000, 'harga_jual' => 15000000, 'stok' => 10, 'create_at' => now(), 'update_at' => now()],
            ['id' => 1002, 'jenis_barang' => 1, 'nama_barang' => 'Samsung Galaxy S23', 'satuan' => 'Unit', 'harga_pokok' => 8000000, 'harga_jual' => 10000000, 'stok' => 25, 'create_at' => now(), 'update_at' => now()],
            ['id' => 1003, 'jenis_barang' => 1, 'nama_barang' => 'Smart TV LG 43 Inch', 'satuan' => 'Unit', 'harga_pokok' => 4000000, 'harga_jual' => 5500000, 'stok' => 15, 'create_at' => now(), 'update_at' => now()],
            ['id' => 1004, 'jenis_barang' => 1, 'nama_barang' => 'Headphone Sony WH-1000XM5', 'satuan' => 'Unit', 'harga_pokok' => 2500000, 'harga_jual' => 3500000, 'stok' => 20, 'create_at' => now(), 'update_at' => now()],
            ['id' => 1005, 'jenis_barang' => 1, 'nama_barang' => 'Tablet iPad Pro 12.9', 'satuan' => 'Unit', 'harga_pokok' => 7000000, 'harga_jual' => 9500000, 'stok' => 8, 'create_at' => now(), 'update_at' => now()],
            ['id' => 2001, 'jenis_barang' => 2, 'nama_barang' => 'Kemeja Batik Pria', 'satuan' => 'Pcs', 'harga_pokok' => 150000, 'harga_jual' => 250000, 'stok' => 50, 'create_at' => now(), 'update_at' => now()],
            ['id' => 2002, 'jenis_barang' => 2, 'nama_barang' => 'Dress Wanita', 'satuan' => 'Pcs', 'harga_pokok' => 200000, 'harga_jual' => 350000, 'stok' => 40, 'create_at' => now(), 'update_at' => now()],
            ['id' => 2003, 'jenis_barang' => 2, 'nama_barang' => 'Celana Jeans Pria', 'satuan' => 'Pcs', 'harga_pokok' => 100000, 'harga_jual' => 200000, 'stok' => 60, 'create_at' => now(), 'update_at' => now()],
            ['id' => 2004, 'jenis_barang' => 2, 'nama_barang' => 'Jaket Kulit', 'satuan' => 'Pcs', 'harga_pokok' => 350000, 'harga_jual' => 600000, 'stok' => 20, 'create_at' => now(), 'update_at' => now()],
            ['id' => 2005, 'jenis_barang' => 2, 'nama_barang' => 'Sepatu Olahraga', 'satuan' => 'Pcs', 'harga_pokok' => 150000, 'harga_jual' => 300000, 'stok' => 35, 'create_at' => now(), 'update_at' => now()],
            ['id' => 3001, 'jenis_barang' => 3, 'nama_barang' => 'Kopi Premium 500g', 'satuan' => 'Box', 'harga_pokok' => 50000, 'harga_jual' => 85000, 'stok' => 100, 'create_at' => now(), 'update_at' => now()],
            ['id' => 3002, 'jenis_barang' => 3, 'nama_barang' => 'Teh Hijau 250g', 'satuan' => 'Box', 'harga_pokok' => 30000, 'harga_jual' => 50000, 'stok' => 75, 'create_at' => now(), 'update_at' => now()],
            ['id' => 3003, 'jenis_barang' => 3, 'nama_barang' => 'Biscuit Coklat 200g', 'satuan' => 'Box', 'harga_pokok' => 20000, 'harga_jual' => 35000, 'stok' => 120, 'create_at' => now(), 'update_at' => now()],
            ['id' => 4001, 'jenis_barang' => 4, 'nama_barang' => 'Lemari Es 2 Pintu', 'satuan' => 'Unit', 'harga_pokok' => 3000000, 'harga_jual' => 4500000, 'stok' => 5, 'create_at' => now(), 'update_at' => now()],
            ['id' => 4002, 'jenis_barang' => 4, 'nama_barang' => 'Mesin Cuci', 'satuan' => 'Unit', 'harga_pokok' => 2000000, 'harga_jual' => 3200000, 'stok' => 8, 'create_at' => now(), 'update_at' => now()],
            ['id' => 5001, 'jenis_barang' => 5, 'nama_barang' => 'Novel Laskar Pelangi', 'satuan' => 'Pcs', 'harga_pokok' => 50000, 'harga_jual' => 75000, 'stok' => 50, 'create_at' => now(), 'update_at' => now()],
            ['id' => 5002, 'jenis_barang' => 5, 'nama_barang' => 'Novel Bumi', 'satuan' => 'Pcs', 'harga_pokok' => 70000, 'harga_jual' => 95000, 'stok' => 40, 'create_at' => now(), 'update_at' => now()],
            ['id' => 6001, 'jenis_barang' => 6, 'nama_barang' => 'Bola Sepak Professional', 'satuan' => 'Pcs', 'harga_pokok' => 80000, 'harga_jual' => 150000, 'stok' => 25, 'create_at' => now(), 'update_at' => now()],
            ['id' => 7001, 'jenis_barang' => 7, 'nama_barang' => 'Serum Wajah Anti Aging', 'satuan' => 'Bot', 'harga_pokok' => 80000, 'harga_jual' => 150000, 'stok' => 30, 'create_at' => now(), 'update_at' => now()],
            ['id' => 8001, 'jenis_barang' => 8, 'nama_barang' => 'Oli Mesin Premium 1L', 'satuan' => 'Botol', 'harga_pokok' => 60000, 'harga_jual' => 100000, 'stok' => 80, 'create_at' => now(), 'update_at' => now()],
        ]);

        // Seed Pelanggan
        DB::table('pelanggan')->insert([
            [
                'id' => 1,
                'nama_pelanggan' => 'Ahmad Rizki',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Merdeka No. 10, Jakarta Pusat',
                'telp_hp' => '081234567890',
                'email' => 'ahmad.rizki@email.com',
                'created_at' => '2025-11-12 04:00:00',
                'updated_at' => '2025-11-12 04:00:00',
            ],
            [
                'id' => 2,
                'nama_pelanggan' => 'Siti Nurhaliza',
                'jenis_kelamin' => 'P',
                'alamat' => 'Jl. Sudirman No. 45, Jakarta Selatan',
                'telp_hp' => '082345678901',
                'email' => 'siti.nurhaliza@email.com',
                'created_at' => '2025-11-12 04:00:00',
                'updated_at' => '2025-11-12 04:00:00',
            ],
            [
                'id' => 3,
                'nama_pelanggan' => 'Budi Santoso',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Gatot Subroto No. 99, Jakarta Barat',
                'telp_hp' => '083456789012',
                'email' => 'budi.santoso@email.com',
                'created_at' => '2025-11-12 04:00:00',
                'updated_at' => '2025-11-12 04:00:00',
            ],
            [
                'id' => 4,
                'nama_pelanggan' => 'Dewi Lestari',
                'jenis_kelamin' => 'P',
                'alamat' => 'Jl. Rasuna Said No. 15, Jakarta Timur',
                'telp_hp' => '084567890123',
                'email' => 'dewi.lestari@email.com',
                'created_at' => '2025-11-12 04:00:00',
                'updated_at' => '2025-11-12 04:00:00',
            ],
            [
                'id' => 5,
                'nama_pelanggan' => 'Eko Prasetyo',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Ahmad Yani No. 23, Jakarta Utara',
                'telp_hp' => '085678901234',
                'email' => 'eko.prasetyo@email.com',
                'created_at' => '2025-11-12 04:00:00',
                'updated_at' => '2025-11-12 04:00:00',
            ],
        ]);

        // Seed Kota
        DB::table('kota')->insert([
            ['id' => 1, 'nama_kota' => 'Jakarta', 'propinsi_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nama_kota' => 'Bandung', 'propinsi_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'nama_kota' => 'Surabaya', 'propinsi_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'nama_kota' => 'Yogyakarta', 'propinsi_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'nama_kota' => 'Malang', 'propinsi_id' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Seed Pengarang
        DB::table('pengarang')->insert([
            ['id' => 1, 'nama_pengarang' => 'Andrea Hirata', 'negara' => 'Indonesia', 'bio' => 'Penulis Laskar Pelangi', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nama_pengarang' => 'Tere Liye', 'negara' => 'Indonesia', 'bio' => 'Penulis Novel Bumi Series', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'nama_pengarang' => 'Dee Lestari', 'negara' => 'Indonesia', 'bio' => 'Penulis Supernova & Perahu Kertas', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'nama_pengarang' => 'Raditya Dika', 'negara' => 'Indonesia', 'bio' => 'Penulis Komedi', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'nama_pengarang' => 'Pidi Baiq', 'negara' => 'Indonesia', 'bio' => 'Penulis Dilan Series', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Seed Buku
        DB::table('buku')->insert([
            [
                'judul' => 'Laskar Pelangi',
                'pengarang_id' => 1,
                'isbn' => '978-979-22-2890-5',
                'tahun_terbit' => 2005,
                'jumlah_halaman' => 529,
                'penerbit' => 'Bentang Pustaka',
                'harga' => 75000,
                'stok' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Bumi',
                'pengarang_id' => 2,
                'isbn' => '978-602-03-0213-4',
                'tahun_terbit' => 2014,
                'jumlah_halaman' => 440,
                'penerbit' => 'Gramedia Pustaka Utama',
                'harga' => 95000,
                'stok' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Bulan',
                'pengarang_id' => 2,
                'isbn' => '978-602-03-1681-0',
                'tahun_terbit' => 2015,
                'jumlah_halaman' => 400,
                'penerbit' => 'Gramedia Pustaka Utama',
                'harga' => 98000,
                'stok' => 35,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Perahu Kertas',
                'pengarang_id' => 3,
                'isbn' => '978-979-22-4721-0',
                'tahun_terbit' => 2009,
                'jumlah_halaman' => 456,
                'penerbit' => 'Bentang Pustaka',
                'harga' => 85000,
                'stok' => 45,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Kambing Jantan',
                'pengarang_id' => 4,
                'isbn' => '978-979-1227-63-2',
                'tahun_terbit' => 2005,
                'jumlah_halaman' => 176,
                'penerbit' => 'Gagas Media',
                'harga' => 55000,
                'stok' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Dilan 1990',
                'pengarang_id' => 5,
                'isbn' => '978-602-385-009-8',
                'tahun_terbit' => 2014,
                'jumlah_halaman' => 332,
                'penerbit' => 'Pastel Books',
                'harga' => 65000,
                'stok' => 70,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Dilan 1991',
                'pengarang_id' => 5,
                'isbn' => '978-602-385-033-3',
                'tahun_terbit' => 2015,
                'jumlah_halaman' => 344,
                'penerbit' => 'Pastel Books',
                'harga' => 68000,
                'stok' => 55,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        echo "\n✅ DataSeeder berhasil dijalankan!\n";
        echo "📊 Data yang di-seed:\n";
        echo "   - 8 Jenis Barang\n";
        echo "   - 20 Barang\n";
        echo "   - 5 Pelanggan\n";
        echo "   - 5 Kota\n";
        echo "   - 5 Pengarang\n";
        echo "   - 7 Buku\n";
    }
}
