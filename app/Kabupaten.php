<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    protected $table = 'r_kabupaten';
    public $incrementing = false;

    public function kecamatan()
    {
        return $this->hasMany('App\Kecamatan');
    }

    public function provinsi()
    {
        return $this->belongsTo('App\Provinsi', 'id_prov', 'id');
    }

    public function getKodePeta($val)
    {
        return $this->attributes['kode_peta'] = $val;
    }
}
