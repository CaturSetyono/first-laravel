<?php

namespace App\Models;

class LimasModel extends SegiTigaModel {
    protected $tinggiLimas;
    
    public function __construct($alas = 0, $tinggi = 0, $tinggiLimas = 0) {
        parent::__construct($alas, $tinggi);
        $this->tinggiLimas = $tinggiLimas;
    }
    
    public function setTinggiLimas($tinggiLimas) {
        $this->tinggiLimas = $tinggiLimas;
    }
    
    public function getTinggiLimas() {
        return $this->tinggiLimas;
    }
    
    public function hitungVolume() {
        // Volume Limas = 1/3 × Luas Alas × Tinggi Limas
        return (1/3) * $this->hitungLuas() * $this->tinggiLimas;
    }
}
?>