<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Models\JenisBarang;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::paginate(10);
        
        // Barang Terlaris (berdasarkan total qty terjual dari detail_jual)
        $barangTerlaris = \DB::table('barang')
            ->leftJoin('detail_jual', 'barang.id', '=', 'detail_jual.barang_id')
            ->select(
                'barang.id',
                'barang.nama_barang',
                'barang.stok',
                \DB::raw('COALESCE(SUM(detail_jual.qty), 0) as total_terjual')
            )
            ->groupBy('barang.id', 'barang.nama_barang', 'barang.stok')
            ->orderBy('total_terjual', 'DESC')
            ->limit(5)
            ->get();
        
        // Barang Stok Menipis (stok <= 10)
        $barangStokMenipis = Barang::where('stok', '<=', 10)
            ->orderBy('stok', 'ASC')
            ->limit(5)
            ->get();
        
        return view('barang.index', compact('barang', 'barangTerlaris', 'barangStokMenipis'));
    }

    public function create()
    {
        $jenisBarang = JenisBarang::all(); // ambil untuk dropdown
        return view('barang.create', compact('jenisBarang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'jenis_barang' => 'required|integer',
            'nama_barang' => 'required|string|max:100',
            'satuan' => 'required|string|max:75',
            'harga_pokok' => 'required|integer|min:0',
            'harga_jual' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        Barang::create($request->all());

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil ditambahkan!');
    }

    public function show(Barang $barang)
    {
        $barang->load('jenis'); // agar relasi jenis_barang ikut dimuat
        return view('barang.show', compact('barang'));
    }

    public function edit(Barang $barang)
    {
        $jenisBarang = JenisBarang::all();
        return view('barang.edit', compact('barang', 'jenisBarang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'jenis_barang' => 'required|integer',
            'nama_barang' => 'required|string|max:100',
            'satuan' => 'required|string|max:75',
            'harga_pokok' => 'required|integer|min:0',
            'harga_jual' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        $barang->update($request->all());

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil diperbarui!');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus!');
    }

    public function trans()
    {
        return "Masih dalam pengembangan";
    }
}
