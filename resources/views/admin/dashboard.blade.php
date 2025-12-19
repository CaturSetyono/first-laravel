@extends('adminlte::page')

@section('title', 'Dashboard - Management System')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <div>
        <h1 class="m-0 text-dark font-weight-bold">Dashboard</h1>
        <small class="text-muted">Selamat datang kembali! Berikut ringkasan bisnis Anda.</small>
    </div>
    <span class="badge badge-light border px-3 py-2">
        <i class="far fa-calendar-alt mr-1"></i> {{ date('d F Y') }}
    </span>
</div>
@stop

@section('content')
<div class="container-fluid page-transition">
    <!-- Stats Cards Row -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <div class="stat-card primary">
                <div class="stat-icon"><i class="fas fa-box"></i></div>
                <p class="stat-label">Total Produk</p>
                <p class="stat-value">{{ number_format($totalBarang) }}</p>
                <div class="stat-change positive">
                    <i class="fas fa-check-circle"></i>
                    <span>Tersedia di inventory</span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <div class="stat-card success">
                <div class="stat-icon"><i class="fas fa-shopping-cart"></i></div>
                <p class="stat-label">Total Transaksi</p>
                <p class="stat-value">{{ number_format($totalTransaksi) }}</p>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i>
                    <span>Penjualan aktif</span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <div class="stat-card warning">
                <div class="stat-icon"><i class="fas fa-coins"></i></div>
                <p class="stat-label">Total Pendapatan</p>
                <p class="stat-value">Rp {{ number_format($totalPenjualan / 1000, 0, ',', '.') }}K</p>
                <div class="stat-change positive">
                    <i class="fas fa-chart-line"></i>
                    <span>Revenue keseluruhan</span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stat-card danger">
                <div class="stat-icon"><i class="fas fa-exclamation-triangle"></i></div>
                <p class="stat-label">Stok Menipis</p>
                <p class="stat-value">{{ number_format($stokMenipis) }}</p>
                <div class="stat-change negative">
                    <i class="fas fa-info-circle"></i>
                    <span>Perlu restock segera</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Row -->
    <div class="row">
        <!-- Quick Actions -->
        <div class="col-lg-4 mb-4">
            <div class="card-modern h-100">
                <div class="card-header-modern">
                    <h5 class="mb-0"><i class="fas fa-bolt text-primary mr-2"></i>Menu Cepat</h5>
                </div>
                <div class="card-body-modern">
                    <div class="quick-action-grid">
                        <a href="{{ route('jual.create') }}" class="quick-action-btn">
                            <i class="fas fa-plus-circle"></i>
                            <span>Transaksi Baru</span>
                        </a>
                        <a href="{{ route('barang.index') }}" class="quick-action-btn">
                            <i class="fas fa-boxes"></i>
                            <span>Kelola Produk</span>
                        </a>
                        <a href="{{ route('jual.index') }}" class="quick-action-btn">
                            <i class="fas fa-list-alt"></i>
                            <span>Daftar Transaksi</span>
                        </a>
                        <a href="{{ route('admin.settings.index') }}" class="quick-action-btn">
                            <i class="fas fa-cog"></i>
                            <span>Pengaturan</span>
                        </a>
                    </div>
                    <hr class="my-4">
                    <h6 class="text-muted mb-3" style="font-size:0.8rem;font-weight:600;letter-spacing:0.5px">AKTIVITAS TERAKHIR</h6>
                    @forelse($transaksiTerbaru->take(3) as $trx)
                    <div class="activity-item">
                        <div class="activity-icon sale"><i class="fas fa-receipt"></i></div>
                        <div class="activity-content">
                            <h6 class="mb-1" style="font-size:0.9rem">Transaksi {{ $trx->no_transaksi }}</h6>
                            <small class="text-muted">{{ date('d M Y, H:i', strtotime($trx->tanggal)) }}</small>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-3"><small class="text-muted">Belum ada aktivitas</small></div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Best Sellers -->
        <div class="col-lg-4 mb-4">
            <div class="card-modern h-100">
                <div class="card-header-modern d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-trophy text-warning mr-2"></i>Produk Terlaris</h5>
                    <a href="{{ route('barang.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                </div>
                <div class="card-body-modern">
                    @if($barangTerlaris->count() > 0 && $barangTerlaris->first()->total_terjual > 0)
                    @foreach($barangTerlaris as $index => $item)
                    @if($item->total_terjual > 0)
                    <div class="bestseller-item">
                        <div class="d-flex align-items-center">
                            <div class="bestseller-rank {{ $index == 0 ? 'gold' : ($index == 1 ? 'silver' : ($index == 2 ? 'bronze' : '')) }}">{{ $index + 1 }}</div>
                            <span style="font-weight:500;color:#1f2937">{{ $item->nama_barang }}</span>
                        </div>
                        <span class="bestseller-sold">{{ $item->total_terjual }} terjual</span>
                    </div>
                    @endif
                    @endforeach
                    @else
                    <div class="empty-state">
                        <i class="fas fa-chart-bar"></i>
                        <p>Belum ada data penjualan</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="col-lg-4 mb-4">
            <div class="card-modern h-100">
                <div class="card-header-modern d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-clock text-info mr-2"></i>Transaksi Terbaru</h5>
                    <a href="{{ route('jual.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                </div>
                <div class="card-body-modern p-0">
                    @if($transaksiTerbaru->count() > 0)
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th>ID Transaksi</th>
                                <th class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksiTerbaru as $trx)
                            <tr>
                                <td>
                                    <span style="font-weight:600;color:#4f46e5">{{ $trx->no_transaksi }}</span><br>
                                    <small class="text-muted">{{ date('d M Y', strtotime($trx->tanggal)) }}</small>
                                </td>
                                <td class="text-right"><span style="font-weight:600;color:#111827">Rp {{ number_format($trx->jumlah_pembelian ?? 0, 0, ',', '.') }}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="empty-state"><i class="fas fa-inbox"></i>
                        <p>Belum ada transaksi</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- System Summary -->
    <div class="row">
        <div class="col-12">
            <div class="card-modern">
                <div class="card-header-modern">
                    <h5 class="mb-0"><i class="fas fa-info-circle text-primary mr-2"></i>Ringkasan Sistem</h5>
                </div>
                <div class="card-body-modern">
                    <div class="row text-center">
                        <div class="col-md-3 col-6 mb-3 mb-md-0">
                            <i class="fas fa-database mb-2" style="font-size:2rem;color:#4f46e5"></i>
                            <h6 class="mb-1">Database</h6>
                            <span class="status-badge success">Online</span>
                        </div>
                        <div class="col-md-3 col-6 mb-3 mb-md-0">
                            <i class="fas fa-server mb-2" style="font-size:2rem;color:#10b981"></i>
                            <h6 class="mb-1">Server</h6>
                            <span class="status-badge success">Aktif</span>
                        </div>
                        <div class="col-md-3 col-6">
                            <i class="fas fa-shield-alt mb-2" style="font-size:2rem;color:#06b6d4"></i>
                            <h6 class="mb-1">Keamanan</h6>
                            <span class="status-badge success">Aman</span>
                        </div>
                        <div class="col-md-3 col-6">
                            <i class="fas fa-sync-alt mb-2" style="font-size:2rem;color:#f59e0b"></i>
                            <h6 class="mb-1">Last Update</h6>
                            <small class="text-muted">{{ date('d M Y H:i') }}</small>
                        </div>
                    </div>
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
<link rel="stylesheet" href="{{ asset('css/preloader.css') }}">
@stop

@section('js')
<script src="{{ asset('js/admin-pro.js') }}" defer></script>
@stop