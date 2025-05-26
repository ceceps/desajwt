<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisPromosi extends Model
{
    protected $table = 'r_jenis_promosi';
    private $timestamp = false;
    protected $guarded = [];

    public function desa_wisata_promosi()
    {
        return $this->hasMany(DesaWisataPromosi::class, 'jenis_promosi_id', 'id');
    }
}
