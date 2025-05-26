<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisDataStatistik extends Model
{
    protected $table= 'r_jen_statistik';
    public $timestamp = false;
    protected $guarded = [];

    public function desawisata_statistik()
    {
        return $this->hasMany(\App\DesaWisata::class, 'desawisata_id', 'id');
    }
}
