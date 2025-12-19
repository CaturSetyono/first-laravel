<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailJual;
use App\Models\Pelanggan;
use App\Models\Jual;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class JualController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Menampilkan daftar transaksi penjualan
     */
    public function index()
    {
        $jual = DB::table('jual')
            ->leftJoin('pelanggan', 'jual.pelanggan_id', '=', 'pelanggan.id')
            ->leftJoin('users', 'jual.user_id', '=', 'users.id')
            ->select(
                'jual.*',
                'pelanggan.nama_pelanggan',
                'users.name as kasir'
            )
            ->orderBy('jual.tanggal', 'desc')
            ->orderBy('jual.created_at', 'desc')
            ->get();
        
        return view('jual.index', compact('jual'));
    }
    
    /**
     * Menampilkan form transaksi baru (tidak insert ke database)
     */
    public function create()
    {
        // Hanya menampilkan form, tidak insert ke database
        // Generate nomor transaksi preview
        $lastJual = DB::table('jual')
            ->whereDate('tanggal', date('Y-m-d'))
            ->orderBy('id', 'desc')
            ->first();
        
        $counter = $lastJual ? (intval(substr($lastJual->no_transaksi ?? $lastJual->id, -4)) + 1) : 1;
        $noTransaksi = 'TRX-' . date('Ymd') . '-' . str_pad($counter, 4, '0', STR_PAD_LEFT);
        
        // Buat object dummy untuk preview (tidak disimpan ke database)
        $jual = (object)[
            'id' => 'PREVIEW',
            'no_transaksi' => $noTransaksi,
            'tanggal' => date('Y-m-d')
        ];
        
        return view('jual.create', compact('jual'));
    }
    
    /**
     * Pembacaan data pelanggan menggunakan ajax
     * Mengembalikan data format json
     */
    public function getPelanggan(Request $request)
    {
        $pelanggan = DB::table("pelanggan")
            ->select("nama_pelanggan", "alamat", "telp_hp")
            ->where("id", $request->pelanggan_id)
            ->first();
            
        return response()->json($pelanggan);
    }
    
    /**
     * Menyimpan data pelanggan dan membuat transaksi baru
     * Dilanjutkan ke detail_jual
     */
    public function store(Request $request)
    {
        $tgJam = date('Y-m-d H:i:s');
        
        // Generate nomor transaksi
        $lastJual = DB::table('jual')
            ->whereDate('tanggal', date('Y-m-d'))
            ->orderBy('id', 'desc')
            ->first();
        
        $counter = $lastJual ? (intval(substr($lastJual->no_transaksi ?? $lastJual->id, -4)) + 1) : 1;
        $noTransaksi = 'TRX-' . date('Ymd') . '-' . str_pad($counter, 4, '0', STR_PAD_LEFT);
        
        // Ambil data pelanggan
        $pelanggan = DB::table('pelanggan')->where('id', $request->pelanggan_id)->first();
        
        // Buat transaksi baru
        $id = DB::table('jual')->insertGetId([
            'no_transaksi' => $noTransaksi,
            'pelanggan_id' => $request->pelanggan_id,
            'tanggal' => date('Y-m-d'),
            'nama_pembeli' => $pelanggan->nama_pelanggan ?? '-',
            'alamat' => $pelanggan->alamat ?? null,
            'telepon' => $pelanggan->telp_hp ?? null,
            'created_at' => $tgJam,
            'updated_at' => $tgJam,
            'user_id' => Auth::id()
        ]);
        
        return response()->json(['success' => true, 'id' => $id]);
    }
    
    /**
     * Dilanjutkan ke detail jual
     */
    public function detailJual($id)
    {
        return view('jual.detail_jual', compact('id'));
    }
    
    /**
     * Pembacaan data barang menggunakan ajax
     * Mengembalikan data format json
     */
    public function getBarang(Request $request)
    {
        $barang = DB::table("barang")
            ->select("nama_barang", "harga_jual as harga", "satuan")
            ->where("id", $request->id)
            ->first();
            
        return response()->json($barang);
    }
    
    /**
     * Menyimpan rekaman
     * - Ubah jumlah_pembelian di tabel jual
     * - Menambah master detil tabel detail_jual
     * - Ubah tabel barang (mengurangi stok setiap barang yang dijual)
     */
    public function simpan(Request $request)
    {
        // Menggunakan mode transaksi, ketika terjadi
        // salah satu kesalahan akan dibatalkan semua
        DB::beginTransaction();
        try {
            $total = 0;
            
            // Looping $request->dataBarang
            foreach ($request->dataBarang as $key => $barang) {
                // Konversi ke tipe data yang benar
                $barangId = intval($barang['barang_id']);
                $qty = intval($barang['qty']);
                $hargaSekarang = intval($barang['harga_sekarang']);
                
                // Simpan ke transaksi jual
                $tgJam = date('Y-m-d H:i:s');
                DB::table('detail_jual')->insert([
                    'jual_id' => $request->idJual,
                    'barang_id' => $barangId,
                    'qty' => $qty,
                    'harga_sekarang' => $hargaSekarang,
                    'jumlah' => $qty, // Untuk kompatibilitas dengan kolom lama
                    'harga' => $hargaSekarang, // Untuk kompatibilitas dengan kolom lama
                    'subtotal' => $qty * $hargaSekarang,
                    'created_at' => $tgJam,
                    'updated_at' => $tgJam,
                    'user_id' => Auth::id()
                ]);
                
                // Kurangi stok di tabel barang
                DB::table('barang')
                    ->where('id', $barangId)
                    ->update([
                        'stok' => DB::raw('stok - ' . $qty)
                    ]);
                
                // Menjumlah pertransaksi
                $total += $qty * $hargaSekarang;
            }
            
            // Merekam jumlah pembelian pertransaksi
            Jual::whereId($request->idJual)->update([
                'jumlah_pembelian' => $total
            ]);
            
            DB::commit();
            
            // Kembalikan response berupa json ke client
            // untuk mencetak struk pembayaran
            return response()->json([
                'berhasil' => true,
                'urlCetak' => url('/jual/cetak/' . $request->idJual)
            ]);
            
        } catch (\Throwable $e) {
            // Jika terjadi kesalahan batalkan semua
            DB::rollback();
            return response()->json([
                'berhasil' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Cetak struk penjualan
     */
    public function cetak($id)
    {
        $djual = DetailJual::where('jual_id', $id)->get();
        $jual = Jual::find($id);
        $tgl = $jual->tanggal;
        
        // Handle null pelanggan_id
        $pelanggan = null;
        if ($jual->pelanggan_id) {
            $pelanggan = Pelanggan::find($jual->pelanggan_id);
        }
        
        return view('jual.cetak', compact('djual', 'pelanggan', 'id', 'tgl'));
    }
    
    /**
     * Hapus transaksi penjualan
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            // Ambil detail jual untuk restore stok
            $detailJual = DetailJual::where('jual_id', $id)->get();
            
            // Restore stok barang
            foreach ($detailJual as $detail) {
                DB::table('barang')
                    ->where('id', $detail->barang_id)
                    ->update([
                        'stok' => DB::raw('stok + ' . $detail->qty)
                    ]);
            }
            
            // Hapus detail jual (cascade akan handle ini jika ada foreign key)
            DetailJual::where('jual_id', $id)->delete();
            
            // Hapus transaksi jual
            Jual::destroy($id);
            
            DB::commit();
            
            return redirect()->route('jual.index')->with('success', 'Transaksi berhasil dihapus');
            
        } catch (\Throwable $e) {
            DB::rollback();
            return redirect()->route('jual.index')->with('error', 'Gagal menghapus transaksi: ' . $e->getMessage());
        }
    }
}
