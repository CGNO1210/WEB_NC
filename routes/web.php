<?php

use Illuminate\Support\Facades\Route;
use App\Models\Courses;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', 'CoursesController@getHomePage');
Route::get('/login','UserController@getLoginPage')->name('login');
Route::post('/login','UserController@loginAction');
Route::get('/register','UserController@getRegisterPage');
Route::post('/register','UserController@registerAction');
Route::get('/logout','UserController@logout');
Route::get('/route',function () {
    return view('client.route');
});
Route::get('/blog',function () {
    return view('client.blog');
});
Route::get('/courses','CoursesController@getAllCourses');
Route::get('/courses/{cour_name}','CoursesController@get_review_Course'); //review course

Route::middleware(['auth'])->group(function () {
    Route::get('/{user_name}/edit','UserController@editUser');
    Route::post('/{user_name}/edit','UserController@updateUser');
    Route::post('/courses/{cour_name}','CoursesController@registerCourse');
    Route::get('/courses/{cour_name}/learn','CoursesController@learnCourse');
    Route::post('/courses/{cour_name}/learn','LessonController@comment');
    Route::prefix('/admin')->group(function () {
        Route::get('/',function () {
            $courses = Courses::query()->leftJoin('chapter','courses.id','chapter.cour_id')
                ->selectRaw('courses.id,cour_name,cour_img,cour_description,cour_price,slug,COUNT(chapter.cour_id) as `chuong`')
                ->groupBy('courses.id','cour_name','cour_img','cour_description','cour_price','slug')->paginate(4);
            return view('admin.admin_courses',[
                'courses' => $courses,  
            ]);
        });
        Route::get('/courses', function () {
            return view('admin.admin_courses');
        });
        Route::get('/users', function () {
            return view('admin.admin_users');
        });
        Route::get('/bill', function () {
            return view('admin.admin_bill');
        });
        //course
        Route::get('/addcourses', 'CoursesController@addcourse');
        Route::post('/addcourses','CoursesController@createCourse');
        Route::get('/{course_slug}/edit','CoursesController@editCourse');
        Route::post('/{course_slug}/edit','CoursesController@updateCourse');
        //chapter
        Route::post('/{course_slug}/addchapter','ChapterController@addChapter');
        Route::get('/{course_slug}/{chapter_slug}/edit','ChapterController@editChapter');
        Route::post('/{course_slug}/{chapter_slug}/edit','ChapterController@updateChapter');
        //lesson
        Route::get('/{course_slug}/{chapter_slug}/addlesson','LessonController@addLesson');
        Route::post('/{course_slug}/{chapter_slug}/addlesson','LessonController@createLesson');
        Route::get('/{course_slug}/{chapter_slug}/{lesson_slug}/edit','LessonController@editLesson');
        Route::post('/{course_slug}/{chapter_slug}/{lesson_slug}/edit','LessonController@updateLesson');
    });
});