<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailJual extends Model
{
    use HasFactory;
    
    protected $table = "detail_jual";
    
    protected $fillable = [
        'jual_id',
        'barang_id',
        'qty',
        'harga_sekarang',
        'user_id'
    ];
    
    public function barang()
    {
        return $this->belongsTo('App\Models\Barang', 'barang_id');
    }
    
    public function jual()
    {
        return $this->belongsTo('App\Models\Jual', 'jual_id');
    }
}
