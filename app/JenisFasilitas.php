<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisFasilitas extends Model
{
    protected $table = 'r_jenis_fasilitas';
    public $timestamps = false;
    protected $guarded = [];

    public function desawisata_fasilitas(){
        return $this->hasMany(DesaWisataasilitas::class,'id','jenis_fasilitas_id');
    }
}
