<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jual;
use App\Models\DetailJual;
use App\Models\Barang;
use Carbon\Carbon;

class JualSeeder extends Seeder
{
    public function run(): void
    {
        // Get existing data
        $pelangganIds = \App\Models\Pelanggan::pluck('id')->toArray();
        $userIds = \App\Models\User::pluck('id')->toArray();
        $barangList = Barang::all();
        
        if (empty($pelangganIds) || empty($userIds) || $barangList->isEmpty()) {
            $this->command->error('Pastikan data Pelanggan, User, dan Barang sudah ada!');
            return;
        }

        // Create 20 transactions with various dates
        $transactions = [];
        $startDate = Carbon::now()->subDays(30);
        
        for ($i = 1; $i <= 20; $i++) {
            $transactions[] = [
                'pelanggan_id' => $pelangganIds[array_rand($pelangganIds)],
                'user_id' => $userIds[array_rand($userIds)],
                'tanggal' => $startDate->copy()->addDays(rand(0, 30))->format('Y-m-d'),
                'items' => rand(1, 4), // Number of items in this transaction
            ];
        }

        foreach ($transactions as $trans) {
            $totalPembelian = 0;
            $details = [];
            
            // Generate random items for this transaction
            $selectedBarang = $barangList->random($trans['items']);
            
            foreach ($selectedBarang as $barang) {
                $qty = rand(1, 5);
                $harga = $barang->harga_jual;
                $subtotal = $qty * $harga;
                $totalPembelian += $subtotal;
                
                $details[] = [
                    'barang_id' => $barang->id,
                    'qty' => $qty,
                    'harga_sekarang' => $harga,
                    'user_id' => $trans['user_id'],
                ];
            }
            
            // Create Jual record
            $noTransaksi = 'TRX-' . date('Ymd', strtotime($trans['tanggal'])) . '-' . str_pad(Jual::count() + 1, 4, '0', STR_PAD_LEFT);
            
            // Get pelanggan name
            $pelanggan = \App\Models\Pelanggan::find($trans['pelanggan_id']);
            
            $jual = Jual::create([
                'no_transaksi' => $noTransaksi,
                'pelanggan_id' => $trans['pelanggan_id'],
                'nama_pembeli' => $pelanggan ? $pelanggan->nama_pelanggan : 'Pelanggan ' . $trans['pelanggan_id'],
                'alamat' => $pelanggan ? $pelanggan->alamat : 'Alamat Pelanggan',
                'telepon' => $pelanggan ? $pelanggan->telepon : '081234567890',
                'tanggal' => $trans['tanggal'],
                'jumlah_pembelian' => $totalPembelian,
                'total' => $totalPembelian,
                'status' => 'selesai',
                'user_id' => $trans['user_id'],
            ]);
            
            // Create DetailJual records
            foreach ($details as $detail) {
                DetailJual::create([
                    'jual_id' => $jual->id,
                    'barang_id' => $detail['barang_id'],
                    'harga' => $detail['harga_sekarang'],
                    'qty' => $detail['qty'],
                    'jumlah' => $detail['qty'] * $detail['harga_sekarang'],
                    'subtotal' => $detail['qty'] * $detail['harga_sekarang'],
                    'harga_sekarang' => $detail['harga_sekarang'],
                    'user_id' => $detail['user_id'],
                ]);
                
                // Update stock
                Barang::where('id', $detail['barang_id'])->decrement('stok', $detail['qty']);
            }
        }
        
        $this->command->info('20 transaksi penjualan berhasil dibuat!');
    }
}
