{{--@extends('admin_core.layouts.test')--}}
{{--@section('main')--}}
{{--    <div class="container">--}}
{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-md-12">--}}
{{--                <form action="" method="GET">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-md-4">--}}
{{--                            <label for="start_date">Ngày bắt đầu:</label>--}}
{{--                            <input type="date" id="start_date" name="start_date" value="{{ request()->input('start_date') }}">--}}
{{--                        </div>--}}
{{--                        <div class="col-md-4">--}}
{{--                            <label for="end_date">Ngày kết thúc:</label>--}}
{{--                            <input type="date" id="end_date" name="end_date" value="{{ request()->input('end_date') }}">--}}
{{--                        </div>--}}
{{--                        <div class="col-md-4">--}}
{{--                            <button type="submit" class="btn btn-primary">Lọc</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header">Thống kê tổng quan về website</div>--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-4">--}}
{{--                                <div class="card">--}}
{{--                                    <div class="card-body">--}}
{{--                                        <h5 class="card-title">Số lượng bài viết</h5>--}}
{{--                                        <p class="card-text">{{ $statistics['blog_count'] }}</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-4">--}}
{{--                                <div class="card">--}}
{{--                                    <div class="card-body">--}}
{{--                                        <h5 class="card-title">Số lượng người dùng</h5>--}}
{{--                                        <p class="card-text">{{ $statistics['user_count'] }}</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-4">--}}
{{--                                <div class="card">--}}
{{--                                    <div class="card-body">--}}
{{--                                        <h5 class="card-title">Số lượng phòng đang hoạt động</h5>--}}
{{--                                        <p class="card-text">{{ $statistics['active_room_count'] }}</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-4">--}}
{{--                                <div class="card">--}}
{{--                                    <div class="card-body">--}}
{{--                                        <h5 class="card-title">Số lượng hợp đồng</h5>--}}
{{--                                        <p class="card-text">{{ $statistics['contract_count'] }}</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-4">--}}
{{--                                <div class="card">--}}
{{--                                    <div class="card-body">--}}
{{--                                        <h5 class="card-title">Số lượng hợp đồng đang hoạt động</h5>--}}
{{--                                        <p class="card-text">{{$statistics['active_contract_count'] }}</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-4">--}}
{{--                                <div class="card">--}}
{{--                                    <div class="card-body">--}}
{{--                                        <h5 class="card-title">Số lượng phòng</h5>--}}
{{--                                        <p class="card-text">{{$statistics['room_count'] }}</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-4">--}}
{{--                                <div class="card">--}}
{{--                                    <div class="card-body">--}}
{{--                                        <h5 class="card-title">Số lượng công việc thất bại</h5>--}}
{{--                                        <p class="card-text">{{ $statistics['failed_job_count'] }}</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-4">--}}
{{--                                <div class="card">--}}
{{--                                    <div class="card-body">--}}
{{--                                        <h5 class="card-title">Số lượng hóa đơn</h5>--}}
{{--                                        <p class="card-text">{{ $statistics['invoice_count'] }}</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-4">--}}
{{--                                <div class="card">--}}
{{--                                    <div class="card-body">--}}
{{--                                        <h5 class="card-title">Số lượng hóa đơn đang chờ xử lý</h5>--}}
{{--                                        <p class="card-text">{{ $statistics['pending_invoice_count'] }}</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <h2>Tổng Quan</h2>--}}
{{--                        <ul>--}}
{{--                            <li><strong>Tổng thu nhập:</strong> {{ number_format($statistics['total_income'], 0, ',', '.') }} VND</li>--}}
{{--                        </ul>--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-12">--}}
{{--                                <canvas id="monthly-income-chart" width="400" height="200"></canvas>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>--}}
{{--    <script>--}}
{{--        const ctx = document.getElementById('monthly-income-chart').getContext('2d');--}}
{{--        const chart = new Chart(ctx, {--}}
{{--            type: 'bar',--}}
{{--            data: {--}}
{{--                labels: {!! json_encode($chartData['labels']) !!},--}}
{{--                datasets: [{--}}
{{--                    label: 'Tổng thu nhập hàng tháng',--}}
{{--                    data: {!! json_encode($chartData['data']) !!},--}}
{{--                    backgroundColor: [--}}
{{--                        'rgba(255, 99, 132, 0.2)',--}}
{{--                        'rgba(54, 162, 235, 0.2)',--}}
{{--                        'rgba(255, 206, 86, 0.2)',--}}
{{--                        'rgba(75, 192, 192, 0.2)',--}}
{{--                        'rgba(153, 102, 255, 0.2)',--}}
{{--                        'rgba(255,  159, 64, 0.2)',--}}
{{--                    ],--}}
{{--                    borderColor: [--}}
{{--                        'rgba(255, 99, 132, 1)',--}}
{{--                        'rgba(54, 162, 235, 1)',--}}
{{--                        'rgba(255, 206, 86, 1)',--}}
{{--                        'rgba(75, 192, 192, 1)',--}}
{{--                        'rgba(153, 102, 255, 1)',--}}
{{--                        'rgba(255, 159, 64, 1)',--}}
{{--                    ],--}}
{{--                    borderWidth: 1--}}
{{--                }]--}}
{{--            },--}}
{{--            options: {--}}
{{--                scales: {--}}
{{--                    y: {--}}
{{--                        beginAtZero: true--}}
{{--                    }--}}
{{--                }--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}
{{--<header>--}}
{{--    <h1>Thống Kê Quản Trị Viên</h1>--}}
{{--</header>--}}
{{--<div class="container">--}}


{{--    <h2>Danh Sách Người Dùng</h2>--}}
{{--    <table>--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <th>ID</th>--}}
{{--            <th>Tên</th>--}}
{{--            <th>Email</th>--}}
{{--            <th>VIP</th>--}}
{{--            <th>Ngày Tham Gia</th>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--        <tbody>--}}
{{--        @foreach ($statistics['users'] as $user)--}}
{{--            <tr>--}}
{{--                <td>{{ $user->id }}</td>--}}
{{--                <td>{{ $user->name }}</td>--}}
{{--                <td>{{ $user->email }}</td>--}}
{{--                <td>{{ $user->is_vip ? 'Có' : 'Không' }}</td>--}}
{{--                <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
{{--        </tbody>--}}
{{--    </table>--}}

{{--    <h2>Danh Sách Phòng Đang Hoạt Động</h2>--}}
{{--   --}}
{{--</div>--}}

{{--@endsection--}}


@extends('admin_core.layouts.test')

@section('main')
    <div class=" container  mt-4">
        <!-- Lọc ngày -->
        <div class="row justify-content-center mb-4">
            <div class="col-md-12">
                <form action="" method="GET">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="start_date" class="form-label">Ngày bắt đầu:</label>
                            <input type="date" id="start_date" name="start_date" class="form-control"
                                   value="{{ request()->input('start_date') }}">
                        </div>
                        <div class="col-md-4">
                            <label for="end_date" class="form-label">Ngày kết thúc:</label>
                            <input type="date" id="end_date" name="end_date" class="form-control"
                                   value="{{ request()->input('end_date') }}">
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">Lọc</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Thống kê tổng quan -->
        <div class="card">
            <div class="card-header">
                <h3>Thống kê tổng quan về website</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Các thông tin thống kê -->
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Số lượng bài viết</h5>
                                <p class="card-text">{{ $statistics['blog_count'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Số lượng người dùng</h5>
                                <p class="card-text">{{ $statistics['user_count'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Số lượng phòng đang hoạt động</h5>
                                <p class="card-text">{{ $statistics['active_room_count'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Các thông tin thống kê tiếp theo -->
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Số lượng hợp đồng</h5>
                                <p class="card-text">{{ $statistics['contract_count'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Số lượng hợp đồng đang hoạt động</h5>
                                <p class="card-text">{{ $statistics['active_contract_count'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Số lượng phòng</h5>
                                <p class="card-text">{{ $statistics['room_count'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Các thông tin thống kê tiếp theo -->
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Số lượng công việc thất bại</h5>
                                <p class="card-text">{{ $statistics['failed_job_count'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Số lượng hóa đơn</h5>
                                <p class="card-text">{{ $statistics['invoice_count'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Số lượng hóa đơn đang chờ xử lý</h5>
                                <p class="card-text">{{ $statistics['pending_invoice_count'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tổng thu nhập -->
                <h3>Tổng Quan</h3>
                <ul>
                    <li><strong>Tổng thu nhập:</strong> {{ number_format($statistics['total_income'], 0, ',', '.') }}
                        VND
                    </li>
                </ul>

                <!-- Biểu đồ thu nhập hàng tháng -->
                <div class="row">
                    <div class="col-md-12">
                        <canvas id="monthly-income-chart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Danh sách người dùng -->
        <div class="mt-4">
            <h3>Danh Sách Người Dùng</h3>
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>VIP</th>
                    <th>Ngày Tham Gia</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($statistics['users'] as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->is_vip ? 'Có' : 'Không' }}</td>
                        <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Danh sách phòng đang hoạt động -->
        <div class="mt-4">
            <h3>Danh Sách Phòng Đang Hoạt Động</h3>
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Tiêu Đề</th>
                    {{--                        <th>Tỉnh</th>--}}
                    <th>Giá</th>
                    <th>Ngày Đăng</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($statistics['active_rooms'] as $room)
                    <tr>
                        <td>{{ $room->id }}</td>
                        <td>{{ $room->title }}</td>
                        @foreach($allProvinceData as $provider)

                        @if($room->province ==$provider['province_id']  )
                                <td>{{$provider['province_name']}}</td>
                        @else
                        @endif
                        @endforeach
                        <td>{{ number_format($room->price, 0, ',', '.') }} VND</td>
                        <td>{{ \Carbon\Carbon::parse($room->created_at)->format('d/m/Y') }}</td>
                    </tr>
                @endforeach

                </tbody>

            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('monthly-income-chart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartData['labels']) !!},
                datasets: [
                    {
                        label: 'Tổng thu nhập hàng tháng',
                        data: {!! json_encode($chartData['data']) !!},
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                        ],
                        borderWidth: 1,
                    },
                ],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });
    </script>
@endsection

