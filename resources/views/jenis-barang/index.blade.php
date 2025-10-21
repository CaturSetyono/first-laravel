@extends('layouts.app')
@section('content')
<div class="container">
    <h4>Data Jenis Barang</h4>
    <a href="{{ route('jenis-barang.create') }}"
        class="btn btn-primary mb-3">Tambah Jenis</a>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama Jenis</th>
                <th width="20%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->nama_jenis }}</td>
                <td>
                    <a href="{{ route('jenis-barang.edit', $row->id) }}"
                        class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('jenis-barang.destroy', $row->id) }}"
                        method="POST" class="d-inline"
                        onsubmit="return confirm('Hapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $data->links() }}
</div>
@endsection