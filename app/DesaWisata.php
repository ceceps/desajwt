<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
class DesaWisata extends Model
{
    use SoftDeletes;

    protected $table = 'r_desawisata';
    public $timestamps = false;
    protected $guarded = [];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'kel_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'idcat', 'idcat');
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'code_id', 'id')->where('parent_table', '=', 'r_desawisata');
    }

    public function media_video()
    {
        return $this->hasMany(MediaVideo::class,'code_id','id')->where('parent_table', '=', 'r_desawisata');
    }

    public function akses()
    {
        return $this->hasOne(DesaWisataAkses::class);
    }

    public function promosi()
    {
        return $this->hasMany(DesaWisataPromosi::class,'desawisata_id','id');
    }

    public function pengelola()
    {
        return $this->hasOne(DesaWisataPengelola::class);
    }
    public function fasilitas()
    {
        return $this->hasMany(DesaWisataFasilitas::class,'desawisata_id','id');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public static function getAllDesaWisata($imageFeature = true,$paging=9,$filter=[])
    {
       //dd($filter);
       if(count($filter)>0){

          $query = self::with('kelurahan.kecamatan.kabupaten','category');
          if (isset($filter['status']))
          {
            $query =  $query->where('status', $filter['status']);
          }
          if (isset($filter['cari']))
          {
            $query =  $query->where('nama_desawisata', 'LIKE', '%' . $filter['cari'] . '%');
          }

          if(isset($filter['kabupaten_id']) && $filter['kabupaten_id']>0){
            $query = $query->where('kabupaten_id',$filter['kabupaten_id']);
          }

          if(isset($filter['kategori_id']) && $filter['kategori_id']>0){
            $query =  $query->where('idcat',$filter['kategori_id']);
          }
          if($paging>0) $query =  $query->paginate($paging);


        }else{
           if($paging>0) $query = self::with('kelurahan.kecamatan.kabupaten','category')->paginate($paging);
            else
              $query = self::with('kelurahan.kecamatan.kabupaten','category');
        }

        return $query;
    }

    public static function getJumDesaWisataInKab($idprov = 32)
    {
        $sql = "SELECT
                rk.id,
                Trim(Replace(rk.nama, 'KABUPATEN', '')) AS nama,
                (SELECT
                 count(*) as jumdes
                FROM
                    r_kelurahan
                    INNER JOIN r_desawisata ON r_desawisata.kel_id = r_kelurahan.id
                    INNER JOIN r_kecamatan ON r_kelurahan.kecamatan_id = r_kecamatan.id
                    INNER JOIN r_kabupaten ON r_kecamatan.kabupaten_id = r_kabupaten.id
                    where r_kabupaten.id = rk.id and r_kabupaten.provinsi_id=" . $idprov . "
                ) as jumdes,
                kode_peta
            FROM r_kabupaten rk
            where rk.provinsi_id= " . $idprov . "
            order by jumdes desc
        ";
        $query = DB::select($sql);
        return $query;
    }

    public static function getJumDesaWisataAllCat(){
        $sql = "select
            (SELECT count(*) as jum from r_desawisata where idcat=1) as jum_embrio,
            (SELECT count(*) as jum from r_desawisata where idcat=2) as jum_maju,
            (SELECT count(*) as jum from r_desawisata where idcat=3) as jum_berkembang
            from r_desawisata GROUP BY jum_embrio";
        $query = DB::select($sql);
        return $query;
    }

    public static function showItemDesaWisata($filter = [])
    {
        if (isset($filter['id'])) {
            $all = DesaWisata::with('kelurahan.kecamatan.kabupaten','akses','pengelola')->with(
                    array('media' => function ($query) {
                        $query->select('filename', 'media_id')->where('parent_table', '=', 'r_desawisata')->select('*')->where('parent_media', '=', 1)->where('status','=',1);
                    })
                )->where('id', $filter['id'])->get();
        } else if (isset($filter['slug'])) {
            $all = DesaWisata::with('kelurahan.kecamatan.kabupaten','akses','pengelola')->with(
                    array('media' => function ($query) {
                        $query->select('filename', 'media_id','title','narasi')->where('parent_table', '=', 'r_desawisata')->select('*')->where('parent_media', '=', 1)->where('status','=',1);
                    })
                )->where('slug', $filter['slug'])->get();
        } else {
            $all = [];
        }

        return $all;
    }



}
