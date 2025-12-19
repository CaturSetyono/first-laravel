@extends('default')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Hasil Perhitungan Limas</h3>
                </div>
                <div class="card-body">
                    <div class="alert alert-success">
                        <h4>Hasil Perhitungan:</h4>
                        <table class="table table-borderless">
                            <tr>
                                <td>Alas</td>
                                <td>:</td>
                                <td>{{ $hasil['alas'] }}</td>
                            </tr>
                            <tr>
                                <td>Tinggi Alas</td>
                                <td>:</td>
                                <td>{{ $hasil['tinggi_alas'] }}</td>
                            </tr>
                            <tr>
                                <td>Tinggi Limas</td>
                                <td>:</td>
                                <td>{{ $hasil['tinggi_limas'] }}</td>
                            </tr>
                            <tr>
                                <td>Luas Alas</td>
                                <td>:</td>
                                <td>{{ $hasil['luas_alas'] }}</td>
                            </tr>
                            <tr>
                                <td><strong>Volume Limas</strong></td>
                                <td>:</td>
                                <td><strong>{{ $hasil['volume'] }}</strong></td>
                            </tr>
                        </table>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('limas.input') }}" class="btn btn-primary">Hitung Lagi</a>
                        <a href="{{ route('segitiga.index') }}" class="btn btn-secondary">Kembali ke Menu</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection