@extends('fe.layouts.app')
@section('header')
    @include('fe.inc.header')
@endsection
{{--@section('searchBar')--}}
{{--@include('fe.inc.search_bar')--}}
{{--@endsection--}}
{{--@section('hotZone')--}}
{{--@include('fe.inc.hot_zone')--}}
{{--@endsection--}}
<style>
    p {
        max-width: 100%; /* Giới hạn chiều rộng */
        max-height: 150px; /* Giới hạn chiều cao */
        overflow-y: auto; /* Hiển thị thanh cuộn dọc nếu cần */
        word-wrap: break-word; /* Chia nhỏ từ để không bị tràn */
    }

</style>
@section('main')
    @php
        $images = json_decode($room->image, true);
            $styles = $room->vipPackage->getDisplayStyles();
            $styles = $room->vipPackage->getDisplayStyles();

    @endphp



    <section class="search-results">

        <div class="container search-results-container">

            <div class="results-left">
                <div id="breadcrumb">
                    <ol class="clearfix">
                        <li class="first link">
                            <a href="#" title="Cho thuê phòng trọ">
                                <span>{{$ClassRoom->title}}</span>
                            </a>
                        </li>
                        <li class="link link">
                            <a href="#" title="{{$provinceData['province_name']}}">
                                <span>{{$provinceData['province_name']}}</span>
                            </a>
                        </li>
                        <li class="link link">
                            <a href="#" title="{{$getDistrict}}">
                                <span>{{$getDistrict}}</span>

                            </a>
                        </li>
                        <li class="link last">
                            <span>{{$room->title}}</span>
                        </li>
                    </ol>
                </div>

                <div class="item-detail">
                    @if (!empty($images))
                        <!-- Carousel -->
                        <div id="demo" class="carousel slide" data-bs-ride="carousel">
                            <!-- Indicators/dots -->
                            <div class="carousel-indicators">
                                @foreach ($images as $index => $img)
                                    <button
                                        type="button"
                                        data-bs-target="#demo"
                                        data-bs-slide-to="{{ $index }}"
                                        class="{{ $index == 0 ? 'active' : '' }}"
                                    ></button>
                                @endforeach
                            </div>

                            <!-- The slideshow/carousel -->
                            <div class="carousel-inner">
                                @foreach ($images as $index => $img)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <img
                                            src="{{ asset('uploads/rooms/' . $img) }}"
                                            alt="Room Image {{ $index + 1 }}"
                                            class="d-block h-100"
                                            style="width: 100%"
                                        />
                                    </div>
                                @endforeach
                            </div>

                            <!-- Left and right controls/icons -->
                            <button
                                class="carousel-control-prev"
                                type="button"
                                data-bs-target="#demo"
                                data-bs-slide="prev"
                            >
                                <span class="carousel-control-prev-icon"></span>
                            </button>
                            <button
                                class="carousel-control-next"
                                type="button"
                                data-bs-target="#demo"
                                data-bs-slide="next"
                            >
                                <span class="carousel-control-next-icon"></span>
                            </button>
                        </div>
                    @else
                        <p>No images available</p>
                    @endif

                    {{--                    <b class="title_room" style="font-size: 20px;">--}}
                    {{--                        {{$room->title}}--}}
                    {{--                    </b>--}}

                    <h3 class="mt-3"
                        style="color: {{ $styles['color'] }}; font-weight: {{ $styles['fontWeight'] }}; text-transform: {{ $styles['textTransform'] }};">{{$room->title}}</h3>

                    <div class="address mb-3">
                        <img class="addr_icone" id="addr_icone" width="10px" height="10px"
                             src="{{asset('uploads/maps-and-flags.png')}}">
                        <span class="ms-2">Địa chỉ: {{$room->full_address}}</span>
                    </div>

                    <div class="attributes mb-3">
                        <span class="badge bg-success">{{number_format($room->price,0,',', '.')}} nghìn/tháng</span>
                        <span class="ms-2">{{$room->area}} m<sup>2</sup></span>
                        <span class="ms-2">{{$timePosted}}</span>
                        <span class="ms-2">Mã phòng: {{$room->id}}</span>
                    </div>
                    <h3 style="margin-top: 20px">Thông tin mô tả</h3>
                    <div class="content-container">
                        @php
                            echo($room->description);
                        @endphp
                    </div>
                    <table class="table table table-striped">
                        <tbody>
                        <tr>
                            <td class="name">Mã phòng:</td>
                            <td>{{$room->id}}</td>
                        </tr>
                        <tr>
                            <td class="name">Chuyên mục:</td>
                            <td>
                                <a
                                    style="text-decoration: underline"
                                    title="{{$getDistrict}}"
                                    href="#"><strong>Cho thuê phòng trọ {{$getDistrict}}</strong></a>
                            </td>
                        </tr>
                        <tr>
                            <td class="name">Khu vực</td>
                            <td>Cho thuê phòng trọ {{$provinceData['province_name']}}
                                {{--                        @foreach($provinceData as $key1 => $province)--}}
                                {{--                            {{dd($provinceData['province_name'])}}--}}
                                {{--                        @endforeach--}}
                            </td>
                        </tr>
                        <tr>
                            <td class="name">Loại tin rao:</td>
                            <td>{{$ClassRoom->title}}</td>
                        </tr>
                        <tr>
                            <td class="name">Đối tượng thuê:</td>
                            @if($room->gender_rental === 0)
                                <td>Tất cả</td>
                            @elseif($room->gender_rental === 1)
                                <td>Nam</td>
                            @else
                                <td>Nữ</td>
                            @endif
                        </tr>
                        <tr>
                            <td class="name">Gói tin:</td>
                            <td><span style="color: #e13427">{{$vipPackages->name}}</span></td>
                        </tr>
                        {{--                        <tr>--}}
                        {{--                            <td class="name">Ngày đăng:</td>--}}
                        {{--                            <td>--}}
                        {{--                                <time title="Thứ 6, 15:33 04/10/2024">Thứ 6, 15:33 04/10/2024--}}
                        {{--                                </time>--}}
                        {{--                            </td>--}}
                        {{--                        </tr>--}}
                        {{--                        <tr>--}}
                        {{--                            <td class="name">Ngày hết hạn:</td>--}}
                        {{--                            <td>--}}
                        {{--                                <time title="Thứ 4, 13:41 09/10/2024">Thứ 4, 13:41 09/10/2024--}}
                        {{--                                </time>--}}
                        {{--                            </td>--}}
                        {{--                        </tr>--}}
                        </tbody>
                    </table>
                    <br>
                    <br>
                    <div class="mb-4">
                        <h3 class="border-danger border-bottom">Các tiện ích hiện có</h3>
                        <div class="row">
                            @foreach($room->utilities as $utility)
                                <div class="col-md-4">
                                    <p>{{ $utility->name }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <h3>Thông tin liên hệ</h3>

                    <table class="table table table-striped">
                        <tr>
                            <td class="name">Liên hệ:</td>
                            <td>{{$findUser->name}}</td>
                        </tr>
                        <tr>
                            <td class="name">Điện thoại:</td>
                            <td>{{$findUser->phone_number}}</td>
                        </tr>
                        <tr>
                            <td class="name">Zalo</td>
                            <td>{{$findUser->phone_number}}</td>
                        </tr>
                    </table>
                    <iframe
                        src="https://maps.google.com/maps?&hl=en&q=${{$room->full_address}}&t=&z=12&ie=UTF8&iwloc=B&output=embed"
                        width="850"
                        height="450"
                        style="border: 0"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                    ></iframe>
                    <p>Bạn đang xem nội dung tin đăng: "{{$room->title}} - Mã
                        tin: #{{$room->id}}". Mọi thông tin liên quan đến tin đăng này chỉ mang tính chất tham khảo. Nếu
                        bạn có phản
                        hồi với tin đăng này (báo xấu, tin đã cho thuê, không liên lạc được,...), vui lòng thông báo để
                        CodeCrib có thể xử lý.</p>
                </div>
                @if ($room->comments->isEmpty())
                    <p class="text-muted">Chưa có bình luận nào cho phòng này.</p>
                @else
                    <div class="row">
                        @foreach ($room->comments as $comment)
                            <div class="col-md-4">
                            <div class="card" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">Tên người đăng:  {{$comment->user->name}}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">{{$comment->created_at}}</h6>
                                    <p class="card-text">{{$comment->content}}.</p>
                                    @if($comment->rating)
                                        <!-- Display stars based on the rating -->
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $comment->rating)
                                                <span class="fa fa-star" style="color: gold;"></span> <!-- Full star -->
                                            @else
                                                <span class="fa fa-star" style="color: gray;"></span> <!-- Empty star -->
                                            @endif
                                        @endfor
                                    @else
                                        <span>No rating</span> <!-- If no rating exists -->
                                    @endif
                                </div>
                            </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                <div class="pagination">
                    {{--                <a href="{{route('getRoom',$room1->slug)}}" style="text-decoration: none;">--}}
                    {{--                    <div class="result-item">--}}
                    {{--                        @php--}}
                    {{--                            $images = json_decode($room1->image, true);--}}
                    {{--                        @endphp--}}
                    {{--                        <img src="{{asset('uploads/fe/img/room1.jpg')}}" alt="Ký túc xá Tân Bình">--}}
                    {{--                        <div class="result-info">--}}
                    {{--                            <h3>{{$room1->title}}</h3>--}}
                    {{--                            <p>{{$room1->price}}triệu/tháng - {{$room1->area}}m² </p>--}}
                    {{--                            <p>{{$room1->full_address}}</p>--}}

                    {{--                            --}}{{--                            <p>{{ \Illuminate\Support\Str::limit($room1->description, 15, '...') }}</p>--}}
                    {{--                            <div class="contact-options">--}}
                    {{--                                <button class="btn call-success">Gọi {{$room1->phone_number}}</button>--}}
                    {{--                                --}}{{--                                <button class="btn zalo-btn">Nhắn Zalo</button>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    {{--                </a>--}}

                    @include('fe.inc.comment',['roomId'=>$room->id])
                </div>
            </div>

            @include('fe.inc.fitler_blogs_right')
        </div>
    </section>
@endsection
@section('overView')
    @include('fe.inc.over_view')
@endsection
@section('footer')
    @include('fe.inc.footer')
@endsection

