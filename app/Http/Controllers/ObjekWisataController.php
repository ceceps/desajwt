<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ObjekWisataController extends Controller
{
    public function index(){
        $client = new Client();
        $respon = $client->request('GET',env('REST_URL').'objekwisata/');
        $allData = $respon->getBody()->getContents();
        return view('pages.objekwisata.objekwisata_list')->with('objek', json_decode($allData, true));
    }
}
