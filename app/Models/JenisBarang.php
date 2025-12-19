<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisBarang extends Model
{
    protected $table = 'jenis_barang';
    
    protected $fillable = [
        'nama_jenis',
        'kode_jenis', 
        'deskripsi',
        'aktif'
    ];
    
    protected $casts = [
        'aktif' => 'boolean'
    ];
}
