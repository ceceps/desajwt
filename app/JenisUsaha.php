<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisUsaha extends Model
{
    protected $table ='r_jenis_usaha';
    protected $timestamp = false;
    protected $guarded= [];

    public function desawisata_jenisusaha()
    {
        return $this->hasMany(DesaWisataUsahaPariwisata, 'id', 'jenis_usaha_id');
    }

}
