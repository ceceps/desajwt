<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesaWisataUsahaPariwisata extends Model
{
    protected $table='r_desawisata_jenis_usaha';
    protected $guarded = [];

    public function desawisata()
    {
        return $this->belongsTo(DesaWisata::class, 'desawisata_id', 'id');
    }

    public function jenis_usaha()
    {
        return $this->belongsTo(JenisUsaha::class, 'jenis_usaha_id', 'id');
    }
    public function media()
    {
        return $this->hasMany(\App\Media::class, 'code_id', 'id')->where('parent_table', '=', 'r_desawisata_jenis_usaha');
    }


}
