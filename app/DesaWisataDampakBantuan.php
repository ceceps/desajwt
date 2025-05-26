<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesaWisataDampakBantuan extends Model
{
    protected $table ='r_desawisata_uraian_dampak';
    protected $timestamp = false;
    protected $guarded = [];

    public function desawisata()
    {
        return $this->belongsTo(DesaWisata::class, 'desawisata_id', 'id');
    }


}
