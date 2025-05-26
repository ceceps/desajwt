<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesaWisataKelsos extends Model
{
    protected $table = 'r_desawisata_kelsos';
    public $timestamp = false;
    protected $guaded = [];

    public function jenis_kelsos()
    {
        return $this->belongsTo(JenisKelsos::class, 'jenis_kelsos_id', 'id');
    }
    public function desawisata()
    {
        return $this->belongsTo(DesaWisata::class, 'desawisata_id', 'id');
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'code_id', 'id')->where('parent_table','r_desawisata_kelsos');
    }
}
