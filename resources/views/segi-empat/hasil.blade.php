@extends('default')
@section('content')
<h1>Hasil Perhitungan Segi Empat</h1>
<table class="table table-striped table-bordered">
    <tr><td>Panjang </td><td>{{$segiEmpat->panjang}}</td></tr>
    <tr><td>Lebar </td><td>{{$segiEmpat->lebar}}</td></tr>
    <tr><td>Luas </td><td>{{$segiEmpat->luas()}}</td></tr>
    <tr><td>Keliling </td><td>{{$segiEmpat->keliling()}}</td></tr>
</table>
@endsection