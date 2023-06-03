<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return "hello";
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
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
            if(1){
                $data = DB::table('users')->select('user_name','login_name')->where('login_name', $request ->input('login_name'))->first();
                Session()->put('user', $data);
                return redirect('/');
            }
            else{
                return view('admin');
            }
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
        ]);
        return 'inserted successfully';
    }
    public function logout()
    {
        Session()->forget('user');
        return redirect('/');
    }
}
