@extends('adminlte::page')

@section('title', 'Edit Jenis Barang')

@section('content_header')
    <h1><i class="fas fa-edit"></i> Edit Jenis Barang</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="info-badge">
                            <i class="fas fa-info-circle me-2"></i>
                            ID: {{ $jenisBarang->id }} | Dibuat: {{ $jenisBarang->created_at->format('d M Y H:i') }}
                        </div>
                        
                        <h5 class="card-title mb-4">Form Edit Jenis Barang</h5>
                        
                        <form action="{{ route('jenis-barang.update', $jenisBarang->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="kode_jenis" class="form-label">
                                            Kode Jenis <span class="required">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control @error('kode_jenis') is-invalid @enderror" 
                                               id="kode_jenis" 
                                               name="kode_jenis" 
                                               value="{{ old('kode_jenis', $jenisBarang->kode_jenis) }}"
                                               placeholder="Contoh: ELK"
                                               required>
                                        @error('kode_jenis')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nama_jenis" class="form-label">
                                            Nama Jenis <span class="required">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control @error('nama_jenis') is-invalid @enderror" 
                                               id="nama_jenis" 
                                               name="nama_jenis" 
                                               value="{{ old('nama_jenis', $jenisBarang->nama_jenis) }}"
                                               placeholder="Contoh: Elektronik"
                                               required>
                                        @error('nama_jenis')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                          id="deskripsi" 
                                          name="deskripsi" 
                                          rows="4" 
                                          placeholder="Masukkan deskripsi jenis barang...">{{ old('deskripsi', $jenisBarang->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label for="aktif" class="form-label">Status</label>
                                <select class="form-select @error('aktif') is-invalid @enderror" 
                                        id="aktif" 
                                        name="aktif">
                                    <option value="1" {{ old('aktif', $jenisBarang->aktif) == '1' ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ old('aktif', $jenisBarang->aktif) == '0' ? 'selected' : '' }}>Non-Aktif</option>
                                </select>
                                @error('aktif')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('jenis-barang.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times me-2"></i>
                                    Batal
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
