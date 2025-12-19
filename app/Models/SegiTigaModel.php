<?php

namespace App\Models;

class SegiTigaModel {
    protected $alas;
    protected $tinggi;
    
    public function __construct($alas = 0, $tinggi = 0) {
        $this->alas = $alas;
        $this->tinggi = $tinggi;
    }
    
    public function setAlas($alas) {
        $this->alas = $alas;
    }
    
    public function setTinggi($tinggi) {
        $this->tinggi = $tinggi;
    }
    
    public function getAlas() {
        return $this->alas;
    }
    
    public function getTinggi() {
        return $this->tinggi;
    }
    
    public function hitungLuas() {
        return 0.5 * $this->alas * $this->tinggi;
    }
}
?>