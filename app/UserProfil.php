<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfil extends Model
{
    protected $table ='r_users_profil';
    protected $guard = [];
    public $timestamp = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'kel_id', 'id');
    }

}
