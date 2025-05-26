<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atraksi extends Model
{
    protected $table = 'r_atraksi';
    public $timestamps = false;
    protected $guarded = [];
    private $rules = [
        "name" => 'nama_atraksi',
        "required" => true,
        "message" => "Harus Diisi"
    ];




}
