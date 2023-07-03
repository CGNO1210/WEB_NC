@extends('layouts.client')
@section('back')
    <a href="/admin/{{$name_course}}/{{$name_chapter}}/edit" class="btn btn-primary" style="margin-left: 8px">Back</a>
@endsection
@section('style')
    <link rel="stylesheet" href="/css/addcourse_style.css">
@endsection
@section('sidebar')
    @include('partials.admin_sidebar')
@endsection
@section('content')
  <div class="form-container">
    <form action="/admin/{{$name_course}}/{{$name_chapter}}/addlesson" enctype="multipart/form-data" method="post" >
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Name lesson</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="lesson_name">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Lesson description</label>
        <textarea rows="3" type="text" class="form-control" id="exampleInputPassword1" name="lesson_description"></textarea>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Lesson video</label>
        <input type="file" class="form-control" id="formFile" name="lesson_video" accept=".mp4">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
      @csrf
    </form>
  </div>
@endsection