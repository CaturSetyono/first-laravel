@extends('adminlte::page')

@section('title', 'Edit Profile')

@section('content_header')
<h1><i class="fas fa-user-edit"></i> Edit Profile</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
            @endif

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Informasi Profile</h3>
                </div>

                <form action="{{ route('admin.settings.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">
                                <i class="fas fa-user"></i> Nama Lengkap
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                id="name"
                                name="name"
                                value="{{ old('name', Auth::user()->name) }}"
                                placeholder="Masukkan nama lengkap"
                                required>
                            @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">
                                <i class="fas fa-envelope"></i> Email
                                <span class="text-danger">*</span>
                            </label>
                            <input type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                id="email"
                                name="email"
                                value="{{ old('email', Auth::user()->email) }}"
                                placeholder="Masukkan email"
                                required>
                            @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            <strong>Informasi:</strong> Pastikan email Anda valid dan aktif untuk menerima notifikasi.
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.settings.index') }}" class="btn btn-default">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
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
<script>
    setTimeout(function() {
        $('.alert-success').fadeOut('slow');
    }, 5000);
</script>
@stop