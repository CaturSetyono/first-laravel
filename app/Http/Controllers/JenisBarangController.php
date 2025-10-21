<?php

namespace App\Http\Controllers;

use App\Models\JenisBarang;
use Illuminate\Http\Request;

class JenisBarangController extends Controller
{
    public function index()
    {
        $data = JenisBarang::latest()->paginate(10);
        return view('jenis-barang.index', compact('data'));
    }
    public function create()
    {
        return view('jenis-barang.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis' => 'required|max:50',
        ]);
        JenisBarang::create($request->only('nama_jenis'));
        return redirect()->route('jenis-barang.index')
            ->with('success', 'Jenis barang berhasil ditambahkan');
    }
    public function edit(JenisBarang $jenis_barang)
    {
        return view('jenis-barang.edit', compact('jenis_barang'));
    }
    public function update(Request $request, JenisBarang $jenis_barang)
    {
        $request->validate([
            'nama_jenis' => 'required|max:50',
        ]);
        $jenis_barang->update($request->only('nama_jenis'));
        return redirect()->route('jenis-barang.index')
            ->with('success', 'Jenis barang berhasil diperbarui');
    }
    public function destroy(JenisBarang $jenis_barang)
    {
        $jenis_barang->delete();
        return redirect()->route('jenis-barang.index')
            ->with('success', 'Jenis barang berhasil dihapus');
    }
}
