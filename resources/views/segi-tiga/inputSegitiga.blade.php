@extends('layouts.default')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Hitung Luas Segitiga</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('segitiga.hitung') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="alas" class="form-label">Alas</label>
                            <input type="number" class="form-control @error('alas') is-invalid @enderror" 
                                   id="alas" name="alas" step="0.01" value="{{ old('alas') }}" required>
                            @error('alas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tinggi" class="form-label">Tinggi</label>
                            <input type="number" class="form-control @error('tinggi') is-invalid @enderror" 
                                   id="tinggi" name="tinggi" step="0.01" value="{{ old('tinggi') }}" required>
                            @error('tinggi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Hitung Luas</button>
                        <a href="{{ route('segitiga.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection