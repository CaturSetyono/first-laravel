<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Jual;
use App\Models\DetailJual;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Barang
        $totalBarang = Barang::count();
        
        // Total Transaksi
        $totalTransaksi = Jual::count();
        
        // Total Penjualan (sum jumlah_pembelian)
        $totalPenjualan = Jual::sum('jumlah_pembelian') ?? 0;
        
        // Barang Terlaris (top 5) - compatible with MySQL strict mode
        $barangTerlaris = DB::table('barang')
            ->leftJoin('detail_jual', 'barang.id', '=', 'detail_jual.barang_id')
            ->select(
                'barang.id',
                'barang.nama_barang',
                'barang.stok',
                DB::raw('COALESCE(SUM(detail_jual.qty), 0) as total_terjual')
            )
            ->groupBy('barang.id', 'barang.nama_barang', 'barang.stok')
            ->orderByDesc('total_terjual')
            ->limit(5)
            ->get();
        
        // Stok Menipis (stok <= 10)
        $stokMenipis = Barang::where('stok', '<=', 10)->count();
        
        // Transaksi Terbaru (5 transaksi terakhir)
        $transaksiTerbaru = Jual::orderByDesc('tanggal')
            ->orderByDesc('id')
            ->limit(5)
            ->get();
        
        return view('admin.dashboard', compact(
            'totalBarang',
            'totalTransaksi',
            'totalPenjualan',
            'barangTerlaris',
            'stokMenipis',
            'transaksiTerbaru'
        ));
    }
}
