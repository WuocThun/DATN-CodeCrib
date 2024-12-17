@extends('admin_core.layouts.app')
@section('navbar')
    @include('admin_core.inc.navbar')
@endsection
@section('main')
<main role="main" class="ml-sm-auto col">
    @include('admin_core.inc.sub_main')




    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Code Crib</a></li>
            <li class="breadcrumb-item"><a href="index.html">Quản lý</a></li>
            <li class="breadcrumb-item active" aria-current="page">Lịch sử nạp tiền</li>
        </ol>
    </nav>
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Lịch sử thanh toán tin</h1>
    </div>
    <div class="table-responsive">
        <table class="table table_listing table-striped table-bordered">
            <thead>
            <tr>
                <th>Thời gian</th>
                <th>Loại hoạt động</th>
                <th>Mã phòng</th>
                <th>Loại tin</th>
                <th>Ngày hết hạn</th>
                <th>Trạng thái</th>
            </tr>

            </thead>
            <tbody>

            @foreach($getVipPur as $vip => $data)
                @php
                    $pack = \App\Models\VIPPackage::where('id',$data->vip_package_id)->first();
                    $roomName = \App\Models\Rooms::where('id',$data->room_id)->first();
                @endphp
            <tr>
                <td>{{$data->created_at}}
                <td></td>
                <td>{{ \Illuminate\Support\Str::limit($roomName->title, 20, '...') }}</td>
                <td>{{$pack->name}}</td>
                <td>{{$data->end_date}}</td>
                <td>{{$data->status}}</td>

            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- pagination -->

    <!-- end pagination -->


    <br><br>

</main>
@endsection
