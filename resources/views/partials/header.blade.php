<div class="wrapper-header">
    <!--Phần đầu-->
    <!--cụm-1-->
    <div class="header">
        <img class="img-f8" src="/img/f8-logo.png" alt />
        <h4>Học Lập Trình Để Đi Làm</h4>
    </div>
    <!--cụm-2-->
    <div>
        <div class="Wrapper-input-search">
            <span><i class="fa fa-search"></i></span>
            <input type="text" class="input-search"
                placeholder="Tìm kiếm khóa học, bài viết, video..." />
        </div>
    </div>

    <!--cụm-3-->
    @if (Session::has('user'))
        <div class="dropdown" dropdown>
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false" >
                Welcome {{ Session::get('user')->user_name}}
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/member/edit">Edit profile</a></li>
                <div class="dropdown-divider"></div>
                <li><a class="dropdown-item" href="/logout">Logout</a></li>
            </ul>
        </div>
        @else
        <a href="login">    
            <button class="login-btn">Đăng nhập</button>
        </a>
        @endif
</div>