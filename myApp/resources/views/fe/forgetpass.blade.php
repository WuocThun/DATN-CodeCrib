@extends('fe.layouts.app')
@section('title', 'Quên mật khẩu')

@section('header')
    @include('fe.inc.header')
@endsection

@section('main')
    <div class="password-reset-container">
        <div class="card">
            <div class="card-header text-center">
                <h2>🔑 Quên Mật Khẩu</h2>
                <p class="text-muted">Nhập email của bạn và chúng tôi sẽ gửi cho bạn liên kết đặt lại mật khẩu.</p>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">📧 Email</label>
                        <input
                            name="email"
                            type="email"
                            id="email"
                            required
                            placeholder="Nhập địa chỉ email của bạn"
                            class="form-control @error('email') is-invalid @enderror"
                        >
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger"/>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary">Gửi Liên Kết Đặt Lại Mật Khẩu</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center mt-3">
                <a href="{{ route('getLogin') }}" class="text-decoration-none">🔑 Đăng nhập</a> |
                <a href="{{ route('getReginster') }}" class="text-decoration-none">📝 Tạo tài khoản mới</a>
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
