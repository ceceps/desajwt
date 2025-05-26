<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Validator;
use Input;
use Auth;
use DB;
use App\DesaWisata;
use App\ProfilDesa;
use App\Media;
use App\Tags;
use App\Komentar;


class MapController extends Controller
{
    public function index(){
        return view('admin.pages.map.index');
    }

    public function store($id){
        //
    }

    public function show(Request $request,$id){
        return view('admin.pages.map.index');
    }
}
