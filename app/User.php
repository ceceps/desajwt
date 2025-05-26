<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable implements MustVerifyEmail,JWTSubject
{
    use Notifiable, HasRoles, SoftDeletes;


    /**
     * The attributes that are mass assignable.
     * Update : JWT add implements JWYSUbject
     * @var array
     */
    protected $fillable = [
        'name', 'email','telp', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     *  Cascade delete untuk menghapus dg cara softdelet
     */
    protected $cascadeDeletes = ['desawisata','artikel','userProfil','profildesa'];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function artikel()
    {
        return $this->hasMany(Artikel::class, 'author_id', 'id');
    }

    public function userProfil()
    {
        return $this->hasOne(UserProfil::class);
    }

    public function desawisata()
    {
        return $this->hasMany(DesaWisata::class,'author_id','id');
    }

    public function profildesa()
    {
        return $this->hasMany(ProfilDesa::class,'author_id','id');
    }

    public function media()
    {
        return $this->hasMany(Media::class,'author_id','id');
    }
    public function media_video()
    {
        return $this->hasMany(MediaVideo::class,'author_id','id');
    }


}
