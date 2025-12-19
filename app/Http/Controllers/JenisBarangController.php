<?php

namespace App\Http\Controllers;

use App\Models\JenisBarang;
use Illuminate\Http\Request;

class JenisBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenisBarang = JenisBarang::all();
        return view('jenis-barang.index', compact('jenisBarang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jenis-barang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'kode_jenis' => 'required|string|max:10|unique:jenis_barang,kode_jenis',
            'nama_jenis' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'aktif' => 'required|boolean'
        ], [
            'kode_jenis.required' => 'Kode jenis wajib diisi.',
            'kode_jenis.unique' => 'Kode jenis sudah ada, gunakan kode yang lain.',
            'kode_jenis.max' => 'Kode jenis maksimal 10 karakter.',
            'nama_jenis.required' => 'Nama jenis wajib diisi.',
            'nama_jenis.max' => 'Nama jenis maksimal 255 karakter.',
            'aktif.required' => 'Status wajib dipilih.'
        ]);

        // Simpan ke database
        JenisBarang::create($validatedData);

        return redirect()->route('jenis-barang.index')
                        ->with('success', 'Jenis barang berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jenisBarang = JenisBarang::findOrFail($id);
        return view('jenis-barang.show', compact('jenisBarang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jenisBarang = JenisBarang::findOrFail($id);
        return view('jenis-barang.edit', compact('jenisBarang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jenisBarang = JenisBarang::findOrFail($id);
        
        // Validasi input
        $validatedData = $request->validate([
            'kode_jenis' => 'required|string|max:10|unique:jenis_barang,kode_jenis,' . $id,
            'nama_jenis' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'aktif' => 'required|boolean'
        ], [
            'kode_jenis.required' => 'Kode jenis wajib diisi.',
            'kode_jenis.unique' => 'Kode jenis sudah ada, gunakan kode yang lain.',
            'kode_jenis.max' => 'Kode jenis maksimal 10 karakter.',
            'nama_jenis.required' => 'Nama jenis wajib diisi.',
            'nama_jenis.max' => 'Nama jenis maksimal 255 karakter.',
            'aktif.required' => 'Status wajib dipilih.'
        ]);

        // Update data
        $jenisBarang->update($validatedData);

        // Redirect dengan pesan sukses
        return redirect()->route('jenis-barang.index')
                        ->with('success', 'Jenis barang berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $jenisBarang = JenisBarang::findOrFail($id);
            $jenisBarang->delete();

            return redirect()->route('jenis-barang.index')
                            ->with('success', 'Jenis barang berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('jenis-barang.index')
                            ->with('error', 'Gagal menghapus jenis barang');
        }
    }
}
