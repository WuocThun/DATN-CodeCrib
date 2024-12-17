@extends('admin_core.layouts.test')

@section('main')

    <main role="main" class="ml-sm-auto col">

        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h1">Sửa tin <strong> {{$room->title}}</strong></h1>
        </div>



        <form id="form_dangtin" action="{{route('admin.rooms.update',$room->id)}}" method="POST" class="form-horizontal js-form-submit-data js-frm-manage-post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Địa chỉ cho thuê</h3>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="province">Tỉnh:</label>
                                <select id="province" name="province" class="form-control">
                                    <option value="">Chọn tỉnh</option>
                                    @foreach ($provinces['results'] as $province)
                                        <option value="{{ $province['province_id'] }}">{{ $province['province_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="district">Quận:</label>
                                <select name="district" id="district"  class="form-control" disabled>
                                    <option  value="">Chọn quận</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="ward">Phường:</label>
                                <select id="ward" name="ward" class="form-control" disabled>
                                    <option value="">Chọn phường</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="street">Tên đường:</label>
                                <input type="text" id="street" class="form-control" placeholder="Nhập tên đường..."/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="selectedInfo">Địa chỉ chính xác:</label>
                                <input class="nameform form-control" name="full_address" value="{{$room->full_address}}" type="text" id="selectedInfo" readonly/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="maps" style="width:100%; height:300px;margin-bottom: 30px;">
                                <iframe width="100%" height="100%" id="map" frameborder="0" scrolling="no"></iframe>
                            </div>

                            <div class="card mb-5"
                                 style="color: #856404; background-color: #fff3cd; border-color: #ffeeba;">
                                <div class="card-body">
                                    <h4 class="card-title">Lưu ý khi đăng tin</h4>
                                    <ul>
                                        <li style="list-style-type: square; margin-left: 15px;">Nội dung phải viết
                                            bằng tiếng Việt có dấu</li>
                                        <li style="list-style-type: square; margin-left: 15px;">Tiêu đề tin không
                                            dài quá 100 kí tự</li>
                                        <li style="list-style-type: square; margin-left: 15px;">Các bạn nên điền đầy
                                            đủ thông tin vào các mục để tin đăng có hiệu quả hơn.</li>
                                        <li style="list-style-type: square; margin-left: 15px;">Để tăng độ tin cậy
                                            và tin rao được nhiều người quan tâm hơn, hãy sửa vị trí tin rao của bạn
                                            trên bản đồ bằng cách kéo icon tới đúng vị trí của tin rao.</li>
                                        <li style="list-style-type: square; margin-left: 15px;">Tin đăng có hình ảnh
                                            rõ ràng sẽ được xem và gọi gấp nhiều lần so với tin rao không có ảnh.
                                            Hãy đăng ảnh để được giao dịch nhanh chóng!</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mt-5">
                        <div class="col-md-12">
                            <h3>Thông tin mô tả</h3>
                        </div>
                    </div>
                    <div class="form-group row mt-3">
                        <label for="post_cat" class="col-md-12 col-form-label">Loại chuyên mục</label>
                        <div class="col-md-6">
                            <select class="form-control" id="post_cat" name="rooms_class_id" required
                                    data-msg-required="Chưa chọn loại chuyên mục">
                                <option value="">-- Chọn loại chuyên mục --</option>
                                @foreach($getAllClassRoom as $roomsClass)
                                    <option {{ $roomsClass->id == $room->rooms_class_id ? 'selected' : '' }} value="{{ $roomsClass->id }}">
                                        {{ $roomsClass->title }}
                                    </option>                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="post_title" class="col-md-12 col-form-label">Tiêu đề</label>
                        <div class="col-md-12">
                            <input type="text" onkeyup="ChangeToSlug();" class="form-control js-title" name="title" id="slug"
                                   value="{{$room->title}}" minlength="30" maxlength="120" required
                                   data-msg-required="Tiêu đề không được để trống"
                                   data-msg-minlength="Tiêu đề quá ngắn" data-msg-maxlength="Tiêu đề quá dài">
                            <input type="text" hidden="" name="slug" class="form-control" id="convert_slug">

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="post_content" class="col-md-12 col-form-label">Nội dung mô tả</label>
                        <div class="col-md-12">
                            <textarea class="des_blog form-control ckeditor" name="description" id="editor1" rows="3">{{$room->description}}</textarea>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-md-12 col-form-label">Thông tin liên hệ</label>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input id="ten_lien_he" type="text" name="ten_lien_he" class="form-control"
                                       readonly="readonly" required data-msg-required="Tên liên hệ"
                                       value="{{$userData->name}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-md-12 col-form-label">Điện thoại</label>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input id="phone" type="number" name="phone" class="form-control"
                                       readonly="readonly" required data-msg-required="Số điện thoại"
                                       value="{{$userData->phone_number}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="giachothue" class="col-md-12 col-form-label">Giá cho thuê</label>
                        <div class="col-md-6">
                            <div class="input-group">
                                <input id="giachothue" name="price" pattern="[0-9.]+" value="{{$room->price}}" type="text"
                                       class="form-control js-gia-cho-thue" required
                                       data-msg-required="Bạn chưa nhập giá phòng"
                                       data-msg-min="Giá phòng chưa đúng">
                                <div class="input-group-append">

                                    <select class="form-control js-unit" name="don_vi" id="don_vi">
                                        <option value="0">đồng/tháng</option>
                                        <option value="1">đồng/m2/tháng</option>
                                    </select>
                                </div>
                            </div>
                            <small class="form-text text-muted">Nhập đầy đủ số, ví dụ 1 triệu thì nhập là
                                1000000</small>
                        </div>
                        <label for="text_giachothue" id="text_giachothue"
                               class="col-sm-12 control-label js-number-text" style="color: red;"></label>
                    </div>
                    <div class="form-group row">
                        <label for="post_acreage" class="col-md-12 col-form-label">Diện tích</label>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input id="post_acreage" value="{{$room->area}}" type="number" attern="[0-9.]+" name="area"
                                       max="1000" class="form-control" required
                                       data-msg-required="Bạn chưa nhập diện tích">
                                <div class="input-group-append">
                                    <span class="input-group-text">m<sup>2</sup></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="doi_tuong" class="col-md-12 col-form-label">Đối tượng cho thuê</label>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <select class="form-control" id="post_cat" name="gender_rental">
                                    <option value="0" {{ $room->gender_rental === 0 ? 'selected' : '' }}>-- Tất cả --</option>
                                    <option value="1" {{ $room->gender_rental === 1 ? 'selected' : '' }}>Nam</option>
                                    <option value="2" {{ $room->gender_rental === 2 ? 'selected' : '' }}>Nữ</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="utilities" class="col-md-12 col-form-label">Tiện ích</label>
                        <div class="col-md-12">
                            @foreach ($utilities as $utility)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="utilities[]" value="{{ $utility->id }}" id="utility{{ $utility->id }}">
                                    <label class="form-check-label" for="utility{{ $utility->id }}">
                                        {{ $utility->name }}
                                    </label>
                                </div>
                            @endforeach

                        </div>
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
                    <div class="form-group row">
                        <div class="col-md-12">
                            <p>Cập nhật hình ảnh rõ ràng sẽ cho thuê nhanh hơn</p>
                            <div class="form-group">
                                <div for="browse_photos" class="browse_photos js-dropzone"><i
                                        class="icon-upload-image">
                                        <input type="file" name="image[]" id="" multiple>
                                    </i><span class="js-btn-chon-anh">Thêm
                                                    Ảnh</span></div>
                            </div>
                            <div class="list_photos row dropzone-previews"
                                 id="list-photos-dropzone-previews"></div>
                            <div id="tpl" style="display:none">
                                <div class="photo_item col-md-2 col-3 js-photo-manual">
                                    <div class="photo"><img data-dz-thumbnail /></div>
                                    <div class="dz-progress"><span class="dz-upload"
                                                                   data-dz-uploadprogress></span></div>
                                    <div class="bottom clearfix">
                                        <span class="photo_name" data-dz-name></span>
                                        <span class="photo_delete" data-dz-remove><i
                                                data-feather="trash-2"></i> Xóa</span>
                                    </div>
                                    <input name="" value="" type="hidden" />
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group row mt-5">
                        <div class="col-md-12">
                            <h3>Video</h3>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="youtube_url" class="col-md-12 col-form-label">Video Link
                            (Youtube)</label>
                        <div class="col-md-12">
                            <input class="form-control" name="youtube_url" id="youtube_url" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <p>Hoặc upload Video từ máy của bạn</p>
                            <div class="form-group">
                                <div for="browse_photos" class="browse_photos js-dropzone-video"><i
                                        class="icon-upload-video"></i><span class="js-btn-chon-video">Thêm
                                                    Video</span></div>
                            </div>
                            <div class="list_photos row dropzone-previews"
                                 id="list-videos-dropzone-previews"></div>
                            <div id="tpl-video" style="display:none">
                                <div class="photo_item col-md-2 col-3 js-video-manual">
                                    <div class="photo">
                                        <video width="100%" height="100%" controls id="video">
                                            <source src="" />
                                        </video>
                                    </div>
                                    <div class="dz-progress"><span class="dz-upload"
                                                                   data-dz-uploadprogress></span></div>
                                    <div class="bottom clearfix">
                                        <span class="photo_name" data-dz-name></span>
                                        <span class="photo_delete" data-dz-remove><i
                                                data-feather="trash-2"></i> Xóa</span>
                                    </div>
                                    <input name="" value="" type="hidden" />
                                </div>
                            </div>

                        </div>
                    </div>
                    @role('admin')
                    <input type="hidden" name="status" value="1">
                    <div class="form-group row mt-5">
                        <div class="col-md-12">
                            <button type="submit"
                                    class="btn btn-warning mb-5 btn-lg btn-block js-btn-hoan-tat">Đăng phòng</button>
                        </div>
                    </div>
                    @endrole
                    @role('houseRenter|viewer')
                    <input type="hidden" name="status" value="0">
                    <div class="form-group row mt-5">
                        <div class="col-md-12">
                            <button type="submit"
                                    class="btn btn-warning mb-5 btn-lg btn-block js-btn-hoan-tat">Gửi bài cho QTV</button>
                        </div>
                    </div>
                    @endrole

                </div>
            </div>

        </form>


        <br><br>

    </main>

    <script>
        $(document).ready(function () {
            $('#province').change(function () {
                var provinceId = $(this).val();
                $('#district').prop('disabled', true).empty().append('<option value="">Chọn quận</option>');
                $('#ward').prop('disabled', true).empty().append('<option value="">Chọn phường</option>');

                if (provinceId) {
                    $.get('https://api.vnappmob.com/api/v2/province/district/' + provinceId, function (data) {
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
                    $.get('https://api.vnappmob.com/api/v2/province/ward/' + districtId, function (data) {
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
                    const mapSrc = `https://maps.google.com/maps?width=1260&height=3000&hl=en&q=${encodedAddress}&t=&z=12&ie=UTF8&iwloc=B&output=embed`;
                    $('#map').attr('src', mapSrc);
                }
            }
        });
    </script>
@endsection



