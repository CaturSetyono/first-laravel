@extends('adminlte::page')

@section('title', 'Tambah Barang')

@section('content_header')
    <h1><i class="fas fa-plus-circle"></i> Tambah Barang</h1>
@stop

@section('content')
<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Tambah Barang</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('barang.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="id" class="form-label">Kode Barang</label>
                <input type="number" name="id" id="id"
                       value="{{ old('id') }}"
                       class="form-control @error('id') is-invalid @enderror">
                @error('id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="jenis_barang" class="form-label">Jenis Barang</label>
                <select name="jenis_barang" id="jenis_barang"
                        class="form-select @error('jenis_barang') is-invalid @enderror">
                    <option value="">-- Pilih Jenis Barang --</option>
                    @foreach($jenisBarang as $jenis)
                        <option value="{{ $jenis->id }}"
                                {{ old('jenis_barang') == $jenis->id ? 'selected' : '' }}>
                            {{ $jenis->nama_jenis }}
                        </option>
                    @endforeach
                </select>
                @error('jenis_barang')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="nama_barang" class="form-label">Nama Barang</label>
                <input type="text" name="nama_barang" id="nama_barang"
                       value="{{ old('nama_barang') }}"
                       class="form-control @error('nama_barang') is-invalid @enderror">
                @error('nama_barang')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="satuan" class="form-label">Satuan</label>
                <input type="text" name="satuan" id="satuan"
                       value="{{ old('satuan') }}"
                       class="form-control @error('satuan') is-invalid @enderror">
                @error('satuan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="harga_pokok" class="form-label">Harga Pokok</label>
                <input type="number" name="harga_pokok" id="harga_pokok"
                       value="{{ old('harga_pokok') }}"
                       class="form-control @error('harga_pokok') is-invalid @enderror">
                @error('harga_pokok')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="harga_jual" class="form-label">Harga Jual</label>
                <input type="number" name="harga_jual" id="harga_jual"
                       value="{{ old('harga_jual') }}"
                       class="form-control @error('harga_jual') is-invalid @enderror">
                @error('harga_jual')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="stok" class="form-label">Stok</label>
                <input type="number" name="stok" id="stok"
                       value="{{ old('stok') }}"
                       class="form-control @error('stok') is-invalid @enderror">
                @error('stok')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('barang.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
</div>
@stop

@section('css')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/admin-pro.css') }}">
@stop

@section('js')
<script src="{{ asset('js/admin-pro.js') }}" defer></script>
@stop
