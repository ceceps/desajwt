<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kelurahan;

class KelurahanController extends Controller
{
    public function getKelurahan($idkec)
    {
        $model =  Kelurahan::where('kecamatan_id','=',$idkec)->get();

        if(is_null($model)){
            $respon = ['error'=>true,'pesan'=>'not_found','kelurahan'=>''];
        }else
            $respon = ['error'=>false,'pesan'=>'','kelurahan'=>$model];
        return json_encode($respon);
    }
}
