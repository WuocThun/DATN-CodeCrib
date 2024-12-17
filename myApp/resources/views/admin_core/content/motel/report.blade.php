@extends('admin_core.layouts.test')

@section('main')

    <main role="main" class="ml-sm-auto col">
        @include('admin_core.inc.sub_main')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <div class="container">
            <h1>Báo Cáo Motel</h1>
            <form method="GET" action="#" class="mb-4">
                <div class="row">
                    <div class="col-md-3">
                        <label for="start_date">Ngày bắt đầu:</label>
                        <input type="date" id="start_date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="end_date">Ngày kết thúc:</label>
                        <input type="date" id="end_date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="motel_id">Chọn Motel:</label>
                        <select id="motel_id" name="motel_id" class="form-control">
                            <option value="">Tất cả Motel</option>
                            @foreach($allMotels as $motel)
                                <option value="{{ $motel->id }}" {{ request('motel_id') == $motel->id ? 'selected' : '' }}>
                                    {{ $motel->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Lọc Báo Cáo</button>
                    </div>
                </div>
            </form>
            <!-- Tổng thu nhập từ các hóa đơn -->
            <div class="card mb-4">
                <div class="card-header">
                    <strong>Tổng thu nhập từ các hóa đơn</strong>
                </div>
                <div class="card-body">
                    <p>Tổng tiền phải trả: {{ number_format($totalAmount, 0, ',', '.') }} VNĐ</p>
                    <p>Tổng tiền điện: {{ number_format($totalElectric, 0, ',', '.') }} VNĐ</p>
                    <p>Tổng tiền nước: {{ number_format($totalWater, 0, ',', '.') }} VNĐ</p>

                    <!-- Biểu đồ thu nhập từ hóa đơn -->
                    <canvas id="invoiceChart"></canvas>
                </div>
            </div>

            <!-- Thống kê tổng thu nhập từ các Motel -->
            <div class="card mb-4">
                <div class="card-header">
                    <strong>Tổng thu nhập từ Motel</strong>
                </div>
                <div class="card-body">
                    <p>Tổng tiền phòng: {{ number_format($totalMotelIncome, 0, ',', '.') }} VNĐ</p>
                    <p>Tổng tiền điện: {{ number_format($totalElectric, 0, ',', '.') }} VNĐ</p>
                    <p>Tổng tiền nước: {{ number_format($totalWater, 0, ',', '.') }} VNĐ</p>
                    <p>Tổng tiền wifi: {{ number_format($totalWifiIncome, 0, ',', '.') }} VNĐ</p>
                    <p>Tổng các khoản phí khác: {{ number_format($totalOtherIncome, 0, ',', '.') }} VNĐ</p>

                    <!-- Biểu đồ thu nhập từ các Motel -->
                    <canvas id="motelChart"></canvas>
                </div>
            </div>

            <!-- Danh sách các Motel của người dùng -->
            <div class="card mb-4">
                <div class="card-header">
                    <strong>Danh sách Motel</strong>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Tên Motel</th>
                            <th>Loại Motel</th>
                            <th>Tổng Thành Viên</th>
                            <th>Thu Nhập Từ Phòng</th>
                            <th>Thu Nhập Từ Điện</th>
                            <th>Thu Nhập Từ Nước</th>
                            <th>Thu Nhập Từ Wifi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($motels as $motel)
                            <tr>
                                <td>{{ $motel->name }}</td>
                                <td>{{ $motel->kind_motel }}</td>
                                <td>{{ $motel->total_member }}</td>
                                <td>{{ number_format($motel->money, 0, ',', '.') }} VNĐ</td>
                                <td>{{ number_format($motel->money_electric, 0, ',', '.') }} VNĐ</td>
                                <td>{{ number_format($motel->money_water, 0, ',', '.') }} VNĐ</td>
                                <td>{{ number_format($motel->money_wifi, 0, ',', '.') }} VNĐ</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <script>
            // Biểu đồ thu nhập từ hóa đơn
            var invoiceChartCtx = document.getElementById('invoiceChart').getContext('2d');
            var invoiceChart = new Chart(invoiceChartCtx, {
                type: 'pie',
                data: {
                    labels: ['Tổng tiền phải trả', 'Tổng tiền điện', 'Tổng tiền nước'],
                    datasets: [{
                        label: 'Thu nhập từ hóa đơn',
                        data: [{{ $totalAmount }}, {{ $totalElectric }}, {{ $totalWater }}],
                        backgroundColor: ['#FF5733', '#33FF57', '#3357FF'],
                        borderColor: ['#FF5733', '#33FF57', '#3357FF'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.label + ': ' + tooltipItem.raw.toLocaleString() + ' VNĐ';
                                }
                            }
                        }
                    }
                }
            });

            // Biểu đồ thu nhập từ các Motel
            var motelChartCtx = document.getElementById('motelChart').getContext('2d');
            var motelChart = new Chart(motelChartCtx, {
                type: 'bar',
                data: {
                    labels: ['Tổng tiền phòng', 'Tổng tiền điện', 'Tổng tiền nước', 'Tổng tiền wifi', 'Các khoản phí khác'],
                    datasets: [{
                        label: 'Thu nhập từ Motel',
                        data: [{{ $totalAmount }}, {{ $totalElectric }}, {{ $totalWater }}, {{ $totalWifiIncome }}, {{ $totalOtherIncome }}],
                        backgroundColor: '#3498db',
                        borderColor: '#2980b9',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.label + ': ' + tooltipItem.raw.toLocaleString() + ' VNĐ';
                                }
                            }
                        }
                    }
                }
            });
        </script>    </main>

@endsection

