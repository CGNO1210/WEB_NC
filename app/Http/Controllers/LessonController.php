<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\Chapter;
use App\Models\Lesson;
use App\Models\Comment;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;


class LessonController extends Controller
{
    public function addLesson($slug_course,$slug_chapter) {
        return view('admin.courses.add_lesson',[
            'name_course' => $slug_course,
            'name_chapter' => $slug_chapter,
        ]
    );
    }
    public function createLesson($slug_course,$slug_chapter,Request $request)
    {
        $cour = Courses::where('slug' ,$slug_course)->first();
        $cour_id = $cour->id;
        $chapter = Chapter::where('cour_id', $cour_id)->where('chapter_slug',$slug_chapter)->first();
        $this->validate($request,[
            'lesson_name'=>'required',
            'lesson_description'=>'required',
            'lesson_video' => 'required'
        ]);
        if(Lesson::where('chapter_id',$chapter->id)->where('lesson_name',$request->input('lesson_name'))->first()){
            session()->flash('error','Tên bài học đã tồn tại!');
            return redirect()->back();
        }

        $file = $request->file('lesson_video');
        $file->move(public_path('video'), Str::slug($cour->cour_name.$chapter->chapter_name.$request->input('lesson_name'), '-').'.'.$file->getClientOriginalExtension());
        $lesson_video = Str::slug($cour->cour_name.$chapter->chapter_name.$request->input('lesson_name'), '-').'.'.$file->getClientOriginalExtension();
        try {
            Lesson::create([
                'cour_id' => $cour_id,
                'chapter_id' => $chapter->id,
                'lesson_name'=> $request->input('lesson_name'),
                'lesson_slug' => Str::slug($request->input('lesson_name'), '-'),
                'lesson_description' =>$request->input('lesson_description'),
                'lesson_video' => $lesson_video
            ]);
            Session()->flash('success','Thêm thành công');
        } catch (Exception $ex){
            Session()->flash('error',$ex->getMessage());
            return redirect()->back();
        }
        return redirect('/admin/'.$slug_course.'/'.$slug_chapter.'/edit');  
    }
    public function editLesson($slug_course,$slug_chapter,$lesson_slug) {
        $cour_id = Courses::where('slug' ,$slug_course)->first()->id;
        $chapter_id = Chapter::where('cour_id', $cour_id)->where('chapter_slug',$slug_chapter)->first()->id;
        $lesson = Lesson::where('chapter_id',$chapter_id)->where('lesson_slug',$lesson_slug)->first();
        return view('admin.courses.edit_lesson',[
            'name_course' => $slug_course,
            'name_chapter' => $slug_chapter,
            'name_lesson' => $lesson_slug,
            'lesson' =>$lesson
        ]
    );
    }
    public function updateLesson($slug_course,$slug_chapter,$lesson_slug,Request $request)
    {
        $cour = Courses::where('slug' ,$slug_course)->first();
        $cour_id = $cour->id;
        $chapter = Chapter::where('cour_id', $cour_id)->where('chapter_slug',$slug_chapter)->first();
        $chapter_id = $chapter->id;
        $lesson= Lesson::where('chapter_id',$chapter_id)->where('lesson_slug',$lesson_slug)->first();
        $lesson_id = $lesson->id;
        $name_old = $lesson->lesson_name;
        $this->validate($request,[
            'lesson_name'=>'required',
        ]);
        if(Lesson::where('chapter_id',$chapter_id)->where('lesson_name','<>',$name_old)->where('lesson_name',$request->input('lesson_name'))->first()){
            session()->flash('error','Tên bài học đã tồn tại!');
            return redirect()->back();
        }

        $lesson_video = Courses::where('lesson_id', $lesson_id)->first()->lesson_video;
        $file = $request->file('lesson_video');
        if($file){
            $file->move(public_path('video'), Str::slug($cour->cour_name.$chapter->chapter_name.$request->input('lesson_name'), '-').'.'.$file->getClientOriginalExtension());
            $lesson_video = Str::slug($cour->cour_name.$chapter->chapter_name.$request->input('lesson_name'), '-').'.'.$file->getClientOriginalExtension();
        }
        try {
            Lesson::where('id', $lesson_id)->update([
                'cour_id' => $cour_id,
                'lesson_name' => $request->input('lesson_name'),
                'lesson_slug' =>  Str::slug($request->input('lesson_name'), '-'),
                'lesson_description' =>$request->input('lesson_description'),
                'lesson_video' => $lesson_video
            ]);
            Session()->flash('success','Chỉnh sửa thành công');
        } catch (Exception $ex){
            Session()->flash('error',$ex->getMessage());
            return redirect()->back();
        }
        return redirect('/admin/'.$slug_course.'/'.$slug_chapter.'/edit');
    }

    public function deleteLesson(Request $request) {
        $Lesson = Lesson::where('id',$request->input('id'))->first();
        if($Lesson){
            if($Lesson->delete()){
                return response()->json([
                    'error'=>'false',
                    'message'=>'Xóa lesson thành công'
                ]);
            }
            return response()->json([
                'error'=>'true',
                'message'=>'Xóa lesson KHÔNG thành công'
            ]);
        }
    }

    public function comment(Request $request) {
        $this->validate($request,[
            'comment'=>'required',
        ]);
        $user_id = $request->input('user_id');
        $lesson_id = $request->input('lesson_id');
        $comment = $request->input('comment');
        try {
            Comment::create([
                'user_id' => $user_id,
                'lesson_id' => $lesson_id,
                'comment'=> $comment,
            ]);
                Session()->flash('success','Thêm thành công');
        } catch (Exception $ex){
                Session()->flash('error',$ex->getMessage());
                return redirect()->back();
        }
        return redirect()->back();
    }
}