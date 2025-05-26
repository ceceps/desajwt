<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgramBantuan extends Model
{
    protected $table = 'r_prog_bantuan';
    protected $timestamp = false;
    protected $guarded = [];

    public function desawisata_bantuan()
    {
        return $this->hasMany(DesaWisataBantuan, 'id', 'prog_bantuan_id');
    }


}
