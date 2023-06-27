<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\Chapter;
use App\Models\Lesson;
use App\Models\Comment;
use App\Models\RegisterCourse;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class CoursesController extends Controller
{
    function getHomePage () {
        $user  = Session()->get('user', function() {
            return 0;
        });
        $user_id = 0;
        if($user) {
            $user_id = $user->id;
        }
        $registerCourses = RegisterCourse::where('user_id',$user_id)->get();
        return view('client.home',[
            'pro_courses' => Courses::where('cour_price','>','0')->get(),
            'pro_courses_count' => Courses::where('cour_price','>','0')->count(),
            'free_courses' => Courses::where('cour_price','0')->get(),
            'free_courses_count' => Courses::where('cour_price','0')->count(),
            'registerCourses' => $registerCourses,
        ]);
    }

    public function get_review_Course($cour_slug) {
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

        $chapters = Chapter::query()->leftJoin('lesson','chapter.id','lesson.chapter_id')
                                    ->selectRaw('chapter.id,chapter_name,chapter_slug,COUNT(lesson.chapter_id) as `bai`')
                                    ->where('chapter.cour_id',$course->id)
                                    ->groupBy('chapter.id','chapter_name','chapter_slug')->paginate(4);
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
        

        if($request->input('user_id')==0){
            return redirect('/login');
        }
        RegisterCourse::create([
            'course_id' => $request->input('cour_id'),
            'user_id' => $request->input('user_id'),
        ]);
        $cour_name = Courses::where('id',$request->input('cour_id'))->first()->slug;
        return redirect('/courses/'.$cour_name.'/learn');
    }
    public function learnCourse($cour_name,Request $request){
        $cour = Courses::where('slug',$cour_name)->first();
        $chapters = Chapter::where('cour_id',$cour->id)->get();
        $lessons = Lesson::all();
        if($request->input('lesson_id') == "")
            $lesson_id = Lesson::where('cour_id',$cour->id)->first()->id;
        else
            $lesson_id = $request->input('lesson_id');
        $comment = Comment::query()->join('users','comments.user_id','users.id')->where('lesson_id',$lesson_id)->get();
        return view('client.learn',[
            'cour_name'=> $cour_name,
            'chapters'=> $chapters,
            'lessons'=> $lessons,
            'lesson_id' => $lesson_id,
            'comments' => $comment
        ]);
    }
}
