<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DbController extends Controller
{
    // Membaca semua rekaman dari tabel kota
    public function bacaDb1()
    {
        $kota = DB::table('kota')->get();
        return view('db.bacaDb1', ['kota' => $kota]);
    }

    // Membaca satu baris rekaman dari tabel kota
    public function bacaDb2()
    {
        $kota = DB::table('kota')->where('nama_kota', 'Bantul')->first();
        return view('db.bacaDb2', ['kota' => $kota]);
    }

    // Contoh fungsi aggregate
    public function aggregate()
    {
        // Harga maksimal
        $hargaMaks = DB::table('barang')->max('harga_jual');
        
        // Harga rata-rata fungsi aggregate avg(), dengan jenis_barang=1
        $hargaRata2 = DB::table('barang')
            ->where('jenis_barang', '1')
            ->avg('harga_jual');
        
        // Harga minimal/fungsi aggregate min(), dengan jenis_barang=1
        $hargaMin = DB::table('barang')
            ->where('jenis_barang', '1')
            ->min('harga_jual');
        
        // Harga maksimal/fungsi aggregate max(), dengan jenis_barang=1
        $hargaMax = DB::table('barang')
            ->where('jenis_barang', '1')
            ->max('harga_jual');
        
        // Harga x stok
        $jumHarga = DB::table('barang')
            ->where('jenis_barang', '1')
            ->sum(DB::raw('stok*harga_jual'));
        
        return view('db.aggregate', [
            'hargaMaks' => $hargaMaks,
            'hargaRata2' => $hargaRata2,
            'hargaMin' => $hargaMin,
            'hargaMax' => $hargaMax,
            'jumHarga' => $jumHarga
        ]);
    }

    // Contoh select dengan berbagai variasi
    public function selectData()
    {
        // Membaca rekaman menggunakan DISTINCT
        $jenisBarang = DB::table('barang')
            ->select('jenis_barang')
            ->distinct()
            ->get();
        
        // Menjumlahkan per kelompok jenis barang
        $groupedBarang = DB::table('barang')
            ->select('jenis_barang', DB::raw('count(*) as jumlah'))
            ->groupBy('jenis_barang')
            ->get();
        
        // Membaca jenis_barang, dan harga * stok
        $jumHarga = DB::table('barang')
            ->where('jenis_barang', '1')
            ->sum(DB::raw('stok*harga_jual'));
        
        // Membaca rekaman memilih kolom dan harga * stok jenis barang=1
        $barang = DB::table('barang')
            ->select('id', 'nama_barang', 'stok', 'satuan', 'harga_jual')
            ->selectRaw('stok * harga_jual as total')
            ->where('jenis_barang', 1)
            ->get();
        
        return view('db.selectData', [
            'barang' => $barang,
            'jenisBarang' => $jenisBarang,
            'groupedBarang' => $groupedBarang,
            'jumHarga' => $jumHarga
        ]);
    }

    // Menambah rekaman barang
    public function insertData()
    {
        $br = DB::table('barang')->insert([
            'id' => 10021,
            'jenis_barang' => 2,
            'nama_barang' => 'Tepung Trigu',
            'satuan' => 'Kg',
            'harga_pokok' => 4000,
            'harga_jual' => 5000,
            'stok' => 10,
            'create_at' => now(),
            'update_at' => now()
        ]);
        echo "Berhasil menyimpan " . ($br ? "1" : "0") . " rekaman<br>";
        echo "<a href='/db/selectData'>Lihat Data Barang</a>";
    }

    // Mengubah rekaman barang dengan id=10021
    public function updateData()
    {
        $stok = 100;
        $br = DB::table('barang')->where('id', 10021)
            ->update([
                'stok' => $stok,
                'update_at' => now()
            ]);
        echo "Berhasil mengubah " . $br . " rekaman<br>";
        echo "Stok barang ID 10021 diubah menjadi: " . $stok . "<br>";
        echo "<a href='/db/selectData'>Lihat Data Barang</a>";
    }

    // Menghapus 1 rekaman barang
    public function deleteData()
    {
        $br = DB::table('barang')->where('id', 10021)->delete();
        echo "Berhasil menghapus " . $br . " rekaman<br>";
        echo "<a href='/db/selectData'>Lihat Data Barang</a>";
    }
}
