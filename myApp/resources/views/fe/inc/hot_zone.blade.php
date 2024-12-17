<section class="featured-areas">
    <div class="container featured-container">
        <h1 class="onetk">Cho Thuê Phòng Trọ, Giá Rẻ, Tiện Nghi, Mới Nhất 2024</h1>
        <p class="content">
            Cho thuê phòng trọ - Kênh thông tin số 1 về phòng trọ giá rẻ, phòng trọ sinh viên, phòng trọ cao cấp mới
            nhất năm 2024. Tất cả nhà trọ cho thuê giá tốt nhất tại Việt Nam.
        </p>
        <h2>Khu vực nổi bật</h2>
        <div class="area-cards">
            @foreach($allProvinceData as $province)
                <div class="card">
                    <a href="{{route('getProvinderRoom',$province['province_id'])}}">
                        <img src="{{ asset('uploads/fe/img/th (1).jpg') }}">
                    </a>
                    <p>Phòng trọ {{ $province['province_name'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
