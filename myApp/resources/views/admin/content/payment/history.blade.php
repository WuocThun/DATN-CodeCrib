@extends('admin.layouts.app')
@section('navbar')
    @include('admin.inc.navbar')
@endsection
@section('main')
    <div class="col-md-3 d-none d-md-block">
        <div class="card mb-3">
            <div class="card-body">
                <div>Số dư tài khoản</div>
                <h3 class="heading" style="margin-top: 0; margin-bottom: 0; color: #28a745;"><strong>{{number_format(auth()->user()->balance,0,',', '.')}} đ</strong></h3>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-striped" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th class="nowrap">Ngày nạp</th>
            <th class="nowrap">Mã giao dịch</th>
            <th class="nowrap">Phương thức</th>
            <th class="nowrap">Số tiền</th>
{{--            <th class="nowrap">Khuyến mãi</th>--}}
            <th class="nowrap">Thực nhận</th>
            <th class="nowrap">Trạng thái</th>
            <th class="nowrap" style="width:200px;">Ghi chú</th>
        </tr>
        </thead>
        <tbody>
            @foreach($orderPayment as $order => $payment)
        <tr>
            <td>{{$payment->created_at}}</td>
            <td>{{$payment->order_code}}</td>
            <td>
                ATM Online
            </td>
            <td>{{number_format($payment->amount,0,',', '.')}} đ</td>
{{--            <td>0</td>--}}
            @if($payment->payment_status == 1)
            <td>
                {{number_format($payment->amount,0,',', '.')}} đ
            </td>
                <td align="center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle" style="width: 16px; height: 16px; color: green;"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                </td>
                <td>
                    Thanh toán thành công
                </td>
            @else
                <td>
                    0
                </td>
                <td align="center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle" style="width: 16px; height: 16px; color: red;"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg>
                </td>
                <td>
                    Thanh toán không thành công
                </td>
            @endif
        </tr>
            @endforeach
        </tbody>
    </table>
@endsection
