<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    public $table ='r_provinsi';
    public $incrementing = false;

    private $rules = [
        "name" =>'nama',
        "required" => true,
        "message" => "Harus Diisi"
    ];

    public function kabupaten(){
        return $this->hasMany('App\Kabupaten');
    }
}
