<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Image;
use Validator;
use Input;
use Auth;
use DB;
use App\Artikel;
use App\ArtikelTags;
use App\Media;
use App\Tags;
use App\KategoriArtikel;
use App\Komentar;


class ArtikelController extends Controller
{
    protected $limit = 10;
    private $artikel;
    public function __construct(Artikel $artikel)
    {
        $this->artikel = $artikel;
        $this->middleware('auth')->except([
                        'index', 'show'
                    ]);
    }

    //admin index list
    public function index()
    {
        $title_page = 'Daftar Artikel';
        $artikel = $this->getArtikel(); //default 4 artikel;

        return view('admin.pages.artikel.artikel_list', compact('artikel', 'title_page'));
    }

    public function getArtikel()
    {
        $artikel = Artikel::with('user', 'kategori_artikel')->latest()->paginate($this->limit);
        $artikel->load(['media' => function ($query) {
            $query->where('parent_table', 'r_artikel')->where('status', 1);
        }]);
        return $artikel;
    }


    public static function getArtikelMedia($limit = 4)
    {
        $artikel = Artikel::with('user')->limit($limit)->get();
        $artikel->load(['media' => function ($query) {
            $query->where('parent_table', 'r_artikel')->where('status', 1);
        }]);
        return $artikel;
    }

    public function create()
    {
        $title_page = 'Buat Artikel';
        $kategori = KategoriArtikel::all();
        $action = 'artikel.store';
        $method = 'POST';
        return view('admin.pages.artikel.artikel_create', compact('title_page', 'kategori', 'action', 'method'));
    }

    public function store(Request $request, Artikel $artikel)
    {
        $data = [
            "errors" => null
         ];
        $inputs = Input::all();
        unset($inputs['_token']);

        $rules = [
            'judul'       => 'required|unique:r_artikel,judul',
            'konten'      => 'required',
            'kategori_id' => 'required|int',
            'status'      => 'required|int',
            'fotoartikel' => 'required|image|max:2048|dimensions:min_width=600,min_height=300',
            'alt_foto'    => 'required|string'
         ];


        $validator = Validator::make($inputs, $rules);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator->getMessage())->withInput();
        } else {
            // assume it won't work
            $success = false;

            DB::beginTransaction();
            try {
                    // Artikel
                $artikel = Artikel::create([
                    'judul' => $request->judul,
                    'slug' => str_slug($request->judul),
                    'konten' => $request->post('konten'),
                    'author_id' => Auth::user()->id, //sementara
                    'kategori_id' => $request->post('kategori_id'),
                    'status' =>  $request->status,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]);

                // Tag
                if($request->post('tag')){
                        $tags= explode(',',$request->post('tag'));

                        // $artikel->tags()->sync($tags);
                        if(count($tags)){
                            foreach($tags as $tg){
                                $isada = Tags::where('nama_tag',$tg)->where('tag_type',$tg)->first();
                                if(isset($isada)){
                                    $taginsert = ArtikelTags::create(
                                        ['artikel_id' => $artikel->id,'tag_id' =>  $isada->id]
                                    );
                                }else{
                                    $theTags = new Tags();
                                    $theTags->nama_tag = $tg;
                                    $theTags->tag_type = 'post';
                                    $theTags->save();

                                    $taginsert = new ArtikelTags();
                                    $taginsert->artikel_id = $artikel->id;
                                    $taginsert->tag_id =$theTags->id;
                                    $taginsert->save();

                                }
                            }
                        }
                }

                if ($request->hasFile('fotoartikel') && $request->file('fotoartikel')->isValid()) {
                    $file = $request->file('fotoartikel');
                    $name = time().str_slug($request->judul).'.'.$file->getClientOriginalExtension();
                    $extensi = $file->getClientOriginalExtension();
                    $mime = $file->getMimeType();
                    $file->move(config('desawisata.PATH_IMAGE_ARTIKEL'), $name);
                         // //thumbnail
                        $this->resizeThumb(config('desawisata.PATH_IMAGE_ARTIKEL').$name,config('desawisata.PATH_IMAGE_ARTIKEL'), $name, 300);

                        // Media
                        $media = Media::create([
                            'code_id' => $artikel->id,
                            'parent_table' => 'r_artikel',
                            'mimetype' => $mime,
                            'filename' => $name,
                            'extensi' => $extensi,
                            'narasi' => $request->alt_foto,
                            'status' =>1,
                            'parent_media'=>1,
                            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                        ]);
                        $success = true;

                    } else {
                      //  dd('disini');
                        return redirect('backend/artikel/create')->withErrors('File tidak bisa diupload')->withInput();
                    }

            } catch (\Exception $e) {
                // dd($e->getMessage());
                return redirect('backend/artikel/create')->with('errors',$e)->withInput();
            }

            if ($success) {
                DB::commit();
                // return Redirect::back()->withSuccessMessage('Artikel Berhasil Disimpan');
                return redirect('backend/artikel')->with('success', 'Artikel sudah berhasil diinput');
            } else {
                DB::rollback();
                // dd('error');
                return redirect()->back()->with('errors', 'Artikel Gagal disimpan');
            }
        }
    }

    private function resizeThumb($imagePath,$destinasi, $name, $size)
    {
        try {
            $img = Image::make($imagePath);
            $img->resize(intval($size), null, function ($constraint) {
                $constraint->aspectRatio();
            });

            return $img->save($destinasi.'/thumb/'. $name);
        } catch (Exception $e) {
            return false;
        }
    }

    public function edit(Artikel $artikel)
    {
        $artikels = Artikel::with('user')->with('kategori_artikel','artikel_tags.tags')->findOrFail($artikel->id);

        $artikel->load(['media' => function ($query) {
            $query->where('parent_table', 'r_artikel');
        }]);
        $kategori = KategoriArtikel::all();
        $title_page = 'Edit Artikel';
        $action = 'artikel.update';
        $artikel_id = $artikel->id;
        //dd($artikels);
        //$tags = Artikel::with('artikel_tags')->where('id',$artikel->id)->get();
        $tags = [];
        if (!empty($artikels->artikel_tags) && count($artikels->artikel_tags)):
            foreach ($artikels->artikel_tags as $tgs):
                $tags[] = $tgs->tags['nama_tag'];
            endforeach;
            $tag = implode(',',$tags);
        else:
            $tag ='';
        endif;

        // $tags =  Artikel::existingTags()->pluck('nama_tag');

        return view('admin.pages.artikel.artikel_edit', compact('artikels', 'title_page', 'action', 'kategori', 'method','artikel_id','tag'));
    }


    public function update(Request $request, Artikel $artikel)
    {
        $data = [
            "errors" => null
         ];
        $inputs = $request->all();
        unset($inputs['_token']);

        $rules =  [
            'judul' => 'required|max:255|unique:r_artikel,judul,'.$artikel->id,
            'konten' => 'required',
            'kategori_id' => 'required|int',
            'status' => 'required|int',
            'fotodesawisata' => 'image|size:2048|dimensions:min_width=600,min_height=300',
            'tag' => 'max:255'
        ];
        $validator = Validator::make($inputs, $rules);


        if ($validator->fails()) {
            return redirect('backend/artikel/'.$artikel->id.'/edit')->withErrors($validator)->withInput();
        } else {
            $success = false;

            DB::beginTransaction();
            try {

                $artikel = Artikel::find($artikel->id);

                $artikel->judul = $request->judul;
                $artikel->slug = str_slug($request->judul);
                $artikel->konten = $request->konten;
                $artikel->author_id = Auth::user()->id;
                $artikel->kategori_id = $request->kategori_id;
                $artikel->status = $request->status;
                $artikel->updated_at = Carbon::now()->format('Y-m-d H:i:s');
                $artikel->save();

                if ($request->hasFile('fotoartikel') && $request->file('fotoartikel')->isValid()) {
                    $file = $request->file('fotoartikel');
                    $name = time() . $file->getClientOriginalName();
                    $save_name = time() . str_replace(' ','-',$file->getClientOriginalName());
                    $mime = $file->getMimeType();
                    $extensi = $file->getClientOriginalExtension();
                    $file->move(config('desawisata.PATH_IMAGE_ARTIKEL'), $name);

                    //ukuran besar
                     // //thumbnail
                    $this->resizeThumb(config('desawisata.PATH_IMAGE_ARTIKEL').$name,config('desawisata.PATH_IMAGE_ARTIKEL'), $name, 300);


                    $media =  Media::where('code_id',$artikel->id)->where('parent_table','r_artikel')->first();
                    if($media== null){
                        $media =  new Media();
                    }
                    $media->code_id = $artikel->id;
                    $media->parent_table = 'r_artikel';
                    $media->mimetype = $mime;
                    $media->extensi = $extensi;
                    $media->title = $request->alt_foto;
                    $media->filename = $name;
                    $media->status =1;
                    $media->parent_media = 1;
                    $media->created_at = Carbon::now()->format('Y-m-d H:i:s');
                    $media->save();
                }else if($request->alt_foto!=null){
                    $media =  Media::where('code_id',$artikel->id)->where('parent_table','r_artikel')->first();
                    if($media== null){
                        $media =  new Media();
                    }
                    $media->title = $request->alt_foto;
                    $media->save();
                }

                if($request->post('tag')){
                    $tags= explode(',',$request->post('tag'));

                    // $artikel->tags()->sync($tags);
                    if(count($tags)){
                        foreach($tags as $tg){
                            $isada = Tags::where('nama_tag',$tg)->where('tag_type',$tg)->first();
                            if(isset($isada)){
                                $taginsert = ArtikelTags::create(
                                    ['artikel_id' => $artikel->id,'tag_id' =>  $isada->id]
                                );
                            }else{
                                $theTags = new Tags();
                                $theTags->nama_tag = $tg;
                                $theTags->tag_type = 'post';
                                $theTags->save();

                                $taginsert = new ArtikelTags();
                                $taginsert->artikel_id = $artikel->id;
                                $taginsert->tag_id =$theTags->id;
                                $taginsert->save();

                            }
                        }
                    }
                }
                $success = true;
            } catch (\Exception $e) {
                return redirect()->back()->withErrors($e->getMessage())->withInput();
            }

            if($success) {
                DB::commit();
               return redirect('backend/artikel')->with('success', 'Artikel sudah berhasil diedit');
            } else {
                DB::rollback();
                return redirect()->back()->withErrorMessage('Artikel Gagal diedit');
            }
        }
    }


    public function showArtikel($slug)
    {
        $artikel = Artikel::with('user')->with('kategori_artikel')->where('slug', $slug)->get();
        $artikel->load(['media' => function ($query) {
            $query->where('parent_table', 'r_artikel')->where('status', 1);
        }]);

        $title_page = $artikel[0]->judul;
        return view('admin.pages.artikel.artikel_show', compact('artikel', 'title_page'));
    }



    public function show(Artikel $artikel)
    {
        $artikel = Artikel::with('user')->with('kategori_artikel')->where('slug', $slug)->get();
        $artikel->load(['media' => function ($query) {
            $query->where('parent_table', 'r_artikel')->where('status', 1);
        }]);
        $title_page = $artikel[0]->judul;
        return view('admin.pages.artikel.artikel_show', compact('artikel', 'title_page'));
    }
}
