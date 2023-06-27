@extends('layouts.client')

@section('back')
    <a href="/admin/{{$name_course}}/edit" class="btn btn-primary" style="margin-left: 8px">Back</a>
@endsection
@section('style')
    <link rel="stylesheet" href="/css/edit_course_style.css">
@endsection
@section('sidebar')
    @include('partials.admin_sidebar')
@endsection
@section('content')
  <div class="form-container">
    <div class="course_content">
      <div for="exampleInputPassword1" class="form-label">Tên chương</div>
      <form class="add_chapter mb-3"  action="/admin/{{$name_course}}/{{$name_chapter}}/edit" enctype="multipart/form-data" method="post" >
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="chapter_name" value="{{$chapter->chapter_name}}">
        <button type="submit" class="btn btn-primary" style="min-width: 100px">Cập nhật</button>
        @csrf
      </form>
      <a href="/admin/{{$name_course}}/{{$name_chapter}}/addlesson" class="btn btn-primary mb-3 mt-3">Thêm bài học</a>
      <div class="table-responsive">
          <table class="table table-dark">
              <thead>
                  <tr>
                      <th scope="col">Id</th>
                      <th scope="col">Name Lesson</th>
                      <th scope="col">Tổng thời lượng</th>
                      <th scope="col">Thao Tác</th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($lessons as $lesson)
                  <tr>
                      <td>{{$lesson->id}}</td>
                      <td>{{$lesson->lesson_name}}</td>
                      <td>0</td>
                      <td>
                          <a href="/admin/{{$name_course}}/{{$name_chapter}}/{{$lesson->lesson_slug}}/edit" class="btn btn-secondary">Edit</a>
                          <a href="" class="btn btn-danger" >Delete</a>
                      </td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
        </div>
        <div class="page mt-4">
            {{$lessons->links('pagination::bootstrap-4')}}
        </div>
    </div>
  </div>
@endsection