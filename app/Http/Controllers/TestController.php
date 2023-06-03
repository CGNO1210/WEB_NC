<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function upimg(Request $request) {
        if($request->hasFile('fileTest')){
            $file = $request->input('fileTest');
            $file->move('img', $file->getClientOriginalName());
        }
    }
}
