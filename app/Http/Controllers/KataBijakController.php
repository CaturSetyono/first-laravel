<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KataBijakController extends Controller
{
    public function kata()
    {
        return "Rajin pangkal pandai";
    }

    public function pepatah()
    {
        return view("kata-bijak.pepatah");
    }
}
