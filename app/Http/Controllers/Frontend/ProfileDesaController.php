<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transformers\ProfilDesaTransformer;
use Illuminate\Support\Facades\Cache;
use App\ProfilDesa;
use App\DesaWisata;
use URL;
class ProfileDesaController extends Controller
{
    const MODEL = \App\ProfilDesa::class;

    //use RESTActions;

    public function index()
    {
        $title_page = 'Daftar Profil Desa';
        $allData = ProfilDesa::getAllDesa();

        return view('frontend.pages.desa.desa_list', compact('title_page'))->with('desa', $allData);
    }

    public function getAllDesa()
    {
        $m = self::MODEL;
        $all = $m::with('kelurahan')->with('penduduk')->with('user')->join('r_media','code_id','profildesa_id')->where('parent_table', 'r_profildesa')->get();

        return $all;
    }
    public function getOneDesa($slug)
    {
        $m = self::MODEL;
        $model = $m::find($slug);
        if (is_null($model)) {
            return $this->respond('not_found');
        }
        return $this->respond('done', $model);
    }

    protected function respond($status, $data = [])
    {
        return response()->json($data, $this->statusCodes[$status]);
    }

    public function getDesaViewOne($slug){
        $respon = $this->get($slug);
        if ($respon=='done'){
            return view('frontend.pages.desa.show',compact($respon));
        }else{
           return redirect('404');
        }
    }

    public function showFront($slug)
    {
        $desa = ProfilDesa::with('kelurahan.kecamatan.kabupaten','penduduk','user')->where('slug', $slug)->first();
        $desa->load(['media'=> function($query){
            return $query->where('parent_table', '=', 'r_profildesa')->get();
        }]);

        $komentar = [];
        $author = $desa->user['name'];
        $authorBio = '';
        $avatar = 'images/noimage.jpg';
        $desawisata = DesaWisata::with('media')->where('kel_id',$desa->kel_id)->get();
        $fotovideo = URL::to('/');
        $desa->load(['media_video'=>function($query){
            return $query->where('parent_table','r_profildesa')->where('status',1)->get();
        }]);

        if($desa->media_video != null and count($desa->media_video)){
            $titleVideo = $desa->media_video[0]->title;
            $filenameVideo  = $desa->media_video[0]->filename;
        }else{
            $titleVideo ='';
            $filenameVideo ='';
        }

        //
        //dd($desa);
        return view('frontend.pages.desa.show', compact('desa','komentar','avatar','author','authorBio','desawisata','fotovideo','titleVideo','filenameVideo'));
    }



}
