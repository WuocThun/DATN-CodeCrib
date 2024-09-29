
    <nav class="navbar navbar-expand-lg bg-body-tertiary ">
        <div class="container-fluid">
            @role('admin')
            <a class="navbar-brand" href="#">Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link active" aria-current="page" href="#">Home</a>--}}
{{--                    </li>--}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Quản lí người dùng
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
                @endrole
                @role('houseRent')
            <a class="navbar-brand" href="#">Người cho thuê nhà</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link active" aria-current="page" href="#">Home</a>--}}
{{--                    </li>--}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Quản lí nhà cho thuê
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Đăng nhà</a></li>
                            <li><a class="dropdown-item" href="#">Tổng quan bài viết</a></li>
                            @role('admin')
                            <li><a class="dropdown-item" href="#">Dành cho trang quản trị</a></li>
                            @endrole
                        </ul>
                    </li>
                </ul>
                @endrole
            </div>
        </div>
    </nav>
