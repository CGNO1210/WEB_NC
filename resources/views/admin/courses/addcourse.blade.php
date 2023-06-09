@extends('layouts.client')
@section('back')
    <a href="/admin" class="btn btn-primary" style="margin-left: 8px">Back</a>
@endsection
@section('style')
    <link rel="stylesheet" href="/css/addcourse_style.css">
@endsection
@section('sidebar')
    @include('partials.admin_sidebar')
@endsection
@section('content')
  <div class="form-container">
    <form action="/admin/addcourses" enctype="multipart/form-data" method="post" >
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Course Name</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="cour_name">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Course Description</label>
        <textarea rows="3" type="text" class="form-control" id="exampleInputPassword1" name="cour_description"></textarea>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Course Price</label>
        <input type="text" class="form-control" id="exampleInputPassword1" name="cour_price">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Course Image</label>
        {{-- <input type="file" name="fileTest"> --}}
        <input type="file" class="form-control" id="formFile" name="cour_img">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
      @csrf
    </form>
  </div>
@endsection