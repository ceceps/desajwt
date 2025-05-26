<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfilDesaMataPencaharian extends Model
{
    protected $table = 'r_profildesa_matapencaharian';
    protected $timestamp = false;
    protected $guarded = [];

    //relation
    public function jenis_matapencaharian()
    {
        return $this->belongsTo(JenisMataPencaharian, 'jenis_matapencaharian_id', 'id');
    }
    //function

    
}
