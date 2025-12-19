@extends('adminlte::page')

@section('title', 'Daftar Buku')

@section('content_header')
    <h1><i class="fas fa-book"></i> Daftar Buku</h1>
@stop

@section('content')
<style>
    .page-header {
        background-color: #ffffff;
        padding: 24px 28px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        margin-bottom: 24px;
        border-left: 4px solid #8b5cf6;
    }
    .page-header h3 {
        margin: 0;
        color: #1a1d29;
        font-weight: 700;
        font-size: 1.75rem;
    }
    .card-table {
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        border: 1px solid #e5e7eb;
    }
    .table {
        margin-bottom: 0;
    }
    .table thead th {
        background-color: #f8fafc;
        color: #475569;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        padding: 16px;
        border-bottom: 2px solid #e5e7eb;
    }
    .table tbody tr {
        transition: all 0.2s ease;
        border-bottom: 1px solid #f1f5f9;
    }
    .table tbody tr:hover {
        background-color: #f8fafc;
    }
    .table tbody td {
        padding: 16px;
        vertical-align: middle;
        color: #334155;
    }
    .btn-action-group {
        display: flex;
        gap: 6px;
    }
    .btn-sm {
        padding: 6px 14px;
        font-size: 0.875rem;
        border-radius: 6px;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    .btn-primary {
        background-color: #8b5cf6;
        border: none;
        box-shadow: 0 2px 6px rgba(139, 92, 246, 0.3);
    }
    .btn-primary:hover {
        background-color: #7c3aed;
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(139, 92, 246, 0.4);
    }
    .btn-info {
        background-color: #0ea5e9;
        border: none;
    }
    .btn-info:hover {
        background-color: #0284c7;
    }
    .btn-warning {
        background-color: #f59e0b;
        border: none;
        color: white;
    }
    .btn-warning:hover {
        background-color: #d97706;
        color: white;
    }
    .btn-danger {
        background-color: #ef4444;
        border: none;
    }
    .btn-danger:hover {
        background-color: #dc2626;
    }
    .alert {
        border-radius: 10px;
        border: none;
        padding: 16px 20px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
    }
    .alert-success {
        background-color: #d1fae5;
        color: #065f46;
        border-left: 4px solid #10b981;
    }
    .alert-danger {
        background-color: #fee2e2;
        color: #991b1b;
        border-left: 4px solid #ef4444;
    }
    .badge {
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.75rem;
    }
    .badge-stock {
        background-color: #dbeafe;
        color: #1e40af;
    }
    .badge-pengarang {
        background-color: #e0e7ff;
        color: #4338ca;
    }
</style>

<div class="container-fluid">
    <div class="mb-3">
        <a href="{{ route('buku.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Tambah Buku
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
        </div>
    @endif

    <div class="card-table">
        <table class="table">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="25%">Judul Buku</th>
                    <th width="15%">Pengarang</th>
                    <th width="12%">ISBN</th>
                    <th width="8%">Tahun</th>
                    <th width="15%">Penerbit</th>
                    <th width="10%" class="text-end">Harga</th>
                    <th width="5%" class="text-center">Stok</th>
                    <th width="5%" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($buku as $index => $b)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td><strong>{{ $b->judul }}</strong></td>
                    <td><span class="badge badge-pengarang">{{ $b->nama_pengarang }}</span></td>
                    <td>{{ $b->isbn }}</td>
                    <td class="text-center">{{ $b->tahun_terbit }}</td>
                    <td>{{ $b->penerbit }}</td>
                    <td class="text-end"><strong>Rp {{ number_format($b->harga, 0, ',', '.') }}</strong></td>
                    <td class="text-center"><span class="badge badge-stock">{{ $b->stok }}</span></td>
                    <td>
                        <div class="btn-action-group">
                            <a href="{{ route('buku.show', $b->id) }}"
                               class="btn btn-sm btn-info text-white"
                               title="Lihat Detail">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('buku.edit', $b->id) }}"
                               class="btn btn-sm btn-warning"
                               title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('buku.destroy', $b->id) }}"
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Yakin hapus buku ini?')"
                                        title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center" style="padding: 40px;">
                        <i class="bi bi-inbox" style="font-size: 3rem; color: #cbd5e1;"></i>
                        <p class="mt-2 mb-0" style="color: #94a3b8;">Tidak ada data buku</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@stop

@section('js')
    <script>
        console.log('Halaman Daftar Buku');
    </script>
@stop
