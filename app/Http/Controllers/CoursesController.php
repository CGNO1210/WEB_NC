<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\User;
use App\Models\Chapter;
use App\Models\Lesson;
use App\Models\Comment;
use App\Models\RegisterCourse;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

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
        $this->validate($request,[
            'cour_name'=>'required|unique:courses,cour_name',
            'cour_description'=>'required',
            'cour_price' =>'required|numeric',
            'cour_img' =>'required'
        ]);

        $file = $request->file('cour_img');
        $file->move(public_path('img'), Str::slug($request->input('cour_name'), '-').'.'.$file->getClientOriginalExtension());
        $img_src = Str::slug($request->input('cour_name'), '-').'.'.$file->getClientOriginalExtension();
        try {
            Courses::create([
                'cour_name' => $request->input('cour_name'),
                'cour_description' => $request->input('cour_description'),
                'cour_price' => $request->input('cour_price'),
                'slug' =>  Str::slug($request->input('cour_name'), '-'),
                'cour_img' => $img_src,
            ]);
            Session()->flash('success','Thêm mới thành công');
        } catch (Exception $ex){
            Session()->flash('error',$ex->getMessage());
            return redirect()->back();
        }
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
        $name = Courses::where('slug', $slug)->first()->id;
        $this->validate($request,[
            'cour_name'=>'required|unique:courses,cour_name,'.$name,
            'cour_description'=>'required',
            'cour_price' =>'required|numeric',
        ]);
        $img_src = Courses::where('slug', $slug)->first()->cour_img;
        $file = $request->file('cour_img');
        if($file){
            $file->move(public_path('img'), Str::slug($request->input('cour_name'), '-').'.'.$file->getClientOriginalExtension());
            $img_src = Str::slug($request->input('cour_name'), '-').'.'.$file->getClientOriginalExtension();
        }
        try {
            Courses::where('slug', $slug)->update([
                'cour_name' => $request->input('cour_name'),
                'cour_description' => $request->input('cour_description'),
                'cour_price' => $request->input('cour_price'),
                'slug' =>  Str::slug($request->input('cour_name'), '-'),
                'cour_img' => $img_src,
            ]);
            Session()->flash('success','Chỉnh sửa thành công');
        } catch (Exception $ex){
            Session()->flash('error',$ex->getMessage());
            return redirect()->back();
        }
        $redirect = '/admin/'.Str::slug($request->input('cour_name'), '-').'/edit';
        return redirect($redirect);
    }

    public function deleteCourse(Request $request) {
        $Course = Courses::where('id',$request->input('id'))->first();
        $lessons = Lesson::where('cour_id',$request->input('id'));
        $chapter = Chapter::where('cour_id',$request->input('id'));
        if($chapter){
            if($lessons){
                $lessons->delete();
            }
            $chapter->delete();
        }
        if($Course->delete()){
            return response()->json([
                'error'=>'false',
                'message'=>'Xóa khóa học thành công'
            ]);
        }
        return response()->json([
            'error'=>'true',
            'message'=>'Xóa khóa học KHÔNG thành công'
        ]);
    }

    public function registerCourse(Request $request)
    {
        if($request->input('user_id') == 0 ){
            return redirect('/login');
        }
        try {
            $deposit = floatval(User::where('id',$request->input('user_id'))->first()->user_deposit);
            $cour_price = floatval(Courses::where('id',$request->input('cour_id'))->first()->cour_price);
            if($deposit >= $cour_price){
                $deposit = $deposit - $cour_price;
                RegisterCourse::create([
                    'course_id' => $request->input('cour_id'),
                    'user_id' => $request->input('user_id'),
                ]);
                User::where('id', $request->input('user_id'))->update([
                    'user_deposit' => $deposit
                ]);
                Session()->put('user', User::where('id', $request->input('id'))->first());
                Session()->flash('success','Đăng kí thành công');
            } else{
                Session()->flash('error','không đủ tiền để đăng kí hãy nạp thêm');
                return redirect()->back();
            }
        } catch (Exception $ex){
            Session()->flash('error',$ex->getMessage());
            return redirect()->back();
        }
        $cour_name = Courses::where('id',$request->input('cour_id'))->first()->slug;
        return redirect('/courses/'.$cour_name.'/learn');
    }
    public function learnCourse($cour_name,Request $request){
        $lesson_id = 0;
        $lesson_video = '';
        $lesson_description ='';
        $comment = null;
        $cour = Courses::where('slug',$cour_name)->first();
        $chapters = Chapter::where('cour_id',$cour->id)->get();
        if(!$chapters->first()){
            $chapters = null;
        }
        $lessons = Lesson::where('cour_id',$cour->id)->get();
        if($chapters){
            if($request->input('lesson_id') == ""){
                $lesson = Lesson::where('cour_id',$cour->id)->first();
                if($lesson){
                    $lesson_id = $lesson->id;
                    $lesson_video = $lesson->lesson_video;
                    $lesson_description = $lesson->lesson_description;
                    $comment = Comment::query()->join('users','comments.user_id','users.id')->where('lesson_id',$lesson_id)->get();
                }   
            }
            else{
                $lesson_id = $request->input('lesson_id');
                $lesson_video = Lesson::where('id',$lesson_id)->first()->lesson_video;
                $lesson_description = Lesson::where('id',$lesson_id)->first()->lesson_description;
                $comment = Comment::query()->join('users','comments.user_id','users.id')->where('lesson_id',$lesson_id)->get();

            }
        }
        
        return view('client.learn',[
            'cour_name'=> $cour_name,
            'chapters'=> $chapters,
            'lessons'=> $lessons,
            'lesson_id' => $lesson_id,
            'comments' => $comment,
            'lesson_video' => $lesson_video,
            'lesson_description' => $lesson_description
        ]);
    }
}
