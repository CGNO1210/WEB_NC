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
    <div class="wrapper-container">
        <!--slide-->
        <div class="nav-main-right">
            <div class="img1-btn">
                <div class="list-btn">
                    <div class="title">Khóa học HTML CSS Pro</div>
                    <p>
                        Đây là khóa học đầy đủ và chi tiết nhất bạn có
                        thể tìm thấy được
                        ở trên Internet
                    </p>
                    <div class="title-2">Tìm hiểu thêm</div>
                </div>
                <div class="img-1"><img src="./6308a6bf603a4.png" alt /></div>
            </div>
        </div>
        {{-- pro courses --}}
        {{-- class đã xóa wrapper-coure-pro -> courses ,wrapper-image -> course-image --}}
        <div class="title pro ">
            <h2 >Khóa học Pro <span>mới</span></h2>
        </div>
        <div class="courses">    
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
                            <img src="{{$pro_courses[$i]->cour_img}}" height="168px" width="298px" alt="img" />
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
                            <del>2.499.000đ</del> <span>1.299.000đ</span>
                        </div>
                    </div>
                </a>
            @endfor
        </div>
    </div>
    <div style="clear:both;"></div>
    <div class="quantity">316.154+ người khác đã học</div>
    {{-- free courses --}}
    <div class="title free">
        <h2>Khóa học miễn phí</h2>
        <div class="more">
            <a class="see-route" href="" style="color: #f05123;">Xem lộ trình</a>
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
                        <img src="{{$free_courses[$i]->cour_img}}" height="168px" width="298px" alt="img" />
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