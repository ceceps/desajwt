<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Komentar;

class KomentarController extends Controller
{
    public function store(Request $request)
    {
    	$request->validate([
            'message'=>'required',
        ]);
   
        $input = $request->all();
        $input['user_id'] = auth()->user()->id;
    
        Komentar::create($input);
   
        return back();
    }
}
