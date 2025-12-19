<?php

namespace App\Http\Controllers;

use App\Models\SegiEmpat;
use App\Models\Balok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class SegiEmpatController extends Controller
{
    public function inputSegiEmpat()
    {
        return View::make('segi-empat.inputSegiEmpat');
    }
    public function hasil(Request $request)
    {
        $segiEmpat = new SegiEmpat();
        $rules = [
            'panjang' => 'required|numeric',
            'lebar' => 'required|numeric'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else{
            $segiEmpat->panjang = $request->panjang;
            $segiEmpat->lebar = $request->lebar;
            return View::make('segi-empat.hasil', compact('segiEmpat'));
        }
    }

    public function inputBalok()
    {
        return View::make('segi-empat.inputBalok');
    }

    public function hasilBalok(Request $request)
    {
        $balok = new Balok;
        
        $rules = [
            'panjang' => 'required|numeric',
            'lebar' => 'required|numeric',
            'tebal' => 'required|numeric'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
            $balok->panjang = $request->panjang;
            $balok->lebar = $request->lebar;
            $balok->tebal = $request->tebal;
            return View::make('segi-empat.hasilBalok', compact('balok'));
        }
    }

