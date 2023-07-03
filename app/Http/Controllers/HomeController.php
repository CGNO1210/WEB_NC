<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Courses;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function loadUser() {
        $users = User::paginate(4);
            return view('admin.admin_users',[
                'users' => $users,  
            ]);
        return view('admin.admin_users');
    }
    public function getHome() {
        if(!Session()->get('admin')){
            return redirect('/');
        }
        $courses = Courses::query()->leftJoin('chapter','courses.id','chapter.cour_id')
            ->selectRaw('courses.id,cour_name,cour_img,cour_description,cour_price,slug,COUNT(chapter.cour_id) as `chuong`')
            ->groupBy('courses.id','cour_name','cour_img','cour_description','cour_price','slug')->paginate(4);
        return view('admin.admin_courses',[
            'courses' => $courses,  
        ]);
    }
    public function getRoute() {
        return view('client.route');
    }

}
