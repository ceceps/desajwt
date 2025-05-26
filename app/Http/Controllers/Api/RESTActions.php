<?php
/**
 * Trait ActionsProvinsi
 * Author: Cecep Saefulloh
 * Date: 21/10/2018
 * Time: 11:15
 */

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

trait RESTActions {

    protected $statusCodes = [
        'done' => 200,
        'created' => 201,
        'removed' => 204,
        'not_valid' => 400,
        'not_found' => 404,
        'conflict' => 409,
        'permissions' => 401
    ];

    public function all()
    {
        $m = self::MODEL;
        //$respon = ['error'=>false,'pesan'=>'','provinsi'=>$m::all()];
        return $this->respond('done', $m::all());
    }

    public function get($id)
    {
        $m = self::MODEL;
        $model = $m::find($id);
        if(is_null($model)){
            return $this->respond('not_found');
        }
        return $this->respond('done', $model);
    }

    public function add(Request $request)
    {
        $m = self::MODEL;
        $this->validate($request, $m::$rules);
        return $this->respond('created', $m::create($request->all()));
    }

    public function put(Request $request, $id)
    {
        $m = self::MODEL;
        $this->validate($request, $m::$rules);
        $model = $m::find($id);
        if(is_null($model)){
            return $this->respond('not_found');
        }
        $model->update($request->all());
        return $this->respond('done', $model);
    }

    public function remove($id)
    {
        $m = self::MODEL;
        if(is_null($m::find($id))){
            return $this->respond('not_found');
        }
        $m::destroy($id);
        return $this->respond('removed');
    }

    protected function respond($status, $data = [])
    {
        $headers = ['Access-Control-Allow-Origin'=> '*',
        'Access-Control-Allow-Headers'=> 'Origin,X-CSRF-TOKEN, Content-Type, Authorization',
        'Access-Control-Allow-Methods'=> 'GET, POST, PUT, DELETE, OPTIONS'];
        return response()->json($data, $this->statusCodes[$status],$headers);
    }

}
