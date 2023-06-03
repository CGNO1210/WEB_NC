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
Route::get('/', function () {
    return view('client.test',[
        'pro_courses' => Courses::all(),
        'pro_courses_count' => Courses::all()->count(),
        'free_courses' => Courses::all(),
        'free_courses_count' => Courses::all()->count(),

    ]);
});
Route::get('/wel', function () {
    return view('welcome');
});
Route::get('/login','UserController@getLoginPage');
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
Route::get('/courses/{cour_name}','CoursesController@getCourse');


Route::get('/test',function () {
    return view('test');
});
Route::post('/testupimg','TestController@upimg');

