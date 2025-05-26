<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use DB;
use Carbon\Carbon;
use App\Artikel;
use App\KategoriArtikel;
use App\Komentar;
use App\MediaVideo;
use Storage;
use URL;
class ArtikelController extends Controller
{
    //admin index list
    public function index()
    {
        $title_page = 'Artikels';
        $artikel = Artikel::getArtikelMedia(7);
        $videolist = MediaVideo::take(7)->get();

        return view('frontend.pages.artikel.front_artikel_list', compact('title_page','videolist','artikel'));
    }

    public function showArtikel($slug)
    {
        $artikel = Artikel::with('user')->where('slug', $slug)->get();
        if(count($artikel)>0){
            $title_page = $artikel[0]->judul;
            $rellkonten = Artikel::getRelatedContent($artikel[0]->id);
            $profil = $artikel->load('user_profil');
        }
        else{
            $rellkonten =[];
            $title_page ='';
        }


        //$komentar = Komentar::where('obj_id',$artikel[0]->artikel_id)->get();
        $komentar =[];

        return view('frontend.pages.artikel.front_artikel_show', compact('artikel', 'title_page','rellkonten','komentar'));
    }


}
