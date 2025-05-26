<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use App\DesaWisata;
use App\Artikel;
use App\Media;
use App\Kelurahan;
use Auth;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;

class DashboardController extends Controller {
    protected  $user;

    public function __construct()
    {
        $this->middleware('auth');
        // $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function index(Request $request)
    {
        //  return view('admin.pages.dashboard.dashboard');
        $user = $request->auth;
        $provid = getenv('PROVID_DEFAULT', 32) !== false ? env('PROVID_DEFAULT') : 32;
        if($request->get('search_text')!=null OR $request->get('search_text')!=''){

            $title_page = 'Dashboad';
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
            /*
            *  @TODO
            *  nilai begining dan end page ketik page >2 masih salah
            */
            if($request->page==null or $request->page==1){
                $begPage =1;
                $endPage = $totalResult<$perPage?$totalResult:$perPage;
            }else if (($request->page>1) or ($request->page==2)){
                $begPage = 1+$perPage;
                $endPage = $totalResult<$perPage?$totalResult:$perPage;
            }else{
                $begPage = $request->page+$perPage;
                $endPage = ($request->page>1)?$currentPage*$perPage:$perPage;
            }

            return view('admin.pages.cari.index',
                compact('request','begPage','endPage', 'jumartikel', 'jumdesawisata', 'jumprofiledesa', 'totalResult', 'perPage', 'currentPage', 'currentPageSearchResults'))
                ->with('results', $results)->with('entries', $entries);
        }else{

            //Jumlah Data Desa Wisata per Kab/Kota di Provinsi Jabar
            $jumDesaWisata = DesaWisata::getJumDesaWisataInKab($provid);
            $artikel = Artikel::join('r_media', 'code_id', 'id')->where('parent_table', '=', 'r_artikel')->orderby('id', 'desc')->take(1)->get();

            $urlFile = Storage::url('data-artikel/'.$artikel[0]->filename);
            if (!$this::url_exists($urlFile)) {
                $urlFile = 'images/noimage.jpg';
            }
            $media = Media::orderBy('media_id', 'desc')->where('parent_table','!=','r_halaman')->take(5)->get();

            return view('admin.pages.dashboard.dashboard-konten', compact('jumDesaWisata', 'user', 'artikel', 'media','urlFile'));
            // return view('admin.pages.dashboard.dashboard', compact('jumDesaWisata', 'user'));
        }


    }


    public static function url_exists($url) {
        if (!$fp = curl_init($url)) return false;
        return true;
    }

}
