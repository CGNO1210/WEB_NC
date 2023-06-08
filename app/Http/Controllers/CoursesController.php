<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\Chapter;
use App\Models\Lesson;
use App\Models\registerCourse;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class CoursesController extends Controller
{
    function getHomePage () {
        return view('client.home',[
            'pro_courses' => Courses::all(),
            'pro_courses_count' => Courses::all()->count(),
            'free_courses' => Courses::all(),
            'free_courses_count' => Courses::all()->count(),
    
        ]);
    }

    public function getCourse($cour_slug) {
        $data = Courses::where('slug',$cour_slug)->get();
        if($data->count())
            return view('client.course_review',[
                'data'=> $data[0]
            ]);
        else
            return "not found";
    }
    public function addcourse() {
        return view('admin.courses.addcourse');
    }
    public function createCourse(Request $request) {
        // $this->validate($request,[
        //     'cour_name'=>['required',Rule::unique('users')],
        //     'cour_description'=>'required',
        //     'cour_price'=>'required',
        //     'cour_img'=>'required',
        // ]);
        $file = $request->file('cour_img');
        $file->move(public_path('img'), Str::slug($request->input('cour_name'), '-').'.'.$file->getClientOriginalExtension());
        $img_src = '/img/'.Str::slug($request->input('cour_name'), '-').'.'.$file->getClientOriginalExtension();
        Courses::create([
            'cour_name' => $request->input('cour_name'),
            'cour_description' => $request->input('cour_description'),
            'cour_price' => $request->input('cour_price'),
            'slug' =>  Str::slug($request->input('cour_name'), '-'),
            'cour_img' => $img_src,
        ]);
        return redirect('/admin');
    }
    public function editCourse($slug) {
        $course = Courses::where('slug',$slug)->first();
        $chapters = Chapter::where('cour_id',$course->id)->paginate(4);
        return view('admin.courses.edit_course',[
            'course' => $course,
            'chapters' => $chapters
        ]
    );
    }
    public function updateCourse($slug, Request $request) {
        $file = $request->file('cour_img');
        $file->move(public_path('img'), Str::slug($request->input('cour_name'), '-').'.'.$file->getClientOriginalExtension());
        $img_src = '/img/'.Str::slug($request->input('cour_name'), '-').'.'.$file->getClientOriginalExtension();
        Courses::where('slug', $slug)->update([
            'cour_name' => $request->input('cour_name'),
            'cour_description' => $request->input('cour_description'),
            'cour_price' => $request->input('cour_price'),
            'slug' =>  Str::slug($request->input('cour_name'), '-'),
            'cour_img' => $img_src,
        ]);
        $redirect = '/admin/'.Str::slug($request->input('cour_name'), '-').'/edit';
        return redirect($redirect);
    }
    public function registerCourse(Request $request)
    {
        registerCourse::create([
            'course_id' => $request->input('cour_id'),
            'user_id' => $request->input('user_id'),
        ]);
    }
}
