@extends('layouts.client')

@section('style')
    <link rel="stylesheet" href="/css/route_style.css">
@endsection
@section('sidebar')
    @include('partials.sidebar')
@endsection
@section('content')
<div class="wrapper-container">
    <div class="title">
        <h1>Lộ trình học</h1>
        <p>Để bắt đầu một cách thuận lợi, bạn
            nên tập trung vào một
            lộ trình học. Ví dụ: Để đi làm với vị trí
            "Lập trình viên Front-end" bạn nên tập trung vào lộ
            trình "Front-end".</p>
    </div>
    <div class="form">
        <div class="route">
            <!--form 1-->
            <div class="wrapper-course-pro">
                <div class="inline-1">
                    <div class="route-content">
                        <h4>Lộ trình học Front-end</h4>
                        <p>Lập trình viên
                            Front-end là người
                            xây dựng ra giao diện websites. Trong phần
                            này F8 sẽ
                            chia sẻ cho bạn lộ trình để trở thành lập
                            trình viên
                            Front-end nhé.</p>
                    </div>
                    <div class="picture-217"><img src="./user 217.png" width="98px" height="98px"></div>
                </div>
                <button class="login-btn">Xem chi tiết</button>

            </div>
            <!--form 2-->
            <div class="wrapper-course-pro">
                <div class="inline-1">
                    <div class="route-content">
                        <h4>Lộ trình học Back-end</h4>
                        <p>Trái với Front-end thì
                            lập trình viên
                            Back-end là người làm việc với dữ liệu, công
                            việc thường nặng tính logic hơn. Chúng ta sẽ
                            cùng tìm hiểu thêm về lộ trình học Back-end
                            nhé.</p>
                    </div>
                    <div class="picture-217">
                        <img src="./user 218.png" width="98px" height="98px">
                    </div>
                </div>
                <button class="login-btn">Xem chi tiết</button>

            </div>
        </div>
        <!--Form-end-->
        <div class="form-end">
            <div>
                <h4>Tham gia cộng đồng học viên F8 trên Facebook</h4>
            <p>Hàng nghìn người khác đang học lộ trình giống như
                bạn. Hãy tham gia hỏi đáp, chia sẻ và hỗ trợ nhau
                trong quá trình học nhé.</p>
                <button>Tham gia nhóm</button>
            </div>
            <div><img src="./user 219.png"
                width="420px" alt=""></div>
        </div>

    </div>
</div>
@endsection