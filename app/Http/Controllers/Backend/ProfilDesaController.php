<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transformers\ProfilDesaTransformer;
use Illuminate\Support\Facades\Cache;
use Image;
use Validator;
use DB;
use App\ProfilDesa;
use App\Media;
use App\Kelurahan;
use App\Kecamatan;
use App\ProfilDesaMataPencaharian;
use App\Penduduk;
use App\JenisMataPencaharian;

class ProfilDesaController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $title_page = 'Daftar Profil Desa';
        $allData  =  ProfilDesa::getAllDesa('all');
        $urlCreate = route('profildesa.create');
        return view('admin.pages.desa.desa_list', compact('title_page','request','urlCreate'))->with('profildesa', $allData);
    }


    public function create(Request $request)
    {
        $title_page = 'Tambah Profil Desa';

        $urlApiKelurahan = route('api.kelterm', 32);
        $tahun = $this->opsiTahun();
        $keahlian = JenisMataPencaharian::pluck('nama_mata_pencaharian');
        return view('admin.pages.desa.desa_create', compact('title_page','urlApiKelurahan','tahun','keahlian'));
    }

    public function opsiTahun(){
        // Sets the top option to be the current year. (IE. the option that is chosen by default).
        $currently_selected = date('Y');
        // Year to start available options at
        $earliest_year = 1950;
        // Set your latest year you want in the range, in this case we use PHP to just set it to the current year.
        $latest_year = date('Y');
        $opsi = []; //inisialisasi array kosong
        foreach (range($latest_year,$earliest_year) as $i ) {
            $opsi[$i] = $i;
        }
        return $opsi;
    }
    public function store(Request $request)
    {
        $rules = [
            'kel_id'           =>'required|int|unique:r_profildesa',
            'pendirian_sk'     =>'required|string|max:200',
            'kades'            =>'required|string|max:200',
            'no_hp'            =>'required|string|max:20',
            'deskripsi'        =>'required|string|max:2000',
            'status'           =>'required|int|max:1',
            'jum_penduduk'     =>'required|int',
            'jum_pria'         =>'required|int',
            'jum_wanita'       =>'required|int',
            'jum_kk'           =>'required|int',
            'lulus_sd'         =>'required|int',
            'lulus_smp'        =>'required|int',
            'lulus_smu'        =>'required|int',
            'lulus_s1'         =>'required|int',
            'lulus_s2'         =>'required|int',
            'tdk_sekolah'      =>'required|int',
            'data_tahun'       =>'required|int',
        ];

        $this->validate($request, $rules);
        $success = false;

         $error ='';
         try{
            DB::beginTransaction();

                $profildesa = new ProfilDesa();
                $profildesa->kel_id = $request->kel_id;
                $profildesa->slug = str_slug($request->kelurahan_nama);
                $profildesa->pendirian_sk = $request->pendirian_sk;
                $profildesa->tgl_sk_pendirian = \Carbon\Carbon::parse($request->tgl_sk_pendirian)->format('Y-m-d');
                $profildesa->kades = $request->kades;
                $profildesa->no_hp = $request->no_hp;
                $profildesa->deskripsi = $request->deskripsi;
                $profildesa->author_id = auth()->user()->id;
                $profildesa->status = $request->status;
                $profildesa->data_tahun = $request->data_tahun;
                $profildesa->created_at = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
                $profildesa->updated_at = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
                $pdesa = $profildesa->save();
                //dd($pdesa);
                if($pdesa){
                    $penduduk = new Penduduk();
                    $penduduk->profildesa_id = $profildesa->id;
                    $penduduk->jum_penduduk = $request->jum_penduduk;
                    $penduduk->jum_pria = $request->jum_pria;
                    $penduduk->jum_wanita = $request->jum_wanita;
                    $penduduk->jum_kk = $request->jum_kk;
                    $penduduk->lulus_sd = $request->lulus_sd;
                    $penduduk->lulus_smp = $request->lulus_smp;
                    $penduduk->lulus_s1 = $request->lulus_s1;
                    $penduduk->tdk_sekolah = $request->tdk_sekolah;
                    $penduduk->data_tahun_pend = $request->data_tahun;
                    $penduduk->save();

                    // $matapencaharian = new ProfilDesaMataPencaharian();
                    // $matapencaharian->jenis_pencaharian_id = $request->jenis_pencaharian_id;
                    // $matapencaharian->jumlah = $request->jumlah;
                    // $matapencaharian->data_tahun_penchr = $request->data_tahun_penchr;
                    if ($request->hasFile('fotodesa') && $request->file('fotodesa')) {
                        $thefile = $request->file('fotodesa');
                        $mimetype = $thefile->getMimeType();
                        $name = $profildesa->slug.preg_replace('/\s+/', '',$thefile->getClientOriginalName());

                        $extensi = $thefile->getClientOriginalExtension();
                        //$media = new Media();
                        $mediaP = Media::select('media_id')->where('code_id',$request->id)->where('parent_table','r_profildesa')->first();
                        if($mediaP==null){
                            $media  = new Media();
                        }else{
                            $media  = Media::where('media_id',$mediaP->media_id)->first();
                        }
                        $media->code_id = $profildesa->id;
                        $media->parent_table = 'r_profildesa';
                        $media->mimetype = $mimetype;
                        $media->extensi = $extensi;
                        $media->filename = $name;
                        $media->title = isset($request->alt_foto)?$request->alt_foto:$request->nama_desawisata;
                        $media->author_id = auth()->user()->id;
                        $media->narasi =  strip_tags($request->deskripsi);
                        // $media->filesize = $size;
                        $media->status = $request->status;
                        $media->parent_media =1;
                        $media->updated_at = \Carbon\Carbon::now()->format('Y-m-d H:i:s');

                        if ($media->save()) {
                            //original
                            // $thefile = $thefile->move($this->photosPath, $name);
                            $berhasilSimpan = $thefile->move(public_path('storage/data-profildesa'), $name);
                            if($berhasilSimpan){
                                $resizedImage = $this->resizeThumb(public_path('storage/data-profildesa/'. $name),$name, 300);
                                //copy(storage_path('app/public/data-desawisata/thumb/').$name);
                                if (!$resizedImage) {
                                    $error.= 'Berhasil diupload tapi tdk bisa diresize<br>';
                                }
                            }else
                                $error.= 'Berhasil Simpan tapi image gagal diupload';
                        } else {
                            $error .= 'Foto Profil Desa Wisata tidak bisa disimpan';
                        }
                    }


                     $success = true;
                }else{
                    $error.='data profil desa gagal disimpan';
                }



            }catch(\Exception $e) {
                $error .= $e->getMessage();
            }

            if ($success) {
                DB::commit();
                return redirect()->route('profildesa.index')->with('success','Data Desa berhasil disimpan');
            } else {
                DB::rollback();
                return redirect()->back()->with('error',$error);
            }

    }


    private function resizeThumb($imagePath,$name, $size)
    {
        try {
            $img = Image::make($imagePath);
            $img->resize(intval($size), null, function ($constraint) {
                $constraint->aspectRatio();
            });

            return $img->save('storage/data-profildesa/thumb/'. $name);
        } catch (Exception $e) {
            return false;
        }
    }

    public function show($slug)
    {
        if(!isset($slug)){
            return redirect('404');
        }
       $profildesa = ProfilDesa::where('slug',$slug)->with('kelurahan.kecamatan.kabupaten','user','penduduk')->first();
        if (is_null($profildesa)) {
            return $this->respond('not_found');
        }

        $profildesa->load(['media'=>function($query){
            return $query->where('parent_media',1)->where('parent_table', '=', 'r_profildesa');
        }]);

       $namakec = $profildesa->kelurahan->kecamatan['nama'];
       $namakab = $profildesa->kelurahan->kecamatan->kabupaten['nama'];
       $urlApiKelurahan = URL('');
        $linkBack = route('profildesa.index');
        return view('admin.pages.desa.desa_show',compact('linkBack','request','namakab','namakec'))->with('profildesa',$profildesa);
    }

    public function edit(ProfilDesa $profildesa)
    {

        $profdesa = ProfilDesa::where('id',$profildesa->id)->with('kelurahan.kecamatan.kabupaten','user','penduduk')->first();

        if (is_null($profildesa)) {
            return abort('404');
        }
        $profdesa->load(['media'=>function($query){
            return $query->where('parent_media',1)->where('parent_table', '=', 'r_profildesa');
        }]);
        if(isset($profdesa)){
            $tahun = $this->opsiTahun();
            // foreach ($profdesa->penduduk as $penduduk) {
            //     $tahun[$penduduk->data_tahun_pend] = $penduduk->data_tahun_pend;
            // }

        }else{
            $awalTahun = isset($profdesa->tgl_sk_pendirian)?date('Y',strtotime($profdesa->tgl_sk_pendirian)):20;
            if((int)$awalTahun!=20){
                for($i=(int)$awalTahun;$i<=date('Y');$i++){
                    $tahun[$i] = $i;
                }
            }else{
                for($i=date('Y')-20;$i<=date('Y');$i++){
                    $tahun[$i] = $i;
                }
            }

        }


        $title_page = 'Edit Profil Desa';
        $linkBack = route('profildesa.index');

        return view('admin.pages.desa.desa_edit',compact('linkBack','profdesa','request','title_page','tahun'));
    }

    public function getPendidikan($iddesa){

    }

    public function getPenduduk($iddesa){
        $penduduk = Penduduk::where('profildesa_id',$iddesa)->get();
        return response()->json($penduduk);
    }

}
