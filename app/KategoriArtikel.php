<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriArtikel extends Model
{
    protected $table = 'r_artikel_kategori';
    public $timestamps = false;
    public $fillable = ['nama', 'slug'];

    public function artikel()
    {
        return $this->hasMany(Artikel::class, 'id', 'kategori_id');
    }

}
