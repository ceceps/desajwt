<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Kelurahan extends Model
{
    protected $table = 'r_kelurahan';
    public $incrementing = false;
    private $rules = [
        "name" => 'nama',
        "required" => true,
        "message" => "Harus Diisi"
    ];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function profildesa()
    {
        return $this->hasOne(ProfilDesa::class,'id','kel_id');
    }

    public static function listKelurahanWilayah($idprov=32,$term=''){
        if($term!=''){
            $where = ' and r_kelurahan.nama LIKE "%'.strtoupper($term).'%"';
        }else{
            $where = '';
        }

        $sql = "SELECT
                r_kelurahan.id,
                r_kecamatan.id as kec_id,
                r_kabupaten.id as kab_id,
                r_kelurahan.nama as nama_kel,
                r_kecamatan.nama as nama_kec,
                r_kabupaten.nama as nama_kab,
                CONCAT(r_kelurahan.nama,', KEC.',r_kecamatan.nama,', ',r_kabupaten.nama) as nama
                FROM
                r_kelurahan
                INNER JOIN r_kecamatan ON r_kelurahan.kecamatan_id = r_kecamatan.id
                INNER JOIN r_kabupaten ON r_kecamatan.kabupaten_id = r_kabupaten.id
                INNER JOIN r_provinsi ON r_kabupaten.provinsi_id = r_provinsi.id
                WHERE
                r_provinsi.id = $idprov $where
                ORDER BY  nama_kel
        ";
        $query = DB::select($sql);
        return $query;
    }
}
