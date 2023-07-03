<?php

namespace App\Http\Controllers;
use App\Models\Courses;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request) {
        $this->validate($request,[
            'search'=>'required',
        ]);
        $search = '%'.$request->input('search').'%';
        $searchcourses = Courses::where('cour_name','LIKE',$search)->get();
        return view('client.search',[
            'pro_courses' => Courses::where('cour_price','>','0')->get(),
            'pro_courses_count' => Courses::where('cour_price','>','0')->count(),
            'free_courses' => Courses::where('cour_price','0')->get(),
            'free_courses_count' => Courses::where('cour_price','0')->count(),
            'searchcourses' => $searchcourses,
        ]);
    }
}
