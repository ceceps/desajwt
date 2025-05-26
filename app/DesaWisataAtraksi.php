<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesaWisataAtraksi extends Model
{
    protected $table = 'r_desawisata_atraksi';
    protected $guarded = [];

    public function atraksi()
    {
        return $this->belongsTo(Atraksi::class);
    }

    public function desawisata()
    {
        return $this->belongsTo(DesaWisata::class);
    }

    public function media()
    {
        return $this->hasMany(Media::class,'code_id','id')->where('parent_table', '=', 'r_desawisata_atraksi');
    }
    public function media_video()
    {
        return $this->hasMany(MediaVideo::class,'code_id','id')->where('parent_table', '=', 'r_desawisata_atraksi');
    }


}
