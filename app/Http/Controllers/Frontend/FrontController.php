<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Frontend\ArtikelController;
use App\DesaWisata;
use App\Artikel;
use App\Media;
use App\StaticPage;
use App\SetingSlider;
use App\Kelurahan;
use DB;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Pagination\LengthAwarePaginator;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        $title_page = 'Beranda';
        $keywords = 'Galeri Foto Desa Wisata, Kampung Wisata Foto Instagramable,Foto Event Keindahan Panorama Alami Desa Wisata';
        $description = 'Pesona Foto Alami Desa Wisata, Desa Wisata Foto Youtube, Instagramable,Foto Info Keindahan Panorama Kehidupan Alami Desa Wisata';

        $slider = SetingSlider::getAllData();
        $kategori = StaticPage::getAllData('kategori');
        $islogin = false;
        $cookie = $request->cookie('desawisata-web');
        if($cookie){
            $islogin = true;
        }

        if($request->get('search_text')!=null OR $request->get('search_text')!=''){

            $title_page  = 'Hasil Pencarian "'.$request->get('search_text').'"';
            $search = '%'.$request->get('search_text').'%';

            $desawisata = DesaWisata::select("nama_desawisata as nama" , "slug", "deskripsi",DB::raw("CONCAT('desawisata') as source"))
                            ->where('nama_desawisata', 'LIKE', $search)->where('status','=',1)
                            ->orWhere('r_desawisata.deskripsi', 'LIKE', $search);

            $jumdesawisata = count($desawisata->get());

            $kelurahan  = Kelurahan::select("nama", "slug","deskripsi",DB::raw("CONCAT('profildesa') as source"))->join('r_profildesa','kel_id','=','r_kelurahan.id')
                            ->where('nama', 'LIKE', $search)->orWhere('deskripsi', 'LIKE', $search);

            $jumprofiledesa = count($kelurahan->get());


            $artikel  = Artikel::select("judul as nama", "slug", "konten as deskripsi",DB::raw("CONCAT('artikel') as source"))
                            ->where('r_artikel.judul', 'LIKE', $search)
                            ->orWhere('r_artikel.konten', 'LIKE', $search);

            $jumartikel = count($artikel->get());
            $results = $desawisata->unionAll($kelurahan)->unionAll($artikel)->get();
            $totalResult = count($results);
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $perPage = 10;
            $currentPageSearchResults = $results->slice(($currentPage - 1) * $perPage, $perPage)->all();
            $entries = new LengthAwarePaginator($currentPageSearchResults, count($results), $perPage, $currentPage, ['path' => LengthAwarePaginator::resolveCurrentPath()]);

            return view('frontend.pages.cari.index',compact('title_page','keywords','description','request', 'jumartikel', 'jumdesawisata', 'jumprofiledesa', 'totalResult', 'perPage', 'currentPage', 'currentPageSearchResults'))
                ->with('results', $results)->with('entries', $entries);
        }else{

            $desa_wisata = DesaWisataController::getDesaWisataLimit(10, true);
            $artikel = Artikel::getArtikelMedia();
            return view('frontend.pages.app-welcome', compact('title_page', 'keywords','description','artikel', 'desa_wisata','kategori','slider','islogin'));
        }

    }

    public function verify()
    {
        $user = JWTAuth::parseToken()->authenticate();
    }


}
