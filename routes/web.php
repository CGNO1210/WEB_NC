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
Route::get('/search','SearchController@search');
Route::get('/route','HomeController@getRoute');
Route::get('/courses','CoursesController@getAllCourses');
Route::get('/courses/{cour_name}','CoursesController@get_review_Course'); //review course
Route::get('/search','SearchController@search');
Route::middleware(['auth'])->group(function () {
    Route::get('/deposit', 'DepositController@showDepositForm');
    Route::post('/deposit', 'DepositController@processDeposit');
    Route::get('/{user_name}/edit','UserController@editUser');
    Route::post('/{user_name}/edit','UserController@updateUser');
    Route::get('/{user_name}/courses','UserController@myCourses');
    Route::post('/courses/{cour_name}','CoursesController@registerCourse');
    Route::get('/courses/{cour_name}/learn','CoursesController@learnCourse');
    Route::post('/courses/{cour_name}/learn','LessonController@comment');
    Route::prefix('/admin')->group(function () {
        Route::get('/','HomeController@getHome');
        Route::get('/users', 'HomeController@loadUser');
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
    Route::delete('/deleteLesson','Lessoncontroller@deleteLesson');
    Route::delete('/deleteChapter','Chaptercontroller@deleteChapter');
    Route::delete('/deleteCourse','Coursescontroller@deleteCourse');
    Route::delete('/deleteUser','Usercontroller@deleteUser');
});