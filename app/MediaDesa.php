<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MediaDesa extends Model
{
    protected $table ='r_media_desa';
    protected $guarded = [];
    public $primaryKey ='media_id';

    public function ProfilDesa(){
        $this->belongsTo(\App\ProfilDesa::class);
    }
}
