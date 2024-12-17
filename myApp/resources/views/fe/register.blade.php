@extends('fe.layouts.app')
@section('header')
@include('fe.inc.header')
@endsection

@section('main')
<div class="login-container">
    <div class="form">
        <h1>Đăng ký</h1>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <div class="form-group">
                    <label for="password">HỌ TÊN</label>
                    <input type="text" name="name" id="name" placeholder="Nhập họ và tên">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />

                </div>  <div class="form-group">
                    <label for="password">Email</label>
                    <input type="text" name="email" id="name" placeholder="Nhập Email">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />

                </div>
                <label for="phone">SỐ ĐIỆN THOẠI</label>
                <input type="text" name="phone_number" id="phone" placeholder="Nhập số điện thoại">
                <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />

            </div>
            <div class="form-group">
                <label for="password">MẬT KHẨU</label>
                <input type="password" name="password" id="password" placeholder="Nhập mật khẩu">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />

            </div>
            <div class="form-group">
                <label for="password">XÁC NHẬN MẬT KHẨU</label>
                <input type="password" name="password_confirmation" id="password" placeholder="Nhập mật khẩu">
            </div>
            <label for="">LOẠI TÀI KHOẢN</label>
            <div class="role">
                <div class="checkrole">
                    <label for="roleLandlord">
                        <input type="radio" name="role" value="houseRenter" id="roleLandlord">
                        Chủ trọ
                    </label>
                </div>
                <div class="checkrole">
                    <label for="roleBroker">
                        <input type="radio" name="role" value="viewer" id="roleBroker">
                        Người thuê trọ
                    </label>
                </div>
            </div>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />

            <button type="submit" id="loginbtn">Đăng ký</button>
        </form>
        <div class="footer-links">
            <a href="#">Bạn quên mật khẩu?</a>
            <a href="#">Tạo tài khoản mới</a>
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

