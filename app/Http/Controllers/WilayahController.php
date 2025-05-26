<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kabupaten;
use App\Kecamatan;
use App\Kelurahan;
use Input;
class WilayahController extends Controller
{
    public function getKabByProvinsi($idprov)
    {

        $model = Kabupaten::where('provinsi_id', '=', $idprov)->get();

        if (is_null($model)) {
            $respon = ['error' => true, 'pesan' => 'not_found', 'kabupaten' => ''];
        } else
            $respon = ['error' => false, 'pesan' => '', 'kabupaten' => $model];
        return json_encode($respon);
    }

    public function getKecamatan($idkab, Request $req)
    {
        if($req->get('csrf-token') != null){
            $model = Kecamatan::where('kabupaten_id', '=', $idkab)->get();

            if (is_null($model)) {
                $data = ['error' => 'true', 'pesan' => 'not_found', 'kecamatan' => ''];
            } else
                $data = ['error' => 'false', 'pesan' => '', 'kecamatan' => $model];

            // dd($respon);
            return json_encode($data);
        }else{
            $data = ['error' => 'true', 'pesan' => 'failed request'];
            return json_encode($data);
        }
    }

    public function getKelurahan($idkec)
    {
        $model = Kelurahan::where('kecamatan_id', '=', $idkec)->get();

        if (is_null($model)) {
            $respon = ['error' => true, 'pesan' => 'not_found', 'kelurahan' => ''];
        } else
            $respon = ['error' => false, 'pesan' => '', 'kelurahan' => $model];
        return json_encode($respon);
    }

    public function getAllKelurahan($idprov, Request $req){

        $kel = Kelurahan::listKelurahanWilayah($idprov,$req->input("term"));
        if (is_null($kel)) {
            $respon = ['error' => true, 'pesan' => 'not_found', 'kelurahan' => ''];
        } else
            $respon = ['error' => false, 'pesan' => '', 'kelurahan' => $kel];
        return json_encode($respon);
    }

    public function getKelurahanProv($idprov, Request $req){
        $kel = Kelurahan::listKelurahanWilayah($idprov,$req->term);
        if (is_null($kel)) {
            $respon = [];
        }else {
            $respon = $kel;
        }
        return json_encode($respon);
    }


}
