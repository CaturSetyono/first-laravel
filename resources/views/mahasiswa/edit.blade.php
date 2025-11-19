@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Header -->
            <div class="card shadow-lg border-0 mb-4">
                <div class="card-body bg-gradient-warning text-dark rounded">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="mb-1">Edit Data Mahasiswa</h2>
                            <p class="mb-0 opacity-75">Perbarui informasi mahasiswa</p>
                        </div>
                        <div class="text-end">
                            <i class="fas fa-user-edit fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Edit -->
            <div class="card shadow-lg border-0">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 text-dark">
                            <i class="fas fa-edit me-2 text-warning"></i>Form Edit Mahasiswa
                        </h4>
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('mahasiswa.update', $mahasiswa) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- NIM -->
                            <div class="col-md-6 mb-3">
                                <label for="nim" class="form-label fw-bold">
                                    <i class="fas fa-id-badge me-1 text-warning"></i>NIM <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('nim') is-invalid @enderror"
                                    id="nim" name="nim"
                                    value="{{ old('nim', $mahasiswa->nim) }}"
                                    placeholder="Masukkan NIM" required>
                                @error('nim')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Nama -->
                            <div class="col-md-6 mb-3">
                                <label for="nama" class="form-label fw-bold">
                                    <i class="fas fa-user me-1 text-warning"></i>Nama Lengkap <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="nama" name="nama"
                                    value="{{ old('nama', $mahasiswa->nama) }}"
                                    placeholder="Masukkan nama lengkap" required>
                                @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Tanggal Lahir -->
                            <div class="col-md-6 mb-3">
                                <label for="tanggal_lahir" class="form-label fw-bold">
                                    <i class="fas fa-calendar me-1 text-warning"></i>Tanggal Lahir <span class="text-danger">*</span>
                                </label>
                                <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                    id="tanggal_lahir" name="tanggal_lahir"
                                    value="{{ old('tanggal_lahir', $mahasiswa->tanggal_lahir?->format('Y-m-d')) }}" required>
                                @error('tanggal_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Jenis Kelamin -->
                            <div class="col-md-6 mb-3">
                                <label for="jenis_kelamin" class="form-label fw-bold">
                                    <i class="fas fa-venus-mars me-1 text-warning"></i>Jenis Kelamin <span class="text-danger">*</span>
                                </label>
                                <select class="form-select @error('jenis_kelamin') is-invalid @enderror"
                                    id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option value="">Pilih jenis kelamin</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin', $mahasiswa->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin', $mahasiswa->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Program Studi -->
                        <div class="mb-3">
                            <label for="prodi" class="form-label fw-bold">
                                <i class="fas fa-graduation-cap me-1 text-warning"></i>Program Studi <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('prodi') is-invalid @enderror"
                                id="prodi" name="prodi"
                                value="{{ old('prodi', $mahasiswa->prodi) }}"
                                placeholder="Masukkan program studi" required>
                            @error('prodi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Alamat -->
                        <div class="mb-4">
                            <label for="alamat" class="form-label fw-bold">
                                <i class="fas fa-map-marker-alt me-1 text-warning"></i>Alamat Lengkap <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror"
                                id="alamat" name="alamat" rows="3"
                                placeholder="Masukkan alamat lengkap" required>{{ old('alamat', $mahasiswa->alamat) }}</textarea>
                            @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary w-100">
                                    <i class="fas fa-times me-2"></i>Batal
                                </a>
                            </div>
                            <div class="col-md-6 mb-2">
                                <button type="submit" class="btn btn-warning w-100">
                                    <i class="fas fa-save me-2"></i>Update Data
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .bg-gradient-warning {
        background: linear-gradient(135deg, #ffc107 0%, #ffb300 100%);
    }

    .card {
        transition: all 0.3s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #ffc107;
        box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
    }

    .btn-warning {
        background: linear-gradient(135deg, #ffc107 0%, #ffb300 100%);
        border: none;
        color: #000;
        font-weight: 600;
    }

    .btn-warning:hover {
        background: linear-gradient(135deg, #ffcd39 0%, #ffc107 100%);
        transform: translateY(-1px);
        color: #000;
    }

    .alert {
        border: none;
        border-radius: 10px;
    }
</style>
@endsection