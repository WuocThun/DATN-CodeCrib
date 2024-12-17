@extends('admin_core.layouts.test')

@section('main')
    <div class="container mt-5">
        <h1 class="mb-4">Danh Sách Bình Luận</h1>

        <!-- Bộ lọc -->
        <form method="GET" action="{{ route('admin.comments.listAllComtent') }}" class="mb-4">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <select name="room_id" class="form-select">
                        <option value="">Tất cả phòng</option>
                        @foreach ($rooms as $room)
                            <option value="{{ $room->id }}" {{ $roomId == $room->id ? 'selected' : '' }}>
                                {{ $room->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Lọc</button>
                </div>
            </div>
        </form>

        <!-- Hiển thị danh sách bình luận -->
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Người dùng</th>
                <th>Nội dung</th>
                <th>Số sao</th>
                <th>Phòng</th>
                <th>Ngày tạo</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($comments as $comment)
                <tr>
                    <td>{{ $comment->id }}</td>
                    <td>{{ $comment->user->name }}</td>
                    <td>{{ $comment->content }}</td>
                    <td>{{ $comment->rating }}</td>
                    <td>{{ $comment->room ? $comment->room->title : 'Không có' }}</td>
                    <td>{{ $comment->created_at }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Không có bình luận nào.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

@endsection
