<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SegiEmpat extends Model
{
    /* properti */
    public $panjang;
    public $lebar;

    /* membuat method/fungsi */
    public function luas()
    {
        return $this->panjang * $this->lebar;
    }
    
    /* membuat method/keliling */
    public function keliling()
    {
        return 2*($this->panjang + $this->lebar);
    }
}
