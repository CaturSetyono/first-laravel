@extends('adminlte::page')

@section('title', 'Data Jenis Barang')

@section('content_header')
<h1><i class="fas fa-tags"></i> Data Jenis Barang</h1>
@stop

@section('content')
<div class="container-fluid">
    <!-- Add Button -->
    <div class="mb-3">
        <a href="{{ route('jenis-barang.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle me-1"></i> Tambah Data
        </a>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Error Alert -->
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-circle me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <!-- Stats -->
    <div class="row stats-row">
        <div class="col-md-4">
            <div class="stat-card total">
                <p class="stat-number">{{ $jenisBarang->count() }}</p>
                <p class="stat-label">Total Jenis Barang</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card active">
                <p class="stat-number">{{ $jenisBarang->where('aktif', true)->count() }}</p>
                <p class="stat-label">Status Aktif</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card inactive">
                <p class="stat-number">{{ $jenisBarang->where('aktif', false)->count() }}</p>
                <p class="stat-label">Status Non-Aktif</p>
            </div>
        </div>
    </div>
    <!-- Table Card -->
    <div class="card-table">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title mb-0">Daftar Jenis Barang</h5>
                <div class="d-flex gap-2">
                    <input type="text" class="form-control search-input" placeholder="Cari jenis barang..." style="width: 250px;">
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="5%">Id</th>
                            <th>Kode</th>
                            <th>Nama Jenis</th>
                            <th>Deskripsi</th>
                            <th width="10%">Status</th>
                            <th width="10%">Aksi</th>
                            <th>Direkam tgl</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jenisBarang as $index => $jb)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <code class="text-primary">{{ $jb->kode_jenis }}</code>
                            </td>
                            <td class="fw-medium">{{ $jb->nama_jenis }}</td>
                            <td class="text-muted small">
                                {{ Str::limit($jb->deskripsi, 60) }}
                            </td>
                            <td>
                                @if($jb->aktif)
                                <span class="badge bg-success-subtle text-success">Aktif</span>
                                @else
                                <span class="badge bg-warning-subtle text-warning">Non-Aktif</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('jenis-barang.edit', $jb->id) }}"
                                        class="btn btn-warning btn-sm text-white"
                                        title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('jenis-barang.destroy', $jb->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus jenis barang ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-danger btn-sm"
                                            title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td class="text-muted small">
                                {{ $jb->created_at->format('d M Y') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="bi bi-inbox fa-2x mb-2"></i>
                                    <p class="mb-0">Belum ada data jenis barang</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
        <div class="card-footer bg-white border-0">
            <small class="text-muted">
                Menampilkan {{ $jenisBarang->count() }} data dari total {{ $jenisBarang->count() }}
            </small>
        </div>
    </div>
</div>

<script>
    document.querySelector('.search-input').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');

        rows.forEach(row => {
            if (row.querySelector('td[colspan]')) return;
            const text = row.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>

@stop

@section('css')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
<link rel="stylesheet" href="{{ asset('css/admin-pro.css') }}">
@stop

@section('js')
<script src="{{ asset('js/admin-pro.js') }}" defer></script>
<script>
    document.querySelector('.search-input')?.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');

        rows.forEach(row => {
            if (row.querySelector('td[colspan]')) return;
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });
</script>
@stop