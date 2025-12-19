<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    // Menampilkan daftar transaksi penjualan
    public function index()
    {
        $penjualan = DB::table('jual')
            ->orderBy('tanggal', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('penjualan.index', compact('penjualan'));
    }

    // Form untuk transaksi penjualan baru
    public function create()
    {
        // Ambil barang yang masih ada stoknya
        $barang = DB::table('barang')
            ->where('stok', '>', 0)
            ->get();
        
        return view('penjualan.create', compact('barang'));
    }

    // Proses transaksi penjualan (insert data dan kurangi stok)
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'nama_pembeli' => 'required|max:100',
            'alamat' => 'nullable',
            'telepon' => 'nullable|max:15',
            'barang_id' => 'required|array|min:1',
            'barang_id.*' => 'required|exists:barang,id',
            'jumlah' => 'required|array|min:1',
            'jumlah.*' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        
        try {
            // Generate nomor transaksi
            $noTransaksi = 'TRX-' . date('Ymd') . '-' . str_pad(DB::table('jual')->whereDate('tanggal', $request->tanggal)->count() + 1, 4, '0', STR_PAD_LEFT);
            
            // Insert ke tabel jual
            $jualId = DB::table('jual')->insertGetId([
                'no_transaksi' => $noTransaksi,
                'tanggal' => $request->tanggal,
                'nama_pembeli' => $request->nama_pembeli,
                'alamat' => $request->alamat,
                'telepon' => $request->telepon,
                'total' => 0, // akan diupdate setelah insert detail
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            $total = 0;
            
            // Insert detail dan kurangi stok
            foreach ($request->barang_id as $index => $barangId) {
                $jumlah = $request->jumlah[$index];
                
                // Ambil data barang
                $barang = DB::table('barang')->where('id', $barangId)->first();
                
                if (!$barang) {
                    throw new \Exception("Barang dengan ID {$barangId} tidak ditemukan!");
                }
                
                // Cek stok
                if ($barang->stok < $jumlah) {
                    throw new \Exception("Stok barang {$barang->nama_barang} tidak mencukupi! Stok tersedia: {$barang->stok}");
                }
                
                $harga = $barang->harga_jual;
                $subtotal = $jumlah * $harga;
                $total += $subtotal;
                
                // Insert detail jual
                DB::table('detail_jual')->insert([
                    'jual_id' => $jualId,
                    'barang_id' => $barangId,
                    'jumlah' => $jumlah,
                    'harga' => $harga,
                    'subtotal' => $subtotal,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                
                // Kurangi stok barang
                DB::table('barang')
                    ->where('id', $barangId)
                    ->decrement('stok', $jumlah);
            }
            
            // Update total di tabel jual
            DB::table('jual')
                ->where('id', $jualId)
                ->update([
                    'total' => $total,
                    'status' => 'selesai',
                    'updated_at' => now(),
                ]);
            
            DB::commit();
            
            return redirect()->route('penjualan.show', $jualId)
                ->with('success', 'Transaksi penjualan berhasil! Nomor Transaksi: ' . $noTransaksi);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan transaksi: ' . $e->getMessage());
        }
    }

    // Detail transaksi penjualan
    public function show($id)
    {
        $jual = DB::table('jual')->where('id', $id)->first();
        
        if (!$jual) {
            return redirect()->route('penjualan.index')
                ->with('error', 'Transaksi tidak ditemukan!');
        }
        
        // Ambil detail dengan join ke barang
        $details = DB::table('detail_jual')
            ->join('barang', 'detail_jual.barang_id', '=', 'barang.id')
            ->select('detail_jual.*', 'barang.nama_barang', 'barang.satuan')
            ->where('detail_jual.jual_id', $id)
            ->get();
        
        return view('penjualan.show', compact('jual', 'details'));
    }
}
