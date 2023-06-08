@extends('layouts.client')

@section('style')
    <link rel="stylesheet" href="/css/course_detail_style.css">
@endsection
@section('sidebar')
    @include('partials.sidebar')
@endsection
@section('content')
<div class="main">
    <div class="course-content">
        <h2>{{ $data->cour_name }}</h2>
        <p>{{$data->cour_description}}</p>
        <h3>Nội dung khóa học</h3>
        <div class="course-info">
            <div class="chapter"></div>
            <div class="lesson"></div>
            <div class="total-time"></div>
        </div>
        <div class="detail-course"></div>
    </div>
    <div class="course-action">
        <div class="course-review">
            <img src="{{$data->cour_img}}" alt="">
        </div>
        <h2>Miễn phí</h2>
        <form action="" method="post">
            <input type="text" value="{{$data->id}}" name="cour_id" hidden>
            <input type="text" value="{{Session::get('user')->id}}" name="user_id" hidden>
            <button type="submit">Đăng kí học</button>
        </form>
        <div class="action-info">
            <div class="item">
                <i class="fa fa-users"></i>
                <div>Trình độ cơ bản</div>
            </div>
            <div class="item">
                <i class="fa fa-users"></i>
                <div>Tổng số 138 bài học</div>
            </div>
            <div class="item">
                <i class="fa fa-users"></i>
                <div>Thời lượng 10 giờ 29 phút</div>
            </div>
            <div class="item">
                <i class="fa fa-users"></i>
                <div>Học mọi lúc, mọi nơi</div>
            </div>
        </div>
    </div>
</div>
@endsection