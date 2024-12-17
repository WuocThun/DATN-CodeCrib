@extends('admin_core.layouts.test')
@section('main')

    <div class="container mt-5">
        <h1 class="text-center mb-4">Thêm Tiện Ích Mới</h1>
        <a href="{{route('admin.utilities.index')}}"><button class="btn mt-3 mb-3 btn-info">Danh sách các tiện ích</button></a>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form Thêm Tiện Ích -->
        <form action="{{ route('admin.utilities.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Tên Tiện Ích</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" required>
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Mô Tả</label>
                <textarea id="description" name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                @error('description')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="icon" class="form-label">Icon (Font Awesome)</label>
                <input type="text" id="icon" name="icon" value="{{ old('icon') }}" class="form-control" placeholder="Nhập tên icon từ Font Awesome">
                <small class="form-text text-muted">Ví dụ: <strong>fas fa-wifi</strong> cho Wifi</small>
                @error('icon')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">Thêm Tiện Ích</button>
        </form>
    </div>

    <!-- Thêm Bootstrap JS và Popper (cho các tính năng của Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

@endsection
