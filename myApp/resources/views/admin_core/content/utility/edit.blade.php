@extends('admin_core.layouts.test')
@section('main')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Chỉnh Sửa Tiện Ích</h1>

        <!-- Thêm thông báo nếu có -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form chỉnh sửa tiện ích -->
        <form action="{{ route('admin.utilities.update', $utility->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Tên Tiện Ích</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $utility->name) }}" required>
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Mô Tả</label>
                <textarea class="form-control" id="description" name="description">{{ old('description', $utility->description) }}</textarea>
                @error('description')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="icon" class="form-label">Icon (Font Awesome Class)</label>
                <input type="text" class="form-control" id="icon" name="icon" value="{{ old('icon', $utility->icon) }}">
                @error('icon')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Cập Nhật Tiện Ích</button>
        </form>

        <a href="{{ route('admin.utilities.index') }}" class="btn btn-secondary mt-3">Quay Lại</a>
    </div>

@endsection
