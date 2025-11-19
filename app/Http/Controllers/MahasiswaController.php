<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Dashboard dengan tabel data mahasiswa
    public function dashboard()
    {
        $mahasiswas = Mahasiswa::latest()->get();
        return view('mahasiswa.dashboard', compact('mahasiswas'));
    }

    // Simpan data mahasiswa baru
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|string|max:20|unique:mahasiswas,nim',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'prodi' => 'required|string|max:255',
        ]);

        Mahasiswa::create([
            'user_id' => Auth::id(),
            'nim' => $request->nim,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'prodi' => $request->prodi,
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Data mahasiswa berhasil ditambahkan!');
    }

    // Edit data mahasiswa
    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    // Update data mahasiswa
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nim' => 'required|string|max:20|unique:mahasiswas,nim,' . $mahasiswa->id,
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'prodi' => 'required|string|max:255',
        ]);

        $mahasiswa->update($request->all());

        return redirect()->route('dashboard')
            ->with('success', 'Data mahasiswa berhasil diperbarui!');
    }

    // Hapus data mahasiswa
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()->route('dashboard')
            ->with('success', 'Data mahasiswa berhasil dihapus!');
    }
}
