@extends('fe.layouts.app')
@section('header')
    @include('fe.inc.header')
@endsection

@section('main')
    <form method="POST" action="{{ route('xac-minh.store') }}">
        @csrf

        <div class="container">
            <div class="form-group ">
                <label for="email">Nhập mã số xác thực</label>
                <input type="text" name="code" id="phone" placeholder="Nhập mã số xác thực">
                <x-input-error :messages="$errors->get('code')" class="mt-2"/>
            </div>

            <button type="submit" id="loginbtn">Xác thực</button>

        </div>
        {{--        <div>--}}
        {{--            <button>--}}
        {{--                {{ __('Xác nhận') }}--}}
        {{--            </button>--}}
        {{--        </div>--}}


    </form>
@endsection

@section('footer')
    @include('fe.inc.footer')
@endsection

