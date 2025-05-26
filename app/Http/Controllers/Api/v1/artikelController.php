<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Artikel;
use App\KategoriArtikel;
use Carbon\Carbon;
use Validator;
use Input;

class artikelController extends Controller
{
    public function index()
    {
        $artikel = Artikel::with('user', 'kategori_artikel')->latest()->paginate($this->limit);
        $artikel->load(['media' => function ($query) {
            $query->where('parent_table', 'r_artikel')->where('status', 1);
        }]);
        return response()->json($artikel);
    }
}
