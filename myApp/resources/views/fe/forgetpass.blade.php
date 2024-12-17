@extends('fe.layouts.app')
@section('title','Quên mật khẩu')
@section('header')
    @include('fe.inc.header')
@endsection
@section('main')
    <div class="login-container">
        <div class="form">
            <h1>Quên mật khẩu</h1>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Vui lòng nhập Email</label>
                    <input name="email" type="email" id="email" required placeholder="Nhập mật Email" class="mt-3">
                    {{--                    @error('email')--}}
                    {{--                    <span class="text-red-500">{{ $message }}</span>--}}
                    {{--                    @enderror--}}
                    <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn-primary btn">Gửi liên kết đặt lại mật khẩu</button>
                </div>
            </form>

            <div class="footer-links">
                <a href="{{route('getLogin')}}">Đăng nhập?</a>
                <a href="{{route('getReginster')}}">Tạo tài khoản mới</a>
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
