
<nav class="d-none d-lg-block bg-light sidebar">
    <div class="user_info">
        <a href="#" class="clearfix">
            <div class="center">
                <img class="img-fluid" src="{{asset('uploads/logoCodeCrib.png')}}">

{{--                <img src="{{asset('uploads/defaultAvatar.jpg')}}">--}}
</div>
            <div class="user_meta">
                <div class="inner">
                    <div class="user_name">{{Auth::user()->name}}</div>
                    <div class="user_verify" style="color: #555; font-size: 0.9rem;">{{Auth::user()->phone_number}}</div>
                </div>
            </div>
        </a>
        <ul>
            <li><span>Mã thành viên:</span> <span style="font-weight: 700;"> {{Auth::user()->id}}</span></li>
            <li><span>TK Chính:</span> <span style="font-weight: 700;"> {{ number_format(Auth::user()->balance, 0, ',', '.') }}</span></li>

        </ul>
        <div class="row">
            <div class="col">
                <a class="btn btn-warning" href="{{route('admin.trangChuNapThe')}}">Nạp
                    tiền</a>
            </div>
            <div class="col">

                <a class="btn btn-danger" href="{{route('admin.roomsCore.createCore')}}">Đăng
                    tin</a>
            </div>
        </div>
    </div>
    @role('admin')
    <div class="dropdown mb-1">
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
        Quản lý
        </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <li><a class="dropdown-item" href="#">Quản lý tất cả các phòng tin</a></li>
            <li><a class="dropdown-item" href="#">Quản lý tất cả người dùng</a></li>
            <li><a class="dropdown-item" href="#">Quản lý tất cả báo cáo</a></li>
            <li><a class="dropdown-item" href="#">Thống kê doanh thu</a></li>
        </ul>
    </div>
    @endrole
    <div class="dropdown mb-1" >
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
            Quản lý các bài đăng
        </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <li><a class="dropdown-item" href="{{route('admin.roomsCore.createCore')}}">Đăng tin mới</a></li>
            <li><a class="dropdown-item" href="{{route('admin.phongcuatoi')}}">Các tin đã đăng</a></li>
            <li><a class="dropdown-item" href="#">Các tin đang đợi duyệt</a></li>
            @role('admin')
            <li><a class="dropdown-item" href="#">Tất cả các phòng hiện có</a></li>
            @endrole
        </ul>
    </div>
    <div class="dropdown mb-1" >
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
            Nạp tiền
        </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <li><a class="dropdown-item" href="#">Nạp tiền</a></li>
            <li><a class="dropdown-item" href="#">Lịch sử nạp tiền</a></li>
            <li><a class="dropdown-item" href="#">Lịch sử thanh toán</a></li>
        </ul>
    </div>
    <div class="dropdown mb-1" >
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
            Sự kiện
        </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <li><a class="dropdown-item" href="{{route('admin.wheel.index')}}">Vòng quay may mắn</a></li>
        </ul>
    </div>
    <div class="dropdown mb-1" >
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
            Quản lý phòng trọ
        </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <li><a class="dropdown-item" href="{{route('admin.motel.index')}}">Danh sách trọ của bạn</a></li>
            @role('houseRenter||admin')
            <li><a class="dropdown-item" href="{{route('admin.motel.index')}}">Danh sách các phòng trọ</a></li>
            <li><a class="dropdown-item" href="{{route('admin.invoices.getIndexInvoice')}}">Danh sách các hoá đơn</a></li>
            <li><a class="dropdown-item" href="{{route('admin.invoices.motelReport')}}">Báo cáo</a></li>
            <li><a class="dropdown-item" href="#">Lịch sử thanh toán</a></li>
            @endrole

        </ul>
    </div>
    <div class="dropdown mb-1" >
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
            Người dùng
        </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <li><a class="dropdown-item" href="#">Chỉnh sửa tài khoản</a></li>
            <li>
                <a class="dropdown-item" href="#"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Đăng xuất
                </a>
                <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>

    </div>

{{--    <ul class="nav-sidebar">--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link " href="{{route('admin.phongcuatoi')}}">--}}
{{--                <svg xmlns="" width="16" height="16" viewBox="0 0 24 24" fill="none"--}}
{{--                     stroke="currentColor" stroke-width="2" stroke-linecap="round"--}}
{{--                     stroke-linejoin="round" class="feather feather-file-text">--}}
{{--                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>--}}
{{--                    <polyline points="14 2 14 8 20 8"></polyline>--}}
{{--                    <line x1="16" y1="13" x2="8" y2="13"></line>--}}
{{--                    <line x1="16" y1="17" x2="8" y2="17"></line>--}}
{{--                    <polyline points="10 9 9 9 8 9"></polyline>--}}
{{--                </svg>--}}
{{--                Quản lý tin đăng--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link " href="cap-nhat-thong-tin-ca-nhan.html">--}}
{{--                <svg xmlns="" width="16" height="16" viewBox="0 0 24 24" fill="none"--}}
{{--                     stroke="currentColor" stroke-width="2" stroke-linecap="round"--}}
{{--                     stroke-linejoin="round" class="feather feather-edit">--}}
{{--                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>--}}
{{--                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>--}}
{{--                </svg>--}}
{{--                Sửa thông tin cá nhân--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link " href="{{route('admin.trangChuNapThe')}}">--}}
{{--                <svg xmlns="" width="16" height="16" viewBox="0 0 24 24" fill="none"--}}
{{--                     stroke="currentColor" stroke-width="2" stroke-linecap="round"--}}
{{--                     stroke-linejoin="round" class="feather feather-dollar-sign">--}}
{{--                    <line x1="12" y1="1" x2="12" y2="23"></line>--}}
{{--                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>--}}
{{--                </svg>--}}
{{--                Nạp tiền vào tài khoản--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link " href="{{route('admin.lichSuNapThe')}}">--}}
{{--                <svg xmlns="" width="16" height="16" viewBox="0 0 24 24" fill="none"--}}
{{--                     stroke="currentColor" stroke-width="2" stroke-linecap="round"--}}
{{--                     stroke-linejoin="round" class="feather feather-clock">--}}
{{--                    <circle cx="12" cy="12" r="10"></circle>--}}
{{--                    <polyline points="12 6 12 12 16 14"></polyline>--}}
{{--                </svg>--}}
{{--                Lịch sử nạp tiền--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link " href="{{route('admin.getPaymentRoom')}}">--}}
{{--                <svg xmlns="" width="16" height="16" viewBox="0 0 24 24" fill="none"--}}
{{--                     stroke="currentColor" stroke-width="2" stroke-linecap="round"--}}
{{--                     stroke-linejoin="round" class="feather feather-calendar">--}}
{{--                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>--}}
{{--                    <line x1="16" y1="2" x2="16" y2="6"></line>--}}
{{--                    <line x1="8" y1="2" x2="8" y2="6"></line>--}}
{{--                    <line x1="3" y1="10" x2="21" y2="10"></line>--}}
{{--                </svg>--}}
{{--                Lịch sử thanh toán--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link " href="" target="_blank">--}}
{{--                <svg xmlns="" width="16" height="16" viewBox="0 0 24 24" fill="none"--}}
{{--                     stroke="currentColor" stroke-width="2" stroke-linecap="round"--}}
{{--                     stroke-linejoin="round" class="feather feather-clipboard">--}}
{{--                    <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2">--}}
{{--                    </path>--}}
{{--                    <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>--}}
{{--                </svg>--}}
{{--                Bảng giá dịch vụ--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item mb-2">--}}
{{--            <a class="nav-link " href="{{route('admin.wheel.index')}}" target="_blank">--}}
{{--                <svg xmlns="" width="16" height="16" viewBox="0 0 24 24" fill="none"--}}
{{--                     stroke="currentColor" stroke-width="2" stroke-linecap="round"--}}
{{--                     stroke-linejoin="round" class="feather feather-clipboard">--}}
{{--                    <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2">--}}
{{--                    </path>--}}
{{--                    <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>--}}
{{--                </svg>--}}
{{--                Vòng quay may mắn--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="">--}}
{{--                <svg xmlns="" width="16" height="16" viewBox="0 0 24 24" fill="none"--}}
{{--                     stroke="currentColor" stroke-width="2" stroke-linecap="round"--}}
{{--                     stroke-linejoin="round" class="feather feather-message-circle">--}}
{{--                    <path--}}
{{--                        d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">--}}
{{--                    </path>--}}
{{--                </svg>--}}
{{--                Liên hệ--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link js-user-logout" href="thoat">--}}
{{--                <svg xmlns="" width="16" height="16" viewBox="0 0 24 24" fill="none"--}}
{{--                     stroke="currentColor" stroke-width="2" stroke-linecap="round"--}}
{{--                     stroke-linejoin="round" class="feather feather-log-out">--}}
{{--                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>--}}
{{--                    <polyline points="16 17 21 12 16 7"></polyline>--}}
{{--                    <line x1="21" y1="12" x2="9" y2="12"></line>--}}
{{--                </svg>--}}
{{--                Thoát--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <a class="nav-link js-user-logout" href="javascript:void(0)"--}}
{{--           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">--}}
{{--            <svg xmlns="" width="16" height="16" viewBox="0 0 24 24" fill="none"--}}
{{--                 stroke="currentColor" stroke-width="2" stroke-linecap="round"--}}
{{--                 stroke-linejoin="round" class="feather feather-log-out">--}}
{{--                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 1 2 2h4"></path>--}}
{{--                <polyline points="16 17 21 12 16 7"></polyline>--}}
{{--                <line x1="21" y1="12" x2="9" y2="12"></line>--}}
{{--            </svg>--}}
{{--            Thoát--}}
{{--        </a>--}}
{{--        <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">--}}
{{--            @csrf--}}
{{--        </form>--}}

{{--    </ul>--}}
</nav>
{{--<form method="POST" action="{{ route('logout') }}">--}}
{{--    @csrf--}}

{{--    <x-dropdown-link :href="route('logout')"--}}
{{--                     onclick="event.preventDefault();--}}
{{--                                                this.closest('form').submit();">--}}
{{--        {{ __('Log Out') }}--}}
{{--    </x-dropdown-link>--}}
{{--</form>--}}
