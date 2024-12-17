@extends('fe.layouts.app')
@section('header')
    @include('fe.inc.header')
@endsection
@section('main')
    <div class="container">

        <h1>Bài Đăng Tìm Người Ở Cùng</h1>

        <div class="container search-results-container">

            <div class="results-left">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif    @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @foreach($requests as $room )
                    {{--                    <a href="{{ route('getRoom', $room->id) }}" style="text-decoration: none;">--}}
                    <div class="card mb-4 shadow-sm" style="max-width: 600px; margin: auto;">
                        @if ($room->image)
                            <div id="roomImagesCarousel-{{ $room->id }}" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach (json_decode($room->image, true) as $index => $image)
                                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                            <img class="d-block w-100" src="{{ asset($image) }}"
                                                 alt="Image {{ $index + 1 }}" style="height: 300px; object-fit: cover;">
                                        </div>
                                    @endforeach
                                </div>
                                <!-- Điều khiển slider -->
                                <button class="carousel-control-prev" type="button"
                                        data-bs-target="#roomImagesCarousel-{{ $room->id }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                        data-bs-target="#roomImagesCarousel-{{ $room->id }}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        @else
                            <div class="card-header text-center bg-info">
                                <div class="row">
                                </div>
                                <img class="img-fluid" src="{{ asset('uploads/logoCodeCrib.png') }}"
                                     style="height: 300px; object-fit: contain;">
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title text-truncate">{{ $room->title }}</h5>
                            <p class="card-text text-muted mb-2">
                                {{ number_format($room->motel->money, 0, ',', '.') }} nghìn/tháng - {{ $room->area }}m²
                            </p>
                            <p class="card-text text-muted mb-2">{{ $room->full_address }}</p>
                            <p class="card-text text-truncate">{{ \Illuminate\Support\Str::limit($room->description, 50, '...') }}</p>
                            @role('admin||viewer')
                            <div class="d-flex justify-content-between align-items-center">
                                <form action="{{ route('room-requests.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="motel_id" value="{{ $room->motel->id }}">
                                    <button type="submit" class="btn btn-warning">Yêu cầu tham gia</button>
                                </form>
                            </div>
                            @endrole
                        </div>
                    </div>
                    {{--                    </a>--}}
                @endforeach
                <div class="pagination">
                    @if ($requests->onFirstPage())
                        <button class="prev" disabled>« Trang trước</button>
                    @else
                        <a href="{{ $requests->previousPageUrl() }}" class="prev">« Trang trước</a>
                    @endif

                    @for ($page = 1; $page <= $requests->lastPage(); $page++)
                        <a href="{{ $requests->url($page) }}"
                           class="page {{ $page == $requests->currentPage() ? 'active' : '' }}">{{ $page }}</a>
                    @endfor

                    @if ($requests->hasMorePages())
                        <a href="{{ $requests->nextPageUrl() }}" class="next">Trang sau »</a>
                    @else
                        <button class="next" disabled>Trang sau »</button>
                    @endif
                </div>
            </div>

            @include('fe.inc.fitler_blogs_right')
        </div>


@endsection
