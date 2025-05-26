<?php
namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transformers\DesaWisataTransformer;
use App\Transformers\DesaWisataAksesTransformer;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use DB;
use Input;
use Image;
use App\DesaWisata;
use App\Media;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class DesaWisataController extends Controller
{
    private $photosPath;
    protected $user;

    public function __construct()
    {
        //$this->user = JWTAuth::parseToken()->authenticate();
        // $this->middleware('jwt.auth');
        $this->photosPath = storage_path('app/public/data-desawisata');
    }

    public function index(Request $request)
    {

        if ($request->get('cari') || $request->get('kabupaten_id')){

        }
        return $this->user
            ->desawisata()
            ->get(['nama_desawisata', 'slug', 'deskripsi'])
            ->toArray();
    }



    public function show($id)
    {
        $desawisata = $this->user->desawisata()->findOrFail($id);

        if (!$desawisata) {
            return response()->json([
                'success' => false,
                'message' => 'Maaf, Desa Wisata dg id ' . $id . ' tidak ditemukan'
            ], 400);
        }

        return $desawisata;
    }

    public function getAllDesaWisataCached()
    {
        if (Cache::has('alldesawisata')) {
            $allData = Cache::get('alldesawisata');
        //return $this->getDesaWisata();
        } else {
            $allData = $this->getDesaWisata();
            Cache::remember('alldesawisata', 22 * 60, function () {
                return $this->getDesaWisata();
            });
        }
        return $allData;
    }

    public function storeWeb(Request $request)
    {

        $desawisata = $this->storeprofil($request);
        dd($desawisata);
        $respon = json_decode($desawisata);
        if ($respon['error']) {
            return response()->json(['success' => true]);
        } else {
            return response()->json([
                'success' => false,
                'message' => $desawisata['message']
            ], 500);
        }
    }
    public function storeprofil(Request $request)
    {
         $rules = [
            // 'nama_desawisata' =>  'required|unique:r_artikel,judul,'.$artikel->artikel_id,
            'nama_desawisata' =>  'required|unique:r_desawisata,nama_desawisata',
            'idcat' => 'required|int',
            'tahun_berdiri' => 'required|int',
            'deskripsi' => 'required',
            'kel_id' => 'required',
            'sk_desa' => 'required',
            'tgl_sk_desa' => 'required|date_format:d-m-Y',
            'lat' => 'required',
            'longi' => 'required',
            'fotodesawisata' => 'required|file|max:5120',
        ];

        $validator =  Validator::make($request->all(), $rules);

        if ($validator->failed()) {
            $errors = $validator->errors();
            return response()->json(['message' =>$errors,'error'=>'true'], 201);
        // return response()->json(['message' =>'Desa Wisata Gagal disimpan '.$errors,'error'=>'true','rel'=>'backend/desawisata/create#step-1'], 201);
        } else {
            // assume it won't work
            $success = false;
            $id = null;

            DB::beginTransaction();
            $profil = new DesaWisata();
            $error ='';
                $name ='';
                $media = '';
            try {
                // Simpan data Profil
                $profil->nama_desawisata = $request->get('nama_desawisata');
                $profil->slug = str_slug($request->nama_desawisata);
                $profil->idcat = $request->idcat;
                $profil->tahun_berdiri = $request->tahun_berdiri;
                $profil->deskripsi = $request->deskripsi;
                $profil->kel_id = $request->kel_id;
                $profil->sk_desa = $request->sk_desa;
                $profil->tgl_sk_desa = date_format('Y-m-d',$request->tgl_sk_desa);
                $profil->sk_dinas_kab = $request->sk_dinas_kab;
                $profil->tgl_sk_kab = $request->tgl_sk_kab;
                $profil->sk_provinsi = $request->sk_provinsi;
                $profil->tgl_sk_prov = $request->tgl_sk_prov;
                $profil->lat = $request->lat;
                $profil->longi = $request->longi;
                $profil->status = $request->status;
                $desawisataprofil = $profil->save();

                if ($desawisataprofil) {
                    $id = $profil->id;
                    if ($request->hasFile('fotodesawisata') && $request->file('fotodesawisata')->isValid() ) {
                        $thefile = $request->file('fotodesawisata');
                        $mimetype = $thefile->getMimeType();
                        $name = $profil->slug.$thefile->getClientOriginalName();

                        $extensi = $thefile->getClientOriginalExtension();

                        $media = new Media();
                        $media->code_id = $profil->id; //last id profil desawisata
                        $media->parent_table = 'r_desawisata';
                        // $media->mimetype = $mimetype;
                        $media->extensi = $extensi;
                        $media->filename = $name;
                        $media->title = $profil->nama_desawisata;
                        $media->author_id = auth()->user()->id;
                        $media->narasi =  substr($profil->deskripsi,0,100);
                        // $media->filesize = $size;
                        $media->status = 1;
                        $media->parent_media =1;
                        $media->created_at = Carbon::now()->format('Y-m-d H:i:s');


                        if ($media->save()) {
                            //original
                            // $thefile = $thefile->move($this->photosPath, $name);
                            $thefile->move(storage_path('app/public/data-desawisata'), $name);
                            $resizedImage = $this->resize(storage_path('app/public/data-desawisata/'. $name),$name, 300);
                            //copy(storage_path('app/public/data-desawisata/thumb/').$name);
                            if (!$resizedImage) {
                                $error.= 'Berhasil diupload tapi tdk bisa diresize<br>';
                            }else
                               $success = true;
                        } else {
                            $error .= 'Profil Desa Wisata tidak bisa disimpan';
                        }
                    }else
                         $error .= ' Foto Profil Desa Wisata tidak bisa disimpan';

                 }else
                    $error .= 'Profil Desa Wisata tidak bisa disimpan';

            } catch (\Exception $e) {
                // return redirect('backend/desawisata/create#step-1')->withErrors($e->getMessage())->withInput();
                return response()->json(['message ' =>$e->getMessage().' '.$error,'error'=>true], 201);
            }

            if ($success) {
                DB::commit();
                // return Redirect::back()->withSuccessMessage('Artikel Berhasil Disimpan');
                // return response()->json(['message' =>'Desa Wisata sudah berhasil diinput', 'id'=>$id,'desawisata'=>$profil, 'error'=>false], 200);
                return array('error'=>false,'message'=>'');
            } else {
                DB::rollback();
                // return response()->json(['message' =>'Desa Wisata Gagal disimpan'.$error,'error'=>'true'], 201);
                return array('error'=>true,'message'=>$error);
            }
        }
    }

    public function update(Request $request, $id)
    {
        $desawisata = $this->user->desawisata()->find($id);

        if (!$desawisata) {
            return response()->json([
                'success' => false,
                'message' => 'Maaf, desawisata dg id ' . $id . ' tidak dapat ditemukan'
            ], 400);
        }

        $updated = $desawisata->fill($request->all())
            ->save();

        if ($updated) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, desawisata could not be updated'
            ], 500);
        }
    }

    public function destroy($id)
    {
        $desawisata = $this->user->desawisatas()->find($id);

        if (!$desawisata) {
            return response()->json([
                'success' => false,
                'message' => 'Maaf, desawisata dg id ' . $id . ' tidak dapat ditemukan'
            ], 400);
        }

        if ($desawisata->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'desawisata tidak dapat dihapus'
            ], 500);
        }
    }

    public static function getDesaWisata()
    {
        $all = DesaWisata::getAllDesaWisata();

        //return fractal()->collection($all, new DesaWisataTransformer)->toJson();
        // $respon = ["error"=>'false','pesan'=>'','desawisata'=>$all];
        $respon = $all;
        return $respon;
    }




    public function storepengelola($iddesawisata){
        if ($iddesawisata<=0){
            return response()->json(['message' =>'Desa Pengelola Gagal disimpan, ID Desa Wisata Kosong','error'=>'true'], 201);
        }else{

        $rules = [
            'nama_unit' => 'required|max:50|unique:r_desawisata_pengelola',
            'nama_pimpinan' => 'required',
            'nohp_pemimpin' => 'required|max:20',
            'kontak_person' => 'required|max:50',
            'jabatan' => 'required|max:50',
            'hp_cp' => 'required|max:50',
        ];

            return response()->json(['message' =>'Desa Wisata sudah berhasil diinput', 'id'=>$id,'desawisata'=>$profil, 'error'=>false], 200);
        }
    }

    private function resize($imagePath,$name, $size)
    {
        try {

            //$imageManager = new ImageManager(); // use this if you don't want facade style code
            //$img = $imageManager->make($imageRealPath);

            $img = Image::make($imagePath); // use this if you want facade style code
            $img->resize(intval($size), null, function ($constraint) {
                $constraint->aspectRatio();
            });
            return $img->save($this->photosPath.'/thumb/'. $name);
        } catch (Exception $e) {
            return false;
        }
    }

    public function postUpload()
    {
        $file = Input::file('file');
        $destinationPath = 'uploads';
        // If the uploads fail due to file system, you can try doing public_path().'/uploads'
        $filename = str_random(12);
        //$filename = $file->getClientOriginalName();
        //$extension =$file->getClientOriginalExtension();
        $upload_success = Input::file('file')->move($destinationPath, $filename);

        $photos = $request->file('file');

        if (!is_array($photos)) {
            $photos = [$photos];
        }

        if (!is_dir($this->photosPath)) {
            mkdir($this->photosPath, 0777);
        }

        for ($i = 0; $i < count($photos); $i++) {
            $photo = $photos[$i];
            $name = sha1(date('YmdHis') . str_random(30));
            $save_name = $name . '.' . $photo->getClientOriginalExtension();
            $resize_name = $name . str_random(2) . '.' . $photo->getClientOriginalExtension();

            Image::make($photo)
                ->resize(250, null, function ($constraints) {
                    $constraints->aspectRatio();
                })
                ->save($this->photosPath . '/' . $resize_name);

            $photo->move($this->photosPath, $save_name);

            $upload = new Upload();
            $upload->filename = $save_name;
            $upload->resized_name = $resize_name;
            $upload->original_name = basename($photo->getClientOriginalName());
            $upload->save();
        }
        return Response::json([
            'message' => 'Image saved Successfully'
        ], 200);
    }


    // public function index(Request $request)
    // {
    //     $title_page = 'Data Desa Wisata';
    //     $allData = $this->getAllDesaWisataCached();
    //     return view('admin.pages.desawisata.desawisata_list')->with('desawisata', json_decode($allData, true))->with('title_page', $title_page);
    // }
}
