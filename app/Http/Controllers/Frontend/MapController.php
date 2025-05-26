<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DesaWisata;

class MapController extends Controller
{
   public function index(){
     $title_page = 'Peta Destinasi Desa Wisata Jawa Barat';
     $keywords = 'Peta Destinasi Desa Wisata Jawa Barat, Kampung Wisata Jawa Barat, Tujuan Wisata Jawa Barat, Tempat Wisata Kampung Alami, Lokasi Wisata Desa Tematik';
     $description = 'Peta Destinasi Desa Wisata Jawa Barat, Kampung Wisata Jawa Barat, Tujuan Wisata Jawa Barat, Tempat Wisata Kampung Alami, Lokasi Wisata Desa Tematik';
     $desawisata = DesaWisata::select('id','slug','nama_desawisata','slug','deskripsi','lat','longi','kel_id')->where('status',1)->where('lat','>',0)->get();
     $desawisata->load(['media'=>function($qry){
        return $qry->where('parent_table','r_desawisata')->whereStatus(1);
     }]);
     if(isset($desawisata)){
         $arPoi = [];
         foreach ($desawisata as $dsw) {
             if(count($dsw->media)>0 and ($dsw->lat>0) and ($dsw->longi>0)){
                 $urlImage = @getimagesize(asset('storage/data-desawisata/'.$dsw->media[0]['filename']))?asset('storage/data-desawisata/'.$dsw->media[0]['filename']):asset('images/noimage.jpg');
                 $arPoi[] = [$dsw->nama_desawisata,$dsw->lat,$dsw->longi,'<br>'.$urlImage.' '.str_limit(strip_tags($dsw->deskripsi),125)];
             }else{
                $arPoi[] = [$dsw->nama_desawisata,$dsw->lat,$dsw->longi,'<br>'.asset('images/noimage.jpg').str_limit(strip_tags($dsw->deskripsi),125)];
             }
         }
        // dd($arPoi);
     }
     return view('frontend.pages.map.index',compact('desawisata','title_page','keywords','description','arPoi'));
   }

   public function cari(Request $request){

   }
}
