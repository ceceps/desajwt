<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesaWisataFasilitas extends Model
{
    protected $table ='r_desawisata_fasilitas';
    protected $guarded =[];

    public function desawisata()
    {
        return $this->belongsTo(DesaWisata::class, 'desawisata_id','id');
    }

    public function jenis_fasilitas(){
        return $this->belongsTo(JenisFasilitas::class,'jenis_fasilitas_id','id');
    }

    public function media()
    {
        return $this->hasMany(\App\Media::class, 'code_id', 'id')->where('parent_table', '=', 'r_desawisata_fasilitas');
    }
}
