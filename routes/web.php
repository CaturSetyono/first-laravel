<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DbController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\JualController;
use App\Http\Controllers\LaporanController;
// use App\Http\Controllers\KataBijakController;
use App\Http\Controllers\ProdukController;
// use App\Http\Controllers\SegiEmpatController;
// use App\Http\Controllers\SegiTigaController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Auth;

Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
});

Route::get('/user{nama}', function ($nama) {
    return view('Hello $nama');
});

Route::get('/produk/{id?}', function ($id = null) {
    return $id ? "Produk ID: $id" : "Tidak ada ID produk";
});

Route::get('/kategori/{nama}', function ($nama) {
    return "Kategori: $nama";
})->where('nama', '[A-Za-z]+');

Route::get('/profil', function () {
    return 'Ini halaman profil';
})->name('profil');

Route::get('/link-profil', function () {
    return route('profil');
});

Route::get('/home', [HomeController::class, 'index']);

Route::resources(['produk' => ProdukController::class]);


Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/laporan', function () {
        return 'Halaman Laporan Admin';
    });
});

// Route::get('kata-bijak/kata',[KataBijakController::class,'kata']);
// Route::get('kata-bijak/pepatah',[KataBijakController::class,'pepatah'])->name('kataPepatah');

// Route::get('segi-empat/input-balok', [SegiEmpatController::class, 'inputBalok'])->name('segi-empat.inputBalok');
// Route::post('segi-empat/hasil-balok', [SegiEmpatController::class, 'hasilBalok'])->name('segi-empat.hasilBalok');


// Route::get('segi-empat', [SegiEmpatController::class, 'inputSegiEmpat'])->name('segi-empat.input');
// Route::post('segi-empat/hasil', [SegiEmpatController::class, 'hasil'])->name('segi-empat.hasil');

// // Routes for Segitiga dan Limas
// Route::get('/segi-tiga', [SegiTigaController::class, 'index'])->name('segitiga.index');
// Route::get('/segi-tiga/input', [SegiTigaController::class, 'inputSegitiga'])->name('segitiga.input');
// Route::post('/segi-tiga/hitung', [SegiTigaController::class, 'hitungSegitiga'])->name('segitiga.hitung');

// Route::get('/limas/input', [SegiTigaController::class, 'inputLimas'])->name('limas.input');
// Route::post('/limas/hitung', [SegiTigaController::class, 'hitungLimas'])->name('limas.hitung');

// Barang and Jenis Barang Routes (Protected with Auth)
Route::middleware('auth')->group(function () {
    Route::resource('/jenis-barang', JenisBarangController::class);
    Route::resource('/barang', BarangController::class);
});

// Database Query Builder Routes
Route::middleware('auth')->group(function () {
    Route::get('db/bacaDb1', [DbController::class, 'bacaDb1']);
    Route::get('db/bacaDb2', [DbController::class, 'bacaDb2']);
    Route::get('db/aggregate', [DbController::class, 'aggregate']);
    Route::get('db/selectData', [DbController::class, 'selectData']);
    Route::get('db/insertData', [DbController::class, 'insertData']);
    Route::get('db/updateData', [DbController::class, 'updateData']);
    Route::get('db/deleteData', [DbController::class, 'deleteData']);

    // Katalog Buku Routes
    Route::resource('buku', BukuController::class);

    // Penjualan Routes
    Route::get('penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
    Route::get('penjualan/create', [PenjualanController::class, 'create'])->name('penjualan.create');
    Route::post('penjualan/store', [PenjualanController::class, 'store'])->name('penjualan.store');
    Route::get('penjualan/{id}', [PenjualanController::class, 'show'])->name('penjualan.show');
    
    // Transaksi Jual dengan Pelanggan
    Route::get('jual', [JualController::class, 'index'])->name('jual.index');
    Route::get('jual/create', [JualController::class, 'create'])->name('jual.create');
    Route::post('jual/store', [JualController::class, 'store'])->name('jual.store');
    Route::delete('jual/{id}', [JualController::class, 'destroy'])->name('jual.destroy');
    Route::post('bacaPelanggan', [JualController::class, 'getPelanggan']);
    Route::get('detailJual/{id}', [JualController::class, 'detailJual']);
    Route::post('bacaBarang', [JualController::class, 'getBarang']);
    Route::post('jual/simpan', [JualController::class, 'simpan'])->name('jual.simpan');
    Route::get('jual/cetak/{id}', [JualController::class, 'cetak'])->name('jual.cetak');
    
    // Laporan Routes
    Route::get('laporan/penjualan', [LaporanController::class, 'penjualan'])->name('laporan.penjualan');
    Route::get('laporan/rekap-bulanan', [LaporanController::class, 'rekapBulanan'])->name('laporan.rekap-bulanan');
});

// Admin Settings Routes
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::get('/settings/profile', [SettingsController::class, 'profile'])->name('settings.profile');
    Route::put('/settings/profile', [SettingsController::class, 'updateProfile'])->name('settings.profile.update');
    Route::get('/settings/password', [SettingsController::class, 'password'])->name('settings.password');
    Route::put('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.password.update');
});

Route::fallback(function () {
    return 'Halaman tidak ditemukan';
});

Auth::routes();

Route::get('/home', function () {
    return redirect()->route('admin.dashboard');
})->name('home');
