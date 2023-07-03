@extends('layouts.client')
@section('back')
    <a href="/" class="btn btn-primary" style="margin-left: 8px">Back</a>
@endsection
@section('style')
    <link rel="stylesheet" href="/css/learn_style.css">
@endsection
@section('sidebar')
    @include('partials.sidebar')
@endsection
@section('content')
    <div class="main">
        <div class="content">
            @if ($lesson_id)
            <div class="video">
                <video src="/video/{{$lesson_video}}" width="640" height="360" controls autoplay></video>
            </div>
            <div class="description">
                Mô tả: {{$lesson_description}}
            </div>
            <div class="comment">
                <div class="writecomment">
                    <form action="/courses/{$cour_name}}/learn" method="post" >
                        <input type="text" placeholder="Thêm comment" name="comment">
                        <input type="text" value="{{Session::get('user')->id}}" name="user_id" hidden>
                        <input type="text" name="lesson_id" value="{{$lesson_id}}" hidden>
                        @csrf
                        <button type="submit"> Đăng</button>
                    </form>
                </div>
                <div class="loadcomment">
                    <ul>
                        @foreach ($comments as $comment)
                        <li>
                            <h5>{{$comment->user_name}}</h5>
                            <p>{{$comment->comment}}</p>
                        </li>                        
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
        </div>
        @if ($chapters)
            <div class="chapters">
                <h4>Danh sách bài học</h4>
                @foreach ($chapters as $chapter)
                <div class="chapter">
                    <div class="chaptername">{{$chapter->chapter_name}}</div>
                    <div class="lessons">
                        @foreach ($lessons as $lesson)
                        @if ($lesson->chapter_id == $chapter->id)
                            <form action="">
                                <input type="text" hidden value="{{$lesson->id}}" name="lesson_id">
                                <button class="btn_lesson"><div class="lesson">{{$lesson->lesson_name}}</div></button>
                            </form>
                        @endif
                    @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        @else
            Đang cập nhật chương
        @endif
    </div>
    <script src="/js/learn.js"></script>
@endsection