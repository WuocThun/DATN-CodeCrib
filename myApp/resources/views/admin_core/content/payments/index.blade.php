@extends('admin_core.layouts.test')
@section('navbar')
    @include('admin_core.inc.navbar')
@endsection
@section('main')
    <main role="main" class="ml-sm-auto col">

        @include('admin_core.inc.sub_main')
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Nạp tiền vào tài khoản</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3 class=" mb-3">Mời bạn chọn phương thức nạp tiền</h3>
                <div class="list-group dashboard_list_payment_method d-md-none">
                </div>
                <div class="d-none d-md-block">
                    <div class="row  addfund_method_listclearfix ">
                        <div class="col-md-3">
                        <div class="method_item">
                            <a href="{{route('admin.payment.mbbank')}}">
                                <div class="method_item_icon">
                                    <img width="200px" class="img-thumbnail" src="{{asset('uploads/payment/payment-transfer.png')}}" alt="Chuyển khoản trực tiếp"
                                         title="Chuyển khoản trực tiếp">
                                </div>
                                <div class="method_item_name">
                                    Thanh toán qua MbBank
                                </div>
                                <button class="btn btn_select_method">Chọn</button>
                            </a>
                        </div>
                        </div>
                        <div class="method_item">
                            <a href="{{route('admin.vnpay')}}">
                                <div class="method_item_icon">
                                    <img width="200px" class="img-thumbnail" src="{{asset('uploads/payment/vnpay.png')}}" alt="Chuyển khoản trực tiếp"
                                         title="Chuyển khoản trực tiếp">
                                </div>
                                <div class="method_item_name">
                                    Thanh toán qua VNPAY
                                </div>
                                <button class="btn btn_select_method">Chọn</button>
                            </a>
                        </div>
                        </div>
{{--                        <div class="method_item">--}}
{{--                            <a href="./nap-tien/atm-internet-banking.html">--}}
{{--                                <div class="method_item_icon">--}}
{{--                                    <img src="/images/payment-method.svg"--}}
{{--                                         alt="Nạp tiền bằng ATM Internet Banking"--}}
{{--                                         title="Nạp tiền bằng Internet Banking">--}}
{{--                                </div>--}}
{{--                                <div class="method_item_name">--}}
{{--                                    Thẻ ATM Internet Banking--}}
{{--                                </div>--}}
{{--                                <button class="btn btn_select_method">Chọn</button>--}}
{{--                            </a>--}}
{{--                        </div>--}}

{{--                        <div class="method_item">--}}
{{--                            <a href="./nap-tien/the-tin-dung.html">--}}
{{--                                <div class="method_item_icon">--}}
{{--                                    <img src="./images/credit-card.png"--}}
{{--                                         alt="Nạp tiền bằng thẻ tín dụng quốc tế"--}}
{{--                                         title="Nạp tiền bằng thẻ tín dụng quốc tế">--}}
{{--                                </div>--}}
{{--                                <div class="method_item_name">--}}
{{--                                    Thẻ tín dụng quốc tế--}}
{{--                                </div>--}}
{{--                                <button class="btn btn_select_method">Chọn</button>--}}
{{--                            </a>--}}
{{--                        </div>--}}


{{--                        <div class="method_item">--}}
{{--                            <a href="./nap-tien/momo.html">--}}
{{--                                <div class="method_item_icon">--}}
{{--                                    <img src="./images/momo.png" alt="Nạp tiền bằng MOMO"--}}
{{--                                         title="Nạp tiền bằng MOMO">--}}
{{--                                </div>--}}
{{--                                <div class="method_item_name">--}}
{{--                                    MOMO--}}
{{--                                </div>--}}
{{--                                <button class="btn btn_select_method">Chọn</button>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        <div class="method_item">--}}
{{--                            <a href="./nap-tien/zalopay.html">--}}
{{--                                <div class="method_item_icon">--}}
{{--                                    <img src="./images/zalopay.png" alt="Nạp tiền bằng ZaloPay"--}}
{{--                                         title="Nạp tiền bằng ZaloPay">--}}
{{--                                </div>--}}
{{--                                <div class="method_item_name">--}}
{{--                                    ZaloPay--}}
{{--                                </div>--}}
{{--                                <button class="btn btn_select_method">Chọn</button>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        <div class="method_item">--}}
{{--                            <a href="./nap-tien/shopeepay.html">--}}
{{--                                <div class="method_item_icon">--}}
{{--                                    <img src="./images/shopeepay2.svg" alt="Nạp tiền bằng ShopeePay"--}}
{{--                                         title="Nạp tiền bằng ShopeePay">--}}
{{--                                </div>--}}
{{--                                <div class="method_item_name">--}}
{{--                                    ShopeePay--}}
{{--                                </div>--}}
{{--                                <button class="btn btn_select_method">Chọn</button>--}}
{{--                            </a>--}}
{{--                        </div>--}}

{{--                        <div class="method_item">--}}
{{--                            <a href="./nap-tien/cua-hang-tien-loi.html">--}}
{{--                                <div class="method_item_icon">--}}
{{--                                    <img src="/images/online-store.svg"--}}
{{--                                         alt="Điểm giao dịch, cửa hàng tiện lợi"--}}
{{--                                         title="Điểm giao dịch, cửa hàng tiện lợi">--}}
{{--                                </div>--}}
{{--                                <div class="method_item_name">--}}
{{--                                    Điểm giao dịch, cửa hàng tiện lợi--}}
{{--                                </div>--}}
{{--                                <button class="btn btn_select_method">Chọn</button>--}}
{{--                            </a>--}}
{{--                        </div>--}}

{{--                        <div class="method_item">--}}
{{--                            <a href="./nap-tien/qr-code.html">--}}
{{--                                <div class="method_item_icon">--}}
{{--                                    <img src="./images/qr-code.png" alt="Quét mã QRCode"--}}
{{--                                         title="Quét mã QRCode">--}}
{{--                                </div>--}}
{{--                                <div class="method_item_name">--}}
{{--                                    Quét mã QRCode--}}
{{--                                </div>--}}
{{--                                <button class="btn btn_select_method">Chọn</button>--}}
{{--                            </a>--}}
{{--                        </div>--}}

                    </div>
                </div>
            </div>

        </div>


        <br><br>

    </main>

@endsection
