<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transformers\DesaWisataTransformer;
use App\Transformers\DesaWisataAksesTransformer;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Auth\User as Authenticate;
use Spatie\Permission\Traits\HasRoles;
use Form;
use Softon\SweetAlert\Facades\SWAL;
use Image;
use Validator;
use DB;

use App\Kabupaten;
use App\DesaWisata;
use App\DesaWisataPengelola;
use App\DesaWisataAkses;
use App\DesaWisataAtraksi;
use App\DesaWisataPromosi;
use App\DesaWisataKelsos;
use App\DesaWisataFasilitas;
use App\DesaWisataUsahaPariwisata;
use App\DesaWisataBantuan;
use App\JenisPromosi;
use App\Kelurahan;
use App\User;
use App\Media;
use App\UserProfil;
use App\MediaVideo;

class DesaWisataController extends Controller
{
    private $photosPath;
    private $user;

    public function __construct()
    {
        $this->middleware('auth');
        $this->photosPath = config('desawisata.PATH_IMAGE_DESAWISATA');
    }

    public function cekToken()
    {
        $token = $request->get('token');
        if (empty($token)) {
            redirect('backend')->withErrors('Token Tidak Tersedia');
        }
    }
    /**
     * @TODO: Ambil total data ketika filter/seach
     *
     */
    public function index(Request $request)
    {
        $title_page = 'Data Desa Wisata';
        //$this->cekToken();
        $kabupaten = Kabupaten::where('provinsi_id', 32)->get();

        if($request->all() != null){

            $filter['kategori_id'] = $request->kategori;
            $filter['kabupaten_id'] = $request->kabupaten;
            $filter['cari'] = $request->cari;
            $filter['page'] = $request->page;

            $desawisata  = DesaWisata::getAllDesaWisata(true,9,$filter);
            $jumData = count($desawisata);
            $current_url  = url()->current().'?_token='.$request->_token.'&kategori='.$request->kategori.'&kabupaten='.$request->kabupaten.'&cari='.$request->cari;
        }else{
            // cek role unt admin kab kota

            $jumData = DesaWisata::count();

            $filter['status'] = 1;
             $desawisata  = DesaWisata::getAllDesaWisata($filter);
             $filter['kategori_id'] ='';
            $current_url  = url()->current();

        }


        return view('admin.pages.desawisata.desawisata_list', compact('title_page',  'desawisata','filter','request','current_url','jumData'))
            ->with('kabupaten', $kabupaten);
    }

    public function tampil(Request $request,$status='')
    {

        if ($status=='trash'){
           $title_page = 'Data Desa Wisata Trash';
           $filter['status'] = 2;
        }else if ($status=='draft'){
           $title_page = 'Data Desa Wisata Draft';
           $filter['status'] = 0;
        }else if ($status=='tampil'){
           $title_page = 'Data Desa Wisata Tampil';
           $filter['status'] = 1;
        }else{
            $title_page = 'Data Desa Wisata';

        }

        //$this->cekToken();
        $kabupaten = Kabupaten::where('provinsi_id', 32)->get();

        if($request->all() != null){

            $filter['kategori_id'] = $request->kategori;
            $filter['kabupaten_id'] = $request->kabupaten;
            $filter['cari'] = $request->cari;
            $filter['kode_peta'] = $request->kode_peta;
            $filter['page'] = $request->page;

            $desawisata  = DesaWisata::getAllDesaWisata(true,9,$filter);
             $jumData = $desawisata->total();
            $current_url  = url()->current().'?_token='.$request->_token.'&kategori='.$request->kategori.'&kabupaten='.$request->kabupaten.'&cari='.$request->cari.'&kode_peta='.$request->kode_peta;
        }else if(count($filter)>0 or $request->all()){
            $desawisata  = DesaWisata::getAllDesaWisata(true,9,$filter);
            $filter['kategori_id'] ='';
            $current_url  = url()->current();
            //$desawisata = DesaWisata::getAllDesaWisata($filter); dd()
            $jumData = $desawisata->total();
        }else{
            $desawisata  = DesaWisata::getAllDesaWisata();
            // $filter = '';
            $filter['kategori_id'] ='';
            $current_url  = url()->current();
            $jumData = $desawisata->total();
        }


        return view('admin.pages.desawisata.desawisata_list', compact('title_page',  'desawisata','filter','request','current_url','jumData'))
            ->with('kabupaten', $kabupaten);
    }

    public function getAllDesaWisataCached()
    {
        $desawisata = $this->getDesaWisata();
        return $desawisata;
    }

    public static function getDesaWisata()
    {
        $all = DesaWisata::getAllDesaWisata();
        $respon = ["error" => 'false', 'pesan' => '', 'data' => $all];
        return $respon;
    }


    public function create(Request $request)
    {
        $title_page = 'Tambah Data Desa Wisata';
        $urlStoreProfil = route("api.desawisata.store.profil");
        $urlApiKelurahan = route('api.kelterm', 32);
        $nama_desawisata='';
        $tahun = $this->opsiTahun();
    //    return view('admin.pages.desawisata.desawisata_create_wizard', compact('title_page','urlStoreProfil','urlApiKelurahan','nama_desawisata','tahun'));
       return view('admin.pages.desawisata.create_profil', compact('title_page','urlStoreProfil','urlApiKelurahan','tahun'));
    }

    public function store(Request $request)
    {
        $responProfil = $this->storeprofil($request);
    }

    public function storeprofil(Request $request)
    {
         $rules = [
            'nama_desawisata' =>  'required|unique:r_desawisata,nama_desawisata',
            'idcat' => 'required|int',
            'tahun_berdiri' => 'required|int',
            'deskripsi' => 'required|string',
            'kel_id' => 'required',
            'sk_desa' => 'nullable|string',
            'tgl_sk_desa' => 'nullable|date',
            'sk_dinas_kab' => 'nullable|string',
            'tgl_sk_kab' => 'nullable|date',
            'sk_provinsi' => 'nullable|string',
            'tgl_sk_prov' => 'nullable|date',
            'lat' => 'nullable|numeric',
            'longi' => 'nullable|numeric',
            'fotodesawisata' => 'required|image|max:5120',
            'video_desawisata' => 'max:200',
        ];
        $this->validate($request,$rules);

        // if ($validator->failed()) {
        //     $errors = $validator->errors();
        //     //return response()->back()->withError($errors)->withInput();
        //     return response()->json(['message' =>'Desa Wisata Gagal disimpan '.$errors,'error'=>'true','rel'=>'backend/desawisata/create#step-1'], 201)->withInput();
        // } else {

            $success = false;
            $id = null;

            DB::beginTransaction();

                $error ='';
                $name ='';
                $media = '';
            try {
                // Simpan data Profil
                $profil = new DesaWisata();
                $profil->nama_desawisata = $request->get('nama_desawisata');
                $profil->slug = str_slug($request->nama_desawisata);
                $profil->idcat = $request->idcat;
                $profil->tahun_berdiri = $request->tahun_berdiri;
                $profil->deskripsi = $request->deskripsi;
                $profil->kel_id = $request->kel_id;
                $profil->kabupaten_id = substr($request->kel_id,0,4);
                $profil->sk_desa = $request->sk_desa;
                $profil->tgl_sk_desa = isset($request->tgl_sk_desa)?\Carbon\Carbon::parse($request->tgl_sk_desa)->format('Y-m-d'):null;
                $profil->sk_dinas_kab = $request->sk_dinas_kab;
                $profil->tgl_sk_kab =  isset($request->tgl_sk_kab)?\Carbon\Carbon::parse($request->tgl_sk_kab)->format('Y-m-d'):null;
                $profil->sk_provinsi = $request->sk_provinsi;
                $profil->tgl_sk_prov = isset($request->tgl_sk_prov)?\Carbon\Carbon::parse($request->tgl_sk_prov)->format('Y-m-d'):null;
                $profil->tgl_modif = isset($request->tgl_data)?\Carbon\Carbon::parse($request->tgl_data)->format('Y-m-d'):\Carbon\Carbon::now()->format('Y-m-d');
                $profil->lat =  (float) str_replace(',', '.', $request->lat);
                $profil->longi =  (float) str_replace(',', '.', $request->longi);
                $profil->status = $request->status;
                $profil->tgl_terdata = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
                $profil->author_id = auth()->user()->id;
                $profil->luas = $request->luas;
                $profil->batasan_desa = $request->batasan_desa;
                $desawisataprofil = $profil->save();

                if ($desawisataprofil) {
                    $id = $profil->id;
                    if ($request->hasFile('fotodesawisata') && $request->file('fotodesawisata')) {
                        $thefile = $request->file('fotodesawisata');
                        $mimetype = $thefile->getMimeType();
                        $name = $profil->slug.preg_replace('/\s+/', '',$profil->nama_desawisata.'-'.$thefile->getClientOriginalName());

                        $extensi = $thefile->getClientOriginalExtension();

                        $media = new Media();
                        $media->code_id = $profil->id; //last id profil desawisata
                        $media->parent_table = 'r_desawisata';

                        $media->extensi = $extensi;
                        $media->mimetype = $mimetype;
                        $media->filename = $name;
                        $media->url = public_path('storage/data-desawisata/'.$name);
                        $media->title = $profil->nama_desawisata;
                        $media->author_id = auth()->user()->id;
                        $media->narasi =  substr($profil->deskripsi,0,100);

                        // $media->filesize = $size;
                        $media->status = 1;
                        $media->parent_media =1;
                        $media->created_at = \Carbon\Carbon::now()->format('Y-m-d H:i:s');

                        if ($media->save()) {
                            //original
                            $berhasilSimpan = $thefile->move(public_path('storage/data-desawisata/'), $name);

                            if($berhasilSimpan){
                                $resizedImage = $this->resizeThumb(public_path('storage/data-desawisata/'. $name),$name, 300);

                                if (!$resizedImage) {
                                    $error.= 'Berhasil diupload tapi tdk bisa diresize<br>';
                                }else
                                   $success = true;
                            }else
                                $error.= 'Berhasil Simpan tapi image gagal diupload';

                        } else {
                            $error .= 'Profil Desa Wisata tidak bisa disimpan';
                        }
                    }

                    //Media Video
                    if($request->video_desawisata != null){
                        $video  = new MediaVideo();
                        $video->title    = $request->video_desawisata;
                        $video->narasi = $request->deskripsi;
                        $video->filename = trim(str_replace('local'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'data-video'.DIRECTORY_SEPARATOR,' ',$request->video_profil));
                        $video->filename = trim(str_replace('public'.DIRECTORY_SEPARATOR.'data-video'.DIRECTORY_SEPARATOR,' ',$request->video_profil));

                        $video->created_at = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
                        $video->code_id = $request->id;
                        $video->status = $request->status;
                        $video->cover = isset($name)?$name:'';
                        $video->author_id = auth()->user()->id;
                        $video->parent_table = 'r_desawisata';
                        $video->extensi = last(explode('.',$video->filename));
                        $video->save();
                    }
                 }else
                    $error .= 'Profil Desa Wisata tidak bisa disimpan';

            } catch (\Exception $e) {
                $error .= $e->getMessage();
            }

            if ($success) {
                DB::commit();
                return redirect()->route('desawisata.create.pengelola',$profil->id)->with('success','Data Profil Berhasil disimpan');
            } else {
                DB::rollback();
                dd($error);
                return redirect()->back()->with('errors',$error)->withInput();
            }
       // }
    }

    public function createPengelola($idprofil)
    {
        $title_page = 'Tambah Data Pengelola Desa Wisata';
        $desawisata =  DesaWisata::with('pengelola')->find($idprofil);

        if(!isset($desawisata)){
            return redirect()->route('desawisata.create');
        }
        $nama_desawisata = ucwords($desawisata->nama_desawisata);
        return view('admin.pages.desawisata.create_pengelola', compact('title_page','idprofil','nama_desawisata','desawisata'));
    }

    public function storePengelola(Request $request)
    {
        $dswpengelola =  DesaWisataPengelola::where('desa_wisata_id',$request->desa_wisata_id)->first();

            if($dswpengelola==null){
                $rules = [
                    'desa_wisata_id' =>  'required|int|unique:r_desawisata_pengelola,desa_wisata_id',
                    'nama_pengelola' =>  'required|string|unique:r_desawisata_pengelola,nama_pengelola',
                    'pimpinan' => 'required|string|max:150',
                    'no_hp' => 'required|string|max:20',
                    'kontak_person' => 'required|string|max:50',
                    'jabatan' => 'required|string|max:50',
                    'nohp_cp' => 'required|string|max:20',
                    'email' => 'required|email',
                    'website' => 'url',
                    'jum_pengurus' => 'required|int',
                    'regulasi' =>'string|max:100'
                ];
                $this->validate($request,$rules);
                $dswpengelola = new DesaWisataPengelola();
            }else{
                $rules = [
                    'nama_pengelola' =>  'required|string|unique:r_desawisata_pengelola,nama_pengelola,'.$request->desa_wisata_id,
                    'pimpinan' => 'required|string|max:150',
                    'no_hp' => 'required|string|max:20',
                    'kontak_person' => 'required|string|max:50',
                    'jabatan' => 'required|string|max:50',
                    'nohp_cp' => 'required|string|max:20',
                    'email' => 'required|email',
                    'website' => 'url',
                    'jum_pengurus' => 'required|int',
                    'regulasi' =>'string|max:100'
                ];
                $this->validate($request,$rules);
                $dswpengelola = DesaWisataPengelola::findOrFail($dswpengelola->id);
            }

            $dswpengelola->nama_pengelola = $request->nama_pengelola;
            $dswpengelola->desa_wisata_id =  $request->desa_wisata_id;
            $dswpengelola->pimpinan = $request->pimpinan;
            $dswpengelola->no_hp = $request->no_hp;
            $dswpengelola->kontak_person = $request->kontak_person;
            $dswpengelola->jabatan = $request->jabatan;
            $dswpengelola->nohp_cp = $request->nohp_cp;
            $dswpengelola->website = $request->website;
            $dswpengelola->email = $request->email;
            $dswpengelola->jum_pengurus = $request->jum_pengurus!=null?$request->jum_pengurus:0;
            $dswpengelola->regulasi = $request->regulasi;
            $simpan = $dswpengelola->save();

            if($simpan){
                return response()->json(['errors'=>false,'message'=>'Data Pengelola Berhasil Disimpan','idprofil'=>$request->desawisata_id]);
            }else{
                return response()->json(['errors'=>true,'message'=>'Data Pengelola Gagal Disimpan']);
            }
    }

    public function createAkses($idprofil)
    {
        $title_page = 'Tambah Data Aksessibilitas Desa Wisata';
        $desawisata =  DesaWisata::with('akses')->findOrFail($idprofil);

        if(!isset($desawisata)){
            return redirect()->route('desawisata.create');
        }

        if($desawisata->akses !=null)
            $url = route('desawisata.update.akses',$idprofil);
        else
            $url = route('desawisata.store.akses',$idprofil);
        $nama_desawisata = $desawisata->nama_desawisata;

        $jarak = ['m'=>'meter','km'=>'kilo meter','mil'=>'mil'];
        return view('admin.pages.desawisata.create_akses', compact('url','title_page','idprofil','nama_desawisata','jarak'))->with('desawisata',$desawisata);
    }

    public function storeAkses(Request $request)
    {
        $dswakses =  DesaWisataAkses::where('desa_wisata_id',$request->desa_wisata_id)->first();
        if($dswakses==null){
            $rules = [
                'desa_wisata_id' =>  'required|int|unique:r_desawisata_akses,desa_wisata_id',
                'jarak_dari_ibukota' =>  'required|int',
                'satuan_prov' =>  'required|string|max:5',
                'waktu_dari_ibukota' =>  'required|string|max:10',
                'jarak_dari_kab' => 'required|int',
                'satuan_kab' => 'required|string|max:5',
                'waktu_dari_kab' => 'required|string|max:10',
                'jarak_dari_kec' => 'required|int',
                'satuan_kec' => 'required|string|max:5',
                'waktu_dari_kec' => 'required|string|max:10',
                'kondisi_jalan' => 'required|string|max:10',
                'jenis_kendaraan' => 'required|string|max:50',
                'kendaraan_umum' => 'required|string|max:50',
                'rambu_petunjuk' => 'required|int',
                'jalur_transport' => 'required|string|max:4000'
            ];

        }else{

            $rules = [
                'desa_wisata_id' =>  'required|int|unique:r_desawisata_akses,desa_wisata_id,'.$request->desa_wisata_id,
                'jarak_dari_ibukota' =>  'required|int',
                'satuan_prov' =>  'required|string|max:5',
                'waktu_dari_ibukota' =>  'required|string',
                'jarak_dari_kab' => 'required|int|max:10',
                'satuan_kab' => 'required|string|max:5',
                'waktu_dari_kab' => 'required|string|max:10',
                'jarak_dari_kec' => 'required|string|max:10',
                'satuan_kec' => 'required|string|max:5',
                'waktu_dari_kec' => 'required|string|max:10',
                'kondisi_jalan' => 'required|string|max:10',
                'jenis_kendaraan' => 'required|string|max:50',
                'kendaraan_umum' => 'required|string|max:50',
                'rambu_petunjuk' => 'required|int',
                'jalur_transport' => 'required|string|max:4000'
            ];

        }

        $this->validate($request, $rules);

        if($dswakses!=null){
            $dswakses = DesaWisataAkses::find($dswakses->id);
        }else{
            $dswakses = new DesaWisataAkses();
        }

            $dswakses->desa_wisata_id =  $request->desa_wisata_id;
            $dswakses->jarak_dari_ibukota = $request->jarak_dari_ibukota;
            $dswakses->waktu_dari_ibukota = $request->waktu_dari_ibukota;
            $dswakses->satuan_prov = $request->satuan_prov;
            $dswakses->jarak_dari_kab = $request->jarak_dari_kab;
            $dswakses->satuan_kab = $request->satuan_kab;
            $dswakses->waktu_dari_kab = $request->waktu_dari_kab;
            $dswakses->jarak_dari_kec = $request->jarak_dari_kec;
            $dswakses->satuan_kec = $request->satuan_kec;
            $dswakses->waktu_dari_kec = $request->waktu_dari_kec;
            $dswakses->kondisi_jalan = $request->kondisi_jalan;
            $dswakses->jenis_kendaraan = $request->jenis_kendaraan;
            $dswakses->kendaraan_umum = $request->kendaraan_umum;
            $dswakses->rambu_petunjuk = $request->rambu_petunjuk;
            $simpan = $dswakses->save();

            if($simpan){
                return  response()->json(['error'=>false,'message'=>'Data Akses Berhasil Disimpan','redirect'=>route('desawisata.create.fasilitas',$request->desa_wisata_id)]);
            }else{
                return response()->json(['error'=>true,'message'=>'Data Akses Gagal Disimpan']);
            }
    }

    public function updateAkses(Request $request)
    {
        $rules = [
            'desa_wisata_id' =>  'required|int|unique:r_desawisata_akses,desa_wisata_id,'.$request->desa_wisata_id,
            'jarak_dari_ibukota' =>  'required|int',
            'satuan_prov' =>  'required|string|max:5',
            'waktu_dari_ibukota' =>  'required|int',
            'jarak_dari_kab' => 'required|int|max:10',
            'satuan_kab' => 'required|string|max:5',
            'waktu_dari_kab' => 'required|string|max:10',
            'jarak_dari_kec' => 'required|string|max:10',
            'satuan_kec' => 'required|string|max:5',
            'waktu_dari_kec' => 'required|string|max:10',
            'kondisi_jalan' => 'required|string|max:10',
            'jenis_kendaraan' => 'required|string|max:50',
            'kendaraan_umum' => 'required|string|max:50',
            'rambu_petunjuk' => 'required|int|max:1',
            'jalur_transport' => 'required|string|max:4000'
        ];

        $this->validate($request, $rules);

        // if ($validator->failed()) {
        //     $errors = $validator->errors();
        //     return response()->json(['message' =>$errors,'error'=>'true'], 201);
        // } else {

            $dswakses =  DesaWisataAkses::where('desa_wisata_id',$request->desa_wisata_id)->first();
            if($dswakses==null){
                $dswakses = new DesaWisataAkses();
            }else{
                $dswakses = DesaWisataAkses::find($dswakses->id);
            }

            $dswakses->desa_wisata_id =  $request->desa_wisata_id;
            $dswakses->jarak_dari_ibukota = $request->jarak_dari_ibukota;
            $dswakses->waktu_dari_ibukota = $request->waktu_dari_ibukota;
            $dswakses->satuan_prov = $request->satuan_prov;
            $dswakses->jarak_dari_kab = $request->jarak_dari_kab;
            $dswakses->satuan_kab = $request->satuan_kab;
            $dswakses->waktu_dari_kab = $request->waktu_dari_kab;
            $dswakses->jarak_dari_kec = $request->jarak_dari_kec;
            $dswakses->satuan_kec = $request->satuan_kec;
            $dswakses->waktu_dari_kec = $request->waktu_dari_kec;
            $dswakses->kondisi_jalan = $request->kondisi_jalan;
            $dswakses->jenis_kendaraan = $request->jenis_kendaraan;
            $dswakses->kendaraan_umum = $request->kendaraan_umum;
            $dswakses->rambu_petunjuk = $request->rambu_petunjuk;
            $dswakses->jalur_transport = $request->jalur_transport;
            $simpan = $dswakses->save();

            if($simpan){
                return  response()->json(['error'=>false,'message'=>'Data Akses Berhasil Diupdate','redirect'=>'backend/editakses/'.$request->desa_wisata_id]);
            }else{
                return response()->json(['error'=>true,'message'=>'Data Akses Gagal Diupdate']);
            }
       // }
    }

    public function createAtraksi($idprofil)
    {
        $title_page = 'Tambah Data Atraksi Desa Wisata';
        $desawisata =  DesaWisata::findOrFail($idprofil);

        if(!isset($desawisata)){
            return redirect()->route('desawisata.create');
        }

        if($desawisata->akses !=null)
            $url = route('desawisata.update.atraksi',$idprofil);
        else
            $url = route('desawisata.store.atraksi',$idprofil);
        $nama_desawisata = ucwords($desawisata->nama_desawisata);

        $jarak = ['m'=>'meter','km'=>'kilo meter','mil'=>'mil'];
        return view('admin.pages.desawisata.create_atraksi', compact('url','title_page','idprofil','nama_desawisata','jarak'))->with('desawisata',$desawisata);
    }

    public function storeAtraksi(Request $request,$idprofil){
        $dswakses =  DesaWisataAkses::where('desa_wisata_id',$request->desa_wisata_id)->first();
        if($dswakses==null){
            $rules = [
                'title' =>  'required|string|max:100|unique:r_desawisata_atraksi,title',
                'daya_tarik' =>  'required',
                'atraksi_id' =>  'required|int',
                'foto_atraksi' =>  'required|string|max:1000',
                'title_foto_atraksi' =>  'required|string|max:1000',
                'video_atraksi' =>  'nullable|string|max:1000',
                'title_video_atraksi' =>  'nullable|string|max:1000',
                'keterangan' =>  'required|string|max:255',
            ];
        }else{
            $rules = [
                'title' =>  'required|string|max:100|unique:r_desawisata_atraksi,title,'.$request->id,
                'daya_tarik' =>  'required',
                'atraksi_id' =>  'required|int',
                'foto_atraksi' =>  'required|string|max:1000',
                'title_foto_atraksi' =>  'required|string|max:1000',
                'video_atraksi' =>  'nullable|string|max:1000',
                'title_video_atraksi' =>  'nullable|string|max:1000',
                'keterangan' =>  'required|string|max:255',
            ];
        }
        $this->validate($request,$rules);
        DB::beginTransaction();
        $error = '';
        try{
            $success = false;

            $dswAtraksi = new DesaWisataAtraksi();
            $dswAtraksi->desawisata_id = $idprofil;
            $dswAtraksi->title = $request->title;
            $dswAtraksi->atraksi_id = $request->atraksi_id;
            $dswAtraksi->keterangan = $request->keterangan;
            $simpan = $dswAtraksi->save();

            if($simpan){
                if($request->foto_atraksi!=null){
                    $file_foto = $request->foto_atraksi;
                    $realfoto = explode(DIRECTORY_SEPARATOR,$file_foto);
                    //$filefoto = str_replace(' ','-',end($realfoto));

                    $ext = explode('.',$filefoto);
                        $ekstensi = end($ext);
                        switch($ekstensi){
                        case 'jpeg': $mime = 'image/jpeg'; break;
                        case 'jpg': $mime = 'image/jpeg'; break;
                        case 'png': $mime = 'image/png'; break;
                        case 'gif': $mime = 'image/gif'; break;
                        }

                    $media = new Media();
                    $media->code_id = $dswAtraksi->id;
                    $media->parent_table = 'r_desawisata_atraksi';
                    $media->mimetype = $mime;
                    $media->extensi =  $ekstensi;
                    $media->title = $request->title_foto_atraksi;
                    $media->narasi = $request->keterangan;
                    $media->url = $request->file_foto;
                    $media->author_id = $idprofil;
                    $media->parent_media = 1;
                    $media->status = 1;
                    $media->filename = $filefoto;
                    $savemedia = $media->save();
                    if($savemedia)
                        $success =true;
                    else{
                        $error .= 'Data Foto tidak berhasil disimpan';
                    }
                }

                if($request->video_atraksi!=null){
                    $file_video = $request->video_atraksi;
                    $realvideo = explode(DIRECTORY_SEPARATOR,$file_video);
                    $filevideo = str_replace(' ','-',end($realvideo));

                    $ext = explode('.',$filevideo);
                    $ekstensi = end($ext);
                    // switch($ekstensi){
                    //     case 'mp4': $mime = 'application/mp4'; break;
                    //     case 'jpg': $mime = 'image/jpeg'; break;
                    //     case 'png': $mime = 'image/png'; break;
                    //     case 'gif': $mime = 'image/gif'; break;
                    // }

                    $mediavideo = new MediaVideo();
                    $mediavideo->code_id = $dswAtraksi->id;
                    $mediavideo->parent_table = 'r_desawisata_atraksi';
                    $mediavideo->mimetype = $mime;
                    $mediavideo->extensi =  $ekstensi;
                    $mediavideo->title = $request->title_video_atraksi;
                    $mediavideo->narasi = $request->keterangan;
                    $mediavideo->url = $file_video;
                    $mediavideo->filename = $filevideo;
                    $mediavideo->cover = $filefoto;
                    $mediavideo->save();
                    $success =true;
                }

            }else{
                $error .= 'Data tidak berhasil disimpan';
            }

        }catch(\Exception $e){
            $error .= $e->getMessage();
        }

        if($success){
             DB::commit();
            return  response()->json(['errors'=>false,'message'=>'Data Atraksi Berhasil Disimpan'],200);
        }else{
            DB::rollback();
            return response()->json(['errors'=>true,'message'=>$error],200);
        }
    }

    public function getAtraksi($idprofil){
        if($idprofil>0){
            $atraksi = DesaWisataAtraksi::with('atraksi')->where('desawisata_id',$idprofil)->get();
            $atraksi->load(['media'=>function($qry){
                 return $qry->where('parent_table','r_desawisata_atraksi')->where('status',1);
            }]);
            $atraksi->load(['media_video'=>function($qry){
                 return $qry->where('parent_table','r_desawisata_atraksi')->where('status',1);
            }]);
            $atrk =[];
           //dd($atraksi);
            if($atraksi!=null){
                foreach($atraksi as $atr){
                    $atrk[] = ['id'=>$atr['id'],'title' => $atr['title'],'atraksi_id' => $atr['atraksi_id'],
                              'tipe' => ucwords($atr->atraksi['tipe']),'kategori' => $atr->atraksi['nama_atraksi'],
                              'foto' => $atr->media,'video'=> $atr->media_video];

                }
                return response()->json(['error'=>false,'atraksi'=>$atrk],200);
            }else
                return response()->json(['error'=>true,'atraksi'=>$atrk],200);
        }else
            return response()->json(['error'=>true,'atraksi'=>[]],200);
    }

    public function createPromosi($idprofil)
    {

        if(!isset($idprofil)){
            return abort('404');
        }

        $title_page = 'Tambah Data Promosi Desa Wisata';
        $desawisata =  DesaWisata::with('promosi')->find($idprofil);

        if($desawisata['promosi']==null || empty($desawisata)){
            return redirect('backend/desawisata/create')->withErrors(['Data Desa Wisata tidak ditemukan silahkan buat dulu']);
        }else{
            $nama_desawisata = $desawisata->nama_desawisata;
            $desawisata = $desawisata->with('promosi.jenis_promosi')->find($idprofil);
            $jenis_promosi = JenisPromosi::all();

            return view('admin.pages.desawisata.create_promosi', compact('title_page','idprofil','nama_desawisata','desawisata','jenis_promosi'));
        }
    }

    public function cekNamaAtraksi(Request $request, $idprofil){
        if($idprofil>0){
            $atraksi = DesaWisataAtraksi::with('atraksi')->where('title','LIKE','%'.$request->title.'%')->where('atraksi_id',$request->atraksi_id)->where('desawisata_id',$idprofil)->get();
            if($atraksi!=null){
                return "false";
            }else
               return "true";
        }else
           return "true";
    }

    public function storePromosi(Request $request, $idprofil)
    {
        $j = $request->j;
        $error ='';
        $errors =[];
        $success = false;
        for($i = 0; $i < $j; $i++){
            //proses id
            DB::beginTransaction();
            try{
                if($request->id[$i] != null){
                    $promoAda = DesaWisataPromosi::find($request->id[$i]);
                    if($promoAda)
                    {
                        $promoAda->desawisata_id = $idprofil;
                        $promoAda->jenis_promosi_id = $request->jenis_promosi_id[$i];
                        if($i==2){
                            $promoAda->url = $request->url;
                        }else{
                            $promoAda->url = '';
                        }
                        $promoAda->note = $request->note[$i];
                        $promoAda->is_ada = $request->input('is_ada'.$i);
                        $promoAda->author_id = auth()->user()->id;
                        $promoAda->updated_at = now();
                        $promoAda->save();
                    }else{
                        //simpan
                        $promo = new DesaWisataPromosi();
                        $promo->desawisata_id = $idprofil;
                        $promo->jenis_promosi_id = $request->jenis_promosi_id[$i];
                        if($i==2){
                            $promo->url = $request->url;
                        }else{
                            $promo->url = '';
                        }
                        $promo->note = $request->note[$i];
                        $promo->is_ada = $request->is_ada.$i;
                        $promo->author_id = auth()->user()->id;
                        $promo->created_at = now();
                        $promo->save();
                    }
                }else{
                    $promo = new DesaWisataPromosi();
                    $promo->desawisata_id = $idprofil;
                    $promo->jenis_promosi_id = $request->jenis_promosi_id[$i];
                    if($i==2){
                        $promo->url = $request->url;
                    }else{
                        $promo->url = '';
                    }
                    $promo->note = isset($request->note[$i])?$request->note[$i]:'';
                    $promo->is_ada = $request->is_ada.$i;
                    $promo->author_id = auth()->user()->id;
                    $promo->created_at = now();
                    $promo->save();
                }
                $success = true;
            }catch(\Exception $e) {
                $error = $e->getMessage().' '.$i;
                $success = false;
            }


            if ($success==false) {
                $errors[] = $error;
            }
        }

        if(count($errors)>0){
            DB::rollback();
            return response()->json(['message ' =>$errors,'error'=>true]);
        }else{
            DB::commit();
            return response()->json(['message ' =>'Data Promosi Berhasil disimpan','error'=>false]);
        }

    }

    public function createFasilitas($idprofil)
    {
        if(!isset($idprofil)){
            return abort('404');
        }

        $title_page = 'Tambah Data Fasilitas Desa Wisata';
        $desawisata =  DesaWisata::with('promosi')->find($idprofil);

        if($desawisata['promosi']==null || empty($desawisata)){
            return redirect('backend/desawisata/create')->withErrors(['Data Desa Wisata tidak ditemukan silahkan buat dulu']);
        }else{
            $nama_desawisata = $desawisata->nama_desawisata;
            $desawisata = $desawisata->with('promosi.jenis_promosi')->find($idprofil);
            $jenis_promosi = JenisPromosi::all();

            return view('admin.pages.desawisata.create_fasilitas', compact('title_page','idprofil','nama_desawisata','desawisata','jenis_promosi'));
        }
    }

    public function editFasilitas($id)
    {
        $title_page = 'Edit Data Fasilitas Desa Wisata';
        $desawisata =  DesaWisata::with('promosi')->find($id);

        if(!isset($desawisata)){
            return redirect()->route('desawisata.index');
        }
        $idprofil = $id;
        $nama_desawisata = $desawisata->nama_desawisata;
        $jenis_promosi = JenisPromosi::all();
        return view('admin.pages.desawisata.edit_fasilitas', compact('title_page','idprofil','nama_desawisata','desawisata','idprofil','jenis_promosi'));
    }

    public function updateFasilitas(Request $request)
    {
        $rules = [
            'nama_promosi'
        ];
    }

    public function createKelsos($idprofil)
    {

        if(!isset($idprofil)){
            return abort('404');
        }

        $title_page = 'Tambah Data Kelompok Sosial Desa Wisata';
        $desawisata =  DesaWisata::findOrFail($idprofil);

        if($desawisata['promosi']==null || empty($desawisata)){
            return redirect('backend/desawisata/create')->withErrors(['Data Desa Wisata tidak ditemukan silahkan buat dulu']);
        }else{
            $nama_desawisata = $desawisata->nama_desawisata;
            $desawisata = $desawisata->with('promosi.jenis_promosi')->find($idprofil);
            $jenis_promosi = JenisPromosi::all();

            return view('admin.pages.desawisata.create_kelsos', compact('title_page','idprofil','nama_desawisata','desawisata','jenis_promosi'));
        }
    }

    public function createUspar($idprofil)
    {

        if(!isset($idprofil)){
            return abort('404');
        }

        $title_page = 'Tambah Usaha Pariwisata Desa Wisata';
        $desawisata =  DesaWisata::findOrFail($idprofil);

        if($desawisata['promosi']==null || empty($desawisata)){
            return redirect('backend/desawisata/create')->withErrors(['Data Desa Wisata tidak ditemukan silahkan buat dulu']);
        }else{
            $nama_desawisata = $desawisata->nama_desawisata;
            $desawisata = $desawisata->with('promosi.jenis_promosi')->find($idprofil);
            $jenis_promosi = JenisPromosi::all();
            $url = route('desawisata.store.uspar',$idprofil);

            return view('admin.pages.desawisata.create_usahapariwisata', compact('title_page','idprofil','nama_desawisata','desawisata','jenis_promosi','url'));
        }
    }

    public function createStat($idprofil)
    {
        if(!isset($idprofil)){
            return abort('404');
        }

        $title_page = 'Tambah Data Statistik Desa Wisata';
        $desawisata =  DesaWisata::findOrFail($idprofil);
        $tahun       = $this->opsiTahun();
        if($desawisata['promosi']==null || empty($desawisata)){
            return redirect('backend/desawisata/create')->withErrors(['Data Desa Wisata tidak ditemukan silahkan buat dulu']);
        }else{
            $nama_desawisata = $desawisata->nama_desawisata;
            $desawisata = $desawisata->with('promosi.jenis_promosi')->find($idprofil);
            $jenis_promosi = JenisPromosi::all();
            $url = route('desawisata.store.uspar',$idprofil);

            return view('admin.pages.desawisata.create_stat', compact('title_page','idprofil','tahun','nama_desawisata','desawisata','jenis_promosi','url'));
        }
    }

    public function createBantuan($idprofil)
    {
        if(!isset($idprofil)){
            return abort('404');
        }

        $title_page = 'Tambah Data Bantuan Desa Wisata';
        $desawisata =  DesaWisata::findOrFail($idprofil);
        $tahun       = $this->opsiTahun();

        if($desawisata['promosi']==null || empty($desawisata)){
            return redirect('backend/desawisata/create')->withErrors(['Data Desa Wisata tidak ditemukan silahkan buat dulu']);
        }else{
            $nama_desawisata = $desawisata->nama_desawisata;
            $desawisata = $desawisata->with('promosi.jenis_promosi')->find($idprofil);
            $jenis_promosi = JenisPromosi::all();
            $url = route('desawisata.store.uspar',$idprofil);
            return view('admin.pages.desawisata.create_bantuan', compact('title_page','idprofil','tahun','nama_desawisata','desawisata','jenis_promosi','url'));
        }
    }

    public function createPenghargaan($idprofil)
    {
        if(!isset($idprofil)){
            return abort('404');
        }

        $title_page = 'Tambah Data Penghargaan Desa Wisata';
        $desawisata =  DesaWisata::findOrFail($idprofil);
        $tahun       = $this->opsiTahun();

        if($desawisata['promosi']==null || empty($desawisata)){
            return redirect('backend/desawisata/create')->withErrors(['Data Desa Wisata tidak ditemukan silahkan buat dulu']);
        }else{
            $nama_desawisata = $desawisata->nama_desawisata;
            $desawisata = $desawisata->with('promosi.jenis_promosi')->find($idprofil);
            $jenis_promosi = JenisPromosi::all();
            $url = route('desawisata.store.uspar',$idprofil);
            return view('admin.pages.desawisata.create_penghargaan', compact('title_page','idprofil','tahun','nama_desawisata','desawisata','jenis_promosi','url'));
        }
    }
    private function resizeThumb($imagePath,$name, $size)
    {
        try {
            $img = Image::make($imagePath);
            $img->resize(intval($size), null, function ($constraint) {
                $constraint->aspectRatio();
            });

            return $img->save($this->photosPath.'/thumb/'. $name);
        } catch (Exception $e) {
            return false;
        }
    }

    private function resize($imagePath,$name, $size)
    {
        try {
            $img = Image::make($imagePath);
            $img->resize(intval($size), null, function ($constraint) {
                $constraint->aspectRatio();
            });

            return $img->save($this->photosPath. $name);
        } catch (Exception $e) {
            return false;
        }
    }

    public function edit($id)
    {
        $title_page      = 'Edit Data Profil Desa Wisata';
        $urlUpdateProfil = "/backend/desawisata/update";
        $urlApiKelurahan = route('api.kelterm', 32);
        $desawisata      = DesaWisata::with('media','kelurahan.kecamatan.kabupaten','akses')->findOrFail($id);
        $nama_desawisata = $desawisata->nama_desawisata;
        $kategori        = ['1'=>'Embrio','2'=>'Berkembang','3'=>'Maju'];
        $opsiTahun       = $this->opsiTahun();

        $desawisata->load(['media_video'=>function($query){
            return $query->where('parent_table','r_desawisata');
        }]);

        if(count($desawisata->media_video)){
            foreach($desawisata->media_video as $mdv){
                $titleVideo = $mdv->title;
                $filenameVideo = $mdv->filename;
                $narasiVideo = $mdv->narasi;
            }
        }else{
            $titleVideo = '';
            $filenameVideo = '';
            $narasiVideo = '';
        }

        return view('admin.pages.desawisata.edit_profil',
            compact('title_page','urlStoreProfil','urlApiKelurahan','desawisata','nama_desawisata','kategori','opsiTahun','titleVideo','filenameVideo','narasiVideo'));
    }

    public function editPengelola($id)
    {
        $title_page = 'Edit Data Pengelola Desa Wisata';
        $desawisata =  DesaWisata::with('pengelola')->find($id);

        if(!isset($desawisata)){
            return redirect()->route('desawisata.create');
        }
        $idprofil = $id;
        $nama_desawisata = $desawisata->nama_desawisata;
        return view('admin.pages.desawisata.edit_pengelola', compact('title_page','idprofil','nama_desawisata','desawisata','idprofil'));
    }

    public function updateprofile(Request $request){
        //dd($request->all());
        $rules = [
            'nama_desawisata' =>  'required|unique:r_desawisata,nama_desawisata,'.$request->id,
            'idcat' => 'required|int',
            'tahun_berdiri' => 'required|int',
            'deskripsi' => 'required|string',
            'kel_id' => 'required',
            'sk_desa' => 'nullable|string',
            'tgl_sk_desa' => 'nullable|date',
            'sk_dinas_kab' => 'nullable|string',
            'tgl_sk_kab' => 'nullable|date',
            'sk_provinsi' => 'nullable|string',
            'tgl_sk_prov' => 'nullable|date',
            'lat' => 'nullable|numeric',
            'longi' => 'nullable|numeric',
            'fotodesawisata' => 'nullable|image|max:5120',
            'video_desawisata' => 'nullable|max:200',
        ];

        $this->validate($request, $rules);
        $success = false;
        $id = null;

        DB::beginTransaction();
        $error = '';
        $name  = '';
        $media = '';

        try {
            $profil =  DesaWisata::find($request->id);
            $profil->nama_desawisata = $request->get('nama_desawisata');
            $profil->slug = str_slug($request->nama_desawisata);
            $profil->idcat = $request->idcat;
            $profil->tahun_berdiri = $request->tahun_berdiri;
            $profil->deskripsi = $request->deskripsi;
            $profil->kel_id = $request->kel_id;
            $profil->sk_desa = $request->sk_desa;
            $profil->tgl_sk_desa = isset($request->tgl_sk_desa)?\Carbon\Carbon::parse($request->tgl_sk_desa)->format('Y-m-d'):null;
            $profil->sk_dinas_kab = $request->sk_dinas_kab;
            $profil->tgl_sk_kab =  isset($request->tgl_sk_kab)?\Carbon\Carbon::parse($request->tgl_sk_kab)->format('Y-m-d'):null;
            $profil->sk_provinsi = $request->sk_provinsi;
            $profil->tgl_sk_prov = isset($request->tgl_sk_prov)?\Carbon\Carbon::parse($request->tgl_sk_prov)->format('Y-m-d'):null;
            $profil->tgl_modif = isset($request->tgl_data)?\Carbon\Carbon::parse($request->tgl_data)->format('Y-m-d h:i:s'):\Carbon\Carbon::now()->format('Y-m-d h:i:s');
            $profil->lat =  (float) str_replace(',', '.', $request->lat);
            $profil->longi =  (float) str_replace(',', '.', $request->longi);
            $profil->status = $request->status;
            $profil->tgl_terdata = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
            $profil->author_id = auth()->user()->id;
            $profil->luas = (float) str_replace(',', '.', $request->luas);
            $profil->batasan_desa = $request->satuan_luas;
            $profil->satuan_luas = $request->batasan_desa;
            $profil->updated_at = \Carbon\Carbon::now()->format('Y-m-d h:i:s');
            $desawisataprofil = $profil->save();

            if ($desawisataprofil) {
                $id = $profil->id;
                if ($request->hasFile('fotodesawisata') && $request->file('fotodesawisata')) {
                    $thefile = $request->file('fotodesawisata');
                    $mimetype = $thefile->getMimeType();
                    $name = $profil->slug.preg_replace('/\s+/', '',$thefile->getClientOriginalName());

                    $extensi = $thefile->getClientOriginalExtension();
                    //$media = new Media();
                    $mediaP = Media::select('media_id')->where('code_id',$request->id)->where('parent_table','r_desawisata')->first();
                    if($mediaP==null){
                        $media  = new Media();
                    }else{
                        $media  = Media::where('media_id',$mediaP->media_id)->first();
                    }
                    $media->code_id = $request->id;
                    $media->parent_table = 'r_desawisata';
                    $media->mimetype = $mimetype;
                    $media->extensi = $extensi;
                    $media->filename = $name;
                    $media->title = isset($request->alt_foto)?$request->alt_foto:$request->nama_desawisata;
                    $media->author_id = auth()->user()->id;
                    $media->narasi =  strip_tags($profil->deskripsi);
                    // $media->filesize = $size;
                    $media->status = $request->status;
                    $media->parent_media =1;
                    $media->updated_at = \Carbon\Carbon::now()->format('Y-m-d H:i:s');

                    if ($media->save()) {
                        //original
                        // $thefile = $thefile->move($this->photosPath, $name);
                        $berhasilSimpan = $thefile->move(public_path('storage/data-desawisata'), $name);
                        if($berhasilSimpan){
                            $resizedImage = $this->resizeThumb(public_path('storage/data-desawisata/'. $name),$name, 300);
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

                if($request->video_profil !=null){
                    $videoL  = MediaVideo::where(['code_id'=>$request->id,'parent_table'=>'r_desawisata'])->first();
                    if($videoL==null){
                        $video = new MediaVideo();
                    }else{
                        $video = MediaVideo::find($videoL->id);
                    }
                    $video->title = $request->video_desawisata;
                    $video->filename = trim(str_replace('local'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'data-video'.DIRECTORY_SEPARATOR,' ',$request->video_profil));
                    $video->filename = trim(str_replace('public'.DIRECTORY_SEPARATOR.'data-video'.DIRECTORY_SEPARATOR,' ',$request->video_profil));
                    $video->created_at = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
                    $video->code_id = $request->id;
                    $video->status = $request->status;
                    $video->author_id = auth()->user()->id;
                    $video->parent_table = 'r_desawisata';
                    $video->parent_media = 1;
                    $video->extensi = last(explode('.',$video->filename));
                    $video->save();
                }
                $success = true;
             }else
                $error .= 'Profil Desa Wisata tidak bisa disimpan';

        } catch (\Exception $e) {
            //return redirect('backend/desawisata/create#step-1')->withErrors($e->getMessage())->withInput();
            //dd($e->getMessage());
            return redirect()->back()->with(['message ' =>$e->getMessage().' '.$error,'errors'=>$e->getMessage().' '.$error]);
        }

        if ($success) {
            DB::commit();
            // return Redirect::back()->withSuccessMessage('Artikel Berhasil Disimpan');
            // return response()->json(['message' =>'Desa Wisata sudah berhasil diinput', 'id'=>$id,'desawisata'=>$profil, 'error'=>false], 200);
            // return array('error'=>false,'message'=>'Data Profil Berhasil Disimpan','idprofil'=>$profil->id);
            return redirect()->route('desawisata.index');
        } else {
            DB::rollback();
            // return response()->json(['message' =>'Desa Wisata Gagal disimpan'.$error,'error'=>'true'], 201);
            return redirect()->back()->with(['errors'=>$error,'message'=>$error]);
        }
    }

    public function opsiTahun()
    {
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

    public function update(Request $request)
    {
        //proses edit
        return $this->updateprofile($request);
    }

    public function show(Request $request, $slug)
    {
        if( $slug == null){
            return redirect()->route('desawisata');
        }

        $title_page = 'Detil Desa Wisata';
        $user = $this->user;
        $filter['slug'] = $slug;
        $desawisata = DesaWisata::showItemDesaWisata($filter);
        // dd($desawisata);
        $fasilitas = DesaWisataFasilitas::with('jenis_fasilitas')->where('desawisata_id',$desawisata[0]->id)->get();
        $fasilitas->load(['media'=>function($query){
            return $query->where('parent_table', 'r_desawisata_fasilitas');
        }]);

        $atraksi = DesaWisataAtraksi::with('atraksi','media')->where('desawisata_id',$desawisata[0]->id)->get();

        $kelsos = DesaWisataKelsos::with('jenis_kelsos')->where('desawisata_id',$desawisata[0]->id)->get();

        $kelsos->load(['media'=>function($query){
            return $query->where('parent_table', 'r_desawisata_kelsos');
        }]);

        $usahapar = DesaWisataUsahaPariwisata::with('jenis_usaha')->where('desawisata_id',$desawisata[0]->id)->get();

        $usahapar->load(['media'=>function($query){
            return $query->where('parent_table', 'r_desawisata_jenis_usaha');
        }]);

        $progbantuan = DesaWisataBantuan::with('program_bantuan')->where('desawisata_id',$desawisata[0]->id)->get();

        $linkBack = route('desawisata.index').'?token='.$request->get('token');
        $respon = ["error" => 'false', 'pesan' => '', 'data' => $desawisata];

       return view('admin.pages.desawisata.desawisata_show',
            compact('title_page','user','linkBack','atraksi','fasilitas','promosi','kelsos','usahapar','progbantuan'))
            ->with('desawisata',$respon);
    }

    public function updatePengelola(Request $request, $id)
    {
        $pengelola = DesaWisataPengelola::where('desa_wisata_id',$id)->first();
        if ($pengelola == null){
            $rules= [
                'nama_pengelola' => 'require|string|max:200|unique:r_desawisata_pengelola,nama_pengelola',
                'pimpinan' => 'require|string|max:200',
                'no_hp'=>'requre|number|max:15',
                'kontak_person'=>'requre|string|max:50',
                'nohp_cp'=>'requre|string|max:50',
                'jabatan'=>'requre|string|max:50',
                'email'=>'requre|email|string|max:200',
                'website'=>'requre|url|max:200',
                'jum_pengurus'=>'requre|int|min:1|max:4',
                'regulasi'=>'requre|string|min:5|max:255'
            ];
        }else{
            $rules= [
                'nama_pengelola' => 'require|string|max:200|unique:r_desawisata_pengelola,nama_pengelola,'.$request->id,
                'pimpinan' => 'require|string|max:200',
                'no_hp'=>'requre|number|max:15',
                'kontak_person'=>'requre|string|max:50',
                'jabatan'=>'requre|string|max:50',
                'nohp_cp'=>'requre|string|max:50',
                'email'=>'requre|email|string|max:200',
                'website'=>'requre|url|max:200',
                'jum_pengurus'=>'requre|int|min:1|max:4',
                'regulasi'=>'requre|string|min:5|max:255'
            ];
        }


        $validator =  Validator::make($request->all(), $rules);

        if ($validator->failed()) {
            $errors = $validator->errors();
            return response()->back()->with('errors',$errors)->withInput();
             //return response()->with(['message' =>'Desa Wisata Gagal disimpan '.$errors,'errors'=>'true','rel'=>'backend/desawisata/create#step-1'], 201)->withInput();
        } else {
            if ($pengelola == null){
                $pengelola = new DesaWisataPengelola();
                $pengelola->nama_pengelola = $request->nama_pengelola;
                $pengelola->pimpinan = $request->pimpinan;
                $pengelola->no_hp = $request->no_hp;
                $pengelola->kontak_person = $request->kontak_person;
                $pengelola->nohp_cp = $request->nohp_cp;
                $pengelola->jabatan = $request->jabatan;
                $pengelola->email = $request->email;
                $pengelola->website = $request->website;
                $pengelola->jum_pengurus = $request->jum_pengurus;
                $pengelola->regulasi = $request->regulasi;
                $pengelola->desa_wisata_id = $id;
                $pengelola->save();
                return response()->json(['error'=>false,'message'=>'Data Pengelola berhasil diupdate']);
            }else{
                $pengelola->nama_pengelola = $request->nama_pengelola;
                $pengelola->pimpinan = $request->pimpinan;
                $pengelola->no_hp = $request->no_hp;
                $pengelola->kontak_person = $request->kontak_person;
                $pengelola->nohp_cp = $request->nohp_cp;
                $pengelola->jabatan = $request->jabatan;
                $pengelola->email = $request->email;
                $pengelola->website = $request->website;
                $pengelola->jum_pengurus = $request->jum_pengurus;
                $pengelola->regulasi = $request->regulasi;
                $pengelola->save();
                return response()->json(['error'=>false,'message'=>'Data Pengelola berhasil diupdate']);
            }
        }

    }

    public function editPromosi($id)
    {
        $title_page = 'Edit Data Promosi Desa Wisata';
        $desawisata =  DesaWisata::with('promosi')->find($id);

        if(!isset($desawisata)){
            return redirect()->route('desawisata.index');
        }
        $idprofil = $id;
        $nama_desawisata = $desawisata->nama_desawisata;
        $jenis_promosi = JenisPromosi::all();
        return view('admin.pages.desawisata.edit_promosi', compact('title_page','idprofil','nama_desawisata','desawisata','idprofil','jenis_promosi'));
    }

    public function updatePromosi(Request $request)
    {
        $rules = [
            'nama_promosi'
        ];
    }

    public function softDeleteDesaWisata($id)
    {
        $desawisata = DesaWisata::findOrFail($id);
        $desawisata->status =2;

        return view('admin.pages.desawisata.desawisata_edit')->with('desawisata', json_decode($desawisata, true));
    }
    public function destroy()
    {
        $desawisata = DesaWisata::where('desawisata_id', $id)->get();
        return view('admin.pages.desawisata.desawisata_edit')->with('desawisata', json_decode($desawisata, true));
    }

    public function getKabIDByKode($kode){
        if($kode!=''){
            $kab = Kabupaten::where('kode_peta',$kode)->first();
            return response()->json(['id'=>$kab->id],'200');
        }else
           return response()->json('error','400');

    }

}
