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
        $cour_id = Courses::where('slug' ,$slug_course)->first()->id;
        $chapter = Chapter::where('cour_id', $cour_id)->where('chapter_slug',$slug_chapter)->first();
        Lesson::create([
            'cour_id' => $cour_id,
            'chapter_id' => $chapter->id,
            'lesson_name'=> $request->input('lesson_name'),
            'lesson_slug' => Str::slug($request->input('lesson_name'), '-'),
        ]);
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
        $cour_id = Courses::where('slug' ,$slug_course)->first()->id;
        $chapter_id = Chapter::where('cour_id', $cour_id)->where('chapter_slug',$slug_chapter)->first()->id;
        $lesson_id= Lesson::where('chapter_id',$chapter_id)->where('lesson_slug',$lesson_slug)->first()->id;

        Lesson::where('id', $lesson_id)->update([
            'cour_id' => $cour_id,
            'lesson_name' => $request->input('lesson_name'),
            'lesson_slug' =>  Str::slug($request->input('lesson_name'), '-'),
        ]);
        return redirect('/admin/'.$slug_course.'/'.$slug_chapter.'/edit');
    }

    public function comment(Request $request) {
        $user_id = $request->input('user_id');
        $lesson_id = $request->input('lesson_id');
        $comment = $request->input('comment');
        Comment::create([
            'user_id' => $user_id,
            'lesson_id' => $lesson_id,
            'comment'=> $comment,
        ]);
        return redirect()->back();
    }
}
