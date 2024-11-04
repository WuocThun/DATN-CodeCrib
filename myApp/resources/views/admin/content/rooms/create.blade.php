@extends('admin.layouts.app')
@section('navbar')
    @include('admin.inc.navbar')
@endsection
@section('main')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .nameform {
            width: 30%;
        }
        #map {
            width: 100%;
            height: 400px;
            margin-top: 20px;
            border: 1px solid #ccc;
        }
    </style>
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.rooms.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <h1>Chọn địa điểm để xem bản đồ</h1>
            <div class="form-group">
                <label for="province">Tỉnh:</label>
                <select id="province" name="province" class="form-control">
                    <option value="">Chọn tỉnh</option>
                    @foreach ($provinces['results'] as $province)
                        <option value="{{ $province['province_id'] }}">{{ $province['province_name'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="district">Quận:</label>
                <select name="district" id="district"  class="form-control" disabled>
                    <option  value="">Chọn quận</option>
                </select>
            </div>

            <div class="form-group">
                <label for="ward">Phường:</label>
                <select id="ward" name="ward" class="form-control" disabled>
                    <option value="">Chọn phường</option>
                </select>
            </div>

            <div class="form-group">
                <label for="street">Tên đường:</label>
                <input type="text" id="street" class="form-control" placeholder="Nhập tên đường..."/>
            </div>

            <div class="form-group">
                <label for="selectedInfo">Địa chỉ chính xác:</label>
                <input class="nameform form-control" name="full_address" type="text" id="selectedInfo" readonly/>
            </div>

            <iframe id="map" frameborder="0" scrolling="no"></iframe>

            <h1>Thông tin mô tả</h1>
            <div class="form-group">
                <label for="rooms_class_id">Phân loại phòng mà bạn muốn đăng:</label>
                <select name="rooms_class_id" class="form-control">
                    <option value="">Chọn loại phòng:</option>
                    @foreach($getAllClassRoom as $roomsClass)
                        <option value="{{ $roomsClass->id }}">{{ $roomsClass->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="title">Tiêu đề:</label>
                <input type="text" onkeyup="ChangeToSlug();" id="slug" name="title" class="form-control" placeholder="Nhập tiêu đề..."/>
                <input type="text" hidden="" name="slug" class="form-control" id="convert_slug">
            </div>

            <div class="form-group">
                <label for="description">Nhập mô tả về phòng</label>
                <textarea class="des_blog form-control ckeditor" name="description" id="des_blog" rows="3"></textarea>
            </div>

            <h1>Thông tin liên hệ</h1>
            <div class="form-group">
                <label for="">Thông tin liên hệ</label>
                <input type="text" disabled value="{{ $userData->name }}" class="form-control"/>
            </div>
            <div class="form-group">
                <label for="">Số điện thoại</label>
                <input type="text" disabled value="{{ $userData->phone_number }}" class="form-control"/>
            </div>
            <div class="form-group">
                <label for="area">Diện tích</label>
                <input type="text" name="area" class="form-control" placeholder="Diện tích...."/>
            </div>
            <div class="form-group">
                <label for="price">Giá</label>
                <input type="text" name="price" class="form-control" placeholder="Giá...."/>
            </div>
            <div class="form-group">
                <label for="gender_rental">Đối tượng cho thuê</label>
                <select name="gender_rental" class="form-control">
                    <option value="0">-- Tất cả --</option>
                    <option value="1">Nam</option>
                    <option value="2">Nữ</option>
                </select>
            </div>

            <h1>Hình ảnh</h1>
            <div class="form-group">
                <label for="images">Hình ảnh</label>
                <input type="file" name="image[]" class="form-control-file" multiple>
            </div>


            <div class="form-group">
                <label for="video_url">Video URL</label>
                <input type="text" name="video_url" class="form-control">
            </div>
            <div class="form-group">
                <label for="video">Video</label>
                <input type="file" name="video" class="form-control-file">
            </div>

            @role('admin')
            <input type="hidden" name="status" value="1">
            <button type="submit" class="btn btn-primary">Đăng bài</button>
            @endrole
            @role('houseRenter|viewer')
            <input type="hidden" name="status" value="0">
            <button type="submit" class="btn btn-warning">Gửi bài cho QTV</button>
            @endrole
        </form>
    </div>

    <script>
        $(document).ready(function () {
            $('#province').change(function () {
                var provinceId = $(this).val();
                $('#district').prop('disabled', true).empty().append('<option value="">Chọn quận</option>');
                $('#ward').prop('disabled', true).empty().append('<option value="">Chọn phường</option>');

                if (provinceId) {
                    $.get('https://vapi.vnappmob.com/api/province/district/' + provinceId, function (data) {
                        $.each(data.results, function (index, district) {
                            $('#district').append('<option value="' + district.district_id + '">' + district.district_name + '</option>');
                        });
                        $('#district').prop('disabled', false);
                    });
                }
                updateMap();
            });

            $('#district').change(function () {
                var districtId = $(this).val();
                $('#ward').prop('disabled', true).empty().append('<option value="">Chọn phường</option>');

                if (districtId) {
                    $.get('https://vapi.vnappmob.com/api/province/ward/' + districtId, function (data) {
                        $.each(data.results, function (index, ward) {
                            $('#ward').append('<option value="' + ward.ward_id + '">' + ward.ward_name + '</option>');
                        });
                        $('#ward').prop('disabled', false);
                    });
                }
                updateMap();
            });

            $('#ward, #street').on('change keyup', updateMap);

            function updateMap() {
                var provinceName = $('#province option:selected').val() ? $('#province option:selected').text() : '';
                var districtName = $('#district option:selected').val() ? $('#district option:selected').text() : '';
                var wardName = $('#ward option:selected').val() ? $('#ward option:selected').text() : '';
                var streetName = $('#street').val();

                var fullAddress = `${streetName}${wardName ? ', ' + wardName : ''}${districtName ? ' ' + districtName : ''}${provinceName ? ', ' + provinceName : ''}`;

                $('#selectedInfo').val(fullAddress);
                $('input[name="full_address"]').val(fullAddress);
                $('#province_get').val(provinceName);
                $('input[name="province"]').val(provinceName);

                if (fullAddress) {
                    const encodedAddress = encodeURIComponent(fullAddress);
                    const mapSrc = `https://maps.google.com/maps?width=600&height=400&hl=en&q=${encodedAddress}&t=&z=12&ie=UTF8&iwloc=B&output=embed`;
                    $('#map').attr('src', mapSrc);
                }
            }
        });
    </script>
@endsection
