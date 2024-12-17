@extends('admin_core.layouts.test')
@section('main')
    <div class="container-fluid">

        <!-- Page Heading -->

        <!-- Content Row -->
        <div class="row">
            <section class="about-section py-5">
                <div class="container">
                    <div class="row align-items-center">
                        <!-- Phần nội dung -->
                        <div class="col-md-6">
                            <h2 class="fw-bold mb-4">Giới thiệu về hệ thống</h2>
                            <p>
                                CodeCrib là một nền tảng hiện đại giúp kết nối chủ phòng trọ và người thuê một cách nhanh chóng và hiệu quả. Với giao diện thân thiện, dễ sử dụng, chúng tôi cung cấp các công cụ quản lý phòng trọ thông minh giúp tiết kiệm thời gian và tối ưu chi phí.
                            </p>
                            <p>
                                Tính năng nổi bật của chúng tôi bao gồm:
                            <ul>
                                <li><i class="fas fa-check text-success"></i> Đăng tin cho thuê phòng nhanh chóng</li>
                                <li><i class="fas fa-check text-success"></i> Tìm kiếm phòng trọ phù hợp</li>
                                <li><i class="fas fa-check text-success"></i> Quản lý hợp đồng và thanh toán tự động</li>
                                <li><i class="fas fa-check text-success"></i> Hỗ trợ tư vấn và phản hồi 24/7</li>
                            </ul>
                            </p>
                        </div>
                        <!-- Phần hình ảnh -->
                        <div class="col-md-6 text-center">
                            <img src="{{asset('uploads/logoCodeCrib.png')}}" alt="Quản lý phòng trọ" class="img-fluid rounded shadow">
                        </div>
                    </div>
                </div>
            </section>

            <!-- Dịch vụ chính -->
            <section class="services py-5 bg-light">
                <div class="container text-center">
                    <h2 class="fw-bold mb-5">Dịch vụ của chúng tôi</h2>
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow">
                                <div class="card-body">
                                    <i class="fas fa-house-user fa-3x text-primary mb-3"></i>
                                    <h5 class="card-title">Cho thuê phòng</h5>
                                    <p class="card-text">Đăng tin cho thuê phòng dễ dàng, tiếp cận nhiều người thuê tiềm năng.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow">
                                <div class="card-body">
                                    <i class="fas fa-search-location fa-3x text-success mb-3"></i>
                                    <h5 class="card-title">Tìm phòng trọ</h5>
                                    <p class="card-text">Tìm kiếm phòng trọ nhanh chóng và phù hợp với nhu cầu của bạn.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow">
                                <div class="card-body">
                                    <i class="fas fa-cogs fa-3x text-danger mb-3"></i>
                                    <h5 class="card-title">Quản lý phòng</h5>
                                    <p class="card-text">Hệ thống quản lý hợp đồng, thanh toán và thông tin phòng trọ tự động.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


        </div>
@endsection
