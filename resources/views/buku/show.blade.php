@extends('adminlte::page')

@section('title', 'Detail Buku')

@section('content_header')
    <h1><i class="fas fa-book-open"></i> Detail Buku</h1>
@stop

@section('content')
<div class="card shadow">
    <div class="card-header bg-info text-white">
        <h5 class="mb-0">Informasi Buku</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th width="200">Judul</th>
                    <td><strong>{{ $buku->judul }}</strong></td>
                </tr>
                <tr>
                    <th>Pengarang</th>
                    <td>{{ $buku->nama_pengarang }} ({{ $buku->negara }})</td>
                </tr>
                <tr>
                    <th>ISBN</th>
                    <td>{{ $buku->isbn }}</td>
                </tr>
                <tr>
                    <th>Tahun Terbit</th>
                    <td>{{ $buku->tahun_terbit }}</td>
                </tr>
                <tr>
                    <th>Jumlah Halaman</th>
                    <td>{{ $buku->jumlah_halaman }} halaman</td>
                </tr>
                <tr>
                    <th>Penerbit</th>
                    <td>{{ $buku->penerbit }}</td>
                </tr>
                <tr>
                    <th>Harga</th>
                    <td>Rp {{ number_format($buku->harga, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Stok</th>
                    <td>{{ $buku->stok }}</td>
                </tr>
            </tbody>
        </table>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('buku.index') }}" class="btn btn-secondary">Kembali</a>
            <div>
                <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Yakin hapus buku ini?')">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@stop
