<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Halaman;
class HalamanController extends Controller
{
    public function show($slug){
        $halaman = Halaman::where('slug',$slug)->first();
        $halaman->load(['media'=>function($query){
           return $query->where('parent_table','r_halaman')->whereStatus(1);
        }]);
        if(count($halaman->media)){
            $foto = url('storage/data-halaman/'.$halaman->media[0]['filename']);
        }else
            $foto = 'images/noimage.jpg';
        return view('frontend.pages.halaman.show',compact('halaman','foto'));
    }
}
