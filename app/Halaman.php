<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Halaman extends Model
{
    protected $table ='r_halaman';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function media(){
        return $this->hasMany(Media::class,'code_id','id')->where('parent_table','r_halaman');
    }
}
