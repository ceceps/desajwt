<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    protected $table= 'r_tags';
    public $timestamps = false;
    protected $guarded = [];

    public function artikel_tags() {
        return $this->hasMany(ArtikelTags::class,'id','tag_id');
    }
}
