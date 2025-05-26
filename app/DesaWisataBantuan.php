<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesaWisataBantuan extends Model
{
    protected $table ='r_desawisata_bantuan';
    protected $timestamp = false;
    protected $guarded = [];

    public function desawisata()
    {
        return $this->belongsTo(DesaWisata::class, 'desawisata_id', 'id');
    }
    public function program_bantuan()
    {
        return $this->belongsTo(ProgramBantuan::class, 'prog_bantuan_id', 'id');
    }
}
