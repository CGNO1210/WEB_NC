<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses;

class CoursesController extends Controller
{
    public function getCourse($cour_slug) {
        $data = Courses::where('slug',$cour_slug)->get();
        if($data->count())
            return view('client.course_detail',[
                'data'=> $data[0]
            ]);
        else
            return "not found";
    }

    public function createCourse(Request $request) {
        $this->validate($request,[
            'cour_name'=>'required',
            'cour_img'=>['required',Rule::unique('users')],
            'password'=>'required',
            'user_mail'=>'required',
            'user_phone'=>'required',
        ]);

        Courses::create([
            'user_name' => $request->input('user_name'),
            'login_name' => $request->input('login_name'),
            'password' =>  Hash::make($request->input('password')),
            'user_mail' =>  $request->input('user_mail'),
            'user_phone' =>  $request->input('user_phone'),
        ]);
        return 'inserted successfully';
    }
}
