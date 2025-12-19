@extends('adminlte::page')

@section('title', 'Pengaturan')

@section('content_header')
    <h1><i class="fas fa-cog"></i> Pengaturan</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Profile Card -->
        <div class="col-md-6">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <div class="mb-3">
                            <i class="fas fa-user-circle fa-5x text-primary"></i>
                        </div>
                    </div>

                    <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
                    <p class="text-muted text-center">{{ Auth::user()->email }}</p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Member Sejak</b> 
                            <span class="float-right">{{ Auth::user()->created_at->format('d M Y') }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Terakhir Update</b> 
                            <span class="float-right">{{ Auth::user()->updated_at->format('d M Y H:i') }}</span>
                        </li>
                    </ul>

                    <a href="{{ route('admin.settings.profile') }}" class="btn btn-primary btn-block">
                        <i class="fas fa-edit"></i> <b>Edit Profile</b>
                    </a>
                </div>
            </div>
        </div>

        <!-- Security Card -->
        <div class="col-md-6">
            <div class="card card-warning card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-shield-alt"></i> Keamanan
                    </h3>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <i class="fas fa-lock fa-4x text-warning"></i>
                    </div>
                    <p class="text-center">
                        Jaga keamanan akun Anda dengan mengganti password secara berkala.
                    </p>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fas fa-check text-success"></i> Gunakan password yang kuat
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success"></i> Kombinasi huruf, angka, dan simbol
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success"></i> Minimal 8 karakter
                        </li>
                    </ul>
                    <a href="{{ route('admin.settings.password') }}" class="btn btn-warning btn-block">
                        <i class="fas fa-key"></i> <b>Ubah Password</b>
                    </a>
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
