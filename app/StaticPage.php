<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaticPage extends Model
{
    protected $table = 'r_static_page';
    protected $guarded = [];

    public static function getAllData($kategori='kategori'){
        $page = self::where('kategori',$kategori)->get();
        return $page;
    }
}
