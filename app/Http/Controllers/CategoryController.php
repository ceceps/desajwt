<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use GuzzleHttp\Client;
class CategoryController extends Controller
{
    /**
     * Ambil Semua Data category dari API
     *
     * URL : REST_URL +category/
     * @return json parse direct to view
     */

    public function showAllCategory(){
        $client = new Client();
        $respon = $client->get(env('REST_URL').'category/');
        $allData = $respon->getBody()->getContents();
        return view('pages.category.category_list')->with('cat', json_decode($allData, true));
    }

    public function showOneCategory($id){
        return response()->json(Category::find($id));
    }

    public function create(Request $request)
    {
        $category = Category::create($request->all());
        $respon = ["error"=>false,"data"=>$category];
        return response()->json($respon,201);
    }

    public function update(Request $request, $id)
    {
        try{
            $category = Category::findOrFail($id);
        }catch(ModelNotFoundException $e){
            return response()->json([
                'error' => [
                    'message' => 'Kategori tidak ditemukan'
                ]
            ], 404);
        }

        $category->fill($request->all());
        $category->save();

        return response()->json($category,201);
    }

    public function delete($id, Request $request)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());

        return response()->json(["error"=>false,"data"=>"","mrssage"=>"Delete Successfully"],200);
    }

    //
}
