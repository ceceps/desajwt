<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfilDesa extends Model
{
    protected $table = 'r_profildesa';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $guarded =[];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];


    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'kel_id', 'id');
    }
    public function penduduk()
    {
        return $this->hasMany(Penduduk::class,'profildesa_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'code_id', 'id')->where('parent_table', '=', 'r_profildesa');
    }
    public function media_video()
    {
        return $this->hasMany(MediaVideo::class, 'code_id', 'id')->where('parent_table', '=', 'r_profildesa');
    }


    public static function getAllDesa($status=1)
    {
        if($status=='all'){
            $all = ProfilDesa::with('kelurahan.kecamatan.kabupaten','user')->paginate(9);
        }else{
            $all = ProfilDesa::with('kelurahan.kecamatan.kabupaten','user')->where('status',$status)->paginate(9);
        }

        $all->load(['media'=>function($query){
          return $query->where('parent_table', '=', 'r_profildesa');
        }]);
        return $all;
    }
}
