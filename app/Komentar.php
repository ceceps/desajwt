<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Komentar extends Model
{
    protected $table = 'r_komentar';

    use SoftDeletes;
   
    protected $dates = ['deleted_at'];
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'obj_id','model_type', 'parent_id', 'message'];
   
    /**
     * The belongs to Relationship
     *
     * @var array
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
   
    /**
     * The has Many Relationship
     *
     * @var array
     */
    public function replies()
    {
        return $this->hasMany(Komentar::class, 'parent_id');
    }
}
