@extends('admin.layouts.app')
@section('navbar')
    @include('admin.inc.navbar')
@endsection
@section('main')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="col-md-3 d-none d-md-block">
        <div class="card mb-3">
            <div class="card-body">
                <div>Số dư tài khoản</div>
                <h3 class="heading" style="margin-top: 0; margin-bottom: 0; color: #28a745;"><strong>{{number_format(auth()->user()->balance,0,',', '.')}} đ</strong></h3>
            </div>
        </div>
    </div>
    <div class="container">
        <h1>Chọn Gói VIP cho: {{ $room->title }}</h1>
        @foreach($vipPackages as $package)
            <div class="card mb-3">
                <div class="card-body">
                    <h3 class="card-title">{{ $package->name }}</h3>
                    <p class="card-text"><strong>Giá:</strong> {{number_format($package->price,0,',', '.')}} VND</p>
                    <p class="card-text"><strong>Thời gian:</strong> {{ $package->duration_days }} ngày</p>
                    <p class="card-text"><strong>Lượt xem tăng:</strong> {{ $package->boosted_views }}</p>

                    <!-- Form để mua gói VIP -->
                    <form action="{{ route('admin.vip.purchase', [$room->id,$package->id]) }}" method="POST">
                        @csrf
                        <input type="hidden" name="vip_package_id" value="{{ $package->id }}">
                        <button type="submit" class="btn btn-primary">Mua Gói</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
