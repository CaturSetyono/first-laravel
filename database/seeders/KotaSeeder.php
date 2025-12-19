<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kota')->insert([
            [
                'id' => 1,
                'nama_kota' => 'Yogyakarta',
                'propinsi_id' => 34,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nama_kota' => 'Bantul',
                'propinsi_id' => 34,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nama_kota' => 'Sleman',
                'propinsi_id' => 34,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'nama_kota' => 'Gunungkidul',
                'propinsi_id' => 34,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'nama_kota' => 'Kulon Progo',
                'propinsi_id' => 34,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
