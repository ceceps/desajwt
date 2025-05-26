<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

use App\ProfilDesa;
use App\Kelurahan;
use Validator;

class ProfilDesaController extends Controller
{

    protected $statusCodes = [
        'done' => 200,
        'created' => 201,
        'removed' => 204,
        'not_valid' => 400,
        'not_found' => 404,
        'conflict' => 409,
        'permissions' => 401
    ];

    public function all()
    {
        $profildesa = ProfilDesa::with('user')
            ->join('r_media', 'r_profildesa.id', '=', 'r_media.code_id')->where('r_media.parent_table', '=', 'r_profildesa')->where('parent_media', '=', 1)
            ->join('r_kelurahan', 'r_profildesa.kel_id', '=', 'r_kelurahan.id')
            ->join('r_kecamatan', 'r_kelurahan.kecamatan_id', '=', 'r_kecamatan.id')
            ->join('r_kabupaten', 'r_kecamatan.kabupaten_id', '=', 'r_kabupaten.id')
            ->select('r_profildesa.*', 'r_kelurahan.nama as nama_kel', 'r_kecamatan.nama as nama_kec', 'r_kabupaten.nama as nama_kab', 'r_media.filename')
            ->get();
        //$respon = ['error'=>false,'pesan'=>'','provinsi'=>$m::all()];
        return $this->respond('done', $profildesa);
    }

    public function show(ProfilDesa $profildesa){

    }

    public function store(Request $request)
    {
        $rules = [
            "kel_id" => 'required|int|unique:r_profildesa,kel_id',
            "pendirian_sk" => 'required|max:50|unique:r_profildesa,pendirian_sk,',
            "kades" => 'required|max:50',
            "tgl_sk_pendirian" => 'required',
            "author_id" => 'required',
            "status" => 'required',
            "no_hp" => 'required|max:50',
            "deskripsi" => 'required|max:255',
            "fotoprofil" => 'required|image',
            "data_tahun" => 'required|int|min:4|max:4',
            "jum_penduduk" => 'required|int|min:1',
            "jum_pria" => 'required|int|min:1',
            "jum_wanita" => 'required|int|min:1',
            "jum_kk" => 'required|int|min:1',
            "lulus_sd" => 'required|int|min:1',
            "lulus_smp" => 'required|int|min:1',
            "lulus_smu" => 'required|int|min:1',
            "lulus_s1" => 'required|int|min:1',
            "lulus_s2" => 'required|int|min:1',
            "tdk_sekolah" => 'required|int|min:1',
            "data_tahun_pend" => 'required|int|min:4|max:4',
            "jenis_pencaharian_id" => 'required|int|min:1',
            "jumlah" => 'required|int|min:1',
            "data_tahun_penchr" => 'required|int|min:4|max:4',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->failed()) {
            return $this->respond('not_valid', ['error' => 'true', 'message' => $validator->error()]);
        } else {
            $success = false;

            $kelurahan = Kelurahan::findOrFail($request->kel_id);
            if ($kelurahan!=null) {
                $nama_kelurahan = $kelurahan->nama;
                $slug = str_slug('Desa '.$nama_kelurahan);
            } else {
                $slug ='';
            }


            $pdesa = new ProfilDesa();
            $pdesa->kel_id = $request->kel_id;
            $pdesa->slug = $slug;
            $pdesa->pendirian_sk = $request->pendirian_sk;
            $pdesa->tgl_sk_pendirian = $request->tgl_sk_pendirian;
            $pdesa->no_hp = $request->no_hp;
            $pdesa->deskripsi = $request->deskripsi;
            $pdesa->kades = $request->kades;
            $pdesa->author_id = $request->author_id;
            $pdesa->status = $request->status;
            $pdesa->data_tahun = $request->data_tahun;
            $simpanProfil = $pdesa->save();
            $error = '';

            if ($simpanProfil) {
                $id = $pdesa->id;
                if ($request->hasFile('fotoprofil') && $request->file('fotoprofil')->isValid()) {
                    $thefile = $request->file('fotoprofil');
                    $mimetype = $thefile->getMimeType();
                    $name = $pdesa->slug.$thefile->getClientOriginalName();

                    $extensi = $thefile->getClientOriginalExtension();

                    $media = new Media();
                    $media->code_id = $simpanProfil->id; //last id profil desawisata
                    $media->parent_table = 'r_profildesa';

                    $media->extensi = $extensi;
                    $media->filename = $name;
                    $media->title = $simpanProfil->nama_desawisata;
                    $media->author_id = auth()->user()->id;
                    $media->narasi = substr($simpanProfil->deskripsi, 0, 100);

                    $media->status = 1;
                    $media->parent_media = 1;
                    $media->created_at = Carbon::now()->format('Y-m-d H:i:s');

                    if ($media->save()) {
                        //original
                        // $thefile = $thefile->move($this->photosPath, $name);
                        $thefile->move(storage_path('app/public/data-profildesa'), $name);
                        $resizedImage = $this->resize(storage_path('app/public/data-profildesa') . '/' . $name, $name, 300);
                        //copy(storage_path('app/public/data-desawisata/thumb/').$name);
                        if (!$resizedImage) {
                            $error .= 'Berhasil diupload tapi tdk bisa diresize<br>';
                        } else {
                            $success = true;
                        }
                    } else {
                        $error .= 'Profil Desa Wisata tidak bisa disimpan';
                    }
                } else {
                    $error .= ' Foto Profil Desa Wisata tidak bisa disimpan';
                }
            } else {
                $error .= ' Data Gagal disimpan';
            }

            if ($success) {
                return $this->respond('done', ['error' => 'false', 'message' => 'Data Berhasil disimpan']);
            } else {
                return $this->respond('not_valid', ['error' => 'false', 'message' => $error]);
            }
        }
    }

    private function resize($imagePath,$name, $size)
    {
        try {
            $img = Image::make($imagePath); // use this if you want facade style code
            $img->resize(intval($size), null, function ($constraint) {
                $constraint->aspectRatio();
            });
            return $img->save($imagePath. '/thumb/'. $name);
        } catch (Exception $e) {
            return false;
        }
    }

    protected function respond($status, $data = [])
    {
        $headers = [
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Headers' => 'Origin,X-CSRF-TOKEN, Content-Type, Authorization',
            'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS'
        ];
        return response()->json($data, $this->statusCodes[$status], $headers);
    }
}


