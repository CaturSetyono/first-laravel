@extends('adminlte::page')

@section('title', 'Daftar Transaksi Penjualan')

@section('content_header')
    <h1><i class="bi bi-receipt"></i> Daftar Transaksi Penjualan</h1>
@stop

@section('content')
<style>
    .card-custom {
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        border: 1px solid #e5e7eb;
        padding: 24px;
    }
    .btn-add {
        background-color: #10b981;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
    }
    .btn-add:hover {
        background-color: #059669;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    thead {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    th {
        padding: 14px 12px;
        text-align: left;
        font-weight: 600;
        font-size: 14px;
    }
    td {
        padding: 12px;
        border-bottom: 1px solid #e5e7eb;
    }
    tbody tr {
        transition: background-color 0.2s ease;
    }
    tbody tr:hover {
        background-color: #f8fafc;
    }
    .badge-status {
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
    }
    .badge-pending { background-color: #fef3c7; color: #92400e; }
    .badge-proses { background-color: #dbeafe; color: #1e40af; }
    .badge-selesai { background-color: #d1fae5; color: #065f46; }
    .badge-batal { background-color: #fee2e2; color: #991b1b; }
    .btn-action {
        padding: 6px 12px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: all 0.2s ease;
    }
    .btn-view {
        background-color: #3b82f6;
        color: white;
    }
    .btn-view:hover {
        background-color: #2563eb;
        color: white;
        transform: translateY(-1px);
    }
    .btn-print {
        background-color: #8b5cf6;
        color: white;
    }
    .btn-print:hover {
        background-color: #7c3aed;
        color: white;
        transform: translateY(-1px);
    }
    .btn-delete {
        background-color: #ef4444;
        color: white;
        border: none;
        cursor: pointer;
    }
    .btn-delete:hover {
        background-color: #dc2626;
        color: white;
        transform: translateY(-1px);
    }
    .btn-group {
        display: flex;
        gap: 4px;
        justify-content: center;
    }
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #6b7280;
    }
    .empty-state i {
        font-size: 64px;
        margin-bottom: 16px;
        opacity: 0.5;
    }
</style>

<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    <div class="card-custom">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h5 class="mb-0"><i class="bi bi-list-ul"></i> Semua Transaksi</h5>
                <small class="text-muted">Total: {{ count($jual) }} transaksi</small>
            </div>
            <a href="{{ route('jual.create') }}" class="btn-add">
                <i class="bi bi-plus-circle"></i>
                Transaksi Baru
            </a>
        </div>

        @if(count($jual) > 0)
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="15%">No Transaksi</th>
                        <th width="12%">Tanggal</th>
                        <th width="20%">Pelanggan</th>
                        <th width="15%">Kasir</th>
                        <th width="13%" style="text-align: right">Total</th>
                        <th width="10%">Status</th>
                        <th width="10%" style="text-align: center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jual as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><strong>{{ $item->no_transaksi }}</strong></td>
                        <td>{{ date('d/m/Y', strtotime($item->tanggal)) }}</td>
                        <td>
                            @if($item->nama_pelanggan)
                                <i class="bi bi-person-fill"></i> {{ $item->nama_pelanggan }}
                            @else
                                <span class="text-muted">{{ $item->nama_pembeli ?? '-' }}</span>
                            @endif
                        </td>
                        <td>
                            <i class="bi bi-person-badge"></i> {{ $item->kasir ?? '-' }}
                        </td>
                        <td style="text-align: right">
                            <strong>Rp {{ number_format($item->jumlah_pembelian ?? $item->total ?? 0, 0, ',', '.') }}</strong>
                        </td>
                        <td>
                            @php
                                $status = $item->status ?? 'pending';
                                $badgeClass = 'badge-' . $status;
                            @endphp
                            <span class="badge-status {{ $badgeClass }}">
                                {{ ucfirst($status) }}
                            </span>
                        </td>
                        <td style="text-align: center">
                            <div class="btn-group" role="group">
                                <a href="{{ url('/detailJual/' . $item->id) }}" class="btn-action btn-view" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="{{ url('/jual/cetak/' . $item->id) }}" class="btn-action btn-print" target="_blank" title="Cetak">
                                    <i class="bi bi-printer"></i>
                                </a>
                                <form action="{{ route('jual.destroy', $item->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" title="Hapus">
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
        @else
        <div class="empty-state">
            <i class="bi bi-inbox"></i>
            <h5>Belum Ada Transaksi</h5>
            <p>Klik tombol "Transaksi Baru" untuk membuat transaksi pertama</p>
        </div>
        @endif
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
@stop
