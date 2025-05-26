<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\KategoriArtikel;
use Validator;

class KategoriArtikelController extends Controller
{
    public function index(){
      $title_page = "Kategori Artikel";
      $kategoriartikel = KategoriArtikel::paginate(10);
      return view('admin.pages.kategoriartikel.index',compact('kategoriartikel','title_page'));
    }
    public function create(){
        $title_page = "Tambah Kategori Artikel";
        return view('admin.pages.kategoriartikel.create',compact('title_page'));
    }

    public function store(Request $request){
       $rules = [
         'nama' => 'required|string|max:100|unique:r_artikel_kategori,nama',
         'slug' => 'max:255'
       ];

       $validator = Validator::make($request->all(), $rules);

       if ($validator->fails()) {
        return redirect()->back()->withErrors($validator->errors())->withInput();
       } else {

            $kategori = new KategoriArtikel();
            $kategori->nama = $request->nama;
            $kategori->slug = ($request->slug != null)?str_slug($request->slug):str_slug($request->nama);
            $kategori->save();

            return redirect()->route('kategoriartikel.index')->with('success','Data Kategori Artikel Berhasil disimpan');
       }
    }
    public function edit($id){
        $title_page = "Edit Kategori Artikel";
        $kategori= KategoriArtikel::findOrFail($id);
        return view('admin.pages.kategoriartikel.edit',compact('title_page','kategori'));

    }
    public function update($id, Request $request){
        $rules = [
            'nama' => 'required|string|max:100|unique:r_artikel_kategori,nama,'.$request->id,
            'slug' => 'max:255'
          ];

          $validator = Validator::make($request->all(), $rules);

          if ($validator->fails()) {
              return redirect()->back()->with('error',$validator->errors())->withInput();
          } else {

               $kategori = KategoriArtikel::findOrFail($request->id);
               $kategori->nama = $request->nama;
               $kategori->slug = ($request->slug != null)?str_slug($request->slug):str_slug($request->nama);
               $kategori->save();

               return redirect()->route('kategoriartikel.index')->with('success','Data Kategori Artikel Berhasil disimpan');
          }
    }
    public function destroy($id){
        $kategori= KategoriArtikel::findOrFail($id);
        $kategory->delete();
        return redirect()->back()->with('success','Data Kategori Artikel Berhasil dihapus');
    }
}
