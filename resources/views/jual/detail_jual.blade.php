@extends('adminlte::page')

@section('title', 'Detail Jual - Daftar Belanja')

@section('content_header')
<h1><i class="fas fa-shopping-basket"></i> Daftar Belanja</h1>
@stop

@section('content')
<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/jual/create') }}">Form Pelanggan</a></li>
        <li class="breadcrumb-item active" aria-current="page">Masukan Daftar Belanja</li>
    </ol>
</nav>

<!-- Info Box -->
<div class="card shadow mb-3">
    <div class="card-header bg-info text-white">
        <h5 class="mb-0">Informasi Transaksi</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4"><strong>Kasir:</strong> {{ auth()->user()->name }}</div>
            <div class="col-md-4"><strong>Tanggal Transaksi:</strong> {{ date('d-m-Y') }}</div>
            <div class="col-md-4"><strong>No Transaksi:</strong> <b>{{ $id }}</b></div>
        </div>
    </div>
</div>

<!-- Form Input Barang -->
<div class="card shadow mb-3">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="fas fa-plus-circle"></i> Tambah Barang</h5>
    </div>
    <div class="card-body">
        <form>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="jual_id" value="{{ $id }}">

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Kode</th>
                            <th>Nama Barang</th>
                            <th>Qty</th>
                            <th>Satuan</th>
                            <th>Harga (Rp)</th>
                            <th>Total (Rp)</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input type="text" class="form-control form-control-sm barang_id" name="barang_id"
                                    placeholder="Kode" title="Setelah diisi tekan enter">
                            </td>
                            <td>
                                <input class="form-control form-control-sm" id="nama_barang" type="text" name="nama_barang" disabled>
                            </td>
                            <td>
                                <input class="form-control form-control-sm" type="number" id="qty" name="qty" value="0" style="width: 80px;">
                            </td>
                            <td>
                                <input class="form-control form-control-sm" id="satuan" type="text" name="satuan" disabled style="width: 100px;">
                            </td>
                            <td>
                                <input class="form-control form-control-sm" id="harga" type="number" name="harga_sekarang"
                                    style="text-align:right" disabled>
                            </td>
                            <td>
                                <input class="form-control form-control-sm" id="total" type="number" name="total"
                                    style="text-align:right" readonly>
                            </td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm add-row">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>

<!-- Keranjang Belanja -->
<div class="card shadow">
    <div class="card-header bg-success text-white">
        <h5 class="mb-0"><i class="fas fa-shopping-cart"></i> Keranjang Belanja</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="table1" class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th width="5%">Pilih</th>
                        <th width="10%">Kode</th>
                        <th width="35%">Nama Barang</th>
                        <th width="10%">Qty</th>
                        <th width="10%">Satuan</th>
                        <th width="15%">Harga (Rp)</th>
                        <th width="15%">Total (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot class="table-secondary">
                    <tr>
                        <th colspan="6" style="text-align:right">TOTAL PEMBELIAN :</th>
                        <td style="text-align:right; font-size: 1.1em; font-weight: bold;">
                            <output id="jtotal" style="text-align:right">0</output>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="d-flex justify-content-between mt-3">
            <button type="button" class="btn btn-danger delete-row">
                <i class="fas fa-trash"></i> Hapus Item
            </button>
            <button type="button" class="btn btn-primary simpan">
                <i class="fas fa-save"></i> Simpan & Cetak
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
    $(document).ready(function() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var jTotal = 0;

        // Kode barang ditekan enter
        $(".barang_id").keypress(function(e) {
            var keycode = (e.keyCode ? e.keyCode : e.which);
            if (keycode == '13') {
                e.preventDefault();
                if ($('.barang_id').val() == "") {
                    alert("Kode barang tidak boleh kosong");
                    return false;
                }

                $.ajax({
                    url: '/bacaBarang',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        id: $(".barang_id").val()
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        if (data === null || data.nama_barang === undefined) {
                            alert("Barang Tidak Ada");
                            $(".barang_id").focus();
                            return false;
                        }
                        $("#nama_barang").val(data.nama_barang);
                        $("#harga").val(data.harga);
                        $("#satuan").val(data.satuan);
                        $("#qty").val(1);
                        $("#qty").focus();
                    },
                    error: function() {
                        alert("Barang tidak ditemukan!");
                    }
                });
            }
        });

        // Jumlah barang ditekan enter
        $("#qty").keypress(function(e) {
            var keycode = (e.keyCode ? e.keyCode : e.which);
            if (keycode == '13') {
                e.preventDefault();
                var qty = parseInt(e.target.value);
                var harga = parseInt($("#harga").val());
                var total = qty * harga;
                $("#total").val(total);
                $(".add-row").focus();
            }
        });

        // Menambahkan ke keranjang belanja
        $(".add-row").click(function() {
            var barang_id = $(".barang_id").val();
            var qty = $("#qty").val();
            var nama_barang = $("#nama_barang").val();
            var satuan = $("#satuan").val();
            var harga = $("#harga").val();
            var total = $("#total").val();

            if (!barang_id || !qty || qty <= 0) {
                alert("Lengkapi data barang!");
                return false;
            }

            jTotal += parseInt(total);

            var html = "<tr><td style='text-align:center'>" +
                "<input type='checkbox' name='record'></td><td>" +
                barang_id + "</td><td>" +
                nama_barang + "</td><td style='text-align:right'>" +
                qty + "</td><td>" +
                satuan + "</td><td style='text-align:right'>" +
                parseInt(harga).toLocaleString('id-ID') + "</td><td style='text-align:right'>" +
                parseInt(total).toLocaleString('id-ID') + "</td></tr>";

            $("#table1").find('tbody').append(html);
            $("#jtotal").text(jTotal.toLocaleString('id-ID'));

            // Kosongkan isian
            $(".barang_id").val('');
            $(".barang_id").focus();
            $("#nama_barang").val('');
            $("#qty").val(0);
            $("#satuan").val('');
            $("#harga").val(0);
            $("#total").val(0);
        });

        // Menghapus jika isian salah
        $(".delete-row").click(function() {
            var jtotal = jTotal;
            var hasChecked = false;

            $("table tbody").find('input[name="record"]').each(function() {
                if ($(this).is(":checked")) {
                    hasChecked = true;
                    var currow = $(this).closest('tr');
                    var isicol6 = currow.find('td:eq(6)').text().replace(/\./g, '');
                    jtotal -= parseInt(isicol6);
                    $(this).parents("tr").remove();
                }
            });

            if (!hasChecked) {
                alert("Pilih item yang akan dihapus!");
                return false;
            }

            jTotal = jtotal;
            $("#jtotal").text(jTotal.toLocaleString('id-ID'));
        });

        // Kirim ke server, simpan rekaman
        $(".simpan").click(function() {
            let dataBarang = [];
            var hasData = false;

            $("table#table1 tbody tr").each(function() {
                hasData = true;
                var currow = $(this);
                dataBarang.push({
                    'barang_id': currow.find('td:eq(1)').text(),
                    'qty': currow.find('td:eq(3)').text(),
                    'harga_sekarang': currow.find('td:eq(5)').text().replace(/\./g, ''),
                    'jual_id': "{{ $id }}"
                });
            });

            if (!hasData) {
                alert("Keranjang belanja masih kosong!");
                return false;
            }

            if (!confirm("Simpan transaksi ini?")) {
                return false;
            }

            // Kirim ke server untuk disimpan
            $.ajax({
                    url: '/jual/simpan',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        idJual: "{{ $id }}",
                        dataBarang: dataBarang
                    }
                })
                .done(function(response) {
                    if (response.berhasil) {
                        window.location.href = response.urlCetak;
                    }
                })
                .fail(function(error) {
                    alert("Gagal menyimpan transaksi!");
                    console.error(error);
                });
        });
    });
</script>
@stop