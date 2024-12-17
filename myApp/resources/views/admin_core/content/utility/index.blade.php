@extends('admin_core.layouts.test')

@section('main')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="container">
<!-- Bảng danh sách tiện ích -->
<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Tên Tiện Ích</th>
        <th scope="col">Mô Tả</th>
        <th scope="col">Icon</th>
        <th scope="col">Hành Động</th>
    </tr>
    </thead>
    <tbody>
    @foreach($utilities as $utility)
        <tr>
            <th scope="row">{{ $utility->id }}</th>
            <td>{{ $utility->name }}</td>
            <td>{{ $utility->description }}</td>
            <td><i class="{{ $utility->icon }}"></i></td>
            <td>
                <!-- Hành động như chỉnh sửa, xóa có thể thêm vào đây -->
                <a href="{{route('admin.utilities.edit',$utility->id)}}" class="btn btn-warning btn-sm">Sửa</a>
                <form action="{{ route('admin.utilities.destroy', $utility->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa tiện ích này?')">Xóa</button>
                </form>            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<a href="{{ route('admin.utilities.create') }}" class="btn btn-success">Thêm Tiện Ích Mới</a>
</div>
@endsection
