@extends('admin_core.layouts.test')

@section('main')
    <div class="container py-4">
        <h1 class="mb-4 text-center">Thống kê Blogs</h1>

        {{-- Thông tin thống kê chung --}}
        <div class="row mb-4 g-3">
            <div class="col-md-4">
                <div class="card text-center shadow-sm border-primary">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Tổng số Blogs</h5>
                        <p class="fs-4 fw-bold">{{ $totalBlogs }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center shadow-sm border-success">
                    <div class="card-body">
                        <h5 class="card-title text-success">Blogs đã duyệt</h5>
                        <p class="fs-4 fw-bold">{{ $approvedBlogs }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center shadow-sm border-danger">
                    <div class="card-body">
                        <h5 class="card-title text-danger">Blogs chưa duyệt</h5>
                        <p class="fs-4 fw-bold">{{ $pendingBlogs }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Thông tin chi tiết --}}
        @if ($topUser)
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Người dùng có nhiều blogs nhất</h5>
                    <p class="card-text">
                        <strong>Tên:</strong> {{ $topUser->user->name ?? 'Không rõ' }} <br>
                        <strong>Số blogs:</strong> {{ $topUser->total_blogs }}
                    </p>
                </div>
            </div>
        @endif

        @if ($commonRejectReason)
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Lý do từ chối phổ biến nhất</h5>
                    <p class="card-text">
                        <strong>Lý do:</strong> {{ $commonRejectReason->reject_reason ?? 'Không rõ' }} <br>
                        <strong>Số lần:</strong> {{ $commonRejectReason->total_reasons }}
                    </p>
                </div>
            </div>
        @endif

        {{-- Thống kê Blogs theo ngày --}}
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Thống kê Blogs theo ngày</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                    <tr>
                        <th scope="col">Ngày</th>
                        <th scope="col">Số lượng Blogs</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($blogsByDate as $stat)
                        <tr>
                            <td>{{ $stat->date }}</td>
                            <td>{{ $stat->total_blogs }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
