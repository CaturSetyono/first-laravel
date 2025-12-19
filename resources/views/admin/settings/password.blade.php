@extends('adminlte::page')

@section('title', 'Ubah Password')

@section('content_header')
    <h1><i class="fas fa-key"></i> Ubah Password</h1>
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

            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Ubah Password Akun</h3>
                </div>

                <form action="{{ route('admin.settings.password.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="card-body">
                        <div class="form-group">
                            <label for="current_password">
                                <i class="fas fa-lock"></i> Password Saat Ini
                                <span class="text-danger">*</span>
                            </label>
                            <input type="password" 
                                   class="form-control @error('current_password') is-invalid @enderror" 
                                   id="current_password" 
                                   name="current_password" 
                                   placeholder="Masukkan password saat ini"
                                   required>
                            @error('current_password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <hr>

                        <div class="form-group">
                            <label for="password">
                                <i class="fas fa-key"></i> Password Baru
                                <span class="text-danger">*</span>
                            </label>
                            <input type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   id="password" 
                                   name="password" 
                                   placeholder="Masukkan password baru"
                                   required>
                            @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                            <small class="form-text text-muted">
                                Password minimal 8 karakter
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">
                                <i class="fas fa-key"></i> Konfirmasi Password Baru
                                <span class="text-danger">*</span>
                            </label>
                            <input type="password" 
                                   class="form-control" 
                                   id="password_confirmation" 
                                   name="password_confirmation" 
                                   placeholder="Ulangi password baru"
                                   required>
                        </div>

                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i> 
                            <strong>Peringatan:</strong>
                            <ul class="mb-0 mt-2">
                                <li>Pastikan password yang Anda masukkan aman dan mudah diingat</li>
                                <li>Jangan berikan password Anda kepada siapapun</li>
                                <li>Gunakan kombinasi huruf besar, kecil, angka, dan simbol</li>
                            </ul>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save"></i> Ubah Password
                        </button>
                        <a href="{{ route('admin.settings.index') }}" class="btn btn-default">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>

            <!-- Password Strength Info -->
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-info-circle"></i> Tips Password Kuat
                    </h3>
                </div>
                <div class="card-body">
                    <ul>
                        <li><i class="fas fa-check text-success"></i> Minimal 8 karakter</li>
                        <li><i class="fas fa-check text-success"></i> Gunakan huruf besar dan kecil (A-Z, a-z)</li>
                        <li><i class="fas fa-check text-success"></i> Gunakan angka (0-9)</li>
                        <li><i class="fas fa-check text-success"></i> Gunakan karakter khusus (!@#$%^&*)</li>
                        <li><i class="fas fa-times text-danger"></i> Jangan gunakan informasi pribadi</li>
                        <li><i class="fas fa-times text-danger"></i> Jangan gunakan password yang sama di akun lain</li>
                    </ul>
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
<script>
    setTimeout(function() {
        $('.alert-success').fadeOut('slow');
    }, 5000);
</script>
@stop
