@extends('layouts.client')
@section('back')
    <a href="/" class="btn btn-primary" style="margin-left: 8px">Back</a>
@endsection
@section('style')
    <link rel="stylesheet" href="/css/blog_style.css">
@endsection
@section('sidebar')
    @include('partials.sidebar')
@endsection
@section('content')
<div class="main">
    <div class="title">
        <h1>Bài viết nổi bật</h1>
        <p>Tổng hợp các bài viết chia sẻ về kinh nghiệm tự
            học
            lập trình online và các kỹ thuật lập trình web.</p>
    </div>
    <div class="content">
        <div class="posts">
            @for ($i = 0; $i < 7; $i++)
            <div class="post-item">
                <div class="post-header">
                    <div class="post-author">
                        <div class="avartar">
                            <img src="/img/users_img/user-22.jpg" width="30px" height="30px" style="border-radius: 30px">
                        </div>
                        <span>Vịt Vịt</span>
                    </div>
                    <div class="post-action">
                        <i class="fa fa-bookmark-o"></i>
                        <i class="fa fa-ellipsis-h"></i>
                    </div>
                </div>
                <div class="post-body">
                    <div class="post-description">
                        <div>
                            <h3>Ngành gì đang hot hiện nay?Top ngành nghề dự báo trở thành xu thế</h3>
                            <p>
                                Nếu bạn đang phân vân trong việc chọn ngành, chuyển ngành thì có thể tham khảo bài viết này
                                để biết ngành gì đang hot hiện nay và...
                            </p>
                        </div>
                        <div class="post-info">
                            <button>IT</button>
                            <div>3 tháng trước </div>
                            <div>7 phút đọc</div>
                        </div>
                    </div>
                    <div class="post-img">
                        <img src="/img/React_JS.png" width="200px" height="120px" style="border-radius: 15px;">
                    </div>
                </div>
            </div>
            @endfor
        </div>
        <div class="advertisement">
        </div>
    </div>
</div>
@endsection