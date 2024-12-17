@extends('fe.layouts.app')
@section('title','Quên mật khẩu')
@section('header')
    @include('fe.inc.header')
@endsection
@section('main')
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <h1 class="text-lg font-bold mb-4">Đặt lại mật khẩu</h1>

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <label for="email">Email:</label>
            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required class="block mt-1 w-full">
            @error('email')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mt-4">
            <label for="password">Mật khẩu mới:</label>
            <input id="password" type="password" name="password" required class="block mt-1 w-full">
            @error('password')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mt-4">
            <label for="password_confirmation">Xác nhận mật khẩu:</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required class="block mt-1 w-full">
        </div>

        <div class="mt-4">
            <button type="submit" class="btn-primary">Đặt lại mật khẩu</button>
        </div>
    </form>
@endsection
@section('overView')
    @include('fe.inc.over_view')
@endsection
@section('footer')
    @include('fe.inc.footer')
@endsection
