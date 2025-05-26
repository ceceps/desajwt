<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesaWisataPromosi extends Model
{
    protected $table= 'r_desawisata_promosi';
    // public $timestamps = false;
    protected $guarded = [];

    public function desawisata()
    {
        return $this->belongsToMany(DesaWisata::class,'desawisata_id','id');
    }

    public function media()
    {
        return $this->hasMany(Media::class,'code_id','id')->where('parent_table', '=', 'r_desawisata_promosi');
    }

    public function jenis_promosi()
    {
        return $this->belongsTo(JenisPromosi::class,'jenis_promosi_id','id');
    }
}
