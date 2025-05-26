<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Artikel extends Model
{
    use SoftDeletes;

    protected $table = 'r_artikel';
    // public $primaryKey = 'artikel_id';
    protected $guarded = [];


    protected $dates = ['created_at','updated_at','deleted_at'];


    // public $fillable = ['judul','artikel_id','konten','tag','slug','kategori_id'];

    public function artikel_tags()
    {
        return $this->hasMany(ArtikelTags::class, 'artikel_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function user_profil()
    {
        return $this->belongsTo(UserProfil::class, 'author_id', 'user_id');
    }

    public function kategori_artikel()
    {
        return $this->belongsTo(KategoriArtikel::class, 'kategori_id', 'id');
    }

    public function media()
    {
        return $this->hasMany('App\Media', 'code_id', $this->primaryKey)->where('parent_table', '=', $this->table);
    }

    public function komentar()
    {
        return $this->hasMany(Komentar::class)->whereNull('parent_id');
    }

    public static function getArtikelMedia($limit = 4){
        if ($limit>4){
            $artikel = Artikel::with('user','kategori_artikel')->orderBy('id','desc')->where('status', 1)->paginate($limit);
        }else{
            $artikel = Artikel::with('user')->orderBy('id','desc')->where('status', 1)->take($limit)->get();
        }

        $artikel->load(['media' => function ($query) {
            $query->where('parent_table', 'r_artikel')->where('status', 1)->where('parent_media', 1);
        }]);
        return $artikel;
    }

    public static function getRelatedContent($id)
    {
        $query = "select a.judul,a.created_at, m.filename,a.slug,u.name from `r_artikel` a
        INNER JOIN users u on a.author_id= u.id
        LEFT JOIN r_media m On a.id = m.code_id
        where a.id not in($id) and m.parent_table='r_artikel' limit 3";
        $rell = DB::select($query);
        return $rell;
    }



}
