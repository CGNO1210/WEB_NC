@extends('layouts.client')
@section('back')
    <a href="/admin" class="btn btn-primary" style="margin-left: 8px">Back</a>
@endsection
@section('style')
    <link rel="stylesheet" href="/css/edit_course_style.css">
@endsection
@section('sidebar')
    @include('partials.admin_sidebar')
@endsection
@section('content')
  <div class="form-container">
    <form class="" action="/admin/{{$course->slug}}/edit" enctype="multipart/form-data" method="post" >
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Course Name</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="cour_name" value="{{$course->cour_name}}">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Course Description</label>
        <textarea rows="3" type="text" class="form-control" id="exampleInputPassword1" name="cour_description">{{$course->cour_description}}</textarea>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Course Price</label>
        <input type="text" class="form-control" id="exampleInputPassword1" name="cour_price" value="{{$course->cour_price}}">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Course Image</label>
        {{-- <input type="file" name="fileTest"> --}}
        <div class="course_img mb-4">
          <img src="{{$course->cour_img}}" width="325px" height="180px" style="border-radius: 10px" alt="">
          {{-- <input type="text" value="{{$course->slug.'.'}}" hidden name="old_cour_img"> --}}
        </div>
        <input type="file" class="form-control" id="formFile" name="cour_img">
      </div>
      <button type="submit" class="btn btn-primary">Cập nhật</button>
      @csrf
    </form>
    <div class="course_content">
      <a class="btn btn-primary mb-3">Thêm Chương</a>
      <div class="children">
        <div for="exampleInputPassword1" class="form-label">Tên chương</div>
        <form class="add_chapter mb-3"  action="/admin/{{$course->slug}}/addchapter" enctype="multipart/form-data" method="post" >
          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="chapter_name">
          <button type="submit" class="btn btn-primary">Thêm</button>
          @csrf
        </form>
      </div>
      <div class="table-responsive">
          <table class="table table-dark">
              <thead>
                  <tr>
                      <th scope="col">Id</th>
                      <th scope="col">Name chapter</th>
                      <th scope="col">Tổng Bài Học</th>
                      <th scope="col">Thao Tác</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($chapters as $chapter)
                  <tr>
                      <td>{{$chapter->id}}</td>
                      <td>{{$chapter->chapter_name}}</td>
                      <td>{{$chapter->bai}}</td>
                      <td>
                          <a href="/admin/{{$course->slug}}/{{$chapter->chapter_slug}}/edit" class="btn btn-secondary">Edit</a>
                          <a href="" class="btn btn-danger" >Delete</a>
                      </td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
      <div class="page mt-4">
        {{$chapters->links('pagination::bootstrap-4')}}
    </div>
    </div>
  </div>
@endsection