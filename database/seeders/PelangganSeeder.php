<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pelanggan')->insert([
            [
                'id' => 1,
                'nama_pelanggan' => 'Ahmad Rizki',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Merdeka No. 10, Yogyakarta',
                'telp_hp' => '081234567890',
                'email' => 'ahmad.rizki@email.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nama_pelanggan' => 'Siti Nurhaliza',
                'jenis_kelamin' => 'P',
                'alamat' => 'Jl. Sudirman No. 25, Bantul',
                'telp_hp' => '081298765432',
                'email' => 'siti.nur@email.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nama_pelanggan' => 'Budi Santoso',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Gajah Mada No. 5, Sleman',
                'telp_hp' => '081345678901',
                'email' => 'budi.santoso@email.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'nama_pelanggan' => 'Dewi Lestari',
                'jenis_kelamin' => 'P',
                'alamat' => 'Jl. Ahmad Yani No. 15, Yogyakarta',
                'telp_hp' => '081456789012',
                'email' => 'dewi.lestari@email.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'nama_pelanggan' => 'Eko Prasetyo',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Malioboro No. 100, Yogyakarta',
                'telp_hp' => '081567890123',
                'email' => 'eko.prasetyo@email.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
