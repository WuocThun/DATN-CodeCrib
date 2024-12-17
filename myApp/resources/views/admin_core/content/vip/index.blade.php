@extends('admin_core.layouts.test')

@section('main')
    <div class="container mt-5">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div class="row">
            <div class="col-12">
                <h2 class="mb-4 text-center">Danh Sách Phòng Đã Kích Hoạt Gói VIP</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
                        <tr>
                            <th>Tiêu Đề Phòng</th>
                            <th>Giá (VND)</th>
                            <th>Tỉnh/Thành Phố</th>
                            <th>Địa Chỉ</th>
                            <th>Gói VIP</th>
                            <th>Giá Gói VIP (VND)</th>
                            <th>Ngày Bắt Đầu</th>
                            <th>Ngày Kết Thúc</th>
                            <th>Trạng Thái</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($vipRooms as $vip)
                            <tr>
                                <td>{{ $vip->room->title }}</td>
                                <td>{{ number_format($vip->room->price) }}</td>
                                <td>{{ $vip->room->province }}</td>
                                <td>{{ $vip->room->full_address }}</td>
                                <td>
                                    <span class="badge bg-success">{{ $vip->vipPackage->name }}</span>
                                </td>
                                <td>{{ number_format($vip->vipPackage->price) }}</td>
                                <td>{{ $vip->start_date }}</td>
                                <td>{{ $vip->end_date }}</td>
                                <td>
                                    @if ($vip->status === 'active')
                                        <form action="{{ route('admin.vipRooms.deleteVip', $vip->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xoá gói VIP này không?');">
                                                Xoá Gói VIP
                                            </button>
                                        </form>
                                    @else
                                        <span class="badge bg-secondary">Không có VIP</span>
                                    @endif
                                </td>


                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center text-muted">
                                    Không có phòng nào đang kích hoạt gói VIP.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
