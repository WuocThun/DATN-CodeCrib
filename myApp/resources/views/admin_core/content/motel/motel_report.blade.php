@extends('admin_core.layouts.test')

@section('main')
    <div class="container">
        <h1 class="my-4">Thống Kê Hệ Thống</h1>

        <!-- Thống Kê Người Dùng -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tổng Số Người Dùng</h5>
                        <p class="card-text">{{ $totalUsers }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tổng Số Người Dùng VIP</h5>
                        <p class="card-text">{{ $totalVipUsers }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Người Dùng Chưa Có Phòng</h5>
                        <p class="card-text">{{ $usersWithoutMotel }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Người Dùng Đã Xác Thực Email</h5>
                        <p class="card-text">{{ $usersWithVerifiedEmail }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Thống Kê Phòng Trọ -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tổng Số Phòng Trọ</h5>
                        <p class="card-text">{{ $totalMotels }}</p>
                    </div>
                </div>
            </div>
            @foreach($motelsByStatus as $status)
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Phòng Trọ - Trạng Thái {{ $status->status }}</h5>
                            <p class="card-text">{{ $status->total_by_status }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Thống Kê Hợp Đồng -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tổng Số Hợp Đồng</h5>
                        <p class="card-text">{{ $totalContracts }}</p>
                    </div>
                </div>
            </div>
            @foreach($contractsByStatus as $status)
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Hợp Đồng - Trạng Thái {{ ucfirst($status->status) }}</h5>
                            <p class="card-text">{{ $status->total_by_status }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Thống Kê Hợp Đồng Mới Theo Tháng -->
        <h4 class="my-4">Hợp Đồng Mới Theo Tháng</h4>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Tháng</th>
                <th scope="col">Số Hợp Đồng</th>
            </tr>
            </thead>
            <tbody>
            @foreach($contractsPerMonth as $month)
                <tr>
                    <td>{{ $month->month }}</td>
                    <td>{{ $month->contracts_per_month }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Thống Kê Phòng Mới Đăng Theo Tháng -->

@endsection
