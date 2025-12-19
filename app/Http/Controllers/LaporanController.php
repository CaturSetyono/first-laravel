<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Laporan Penjualan dengan filter tanggal, periode, dan barang
     */
    public function penjualan(Request $request)
    {
        $query = DB::table('jual')
            ->leftJoin('pelanggan', 'jual.pelanggan_id', '=', 'pelanggan.id')
            ->leftJoin('users', 'jual.user_id', '=', 'users.id')
            ->select(
                'jual.*',
                'pelanggan.nama_pelanggan',
                'users.name as kasir'
            );
        
        // Filter berdasarkan tanggal
        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('jual.tanggal', '>=', $request->tanggal_mulai);
        }
        
        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('jual.tanggal', '<=', $request->tanggal_akhir);
        }
        
        // Filter berdasarkan barang (jika dipilih)
        if ($request->filled('barang_id')) {
            $query->whereExists(function($q) use ($request) {
                $q->select(DB::raw(1))
                    ->from('detail_jual')
                    ->whereColumn('detail_jual.jual_id', 'jual.id')
                    ->where('detail_jual.barang_id', $request->barang_id);
            });
        }
        
        // Clone query untuk menghitung total sebelum pagination
        $totalQuery = clone $query;
        $totalPenjualan = $totalQuery->sum(DB::raw('COALESCE(jumlah_pembelian, 0)'));
        $totalTransaksi = $totalQuery->count();
        
        // Pagination - 15 item per halaman
        $penjualan = $query->orderBy('jual.tanggal', 'desc')
            ->orderBy('jual.created_at', 'desc')
            ->paginate(15)
            ->withQueryString();
        
        // Ambil detail untuk setiap transaksi
        foreach ($penjualan as $item) {
            $item->detail = DB::table('detail_jual')
                ->join('barang', 'detail_jual.barang_id', '=', 'barang.id')
                ->where('detail_jual.jual_id', $item->id)
                ->select('detail_jual.*', 'barang.nama_barang')
                ->get();
        }
        
        // Ambil daftar barang untuk filter
        $barang = DB::table('barang')->orderBy('nama_barang')->get();
        
        return view('laporan.penjualan', compact('penjualan', 'barang', 'totalPenjualan', 'totalTransaksi'));
    }
    
    /**
     * Rekap Penjualan Per Bulan
     */
    public function rekapBulanan(Request $request)
    {
        $tahun = $request->tahun ?? date('Y');
        $barangId = $request->barang_id;
        
        // Query rekap per bulan
        $query = DB::table('jual')
            ->selectRaw('
                MONTH(tanggal) as bulan,
                YEAR(tanggal) as tahun,
                COUNT(*) as jumlah_transaksi,
                SUM(COALESCE(jumlah_pembelian, 0)) as total_penjualan
            ')
            ->whereYear('tanggal', $tahun);
        
        // Filter barang jika dipilih
        if ($barangId) {
            $query->whereExists(function($q) use ($barangId) {
                $q->select(DB::raw(1))
                    ->from('detail_jual')
                    ->whereColumn('detail_jual.jual_id', 'jual.id')
                    ->where('detail_jual.barang_id', $barangId);
            });
        }
        
        $rekapBulanan = $query->groupByRaw('YEAR(tanggal), MONTH(tanggal)')
            ->orderByRaw('YEAR(tanggal), MONTH(tanggal)')
            ->get();
        
        // Nama bulan Indonesia
        $namaBulan = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        
        foreach ($rekapBulanan as $item) {
            $item->nama_bulan = $namaBulan[$item->bulan] ?? '-';
        }
        
        // Hitung total tahunan
        $totalTahunan = $rekapBulanan->sum('total_penjualan');
        $totalTransaksi = $rekapBulanan->sum('jumlah_transaksi');
        
        // Ambil daftar tahun yang ada transaksinya
        $tahunList = DB::table('jual')
            ->selectRaw('DISTINCT YEAR(tanggal) as tahun')
            ->whereNotNull('tanggal')
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');
        
        // Jika tidak ada data, tambahkan tahun sekarang
        if ($tahunList->isEmpty()) {
            $tahunList = collect([date('Y')]);
        }
        
        // Ambil daftar barang untuk filter
        $barang = DB::table('barang')->orderBy('nama_barang')->get();
        
        // Detail per barang per bulan (jika ada filter barang)
        $detailBarang = collect([]);
        if ($barangId) {
            $detailBarang = DB::table('detail_jual')
                ->join('jual', 'detail_jual.jual_id', '=', 'jual.id')
                ->join('barang', 'detail_jual.barang_id', '=', 'barang.id')
                ->selectRaw('
                    MONTH(jual.tanggal) as bulan,
                    barang.nama_barang,
                    SUM(detail_jual.qty) as total_qty,
                    SUM(detail_jual.qty * detail_jual.harga_sekarang) as total_nilai
                ')
                ->where('detail_jual.barang_id', $barangId)
                ->whereYear('jual.tanggal', $tahun)
                ->groupByRaw('MONTH(jual.tanggal), barang.nama_barang')
                ->orderByRaw('MONTH(jual.tanggal)')
                ->get();
            
            foreach ($detailBarang as $item) {
                $item->nama_bulan = $namaBulan[$item->bulan] ?? '-';
            }
        }
        
        return view('laporan.rekap-bulanan', compact(
            'rekapBulanan', 
            'tahun', 
            'tahunList', 
            'barang', 
            'totalTahunan', 
            'totalTransaksi',
            'detailBarang',
            'barangId'
        ));
    }
}
