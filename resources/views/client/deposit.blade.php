@extends('layouts.client')
@section('back')
    <a href="/" class="btn btn-primary" style="margin-left: 8px">Back</a>
@endsection
@section('style')
    <link rel="stylesheet" href="/css/addcourse_style.css">
@endsection
@section('sidebar')
    @include('partials.admin_sidebar')
@endsection
@section('content')
  <div class="form-container">
    <form action="/deposit" enctype="multipart/form-data" method="post" >
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Nhập số tiền cần nạp</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="deposit">
        <input type="text" value="{{Session::get('user')->id}}" name="id" hidden>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
      @csrf
    </form>
  </div>
@endsection 