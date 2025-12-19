<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JenisBarang;

class JenisBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenisBarang = [
            [
                'nama_jenis' => 'Elektronik',
                'kode_jenis' => 'ELK',
                'deskripsi' => 'Barang-barang elektronik seperti handphone, laptop, TV, dll',
                'aktif' => true
            ],
            [
                'nama_jenis' => 'Pakaian',
                'kode_jenis' => 'PKN',
                'deskripsi' => 'Pakaian pria, wanita, dan anak-anak',
                'aktif' => true
            ],
            [
                'nama_jenis' => 'Makanan & Minuman',
                'kode_jenis' => 'FNB',
                'deskripsi' => 'Produk makanan dan minuman',
                'aktif' => true
            ],
            [
                'nama_jenis' => 'Peralatan Rumah Tangga',
                'kode_jenis' => 'HME',
                'deskripsi' => 'Peralatan dan perlengkapan rumah tangga',
                'aktif' => true
            ],
            [
                'nama_jenis' => 'Buku & Alat Tulis',
                'kode_jenis' => 'BKS',
                'deskripsi' => 'Buku, majalah, alat tulis, dan perlengkapan kantor',
                'aktif' => true
            ],
            [
                'nama_jenis' => 'Olahraga & Outdoor',
                'kode_jenis' => 'SPT',
                'deskripsi' => 'Peralatan olahraga dan aktivitas outdoor',
                'aktif' => true
            ],
            [
                'nama_jenis' => 'Kecantikan & Kesehatan',
                'kode_jenis' => 'BTY',
                'deskripsi' => 'Produk kecantikan, perawatan, dan kesehatan',
                'aktif' => true
            ],
            [
                'nama_jenis' => 'Otomotif',
                'kode_jenis' => 'OTO',
                'deskripsi' => 'Spare part dan aksesoris kendaraan',
                'aktif' => true
            ]
        ];

        foreach ($jenisBarang as $jenis) {
            JenisBarang::create($jenis);
        }
    }
}
