@extends('adminlte::page')

@section('title', 'Tabel Kota')

@section('content_header')
    <h1><i class="fas fa-map-marked-alt"></i> Tabel Kota</h1>
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
    .badge-id {
        background-color: #dbeafe;
        color: #1e40af;
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.75rem;
    }
    .badge-propinsi {
        background-color: #e0e7ff;
        color: #4338ca;
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.75rem;
    }
</style>

<div class="container-fluid">
    <div class="card-table">
        <table class="table">
            <thead>
                <tr>
                    <th width="10%">ID</th>
                    <th width="60%">Nama Kota</th>
                    <th width="30%" class="text-center">ID Propinsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kota as $k)
                <tr>
                    <td><span class="badge-id">{{ $k->id }}</span></td>
                    <td><strong>{{ $k->nama_kota }}</strong></td>
                    <td class="text-center"><span class="badge-propinsi">{{ $k->propinsi_id }}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@stop
