<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Jual;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    public function index()
    {
        // Total Stats
        $totalBarang = Barang::count();
        $totalTransaksi = Jual::count();
        $totalPenjualan = Jual::sum('jumlah_pembelian') ?? 0;
        
        // Barang Terlaris (top 5)
        $barangTerlaris = DB::table('barang')
            ->leftJoin('detail_jual', 'barang.id', '=', 'detail_jual.barang_id')
            ->select(
                'barang.nama_barang',
                DB::raw('COALESCE(SUM(detail_jual.qty), 0) as total_terjual')
            )
            ->groupBy('barang.id', 'barang.nama_barang')
            ->orderByDesc('total_terjual')
            ->limit(5)
            ->get();

        // Transaksi per hari (7 hari terakhir)
        $transaksiPerHari = Jual::select(
                DB::raw('DATE(tanggal) as tanggal'),
                DB::raw('COUNT(*) as jumlah'),
                DB::raw('SUM(jumlah_pembelian) as total')
            )
            ->where('tanggal', '>=', now()->subDays(7))
            ->groupBy(DB::raw('DATE(tanggal)'))
            ->orderBy('tanggal')
            ->get();

        // Kategori barang
        $kategoriData = DB::table('barang')
            ->join('jenis_barang', 'barang.jenis_barang', '=', 'jenis_barang.id')
            ->select('jenis_barang.nama_jenis', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('jenis_barang.id', 'jenis_barang.nama_jenis')
            ->get();

        return view('landing', compact(
            'totalBarang',
            'totalTransaksi',
            'totalPenjualan',
            'barangTerlaris',
            'transaksiPerHari',
            'kategoriData'
        ));
    }
}
