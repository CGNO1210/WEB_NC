@extends('layouts.client')
@section('back')
    <a href="/" class="btn btn-primary" style="margin-left: 8px">Back</a>
@endsection
@section('style')
    <link rel="stylesheet" href="/css/admin_course_style.css">
@endsection
@section('sidebar')
    @include('partials.admin_sidebar')
@endsection
@section('content')
    <a href="/admin/addcourses" class="btn btn-primary mb-3 mt-3">Thêm khóa học</a>
    <div class="table-responsive">
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name course</th>
                    <th scope="col">Tổng Số Chương</th>
                    <th scope="col">Thao Tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                <tr>
                    <td>{{$course->id}}</td>
                    <td>{{$course->cour_name}}</td>
                    <td>{{$course->chuong}}</td>
                    <td style="display: flex;gap:10px">
                        <a href="/admin/{{$course->slug}}/edit" class="btn btn-secondary">Edit</a>
                        <form action="">
                            <button class="btn btn-danger"><a href="#" style="color: white">Delete</a></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="page mt-4">
        {{$courses->links('pagination::bootstrap-4')}}
    </div>
@endsection