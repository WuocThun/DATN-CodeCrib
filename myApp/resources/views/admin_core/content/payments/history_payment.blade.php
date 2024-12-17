@extends('admin_core.layouts.test')
@section('navbar')
    @include('admin_core.inc.navbar')
@endsection
@section('main')
<main role="main" class="ml-sm-auto col">

 @include('admin_core.inc.sub_main')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Code Crib</a></li>
            <li class="breadcrumb-item"><a href="index.html">Quản lý</a></li>
            <li class="breadcrumb-item active" aria-current="page">Lịch sử nạp tiền</li>
        </ol>
    </nav>
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Lịch sử nạp tiền: {{count($getAllPayment)}} </h1>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th class="nowrap">Ngày nạp</th>
                <th class="nowrap">Mã giao dịch</th>
                <th class="nowrap">Phương thức</th>
                <th class="nowrap">Số tiền</th>
                <th class="nowrap">Khuyến mãi</th>
                <th class="nowrap">Thực nhận</th>
                <th class="nowrap">Trạng thái</th>
                <th class="nowrap" style="width:200px;">Ghi chú</th>
            </tr>
            </thead>
            <tbody>
@foreach($orderPayment as $payemnt => $historyPayment)
            <tr>
                <td>{{$historyPayment->created_at}}</td>
                <td>{{$historyPayment->description}} - {{$historyPayment->order_code}}</td>
                <td>
                    ATM BANKING
                </td>
                <td>{{number_format($historyPayment->amount,0,',', '.')}} đ</td>
                <td>0</td>
                @if($historyPayment->payment_status == 1)
                    <td>
                        {{number_format($historyPayment->amount,0,',', '.')}} đ
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
@endforeach
            </tbody>
        </table>
    </div>
    <!-- pagination -->
    <div class="pagination">
        @if ($orderPayment->onFirstPage())
            <button class="prev" disabled>« Trang trước</button>
        @else
            <a href="{{ $orderPayment->previousPageUrl() }}" class="prev">« Trang trước</a>
        @endif

        @for ($page = 1; $page <= $orderPayment->lastPage(); $page++)
            <a href="{{ $orderPayment->url($page) }}" class="page {{ $page == $orderPayment->currentPage() ? 'active' : '' }}">{{ $page }}</a>
        @endfor

        @if ($orderPayment->hasMorePages())
            <a href="{{ $orderPayment->nextPageUrl() }}" class="next">Trang sau »</a>
        @else
            <button class="next" disabled>Trang sau »</button>
        @endif
    </div>
    <!-- end pagination -->


    <br><br>

</main>
@endsection
