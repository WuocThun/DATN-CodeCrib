@extends('fe.layouts.app')
@section('title','Bộ lọc')
@section('header')
    @include('fe.inc.header')
@endsection
@section('searchBar')
    @include('fe.inc.search_bar')
@endsection
@section('hotZone')
    @include('fe.inc.hot_zone')
@endsection
@section('main')
    <style>
        .call-btn {
            background-color: #007bff;
            border: none;
            font-size: 14px;
            color: white;
        }
    </style>
    <section class="search-results">
        <div class="container search-results-container">
            <div class="results-left">
                <h2>Tổng {{count($rooms)}} kết quả</h2>
                <div class="sort-options">
                    <span>Sắp xếp: </span>
                    <button onclick="window.location.href='{{'/bo-loc/phong?orderby=mac-dinh'}}'" class="btn sort-btn">
                        Mặc định
                    </button>
                    <button onclick="window.location.href='{{'/bo-loc/phong?orderby=moi-nhat'}}'" class="btn sort-btn">
                        Mới nhất
                    </button>
                    <button class="btn sort-btn">Có video</button>
                </div>
                @if($rooms->isEmpty())
                    <h3>Hiện không có phòng khả dụng</h3>
            </div>
            @include('fe.inc.fitler_blogs_right')
            @else
                @foreach($rooms as $room => $room1)
                    @php
                        $styles = $room1->vipPackage->getDisplayStyles();
                    @endphp
                    <a href="{{route('getRoom',$room1->slug)}}" style="text-decoration: none;">
                        <div class="result-item">
                            @php
                                $images = json_decode($room1->image, true);
                            @endphp
                            <img src="{{asset('uploads/fe/img/room1.jpg')}}" alt="Ký túc xá Tân Bình">
                            <div class="result-info">
                                <h3 style="color: {{ $styles['color'] }}; font-weight: {{ $styles['fontWeight'] }}; text-transform: {{ $styles['textTransform'] }};">{{$room1->title}}</h3>
                                <p>{{number_format($room1->price,0,',', '.')}} nghìn/tháng - {{$room1->area}}m² </p>
                                <p>{{$room1->full_address}}</p>

                                <p>{{ \Illuminate\Support\Str::limit($room1->description, 15, '...') }}</p>
                                <div class="contact-options">
                                    <button class="btn  call-btn">Gọi {{$room1->phone_number}}</button>
                                    <a href="https://zalo.me/{{ $room1->phone_number }}" target="_blank">
                                        <button class="btn zalo-btn">Nhắn Zalo</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
                <div class="pagination">
                    @if ($rooms->onFirstPage())
                        <button class="prev" disabled>« Trang trước</button>
                    @else
                        <a href="{{ $rooms->previousPageUrl() }}" class="prev">« Trang trước</a>
                    @endif

                    @for ($page = 1; $page <= $rooms->lastPage(); $page++)
                        <a href="{{ $rooms->url($page) }}"
                           class="page {{ $page == $rooms->currentPage() ? 'active' : '' }}">{{ $page }}</a>
                    @endfor

                    @if ($rooms->hasMorePages())
                        <a href="{{ $rooms->nextPageUrl() }}" class="next">Trang sau »</a>
                    @else
                        <button class="next" disabled>Trang sau »</button>
                    @endif
                </div>

        </div>

        @include('fe.inc.fitler_blogs_right')

        @endif
        </div>
    </section>
@endsection
@section('overView')
    @include('fe.inc.over_view')
@endsection
@section('footer')
    @include('fe.inc.footer')
@endsection

