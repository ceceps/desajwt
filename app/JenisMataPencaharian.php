<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisMataPencaharian extends Model
{
    protected $table = 'r_jenis_matapencaharian';
    protected $timestamp = false;
    protected $fillable = ['nama_mata_pencaharian'];

    //relation
    public function profildesa_matapencaharian()
    {
        return $this->hasMany(ProfilDesaMataPencaharian,'id', 'jenis_matapencaharian_id');
    }
}
