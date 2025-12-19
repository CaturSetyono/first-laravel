@extends('default')
@section('content')
<h4>Form Masukan Nilai Balok</h4>
<form action="{{ route('segi-empat.hasilBalok') }}" method="post">
    @csrf
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ada kesalahan</strong> Harap diperbaiki.<br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="form-group {{ $errors->has('panjang') ? 'has-error' : ''}}">
        <label for="panjang" class="control-label">Panjang</label>
        <input type="text" class="form-control" name="panjang" value="{{ old('panjang') }}">
    </div>
    <div class="form-group {{ $errors->has('lebar') ? 'has-error' : ''}}">
        <label for="lebar" class="control-label">Lebar</label>
        <input type="text" class="form-control" name="lebar" value="{{ old('lebar') }}">
    </div>
    <div class="form-group {{ $errors->has('tebal') ? 'has-error' : ''}}">
        <label for="tebal" class="control-label">Tebal</label>
        <input type="text" class="form-control" name="tebal" value="{{ old('tebal') }}">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-info">Proses</button>
    </div>
</form>
@endsection