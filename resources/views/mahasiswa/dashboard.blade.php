@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <!-- Header Dashboard -->
            <div class="card shadow-lg border-0 mb-4">
                <div class="card-body bg-gradient-primary text-white rounded">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="mb-1 text-secondary text">Dashboard Data Mahasiswa</h2>
                            <p class="mb-0 opacity-75 text-secondary text">Kelola data mahasiswa dengan mudah</p>
                        </div>
                        <div class="text-end">
                            <i class="fas fa-users fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <!-- Form Input Mahasiswa -->
            <div class="card shadow-lg border-0 mb-4">
                <div class="card-header bg-white py-3">
                    <h4 class="mb-0 text-dark">
                        <i class="fas fa-user-plus me-2 text-primary"></i>Input Data Mahasiswa Baru
                    </h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('mahasiswa.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <!-- NIM -->
                            <div class="col-md-6 mb-3">
                                <label for="nim" class="form-label fw-bold">
                                    <i class="fas fa-id-badge me-1 text-primary"></i>NIM <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('nim') is-invalid @enderror"
                                    id="nim" name="nim" value="{{ old('nim') }}"
                                    placeholder="Masukkan NIM" required>
                                @error('nim')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Nama -->
                            <div class="col-md-6 mb-3">
                                <label for="nama" class="form-label fw-bold">
                                    <i class="fas fa-user me-1 text-primary"></i>Nama Lengkap <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="nama" name="nama" value="{{ old('nama') }}"
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
                                    <i class="fas fa-calendar me-1 text-primary"></i>Tanggal Lahir <span class="text-danger">*</span>
                                </label>
                                <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                    id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                                @error('tanggal_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Jenis Kelamin -->
                            <div class="col-md-6 mb-3">
                                <label for="jenis_kelamin" class="form-label fw-bold">
                                    <i class="fas fa-venus-mars me-1 text-primary"></i>Jenis Kelamin <span class="text-danger">*</span>
                                </label>
                                <select class="form-select @error('jenis_kelamin') is-invalid @enderror"
                                    id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option value="">Pilih jenis kelamin</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Program Studi -->
                        <div class="mb-3">
                            <label for="prodi" class="form-label fw-bold">
                                <i class="fas fa-graduation-cap me-1 text-primary"></i>Program Studi <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('prodi') is-invalid @enderror"
                                id="prodi" name="prodi" value="{{ old('prodi') }}"
                                placeholder="Masukkan program studi" required>
                            @error('prodi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Alamat -->
                        <div class="mb-4">
                            <label for="alamat" class="form-label fw-bold">
                                <i class="fas fa-map-marker-alt me-1 text-primary"></i>Alamat Lengkap <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror"
                                id="alamat" name="alamat" rows="3"
                                placeholder="Masukkan alamat lengkap" required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Button Submit -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-plus me-2"></i>Tambah Data Mahasiswa
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tabel Data Mahasiswa -->
            <div class="card shadow-lg border-0">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 text-dark">
                            <i class="fas fa-table me-2 text-primary"></i>Data Mahasiswa
                        </h4>
                        <span class="badge bg-primary fs-6">Total: {{ $mahasiswas->count() }} mahasiswa</span>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($mahasiswas->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col">NIM</th>
                                    <th scope="col">Nama Lengkap</th>
                                    <th scope="col">Tanggal Lahir</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Program Studi</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mahasiswas as $index => $mahasiswa)
                                <tr>
                                    <td class="text-center fw-bold">{{ $index + 1 }}</td>
                                    <td><span class="badge bg-info">{{ $mahasiswa->nim ?? '-' }}</span></td>
                                    <td class="fw-semibold">{{ $mahasiswa->nama ?? '-' }}</td>
                                    <td>{{ $mahasiswa->tanggal_lahir ? $mahasiswa->tanggal_lahir->format('d/m/Y') : '-' }}</td>
                                    <td>
                                        @if($mahasiswa->jenis_kelamin == 'Laki-laki')
                                        <span class="badge bg-primary">{{ $mahasiswa->jenis_kelamin }}</span>
                                        @elseif($mahasiswa->jenis_kelamin == 'Perempuan')
                                        <span class="badge bg-pink">{{ $mahasiswa->jenis_kelamin }}</span>
                                        @else
                                        <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>{{ $mahasiswa->prodi ?? '-' }}</td>
                                    <td>
                                        @if($mahasiswa->alamat)
                                        {{ Str::limit($mahasiswa->alamat, 30) }}
                                        @else
                                        <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <a href="{{ route('mahasiswa.edit', $mahasiswa) }}"
                                                class="btn btn-warning btn-sm text-white" title="Edit Data">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm"
                                                title="Hapus Data" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $mahasiswa->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>

                                        <!-- Modal Konfirmasi Hapus -->
                                        <div class="modal fade" id="deleteModal{{ $mahasiswa->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah Anda yakin ingin menghapus data mahasiswa:</p>
                                                        <div class="alert alert-warning">
                                                            <strong>{{ $mahasiswa->nama }}</strong><br>
                                                            <small>NIM: {{ $mahasiswa->nim }}</small>
                                                        </div>
                                                        <p class="text-danger"><strong>Tindakan ini tidak dapat dibatalkan!</strong></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <form action="{{ route('mahasiswa.destroy', $mahasiswa) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">
                                                                <i class="fas fa-trash me-1"></i>Hapus Data
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <i class="fas fa-users fa-5x text-muted mb-3"></i>
                        <h5 class="text-muted">Belum ada data mahasiswa</h5>
                        <p class="text-muted">Silakan tambahkan data mahasiswa menggunakan form di atas</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .card {
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-2px);
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
        transform: translateY(-1px);
    }

    .table th {
        font-weight: 600;
        font-size: 0.9rem;
    }

    .table td {
        vertical-align: middle;
        font-size: 0.85rem;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(102, 126, 234, 0.1);
    }

    .bg-pink {
        background-color: #e91e63 !important;
    }

    .alert {
        border: none;
        border-radius: 10px;
    }

    .btn-sm {
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        border-radius: 0.375rem;
        min-width: 40px;
    }

    .btn-sm i {
        font-size: 0.875rem;
    }

    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
    }

    .btn-warning:hover {
        background-color: #e0a800;
        border-color: #d39e00;
        transform: translateY(-1px);
    }

    .btn-danger:hover {
        transform: translateY(-1px);
    }

    .table-responsive {
        border-radius: 0 0 0.5rem 0.5rem;
    }

    .badge {
        font-size: 0.8rem;
    }

    /* Memastikan icon Font Awesome tampil dengan baik */
    .fas,
    .far,
    .fab {
        font-family: "Font Awesome 6 Free", "Font Awesome 6 Brands";
        font-weight: 900;
        display: inline-block;
    }
</style>
@endsection