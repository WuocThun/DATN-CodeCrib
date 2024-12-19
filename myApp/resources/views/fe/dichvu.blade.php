@extends('fe.layouts.app')
@section('header')
    @include('fe.inc.header')
@endsection
@section('main')
    <style>
        body {
            background-color: #eee;
        }
        .container1 {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .content {
            margin: 20px;
            background-color: #fff;
            width: 1000px;
            height: 350px;
            border-radius: 10px;
            padding: 20px;
            text-align: left;
            color: black;
        }
        .tongmota {
            display: flex;
            justify-content: center;
        }
        .cha {
            display: flex;
            justify-content: center;
        }
        .mota {
            width: 700px;
            margin-top: 20px;
        }
        .checked {
            color: orange;
        }
        .mota img {
            width: 700px;
        }
        .tongdg {
            display: flex;
            width: 70%;
            justify-content: center;
            flex-wrap: wrap;
        }
        .danhgia {
            width: 30%;
            background-color: white;
            margin: 10px;
            height: auto;
            border-radius: 10px;
            padding: 20px;
        }

        .tongdg .danhgia .info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-top: 5px;
        }
        .info {
            display: flex;
            flex-direction: row;
            gap: 20px;
        }
        .tongtt {
            display: flex;
            justify-content: center;
            margin-left: 155px;
            flex-wrap: wrap;
            width: 80%;
            gap: 20px;
            margin-bottom: 30px;
        }

        .method {
            width: 250px;
            display: flex;
            justify-content: center;
            height: 160px;
            background-color: white;
            border-radius: 10px;
        }
        .img img {
            max-width: 160px;
            height: 60px;
            margin-top: 40px;
            margin-bottom: 10px;
        }
        .tongheader {
            width: 90%;
            margin: 0 auto;
            padding-bottom: 5px;
        }
        .user-options1 .btn1 {
            background-color: #fff;
            padding: 5px 16px;
            border: none;
            cursor: pointer;
            margin-left: 10px;
            border-radius: 20px;
            font-size: 14px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .user-options1 {
            display: flex;
            flex-direction: row;
        }

        .user-options1 .btn1.highlight1 {
            background-color: #ff3366;
            color: white;
            border-radius: 20px;

        }
    </style>

    <div><h3 style="text-align: center; font-weight: bold ;margin-top: 30px;">
            Giới thiệu CodeCrib.com
        </h3></div>
    <div class="container1">
        <div class="content">
            <p>
                ĐỪNG ĐỂ PHÒNG TRỐNG THÊM BẤT CỨ NGÀY NÀO!, đăng tin ngay tại
                CodeCrib.COM và tất cả các vấn đề sẽ được giải quyết một cách nhanh
                nhất.
            </p>
            <p>ƯU ĐIỂM CodeCrib:</p>
            <p>
                <i class="check">✔</i> <strong>Top đầu google</strong> về từ khóa: cho
                thuê phòng trọ, thuê phòng trọ, phòng trọ hồ chí minh, phòng trọ hà
                nội, thuê nhà nguyên căn, cho thuê căn hộ, tìm người ở ghép…với lưu
                lượng truy cập (traffic) cao nhất trong lĩnh vực.
            </p>
            <p>
                <i class="check">✔</i> <strong>Top đầu google</strong> về từ khóa: cho
                thuê phòng trọ, thuê phòng trọ, phòng trọ hồ chí minh, phòng trọ hà
                nội, thuê nhà nguyên căn, cho thuê căn hộ, tìm người ở ghép…với lưu
                lượng truy cập (traffic) cao nhất trong lĩnh vực.
            </p>
            <p>
                <i class="check">✔</i> <strong>Top đầu google</strong> về từ khóa: cho
                thuê phòng trọ, thuê phòng trọ, phòng trọ hồ chí minh, phòng trọ hà
                nội, thuê nhà nguyên căn, cho thuê căn hộ, tìm người ở ghép…với lưu
                lượng truy cập (traffic) cao nhất trong lĩnh vực.
            </p>
            <p>
                <i class="check">✔</i> <strong>Top đầu google</strong> về từ khóa: cho
                thuê phòng trọ, thuê phòng trọ, phòng trọ hồ chí minh, phòng trọ hà
                nội, thuê nhà nguyên căn, cho thuê căn hộ, tìm người ở ghép…với lưu
                lượng truy cập (traffic) cao nhất trong lĩnh vực.
            </p>
        </div>
    </div>
    <div style="text-align: center; margin-bottom: 20px">
        <h3>Bảng giá dịch vụ<br/></h3>
        Áp dụng từ ngày 31/11/2024
    </div>
    <div class="section-content">
        <table
            class="table table-striped-columns table" Giá tuần (7 ngày)
            style="width: 80%; margin-left: 150px">
            <thead>
            <tr>
                <th style="background: #fff; border: 0"></th>
                <th
                    class="package_vip1"
                    style="
                background-color: #e13427;
                color: #fff;
                vertical-align: middle;
              "
                >
                    Tin VIP nổi bật<span class="star star-5"></span>
                </th>
                <th
                    class="package_vip2"
                    style="
                background-color: #ea2e9d;
                color: #fff;
                vertical-align: middle;
              "
                >
                    Tin VIP 1<span class="star star-4"></span>
                </th>
                <th
                    class="package_vip3"
                    style="
                background-color: #ff6600;
                color: #fff;
                vertical-align: middle;
              "
                >
                    Tin VIP 2<span class="star star-3"></span>
                </th>
                <th
                    class="package_vip4"
                    style="
                background-color: #007bff;
                color: #fff;
                vertical-align: middle;
              "
                >
                    Tin VIP 3<span class="star star-2"></span>
                </th>
                <th
                    class="package_tinthuong"
                    style="
                background-color: #055699;
                color: #fff;
                vertical-align: middle;
              "
                >
                    Tin thường
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="nowrap"><strong>Giá ngày</strong></td>
                <td>
              <span class="price-day">50.000đ</span
              ><span style="display: block; font-size: 0.8rem"
                    >(Tối thiểu 3 ngày)</span
                    >
                </td>
                <td>
              <span class="price-day">30.000đ</span
              ><span style="display: block; font-size: 0.8rem"
                    >(Tối thiểu 3 ngày)</span
                    >
                </td>
                <td>
              <span class="price-day">20.000đ</span
              ><span style="display: block; font-size: 0.8rem"
                    >(Tối thiểu 3 ngày)</span
                    >
                </td>
                <td>
              <span class="price-day">10.000đ</span
              ><span style="display: block; font-size: 0.8rem"
                    >(Tối thiểu 3 ngày)</span
                    >
                </td>
                <td>
              <span class="price-day">2.000đ</span
              ><span style="display: block; font-size: 0.8rem"
                    >(Tối thiểu 5 ngày)</span
                    >
                </td>
            </tr>
{{--            <tr>--}}
{{--                <td class="nowrap">--}}
{{--                    <strong>Giá tháng (30 ngày)</strong--}}
{{--                    ><span style="display: block; font-size: 0.8rem; color: #4caf50"--}}
{{--                    >Rẻ hơn 10% so với giá ngày</span--}}
{{--                    >--}}
{{--                </td>--}}
{{--                <td>--}}
{{--              <span--}}
{{--                  style="--}}
{{--                  display: block;--}}
{{--                  text-decoration: line-through;--}}
{{--                  color: red;--}}
{{--                "--}}
{{--              >1.500.000đ</span--}}
{{--              ><span style="display: block; color: #4caf50"--}}
{{--                    >Giảm 20% chỉ còn</span--}}
{{--                    ><span class="price-month">1.200.000đ</span>--}}
{{--                </td>--}}
{{--                <td>--}}
{{--              <span--}}
{{--                  style="--}}
{{--                  display: block;--}}
{{--                  text-decoration: line-through;--}}
{{--                  color: red;--}}
{{--                "--}}
{{--              >900.000đ</span--}}
{{--              ><span style="display: block; color: #4caf50"--}}
{{--                    >Giảm 11% chỉ còn</span--}}
{{--                    ><span class="price-month">800.000đ</span>--}}
{{--                </td>--}}
{{--                <td>--}}
{{--              <span--}}
{{--                  style="--}}
{{--                  display: block;--}}
{{--                  text-decoration: line-through;--}}
{{--                  color: red;--}}
{{--                "--}}
{{--              >600.000đ</span--}}
{{--              ><span style="display: block; color: #4caf50"--}}
{{--                    >Giảm 10% chỉ còn</span--}}
{{--                    ><span class="price-month">540.000đ</span>--}}
{{--                </td>--}}
{{--                <td>--}}
{{--              <span--}}
{{--                  style="--}}
{{--                  display: block;--}}
{{--                  text-decoration: line-through;--}}
{{--                  color: red;--}}
{{--                "--}}
{{--              >300.000đ</span--}}
{{--              ><span style="display: block; color: #4caf50"--}}
{{--                    >Giảm 20% chỉ còn</span--}}
{{--                    ><span class="price-month">240.000đ</span>--}}
{{--                </td>--}}
{{--                <td>--}}
{{--              <span--}}
{{--                  style="--}}
{{--                  display: block;--}}
{{--                  text-decoration: line-through;--}}
{{--                  color: red;--}}
{{--                "--}}
{{--              >60.000đ</span--}}
{{--              ><span style="display: block; color: #4caf50"--}}
{{--                    >Giảm 20% chỉ còn</span--}}
{{--                    ><span class="price-month">48.000đ</span>--}}
{{--                </td>--}}
{{--            </tr>--}}
            <tr>
                <td class="nowrap"><strong>Giá đẩy tin</strong></td>
                <td>5.000đ</td>
                <td>3.000đ</td>
                <td>2.000đ</td>
                <td>2.000đ</td>
                <td>2.000đ</td>
            </tr>
            <tr>
                <td class="nowrap" style="vertical-align: middle">
                    <strong>Màu sắc tiêu đề</strong>
                </td>
                <td>
                    <p>
                <span style="color: #e13427; font-weight: bold"
                >TIÊU ĐỀ MÀU ĐỎ, IN HOA</span
                >
                    </p>
                </td>
                <td>
                    <p>
                <span style="color: #ea2e9d; font-weight: bold"
                >TIÊU ĐỀ MÀU HỒNG, IN HOA</span
                >
                    </p>
                </td>
                <td>
                    <p>
                <span style="color: #ff6600; font-weight: bold"
                >TIÊU ĐỀ MÀU CAM, IN HOA</span
                >
                    </p>
                </td>
                <td>
                    <p>
                <span style="color: #007bff; font-weight: bold"
                >TIÊU ĐỀ MÀU XANH, IN HOA</span
                >
                    </p>
                </td>
                <td>
                    <p>
                <span style="color: #055699; font-weight: bold"
                >Tiêu đề màu mặc định, viết thường</span
                >
                    </p>
                </td>
            </tr>
            <tr>
                <td class="nowrap" style="vertical-align: middle">
                    <strong>Tự động duyệt</strong>
                </td>
                <td>
                    <i class="material-icons" style="font-size: 36px; color: green"
                    >check</i
                    >
                </td>
                <td>
                    <i class="material-icons" style="font-size: 36px; color: green"
                    >check</i
                    >
                </td>
                <td>
                    <i class="material-icons" style="font-size: 36px; color: green"
                    >check</i
                    >
                </td>
                <td>
                    <i class="material-icons" style="font-size: 36px; color: green"
                    >check</i
                    >
                </td>
                <td>
                    <i class="material-icons" style="font-size: 36px; color: red"
                    >close</i
                    >
                </td>
            </tr>
            <tr>
                <td class="nowrap" style="vertical-align: middle">
                    <strong>Hiển thị số điện thoại ở trang danh sách</strong>
                </td>
                <td>
                    <i class="material-icons" style="font-size: 36px; color: green"
                    >check</i
                    >
                </td>
                <td>
                    <i class="material-icons" style="font-size: 36px; color: red"
                    >close</i
                    >
                </td>
                <td>
                    <i class="material-icons" style="font-size: 36px; color: red"
                    >close</i
                    >
                </td>
                <td>
                    <i class="material-icons" style="font-size: 36px; color: red"
                    >close</i
                    >
                </td>
                <td>
                    <i class="material-icons" style="font-size: 36px; color: red"
                    >close</i
                    >
                </td>
            </tr>
            <tr>
                <td class="nowrap" style="vertical-align: middle">
                    <strong>Huy hiệu nổi bật</strong>
                </td>
                <td>
                    <i class="material-icons" style="font-size: 36px; color: green"
                    >check</i
                    >
                </td>
                <td>
                    <i class="material-icons" style="font-size: 36px; color: red"
                    >close</i
                    >
                </td>
                <td>
                    <i class="material-icons" style="font-size: 36px; color: green"
                    >check</i
                    >
                </td>
                <td>
                    <i class="material-icons" style="font-size: 36px; color: red"
                    >close</i
                    >
                </td>
                <td>
                    <i class="material-icons" style="font-size: 36px; color: green"
                    >check</i
                    >
                </td>
            </tr>
            <tr>
                <td style="background: #fff; border-bottom: 0"></td>
                <td style="background: #fff; border-bottom: 0">
                    <button
                        class="btn btn-primary btn-block js-jump-to"
                        data-jumpto="demo-vip-noibat"
                    >
                        Xem demo
                    </button>
                </td>
                <td style="background: #fff; border-bottom: 0">
                    <button
                        class="btn btn-primary btn-block js-jump-to"
                        data-jumpto="demo-vip-1"
                    >
                        Xem demo
                    </button>
                </td>
                <td style="background: #fff; border-bottom: 0">
                    <button
                        class="btn btn-primary btn-block js-jump-to"
                        data-jumpto="demo-vip-2"
                    >
                        Xem demo
                    </button>
                </td>
                <td style="background: #fff; border-bottom: 0">
                    <button
                        class="btn btn-primary btn-block js-jump-to"
                        data-jumpto="demo-vip-3"
                    >
                        Xem demo
                    </button>
                </td>
                <td style="background: #fff; border-bottom: 0">
                    <button
                        class="btn btn-primary btn-block js-jump-to"
                        data-jumpto="demo-tinthuong"
                    >
                        Xem demo
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <h3 style="text-align: center; margin: 50px">Hình ảnh minh họa</h3>
    <div class="tongmota">
        <div class="mota">
            <strong>Tin VIP nổi bật</strong><br/>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>

            <span class="fa fa-star checked"></span>

            <span class="fa fa-star checked"></span>

            <span class="fa fa-star checked"></span>
            <br/>
            <p>
          <span style="font-weight: bold; color: #e13427"
          >TIÊU ĐỀ IN HOA MÀU ĐỎ</span
          >,gắn biểu tượng 5 ngôi sao màu vàng và hiển thị to và nhiều hình hơn
                các tin khác. Nằm trên tất cả các tin khác, được hưởng nhiều ưu tiên
                và hiệu quả giao dịch cao nhất.
            </p>
            <br/>
            <p>
                Đồng thời xuất hiện đầu tiên ở mục tin nổi bật xuyên suốt khu vực
                chuyên mục đó
            </p>
            <img src="{{asset('uploads/fe/img/demo-vipnoibat.jpg')}}" alt="vipnoibat"/>
            <img src="{{asset('uploads/fe/img/demo-vipnoibat2.jpg')}}" alt="vipnoibat2"/>
        </div>
    </div>
    <div class="tongmota">
        <div class="mota">
            <strong>Tin VIP 1</strong><br/>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>

            <span class="fa fa-star checked"></span>

            <span class="fa fa-star checked"></span>

            <br/>
            <p>
          <span style="font-weight: bold; color: rgb(247, 145, 162)"
          >TIÊU ĐỀ IN HOA MÀU HỒNG</span
          >,gắn biểu tượng 5 ngôi sao màu vàng và hiển thị to và nhiều hình hơn
                các tin khác. Nằm trên tất cả các tin khác, được hưởng nhiều ưu tiên
                và hiệu quả giao dịch cao nhất.
            </p>
            <br/>
            <p>
                Đồng thời xuất hiện đầu tiên ở mục tin nổi bật xuyên suốt khu vực
                chuyên mục đó
            </p>
            <img src="{{asset('uploads/fe/img/demo-vipnoibat.jpg')}}" alt="vipnoibat"/>
        </div>
    </div>
    <div class="tongmota">
        <div class="mota">
            <strong>Tin VIP 2</strong><br/>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>

            <span class="fa fa-star checked"></span>

            <br/>
            <p>
          <span style="font-weight: bold; color: orange"
          >TIÊU ĐỀ IN HOA MÀU CAM</span
          >,gắn biểu tượng 5 ngôi sao màu vàng và hiển thị to và nhiều hình hơn
                các tin khác. Nằm trên tất cả các tin khác, được hưởng nhiều ưu tiên
                và hiệu quả giao dịch cao nhất.
            </p>
            <br/>
            <p>
                Đồng thời xuất hiện đầu tiên ở mục tin nổi bật xuyên suốt khu vực
                chuyên mục đó
            </p>
            <img src="{{asset('uploads/fe/img/demo-vipnoibat.jpg')}}" alt="vipnoibat"/>
        </div>
    </div>
    <div class="tongmota">
        <div class="mota">
            <strong>Tin VIP 3</strong><br/>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>

            <span class="fa fa-star checked"></span>

            <br/>
            <p>
          <span style="font-weight: bold; color: rgb(4, 90, 160)"
          >TIÊU ĐỀ IN HOA MÀU XANH</span
          >,gắn biểu tượng 5 ngôi sao màu vàng và hiển thị to và nhiều hình hơn
                các tin khác. Nằm trên tất cả các tin khác, được hưởng nhiều ưu tiên
                và hiệu quả giao dịch cao nhất.
            </p>
            <br/>
            <p>
                Đồng thời xuất hiện đầu tiên ở mục tin nổi bật xuyên suốt khu vực
                chuyên mục đó
            </p>
            <img src="{{asset('uploads/fe/img/demo-vipnoibat.jpg')}}" alt="vipnoibat"/>
        </div>
    </div>
    <div class="tongmota">
        <div class="mota" style="margin-bottom: 50px">
            <strong>Tin thường</strong><br/>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>

            <span class="fa fa-star checked"></span>

            <br/>
            <p>
          <span style="color: #5b7ef1">Tiêu đề màu mặc định, viết thường.</span
          >,gắn biểu tượng 5 ngôi sao màu vàng và hiển thị to và nhiều hình hơn
                các tin khác. Nằm trên tất cả các tin khác, được hưởng nhiều ưu tiên
                và hiệu quả giao dịch cao nhất.
            </p>
            <br/>
            <p>
                Đồng thời xuất hiện đầu tiên ở mục tin nổi bật xuyên suốt khu vực
                chuyên mục đó
            </p>
            <img src="{{asset('uploads/fe/demo-vipnoibat.jpg')}}" alt="vipnoibat"/>
        </div>
    </div>
    <div style="text-align: center">
        <h3>Khách hàng nói về chúng tôi</h3>
        <p>
            Sự hài lòng của khách hàng là động lực phát triển của CodeCrib.com
        </p>
    </div>
    <div class="cha">
        <div class="tongdg">
            <div class="danhgia">
                <div class="info">
                    <img src="{{asset('uploads/fe/img/default-user.png')}}" alt="imguser"/>
                    <aside>
                        <span style="font-weight: bold">Cô Minh Thu</span><br/>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                    </aside>
                </div>
                <p>
                    Nhà tôi đang sống đã xây dựng cách đây 7 năm, phục vụ phần lớn cho
                    nhu cầu của các con trai tôi. Tuy nhiên, giờ chúng đã làm việc định
                    cư ở xa nên không còn sống chung. Thấy nhà còn trống tận 4 phòng lớn
                    nên hồi tháng 11 năm ngoái, vợ chồng chúng tôi quyết định cho thuê
                    để nhà được vui vẻ hơn. Ông nhà tôi được bạn bè giới thiệu nên cũng
                    thử đăng tin lên website CodeCrib.com, đâu tầm 2 ngày thì đã có 3
                    cháu sinh viên đến hỏi thăm và dọn vào ở. Sau đó 3 ngày thì một
                    chàng thanh niên đang đi làm tại Bình Thạnh cũng lại thuê nốt căn
                    cuối. Vợ chồng tôi cũng vui mừng vì chưa đầy 1 tuần mà đã cho thuê
                    xong toàn bộ phòng trong nhà. Nói không phải khen, chứ bạn bè tôi
                    đăng căn nào lên đây cũng tìm được khách tốt tới thuê.
                </p>
            </div>
            <div class="danhgia">
                <div class="info">
                    <img src="{{asset('uploads/fe/img/default-user.png')}}" alt="imguser"/>
                    <aside>
                        <span style="font-weight: bold">Cô Minh Thu</span><br/>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                    </aside>
                </div>
                <p>
                    Nhà tôi đang sống đã xây dựng cách đây 7 năm, phục vụ phần lớn cho
                    nhu cầu của các con trai tôi. Tuy nhiên, giờ chúng đã làm việc định
                    cư ở xa nên không còn sống chung. Thấy nhà còn trống tận 4 phòng lớn
                    nên hồi tháng 11 năm ngoái, vợ chồng chúng tôi quyết định cho thuê
                    để nhà được vui vẻ hơn. Ông nhà tôi được bạn bè giới thiệu nên cũng
                    thử đăng tin lên website CodeCrib.com, đâu tầm 2 ngày thì đã có 3
                    cháu sinh viên đến hỏi thăm và dọn vào ở. Sau đó 3 ngày thì một
                    chàng thanh niên đang đi làm tại Bình Thạnh cũng lại thuê nốt căn
                    cuối. Vợ chồng tôi cũng vui mừng vì chưa đầy 1 tuần mà đã cho thuê
                    xong toàn bộ phòng trong nhà. Nói không phải khen, chứ bạn bè tôi
                    đăng căn nào lên đây cũng tìm được khách tốt tới thuê.
                </p>
            </div>
            <div class="danhgia">
                <div class="info">
                    <img src="{{asset('uploads/fe/img/default-user.png')}}" alt="imguser"/>
                    <aside>
                        <span style="font-weight: bold">Cô Minh Thu</span><br/>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                    </aside>
                </div>
                <p>
                    Nhà tôi đang sống đã xây dựng cách đây 7 năm, phục vụ phần lớn cho
                    nhu cầu của các con trai tôi. Tuy nhiên, giờ chúng đã làm việc định
                    cư ở xa nên không còn sống chung. Thấy nhà còn trống tận 4 phòng lớn
                    nên hồi tháng 11 năm ngoái, vợ chồng chúng tôi quyết định cho thuê
                    để nhà được vui vẻ hơn. Ông nhà tôi được bạn bè giới thiệu nên cũng
                    thử đăng tin lên website CodeCrib.com, đâu tầm 2 ngày thì đã có 3
                    cháu sinh viên đến hỏi thăm và dọn vào ở. Sau đó 3 ngày thì một
                    chàng thanh niên đang đi làm tại Bình Thạnh cũng lại thuê nốt căn
                    cuối. Vợ chồng tôi cũng vui mừng vì chưa đầy 1 tuần mà đã cho thuê
                    xong toàn bộ phòng trong nhà. Nói không phải khen, chứ bạn bè tôi
                    đăng căn nào lên đây cũng tìm được khách tốt tới thuê.
                </p>
            </div>
            <div class="danhgia">
                <div class="info">
                    <img src="{{asset('uploads/fe/img/default-user.png')}}" alt="imguser"/>
                    <aside>
                        <span style="font-weight: bold">Cô Minh Thu</span><br/>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                    </aside>
                </div>
                <p>
                    Nhà tôi đang sống đã xây dựng cách đây 7 năm, phục vụ phần lớn cho
                    nhu cầu của các con trai tôi. Tuy nhiên, giờ chúng đã làm việc định
                    cư ở xa nên không còn sống chung. Thấy nhà còn trống tận 4 phòng lớn
                    nên hồi tháng 11 năm ngoái, vợ chồng chúng tôi quyết định cho thuê
                    để nhà được vui vẻ hơn. Ông nhà tôi được bạn bè giới thiệu nên cũng
                    thử đăng tin lên website CodeCrib.com, đâu tầm 2 ngày thì đã có 3
                    cháu sinh viên đến hỏi thăm và dọn vào ở. Sau đó 3 ngày thì một
                    chàng thanh niên đang đi làm tại Bình Thạnh cũng lại thuê nốt căn
                    cuối. Vợ chồng tôi cũng vui mừng vì chưa đầy 1 tuần mà đã cho thuê
                    xong toàn bộ phòng trong nhà. Nói không phải khen, chứ bạn bè tôi
                    đăng căn nào lên đây cũng tìm được khách tốt tới thuê.
                </p>
            </div>
            <div class="danhgia">
                <div class="info">
                    <img src="{{asset('uploads/fe/img/default-user.png')}}" alt="imguser"/>
                    <aside>
                        <span style="font-weight: bold">Cô Minh Thu</span><br/>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                    </aside>
                </div>
                <p>
                    Nhà tôi đang sống đã xây dựng cách đây 7 năm, phục vụ phần lớn cho
                    nhu cầu của các con trai tôi. Tuy nhiên, giờ chúng đã làm việc định
                    cư ở xa nên không còn sống chung. Thấy nhà còn trống tận 4 phòng lớn
                    nên hồi tháng 11 năm ngoái, vợ chồng chúng tôi quyết định cho thuê
                    để nhà được vui vẻ hơn. Ông nhà tôi được bạn bè giới thiệu nên cũng
                    thử đăng tin lên website CodeCrib.com, đâu tầm 2 ngày thì đã có 3
                    cháu sinh viên đến hỏi thăm và dọn vào ở. Sau đó 3 ngày thì một
                    chàng thanh niên đang đi làm tại Bình Thạnh cũng lại thuê nốt căn
                    cuối. Vợ chồng tôi cũng vui mừng vì chưa đầy 1 tuần mà đã cho thuê
                    xong toàn bộ phòng trong nhà. Nói không phải khen, chứ bạn bè tôi
                    đăng căn nào lên đây cũng tìm được khách tốt tới thuê.
                </p>
            </div>
            <div class="danhgia">
                <div class="info">
                    <img src="{{asset('uploads/fe/img/default-user.png')}}" alt="imguser"/>
                    <aside>
                        <span style="font-weight: bold">Cô Minh Thu</span><br/>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                    </aside>
                </div>
                <p>
                    Nhà tôi đang sống đã xây dựng cách đây 7 năm, phục vụ phần lớn cho
                    nhu cầu của các con trai tôi. Tuy nhiên, giờ chúng đã làm việc định
                    cư ở xa nên không còn sống chung. Thấy nhà còn trống tận 4 phòng lớn
                    nên hồi tháng 11 năm ngoái, vợ chồng chúng tôi quyết định cho thuê
                    để nhà được vui vẻ hơn. Ông nhà tôi được bạn bè giới thiệu nên cũng
                    thử đăng tin lên website CodeCrib.com, đâu tầm 2 ngày thì đã có 3
                    cháu sinh viên đến hỏi thăm và dọn vào ở. Sau đó 3 ngày thì một
                    chàng thanh niên đang đi làm tại Bình Thạnh cũng lại thuê nốt căn
                    cuối. Vợ chồng tôi cũng vui mừng vì chưa đầy 1 tuần mà đã cho thuê
                    xong toàn bộ phòng trong nhà. Nói không phải khen, chứ bạn bè tôi
                    đăng căn nào lên đây cũng tìm được khách tốt tới thuê.
                </p>
            </div>
        </div>
    </div>
    <h3 style="text-align: center; padding: 30px">
        <strong>Phương thức thanh toán</strong>
    </h3>
    <div class="tongtt">
        <div class="method">
            <div class="bank">
                <div class="img" style="margin-left: 10px">
                    <img src="{{asset('uploads/fe/img/bank-transfer.png')}}" alt="bank-transfer"/>
                </div>
                <strong>Chuyển khoản</strong>
            </div>
        </div>

        <div class="method">
            <div class="bank">
                <div class="img">
                    <img src="{{asset('uploads/fe/img/cash.svg')}}" alt="bank-transfer"/>
                </div>
                <strong>Tiền mặt</strong>
            </div>
        </div>

        <div class="method">
            <div class="bank">
                <div class="img">
                    <img src="{{asset('uploads/fe/img/momo.png')}}" alt="bank-transfer"/>
                </div>
                <strong>MOMO</strong>
            </div>
        </div>

        <div class="method">
            <div class="bank">
                <div class="img">
                    <img src="{{asset('uploads/fe/img/zalopay.png')}}" alt="bank-transfer"/>
                </div>
                <strong>ZaloPay</strong>
            </div>
        </div>

        <div class="method">
            <div class="bank">
                <div class="img">
                    <img src="{{asset('uploads/fe/img/qr-code.png')}}" alt="bank-transfer"/>
                </div>
                <strong>Qr code</strong>
            </div>
        </div>

        <div class="method">
            <div class="bank">
                <div class="img">
                    <img src="{{asset('uploads/fe/img/payment-method.svg')}}" alt="bank-transfer"/>
                </div>
                <strong>Thẻ ATM</strong>
            </div>
        </div>

        <div class="method">
            <div class="bank">
                <div class="img" style="margin-left: 20px">
                    <img src="{{asset('uploads/fe/img/online-store.svg')}}" alt="bank-transfer"/>
                </div>
                <div><strong>Điểm giao dịch</strong></div>
            </div>
        </div>

        <div class="method">
            <div class="bank">
                <div class="img">
                    <img src="{{asset('uploads/fe/img/credit-card.png')}}" alt="bank-transfer"/>
                </div>
                <div><strong>Thẻ tín dụng quốc tế</strong></div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-top">
                <div class="footer-column">
                    <h4>Thông tin</h4>
                    <ul>
                        <li><a href="#">Giới thiệu</a></li>
                        <li><a href="#">Liên hệ</a></li>
                        <li><a href="#">Chính sách bảo mật</a></li>
                        <li><a href="#">Điều khoản sử dụng</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4>Dịch vụ</h4>
                    <ul>
                        <li><a href="#">Cho thuê phòng trọ</a></li>
                        <li><a href="#">Cho thuê nhà nguyên căn</a></li>
                        <li><a href="#">Cho thuê căn hộ</a></li>
                        <li><a href="#">Cho thuê mặt bằng</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4>Kết nối với chúng tôi</h4>
                    <ul class="social-icons">
                        <li>
                            <a href="#">
                                <div class="imgfb"></div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="imgyt"></div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="imgzl"></div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="imgtw"></div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 CodeCrib. Tất cả quyền được bảo lưu.</p>
            </div>
        </div>
    </footer>

@endsection
