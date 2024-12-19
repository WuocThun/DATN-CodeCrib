@extends('admin_core.layouts.test')
@section('main')
    <div class="container mt-4">
        <h2 class="mb-4">Danh sách yêu cầu đang chờ xử lý</h2>
        <div class="row">
            @forelse ($requests as $request)
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="carousel-inner">

                            @foreach (json_decode($request->image, true) as $index => $image)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <img class="d-block w-100" src="{{ asset($image) }}"
                                         alt="Image {{ $index + 1 }}" style="height: 300px; object-fit: cover;">
                                </div>
                            @endforeach

                        </div>
                        <!-- Nội dung yêu cầu -->
                        <div class="card-body">
                            <h5 class="card-title">{{ $request->title }}</h5>
                            <p class="card-text text-muted">
                                Người gửi: {{ $request->user_name }} <br>
                                Phòng trọ: {{ $request->motel_name }}
                            </p>
                            @if($request->status ==0)
                                <p class="card-text text-muted">
                                    Trạng thái: <span class="badge-info btn">Đang đợi duyệt</span>
                                </p>
                            @elseif($request->status ==1)
                                Trạng thái: <span class="badge-info btn"> Đã duyệt</span>
                            @endif
                            <p class="card-text">{{ $request->description }}</p>
                            <p class="text-muted" style="font-size: 0.9rem;">
                                Ngày tạo: {{ \Carbon\Carbon::parse($request->created_at)->format('d/m/Y H:i') }}
                            </p>
                        </div>

                        <!-- Nút hành động -->
                        <div class="card-footer bg-white border-0">
                            <div class="card-footer bg-white border-0">
                                <form action="{{ route('admin.accept.request', $request->id) }}" method="POST"
                                      style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        Chấp nhận
                                    </button>
                                </form>
                                <button class="btn btn-danger btn-sm">Hủy</button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">Không có yêu cầu nào đang chờ xử lý.</p>
            @endforelse
        </div>
    </div>

@endsection
