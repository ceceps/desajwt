<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Atraksi;
use App\Transformers\AtraksiTransformer;

class AtraksiController extends Controller
{
    public function getAtraksi(Request $req)
    {
        //Alam
        $atraksi = Atraksi::where('parent_id', '=', 1)->get();
        return fractal()->collection($atraksi, new AtraksiTransformer)->toJson();
    }
}
