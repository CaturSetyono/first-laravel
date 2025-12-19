<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\JenisBarang;

class Barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id';
    public $timestamps = true;
    
    const CREATED_AT = 'create_at';
    const UPDATED_AT = 'update_at';
    
    protected $fillable = [
        'id',
        'jenis_barang',
        'nama_barang',
        'satuan',
        'harga_pokok',
        'harga_jual',
        'stok',
    ];

    // relasi barang dengan jenis
    public function jenis()
    {
        return $this->belongsTo(JenisBarang::class, 'jenis_barang', 'id');
    }
}
