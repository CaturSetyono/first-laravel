@extends('adminlte::page')

@section('title', 'Transaksi Penjualan')

@section('content_header')
    <h1>Daftar Transaksi Penjualan</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Riwayat Transaksi</h3>
                    <a href="{{ route('penjualan.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Transaksi Baru
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No. Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Nama Pembeli</th>
                                    <th>Telepon</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($penjualan as $p)
                                <tr>
                                    <td><strong>{{ $p->no_transaksi }}</strong></td>
                                    <td>{{ date('d/m/Y', strtotime($p->tanggal)) }}</td>
                                    <td>{{ $p->nama_pembeli }}</td>
                                    <td>{{ $p->telepon ?? '-' }}</td>
                                    <td><strong>Rp {{ number_format($p->total, 0, ',', '.') }}</strong></td>
                                    <td>
                                        @if($p->status == 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($p->status == 'proses')
                                            <span class="badge badge-info">Proses</span>
                                        @elseif($p->status == 'selesai')
                                            <span class="badge badge-success">Selesai</span>
                                        @else
                                            <span class="badge badge-danger">Batal</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('penjualan.show', $p->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada transaksi penjualan</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
