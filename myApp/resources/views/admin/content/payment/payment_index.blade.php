@extends('admin.layouts.app')
@section('navbar')
    @include('admin.inc.navbar')
@endsection
@section('main')
    <main role="main" class="ml-sm-auto col-lg-10">

        <div class="user_quick_info js-mobile-user-quick-info">
            <p style="margin-top: 0; margin-bottom: 5px;">Xin chào <strong>Hồ Phạm Quốc Thuận</strong>. Mã tài khoản: <strong>144922</strong></p>
            <p style="margin-bottom: 0;">Số dư TK của bạn là: <strong> {{number_format(auth()->user()->balance,0,',', '.')}} đ</strong></p>
        </div>
        <div class="alert alert-warning" role="alert">
            <p><strong>Lưu ý quan trọng:</strong></p>
            <p>- Nội dung chuyển tiền bạn vui lòng ghi đúng thông tin sau:</p><p>
            </p><p><strong style="color: red;">" Crib - {{auth()->user()->id}} -  {{substr(auth()->user()->phone_number, -3)}}"</strong></p>
            <p>Trong đó {{auth()->user()->id}} là mã thành viên,  {{substr(auth()->user()->phone_number, -3)}} là 3 số cuối điện thoại của bạn đăng ký trên website CodeCrib.com.</p>
            <p>Xin cảm ơn!</p>
        </div>


        <div class="row">
            <div class="col-md-9">
                <h3 class="mt-5 mb-3">Mời bạn chọn phương thức nạp tiền</h3>
                <div class="list-group dashboard_list_payment_method d-md-none">
                    <a href="https://phongtro123.com/quan-ly/nap-tien/chuyen-khoan.html" class="list-group-item"><div class="item-icon"><img src="/images/bank-transfer.png"></div> Chuyển khoản <svg style="position: absolute; right: 10px; top: 50%; margin-top: -8px;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg></a>

                </div>
                <div class="d-none d-md-block">
                    <div class="row addfund_method_list clearfix">
                        <div class="col-md-4">
                            <div class="method_item">
                                <a href="{{route('admin.payment.mbbank')}}">
                                    <div class="method_item_icon">
                                        <img src="{{asset('uploads/payment/payment-transfer.png')}}" alt="Chuyển khoản trực tiếp" title="Chuyển khoản trực tiếp">
                                    </div>
                                    <div class="method_item_name">
                                        Chuyển khoản qua ngân hàng MbBank
                                    </div>
                                    <button class="btn btn_select_method">Chọn</button>
                                </a>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div class="col-md-3 d-none d-md-block">
                <div class="card mb-3">
                    <div class="card-body">
                        <div>Số dư tài khoản</div>
                        <h3 class="heading" style="margin-top: 0; margin-bottom: 0; color: #28a745;"><strong>{{number_format(auth()->user()->balance,0,',', '.')}} đ</strong></h3>
                    </div>
                </div>
                <a class="btn btn-secondary btn-block" href="{{route('admin.payment.historyPayment')}}">Lịch sử nạp tiền <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg></a>
            </div>
        </div>


        <br><br>

    </main>
@endsection
