<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Tạo Link thanh toán</title>
    <link rel="stylesheet" href="{{asset('style/css/checkout.css')}}"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


</head>
<body>
<div class="main-box">
    {{--    <div class="checkout">--}}
    {{--        <div class="product">--}}
    {{--            <p><strong>Tên sản phẩm:</strong> Mì tôm Hảo Hảo ly</p>--}}
    {{--            <p><strong>Giá tiền:</strong> 2000 VNĐ</p>--}}
    {{--            <p><strong>Số lượng:</strong> 1</p>--}}
    {{--        </div>--}}
    {{--        <form action="{{route('admin.payment.mbbank.createPaymentLink')}}" method="post">--}}
    {{--            @csrf--}}
    {{--            <button type="submit" class="btn" id="create-payment-link-btn">--}}
    {{--                Tạo Link thanh toán--}}
    {{--            </button>--}}
    {{--        </form>--}}
    {{--    </div>--}}
    {{--</div>--}}
    <div class="main-box">
        <form action="{{route('admin.payment.mbbank.createPaymentLink')}}" method="post">
            @csrf
            <div class="checkout">
                <div class="product">
                    <p><strong>Tên người đặt: {{ auth()->user()->name }} </strong></p>
                    <p><strong>Giá tiền:</strong></p>
                    <div class="input-group mb-3">
                        <input type="number" id="amount" name="amount" min="2000" max="9000000" step="1" required
                               oninput="convertAmount()">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">vnđ</span>
                        </div>
                    </div>

                    <p id="amountText" style="margin-top: 10px;"></p>
                    <p><strong>Số lượng:</strong> 1</p>
                </div>

                <button type="submit" class="btn" id="create-payment-link-btn">
                    Tạo Link thanh toán
                </button>
        </form>
    </div>
</div>

</body>
<script src="{{asset('style/js/payment.js')}}"></script>
</html>
