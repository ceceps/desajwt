<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "r_category";
    protected $primaryKey = 'idcat';
    public $timestamps = false;

    protected $fillable = [
        'idclass', 'parentid', 'catname', 'catnameen', 'catnamejp', 'narasi'
    ];

    public function desawisata()
    {
        return $this->hasMany(DesaWisata::class, 'idcat', 'idcat');
    }
}
