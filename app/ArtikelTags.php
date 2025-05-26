<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtikelTags extends Model
{
    protected $table = 'r_artikel_tags';
    public $timestamps = false;
    protected $primaryKey = 'artikel_id';
    protected $fillable = ['artikel_id','tag_id'];

    public function artikel()
    {
        return $this->belongsTo(Artikel::class, 'artikel_id', 'id');
    }

    public function tags()
    {
        return $this->belongsTo(Tags::class, 'tag_id', 'id');
    }

}
