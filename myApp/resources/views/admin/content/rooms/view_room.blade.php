@extends('admin.layouts.app')
@section('navbar')
    @include('admin.inc.navbar')
@endsection
@section('main')
    <link rel="stylesheet" href="{{asset('style/css/style.css')}}"/>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous"
    />
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"
    ></script>
<body>
<!-- Header -->

<!-- Search Results -->
<section class="search-results">
    <div class="container search-results-container">
        <div class="">
            @php
                $images = json_decode($room->image, true);
            @endphp

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
            </div>


            <b style="font-size: 20px; color: red">
                    {{$room->title}}                </b>

                <div class="address">
                    <div class="iconaddress"></div>
                    <span style="margin-left: 10px">Địa chỉ: {{$room->full_address}}</span>
                </div>

                <div class="attributes">
                    <div class="iconprice"></div>
                    <span
                        style="
                  color: #16c784;
                  font-weight: bold;
                  font-size: 18px;
                  margin-left: 10px;">{{$room->price}} triệu/tháng</span>
                    <div class="iconacreage"></div>
                    <span style="margin-left: 10px">Diện tích:{{$room->area}} m<sup>2</sup></span>
                    <div class="iconclock"></div>
{{--                    <span style="margin-left: 10px">{{$room->created_at}}</span>--}}
                    <span style="margin-left: 10px">Đã đăng {{ $timePosted }} </span>
                    <div class="iconhastag"></div>
                    <span style="margin-left: 10px">81204</span>
                </div>
                <h3 style="margin-top: 20px">Thông tin mô tả</h3>
                <div>
                    @php
                    echo($room->description);
                    @endphp
                </div>
                <table class="table table table-striped">
                    <tbody>
                    <tr>
                        <td class="name">Mã tin:</td>
                        <td>{{$room->id}}</td>
                    </tr>
                    <tr>
                        <td class="name">Chuyên mục:</td>
                        <td>
                            <a
                                style="text-decoration: underline"
                                title="Phòng trọ Quận 2"
                                href="page2.html"><strong>Cho thuê phòng trọ {{$getDistrict}}</strong></a>
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
                        <td><span style="color: #e13427">Tin VIP nổi bật</span></td>
                    </tr>
                    <tr>
                        <td class="name">Ngày đăng:</td>
                        <td>
                            <time title="Thứ 6, 15:33 04/10/2024">Thứ 6, 15:33 04/10/2024
                            </time>
                        </td>
                    </tr>
                    <tr>
                        <td class="name">Ngày hết hạn:</td>
                        <td>
                            <time title="Thứ 4, 13:41 09/10/2024">Thứ 4, 13:41 09/10/2024
                            </time>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <h3>Thông tin liên hệ</h3>
                <table class="table table table-striped">
                    <tr>
                        <td class="name">Liên hệ:</td>
                        <td>{{$getUser->name}}</td>
                    </tr>
                    <tr>
                        <td class="name">Điện thoại:</td>
                        <td>{{$getUser->phone_number}}</td>
                    </tr>
                    <tr>
                        <td class="name">Zalo</td>
                        <td>{{$getUser->phone_number}}</td>
                    </tr>
                </table>

                <iframe src="https://maps.google.com/maps?&hl=en&q=${{$room->full_address}}&t=&z=12&ie=UTF8&iwloc=B&output=embed"
                        width="850" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                ></iframe>
                <p>Bạn đang xem nội dung tin đăng: "{{$room->title}} - Mã
                    tin: #{{$room->id}}". Mọi thông tin liên quan đến tin đăng này chỉ mang tính chất tham khảo. Nếu bạn có phản
                    hồi với tin đăng này (báo xấu, tin đã cho thuê, không liên lạc được,...), vui lòng thông báo để
                    CodeCrib có thể xử lý.</p>
            </div>



</section>

</body>
<script src="{{asset('style/js/myapp.js')}}"></script>
@endsection
