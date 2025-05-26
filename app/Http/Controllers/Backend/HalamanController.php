<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Halaman;
use App\Media;
use Validator;
use Image;
use DB;
use File;
use Softon\SweetAlert\Facades\SWAL;

class HalamanController extends Controller
{
    public function index()
    {
        $title_page = 'Daftar Halaman';
        ///$halaman = Halaman::all(); //default 4 halaman;
        $halaman = Halaman::with('user')->paginate(10);
        return view('admin.pages.halaman.halaman_list', compact('halaman', 'title_page'));
    }
    public function create(){
        $title_page = 'Tambah Halaman';
        return view('admin.pages.halaman.halaman_create', compact('title_page'));
    }

    public function store(Request $request){
        $rules = [
            'judul'       => 'required|unique:r_halaman,judul',
            'konten'      => 'required',
            'status'      => 'required|int',
            'fotohalaman' => 'required|image|max:5048|dimensions:min_width=600,min_height=300',
            'alt_foto'    => 'required|string'
         ];


        $this->validate($request, $rules);

    //    / if ($validator->fails()) {

    //         return redirect()->back()->with('error',$validator->errors)->withInput();
    //     } else {
            // assume it won't work
            $success = false;
            DB::beginTransaction();
            $error = '';
           try{
                $halaman = Halaman::create([
                    'judul' => $request->judul,
                    'slug' => str_slug($request->judul),
                    'konten' => $request->post('konten'),
                    'author_id' => \Auth::user()->id, //sementara
                    'status' =>  $request->status,
                    'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
                ]);
                $success= true;
                //dd($request->hasFile('fotohalaman') && $request->file('fotohalaman')->isValid());
                if ($request->hasFile('fotohalaman') && $request->file('fotohalaman')->isValid()) {
                    $file = $request->file('fotohalaman');
                    $name = time().str_slug($request->judul).'.'.str_replace(' ','-',$file->getClientOriginalExtension());
                    $extensi = $file->getClientOriginalExtension();
                    $mime = $file->getMimeType();
                    $file->move(config('desawisata.PATH_IMAGE_HALAMAN'), $name);
                         // //thumbnail
                        $this->resizeThumb(config('desawisata.PATH_IMAGE_HALAMAN').$name, $name, 300);

                        // Media
                        $media = Media::create([
                            'code_id' => $halaman->id,
                            'parent_table' => 'r_halaman',
                            'mimetype' => $mime,
                            'filename' => $name,
                            'extensi' => $extensi,
                            'title' => $request->judul,
                            'narasi' => $request->alt_foto,
                            'status' =>1,
                            'parent_media'=>1,
                            'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                        ]);
                        $success = true;

                    } else {
                       $error .= 'file tidak bisa diupload';
                    }

           }catch(\Exception $e){
              $error .= $e->getMessage();
           }

           if ($success) {
            DB::commit();
            return redirect('backend/halaman')->with('success', 'Halaman sudah berhasil diinput');
            } else {
                DB::rollback();
                return redirect()->back()->with('error', 'Halaman Gagal disimpan');
            }
       // }
    }
    private function resizeThumb($imagePath,$name, $size)
    {
        try {
            $img = Image::make($imagePath);
            $img->resize(intval($size), null, function ($constraint) {
                $constraint->aspectRatio();
            });

            return $img->save('storage/data-halaman/thumb/'. $name);
        } catch (Exception $e) {
            return false;
        }
    }
    public function edit($id){
        $title_page = 'Edit Halaman';
        $halaman = Halaman::findOrFail($id);
        $halaman->load(['media'=>function($query){
            return $query->where('parent_table','r_halaman');
        }]);
        return view('admin.pages.halaman.halaman_edit',compact('title_page','halaman'));
    }

    public function update(Request $request, Halaman $halaman){
        $rules = [
            'judul'       => 'required|max:200|unique:r_halaman,judul,'.$request->id,
            'konten'      => 'required',
            'status'      => 'required|int',
            'fotodesawisata' => 'image',
            'alt_foto'    => 'required|string'
         ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->with('error',$validator->errors())->withInput();
        } else {
            // assume it won't work
            $success = false;
            DB::beginTransaction();
           try{

            $halaman = halaman::find($halaman->id);

            $halaman->judul = $request->judul;
            $halaman->slug = str_slug($request->judul);
            $halaman->konten = $request->konten;
            $halaman->author_id = \Auth::user()->id;
            $halaman->status = $request->status;
            $halaman->updated_at = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
            $halaman->save();

            if ($request->hasFile('fotohalaman') && $request->file('fotohalaman')->isValid()) {
                $file = $request->file('fotohalaman');
                $name = time() . str_replace(' ','-',$file->getClientOriginalName());
                $mime = $file->getMimeType();
                $extensi = $file->getClientOriginalExtension();
                $save_foto = $file->move(config('desawisata.PATH_IMAGE_HALAMAN'), $name);

                //ukuran besar
                 // //thumbnail
                $savethumb =  $this->resizeThumb(config('desawisata.PATH_IMAGE_HALAMAN').$name, $name, 300);
                if($savethumb){
                    $media =  Media::where('code_id',$halaman->id)->where('parent_table','r_halaman')->first();
                    if($media== null){
                        $media =  new Media();
                    }
                    $media->code_id = $halaman->id;
                    $media->parent_table = 'r_halaman';
                    $media->mimetype = $mime;
                    $media->extensi = $extensi;
                    $media->title = $request->alt_foto;
                    $media->filename = $name;
                    $media->status =1;
                    $media->parent_media = 1;
                    $media->created_at = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
                    $media->save();
                }else
                    $error .='Tidak bisa membuat thumbnail';

            }else if($request->alt_foto!=null){
                $media =  Media::where('code_id',$halaman->id)->where('parent_table','r_halaman')->first();
                if($media== null){
                    $media =  new Media();
                }
                $media->title = $request->alt_foto;
                $media->save();
            }
                $success = true;
           }catch(\Exception $e){
               return redirect()->back()->with('error',$e->getMessage())->withInput();
           }

           if ($success) {
            DB::commit();
            return redirect('backend/halaman')->with('success', 'Halaman sudah berhasil diupdate');
            } else {
                DB::rollback();
                return redirect()->back()->with('error', 'Halaman Gagal diupdate');
            }
        }
    }
    public function destroy($id)
    {
        $halaman = Halaman::findOrFail($id);

        $media = Media::where('code_id',$halaman->id)->where('parent_table','r_halaman')->first();
        File::delete('/storage/data-halaman/'.$media->filename);
        $halaman->delete();
        return redirect()->back()->with(['success' => 'Halaman: ' . $halaman->judul . ' Dihapus']);
    }
}
