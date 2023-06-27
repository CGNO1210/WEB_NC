@extends('layouts.client')

@section('style')
    <link rel="stylesheet" href="/css/addcourse_style.css">
@endsection
@section('sidebar')
    @include('partials.admin_sidebar')
@endsection
@section('content')
  <div class="form-container">
    <form action="/{{Session::get('user')->slug}}/edit" enctype="multipart/form-data" method="post" >
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">User name</label>
        <input type="text" class="form-control" id="exampleInputPassword1" name="user_name" value="{{Session::get('user')->user_name}}">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Số Điện Thoại</label>
        <input type="text" class="form-control" id="exampleInputPassword1" name="user_phone" value="{{Session::get('user')->user_phone}}">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Email</label>
        <input type="text" class="form-control" id="exampleInputPassword1" name="user_mail" value="{{Session::get('user')->user_mail}}">
      </div>
      <input type="text" name="id" value="{{Session::get('user')->id}}" hidden>
      <button type="submit" class="btn btn-primary">Submit</button>
      @csrf
    </form>
  </div>
@endsection