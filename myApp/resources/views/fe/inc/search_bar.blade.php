<section class="search-bar">
    <div class="container search-container">
        <input type="hidden" id="room_class" hidden="" value="{!! $cl->title ?? '' !!}" />
        <select class="bus_to_input" id="romm_class_to_input">
            <option></option>
            @foreach ($clasRoom as $class => $cl)
                <option value="{{ $cl->id }}" data-name="{{ $cl->title }}">{{ $cl->title }}</option>
            @endforeach
        </select>
        <select name="province" id="province-select">
            <option></option>
        @foreach($provinceData as $data)
                <option value="{{ $data['province_id'] }}">{{ $data['province_name'] }}</option>
            @endforeach
        </select>

        <select name="gia" id="price-select">
{{--            <option data-placeholder="true"  value="">Chọn giá</option>--}}
            <!-- Các lựa chọn giá ở đây -->
        </select>

        <select name="dien-tich" id="area-select">
{{--            <option ></option>--}}
{{--            <option value="duoi-30">Dưới 30 m²</option>--}}
{{--            <option value="30-50">Từ 30 m² đến 50 m²</option>--}}
{{--            <option value="50-70">Từ 50 m² đến 70 m²</option>--}}
{{--            <option value="tren-70">Trên 70 m²</option>--}}
            <!-- Các lựa chọn diện tích ở đây -->
        </select>

        <button id="bar_search" class="search-btn">Tìm kiếm</button>

        <!-- Div to display search results -->
        <div id="search-results"></div>


</section>
<script>
    document.getElementById('bar_search').addEventListener('click', function() {
        // Lấy giá trị các trường dropdown
        var roomClass = document.getElementById('romm_class_to_input').value || ''; // Nếu không có giá trị thì là chuỗi rỗng
        var provinceId = document.getElementById('province-select').value || '';   // Nếu không có giá trị thì là chuỗi rỗng
        var price = document.getElementById('price-select').value || '';           // Nếu không có giá trị thì là chuỗi rỗng
        var area = document.getElementById('area-select').value || '';             // Nếu không có giá trị thì là chuỗi rỗng

        // Tạo dữ liệu để gửi trong request, chỉ gửi các giá trị đã chọn
        var data = {};

        // Kiểm tra và thêm vào đối tượng `data` nếu có giá trị
        if (roomClass !== '') {
            data.room_class = roomClass;
        }
        if (provinceId !== '') {
            data.province_id = provinceId;
        }
        if (price !== '') {
            data.price = price;
        }
        if (area !== '') {
            data.area = area;
        }

        // Tạo URL với tham số tìm kiếm
        var queryString = new URLSearchParams(data).toString();
        var searchUrl = '/tim-kiem/phong?' + queryString;

        // Chuyển hướng tới trang kết quả tìm kiếm với query string
        window.location.href = searchUrl;
    });
</script>
