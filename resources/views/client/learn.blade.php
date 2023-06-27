@extends('layouts.client')

@section('style')
    <link rel="stylesheet" href="/css/learn_style.css">
@endsection
@section('sidebar')
    @include('partials.sidebar')
@endsection
@section('content')
    <div class="main">
        <div class="content">
            <div class="video">
                <img src="/img/video/HTML_CSS_Pro.png" alt="">
                
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
        </div>
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
                            <button><div class="lesson">{{$lesson->lesson_name}}</div></button>
                        </form>
                    @endif
                @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <script src="/js/learn.js"></script>
@endsection