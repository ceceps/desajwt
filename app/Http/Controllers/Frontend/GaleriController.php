<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Media;
use App\MediaVideo;
use DB;
class GaleriController extends Controller
{
    public function index(){
        $title_page = 'Galeri';
        $keywords = 'Galeri Foto Desa Wisata, Kampung Wisata Foto Instagramable,Foto Event Keindahan Panorama Alami Desa Wisata';
        $description = 'Pesona Foto Alami Desa Wisata, Desa Wisata Foto Youtube, Instagramable,Foto Info Keindahan Panorama Kehidupan Alami Desa Wisata';
        $foto = Media::select('media_id','title','filename','narasi','extensi','parent_table','code_id');
        $video = MediaVideo::select('id','title','cover','filename','narasi','extensi','parent_table','code_id');
        $fiturFoto = $foto->orderBy('media_id', 'desc')->where('parent_table','!=','r_halaman')->take(5)->get();
        $fiturVideo = $video->take(3)->get();
        $arrFV = [];
        foreach($fiturVideo as $fv){
            $arrFV[] = $fv->id;
        }
        $arrFF = [];
        foreach($fiturFoto as $ff){
            $arrFF[] = $ff->media_id;
        }

        $detilVideo = $video->whereNotIn('id',$arrFV)->take(6)->get();
        $detilFoto = $foto->whereNotIn('media_id',$arrFF)->take(6)->get();
        return view('frontend.pages.galeri.index',compact('title_page','keywords','description','foto','video','fiturFoto','fiturVideo','detilVideo','detilFoto'));
    }

    public function foto($slug=''){
        if($slug!=''){
            $title_page = 'Galeri Foto';
            $media = Media::orderBy('media_id', 'desc')->whereIn('extensi',['jpeg','jpg','png','gif'])->with('user')->where('title',str_replace('-',' ',$slug))->where('parent_table','!=','r_halaman')->where('parent_media',1)->where('status',1)->take(5)->get();
            return view('frontend.pages.galeri.foto_show',compact('title_page','media'));

        }else{
            $title_page = 'Foto';

            $title_page = 'Galeri Foto';
            $media = Media::orderBy('media_id', 'desc')->whereIn('extensi',['jpeg','jpg','png','gif'])->where('parent_table','!=','r_halaman')->where('parent_media',1)->where('status',1)->take(5)->get();

            $mediaAll = Media::orderBy('media_id', 'desc')->where('parent_table','!=','r_halaman')->whereIn('extensi',['jpeg','jpg','png','gif'])->where('status',1)->paginate(8);
            $latesDesaWisata = Media::orderBy('media_id', 'desc')->whereIn('extensi',['jpeg','jpg','png','gif'])->where('parent_table','r_desawisata')->take(1)->first();
            $latesDesa = Media::orderBy('media_id', 'desc')->whereIn('extensi',['jpeg','jpg','png','gif'])->where('parent_table','r_profildesa')->take(1)->first();
            return view('frontend.pages.galeri.foto',compact('title_page','media','mediaAll','latesDesa','latesDesaWisata'));
        }

    }

    public function video($slug=''){
        if($slug!=''){
            $media = MediaVideo::select('title','extensi','filename','narasi','cover')->with('user')->orderBy('id', 'desc')->where('title',str_replace('-',' ',$slug))->where('status',1)->get();
            $title_page = 'Video';
            return view('frontend.pages.galeri.video_show',compact('title_page','media'));
        }else{
            $title_page = 'Video';
            $media = MediaVideo::select('title','extensi','filename','narasi','cover')->orderBy('id', 'desc')->where('parent_media',1)->where('status',1)->get();

            $mediaAll = MediaVideo::select('title','extensi','filename','narasi','cover')->orderBy('id', 'desc')->where('status',1)->paginate(8);
            $latesDesaWisata = MediaVideo::orderBy('id', 'desc')->where('extensi','mp4')->where('parent_table','r_desawisata')->take(1)->first();
            $latesDesa = MediaVideo::orderBy('id', 'desc')->where('extensi','mp4')->where('parent_table','r_profildesa')->take(1)->first();
            return view('frontend.pages.galeri.video',compact('title_page','media','mediaAll','latesDesa','latesDesaWisata'));
        }
    }

    public function videoShow(){
        $video = MediaVideo::find(1)->latest();
        return view('frontend.pages.galeri.video_detil',compact('video'));
    }
}
