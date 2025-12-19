@extends('adminlte::page')

@section('title', 'Daftar Barang')

@section('content_header')
    <h1><i class="fas fa-box-seam"></i> Daftar Barang</h1>
@stop

@section('content')
<style>
    .page-header {
        background-color: #ffffff;
        padding: 24px 28px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        margin-bottom: 24px;
        border-left: 4px solid #3b82f6;
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
        background-color: #3b82f6;
        border: none;
        box-shadow: 0 2px 6px rgba(59, 130, 246, 0.3);
    }
    .btn-primary:hover {
        background-color: #2563eb;
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(59, 130, 246, 0.4);
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
    .stats-row {
        margin-bottom: 1.5rem;
    }
    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 1.25rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        border: 1px solid #e5e7eb;
        transition: all 0.2s ease;
    }
    .stat-card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }
    .stat-card.terlaris { 
        border-left: 4px solid #f59e0b; 
    }
    .stat-card.stok-menipis { 
        border-left: 4px solid #ef4444; 
    }
    .stat-number {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1a1d29;
        margin: 0;
    }
    .stat-label {
        color: #6b7280;
        font-size: 0.875rem;
        margin: 0;
        font-weight: 600;
    }
    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        background: linear-gradient(135deg, #f8fafc 0%, #e5e7eb 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: #6b7280;
    }
    .detail-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        border: 1px solid #e5e7eb;
        overflow: hidden;
    }
    .detail-card-header {
        padding: 12px 16px;
        background-color: #f8fafc;
        border-bottom: 1px solid #e5e7eb;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-weight: 600;
        color: #475569;
        font-size: 0.875rem;
        transition: all 0.2s ease;
    }
    .detail-card-header:hover {
        background-color: #f1f5f9;
    }
    .detail-card-body {
        padding: 16px;
        max-height: 250px;
        overflow-y: auto;
        transition: all 0.3s ease;
    }
    .detail-card-header i.fa-chevron-down,
    .detail-card-header i.fa-chevron-up {
        transition: transform 0.3s ease;
    }
    .detail-item {
        padding: 10px;
        margin-bottom: 8px;
        background-color: #f8fafc;
        border-radius: 8px;
        transition: all 0.2s ease;
    }
    .detail-item:hover {
        background-color: #f1f5f9;
    }
    .detail-item:last-child {
        margin-bottom: 0;
    }
    .badge-rank-small {
        display: inline-block;
        width: 24px;
        height: 24px;
        line-height: 24px;
        text-align: center;
        background-color: #3b82f6;
        color: white;
        border-radius: 50%;
        font-weight: 700;
        font-size: 0.75rem;
        margin-right: 8px;
    }
</style>

<div class="container-fluid">
    <!-- Add Button -->
    <div class="mb-3">
        <a href="{{ route('barang.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Tambah Barang
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="row stats-row mb-4">
        <!-- Barang Terlaris -->
        <div class="col-md-6">
            <div class="stat-card terlaris">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="stat-label mb-2"><i class="fas fa-fire"></i> Barang Terlaris</p>
                        @if($barangTerlaris->count() > 0 && $barangTerlaris->first()->total_terjual > 0)
                            <p class="stat-number mb-1">{{ $barangTerlaris->first()->nama_barang }}</p>
                            <small class="text-muted">{{ $barangTerlaris->first()->total_terjual }} terjual • Stok: {{ $barangTerlaris->first()->stok }}</small>
                        @else
                            <p class="stat-number mb-1">-</p>
                            <small class="text-muted">Belum ada penjualan</small>
                        @endif
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stok Menipis -->
        <div class="col-md-6">
            <div class="stat-card stok-menipis">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="stat-label mb-2"><i class="fas fa-exclamation-triangle"></i> Stok Menipis</p>
                        @if($barangStokMenipis->count() > 0)
                            <p class="stat-number mb-1">{{ $barangStokMenipis->count() }} Barang</p>
                            <small class="text-muted">Perlu segera di-restock</small>
                        @else
                            <p class="stat-number mb-1">0 Barang</p>
                            <small class="text-muted">Semua stok aman</small>
                        @endif
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-box-open"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Cards (Collapsible) -->
    @if(($barangTerlaris->count() > 0 && $barangTerlaris->first()->total_terjual > 0) || $barangStokMenipis->count() > 0)
    <div class="row mb-4">
        @if($barangTerlaris->count() > 0 && $barangTerlaris->first()->total_terjual > 0)
        <div class="col-md-6">
            <div class="detail-card">
                <div class="detail-card-header" onclick="toggleDetail('detailTerlaris')">
                    <span><i class="fas fa-chart-line"></i> Top 5 Barang Terlaris</span>
                    <i class="fas fa-chevron-down" id="icon-detailTerlaris"></i>
                </div>
                <div class="detail-card-body" id="detailTerlaris" style="display: none;">
                    @foreach($barangTerlaris as $index => $item)
                    <div class="detail-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="badge-rank-small">{{ $index + 1 }}</span>
                                <strong>{{ $item->nama_barang }}</strong>
                            </div>
                            <div class="text-end">
                                <span class="badge" style="background-color: #d1fae5; color: #065f46;">
                                    {{ $item->total_terjual }} terjual
                                </span>
                                <small class="text-muted d-block">Stok: {{ $item->stok }}</small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        @if($barangStokMenipis->count() > 0)
        <div class="col-md-6">
            <div class="detail-card">
                <div class="detail-card-header" onclick="toggleDetail('detailStok')">
                    <span><i class="fas fa-exclamation-circle"></i> Detail Stok Menipis</span>
                    <i class="fas fa-chevron-down" id="icon-detailStok"></i>
                </div>
                <div class="detail-card-body" id="detailStok" style="display: none;">
                    @foreach($barangStokMenipis as $item)
                    <div class="detail-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $item->nama_barang }}</strong>
                                <small class="text-muted d-block">{{ $item->jenis->nama_jenis }}</small>
                            </div>
                            <div>
                                <span class="badge" style="background-color: {{ $item->stok <= 5 ? '#fee2e2' : '#fef3c7' }}; color: {{ $item->stok <= 5 ? '#991b1b' : '#92400e' }};">
                                    Stok: {{ $item->stok }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>
    @endif

    <div class="card-table">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Jenis</th>
                    <th>Nama Barang</th>
                    <th>Satuan</th>
                    <th class="text-end">Harga Pokok</th>
                    <th class="text-end">Harga Jual</th>
                    <th class="text-center">Stok</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barang as $b)
                <tr>
                    <td>{{ $b->id }}</td>
                    <td><span class="badge" style="background-color: #e0e7ff; color: #4338ca;">{{ $b->jenis->nama_jenis }}</span></td>
                    <td>{{ $b->nama_barang }}</td>
                    <td>{{ $b->satuan }}</td>
                    <td class="text-end">Rp {{ number_format($b->harga_pokok, 0, ',', '.') }}</td>
                    <td class="text-end"><strong>Rp {{ number_format($b->harga_jual, 0, ',', '.') }}</strong></td>
                    <td class="text-center"><span class="badge badge-stock">{{ $b->stok }}</span></td>
                    <td>
                        <div class="btn-action-group">
                            <a href="{{ route('barang.show', $b->id) }}"
                               class="btn btn-sm btn-info text-white"
                               title="Lihat Detail">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('barang.edit', $b->id) }}"
                               class="btn btn-sm btn-warning"
                               title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('barang.destroy', $b->id) }}"
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Yakin hapus data ini?')"
                                        title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <style>
            .pagination {
                display: flex;
                gap: 8px;
                justify-content: center;
                align-items: center;
            }
            .pagination .page-item {
                list-style: none;
            }
            .pagination .page-link {
                padding: 10px 16px;
                border-radius: 8px;
                border: 1px solid #e5e7eb;
                color: #475569;
                font-weight: 500;
                transition: all 0.2s ease;
                display: flex;
                align-items: center;
                gap: 4px;
                background-color: #ffffff;
            }
            .pagination .page-link:hover {
                background-color: #f8fafc;
                border-color: #3b82f6;
                color: #3b82f6;
                transform: translateY(-1px);
                box-shadow: 0 2px 6px rgba(59, 130, 246, 0.2);
            }
            .pagination .page-item.active .page-link {
                background-color: #3b82f6;
                border-color: #3b82f6;
                color: white;
                font-weight: 600;
                box-shadow: 0 2px 6px rgba(59, 130, 246, 0.3);
            }
            .pagination .page-item.disabled .page-link {
                background-color: #f1f5f9;
                border-color: #e5e7eb;
                color: #cbd5e1;
                cursor: not-allowed;
            }
            .pagination .page-item.disabled .page-link:hover {
                transform: none;
                box-shadow: none;
            }
        </style>
        {{ $barang->links('vendor.pagination.custom') }}
    </div>
</div>
@stop

@section('css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin-pro.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@stop

@section('js')
    <script src="{{ asset('js/admin-pro.js') }}" defer></script>
    <script>
        // Toggle detail cards
        function toggleDetail(id) {
            const element = document.getElementById(id);
            const icon = document.getElementById('icon-' + id);
            
            if (element.style.display === 'none') {
                element.style.display = 'block';
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
            } else {
                element.style.display = 'none';
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
            }
        }
    </script>
@stop
