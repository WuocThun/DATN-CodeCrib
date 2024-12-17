@extends('admin_core.layouts.test')

@section('main')
    <div class="container mt-5">
        <h2>Chỉnh sửa thông tin người dùng</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Tên người dùng</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="phone_number">Số điện thoại</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number', $user->phone_number) }}">
                @error('phone_number') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="balance">Số dư</label>
                <input type="text" name="balance" id="balance" class="form-control" readonly  value="{{ old('balance', $user->balance ) }} ">
                @error('balance') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="avatar">Ảnh đại diện</label>
                <input type="file" name="avatar" id="avatar" class="form-control-file">
                @if($user->avatar)
                    <img src="{{ asset('uploads/users/' . $user->avatar) }}" alt="Avatar" class="img-thumbnail mt-2" style="width: 100px;">
                @endif
                @error('avatar') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('admin.dashboardCore') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
@endsection
