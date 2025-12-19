<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BukuController extends Controller
{
    // Menampilkan daftar buku dengan join ke tabel pengarang
    public function index()
    {
        $buku = DB::table('buku')
            ->join('pengarang', 'buku.pengarang_id', '=', 'pengarang.id')
            ->select('buku.*', 'pengarang.nama_pengarang', 'pengarang.negara')
            ->get();
        
        return view('buku.index', compact('buku'));
    }

    // Form untuk menambah buku baru
    public function create()
    {
        $pengarang = DB::table('pengarang')->get();
        return view('buku.create', compact('pengarang'));
    }

    // Menyimpan buku baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:200',
            'pengarang_id' => 'required|exists:pengarang,id',
            'isbn' => 'required|unique:buku,isbn|max:20',
            'tahun_terbit' => 'required|integer',
            'jumlah_halaman' => 'required|integer',
            'penerbit' => 'required|max:100',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
        ]);

        $inserted = DB::table('buku')->insert([
            'judul' => $request->judul,
            'pengarang_id' => $request->pengarang_id,
            'isbn' => $request->isbn,
            'tahun_terbit' => $request->tahun_terbit,
            'jumlah_halaman' => $request->jumlah_halaman,
            'penerbit' => $request->penerbit,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($inserted) {
            return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan!');
        }

        return redirect()->back()->with('error', 'Gagal menambahkan buku!');
    }

    // Form untuk edit buku
    public function edit($id)
    {
        $buku = DB::table('buku')->where('id', $id)->first();
        $pengarang = DB::table('pengarang')->get();
        
        if (!$buku) {
            return redirect()->route('buku.index')->with('error', 'Buku tidak ditemukan!');
        }
        
        return view('buku.edit', compact('buku', 'pengarang'));
    }

    // Update data buku
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|max:200',
            'pengarang_id' => 'required|exists:pengarang,id',
            'isbn' => 'required|max:20|unique:buku,isbn,' . $id,
            'tahun_terbit' => 'required|integer',
            'jumlah_halaman' => 'required|integer',
            'penerbit' => 'required|max:100',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
        ]);

        $updated = DB::table('buku')
            ->where('id', $id)
            ->update([
                'judul' => $request->judul,
                'pengarang_id' => $request->pengarang_id,
                'isbn' => $request->isbn,
                'tahun_terbit' => $request->tahun_terbit,
                'jumlah_halaman' => $request->jumlah_halaman,
                'penerbit' => $request->penerbit,
                'harga' => $request->harga,
                'stok' => $request->stok,
                'updated_at' => now(),
            ]);

        if ($updated) {
            return redirect()->route('buku.index')->with('success', 'Buku berhasil diupdate!');
        }

        return redirect()->back()->with('error', 'Gagal mengupdate buku!');
    }

    // Hapus buku
    public function destroy($id)
    {
        $deleted = DB::table('buku')->where('id', $id)->delete();

        if ($deleted) {
            return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus!');
        }

        return redirect()->back()->with('error', 'Gagal menghapus buku!');
    }

    // Menampilkan detail buku dengan join
    public function show($id)
    {
        $buku = DB::table('buku')
            ->join('pengarang', 'buku.pengarang_id', '=', 'pengarang.id')
            ->select('buku.*', 'pengarang.nama_pengarang', 'pengarang.bio', 'pengarang.negara')
            ->where('buku.id', $id)
            ->first();
        
        if (!$buku) {
            return redirect()->route('buku.index')->with('error', 'Buku tidak ditemukan!');
        }
        
        return view('buku.show', compact('buku'));
    }
}
