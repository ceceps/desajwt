<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesaWisataDetilDampakBantuan extends Model
{
    protected $table = 'r_desawisata_dampak_bantuan_detil';
    protected $guarded = [];
    protected $timestamp = false;

     public function jenis_uraian_dampak()
    {
        return $this->belongsTo(JenisUraianDampak::class, 'jenis_uraian_id', 'id');
    }
}
