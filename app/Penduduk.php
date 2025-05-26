<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    protected $table ='r_profildesa_kependudukan';
    protected $primaryKey ='id';
    protected $guarded = [];

    public function profildesa(){
        return $this->belongsToMany(ProfilDesa::class,'profildesa_id');
    }

}
