<header class="navbar">
    <div class="navbar-top">
        <div class="logo">
            <img class="img-fluid" src="{{asset('uploads/logoCodeCrib.png')}}">
        </div>
        @if (Auth::check())
            <div class="user-info">
                <div class="imguser">
                    <img class="img-fluid rounded-circle " src="{{asset('uploads/users/'.Auth::user()->avatar)}}">
                </div>

                <div class="flexinfo">
                    <span>Xin chào, <b>{{ Auth::user()->name }}</b></span>
                    <span>Mã tài khoản: {{ Auth::user()->rand_code_user }}</span>
                    <span>TK Chính: <b>{{ number_format(Auth::user()->balance, 0, ',', '.') }} VNĐ</b></span>
                </div>
                <span class="icon"><a href="{{route('wishlist.list')}}">Yêu thích</a></span>
                <span class="icon"><a href="{{route('admin.dashboardCore')}}">Quản lý tài khoản</a></span>

                <button class="btn-dang-tin">Đăng tin miễn phí</button>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')"
                                     onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
                @else
                    <div class="user-info">
                        <div class="flexinfo">
                        </div>
                        <a href="{{route('getLogin')}}" style="text-decoration: none;">
                            <button class="btn">Đăng nhập</button>
                        </a>

                        <a href="{{route('getReginster')}}" style="text-decoration: none;">
                            <button class="btn highlight">Đăng ký</button>
                        </a>
                        @endif

                    </div>
            </div>
            <nav class="navbar-bottom">
                <nav class="main-nav">
                    <ul class="text-center d-flex justify-content-center">
                        <li class="mx-3">
                            <a class="" href="{{ route('welcome') }}">Trang chủ</a>
                        </li>
                        @foreach($clasRoom as $class => $cl)
                            <li class="mx-3"><a class="" href="{{ route('laydichvu', $cl->slug) }}">{{ $cl->title }}</a>
                            </li>
                        @endforeach
                        <li class="mx-3"><a class="" href="{{ route('room-requests.index') }}">Đăng ký phòng trọ</a>
                        </li>
                        <li class="mx-3"><a class="" href="{{ route('viewRequests') }}">Đăng ký ở ghép</a></li>
                        <li class="mx-3"><a class="" href="{{ route('indexBlog') }}">Tin tức</a></li>
                        <li class="mx-3"><a class="" href="{{ route('dichvu') }}">Dịch vụ</a></li>
                    </ul>
                </nav>
            </nav>
</header>
