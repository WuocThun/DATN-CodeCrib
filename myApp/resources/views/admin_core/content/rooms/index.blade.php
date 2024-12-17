@extends('admin_core.layouts.app')
@section('navbar')
    @include('admin_core.inc.navbar')
@endsection
@section('main')
    <main role="main" class="ml-sm-auto col">
        @include('admin_core.inc.sub_main')

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('welcome')}}">Code Crib</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.dashboardCore')}}">Quản lý</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Đăng tin mới</li>
            </ol>
        </nav>
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Quản lý tin đăng</h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="dropdown mr-1">
                <form class="form_search">
                    <div class="input-group input-group-search">
                        <input style="padding:2px; width: 200px; border-color:#6c757d;" type="text"
                               name="s" value="" class="form-control"
                               placeholder="Tìm theo mã tin hoặc tiêu đề">
                    </div>
                </form>
            </div>
            <div class="dropdown mr-1">
                <button class="btn btn-outline-secondary dropdown-toggle btn-sm" type="button"
                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                    Lọc theo loại VIP
                </button>
            </div>
            <div class="dropdown mr-1">
                <button class="btn btn-outline-secondary dropdown-toggle btn-sm" type="button"
                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                    Lọc theo trạng thái
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="./tin-dang.html?status=publish&amp;package=all">Tin
                        đang hiển thị</a>
                    <a class="dropdown-item" href="./tin-dang.html?status=expired&amp;package=all">Tin
                        hết hạn</a>
                    <a class="dropdown-item" href="./tin-dang.html?status=hidden&amp;package=all">Tin
                        đang ẩn</a>
                </div>
            </div>
            <a class="btn btn-danger btn-sm d-none d-md-block" href="{{route('admin.roomsCore.createCore')}}">Đăng tin
                mới</a>
            <div class="d-lg-none" style="width: 100%;"><a class="btn btn-danger btn-block mt-3"
                                                           href="{{route('admin.roomsCore.createCore')}}">Đăng tin mới</a></div>
        </div>

    </div>

    <div class="d-none d-md-block">
        <div class="table-responsive">
            <table class="table table_post_listing table-bordered _table-hover">
                <thead>
                <tr>
                    <th>Mã tin</th>
                    <th style="text-align: center; white-space: nowrap;">Ảnh đại diện</th>
                    <th>Tiêu đề</th>
                    <th>Giá</th>
                    <th style="white-space: nowrap;">Trạng thái</th>
                    <th style="white-space: nowrap;">Địa chỉ</th>
                    <th style="white-space: nowrap;">Quản lý</th>
                </tr>
                </thead>
                <tbody>
        @if($rooms->isEmpty())
                <tr>
                    <td colspan="7">Bạn chưa có tin đăng nào. Bấm <a href="{{route('admin.roomsCore.createCore')}}">vào
                            đây</a> để bắt đầu đăng tin</td>
                </tr>
        @else
            @foreach($rooms as $room => $data)
            <tr>
                <td># {{$data->id}}</td>
                <td></td>
                <td>{{$data->title}}</td>
                <td>{{number_format($data->price,0,',', '.')}}Ngìn</td>
                <td>
                    @if($data->status == 1)
                        <p class="text-success btn">Phòng đã được duyệt </p>
                    @elseif($data->status == 0)

                        <p class="text-warning btn">Phòng đang đợi QTV duyệt</p>
                    @elseif($data->status == 3)
                        <p class="text-danger btn">Phòng đã bị từ chối</p>
                    @else
                        <p class="text-danger btn">Phòng Không hiển thị </p>
                    @endif
                </td>                <td>{{$data->full_address}}</td>
                <td> <a class="btn btn-warning"  href="{{route('admin.rooms.edit',$data->id)}}">Sửa</a>
                    <a class="btn btn-primary"  href="{{route('admin.vip.packages',$data->id)}}">Kích hoạt vip</a>

                    <form method="post"  action="{{route('admin.rooms.destroy',[$data->id])}}">
                        @method('DELETE')
                        @csrf
                        <button onclick="return confirm('Bạn có muốn xoá?')" class="btn btn-danger">Xoá</button>
                    </form></td>
            </tr>
            @endforeach
        @endif
                </tbody>
            </table>
        </div>


        <!-- end pagination -->
    </div>


    <br><br>

</main>
@endsection
