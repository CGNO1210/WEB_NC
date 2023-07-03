<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\RegisterCourse;
use App\Models\Courses;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use DB;

class UserController extends Controller
{   
    public function getLoginPage()
    {
        return view('login');
    }

    public function loginAction(Request $request)
    {
        $username = $request ->input('login_name');
        $password = $request ->input('password');
        //xu ly loi khi nhap vao form
        $this->validate($request,[
            'login_name'=>'required',
            'password'=>'required'
        ]);

        if (Auth::attempt([
            'login_name'=> $request->input('login_name'),
            'password'=>$request->input('password')
        ])) {
            $data = User::where('login_name', $request ->input('login_name'))->first();
            Session()->put('user', $data);
            if($data->user_isadmin){
                Session()->put('admin', $data);
            }
            return redirect('/');
        }

        Session()->flash('error','login_name hoặc Password không chính xác');
        return redirect()->back();
    }

    public function getRegisterPage()
    {
        return view('register');
    }
    public function registerAction(Request $request)
    {
        $this->validate($request,[
            'user_name'=>'required',
            'login_name'=>['required',Rule::unique('users')],
            'password'=>'required',
            'user_mail'=>'required',
            'user_phone'=>'required',
        ]);

        User::create([
            'user_name' => $request->input('user_name'),
            'login_name' => $request->input('login_name'),
            'password' =>  Hash::make($request->input('password')),
            'user_mail' =>  $request->input('user_mail'),
            'user_phone' =>  $request->input('user_phone'),
            'slug' => Str::slug($request->input('user_name'), '-')
        ]);

        Session()->flash('success','Đăng ký thành công');
        return redirect('/login');
    }
    public function logout()
    {
        Session()->forget('user');
        if(Session()->has('admin'))
            Session()->forget('admin');
        return redirect('/');
    }

    public function editUser($user_name) {
        return view('edituser');
    }    
    public function updateUser($user_name,Request $request) {

        User::where('id', $request->input('id'))->update([
            'user_name' => $request->input('user_name'),
            'user_phone' => $request->input('user_phone'),
            'user_mail' => $request->input('user_mail'),
            'slug' =>  Str::slug($request->input('user_name'), '-'),
        ]);
        $data = User::where('id', Session()->get('user')->id)->first();
        Session()->put('user', $data);
        Session()->flash('success','Cập nhật thông tin thành công');
        return redirect('/');
    }    
    public function myCourses($user_name) {
        $user  = Session()->get('user', function() {
            return 0;
        });
        $user_id = 0;
        if($user) {
            $user_id = $user->id;
        }
        $registerCourses = RegisterCourse::where('user_id',$user_id)->get();
        return view('client.mycourses',[
            'pro_courses' => Courses::where('cour_price','>','0')->get(),
            'pro_courses_count' => Courses::where('cour_price','>','0')->count(),
            'free_courses' => Courses::where('cour_price','0')->get(),
            'free_courses_count' => Courses::where('cour_price','0')->count(),
            'registerCourses' => $registerCourses,
        ]);
    }
    public function deleteUser(Request $request) {
        $User = User::where('id',$request->input('id'))->first();
        if($User){
            if($User->delete()){
                return response()->json([
                    'error'=>'false',
                    'message'=>'Xóa User thành công'
                ]);
            }
            return response()->json([
                'error'=>'true',
                'message'=>'Xóa User KHÔNG thành công'
            ]);
        }
    }

}
