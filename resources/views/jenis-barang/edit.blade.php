@extends('layouts.app')
@section('content')
<div class="container">
 <h4>Edit Jenis Barang</h4>
 <form action="{{ route('jenis-barang.update', $jenis_barang->id) }}"
 method="POST">
 @csrf
 @method('PUT')
 <div class="mb-3">
 <label for="nama_jenis" class="form-label">Nama Jenis</label>
 <input type="text" name="nama_jenis" class="form-control"
 value="{{ old('nama_jenis', $jenis_barang->nama_jenis) }}" required>
 @error('nama_jenis')
 <div class="text-danger small">{{ $message }}</div>
 @enderror
 </div>
 <button class="btn btn-success">Update</button>
 <a href="{{ route('jenis-barang.index') }}"
 class="btn btn-secondary">Kembali</a>
 </form>
</div>
@endsection