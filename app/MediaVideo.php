<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MediaVideo extends Model
{
    protected $table = 'r_media_video';
    protected $primaryKey = 'media_id';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class,  'id','author_id');
    }

}
