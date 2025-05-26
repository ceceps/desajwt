<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesaWisataStatistik extends Model
{
    protected $table= 'r_desawisata_statistik';
    public $timestamp = false;
    protected $guarded = [];

    public function desawisata()
    {
        return $this->hasMany(DesaWisata::class, 'desawisata_id', 'id');
    }
    public function jenis_data_statistik()
    {
        return $this->hasMany(JenisdataStatistik::class, 'jen_statistik_id', 'id');
    }
}
