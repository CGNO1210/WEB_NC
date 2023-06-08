<div class="wrapper-nav-menu">
    <div class="icon-left">
        {{-- <div class="icon-df">
            <i class="fa fa-plus-circle" style="font-size: 48px; color: #1473e6"></i>
        </div> --}}
        @if (Session::has('admin'))
        <a href="/admin">
            <button class="icon-btn">
                <i class="fa fa-home" style="font-size: 24px"></i>
                <p class="home">Admin</p>
            </button>
        </a>            
        @endif
        <a href="/">
            <button class="icon-btn">
                <i class="fa fa-home" style="font-size: 24px"></i>
                <p class="home">Home</p>
            </button>
        </a>
        <a href="/route">
            <button class="icon-btn">
                <i class="fa fa-road" style="font-size: 24px"></i>
                <p>Lộ trình</p>
            </button>
        </a>
        <a href="/">
            <button class="icon-btn">
                <i class="fa fa-lightbulb-o" style="font-size: 24px"></i>
                <p>Học</p>
            </button>
        </a>
        <a href="/blog">
            <button class="icon-btn">
                <i class="fa fa-newspaper-o" style="font-size: 24px"></i>
                <p>Blog</p>
            </button>
        </a>
    </div>
</div>