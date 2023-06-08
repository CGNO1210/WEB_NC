<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function upimg(Request $request) {
        if($request->hasFile('fileTest')){
            $file = $request->file('fileTest');
            return $file->move(public_path('img'), time().'-'.'.'.$file->getClientOriginalExtension());
        }
    }
}