<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\DesaWisata;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\DesaWisataAtraksi;
use App\DesaWisataUsahaPariwisata;
use App\MediaVideo;

class DesaWisataController extends Controller
{
    private $photos_path;

    public function __construct()
    {
        $this->photos_path = config('desawisata.PATH_IMAGE_DESAWISATA');
    }

    public function index(Request $request)
    {
        $title_page = 'Data Desa Wisata';
        $desawisata = $this->getAllDesaWisataCached();
        // $token = JWTAuth::getToken();
        // if (empty($token)) {
        //     redirect('backend')->withErrors('Token Tidak Tersedia');
        // }


        //  return view('admin.pages.dashboard.dashboard');
        //$user = JWTAuth::toUser($token);
        return view('admin.pages.desawisata.desawisata_list',compact('jumdesawisata','title_page','user'))->with('desawisata', json_decode($desawisata, true));
    }


    public function getAllDesaWisataCached()
    {
        if (Cache::has('alldesawisata')) {
            $desawisata = Cache::get('alldesawisata');
           //return $this->getDesaWisata();
        } else {
            $desawisata = $this->getDesaWisata();

            Cache::remember('alldesawisata', 22 * 60, function () {
                return $this->getDesaWisata();
            });
        }
        //dd($desawisata);
        return $desawisata;
    }

    public static function getDesaWisata()
    {
        $all = DesaWisata::getAllDesaWisata();
        return $all;
        // $respon = ["error" => 'false', 'pesan' => '', 'data' => $all];
    }


    public function frontAllDesaWisata()
    {
        $title_page = 'Data Desa Wisata';
        $desawisata = $this->getDesaWisataLite();


        return view('frontend.pages.desawisata.front_desawisata_list',compact('title_page','desawisata'));
    }

    public static function getDesaWisataLite($utama = false)
    {
        $desawisata = DesaWisata::select('id', 'slug', 'idcat', 'nama_desawisata', 'lat', 'longi', 'deskripsi', 'tgl_modif')->with('kelurahan.kecamatan.kabupaten','category')
        ->where('status', 1)->paginate(8);
        $desawisata->load(['media' => function ($query) use ($utama) {
            if ($utama)
                $query->where('parent_table', 'r_desawisata')->where('parent_media', 1)->where('status', 1);
            else
                $query->where('parent_table', 'r_desawisata')->where('status', 1);
        }]);

        return $desawisata;
    }


    public static function getDesaWisataLimit($jum = 10, $parent_media = true)
    {
        $desawisata = DesaWisata::select('id', 'nama_desawisata', 'slug', 'lat', 'longi', 'deskripsi', 'tgl_modif')->where('status', 1)
            ->limit($jum)->get();
        $desawisata->load(['media' => function ($query) use ($parent_media, $jum) {
            if ($parent_media)
                $query->where('parent_table', 'r_desawisata')->where('parent_media', 1)->where('status', 1);
            else
                $query->where('parent_table', 'r_desawisata')->where('status', 1);
        }]);

        return $desawisata;
    }

    public function showFront($slug)
    {
        $filter['slug'] = $slug;
        if (Cache::has('showOneDesaWisata')) {
            $desawisata = DesaWisata::showItemDesaWisata($filter);
        } else {
            $desawisata = DesaWisata::showItemDesaWisata($filter);
            Cache::remember('showOneDesaWisata', 22 * 60, function () use ($desawisata) {
                return $desawisata;
            });
        }

        if(count($desawisata)==0){
            return redirect('/desawisata');
        }

        $title_page = isset($desawisata[0]['nama_desawisata']) ? ucwords(strtolower($desawisata[0]['nama_desawisata'])). ' ' : '';
        $keywords = substr($desawisata[0]['narasi'], 0, 100);
        $descriptions = substr($desawisata[0]['narasi'], 101, 200);

        $atraksi = DesaWisataAtraksi::with('atraksi','media')->where('desawisata_id',$desawisata[0]['id'])->get();
        $usahapar = DesaWisataUsahaPariwisata::with('jenis_usaha')->where('desawisata_id',$desawisata[0]['id'])->get();
        $usahapar->load(['media'=>function($query){
            return $query->where('parent_table', 'r_desawisata_jenis_usaha');
        }]);

       //dd($desawisata);
        //video desa wisata
        $desawisata->load(['media_video'=>function($query){
            return $query->where('parent_table','r_desawisata')->where('parent_media',1);
        }]);

        if(count($desawisata[0]->media_video)>0){
            foreach($desawisata[0]->media_video as $mdv){
                $titleVideo = $mdv->title;
                $filenameVideo = '/storage/data-video/'.$mdv->filename;
                $narasiVideo = $mdv->narasi;
            }
        }else{
            $titleVideo = '';
            $filenameVideo = '';
            $narasiVideo = '';
        }
        return view('frontend.pages.desawisata.front_desawisata_show', compact('title_page', 'keywords', 'desawisata', 'description','atraksi','usahapar','mediavideo','titleVideo','filenameVideo'));
    }


}
