@extends('fe.layouts.app')
@section('title', 'Đặt Lại Mật Khẩu')

@section('header')
    @include('fe.inc.header')
@endsection

@section('main')
    <div class="reset-password-container">
        <div class="card">
            <div class="card-header text-center">
                <h2>🔒 Đặt Lại Mật Khẩu</h2>
                <p class="text-muted">Nhập thông tin bên dưới để tạo mật khẩu mới.</p>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('password.update') }}">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email -->
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">📧 Email</label>
                        <input
                            id="email"
                            type="email"
                            readonly
                            name="email"
                            value="{{ old('email', $request->email) }}"
                            required
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="Nhập địa chỉ email của bạn"
                        >
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Mật khẩu mới -->
                    <div class="form-group mb-3">
                        <label for="password" class="form-label">🔑 Mật khẩu mới</label>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Nhập mật khẩu mới"
                        >
                        @error('password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Xác nhận mật khẩu -->
                    <div class="form-group mb-3">
                        <label for="password_confirmation" class="form-label">🔐 Xác nhận mật khẩu</label>
                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            required
                            class="form-control"
                            placeholder="Xác nhận mật khẩu mới"
                        >
                    </div>

                    <!-- Nút Gửi -->
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary">✅ Đặt Lại Mật Khẩu</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center mt-3">
                <a href="{{ route('getLogin') }}" class="text-decoration-none">🔑 Quay lại Đăng nhập</a>
            </div>
        </div>
    </div>
@endsection

@section('overView')
    @include('fe.inc.over_view')
@endsection

@section('footer')
    @include('fe.inc.footer')
@endsection
