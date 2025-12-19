<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Membuat data transaksi penjualan untuk berbagai periode
     */
    public function run(): void
    {
        // Hapus data transaksi lama
        DB::table('detail_jual')->delete();
        DB::table('jual')->delete();
        
        // Ambil data yang dibutuhkan
        $pelanggan = DB::table('pelanggan')->pluck('id')->toArray();
        $barang = DB::table('barang')->get();
        $users = DB::table('users')->pluck('id')->toArray();
        
        if (empty($pelanggan) || $barang->isEmpty() || empty($users)) {
            $this->command->warn('Data pelanggan, barang, atau user tidak ditemukan. Jalankan seeder lain terlebih dahulu.');
            return;
        }
        
        $statusList = ['pending', 'proses', 'selesai', 'selesai', 'selesai']; // Lebih banyak selesai
        
        // Generate transaksi untuk 6 bulan terakhir
        $startDate = Carbon::now()->subMonths(6)->startOfMonth();
        $endDate = Carbon::now();
        
        $transactionCount = 0;
        $currentDate = $startDate->copy();
        
        while ($currentDate <= $endDate) {
            // Random jumlah transaksi per hari (0-5)
            $dailyTransactions = rand(0, 5);
            
            for ($i = 0; $i < $dailyTransactions; $i++) {
                $transactionCount++;
                
                // Generate nomor transaksi
                $noTransaksi = 'TRX-' . $currentDate->format('Ymd') . '-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT);
                
                // Random data
                $pelangganId = $pelanggan[array_rand($pelanggan)];
                $userId = $users[array_rand($users)];
                $status = $statusList[array_rand($statusList)];
                
                // Ambil data pelanggan
                $dataPelanggan = DB::table('pelanggan')->where('id', $pelangganId)->first();
                
                // Insert ke tabel jual
                $jualId = DB::table('jual')->insertGetId([
                    'pelanggan_id' => $pelangganId,
                    'no_transaksi' => $noTransaksi,
                    'tanggal' => $currentDate->format('Y-m-d'),
                    'user_id' => $userId,
                    'jumlah_pembelian' => 0, // akan diupdate
                    'nama_pembeli' => $dataPelanggan->nama_pelanggan ?? 'Pelanggan',
                    'alamat' => $dataPelanggan->alamat ?? null,
                    'telepon' => $dataPelanggan->telp_hp ?? null,
                    'total' => 0,
                    'status' => $status,
                    'created_at' => $currentDate->format('Y-m-d H:i:s'),
                    'updated_at' => $currentDate->format('Y-m-d H:i:s'),
                ]);
                
                // Random jumlah item dalam transaksi (1-4)
                $itemCount = rand(1, 4);
                $usedBarang = [];
                $totalTransaksi = 0;
                
                for ($j = 0; $j < $itemCount; $j++) {
                    // Pilih barang random yang belum dipilih
                    $randomBarang = $barang->whereNotIn('id', $usedBarang)->random();
                    $usedBarang[] = $randomBarang->id;
                    
                    $qty = rand(1, 5);
                    $harga = $randomBarang->harga_jual;
                    $subtotal = $qty * $harga;
                    $totalTransaksi += $subtotal;
                    
                    // Insert detail jual
                    DB::table('detail_jual')->insert([
                        'jual_id' => $jualId,
                        'barang_id' => $randomBarang->id,
                        'jumlah' => $qty,
                        'qty' => $qty,
                        'harga' => $harga,
                        'harga_sekarang' => $harga,
                        'subtotal' => $subtotal,
                        'user_id' => $userId,
                        'created_at' => $currentDate->format('Y-m-d H:i:s'),
                        'updated_at' => $currentDate->format('Y-m-d H:i:s'),
                    ]);
                    
                    // Jika barang sudah habis, keluar dari loop
                    if (count($usedBarang) >= $barang->count()) {
                        break;
                    }
                }
                
                // Update total transaksi
                DB::table('jual')->where('id', $jualId)->update([
                    'jumlah_pembelian' => $totalTransaksi,
                    'total' => $totalTransaksi,
                ]);
            }
            
            // Pindah ke hari berikutnya
            $currentDate->addDay();
        }
        
        $this->command->info("✅ Berhasil membuat {$transactionCount} transaksi penjualan!");
        
        // Tampilkan ringkasan per bulan
        $this->command->info("\n📊 Ringkasan Transaksi Per Bulan:");
        $rekapBulanan = DB::table('jual')
            ->selectRaw('YEAR(tanggal) as tahun, MONTH(tanggal) as bulan, COUNT(*) as jumlah, SUM(jumlah_pembelian) as total')
            ->groupByRaw('YEAR(tanggal), MONTH(tanggal)')
            ->orderByRaw('YEAR(tanggal), MONTH(tanggal)')
            ->get();
        
        $namaBulan = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        
        foreach ($rekapBulanan as $rekap) {
            $bulanNama = $namaBulan[$rekap->bulan] ?? $rekap->bulan;
            $this->command->line("   {$bulanNama} {$rekap->tahun}: {$rekap->jumlah} transaksi - Rp " . number_format($rekap->total, 0, ',', '.'));
        }
    }
}
