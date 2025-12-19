@extends('adminlte::page')

@section('title', 'Cetak Transaksi Penjualan')

@section('content_header')
    <h1><i class="fas fa-print"></i> Cetak Struk Penjualan</h1>
@stop

@section('content')
<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">TOKO SERBA ADA</h5>
    </div>
    <div class="card-body">
        <p class="text-center mb-3"><strong>Alamat Jl. Wonosari KM.7 Bantul</strong></p>
        <hr>
        
        <div class="row mb-3">
            <div class="col-md-6">
                <table class="table table-sm table-borderless">
                    <tr>
                        <td width="150"><strong>No Transaksi</strong></td>
                        <td>: <b>{{ $id }}</b></td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal</strong></td>
                        <td>: <b>{{ $tgl }}</b></td>
                    </tr>
                    <tr>
                        <td><strong>Pelanggan</strong></td>
                        <td>: <b>{{ $pelanggan ? $pelanggan->nama_pelanggan : '-' }}</b></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th width="15%">Kode</th>
                        <th width="35%">Nama Barang</th>
                        <th width="10%" class="text-center">Qty</th>
                        <th width="10%">Satuan</th>
                        <th width="15%" class="text-end">Harga (Rp)</th>
                        <th width="15%" class="text-end">Total (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1;
                    $total = 0;
                    @endphp
                    @foreach($djual as $j)
                    <tr>
                        <td class="text-center">{{ $i++ }}</td>
                        <td>{{ $j->barang_id }}</td>
                        <td>{{ $j->barang->nama_barang }}</td>
                        <td class="text-center">{{ $j->qty }}</td>
                        <td>{{ $j->barang->satuan }}</td>
                        <td class="text-end">{{ number_format($j->harga_sekarang, 0, ',', '.') }}</td>
                        <td class="text-end">{{ number_format($j->qty * $j->harga_sekarang, 0, ',', '.') }}</td>
                        @php
                        $total += $j->qty * $j->harga_sekarang;
                        @endphp
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-secondary">
                    <tr>
                        <th colspan="6" class="text-end">TOTAL PEMBAYARAN</th>
                        <th class="text-end">Rp {{ number_format($total, 0, ',', '.') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('jual.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <button onclick="window.print()" class="btn btn-primary">
                <i class="fas fa-print"></i> Cetak Struk
            </button>
        </div>
    </div>
</div>

<style>
@media print {
    .btn, .main-header, .main-sidebar, .content-header, .main-footer {
        display: none !important;
    }
    .card {
        border: none !important;
        box-shadow: none !important;
    }
    .card-header {
        background-color: white !important;
        color: black !important;
        border-bottom: 2px solid #000 !important;
    }
}
</style>
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
