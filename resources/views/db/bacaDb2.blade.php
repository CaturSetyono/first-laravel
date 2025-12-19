@extends('adminlte::page')

@section('title', 'Detail Kota')

@section('content_header')
    <h1><i class="fas fa-map-marker-alt"></i> Detail Kota - Query first()</h1>
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
    .badge-value {
        background-color: #dbeafe;
        color: #1e40af;
        padding: 8px 16px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 1rem;
    }
</style>

<div class="container-fluid">
    @if($kota)
    <div class="card-table">
        <table class="table">
            <thead>
                <tr>
                    <th width="30%">Field</th>
                    <th width="70%">Value</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>ID Kota</strong></td>
                    <td><span class="badge-value">{{ $kota->id }}</span></td>
                </tr>
                <tr>
                    <td><strong>Nama Kota</strong></td>
                    <td><span class="badge-value">{{ $kota->nama_kota }}</span></td>
                </tr>
                <tr>
                    <td><strong>ID Propinsi</strong></td>
                    <td><span class="badge-value">{{ $kota->propinsi_id }}</span></td>
                </tr>
            </tbody>
        </table>
    </div>
    @else
    <div class="alert alert-warning">
        <i class="bi bi-exclamation-triangle"></i> Data tidak ditemukan!
    </div>
    @endif
</div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@stop
