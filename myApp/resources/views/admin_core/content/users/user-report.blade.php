
@extends('admin_core.layouts.test')

@section('main')

    <!-- Thông báo -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Thống kê User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <h3 class="text-lg font-medium">Tổng quan</h3>
                    <ul>
                        <li><strong>Tổng số lượng User:</strong> {{ $totalUsers }}</li>
                        <li><strong>Số lượng User VIP:</strong> {{ $vipUsers }}</li>
                        <li><strong>Số dư trung bình:</strong> {{ number_format($averageBalance, 0, ',', '.') }} VNĐ
                        </li>
                        <li><strong>Số lượng User có số dư lớn hơn 100.000:</strong> {{ $usersWithHighBalance }}</li>
                        <li><strong>Số lượng User đã có trọ:</strong> {{ $usersWithMotel }}</li>
                        <li><strong>Số lượng User chưa có trọ:</strong> {{ $usersWithoutMotel }}</li>
                    </ul>

                    <h3 class="text-lg font-medium mt-6">Biểu đồ User theo tháng</h3>
                    <canvas id="userChart" width="400" height="200"></canvas>

                </div>
            </div>
        </div>
    </div>

    <!-- Bảng Danh Sách Người Dùng -->
    <div class="container mt-5">
        <h1 class="text-center mb-4">Danh sách User</h1>

        <!-- Thêm các link sắp xếp -->
        <div class="mb-3">
            <a href="{{ route('admin.user.report', ['sort_by' => 'balance', 'order' => 'desc']) }}"
               class="btn btn-primary">Sắp xếp theo số dư (Từ cao đến thấp)</a>
            <a href="{{ route('admin.user.report', ['sort_by' => 'created_at', 'order' => 'asc']) }}"
               class="btn btn-secondary">Sắp xếp theo ngày tạo (Cũ đến mới)</a>
            <a href="{{ route('admin.user.report', ['sort_by' => 'created_at', 'order' => 'desc']) }}"
               class="btn btn-success">Sắp xếp theo ngày tạo (Mới đến cũ)</a>
        </div>

        <!-- Bảng thông tin người dùng -->
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
            <tr>
                <th>Mã số tài khoản</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Số dư</th>
                <th>Đã có trọ?</th>
                <th>Tên của chủ trọ</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->rand_code_user }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone_number }}</td>
                    <td>{{ number_format($user->balance,0, ',', '.') }} VNĐ</td>
                    <td>{{ $user->motel_id ? 'Đã có trọ - ' : 'Chưa có trọ' }} {{$user->motel->name ?? ''}} </td>
                    <td>
                        Chủ trọ: {{$user->owner_name ?? 'Chưa đăng ký trọ'}}
                    </td>
                    <td>
                        <a href="{{ route('admin.users.edit', [$user->id]) }}" class="btn btn-warning">Sửa</a>
                        <form action="{{ route('admin.users.delete', $user->id) }}" method="POST"
                              onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này không?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination">
            @if ($users->onFirstPage())
                <button class="prev" disabled>« Trang trước</button>
            @else
                <a href="{{ $users->previousPageUrl() }}" class="prev">« Trang trước</a>
            @endif

            @for ($page = 1; $page <= $users->lastPage(); $page++)
                <a href="{{ $users->url($page) }}"
                   class="page {{ $page == $users->currentPage() ? 'active' : '' }}">{{ $page }}</a>
            @endfor

            @if ($users->hasMorePages())
                <a href="{{ $users->nextPageUrl() }}" class="next">Trang sau »</a>
            @else
                <button class="next" disabled>Trang sau »</button>
            @endif
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('userChart').getContext('2d');
            const userChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($chartLabels),
                    datasets: [
                        {
                            label: 'Số lượng User',
                            data: @json($chartData),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        title: {
                            display: true,
                            text: 'Thống kê User theo tháng'
                        }
                    }
                }
            });
        });
    </script>

@endsection


