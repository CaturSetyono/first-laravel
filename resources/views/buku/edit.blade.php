@extends('adminlte::page')

@section('title', 'Edit Buku')

@section('content_header')
    <h1><i class="fas fa-edit"></i> Edit Buku</h1>
@stop

@section('content')
<div class="card shadow">
    <div class="card-header bg-warning text-white">
        <h5 class="mb-0">Edit Buku</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('buku.update', $buku->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Buku</label>
                <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                       id="judul" name="judul" value="{{ old('judul', $buku->judul) }}">
                @error('judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="pengarang_id" class="form-label">Pengarang</label>
                <select class="form-select @error('pengarang_id') is-invalid @enderror" 
                        id="pengarang_id" name="pengarang_id">
                    <option value="">-- Pilih Pengarang --</option>
                    @foreach($pengarang as $p)
                        <option value="{{ $p->id }}" 
                            {{ old('pengarang_id', $buku->pengarang_id) == $p->id ? 'selected' : '' }}>
                            {{ $p->nama_pengarang }}
                        </option>
                    @endforeach
                </select>
                @error('pengarang_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="isbn" class="form-label">ISBN</label>
                <input type="text" class="form-control @error('isbn') is-invalid @enderror" 
                       id="isbn" name="isbn" value="{{ old('isbn', $buku->isbn) }}">
                @error('isbn')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                        <input type="number" class="form-control @error('tahun_terbit') is-invalid @enderror" 
                               id="tahun_terbit" name="tahun_terbit" 
                               value="{{ old('tahun_terbit', $buku->tahun_terbit) }}">
                        @error('tahun_terbit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="jumlah_halaman" class="form-label">Jumlah Halaman</label>
                        <input type="number" class="form-control @error('jumlah_halaman') is-invalid @enderror" 
                               id="jumlah_halaman" name="jumlah_halaman" 
                               value="{{ old('jumlah_halaman', $buku->jumlah_halaman) }}">
                        @error('jumlah_halaman')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="penerbit" class="form-label">Penerbit</label>
                <input type="text" class="form-control @error('penerbit') is-invalid @enderror" 
                       id="penerbit" name="penerbit" value="{{ old('penerbit', $buku->penerbit) }}">
                @error('penerbit')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control @error('harga') is-invalid @enderror" 
                               id="harga" name="harga" value="{{ old('harga', $buku->harga) }}">
                        @error('harga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" class="form-control @error('stok') is-invalid @enderror" 
                               id="stok" name="stok" value="{{ old('stok', $buku->stok) }}">
                        @error('stok')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('buku.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </form>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@stop
