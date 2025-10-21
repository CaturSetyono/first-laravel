<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JenisBarangController;

Route::get('/', function () {
    return view('welcome');
});

// Routes untuk CRUD Jenis Barang
Route::resource('jenis-barang', JenisBarangController::class);
