<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SetingController extends Controller
{
    public function index() {
        return view('admin.pages.seting.general');
    }
}
