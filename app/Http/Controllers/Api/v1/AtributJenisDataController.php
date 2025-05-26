<?php
namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;

use App\Atraksi;
use App\JenisUsaha;
use App\JenisDataStatistik;
use App\JenisUraianDampak;
use App\JenisFasilitas;
use App\JenisKelsos;
use App\JenisPromosi;
use Request;

class AtributJenisDataController extends Controller
{

    public function getComboJenisAtraksi($tipe='alam')
    {
        $data = [];
        $request = Request();

        if($tipe =='budaya' || $tipe =='alam' || $tipe =='buatan'){
            if($request->has('search')){
                $search = $request->search;
                $data = Atraksi::select('nama_atraksi as text','id')
                ->where('tipe', $tipe)->where('nama_atraksi', 'like', '%'.$search.'%')
                ->orderBy('nama_atraksi')->get();
            }else{
                $data = Atraksi::select('nama_atraksi as text','id')
                ->where('tipe', $tipe)
                ->orderBy('nama_atraksi')->get();
            }
        }
        return response()->json($data);
    }

    public function getComboJenisFasilitas()
    {
        $data = [];
        $request = Request();
        if($request->has('search')){
            $search = $request->search;
            $data = JenisFasilitas::select('jenis_fasilitas as text', 'id')->where('jenis_fasilitas', 'like', '%'.$search.'%')->get();
        }else{
            $data = JenisFasilitas::select('jenis_fasilitas as text', 'id')->get();
        }
        return response()->json($data);
    }

    public function getComboJenisKelsos()
    {
        $data = [];
        $request = Request();
        if($request->has('search')){
            $search = $request->search;
            $data = JenisKelsos::select('nama_kelsos as text', 'id')->where('nama_kelsos', 'like', '%'.$search.'%')->get();
        }else{
            $data = JenisKelsos::select('nama_kelsos as text', 'id')->get();
        }
        return response()->json($data);
    }

    public function getComboJenisUsaha()
    {
        $data = [];
        $request = Request();
        if($request->has('search')){
            $search = $request->search;
            $data = JenisUsaha::select('nama_jenis_usaha as text', 'id')->where('nama_jenis_usaha', 'like', '%'.$search.'%')->get();
        }else{
            $data = JenisUsaha::select('nama_jenis_usaha as text', 'id')->get();
        }
        return response()->json($data);
    }

    public function getComboJenisStatistik()
    {
        $data = [];
        $request = Request();
        if($request->has('search')){
            $search = $request->search;
            $data = JenisDataStatistik::select('jenis_data as text', 'id')->where('jenis_data', 'like', '%'.$search.'%')->get();
        }else{
            $data = JenisDataStatistik::select('jenis_data as text', 'id')->get();
        }
        return response()->json($data);
    }

    public function getComboJenisDampak()
    {
        $data = [];
        $request = Request();
        if($request->has('search')){
            $search = $request->search;
            $data = JenisUraianDampak::select('nama_uraian as text', 'id')->where('nama_uraian', 'like', '%'.$search.'%')->get();
        }else{
            $data = JenisUraianDampak::select('nama_uraian as text', 'id')->get();
        }
        return response()->json($data);
    }

}

