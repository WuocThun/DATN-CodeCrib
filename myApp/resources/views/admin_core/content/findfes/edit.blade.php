<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<link  href="../style.css">
</head>

<body class="desktop dashboard quan-ly dang-tin dang-tin-moi">
    <div id="webpage">
        <div class="container-fluid">
            <div class="row">
                <nav class="d-none d-lg-block bg-light sidebar">
                    <div class="user_info">
                        <a href="#" class="clearfix">
                            <div class="user_avatar"><img src="" alt=""></div>
                            <div class="user_meta">
                                <div class="inner">
                                    <div class="user_name">van trung</div>
                                    <div class="user_verify" style="color: #555; font-size: 0.9rem;">0582686301</div>
                                </div>
                            </div>
                        </a>
                        <ul>
                            <li><span>Mã thành viên:</span> <span style="font-weight: 700;"> 145617</span></li>
                            <li><span>TK Chính:</span> <span style="font-weight: 700;"> 0</span></li>

                        </ul>
                        <a class="btn btn-warning" href="./nap-tien.html">Nạp
                            tiền</a>
                        <a class="btn btn-danger" href="./dang-tin-moi.html">Đăng
                            tin</a>
                    </div>
                    <ul class="nav-sidebar">
                        <li class="nav-item">
                            <a class="nav-link " href="./tin-dang.html">
                                <svg xmlns="" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-file-text">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                                Quản lý tin đăng
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="./cap-nhat-thong-tin-ca-nhan.html">
                                <svg xmlns="" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-edit">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                                Sửa thông tin cá nhân
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="./nap-tien.html">
                                <svg xmlns="" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-dollar-sign">
                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                </svg>
                                Nạp tiền vào tài khoản
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="./lich-su-nap-tien.html">
                                <svg xmlns="" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-clock">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                Lịch sử nạp tiền
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="./lich-su-thanh-toan.html">
                                <svg xmlns="" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-calendar">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                Lịch sử thanh toán
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="" target="_blank">
                                <svg xmlns="" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-clipboard">
                                    <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2">
                                    </path>
                                    <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                                </svg>
                                Bảng giá dịch vụ
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">
                                <svg xmlns="" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-message-circle">
                                    <path
                                        d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                                    </path>
                                </svg>
                                Liên hệ
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-user-logout" href="./thoat">
                                <svg xmlns="" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-log-out">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg>
                                Thoát
                            </a>
                        </li>
                    </ul>
                </nav>

                <main role="main" class="ml-sm-auto col">

                    <div class="user_quick_info js-mobile-user-quick-info">
                        <p style="margin-top: 0; margin-bottom: 5px;">Xin chào <strong>van trung</strong>. Mã tài khoản:
                            <strong>145617</strong>
                        </p>
                        <p style="margin-bottom: 0;">Số dư TK của bạn là: <strong>0</strong></p>
                    </div>



                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Code Crib</a></li>
                            <li class="breadcrumb-item"><a href="index.html">Quản lý</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Đăng tin mới</li>
                        </ol>
                    </nav>
                    <div
                        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                        <h1 class="h1">Đăng tin mới</h1>
                    </div>

                    <!-- <div class="alert alert-danger mb-5" role="alert">
                    </div> -->


                    <form action="{{route('findfes.update',$findfe->id) }}" id="form_dangtin" class="form-horizontal js-form-submit-data js-frm-manage-post"
                        data-action-url=""  method="POST" enctype="multipart/form-data" >
                        @method('put')
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                {{-- <div class="row">
                                    <div class="col-md-12">
                                        <h3>Địa chỉ cho thuê</h3>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="province_id" class="col-form-label">Tỉnh/Thành phố</label>
                                            <select id="province_id" name="province_id"
                                                class="form-control js-select-tinhthanhpho" required
                                                data-msg-required="Chưa chọn Tỉnh/TP">
                                                <option value="">-- Chọn Tỉnh/TP --</option>
                                                <option value="90">Hồ Chí Minh</option>
                                                <option value="41">Hà Nội</option>
                                                <option value="72">Đà Nẵng</option>
                                                <option value="87">Bình Dương</option>
                                                <option value="88">Đồng Nai</option>
                                                <option value="89">Bà Rịa - Vũng Tàu</option>
                                                <option value="99">Cần Thơ</option>
                                                <option value="77">Khánh Hòa</option>
                                                <option value="60">Hải Phòng</option>
                                                <option value="97">An Giang</option>
                                                <option value="55">Bắc Giang</option>
                                                <option value="44">Bắc Kạn</option>
                                                <option value="102">Bạc Liêu</option>
                                                <option value="58">Bắc Ninh</option>
                                                <option value="93">Bến Tre</option>
                                                <option value="85">Bình Phước</option>
                                                <option value="79">Bình Thuận</option>
                                                <option value="75">Bình Định</option>
                                                <option value="103">Cà Mau</option>
                                                <option value="43">Cao Bằng</option>
                                                <option value="81">Gia Lai</option>
                                                <option value="42">Hà Giang</option>
                                                <option value="63">Hà Nam</option>
                                                <option value="68">Hà Tĩnh</option>
                                                <option value="59">Hải Dương</option>
                                                <option value="100">Hậu Giang</option>
                                                <option value="51">Hòa Bình</option>
                                                <option value="61">Hưng Yên</option>
                                                <option value="98">Kiên Giang</option>
                                                <option value="80">Kon Tum</option>
                                                <option value="48">Lai Châu</option>
                                                <option value="84">Lâm Đồng</option>
                                                <option value="53">Lạng Sơn</option>
                                                <option value="46">Lào Cai</option>
                                                <option value="91">Long An</option>
                                                <option value="64">Nam Định</option>
                                                <option value="67">Nghệ An</option>
                                                <option value="65">Ninh Bình</option>
                                                <option value="78">Ninh Thuận</option>
                                                <option value="56">Phú Thọ</option>
                                                <option value="76">Phú Yên</option>
                                                <option value="69">Quảng Bình</option>
                                                <option value="73">Quảng Nam</option>
                                                <option value="74">Quảng Ngãi</option>
                                                <option value="54">Quảng Ninh</option>
                                                <option value="70">Quảng Trị</option>
                                                <option value="101">Sóc Trăng</option>
                                                <option value="49">Sơn La</option>
                                                <option value="86">Tây Ninh</option>
                                                <option value="62">Thái Bình</option>
                                                <option value="52">Thái Nguyên</option>
                                                <option value="66">Thanh Hóa</option>
                                                <option value="71">Thừa Thiên Huế</option>
                                                <option value="92">Tiền Giang</option>
                                                <option value="94">Trà Vinh</option>
                                                <option value="45">Tuyên Quang</option>
                                                <option value="95">Vĩnh Long</option>
                                                <option value="57">Vĩnh Phúc</option>
                                                <option value="50">Yên Bái</option>
                                                <option value="82">Đắk Lắk</option>
                                                <option value="83">Đắk Nông</option>
                                                <option value="47">Điện Biên</option>
                                                <option value="96">Đồng Tháp</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="col-form-label" for="district_id">Quận/Huyện</label>
                                            <select name="district_id" id="district_id"
                                                class="form-control js-select-quanhuyen" required
                                                data-msg-required="Chưa chọn Quận/Huyện">
                                                <option value="">chọn quận huyện</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="col-form-label" for="phuongxa">Phường/Xã</label>
                                            <select class="form-control js-select-phuongxa" name="phuongxa"
                                                id="phuongxa">
                                                <option value="">chọn phường xã</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="col-form-label" for="duong">Đường/Phố</label>
                                            <select class="form-control js-select-duong" name="duong" id="duong">
                                                <option value="">chọn đường phố</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="street_number" class="col-form-label">Số nhà</label>
                                            <input type="text" class="form-control js-input-street-number"
                                                name="street_number" id="street_number" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="diachi" class="col-form-label">Địa chỉ chính xác</label>
                                            <input type="text" readonly class="form-control" name="dia_chi" id="diachi"
                                                required data-msg-required="Chưa chọn khu vực đăng tin">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="maps" style="width:100%; height:300px; margin-bottom: 30px;">
                                            <iframe width="100%" height="100%" style="border:0" loading="lazy" allowfullscreen
                                                src="https://www.google.com/maps/embed/v1/place?key=AIzaSyD6Coia3ssHYuRKJ2nDysWBdSlVlBCzKAw&q=Hồ Chí Minh">
                                            </iframe>
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
                                </div> --}}

                                <div class="form-group row mt-5">
                                    <div class="col-md-12">
                                        <h3>Thông tin mô tả</h3>
                                    </div>
                                </div>
                                {{-- <div class="form-group row mt-3">
                                    <label for="post_cat" class="col-md-12 col-form-label">Loại chuyên mục</label>
                                    <div class="col-md-6">
                                        <select class="form-control" id="post_cat" name="loai_chuyen_muc" required
                                            data-msg-required="Chưa chọn loại chuyên mục">
                                            <option value="">-- Chọn loại chuyên mục --</option>

                                            <option value="1">Phòng trọ, nhà trọ</option>
                                            <option value="2">Nhà thuê nguyên căn</option>
                                            <optgroup label="Căn hộ">
                                                <option value="3">Cho thuê căn hộ</option>
                                                <option value="6">Cho thuê căn hộ mini</option>
                                                <option value="7">Cho thuê căn hộ dịch vụ</option>
                                            </optgroup>
                                            <option value="4">Tìm người ở ghép</option>
                                            <option value="5">Cho thuê mặt bằng + Văn phòng</option>
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="form-group row">
                                    <label for="post_title" class="col-md-12 col-form-label">Tiêu đề</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control js-title"  value="{{old('title',$findfe->title)}}" name="title" id="title"
                                            {{-- value="" minlength="30" maxlength="120" --}}
                                            {{-- required data-msg-required="Tiêu đề không được để trống" --}}
                                            {{-- data-msg-minlength="Tiêu đề quá ngắn" data-msg-maxlength="Tiêu đề quá dài"--}} >
                                    </div>
                                    @error('title')

                                    <p class="text-red-400 font-medium">{{$message}}</p>

                                    @enderror
                                </div>

                                <div class="form-group row">
                                    <label for="post_content" class="col-md-12 col-form-label">Nội dung mô tả</label>
                                    <div class="col-md-12">
                                        {{-- <textarea  class="form-control js-content"  name="description" id="description"
                                            {{-- rows="10" required minlength="100"
                                            data-msg-required="Bạn chưa nhập nội dung"
                                            {{-- data-msg-minlength="Nội dung tối thiểu 100 kí tự"--}}

                                            <textarea name="description" placeholder="Enter Description"  class="form-control js-content" cols="30" rows="10"  >{{old('description',$findfe->description)}}</textarea>

                                    </div>
                                    @error('description')

                                    <p class="text-red-400 font-medium">{{$message}}</p>

                                    @enderror
                                </div>

                                <div class="form-group row">
                                    <label for="phone" class="col-md-12 col-form-label">Thông tin liên hệ</label>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <input id="ten_lien_he" type="text" value="{{old('contact_name',$findfe->contact_name)}}" name="contact_name" class="form-control"
                                            placeholder="Name"
                                               >
                                        </div>
                                        @error('contact_name')

                                       <p class="text-red-400 font-medium">{{$message}}</p>

                                       @enderror

                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="phone" class="col-md-12 col-form-label">Điện thoại</label>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            {{-- <input  type="text" value="{{old('contact_phone')}}" name="contact_phone"  class="form-control"
                                                {{-- readonly="readonly" required data-msg-required="Số điện thoại"
                                                value="0582686301"> --}}


                                                <input  value="{{old('contact_phone',$findfe->contact_phone)}}" name="contact_phone"  type="text"
                                                class="form-control ">


                                        </div>

                                        @error('contact_phone')

                                        <p class="text-red-400 font-medium">{{$message}}</p>

                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="giachothue" class="col-md-12 col-form-label">Giá cho thuê</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input id="giachothue" value="{{old('price',$findfe->price)}}" name="price" pattern="[0-9.]+" type="text"
                                                class="form-control js-gia-cho-thue"
                                                {{-- required
                                                data-msg-required="Bạn chưa nhập giá phòng"
                                                data-msg-min="Giá phòng chưa đúng"--}}>

                                            <div class="input-group-append">

                                                <select class="form-control js-unit" name="don_vi" id="don_vi">
                                                    <option value="0">đồng/tháng</option>
                                                    <option value="1">đồng/m2/tháng</option>
                                                </select>
                                            </div>
                                        </div>
                                        <small class="form-text text-muted">Nhập đầy đủ số, ví dụ 1 triệu thì nhập là
                                            1000000</small>

                                            @error('price')

                                            <p class="text-red-400 font-medium">{{$message}}</p>

                                            @enderror
                                    </div>

                                    <label for="text_giachothue" id="text_giachothue"
                                        class="col-sm-12 control-label js-number-text" style="color: red;">
                                    </label>

                                </div>


                                <div class="form-group row">
                                    <label for="post_acreage" class="col-md-12 col-form-label">Diện tích</label>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <input id="post_acreage" type="number" attern="[0-9.]+" value="{{old('area',$findfe->area)}}" name="area"
                                                {{-- max="1000"--}} class="form-control"
                                                 {{-- required
                                                data-msg-required="Bạn chưa nhập diện tích"--}}>
                                            <div class="input-group-append">
                                                <span class="input-group-text">m<sup>2</sup></span>
                                            </div>


                                        </div>
                                        @error('area')

                                            <p class="text-red-400 font-medium">{{$message}}</p>

                                            @enderror
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="doi_tuong" class="col-md-12 col-form-label">Đối tượng cho thuê</label>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            {{-- <select class="form-control" id="post_cat" value="{{old('gender_rental')}}" name="gender_rental">
                                                <option value="0">-- Tất cả --</option>
                                                <option value="1">Nam</option>
                                                <option value="2">Nữ</option>
                                            </select> --}}

                                            <select name="gender_rental" id="gender_rental" class="form-control">
                                                <option value="0" {{ old('gender_rental', $findfe->gender_rental ?? '') == 0 ? 'selected' : '' }}>Tất cả</option>
                                                <option value="1" {{ old('gender_rental', $findfe->gender_rental ?? '') == 1 ? 'selected' : '' }}>Nam</option>
                                                <option value="2" {{ old('gender_rental', $findfe->gender_rental ?? '') == 2 ? 'selected' : '' }}>Nữ</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mt-5">
                                    <div class="col-md-12">
                                        <h3>Hình ảnh</h3>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <p>Avatar</p>
                                        <div class="form-group">
                                            <div for="browse_photos" class="browse_photos js-dropzone">
                                                <input type="file" name="image" >

                                                @if ($findfe->image != "")

                                                <img class="w-5 my-1" src="{{asset('uploads/rooms/avatar/'.$findfe->image)}}" alt="">

                                                @endif


                                            </div>
                                            {{-- @error('image')

                                       <p class="text-red-400 font-medium">{{$message}}</p>

                                       @enderror --}}
                                        </div>
                                        {{-- <p>Ảnh mô tả</p>
                                        <div class="form-group">
                                            <div for="browse_photos" class="browse_photos js-dropzone">
                                                <input type="file" name="image_path[]"  multiple>


                                            </div>
                                            @error('image_path')

                                       <p class="text-red-400 font-medium">{{$message}}</p>

                                       @enderror
                                        </div> --}}


                                        {{-- <div class="list_photos row dropzone-previews"
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
                                        </div> --}}

                                    </div>
                                </div>

                                {{-- <div class="form-group row mt-5">
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
                                </div> --}}
                                {{-- <div class="form-group row">
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
                                </div> --}}
                                <div class="form-group row mt-5">
                                    <div class="col-md-12">
                                        <button type="submit"
                                            class="btn btn-success mb-5 btn-lg btn-block js-btn-hoan-tat">Tiếp
                                            tục</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="action" name="action" value="add_new_post" />
                        <input type="hidden" id="map_lat" name="map_lat" value="" />
                        <input type="hidden" id="map_long" name="map_long" value="" />
                        <input type="hidden" id="payment_method" name="payment_method" value="thanh_toan_sau" />
                    </form>


                    <br><br>

                </main>



            </div>
        </div>



    </div><!-- end webpage -->

</body>

</html>
