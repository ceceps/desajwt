<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisUraianDampak extends Model
{
    protected $table = 'r_jenis_uraian_dampak';
    protected $timestamp = false;
    protected $guared = [];

    public function desawisata_detil_dampak_bantuan()
    {
        return $this->hasMany(DesaWisataDampakBantuanDetil, 'id', 'jenis_uraian_id');
    }
}
