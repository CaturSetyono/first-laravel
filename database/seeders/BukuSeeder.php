<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('buku')->insert([
            [
                'judul' => 'Laskar Pelangi',
                'pengarang_id' => 1,
                'isbn' => '978-979-22-2592-1',
                'tahun_terbit' => 2005,
                'jumlah_halaman' => 529,
                'penerbit' => 'Bentang Pustaka',
                'harga' => 85000,
                'stok' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Sang Pemimpi',
                'pengarang_id' => 1,
                'isbn' => '978-979-22-3080-2',
                'tahun_terbit' => 2006,
                'jumlah_halaman' => 292,
                'penerbit' => 'Bentang Pustaka',
                'harga' => 78000,
                'stok' => 45,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Bumi',
                'pengarang_id' => 2,
                'isbn' => '978-602-03-0213-2',
                'tahun_terbit' => 2014,
                'jumlah_halaman' => 440,
                'penerbit' => 'Gramedia Pustaka Utama',
                'harga' => 95000,
                'stok' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Bulan',
                'pengarang_id' => 2,
                'isbn' => '978-602-03-0551-5',
                'tahun_terbit' => 2015,
                'jumlah_halaman' => 440,
                'penerbit' => 'Gramedia Pustaka Utama',
                'harga' => 95000,
                'stok' => 55,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Perahu Kertas',
                'pengarang_id' => 3,
                'isbn' => '978-979-22-5980-4',
                'tahun_terbit' => 2009,
                'jumlah_halaman' => 456,
                'penerbit' => 'Bentang Pustaka',
                'harga' => 89000,
                'stok' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Supernova: Ksatria, Putri, dan Bintang Jatuh',
                'pengarang_id' => 3,
                'isbn' => '978-979-22-1380-5',
                'tahun_terbit' => 2001,
                'jumlah_halaman' => 326,
                'penerbit' => 'Bentang Pustaka',
                'harga' => 82000,
                'stok' => 35,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Bumi Manusia',
                'pengarang_id' => 4,
                'isbn' => '978-979-22-1880-0',
                'tahun_terbit' => 1980,
                'jumlah_halaman' => 535,
                'penerbit' => 'Hasta Mitra',
                'harga' => 120000,
                'stok' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Cantik Itu Luka',
                'pengarang_id' => 5,
                'isbn' => '978-602-03-1394-7',
                'tahun_terbit' => 2002,
                'jumlah_halaman' => 528,
                'penerbit' => 'Gramedia Pustaka Utama',
                'harga' => 110000,
                'stok' => 38,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
