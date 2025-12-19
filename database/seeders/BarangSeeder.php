<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barang = [
            // Elektronik (jenis_barang: 1)
            [
                'id' => 1001,
                'jenis_barang' => 1,
                'nama_barang' => 'Laptop ASUS ROG',
                'satuan' => 'Unit',
                'harga_pokok' => 12000000,
                'harga_jual' => 15000000,
                'stok' => 10
            ],
            [
                'id' => 1002,
                'jenis_barang' => 1,
                'nama_barang' => 'Samsung Galaxy S23',
                'satuan' => 'Unit',
                'harga_pokok' => 8000000,
                'harga_jual' => 10000000,
                'stok' => 25
            ],
            [
                'id' => 1003,
                'jenis_barang' => 1,
                'nama_barang' => 'Smart TV LG 43 Inch',
                'satuan' => 'Unit',
                'harga_pokok' => 4500000,
                'harga_jual' => 5500000,
                'stok' => 15
            ],
            
            // Pakaian (jenis_barang: 2)
            [
                'id' => 2001,
                'jenis_barang' => 2,
                'nama_barang' => 'Kemeja Batik Pria',
                'satuan' => 'Pcs',
                'harga_pokok' => 150000,
                'harga_jual' => 250000,
                'stok' => 50
            ],
            [
                'id' => 2002,
                'jenis_barang' => 2,
                'nama_barang' => 'Dress Wanita',
                'satuan' => 'Pcs',
                'harga_pokok' => 200000,
                'harga_jual' => 350000,
                'stok' => 40
            ],
            [
                'id' => 2003,
                'jenis_barang' => 2,
                'nama_barang' => 'Kaos Anak',
                'satuan' => 'Pcs',
                'harga_pokok' => 50000,
                'harga_jual' => 100000,
                'stok' => 100
            ],
            
            // Makanan & Minuman (jenis_barang: 3)
            [
                'id' => 3001,
                'jenis_barang' => 3,
                'nama_barang' => 'Kopi Arabica 250gr',
                'satuan' => 'Pack',
                'harga_pokok' => 50000,
                'harga_jual' => 75000,
                'stok' => 80
            ],
            [
                'id' => 3002,
                'jenis_barang' => 3,
                'nama_barang' => 'Keripik Singkong',
                'satuan' => 'Pack',
                'harga_pokok' => 15000,
                'harga_jual' => 25000,
                'stok' => 120
            ],
            [
                'id' => 3003,
                'jenis_barang' => 3,
                'nama_barang' => 'Susu UHT 1 Liter',
                'satuan' => 'Botol',
                'harga_pokok' => 12000,
                'harga_jual' => 18000,
                'stok' => 150
            ],
            
            // Peralatan Rumah Tangga (jenis_barang: 4)
            [
                'id' => 4001,
                'jenis_barang' => 4,
                'nama_barang' => 'Blender Philips',
                'satuan' => 'Unit',
                'harga_pokok' => 350000,
                'harga_jual' => 500000,
                'stok' => 20
            ],
            [
                'id' => 4002,
                'jenis_barang' => 4,
                'nama_barang' => 'Panci Set Stainless',
                'satuan' => 'Set',
                'harga_pokok' => 200000,
                'harga_jual' => 300000,
                'stok' => 30
            ],
            
            // Buku & Alat Tulis (jenis_barang: 5)
            [
                'id' => 5001,
                'jenis_barang' => 5,
                'nama_barang' => 'Buku Tulis 100 Lembar',
                'satuan' => 'Pcs',
                'harga_pokok' => 8000,
                'harga_jual' => 12000,
                'stok' => 200
            ],
            [
                'id' => 5002,
                'jenis_barang' => 5,
                'nama_barang' => 'Pulpen Joyko 0.5mm',
                'satuan' => 'Pcs',
                'harga_pokok' => 2000,
                'harga_jual' => 4000,
                'stok' => 300
            ],
            [
                'id' => 5003,
                'jenis_barang' => 5,
                'nama_barang' => 'Novel Best Seller',
                'satuan' => 'Pcs',
                'harga_pokok' => 60000,
                'harga_jual' => 90000,
                'stok' => 45
            ],
            
            // Olahraga & Outdoor (jenis_barang: 6)
            [
                'id' => 6001,
                'jenis_barang' => 6,
                'nama_barang' => 'Sepatu Lari Nike',
                'satuan' => 'Pasang',
                'harga_pokok' => 800000,
                'harga_jual' => 1200000,
                'stok' => 35
            ],
            [
                'id' => 6002,
                'jenis_barang' => 6,
                'nama_barang' => 'Raket Badminton Yonex',
                'satuan' => 'Unit',
                'harga_pokok' => 400000,
                'harga_jual' => 600000,
                'stok' => 25
            ],
            
            // Kecantikan & Kesehatan (jenis_barang: 7)
            [
                'id' => 7001,
                'jenis_barang' => 7,
                'nama_barang' => 'Wardah Lightening Serum',
                'satuan' => 'Botol',
                'harga_pokok' => 50000,
                'harga_jual' => 75000,
                'stok' => 60
            ],
            [
                'id' => 7002,
                'jenis_barang' => 7,
                'nama_barang' => 'Masker Wajah Korea',
                'satuan' => 'Pack',
                'harga_pokok' => 15000,
                'harga_jual' => 25000,
                'stok' => 150
            ],
            
            // Otomotif (jenis_barang: 8)
            [
                'id' => 8001,
                'jenis_barang' => 8,
                'nama_barang' => 'Oli Mobil Shell 4L',
                'satuan' => 'Gallon',
                'harga_pokok' => 200000,
                'harga_jual' => 280000,
                'stok' => 50
            ],
            [
                'id' => 8002,
                'jenis_barang' => 8,
                'nama_barang' => 'Ban Motor FDR',
                'satuan' => 'Unit',
                'harga_pokok' => 250000,
                'harga_jual' => 350000,
                'stok' => 40
            ]
        ];

        foreach ($barang as $item) {
            Barang::create($item);
        }
    }
}
