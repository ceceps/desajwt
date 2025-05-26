<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesaWisataAkses extends Model
{
    protected $table = 'r_desawisata_akses';
    protected $primaryKey = 'id';
    public $guarded = ['*'];
    public $timestamps = false;
    
    public function desawisata()
    {
        return $this->belongsTo(DesaWisata::class, 'desawisata_id', 'id');
    }
}
