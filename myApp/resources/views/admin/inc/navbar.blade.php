

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">Trang chủ</a>


    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link active" href="{{route('admin.index')}}">Trang chủ quản lý <span class="sr-only">(current)</span></a>
            </li>
            @role('admin')
            <li class="nav-item active">
                <a class="nav-link active" href="{{route('admin.rooms_classification.index')}}">Danh mục phòng <span class="sr-only">(current)</span></a>
            </li>
            @endrole
            <div class="dropdown">
                <a class="btn  dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Danh sách Blog
                </a>
                <ul class="dropdown-menu">
                    @role('admin')
                    <li><a class="dropdown-item" href="{{route('admin.blogs.index')}}">Tât cả blogs</a></li>
                    @endrole
                    <li><a class="dropdown-item" href="{{route('admin.blogs.myblogs')}}">Bài viết của tôi</a></li>
                    @can('manage blogs')
                        <li><a class="dropdown-item" href="{{route('admin.get_pending_blogs')}}">Duyệt bài Blogs</a>
                        </li>
                    @endcan
                </ul>
            </div>
            <div class="dropdown">
                <a class="btn  dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Đăng Phòng
                </a>
                <ul class="dropdown-menu">
                    @role('admin')
                    <li><a class="dropdown-item" href="{{route('admin.rooms.allRooms')}}">Tất cả các phòng hiện có - (admin)</a></li>
                    @endrole
                    <li><a class="dropdown-item" href="{{route('admin.rooms.myRooms')}}">Phòng của tôi</a></li>
                    <li><a class="dropdown-item" href="{{route('admin.rooms.create')}}">Đăng bài phòng</a></li>
                    @can('manage blogs')
                        <li><a class="dropdown-item" href="{{route('admin.rooms.getPendingRooms')}}">Tất cả bài cần duyệt</a>
                        </li>
                    @endcan
                </ul>
            </div>
            <div class="dropdown">
                <a class="btn  dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Nạp tiền vào tài khoản
                </a>
                <ul class="dropdown-menu">
                    @role('admin')
                    <li><a class="dropdown-item" href="{{route('admin.rooms.allRooms')}}">Kiểm tra toàn hệ thống (admin) --chưa update</a></li>
                    @endrole
                    <li><a class="dropdown-item" href="{{route('admin.user.paymentIndex')}}">Nạp tiền</a></li>
                    <li><a class="dropdown-item" href="{{route('admin.payment.historyPayment')}}">Lịch sử nạp tiền</a></li>
{{--                    <li><a class="dropdown-item" href="{{route('admin.rooms.create')}}">Đăng bài phòng</a></li>--}}
{{--                    @can('manage blogs')--}}
{{--                        <li><a class="dropdown-item" href="{{route('admin.rooms.getPendingRooms')}}">Tất cả bài cần duyệt</a>--}}
{{--                        </li>--}}
{{--                    @endcan--}}
                </ul>
            </div>
        </ul>
        @role('admin')
        <div class="dropdown">
            <a class="btn  dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Toàn quyền
            </a>

            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{route('admin.allUser')}}">Tất cả người dùng</a></li>
                <li><a class="dropdown-item" href="{{route('admin.addRole')}}">Gỡ vai trò</a></li>
            </ul>
        </div>
        @endrole


    </div>
</nav>
