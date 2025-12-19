@extends('adminlte::page')

@section('title', 'Transaksi Baru')

@section('content_header')
    <h1>Transaksi Penjualan Baru</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Penjualan</h3>
                </div>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form action="{{ route('penjualan.store') }}" method="POST" id="formPenjualan">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror" 
                                           id="tanggal" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                                    @error('tanggal')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_pembeli">Nama Pembeli <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nama_pembeli') is-invalid @enderror" 
                                           id="nama_pembeli" name="nama_pembeli" value="{{ old('nama_pembeli') }}" required>
                                    @error('nama_pembeli')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                      id="alamat" name="alamat" rows="2">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="telepon">Telepon</label>
                            <input type="text" class="form-control @error('telepon') is-invalid @enderror" 
                                   id="telepon" name="telepon" value="{{ old('telepon') }}">
                            @error('telepon')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <hr>
                        <h5>Detail Barang</h5>
                        
                        <div id="itemContainer">
                            <div class="item-row mb-3">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Barang <span class="text-danger">*</span></label>
                                            <select class="form-control barang-select" name="barang_id[]" required onchange="updateHarga(this)">
                                                <option value="">Pilih Barang</option>
                                                @foreach($barang as $b)
                                                    <option value="{{ $b->id }}" 
                                                            data-harga="{{ $b->harga_jual }}" 
                                                            data-stok="{{ $b->stok }}"
                                                            data-nama="{{ $b->nama_barang }}">
                                                        {{ $b->nama_barang }} - Stok: {{ $b->stok }} - Rp {{ number_format($b->harga_jual, 0, ',', '.') }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Jumlah <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control jumlah-input" 
                                                   name="jumlah[]" min="1" value="1" required 
                                                   onchange="updateSubtotal(this)">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Harga</label>
                                            <input type="text" class="form-control harga-display" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Subtotal</label>
                                            <input type="text" class="form-control subtotal-display" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <button type="button" class="btn btn-danger btn-block" onclick="removeItem(this)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-success mb-3" onclick="addItem()">
                            <i class="fas fa-plus"></i> Tambah Barang
                        </button>

                        <hr>
                        
                        <div class="row">
                            <div class="col-md-8"></div>
                            <div class="col-md-4">
                                <h4>Total: <span id="grandTotal">Rp 0</span></h4>
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Transaksi
                            </button>
                            <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function updateHarga(selectElement) {
    const row = selectElement.closest('.item-row');
    const selectedOption = selectElement.options[selectElement.selectedIndex];
    const harga = selectedOption.dataset.harga || 0;
    const stok = selectedOption.dataset.stok || 0;
    
    const hargaDisplay = row.querySelector('.harga-display');
    const jumlahInput = row.querySelector('.jumlah-input');
    
    hargaDisplay.value = 'Rp ' + parseInt(harga).toLocaleString('id-ID');
    jumlahInput.max = stok;
    
    updateSubtotal(jumlahInput);
}

function updateSubtotal(jumlahInput) {
    const row = jumlahInput.closest('.item-row');
    const barangSelect = row.querySelector('.barang-select');
    const selectedOption = barangSelect.options[barangSelect.selectedIndex];
    const harga = parseInt(selectedOption.dataset.harga || 0);
    const jumlah = parseInt(jumlahInput.value || 0);
    const stok = parseInt(selectedOption.dataset.stok || 0);
    
    if (jumlah > stok) {
        alert(`Stok tidak mencukupi! Stok tersedia: ${stok}`);
        jumlahInput.value = stok;
        return;
    }
    
    const subtotal = harga * jumlah;
    const subtotalDisplay = row.querySelector('.subtotal-display');
    subtotalDisplay.value = 'Rp ' + subtotal.toLocaleString('id-ID');
    
    calculateGrandTotal();
}

function calculateGrandTotal() {
    let total = 0;
    document.querySelectorAll('.item-row').forEach(row => {
        const barangSelect = row.querySelector('.barang-select');
        const selectedOption = barangSelect.options[barangSelect.selectedIndex];
        const harga = parseInt(selectedOption.dataset.harga || 0);
        const jumlah = parseInt(row.querySelector('.jumlah-input').value || 0);
        total += harga * jumlah;
    });
    
    document.getElementById('grandTotal').textContent = 'Rp ' + total.toLocaleString('id-ID');
}

function addItem() {
    const container = document.getElementById('itemContainer');
    const newItem = container.firstElementChild.cloneNode(true);
    
    // Reset values
    newItem.querySelector('.barang-select').value = '';
    newItem.querySelector('.jumlah-input').value = 1;
    newItem.querySelector('.harga-display').value = '';
    newItem.querySelector('.subtotal-display').value = '';
    
    container.appendChild(newItem);
}

function removeItem(button) {
    const container = document.getElementById('itemContainer');
    if (container.children.length > 1) {
        button.closest('.item-row').remove();
        calculateGrandTotal();
    } else {
        alert('Minimal harus ada satu barang!');
    }
}

// Initialize first row
document.addEventListener('DOMContentLoaded', function() {
    const firstSelect = document.querySelector('.barang-select');
    if (firstSelect && firstSelect.value) {
        updateHarga(firstSelect);
    }
});
</script>
@stop
