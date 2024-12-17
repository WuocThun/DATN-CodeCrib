
@extends('fe.layouts.app')
@section('title','Chi tiết bài viết')
@section('header')
    @include('fe.inc.header')
@endsection
@section('main')
<div class="login-container">
    <div class="form">
        <h1>Đăng nhập</h1>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text"  name="email" id="phone" placeholder="Nhập Email">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div class="form-group">
                <label for="password">MẬT KHẨU</label>
                <input name="password" type="password" id="password" placeholder="Nhập mật khẩu">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />

            </div>
            <button type="submit" id="loginbtn">Đăng nhập</button>
        </form>
        <div class="footer-links">
            <a href="{{ route('forgetpass')}} ">Bạn quên mật khẩu?</a>
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
