<?php

namespace App\Http\Controllers;

use App\Models\LimasModel;
use App\Models\SegiTigaModel;
use Illuminate\Http\Request;

class SegiTigaController extends Controller
{
    public function index()
    {
        return view('segi-tiga.inputSegitiga');
    }

    public function inputSegitiga()
    {
        return view('segi-tiga.inputSegitiga');
    }

    public function hitungSegitiga(Request $request)
    {
        $request->validate([
            'alas' => 'required|numeric|min:0',
            'tinggi' => 'required|numeric|min:0',
        ]);

        $segiTiga = new SegiTigaModel($request->alas, $request->tinggi);
        $hasil = [
            'alas' => $segiTiga->getAlas(),
            'tinggi' => $segiTiga->getTinggi(),
            'luas' => $segiTiga->hitungLuas()
        ];

        return view('segi-tiga.hasil', compact('hasil'));
    }

    public function inputLimas()
    {
        return view('segi-tiga.inputLimas');
    }

    public function hitungLimas(Request $request)
    {
        $request->validate([
            'alas' => 'required|numeric|min:0',
            'tinggi' => 'required|numeric|min:0',
            'tinggi_limas' => 'required|numeric|min:0',
        ]);

        $limas = new LimasModel($request->alas, $request->tinggi, $request->tinggi_limas);
        $hasil = [
            'alas' => $limas->getAlas(),
            'tinggi_alas' => $limas->getTinggi(),
            'tinggi_limas' => $limas->getTinggiLimas(),
            'luas_alas' => $limas->hitungLuas(),
            'volume' => $limas->hitungVolume()
        ];

        return view('segi-tiga.hasilLimas', compact('hasil'));
    }
}
