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

        <form action="{{ route('admin.rooms.update', $room->id) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <h1>Chọn địa điểm để xem bản đồ</h1>
            <label for="province">Tỉnh:</label>
            <select id="province" name="province">
                <option value="">Chọn tỉnh</option>
                @foreach ($provinces['results'] as $province)
                    <option value="{{ $province['province_id'] }}">{{ $province['province_name'] }}</option>
                @endforeach
            </select>

            <label for="district">Quận:</label>
            <select id="district" name="district" disabled>
                <option value="">Chọn quận</option>
            </select>

            <label for="ward">Phường:</label>
            <select id="ward" name="ward" disabled>
                <option value="">Chọn phường</option>
            </select>

            <label for="street">Tên đường:</label>
            <input type="text" id="street" placeholder="Nhập tên đường..." />

            <label for="selectedInfo">Địa chỉ chính xác:</label>
            <input class="nameform" value="{{ $room->full_address }}" name="full_address" type="text" id="selectedInfo" readonly />

            <h1>Thông tin mô tả</h1>
            <label for="rooms_class_id">Phân loại phòng mà bạn muốn đăng:</label>
            <select name="rooms_class_id">
                <option value="">Chọn loại phòng:</option>
                @foreach($getAllClassRoom as $roomsClass)
                    <option {{ $roomsClass->id == $room->rooms_class_id ? 'selected' : '' }} value="{{ $roomsClass->id }}">
                        {{ $roomsClass->title }}
                    </option>
                @endforeach
            </select>

            <div class="form-group">
                <label for="title">Tiêu đề:</label>
                <input type="text" onkeyup="ChangeToSlug();" id="slug" value="{{ $room->title }}" name="title" />
                <input type="text" hidden name="slug" class="form-control" id="convert_slug" />
            </div>

            <div class="form-group">
                <label for="des_blog">Nhập mô tả về phòng:</label>
                <textarea class="des_blog form-control ckeditor" name="description" id="des_blog" rows="3">{{ old('description', $room->description) }}</textarea>
            </div>

            <h1>Thông tin liên hệ</h1>
            <div class="form-group">
                <label>Thông tin liên hệ:</label>
                <input type="text" disabled value="{{ $userData->name }}" />
            </div>
            <div class="form-group">
                <label>Số điện thoại:</label>
                <input type="text" disabled value="{{ $userData->phone_number }}" />
            </div>
            <div class="form-group">
                <label>Diện tích:</label>
                <input type="text" name="area" value="{{ old('area', $room->area) }}" />
            </div>
            <div class="form-group">
                <label>Giá:</label>
                <input type="text" name="price" value="{{ old('price', $room->price) }}" />
            </div>

            <div class="form-group">
                <label>Đối tượng cho thuê:</label>
                <select name="gender_rental">
                    <option value="0" {{ $room->gender_rental === 0 ? 'selected' : '' }}>-- Tất cả --</option>
                    <option value="1" {{ $room->gender_rental === 1 ? 'selected' : '' }}>Nam</option>
                    <option value="2" {{ $room->gender_rental === 2 ? 'selected' : '' }}>Nữ</option>
                </select>
            </div>

            <h1>Hình ảnh</h1>
            @php
                $images = json_decode($room->image, true);
            @endphp

            @if (!empty($images))
                @foreach ($images as $index => $img)
                    <img width="200px" height="100px" src="{{ asset('uploads/rooms/' . $img) }}" alt="Room Image" />
                @endforeach
            @else
                <p>No images available</p>
            @endif

            <div class="form-group">
                <label for="">Hình ảnh:</label>
                <input type="file" name="image[]" class="form-control-image" multiple>
            </div>

            <div class="form-group">
                <label for="">Video URL:</label>
                <input type="text" name="video_url" class="form-control-image" /> <br>
                <label for="">Video:</label>
                <input type="file" name="video" class="form-control-image" />
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

        {{-- Embed the map here --}}
{{--        <iframe id="map" frameborder="0" scrolling="no"></iframe>--}}
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

            $('#ward, #street').change(updateMap);

            function updateMap() {
                var provinceName = $('#province option:selected').text();
                var districtName = $('#district option:selected').text();
                var wardName = $('#ward option:selected').text();
                var streetName = $('#street').val();
                var fullAddress = `${streetName}${wardName ? ', ' + wardName : ''}${districtName ? ', ' + districtName : ''}${provinceName ? ', ' + provinceName : ''}`;

                $('#selectedInfo').val(fullAddress);
                $('input[name="full_address"]').val(fullAddress);

                if (fullAddress) {
                    const encodedAddress = encodeURIComponent(fullAddress);
                    const mapSrc = `https://maps.google.com/maps?width=600&height=400&hl=en&q=${encodedAddress}&t=&z=12&ie=UTF8&iwloc=B&output=embed`;
                    $('#map').attr('src', mapSrc);
                }
            }
        });
    </script>
@endsection
