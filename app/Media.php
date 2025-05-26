<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table ='r_media';
    public $primaryKey ='media_id';
    public $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

}
