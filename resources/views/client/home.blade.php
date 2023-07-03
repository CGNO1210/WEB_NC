@extends('layouts.client')

@section('back')
    <h4>Học Lập Trình Để Đi Làm</h4>
@endsection
@section('style')
    <link rel="stylesheet" href="/css/home_style.css">
@endsection
@section('sidebar')
    @include('partials.sidebar')
@endsection
@section('content')
<div class="main">
    {{-- @include('header') --}}
    {{-- @include('sidebar') --}}
    <div class="wrapper-container ">
        <!--slide-->
        {{-- pro courses --}}
        {{-- class đã xóa wrapper-coure-pro -> courses ,wrapper-image -> course-image --}}
        <div class="title pro mt-6">
            <h2 >Khóa học Pro <span>mới</span></h2>
        </div>
        <div class="courses ">    
            {{-- render từng khóa học --}}
            @for ($i = 0; $i < $pro_courses_count; $i++)
                {{$a = false}}
                @foreach ($registerCourses as $item)
                    @if ($item->course_id == $pro_courses[$i]->id)
                        <h1 hidden>{{$a = true}}</h1>
                    @endif
                @endforeach
                @if ($a)
                <a href="/courses/{{$pro_courses[$i]->slug}}/learn">  
                @else
                <a href="/courses/{{$pro_courses[$i]->slug}}">
                @endif
                    <div class="courses-item">
                        <div class="course-image">
                            <img src="/img/{{$pro_courses[$i]->cour_img}}" height="168px" width="298px" alt="img" />
                            {{-- <div class="see-more"><div>Xem khóa học</div></div> --}}
                            <div class="see-more">
                                <div>
                                    @if($a)
                                        Tiếp tục học                                
                                    @else
                                        Xem khóa học
                                    @endif    
                                </div>
                            </div>
                        </div>
                        <div class="course-name">{{$pro_courses[$i]->cour_name}}</div>
                        <div class="price">
                            <span>{{$pro_courses[$i]->cour_price}} VND</span>
                        </div>
                    </div>
                </a>
            @endfor
        </div>
    </div>
    <div style="clear:both;"></div>
    {{-- free courses --}}
    <div class="title free">
        <h2>Khóa học miễn phí</h2>
        <div class="more">
            <a class="see-route" href="/route" style="color: #f05123;">Xem lộ trình</a>
            <i style="font-size:24px" class="fa">&#xf105;</i>
        </div>
    </div>
    <div class="courses">
        {{-- render từng khóa học --}}
        @for ($i = 0; $i < $free_courses_count; $i++)
            {{$a = false}}
            @foreach ($registerCourses as $item)
                @if ($item->course_id == $free_courses[$i]->id)
                    <h1 hidden>{{$a = true}}</h1>
                @endif
            @endforeach
            @if ($a)
            <a href="/courses/{{$free_courses[$i]->slug}}/learn">  
            @else
            <a href="/courses/{{$free_courses[$i]->slug}}">
            @endif
                <div class="courses-item">
                    <div class="course-image">
                        <img src="/img/{{$free_courses[$i]->cour_img}}" height="168px" width="298px" alt="img" />
                        {{-- <div class="see-more"><div>Xem khóa học</div></div> --}}
                        <div class="see-more">
                            <div>
                                @if($a)
                                    Tiếp tục học                                
                                @else
                                    Xem khóa học
                                @endif    
                            </div>
                        </div>
                    </div>
                    <div class="course-name">{{$free_courses[$i]->cour_name}}</div>
                    <div class="viewer">
                        <div><i class="fa fa-users"></i></div> <span>8.807</span>
                    </div>
                </div>
            </a>
        @endfor
    </div>   
    <div style="clear:both;"></div>            
    {{-- @include('footer') --}}
</div>
@endsection