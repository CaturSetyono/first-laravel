<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pengarang')->insert([
            [
                'id' => 1,
                'nama_pengarang' => 'Andrea Hirata',
                'bio' => 'Penulis novel Indonesia terkenal dengan karyanya Laskar Pelangi',
                'negara' => 'Indonesia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nama_pengarang' => 'Tere Liye',
                'bio' => 'Penulis produktif Indonesia dengan berbagai genre',
                'negara' => 'Indonesia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nama_pengarang' => 'Dee Lestari',
                'bio' => 'Penyanyi dan penulis novel Indonesia',
                'negara' => 'Indonesia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'nama_pengarang' => 'Pramoedya Ananta Toer',
                'bio' => 'Sastrawan Indonesia paling terkenal',
                'negara' => 'Indonesia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'nama_pengarang' => 'Eka Kurniawan',
                'bio' => 'Penulis Indonesia yang karyanya diterjemahkan ke berbagai bahasa',
                'negara' => 'Indonesia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
