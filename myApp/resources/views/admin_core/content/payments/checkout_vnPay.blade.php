@extends('admin_core.layouts.test')
@section('navbar')
    @include('admin_core.inc.navbar')
@endsection
@section('main')
    <main role="main" class="ml-sm-auto col">
        @include('admin_core.inc.sub_main')
        <div class="main-box">
{{--            <div class="note alert alert-success js-promotion-payment-daily" role="alert">--}}
{{--                <p><strong>Khuyến mãi:</strong></p>--}}
{{--                <ul>--}}
{{--                    <li>Nạp từ 50.000 đến dưới 1.000.000 tặng <strong>10%</strong></li>--}}
{{--                    <li>Nạp từ 1.000.000 đến dưới 2.000.000 tặng <strong>20%</strong></li>--}}
{{--                    <li>Nạp từ 2.000.000 trở lên tặng <strong>25%</strong></li>--}}
{{--                </ul>--}}
{{--            </div>--}}

            <div class="payment-form">
                <form action="{{ route('admin.vnpay.store') }}" method="post">
                    @csrf
                    <div class="checkout">
                        <div class="product">
                            <p><strong>Tên người nhận:</strong> {{ auth()->user()->name }}</p>

                            <label for="amount"><strong>Giá tiền:</strong></label>
                            <div class="input-group mb-3">
                                <input type="number" id="amount" name="amount" class="form-control" min="2000"
                                       max="9000000" step="1" required
                                       oninput="convertAmount()" placeholder="Nhập số tiền...">
                                <div class="input-group-append">
                                    <span class="input-group-text">VNĐ</span>
                                </div>
                            </div>

                            <p id="amountText" class="amount-text"></p>
                        </div>

                        <button type="submit" class="btn btn-primary" id="create-payment-link-btn">
                            Tạo Link thanh toán
                        </button>
                    </div>
                </form>

            </div>

        </div>

    </main>


@endsection
@section('script')
    <script src="{{asset('style/js/payment.js')}}"></script>
@endsection
