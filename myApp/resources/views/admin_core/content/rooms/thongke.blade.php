@extends('admin_core.layouts.test')
@section('main')
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

{{--    <canvas id="myChart" style="width:100%;max-width:600px"></canvas>--}}


{{--    <script>--}}
{{--        var xValues = ["Chưa duyệt", "Đã duyệt", "Từ chối"];--}}

{{--        var yValues = [55, 49, 44, 24, 15];--}}

{{--        var barColors = ["red", "green","blue"];--}}

{{--        new Chart("myChart", {--}}
{{--            type: "bar",--}}
{{--            data: {--}}
{{--                labels: xValues,--}}
{{--                datasets: [{--}}
{{--                    backgroundColor: barColors,--}}
{{--                    data: yValues--}}
{{--                }]--}}
{{--            },--}}
{{--            options: {--}}
{{--                legend: {display: false},--}}
{{--                title: {--}}
{{--                    display: true,--}}
{{--                    text: "World Wine Production 2018"--}}
{{--                }--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}
    <div class="container mt-4">
        <h2 class="mb-4">Báo Cáo Thống Kê</h2>

        <!-- Tổng số phòng -->
        <div class="mb-4">
            <h5>Tổng số phòng: <span class="text-primary">{{ $totalRooms }}</span></h5>
        </div>

        <!-- Biểu đồ số phòng theo trạng thái -->
        <div class="mb-4">
            <h5>Số phòng theo trạng thái (Biểu đồ)</h5>
            <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
        </div>

        <!-- Số phòng theo trạng thái (Bảng) -->
        <div class="mb-4">
            <h5>Số phòng theo trạng thái</h5>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Trạng thái</th>
                    <th>Số lượng</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roomsByStatus as $status)
                    <tr>
                        <td>{{ $status->status == 1 ? 'Đã duyệt' : ($status->status == 0 ? 'Chưa duyệt' : 'Từ chối') }}</td>
                        <td>{{ $status->count }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Số phòng theo tỉnh -->
        <div class="mb-4">
            <h5>Số phòng theo tỉnh</h5>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Tỉnh</th>
                    <th>Số lượng phòng</th>
                </tr>
                </thead>
                <tbody>
                @foreach($provinceData as $province)
                    @php
                        $roomCount = $roomsByProvince->firstWhere('province', $province['province_id'])->count ?? 0;
                    @endphp
                    <tr>
                        <td>{{ $province['province_name'] }}</td>
                        <td>{{ $roomCount }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Số phòng theo gói VIP -->
        <div class="mb-4">
            <h5>Số phòng theo gói VIP</h5>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Gói VIP</th>
                    <th>Số lượng</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roomsByVipPackage as $vip)
                    <tr>
                        <td>{{ $vip->vip_package_id }}</td>
                        <td>{{ $vip->count }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div style="color: #5aa2f0"></div>
    <!-- Script for Chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Xử lý dữ liệu để hiển thị trên biểu đồ
        var xValues = @json($roomsByStatus->pluck('status')->map(function ($status) {
        return $status == 1 ? 'Đã duyệt' : ($status == 0 ? 'Chưa duyệt' : 'Từ chối');
    }));

        var yValues = @json($roomsByStatus->pluck('count'));

        var barColors = ["#5aa2f0", "green", "red"];
        // Vẽ biểu đồ
        new Chart("myChart", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                legend: { display: false },
                title: {
                    display: true,
                    text: "Thống Kê Số Phòng Theo Trạng Thái"
                }
            }
        });
    </script>
@endsection
