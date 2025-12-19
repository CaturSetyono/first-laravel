@extends('adminlte::page')

@section('title', 'Aggregate Functions')

@section('content_header')
    <h1><i class="fas fa-calculator"></i> Aggregate Functions</h1>
@stop

@section('content')
<style>
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
</style>

<div class="container-fluid">
    <div class="card-table">
        <table class="table">
            <thead>
                <tr>
                    <th width="50%">Fungsi Agregat</th>
                    <th width="50%" class="text-end">Hasil</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>max('harga_jual')</strong> - Harga Maksimal</td>
                    <td class="text-end"><strong>Rp {{ number_format($hargaMaks, 0, ',', '.') }}</strong></td>
                </tr>
                <tr>
                    <td><strong>avg('harga_jual')</strong> - Harga Rata-rata (Jenis 1)</td>
                    <td class="text-end"><strong>Rp {{ number_format($hargaRata2, 0, ',', '.') }}</strong></td>
                </tr>
                <tr>
                    <td><strong>min('harga_jual')</strong> - Harga Minimal (Jenis 1)</td>
                    <td class="text-end"><strong>Rp {{ number_format($hargaMin, 0, ',', '.') }}</strong></td>
                </tr>
                <tr>
                    <td><strong>max('harga_jual')</strong> - Harga Maksimal (Jenis 1)</td>
                    <td class="text-end"><strong>Rp {{ number_format($hargaMax, 0, ',', '.') }}</strong></td>
                </tr>
                <tr>
                    <td><strong>sum(stok * harga_jual)</strong> - Total Nilai Stok (Jenis 1)</td>
                    <td class="text-end"><strong>Rp {{ number_format($jumHarga, 0, ',', '.') }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@stop
