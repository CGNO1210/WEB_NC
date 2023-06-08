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
        Chapter::create([
            'cour_id' => $cour_id,
            'chapter_name'=> $request->input('chapter_name'),
            'chapter_slug' => Str::slug($request->input('chapter_name'), '-'),
        ]);
        return redirect()->back();

    }
    public function editChapter($slug_course,$slug_chapter) {
        $cour_id = Courses::where('slug' ,$slug_course)->first()->id;
        $chapter = Chapter::where('cour_id', $cour_id)->where('chapter_slug',$slug_chapter)->first();
        $lessons = Lesson::where('chapter_id',$chapter->id)->paginate(1);
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
        $chapter_id = Chapter::where('cour_id', $cour_id)->where('chapter_slug',$slug_chapter)->first()->id;
        Chapter::where('id', $chapter_id)->update([
            'chapter_name' => $request->input('chapter_name'),
            'chapter_slug' =>  Str::slug($request->input('chapter_name'), '-'),
        ]);
        return redirect('/admin/'.$slug_course.'/edit');
    }
}
