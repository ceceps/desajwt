<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesaWisataPengelola extends Model
{
    protected $table ='r_desawisata_pengelola';
    protected $guarded = [];
    public $timestamps = false;

    public function desawisata()
    {
        return $this->belongsTo(DesaWisata::class, 'desawisata_id','id');
    }

}
