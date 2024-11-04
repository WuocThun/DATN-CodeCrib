<nav x-data="{ open: false }" class="bg-dark dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
{{--                                        <a href="{{ route('/') }}">--}}
{{--                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200"/>--}}
{{--                                        </a>--}}
                <span>
    <img width="50px" height="50px" src="{{asset('uploads/'.Auth::user()->avatar)}}" alt="">
</span>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @role('admin')
                    <x-nav-link>
                        {{ __('Admin') }}
                    </x-nav-link>
                    @endrole
                    @role('houseRenter')
                    <x-nav-link>
                        {{ __('Người cho thuê nhà') }}
                    </x-nav-link>
                    @endrole
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-dark dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            {{--            <x-responsive-nav-link :href="route('admin')" :active="request()->routeIs('dashboard')">--}}
            {{ __('Dashboard') }}
            {{--            </x-responsive-nav-link>--}}
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                                           onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>


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
