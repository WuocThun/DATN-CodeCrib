@extends('admin_core.layouts.test')

@section('main')
    <div class="main-box">
        <div class="card">
            <div class="card-header text-center">
                <h2 class="payment-title text-danger">Thanh toán đã bị huỷ</h2>
            </div>
            <div class="card-body text-center">
                <img src="{{ asset('uploads/logoCodeCrib.png') }}" width="300px" alt="Cancelled" class="mb-3" style="max-width: 150px;">
                <p class="lead">
                    Rất tiếc, giao dịch của bạn đã bị huỷ.
                    Chúng tôi hiểu rằng điều này có thể gây ra sự bất tiện.
                </p>
                <p>
                    Nếu có bất kỳ câu hỏi nào, hãy gửi email tới
                    <a href="mailto:binngoc1963@gmail.vn" class="text-primary">admin</a>
                </p>
                <p>
                    Bạn có thể thử lại hoặc kiểm tra thông tin thanh toán của mình.
                </p>
                <a href="{{ route('admin.trangChuNapThe') }}" id="return-page-btn" class="btn btn-primary mt-3">
                    Trở về trang chủ thanh toán
                </a>
            </div>
        </div>
    </div>
@endsection
