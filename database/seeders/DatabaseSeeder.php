<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Seed Users
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::factory()->create([
            'name' => 'Admin Panuntun',
            'email' => 'admin@panuntun.com',
        ]);

        // Seed Jenis Barang dan Barang
        $this->call([
            DataSeeder::class,
        ]);

        // All data seeding handled by DataSeeder
    }
}
