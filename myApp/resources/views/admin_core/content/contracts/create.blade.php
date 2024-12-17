@extends('admin_core.layouts.test')

@section('main')
    <main role="main" class="ml-sm-auto col">

        <div class="container">
            <h1>Danh Sách Hợp Đồng</h1>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Người Thuê</th>
                    <th>Chủ Trọ</th>
                    <th>Ngày Bắt Đầu</th>
                    <th>Ngày Kết Thúc</th>
                    <th>Trạng Thái</th>
                    <th>Hành Động</th>
                </tr>
                </thead>
                <tbody>
                @foreach($contracts as $contract)
                    <tr>
                        <td>{{ $contract->id }}</td>
                        <td>{{ $contract->tenant_name }}</td>
                        <td>{{ $contract->owner_name }}</td>
                        <td>{{ $contract->start_date }}</td>
                        <td>{{ $contract->end_date }}</td>
                        <td>{{ $contract->status }}</td>
                        <td>
                            <a href="{{ asset($contract->contract_file) }}" target="_blank" class="btn btn-sm btn-success">
                                Xem Hợp Đồng
                            </a>
                        </td>
                        <td>
                            @if(!empty($contract->contract_image))
                                @php
                                    $images = is_array(json_decode($contract->contract_image, true))
                                              ? json_decode($contract->contract_image, true)
                                              : [$contract->contract_image]; // Đưa vào mảng nếu là string
                                @endphp

                                @if(count($images) > 1)
                                    <!-- Hiển thị nhiều ảnh -->
                                    <div class="row">
                                        @foreach($images as $image)
                                            <div class="col-md-3">
                                                <div class="card mb-3">
                                                    <img src="{{ asset('uploads/contracts/' . $image) }}" class="card-img-top" alt="Contract Image">
                                                    <div class="card-body text-center">
                                                        <button class="btn btn-danger btn-sm delete-image" data-image="{{ $image }}">Xóa</button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <!-- Hiển thị một ảnh -->
                                    <div class="text-center">
                                        <img src="{{ asset('uploads/contracts/' . $images[0]) }}" class="img-fluid rounded" alt="Contract Image">
                                    </div>
                                @endif
                            @endif

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>


            {{ $contracts->links() }}
        </div>
    </main>
@endsection
