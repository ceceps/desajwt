<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SetingSlider extends Model
{
    protected $table ='r_seting_slider';
    protected $guarded = [];

    public static function getAllData(){
        return self::where('status',1)->get();
    }
}
