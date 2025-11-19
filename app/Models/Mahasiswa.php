<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nim',
        'nama',
        'alamat',
        'tanggal_lahir',
        'jenis_kelamin',
        'prodi'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date'
    ];

    // Relationship dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
