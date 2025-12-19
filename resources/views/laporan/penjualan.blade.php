@extends('adminlte::page')

@section('title', 'Laporan Penjualan')

@section('content_header')
    <h1><i class="fas fa-file-invoice-dollar"></i> Laporan Penjualan</h1>
@stop

@section('content')
<style>
    .filter-card {
        background: #fff;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    .summary-row {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }
    .summary-box {
        flex: 1;
        min-width: 200px;
        background: #fff;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        border-left: 4px solid #6c757d;
    }
    .summary-box.primary { border-left-color: #007bff; }
    .summary-box.success { border-left-color: #28a745; }
    .summary-box.info { border-left-color: #17a2b8; }
    .summary-box .label {
        font-size: 12px;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 5px;
    }
    .summary-box .value {
        font-size: 24px;
        font-weight: 700;
        color: #333;
    }
    .report-card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    .report-card .card-header {
        background: #f8f9fa;
        padding: 15px 20px;
        border-bottom: 1px solid #e9ecef;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .report-card .card-header h5 {
        margin: 0;
        font-weight: 600;
        color: #333;
    }
    .report-card .card-body {
        padding: 20px;
    }
    .report-card .card-footer {
        background: #f8f9fa;
        padding: 15px 20px;
        border-top: 1px solid #e9ecef;
    }
    
    /* Report Table Styles */
    .report-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 12px;
    }
    .report-table th, .report-table td {
        border: 1px solid #dee2e6;
        padding: 8px 10px;
        vertical-align: middle;
    }
    .report-table thead th {
        background: #343a40;
        color: #fff;
        font-weight: 600;
        text-align: center;
        font-size: 11px;
        text-transform: uppercase;
    }
    .report-table tbody td {
        background: #fff;
    }
    .report-table tbody tr:nth-child(even) td {
        background: #f8f9fa;
    }
    .report-table tbody tr:hover td {
        background: #e9ecef;
    }
    .report-table .text-right { text-align: right; }
    .report-table .text-center { text-align: center; }
    .report-table .text-left { text-align: left; }
    .report-table tfoot td {
        background: #e9ecef !important;
        font-weight: 700;
    }
    
    /* Detail Items */
    .detail-row td {
        padding: 0 !important;
        border-top: none !important;
    }
    .detail-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 11px;
        margin: 0;
    }
    .detail-table th {
        background: #6c757d;
        color: #fff;
        padding: 5px 8px;
        font-weight: 500;
        text-align: center;
    }
    .detail-table td {
        padding: 5px 8px;
        border-bottom: 1px dashed #dee2e6;
    }
    .detail-table tr:last-child td {
        border-bottom: none;
    }
    
    .empty-state {
        padding: 60px 20px;
        text-align: center;
        color: #6c757d;
    }
    .empty-state i {
        font-size: 48px;
        margin-bottom: 15px;
        opacity: 0.5;
    }
    .btn-group-action .btn {
        padding: 6px 12px;
        font-size: 13px;
    }
    .period-info {
        background: #e9ecef;
        padding: 8px 15px;
        border-radius: 4px;
        font-size: 13px;
        color: #495057;
        display: inline-block;
        margin-bottom: 15px;
    }
    
    /* Toggle Detail */
    .btn-toggle-detail {
        background: none;
        border: none;
        color: #007bff;
        cursor: pointer;
        font-size: 14px;
        padding: 0;
    }
    .btn-toggle-detail:hover {
        color: #0056b3;
    }
    .detail-row {
        display: none;
    }
    .detail-row.show {
        display: table-row;
    }
    
    /* Pagination Styles */
    .pagination-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }
    .pagination-info {
        font-size: 13px;
        color: #6c757d;
    }
    .pagination {
        margin: 0;
        display: flex;
        gap: 5px;
    }
    .pagination .page-item .page-link {
        border-radius: 6px;
        border: 1px solid #dee2e6;
        color: #495057;
        padding: 8px 12px;
        font-size: 13px;
    }
    .pagination .page-item.active .page-link {
        background: #007bff;
        border-color: #007bff;
        color: #fff;
    }
    .pagination .page-item.disabled .page-link {
        color: #adb5bd;
    }
    .pagination .page-item .page-link:hover {
        background: #e9ecef;
    }
    
    /* Status Badge */
    .badge-status {
        padding: 3px 8px;
        border-radius: 3px;
        font-size: 10px;
        font-weight: 600;
    }
    .badge-pending { background: #fff3cd; color: #856404; }
    .badge-proses { background: #cce5ff; color: #004085; }
    .badge-selesai { background: #d4edda; color: #155724; }
    .badge-batal { background: #f8d7da; color: #721c24; }
    
    @media print {
        .no-print { display: none !important; }
        .content-wrapper { margin: 0 !important; padding: 0 !important; }
        .main-sidebar, .main-header, .main-footer { display: none !important; }
        .report-card { box-shadow: none; border: none; }
        .summary-box { box-shadow: none; border: 1px solid #ddd; }
        .card-footer { display: none !important; }
        .report-table thead th { background: #333 !important; -webkit-print-color-adjust: exact; }
        .detail-table th { background: #666 !important; -webkit-print-color-adjust: exact; }
        .detail-row.show { display: table-row !important; }
    }
</style>

<div class="container-fluid">
    <!-- Filter -->
    <div class="filter-card no-print">
        <form method="GET" action="{{ route('laporan.penjualan') }}">
            <div class="row align-items-end">
                <div class="col-md-3 mb-2">
                    <label class="small text-muted mb-1">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="form-control" value="{{ request('tanggal_mulai') }}">
                </div>
                <div class="col-md-3 mb-2">
                    <label class="small text-muted mb-1">Tanggal Akhir</label>
                    <input type="date" name="tanggal_akhir" class="form-control" value="{{ request('tanggal_akhir') }}">
                </div>
                <div class="col-md-3 mb-2">
                    <label class="small text-muted mb-1">Barang</label>
                    <select name="barang_id" class="form-control">
                        <option value="">Semua Barang</option>
                        @foreach($barang as $b)
                            <option value="{{ $b->id }}" {{ request('barang_id') == $b->id ? 'selected' : '' }}>{{ $b->nama_barang }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <div class="btn-group-action">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Tampilkan</button>
                        <a href="{{ route('laporan.penjualan') }}" class="btn btn-outline-secondary"><i class="fas fa-redo"></i></a>
                        <button type="button" onclick="window.print()" class="btn btn-outline-dark"><i class="fas fa-print"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Period Info -->
    @if(request('tanggal_mulai') || request('tanggal_akhir'))
    <div class="period-info no-print">
        <i class="fas fa-calendar-alt"></i>
        @if(request('tanggal_mulai') && request('tanggal_akhir'))
            Periode: {{ date('d M Y', strtotime(request('tanggal_mulai'))) }} - {{ date('d M Y', strtotime(request('tanggal_akhir'))) }}
        @elseif(request('tanggal_mulai'))
            Dari: {{ date('d M Y', strtotime(request('tanggal_mulai'))) }}
        @else
            Sampai: {{ date('d M Y', strtotime(request('tanggal_akhir'))) }}
        @endif
    </div>
    @endif

    <!-- Summary -->
    <div class="summary-row no-print">
        <div class="summary-box primary">
            <div class="label"><i class="fas fa-receipt"></i> Total Transaksi</div>
            <div class="value">{{ number_format($totalTransaksi) }}</div>
        </div>
        <div class="summary-box success">
            <div class="label"><i class="fas fa-money-bill-wave"></i> Total Penjualan</div>
            <div class="value">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</div>
        </div>
        <div class="summary-box info">
            <div class="label"><i class="fas fa-calculator"></i> Rata-rata/Transaksi</div>
            <div class="value">Rp {{ $totalTransaksi > 0 ? number_format($totalPenjualan / $totalTransaksi, 0, ',', '.') : 0 }}</div>
        </div>
    </div>

    <!-- Report Table -->
    <div class="report-card">
        <div class="card-header no-print">
            <h5><i class="fas fa-table"></i> Laporan Penjualan</h5>
            <small class="text-muted">{{ $penjualan->total() }} transaksi</small>
        </div>
        <div class="card-body">
            @if($penjualan->count() > 0)
            
            <!-- Print Header -->
            <div class="d-none d-print-block text-center mb-4">
                <h4 style="margin-bottom: 5px; font-weight: bold;">TOKO SERBA ADA</h4>
                <p style="margin-bottom: 3px; font-size: 12px;">Jl. Contoh Alamat No. 123, Kota</p>
                <h5 style="margin: 15px 0 5px 0; font-weight: bold; text-decoration: underline;">LAPORAN PENJUALAN</h5>
                <p style="font-size: 12px;">
                    @if(request('tanggal_mulai') && request('tanggal_akhir'))
                        Periode: {{ date('d/m/Y', strtotime(request('tanggal_mulai'))) }} s/d {{ date('d/m/Y', strtotime(request('tanggal_akhir'))) }}
                    @else
                        Tanggal Cetak: {{ date('d/m/Y H:i') }}
                    @endif
                </p>
            </div>
            
            <div class="table-responsive">
                <table class="report-table">
                    <thead>
                        <tr>
                            <th style="width: 40px">No</th>
                            <th style="width: 120px">No. Faktur</th>
                            <th style="width: 90px">Tanggal</th>
                            <th>Pelanggan</th>
                            <th style="width: 100px">Kasir</th>
                            <th style="width: 70px">Status</th>
                            <th style="width: 50px" class="no-print">Detail</th>
                            <th style="width: 130px" class="text-right">Total (Rp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penjualan as $index => $item)
                        <tr>
                            <td class="text-center">{{ $penjualan->firstItem() + $index }}</td>
                            <td><strong>{{ $item->no_transaksi ?? 'INV-'.str_pad($item->id, 5, '0', STR_PAD_LEFT) }}</strong></td>
                            <td class="text-center">{{ date('d/m/Y', strtotime($item->tanggal)) }}</td>
                            <td>{{ $item->nama_pelanggan ?? $item->nama_pembeli ?? 'Umum' }}</td>
                            <td>{{ $item->kasir ?? '-' }}</td>
                            <td class="text-center">
                                <span class="badge-status badge-{{ $item->status ?? 'selesai' }}">
                                    {{ ucfirst($item->status ?? 'Selesai') }}
                                </span>
                            </td>
                            <td class="text-center no-print">
                                @if(isset($item->detail) && count($item->detail) > 0)
                                <button class="btn-toggle-detail" onclick="toggleDetail({{ $item->id }})">
                                    <i class="fas fa-chevron-down" id="icon-{{ $item->id }}"></i>
                                </button>
                                @else
                                -
                                @endif
                            </td>
                            <td class="text-right"><strong>{{ number_format($item->jumlah_pembelian ?? $item->total ?? 0, 0, ',', '.') }}</strong></td>
                        </tr>
                        @if(isset($item->detail) && count($item->detail) > 0)
                        <tr class="detail-row" id="detail-{{ $item->id }}">
                            <td colspan="8" style="padding: 0; background: #f8f9fa;">
                                <table class="detail-table">
                                    <thead>
                                        <tr>
                                            <th style="width: 40px">No</th>
                                            <th class="text-left">Nama Barang</th>
                                            <th style="width: 80px">Harga</th>
                                            <th style="width: 60px">Qty</th>
                                            <th style="width: 100px">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($item->detail as $di => $detail)
                                        <tr>
                                            <td class="text-center">{{ $di + 1 }}</td>
                                            <td>{{ $detail->nama_barang ?? '-' }}</td>
                                            <td class="text-right">{{ number_format($detail->harga_sekarang ?? $detail->harga ?? 0, 0, ',', '.') }}</td>
                                            <td class="text-center">{{ $detail->qty ?? $detail->jumlah ?? 0 }}</td>
                                            <td class="text-right">{{ number_format(($detail->harga_sekarang ?? $detail->harga ?? 0) * ($detail->qty ?? $detail->jumlah ?? 0), 0, ',', '.') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7" class="text-right" style="font-size: 13px;"><strong>GRAND TOTAL</strong></td>
                            <td class="text-right" style="font-size: 13px;"><strong>Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
            <!-- Print Footer -->
            <div class="d-none d-print-block mt-4">
                <div class="row">
                    <div class="col-6">
                        <p style="font-size: 11px; margin: 0;">Total Transaksi: {{ number_format($totalTransaksi) }}</p>
                        <p style="font-size: 11px; margin: 0;">Dicetak pada: {{ date('d/m/Y H:i:s') }}</p>
                    </div>
                    <div class="col-6 text-right">
                        <p style="font-size: 12px; margin-bottom: 60px;">..................., {{ date('d F Y') }}</p>
                        <p style="font-size: 12px; margin: 0;">(_________________________)</p>
                        <p style="font-size: 11px; margin: 0;">Petugas</p>
                    </div>
                </div>
            </div>
            
            <!-- Pagination -->
            @if($penjualan->hasPages())
            <div class="card-footer no-print">
                <div class="pagination-wrapper">
                    <div class="pagination-info">
                        Menampilkan {{ $penjualan->firstItem() }} - {{ $penjualan->lastItem() }} dari {{ $penjualan->total() }} data
                    </div>
                    {{ $penjualan->links('pagination::bootstrap-4') }}
                </div>
            </div>
            @endif
            
            @else
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <h5>Tidak Ada Data</h5>
                <p class="text-muted">Tidak ditemukan transaksi sesuai filter yang dipilih</p>
            </div>
            @endif
        </div>
    </div>
</div>

<script>
function toggleDetail(id) {
    const detailRow = document.getElementById('detail-' + id);
    const icon = document.getElementById('icon-' + id);
    
    if (detailRow.classList.contains('show')) {
        detailRow.classList.remove('show');
        icon.classList.remove('fa-chevron-up');
        icon.classList.add('fa-chevron-down');
    } else {
        detailRow.classList.add('show');
        icon.classList.remove('fa-chevron-down');
        icon.classList.add('fa-chevron-up');
    }
}

// Expand all details when printing
window.onbeforeprint = function() {
    document.querySelectorAll('.detail-row').forEach(function(row) {
        row.classList.add('show');
    });
};
</script>
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
