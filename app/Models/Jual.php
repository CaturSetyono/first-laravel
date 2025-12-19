<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jual extends Model
{
    use HasFactory;
    
    protected $table = "jual";
    protected $primaryKey = "id";
    
    protected $fillable = [
        'pelanggan_id',
        'tanggal',
        'jumlah_pembelian',
        'user_id'
    ];
    
    public function pelanggan()
    {
        return $this->belongsTo('App\Models\Pelanggan', 'pelanggan_id');
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    
    public function detailJual()
    {
        return $this->hasMany('App\Models\DetailJual', 'jual_id');
    }
}
