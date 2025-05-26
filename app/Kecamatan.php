<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = 'r_kecamatan';
    public $incrementing = false;

    public function kelurahan()
    {
        return $this->hasMany(\App\Kelurahan::class);
    }

    public function kabupaten()
    {
        return $this->belongsTo(\App\Kabupaten::class);
    }
}
