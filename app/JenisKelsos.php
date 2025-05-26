<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisKelsos extends Model
{
    protected $table = 'r_jenis_kelsos';
    private $timestamp = false;
    protected $guarded = [];

    public function desa_wisata_kelsos()
    {
        return $this->hasMany(DesaWisataKelsos::class, 'jenis_kelsos_id', 'id');
    }
}
