@extends('admin_core.layouts.test')

@section('main')
    <div class="container">
        <h1>Thống kê nạp tiền</h1>

        <!-- Bộ lọc -->
        <form method="GET" action="{{ route('admin.payment.report') }}">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="user_id">Người dùng</label>
                    <select name="user_id" id="user_id" class="form-control">
                        <option value="">-- Tất cả --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="date">Ngày nạp</label>
                    <input type="date" name="date" id="date" class="form-control" value="{{ request('date') }}">
                </div>
                <div class="form-group col-md-4">
                    <label for="month">Tháng nạp</label>
                    <input type="month" name="month" id="month" class="form-control" value="{{ request('month') }}">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Lọc</button>
        </form>

        <!-- Thống kê -->
        <h3 class="mt-4">Người nạp nhiều nhất: {{ $topUser->name ?? 'Không có dữ liệu' }} ({{ number_format($topUser->total_amount ?? 0) }} VND)</h3>

        <canvas id="paymentChart" width="400" height="200"></canvas>
    </div>
    <div class="container mt-5">
        <h2>Tỷ lệ trạng thái thanh toán</h2>
        <canvas id="statusPieChart" width="400" height="200"></canvas>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Dữ liệu từ server
            const statusData = {!! json_encode($statusData) !!};

            // Chuẩn bị dữ liệu cho Chart.js
            const pieLabels = statusData.map(item => item.label);
            const pieCounts = statusData.map(item => item.count);

            // Tạo biểu đồ Pie Chart
            const ctxPie = document.getElementById('statusPieChart').getContext('2d');
            const statusPieChart = new Chart(ctxPie, {
                type: 'pie',
                data: {
                    labels: pieLabels,
                    datasets: [
                        {
                            label: 'Trạng thái thanh toán',
                            data: pieCounts,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)', // Màu cho "Chưa thanh toán"
                                'rgba(54, 162, 235, 0.2)', // Màu cho "Đã thanh toán"
                                'rgba(255, 206, 86, 0.2)'  // Màu cho "Hủy"
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)'
                            ],
                            borderWidth: 1
                        }
                    ],
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Tỷ lệ trạng thái thanh toán'
                        }
                    }
                }
            });
        });    </script>
    <div class="container mt-5">
        <h2>Biểu đồ trạng thái thanh toán</h2>
        <canvas id="stackedBarChart" width="600" height="400"></canvas>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Dữ liệu từ server
            const labels = {!! json_encode($labels) !!};
            const pendingData = {!! json_encode($pendingData) !!};
            const completedData = {!! json_encode($completedData) !!};
            const canceledData = {!! json_encode($canceledData) !!};

            // Tạo biểu đồ cột chồng
            const ctx = document.getElementById('stackedBarChart').getContext('2d');
            const stackedBarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: "Đang đợi thanh toán",
                            data: pendingData,
                            backgroundColor: 'rgba(128, 128, 128, 0.8)', // Màu xám
                            borderColor: 'rgba(128, 128, 128, 1)',
                            borderWidth: 1
                        },
                        {
                            label: "Đã thanh toán",
                            data: completedData,
                            backgroundColor: 'rgba(75, 192, 192, 0.8)', // Màu xanh
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: "Đã huỷ",
                            data: canceledData,
                            backgroundColor: 'rgba(255, 99, 132, 0.8)', // Màu đỏ
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Thống kê trạng thái thanh toán'
                        }
                    },
                    scales: {
                        x: {
                            stacked: true // Kích hoạt cột chồng theo trục X
                        },
                        y: {
                            stacked: true // Kích hoạt cột chồng theo trục Y
                        }
                    }
                }
            });
        });
    </script>
    <div class="container">
        <h1 class="text-center">Thống kê thanh toán</h1>
        <h4>Tổng số tiền ghi nhận trên hệ thống: {{  number_format($totalAmount ?? 0)  }} VNĐ</h4>

        <canvas id="paymentStatusChart" width="400" height="200"></canvas>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('paymentStatusChart').getContext('2d');
            const paymentStatusCounts = @json($paymentStatusCounts);

            const labels = Object.keys(paymentStatusCounts);
            const data = Object.values(paymentStatusCounts);

            const myChart = new Chart(ctx, {
                type: 'bar', // Bạn có thể thay đổi loại biểu đồ
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Số lượng thanh toán theo trạng thái',
                        data: data,
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(54, 162, 235, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const data = @json($data);

            // Chuẩn bị dữ liệu cho Chart.js
            const labels = data.map(item => item.name);
            const amounts = data.map(item => item.total_amount);

            // Tạo biểu đồ
            const ctx = document.getElementById('paymentChart').getContext('2d');
            const paymentChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Tổng số tiền đã nạp (VND)',
                            data: amounts,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1,
                        },
                    ],
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Thống kê nạp tiền'
                        }
                    }
                }
            });
        });
    </script>
@endsection
