<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container">
        <a class="navbar-brand" routerLink="/">Course App</a>
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <li class="nav-item">
                <a class="nav-link" routerLink="#" routerLinkActive="active">Matches</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" routerLink="#" routerLinkActive="active">List</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" routerLink="#" routerLinkActive="active">Messages</a>
            </li>
        </ul>
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
        <button class="btn btn-success" style="margin-right: 8px" type="button"><a style="text-decoration:none;color:white" href="/login">Login</a></button>
        <button class="btn btn-success " type="button"><a style="text-decoration:none;color:white" href="/register">Register</a></button>
        @endif

        {{-- <form class="d-flex" role="search"
            (ngSubmit)="login()" autocomplete="off">
            <input name="username" class="form-control me-2" type="text"
                placeholder="Username">
            <input name="password" class="form-control me-2" type="password"
                placeholder="Password">
            <button class="btn btn-success" type="submit">Login</button>
        </form> --}}
    </div>
</nav>