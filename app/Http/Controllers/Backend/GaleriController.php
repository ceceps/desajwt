<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Media;
use App\MediaVideo;
use Illuminate\Pagination\LengthAwarePaginator;
class GaleriController extends Controller
{
    public function index(Request $request){
        $title_page = 'Galeri';
        $galeriFoto = Media::select('media_id as id','parent_table','title', 'filename as img','narasi','extensi','status','author_id')->with('user')->where('parent_table','!=','r_halaman')->where('parent_table','!=','r_setting_slider');
        $galeriVideo = MediaVideo::select('id','parent_table','title','cover as img','narasi','extensi','status','author_id')->with('user');
        $results = $galeriFoto->unionAll($galeriVideo)->get();
        $totalResult = count($results);
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $currentPageSearchResults = $results->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $entries = new LengthAwarePaginator($currentPageSearchResults, count($results), $perPage, $currentPage, ['path' => LengthAwarePaginator::resolveCurrentPath()]);

        if($request->page==2)
          $i = $perPage+1;
        else if($request->page>2)
          $i = ($perPage*($request->page-1))+1;
        else
          $i = 1;
        //dd($galeriFoto->get());
        return view('admin.pages.galeri.index',compact('title_page','results','entries','i', 'totalResult', 'perPage', 'currentPage', 'currentPageSearchResults'));
    }
    public function foto(){
        $title_page = 'Galeri Foto';

        $title_page = 'Galeri';
        $galeriFoto = Media::select('media_id as id','parent_table','title', 'filename as img','narasi','extensi','status','author_id')->with('user')->where('parent_table','!=','r_halaman')->where('parent_table','!=','r_setting_slider');
        $galeriVideo = MediaVideo::select('id','parent_table','title','cover as img','narasi','extensi','status','author_id')->with('user');
        $results = $galeriFoto->unionAll($galeriVideo)->get();
        $totalResult = count($results);
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $currentPageSearchResults = $results->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $entries = new LengthAwarePaginator($currentPageSearchResults, count($results), $perPage, $currentPage, ['path' => LengthAwarePaginator::resolveCurrentPath()]);

        if($request->page==2)
          $i = $perPage+1;
        else if($request->page>2)
          $i = ($perPage*($request->page-1))+1;
        else
          $i = 1;
        return view('admin.pages.galeri.foto',compact('title_page'));
    }
    public function video(){
        $title_page = 'Galeri Video';
        return view('admin.pages.galeri.video',compact('title_page'));
    }
}
