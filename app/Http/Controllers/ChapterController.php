<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\Chapter;
use App\Models\Lesson;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ChapterController extends Controller
{
    public function addChapter($slug, Request $request) {
        $cour_id =  Courses::where('slug', $slug)->first()->id;

        $this->validate($request,[
            'chapter_name'=>'required',
        ]);
        if(Chapter::where('cour_id', $cour_id)->where('chapter_name',$request->input('chapter_name'))->first()){
            session()->flash('error','Tên chương đã tồn tại!');
            return redirect()->back();
        }
        try {
            Chapter::create([
            'cour_id' => $cour_id,
            'chapter_name'=> $request->input('chapter_name'),
            'chapter_slug' => Str::slug($request->input('chapter_name'), '-'),
        ]);
            Session()->flash('success','Thêm thành công');
        } catch (Exception $ex){
            Session()->flash('error',$ex->getMessage());
            return redirect()->back();
        }
        return redirect()->back();
    }
    public function editChapter($slug_course,$slug_chapter) {

        $cour_id = Courses::where('slug' ,$slug_course)->first()->id;
        $chapter = Chapter::where('cour_id', $cour_id)->where('chapter_slug',$slug_chapter)->first();
        $lessons = Lesson::where('chapter_id',$chapter->id)->paginate(5);
        return view('admin.courses.edit_chapter',[
            'name_course' => $slug_course,
            'name_chapter' => $slug_chapter,
            'chapter' => $chapter,
            'lessons' => $lessons
        ]
    );
    }
    public function updateChapter($slug_course,$slug_chapter,Request $request)
    {
        $cour_id = Courses::where('slug' ,$slug_course)->first()->id;
        $name_old = Chapter::where('chapter_slug', $slug_chapter)->first()->chapter_name;
        $this->validate($request,[
            'chapter_name'=>'required',
        ]);

        if(Chapter::where('cour_id', $cour_id)->where('chapter_name','<>',$name_old)->where('chapter_name',$request->input('chapter_name'))->first()){
            session()->flash('error','Tên chương đã tồn tại!');
            return redirect()->back();
        }

        $chapter_id = Chapter::where('cour_id', $cour_id)->where('chapter_slug',$slug_chapter)->first()->id;
        try {
            Chapter::where('id', $chapter_id)->update([
            'chapter_name' => $request->input('chapter_name'),
            'chapter_slug' =>  Str::slug($request->input('chapter_name'), '-'),
        ]);
            Session()->flash('success','Chỉnh sửa thành công');
        } catch (Exception $ex){
            Session()->flash('error',$ex->getMessage());
            return redirect()->back();
        }
        return redirect('/admin/'.$slug_course.'/edit');
    }
    public function deleteChapter(Request $request) {
        $chapter = Chapter::where('id',$request->input('id'))->first();
        $lessons = Lesson::where('chapter_id',$request->input('id'));
        if($chapter){
            if($lessons->delete()){
                if($chapter->delete()){
                    return response()->json([
                        'error'=>'false',
                        'message'=>'Xóa chapter thành công'
                    ]);
                }
                return response()->json([
                    'error'=>'true',
                    'message'=>'Xóa chapter KHÔNG thành công'
                ]);
            }
        }
    }
}
