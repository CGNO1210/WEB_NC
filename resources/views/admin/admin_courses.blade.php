@extends('layouts.client')

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
                    <th scope="col">Chương</th>
                    <th scope="col">Bài học</th>
                    <th scope="col">Tổng thời lượng</th>
                    <th scope="col">Thao Tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                <tr>
                    <td>{{$course->id}}</td>
                    <td>{{$course->cour_name}}</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>
                        <a href="/admin/{{$course->slug}}/edit" class="btn btn-secondary">Edit</a>
                        <a href="" class="btn btn-danger" >Delete</a>
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