@extends('admin_core.layouts.test')

@section('main')
    <div class="main-box">
        <div class="card">
            <div class="card-header text-center">
                <h4 class="payment-title text-success text-bold">Thanh toán thành công!</h4>
            </div>
            <div class="card-body text-center">
                <img src="{{ asset('uploads/logoCodeCrib.png') }}" width="300px" alt="Cancelled" class="mb-3" style="max-width: 150px;">
                <p class="lead">
                    Cảm ơn bạn. Giao dịch của bạn đã được xử lý thành công.
                </p>
                <p>
                    Nếu có bất kỳ câu hỏi nào, hãy gửi email tới
                    <a href="mailto:binngoc1963@gmail.vn" class="text-primary">admin</a>
                </p>
                <a href="{{ route('admin.trangChuNapThe') }}" id="return-page-btn" class="btn btn-success mt-3">
                    Trở về trang Tạo Link thanh toán
                </a>
            </div>
        </div>
    </div>
@endsection
