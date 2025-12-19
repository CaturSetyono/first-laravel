@extends('adminlte::page')

@section('title', 'Transaksi Penjualan')

@section('content_header')
    <h1><i class="fas fa-cash-register"></i> Tambah Transaksi Penjualan</h1>
@stop

@section('content')
<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Form Data Pelanggan</h5>
    </div>
    <div class="card-body">
        {{ csrf_field() }}
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
        <div class="mb-3">
            <label for="no_transaksi" class="form-label">Nomor Transaksi (Preview)</label>
            <input type="text" class="form-control" id="no_transaksi" name="no_transaksi"
                   value="{{ $jual->no_transaksi }}" readonly>
            <small class="text-muted">Nomor transaksi akan digenerate saat klik Proses</small>
        </div>

        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="text" class="form-control tanggal" name="tanggal" id="tanggal"
                   value="{{ $jual->tanggal }}" readonly>
        </div>

        <div class="mb-3">
            <label for="username" class="form-label">Kasir</label>
            <input type="text" class="form-control username" name="username" id="username"
                   value="{{ auth()->user()->name }}" readonly>
        </div>

        <div class="mb-3">
            <label for="pelanggan_id" class="form-label">Nomor ID Pelanggan <small class="text-muted">(tekan enter)</small></label>
            <input type="text" class="form-control pelanggan_id" name="pelanggan_id" id="pelanggan_id"
                   placeholder="Masukkan ID pelanggan...">
        </div>

        <div class="mb-3">
            <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
            <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" readonly>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('jual.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <button type="button" class="btn btn-success proses">
                <i class="fas fa-arrow-right"></i> Proses
            </button>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/admin-pro.css') }}">
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/admin-pro.js') }}" defer></script>
<script>
$(document).ready(function(){
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    
    // Cari pelanggan ketika enter ditekan
    $(".pelanggan_id").keypress(function(e) {
        var keycode = (e.keyCode ? e.keyCode : e.which);
        if(keycode == '13') {
            e.preventDefault();
            $.ajax({
                url: '/bacaPelanggan',
                type: 'POST',
                data: {_token: CSRF_TOKEN, pelanggan_id: $(".pelanggan_id").val()},
                dataType: 'JSON',
                success: function (data) {
                    if(data) {
                        $("#nama_pelanggan").val(data.nama_pelanggan);
                    } else {
                        alert('Pelanggan tidak ditemukan!');
                        $("#nama_pelanggan").val('');
                    }
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + xhr.statusText;
                    alert('Error - ' + errorMessage);
                }
            });
        }
    });
    
    // Proses simpan pelanggan dan redirect ke detail jual
    $(".proses").click(function(){
        if(!$(".pelanggan_id").val()) {
            alert('Silakan masukkan ID pelanggan terlebih dahulu!');
            return;
        }
        
        if(!$("#nama_pelanggan").val()) {
            alert('Data pelanggan belum dimuat! Tekan Enter pada ID Pelanggan.');
            return;
        }
        
        $.ajax({
            url: '/jual/store',
            type: 'POST',
            data: {
                _token: CSRF_TOKEN,
                pelanggan_id: $(".pelanggan_id").val()
            },
            success: function(response) {
                if(response.success && response.id) {
                    // Redirect ke halaman detail jual dengan ID baru
                    $(location).attr('href', "{{ url('/detailJual') }}/" + response.id);
                } else {
                    alert('Error: Gagal membuat transaksi');
                }
            },
            error: function(xhr, status, error) {
                alert('Error menyimpan data!');
                console.error(xhr.responseText);
            }
        });
    });
});
</script>
@stop
