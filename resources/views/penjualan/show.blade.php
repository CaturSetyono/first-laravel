@extends('adminlte::page')

@section('title', 'Detail Transaksi')

@section('content_header')
    <h1>Detail Transaksi Penjualan</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Informasi Transaksi</h3>
                    <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
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

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="150">No. Transaksi</th>
                                    <td>: <strong>{{ $jual->no_transaksi }}</strong></td>
                                </tr>
                                <tr>
                                    <th>Tanggal</th>
                                    <td>: {{ date('d F Y', strtotime($jual->tanggal)) }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>: 
                                        @if($jual->status == 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($jual->status == 'proses')
                                            <span class="badge badge-info">Proses</span>
                                        @elseif($jual->status == 'selesai')
                                            <span class="badge badge-success">Selesai</span>
                                        @else
                                            <span class="badge badge-danger">Batal</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="150">Nama Pembeli</th>
                                    <td>: {{ $jual->nama_pembeli }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>: {{ $jual->alamat ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Telepon</th>
                                    <td>: {{ $jual->telepon ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <hr>

                    <h5>Detail Barang</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th width="50">No</th>
                                    <th>Nama Barang</th>
                                    <th>Satuan</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($details as $index => $detail)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $detail->nama_barang }}</td>
                                    <td>{{ $detail->satuan }}</td>
                                    <td class="text-right">Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                                    <td class="text-center">{{ $detail->jumlah }}</td>
                                    <td class="text-right"><strong>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</strong></td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="table-info">
                                    <th colspan="5" class="text-right">TOTAL</th>
                                    <th class="text-right">
                                        <h5>Rp {{ number_format($jual->total, 0, ',', '.') }}</h5>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="mt-3">
                        <small class="text-muted">
                            Dibuat: {{ $jual->created_at }}<br>
                            Terakhir Diupdate: {{ $jual->updated_at }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
