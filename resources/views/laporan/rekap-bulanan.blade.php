@extends('adminlte::page')

@section('title', 'Rekap Penjualan Bulanan')

@section('content_header')
<h1><i class="fas fa-chart-bar"></i> Rekap Penjualan Bulanan</h1>
@stop

@section('content')
<style>
    .filter-card {
        background: #fff;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .summary-row {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .summary-box {
        flex: 1;
        min-width: 180px;
        background: #fff;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        border-left: 4px solid #6c757d;
    }

    .summary-box.primary {
        border-left-color: #007bff;
    }

    .summary-box.success {
        border-left-color: #28a745;
    }

    .summary-box.warning {
        border-left-color: #ffc107;
    }

    .summary-box.info {
        border-left-color: #17a2b8;
    }

    .summary-box .label {
        font-size: 12px;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 5px;
    }

    .summary-box .value {
        font-size: 22px;
        font-weight: 700;
        color: #333;
    }

    .summary-box .sub-value {
        font-size: 12px;
        color: #6c757d;
        margin-top: 5px;
    }

    .data-card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-bottom: 20px;
    }

    .data-card .card-header {
        background: #f8f9fa;
        padding: 15px 20px;
        border-bottom: 1px solid #e9ecef;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .data-card .card-header h5 {
        margin: 0;
        font-weight: 600;
        color: #333;
    }

    .data-card .card-body {
        padding: 0;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table th {
        background: #f8f9fa;
        padding: 12px 15px;
        text-align: left;
        font-size: 12px;
        font-weight: 600;
        color: #495057;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #dee2e6;
    }

    .data-table td {
        padding: 12px 15px;
        border-bottom: 1px solid #f1f3f4;
        font-size: 14px;
        color: #333;
    }

    .data-table tbody tr:hover {
        background: #f8f9fa;
    }

    .data-table .text-right {
        text-align: right;
    }

    .data-table .text-center {
        text-align: center;
    }

    .data-table tfoot td {
        background: #f8f9fa;
        font-weight: 600;
        border-top: 2px solid #dee2e6;
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

    .month-badge {
        background: #e9ecef;
        padding: 4px 10px;
        border-radius: 4px;
        font-weight: 600;
        font-size: 13px;
    }

    .progress-mini {
        height: 6px;
        border-radius: 3px;
        background: #e9ecef;
        margin-top: 8px;
        overflow: hidden;
    }

    .progress-mini .bar {
        height: 100%;
        border-radius: 3px;
        background: #28a745;
    }

    .chart-wrapper {
        padding: 20px;
    }

    .chart-bar {
        display: flex;
        align-items: flex-end;
        gap: 8px;
        height: 150px;
        padding: 10px 0;
        border-bottom: 2px solid #e9ecef;
    }

    .chart-bar-item {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        height: 100%;
        justify-content: flex-end;
    }

    .chart-bar-item .bar {
        width: 100%;
        max-width: 50px;
        background: linear-gradient(180deg, #007bff 0%, #0056b3 100%);
        border-radius: 4px 4px 0 0;
        transition: height 0.3s ease;
        min-height: 4px;
    }

    .chart-bar-item .month-label {
        font-size: 11px;
        color: #6c757d;
        margin-top: 8px;
        font-weight: 500;
    }

    .chart-bar-item .value-label {
        font-size: 10px;
        color: #333;
        margin-bottom: 5px;
        font-weight: 600;
    }

    .kontribusi-badge {
        padding: 3px 8px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 600;
    }

    .kontribusi-high {
        background: #d4edda;
        color: #155724;
    }

    .kontribusi-medium {
        background: #cce5ff;
        color: #004085;
    }

    .kontribusi-low {
        background: #e9ecef;
        color: #495057;
    }

    @media print {
        .no-print {
            display: none !important;
        }

        .content-wrapper {
            margin: 0 !important;
            padding: 0 !important;
        }

        .main-sidebar,
        .main-header,
        .main-footer {
            display: none !important;
        }

        .data-card {
            box-shadow: none;
            border: 1px solid #ddd;
        }

        .summary-box {
            box-shadow: none;
            border: 1px solid #ddd;
        }
    }
</style>

<div class="container-fluid">
    <!-- Filter -->
    <div class="filter-card no-print">
        <form method="GET" action="{{ route('laporan.rekap-bulanan') }}">
            <div class="row align-items-end">
                <div class="col-md-3 mb-2">
                    <label class="small text-muted mb-1">Tahun</label>
                    <select name="tahun" class="form-control">
                        @foreach($tahunList as $t)
                        <option value="{{ $t }}" {{ $tahun == $t ? 'selected' : '' }}>{{ $t }}</option>
                        @endforeach
                        @if(!$tahunList->contains($tahun))
                        <option value="{{ $tahun }}" selected>{{ $tahun }}</option>
                        @endif
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <label class="small text-muted mb-1">Barang</label>
                    <select name="barang_id" class="form-control">
                        <option value="">Semua Barang</option>
                        @foreach($barang as $b)
                        <option value="{{ $b->id }}" {{ $barangId == $b->id ? 'selected' : '' }}>{{ $b->nama_barang }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <div class="form-check mt-2">
                        <input type="checkbox" name="detail" value="1" class="form-check-input" id="showDetail" {{ request('detail') ? 'checked' : '' }}>
                        <label class="form-check-label" for="showDetail">Tampilkan Detail Barang</label>
                    </div>
                </div>
                <div class="col-md-3 mb-2">
                    <div class="btn-group-action">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Tampilkan</button>
                        <a href="{{ route('laporan.rekap-bulanan') }}" class="btn btn-outline-secondary"><i class="fas fa-redo"></i></a>
                        <button type="button" onclick="window.print()" class="btn btn-outline-dark"><i class="fas fa-print"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Summary -->
    @php
    $avgPerBulan = count($rekapBulanan) > 0 ? $totalTahunan / count($rekapBulanan) : 0;
    $maxMonth = collect($rekapBulanan)->sortByDesc('total_penjualan')->first();
    $namaBulan = [
    1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
    5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
    9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];
    @endphp
    <div class="summary-row">
        <div class="summary-box primary">
            <div class="label"><i class="fas fa-calendar"></i> Tahun</div>
            <div class="value">{{ $tahun }}</div>
            <div class="sub-value">{{ count($rekapBulanan) }} bulan aktif</div>
        </div>
        <div class="summary-box success">
            <div class="label"><i class="fas fa-money-bill-wave"></i> Total Penjualan</div>
            <div class="value">Rp {{ number_format($totalTahunan, 0, ',', '.') }}</div>
            <div class="sub-value">{{ number_format($totalTransaksi) }} transaksi</div>
        </div>
        <div class="summary-box warning">
            <div class="label"><i class="fas fa-chart-line"></i> Rata-rata/Bulan</div>
            <div class="value">Rp {{ number_format($avgPerBulan, 0, ',', '.') }}</div>
        </div>
        <div class="summary-box info">
            <div class="label"><i class="fas fa-trophy"></i> Bulan Tertinggi</div>
            <div class="value">{{ $maxMonth ? ($maxMonth->nama_bulan ?? $namaBulan[$maxMonth->bulan] ?? '-') : '-' }}</div>
            @if($maxMonth)
            <div class="sub-value">Rp {{ number_format($maxMonth->total_penjualan, 0, ',', '.') }}</div>
            @endif
        </div>
    </div>

    <!-- Chart -->
    @if(count($rekapBulanan) > 0)
    <div class="data-card">
        <div class="card-header">
            <h5><i class="fas fa-chart-bar"></i> Grafik Penjualan Bulanan {{ $tahun }}</h5>
        </div>
        <div class="chart-wrapper">
            @php $maxValue = collect($rekapBulanan)->max('total_penjualan'); @endphp
            <div class="chart-bar">
                @foreach($rekapBulanan as $r)
                @php $height = $maxValue > 0 ? ($r->total_penjualan / $maxValue) * 100 : 0; @endphp
                <div class="chart-bar-item">
                    <div class="value-label">{{ number_format($r->total_penjualan / 1000000, 1) }}jt</div>
                    <div class="bar" style="height: {{ $height }}%"></div>
                    <div class="month-label">{{ substr($r->nama_bulan ?? $namaBulan[$r->bulan] ?? '-', 0, 3) }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Data Table -->
    <div class="data-card">
        <div class="card-header">
            <h5><i class="fas fa-table"></i> Rekap Per Bulan</h5>
            <small class="text-muted">Tahun {{ $tahun }}</small>
        </div>
        <div class="card-body">
            @if(count($rekapBulanan) > 0)
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="width: 50px">No</th>
                            <th>Bulan</th>
                            <th class="text-center">Jumlah Transaksi</th>
                            <th class="text-right">Total Penjualan</th>
                            <th class="text-right">Rata-rata/Transaksi</th>
                            <th style="width: 150px">Progress</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rekapBulanan as $index => $r)
                        @php
                        $progress = $maxValue > 0 ? ($r->total_penjualan / $maxValue) * 100 : 0;
                        $rataRata = $r->jumlah_transaksi > 0 ? $r->total_penjualan / $r->jumlah_transaksi : 0;
                        @endphp
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td><span class="month-badge">{{ $r->nama_bulan ?? $namaBulan[$r->bulan] ?? '-' }}</span></td>
                            <td class="text-center"><strong>{{ number_format($r->jumlah_transaksi) }}</strong></td>
                            <td class="text-right"><strong>Rp {{ number_format($r->total_penjualan, 0, ',', '.') }}</strong></td>
                            <td class="text-right">Rp {{ number_format($rataRata, 0, ',', '.') }}</td>
                            <td>
                                <div class="progress-mini">
                                    <div class="bar" style="width: {{ $progress }}%"></div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" class="text-right">TOTAL {{ $tahun }}</td>
                            <td class="text-center"><strong>{{ number_format($totalTransaksi) }}</strong></td>
                            <td class="text-right"><strong>Rp {{ number_format($totalTahunan, 0, ',', '.') }}</strong></td>
                            <td class="text-right">Rp {{ $totalTransaksi > 0 ? number_format($totalTahunan / $totalTransaksi, 0, ',', '.') : 0 }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            @else
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <h5>Tidak Ada Data</h5>
                <p class="text-muted">Tidak ditemukan transaksi pada tahun {{ $tahun }}</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Detail Barang -->
    @if(request('detail') && $detailBarang->count() > 0)
    <div class="data-card">
        <div class="card-header">
            <h5><i class="fas fa-boxes"></i> Detail Penjualan Per Barang</h5>
            <small class="text-muted">Tahun {{ $tahun }}</small>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="width: 50px">No</th>
                            <th>Nama Barang</th>
                            <th class="text-center">Qty Terjual</th>
                            <th class="text-right">Total Penjualan</th>
                            <th class="text-right">Kontribusi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $totalDetailPenjualan = $detailBarang->sum('total_penjualan') ?: $detailBarang->sum('total_nilai'); @endphp
                        @foreach($detailBarang as $index => $d)
                        @php
                        $itemTotal = $d->total_penjualan ?? $d->total_nilai ?? 0;
                        $kontribusi = $totalDetailPenjualan > 0 ? ($itemTotal / $totalDetailPenjualan) * 100 : 0;
                        @endphp
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td><strong>{{ $d->nama_barang }}</strong></td>
                            <td class="text-center">{{ number_format($d->qty_terjual ?? $d->total_qty ?? 0) }}</td>
                            <td class="text-right"><strong>Rp {{ number_format($itemTotal, 0, ',', '.') }}</strong></td>
                            <td class="text-right">
                                <span class="kontribusi-badge {{ $kontribusi > 20 ? 'kontribusi-high' : ($kontribusi > 10 ? 'kontribusi-medium' : 'kontribusi-low') }}">
                                    {{ number_format($kontribusi, 1) }}%
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @elseif($barangId && $detailBarang->count() > 0)
    <div class="data-card">
        <div class="card-header">
            <h5><i class="fas fa-box"></i> Detail Penjualan Barang Per Bulan</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="width: 50px">No</th>
                            <th>Bulan</th>
                            <th>Nama Barang</th>
                            <th class="text-center">Qty</th>
                            <th class="text-right">Total Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($detailBarang as $index => $item)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td><span class="month-badge">{{ $item->nama_bulan ?? $namaBulan[$item->bulan] ?? '-' }}</span></td>
                            <td><strong>{{ $item->nama_barang }}</strong></td>
                            <td class="text-center">{{ number_format($item->total_qty ?? $item->qty_terjual ?? 0) }}</td>
                            <td class="text-right"><strong>Rp {{ number_format($item->total_nilai ?? $item->total_penjualan ?? 0, 0, ',', '.') }}</strong></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
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