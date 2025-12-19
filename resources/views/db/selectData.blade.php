@extends('adminlte::page')

@section('title', 'Data Barang')

@section('content_header')
    <h1><i class="fas fa-database"></i> Data Barang - Query Builder</h1>
@stop

@section('content')
<style>
    .stats-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 12px;
        padding: 20px;
        color: white;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        transition: transform 0.2s ease;
    }
    .stats-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(102, 126, 234, 0.4);
    }
    .stats-card.info {
        background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
    }
    .stats-card.success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }
    .stats-card.warning {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    }
    .stats-card h6 {
        font-size: 0.875rem;
        font-weight: 500;
        opacity: 0.9;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .stats-card .value {
        font-size: 1.75rem;
        font-weight: 700;
        margin: 0;
    }
    .card-table {
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        border: 1px solid #e5e7eb;
        margin-top: 24px;
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
    .table tfoot tr {
        background-color: #f1f5f9;
        font-weight: 700;
    }
    .table tfoot th {
        padding: 16px;
        color: #1e293b;
        border-top: 2px solid #e5e7eb;
    }
    .badge-stok {
        background-color: #dbeafe;
        color: #1e40af;
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.75rem;
    }
    .section-title {
        color: #1e293b;
        font-weight: 700;
        font-size: 1.125rem;
        margin-bottom: 16px;
        padding-bottom: 8px;
        border-bottom: 2px solid #e5e7eb;
    }
</style>

<div class="container-fluid">
    <!-- Statistik Cards -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="stats-card info">
                <h6>Jenis Barang</h6>
                <p class="value">{{ $jenisBarang->count() }} <small style="font-size: 1rem; font-weight: 500;">jenis</small></p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="stats-card success">
                <h6>Total Item</h6>
                <p class="value">{{ $groupedBarang->sum('jumlah') }} <small style="font-size: 1rem; font-weight: 500;">item</small></p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="stats-card warning">
                <h6>Nilai Stok (Jenis 1)</h6>
                <p class="value">Rp {{ number_format($jumHarga, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <!-- Tabel Daftar Barang -->
    <h5 class="section-title"><i class="bi bi-table"></i> Daftar Barang (Jenis Barang = 1)</h5>
    <div class="card-table">
        <table class="table">
            <thead>
                <tr>
                    <th width="8%">ID</th>
                    <th width="35%">Nama Barang</th>
                    <th width="12%" class="text-center">Stok</th>
                    <th width="12%">Satuan</th>
                    <th width="18%" class="text-end">Harga Jual</th>
                    <th width="15%" class="text-end">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($barang as $b)
                <tr>
                    <td>{{ $b->id }}</td>
                    <td><strong>{{ $b->nama_barang }}</strong></td>
                    <td class="text-center"><span class="badge-stok">{{ $b->stok }}</span></td>
                    <td>{{ $b->satuan }}</td>
                    <td class="text-end">Rp {{ number_format($b->harga_jual, 0, ',', '.') }}</td>
                    <td class="text-end"><strong>Rp {{ number_format($b->total, 0, ',', '.') }}</strong></td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="5" class="text-end">TOTAL NILAI</th>
                    <th class="text-end">Rp {{ number_format($barang->sum('total'), 0, ',', '.') }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@stop
