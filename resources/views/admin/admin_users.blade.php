@extends('layouts.client')
@section('back')
    <a href="/admin" class="btn btn-primary" style="margin-left: 8px">Back</a>
@endsection
@section('style')
    <link rel="stylesheet" href="/css/admin_course_style.css">
@endsection
@section('sidebar')
    @include('partials.admin_sidebar')
@endsection
@section('content') 
    <button class="btn btn-primary mb-3 mt-3">Thêm user</button>
    <div class="table-responsive">
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">SDT</th>
                    <th scope="col">Email</th>
                    <th scope="col">Tài khoản</th>
                    <th scope="col">Admin</th>
                    <th scope="col">Thao Tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->user_name}}</td>
                    <td>{{$user->user_phone}}</td>
                    <td>{{$user->user_mail}}</td>
                    <td>{{$user->user_deposit}} VND</td>
                    <td>{{$user->user_isadmin}}</td>        
                    <td>
                        <a href="" class="btn btn-danger" onclick="Delete({{$user->id}},'/deleteUser')">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="page mt-4">
        {{$users->links('pagination::bootstrap-4')}}
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="/js/main.js"></script>
@endsection