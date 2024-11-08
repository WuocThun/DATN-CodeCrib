<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Phongtro123 Clone</title>
    <link rel="stylesheet" href="{{asset('style/css/fe.css')}}" />
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
  </head>
  <body>
    <!-- Header -->
    <header>
      <div class="container header-container">
        <div class="logo">
          <img
            src="https://phongtro123.com/images/logo.png"
            alt="Phongtro123 Logo"
          />
        </div>
        <nav class="main-nav">
          <ul>
            <li><a href="index.html">Trang chủ</a></li>
            <li><a href="page1.html">Cho thuê phòng trọ</a></li>
            <li><a href="page2.html">Cho thuê căn hộ</a></li>
            <li><a href="page3.html">Tìm người ở ghép</a></li>
            <li><a href="tintuc.html">Tin tức</a></li>
            <li><a href="dichvu.html">Dịch vụ</a></li>
          </ul>
        </nav>
        <div class="user-options">
          <button class="btn">Yêu thích</button>
          <a href="login.html" style="text-decoration: none"
            ><button class="btn">Đăng nhập</button></a
          >
          <button class="btn highlight">Đăng tin miễn phí</button>
        </div>
      </div>
    </header>

    <!-- Search Results -->
    <section class="search-results">
      <div class="container search-results-container">
        <div class="results-left">
          <div class="item-detail">
            <!-- Carousel -->
            <div id="demo" class="carousel slide" data-bs-ride="carousel">
              <!-- Indicators/dots -->
              <div class="carousel-indicators">
                <button
                  type="button"
                  data-bs-target="#demo"
                  data-bs-slide-to="0"
                  class="active"
                ></button>
                <button
                  type="button"
                  data-bs-target="#demo"
                  data-bs-slide-to="1"
                ></button>
                <button
                  type="button"
                  data-bs-target="#demo"
                  data-bs-slide-to="2"
                ></button>
              </div>

              <!-- The slideshow/carousel -->
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img
                    src="{{asset('uploads/fe/fe.jpg')}}"
                    alt="Los Angeles"
                    class="d-block h-100"
                    style="width: 100%"
                  />
                </div>
                <div class="carousel-item">
                  <img
                    src="{{asset('uploads/fe/fe.jpg')}}"
                    alt="Chicago"
                    class="d-block h-100"
                    style="width: 100%"
                  />
                </div>
                <div class="carousel-item">
                  <img
                    src="{{asset('uploads/fe/fe.jpg')}}"
                    alt="New York"
                    class="d-block h-100"
                    style="width: 100%"
                  />
                </div>
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

            <b style="font-size: 20px; color: red">
              Cho thuê phòng trọ mới sửa 7/2023 Đường Lương Thế Vinh, Phường Tân
              Thới Hòa, Quận Tân Phú (gần Đầm Sen).
            </b>

            <div class="address">
              <div class="iconaddress"></div>
              <span style="margin-left: 10px"
                >Địa chỉ: Đường số 61, Phường Thạnh Mỹ Lợi, Quận 2, Hồ Chí
                Minh</span
              >
            </div>

            <div class="attributes">
              <div class="iconprice"></div>
              <span
                style="
                  color: #16c784;
                  font-weight: bold;
                  font-size: 18px;
                  margin-left: 10px;
                "
                >6.2 triệu/tháng</span
              >
              <div class="iconacreage"></div>
              <span style="margin-left: 10px">35m <sup>2</sup></span>
              <div class="iconclock"></div>
              <span style="margin-left: 10px">2 ngày trước</span>
              <div class="iconhastag"></div>
              <span style="margin-left: 10px">81204</span>
            </div>
            <h3 style="margin-top: 20px">Thông tin mô tả</h3>
            <div>
              <p>
                Mình cần cho thuê phòng mới diện tích 32m2, giá 6tr/tháng có sẵn
                nội thất cơ bản
              </p>
              <p>
                Địa chỉ: 17 Đường số 61, Phường Thạnh Mỹ Lợi, Quận 2, Hồ Chí
                Minh
              </p>
              <p>- Giá cho thuê: 6tr/tháng</p>
              <p>
                - Full nội thất: Giường, Tủ, máy lạnh, máy giặt, tủ lạnh, máy
                giặt, máy nc nóng...
              </p>
              <p>- Có chỗ nấu ăn</p>
              <p>- Có hầm để xe miễn phí</p>
              <p>- Có thang máy.</p>
              <p>- View công viên.</p>
              <p>- Điện: 4k/kg, nước 20k/khối</p>
              <p>- Internet free siêu mạnh.</p>
            </div>
            <table class="table table table-striped">
              <tbody>
                <tr>
                  <td class="name">Mã tin:</td>
                  <td>#315940</td>
                </tr>
                <tr>
                  <td class="name">Chuyên mục:</td>
                  <td>
                    <a
                      style="text-decoration: underline"
                      title="Phòng trọ Quận 2"
                      href="page2.html"
                      ><strong>Cho thuê phòng trọ Quận 2</strong></a
                    >
                  </td>
                </tr>
                <tr>
                  <td class="name">Khu vực</td>
                  <td>Cho thuê phòng trọ Hồ Chí Minh</td>
                </tr>
                <tr>
                  <td class="name">Loại tin rao:</td>
                  <td>Phòng trọ, nhà trọ</td>
                </tr>
                <tr>
                  <td class="name">Đối tượng thuê:</td>
                  <td>Tất cả</td>
                </tr>
                <tr>
                  <td class="name">Gói tin:</td>
                  <td><span style="color: #e13427">Tin VIP nổi bật</span></td>
                </tr>
                <tr>
                  <td class="name">Ngày đăng:</td>
                  <td>
                    <time title="Thứ 6, 15:33 04/10/2024"
                      >Thứ 6, 15:33 04/10/2024</time
                    >
                  </td>
                </tr>
                <tr>
                  <td class="name">Ngày hết hạn:</td>
                  <td>
                    <time title="Thứ 4, 13:41 09/10/2024"
                      >Thứ 4, 13:41 09/10/2024</time
                    >
                  </td>
                </tr>
              </tbody>
            </table>
            <h3>Thông tin liên hệ</h3>
            <table class="table table table-striped">
              <tr>
                <td class="name">Liên hệ:</td>
                <td>Khánh</td>
              </tr>
              <tr>
                <td class="name">Điện thoại:</td>
                <td>0989997054</td>
              </tr>
              <tr>
                <td class="name">Zalo</td>
                <td>0989997054</td>
              </tr>
            </table>

            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3840.5882074426004!2d108.31325527459327!3d15.71999244869371!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3169e2160c12e89b%3A0x118aa715886e6b5c!2zSOG7kyBDaMOtIE1pbmgsIFF14bqjbmcgTmFtLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1728227921569!5m2!1svi!2s"
              width="850"
              height="450"
              style="border: 0"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
            <p>
              Bạn đang xem nội dung tin đăng: "Cho thuê phòng mới diện tích
              35m2, giá 6tr/tháng full nội thất - Mã tin: 315940". Mọi thông tin
              liên quan đến tin đăng này chỉ mang tính chất tham khảo. Nếu bạn
              có phản hồi với tin đăng này (báo xấu, tin đã cho thuê, không liên
              lạc được,...), vui lòng thông báo để PhòngTrọ123 có thể xử lý.
            </p>
          </div>

          <div class="pagination">
            <button class="prev">« Trang trước</button>
            <button class="active">1</button>
            <button>2</button>
            <button>3</button>
            <button>4</button>
            <button>5</button>
            <button class="next">» Trang sau »</button>
          </div>
        </div>

        <div class="results-right1">
          <div class="filter-section">
            <h3>Danh mục cho thuê</h3>
            <ul>
              <li>Cho thuê phòng trọ (77,318)</li>
              <li>Cho thuê nhà nguyên căn (11,863)</li>
              <li>Cho thuê căn hộ (13,604)</li>
              <li>Cho thuê căn hộ mini (3,048)</li>
              <li>Cho thuê căn hộ dịch vụ (7,810)</li>
              <li>Cho thuê mặt bằng (2,390)</li>
              <li>Tìm người ở ghép (15,847)</li>
            </ul>
          </div>
          <div class="filter-section">
            <h3>Xem theo giá</h3>
            <ul>
              <li>Dưới 1 triệu</li>
              <li>Từ 1 - 2 triệu</li>
              <li>Từ 2 - 3 triệu</li>
              <li>Từ 3 - 5 triệu</li>
              <li>Từ 5 - 7 triệu</li>
              <li>Từ 7 - 10 triệu</li>
              <li>Từ 10 - 15 triệu</li>
              <li>Trên 15 triệu</li>
            </ul>
          </div>

          <div class="filter-section">
            <h3>Xem theo diện tích</h3>
            <ul>
              <li>Dưới 20m²</li>
              <li>Từ 20 - 30m²</li>
              <li>Từ 30 - 50m²</li>
              <li>Từ 50 - 70m²</li>
              <li>Từ 70 - 90m²</li>
              <li>Trên 90m²</li>
            </ul>
          </div>
          <div class="newstr">
            <h3>Tin đăng mới</h3>
            <ul>
              <li>
                <a href="#">
                  <img src="{{asset('uploads/fe/fe.jpg')}}" alt="Phòng trọ mới" />
                  <div>
                    <span class="post-meta">Phòng trọ tiện nghi Q1</span>
                    <span class="post-price">2.5 triệu/tháng</span>
                    <span class="post-time">Đăng 2 giờ trước</span>
                  </div>
                </a>
              </li>
              <li>
                <a href="#">
                  <img src="{{asset('uploads/fe/fe.jpg')}}" alt="Phòng trọ mới" />
                  <div>
                    <span class="post-meta">Phòng trọ tiện nghi Q1</span>
                    <span class="post-price">2.5 triệu/tháng</span>
                    <span class="post-time">Đăng 2 giờ trước</span>
                  </div>
                </a>
              </li>
              <li>
                <a href="#">
                  <img src="{{asset('uploads/fe/fe.jpg')}}" alt="Phòng trọ mới" />
                  <div>
                    <span class="post-meta">Phòng trọ tiện nghi Q1</span>
                    <span class="post-price">2.5 triệu/tháng</span>
                    <span class="post-time">Đăng 2 giờ trước</span>
                  </div>
                </a>
              </li>
              <li>
                <a href="#">
                  <img src="{{asset('uploads/fe/fe.jpg')}}" alt="Phòng trọ mới" />
                  <div>
                    <span class="post-meta">Phòng trọ tiện nghi Q1</span>
                    <span class="post-price">2.5 triệu/tháng</span>
                    <span class="post-time">Đăng 2 giờ trước</span>
                  </div>
                </a>
              </li>
              <li>
                <a href="#">
                  <img src="{{asset('uploads/fe/fe.jpg')}}" alt="Phòng trọ mới" />
                  <div>
                    <span class="post-meta">Phòng trọ tiện nghi Q1</span>
                    <span class="post-price">2.5 triệu/tháng</span>
                    <span class="post-time">Đăng 2 giờ trước</span>
                  </div>
                </a>
              </li>
              <li>
                <a href="#">
                  <img src="{{asset('uploads/fe/fe.jpg')}}" alt="Phòng trọ mới" />
                  <div>
                    <span class="post-meta">Phòng trọ gần Đại học Kinh Tế</span>
                    <span class="post-price">3.0 triệu/tháng</span>
                    <span class="post-time">Đăng 5 giờ trước</span>
                  </div>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <!-- Statistics and Testimonials Section -->
    <section class="stats-testimonials">
      <div class="container stats-container">
        <h2>Tại sao lại chọn PhongTro123.com?</h2>
        <p>
          Chúng tôi biết bạn có rất nhiều lựa chọn, nhưng PhongTro123.com tự hào
          là trang web đứng top google về các từ khóa: cho thuê phòng trọ, nhà
          trọ, thuê nhà nguyên căn, cho thuê căn hộ, tìm người ở ghép, cho thuê
          mặt bằng... Vì vậy tin của bạn đăng trên website sẽ tiếp cận được với
          nhiều khách hàng hơn, do đó giao dịch nhanh hơn, tiết kiệm chi phí
          hơn.
        </p>

        <div class="stats">
          <div class="stat-item">
            <h3>116.998+</h3>
            <p>Thành viên</p>
          </div>
          <div class="stat-item">
            <h3>103.348+</h3>
            <p>Tin đăng</p>
          </div>
          <div class="stat-item">
            <h3>300.000+</h3>
            <p>Lượt truy cập/tháng</p>
          </div>
          <div class="stat-item">
            <h3>2.500.000+</h3>
            <p>Lượt xem/tháng</p>
          </div>
        </div>
      </div>

      <!-- Testimonials -->
      <div class="container testimonials-container">
        <h2>Chi phí thấp, hiệu quả tối đa</h2>
        <div class="testimonial">
          <p>
            "Trước khi biết website phongtro123, mình phải tốn nhiều công sức và
            chi phí cho việc đăng tin cho thuê: từ việc phát tờ rơi, dán giấy,
            và đăng lên các website khác nhưng hiệu quả không cao. Từ khi biết
            website phongtro123.com, mình đã thử đăng tin lên và đánh giá hiệu
            quả khá cao trong khi chi phí khá thấp, không còn tình trạng phòng
            trống kéo dài."
          </p>
          <p>- Anh Khánh (Chủ hệ thống phòng trọ tại Tp.HCM)</p>
        </div>
      </div>

      <!-- Call to Action -->
      <div class="container cta-container">
        <h3>Bạn đang có phòng trọ / căn hộ cho thuê?</h3>
        <p>Không phải lo tìm người cho thuê, phòng trống kéo dài</p>
        <button class="cta-btn">Đăng tin ngay</button>
      </div>
      <div class="support-section">
        <div class="support-container">
          <div class="support-image">
            <img src="{{asset('uploads/fe/fe.jpg')}}" alt="Support team" />
          </div>
          <p>Liên hệ với chúng tôi nếu bạn cần hỗ trợ:</p>
          <div class="support-categories">
            <div class="support-category">
              <h4>HỖ TRỢ ĐĂNG TIN</h4>
              <p>Điện thoại: 0909316890<br />Zalo: 0909316890</p>
            </div>
            <div class="support-category">
              <h4>HỖ TRỢ THANH TOÁN</h4>
              <p>Điện thoại: 0909316890<br />Zalo: 0909316890</p>
            </div>
            <div class="support-category">
              <h4>PHẢN ÁNH/KHIẾU NẠI</h4>
              <p>Điện thoại: 0917686101<br />Zalo: 0917686101</p>
            </div>
          </div>
          <button class="support-btn">Gửi liên hệ</button>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
      <div class="container footer-container">
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
                <a href="#"><div class="imgfb"></div></a>
              </li>
              <li>
                <a href="#"><div class="imgyt"></div></a>
              </li>
              <li>
                <a href="#"><div class="imgzl"></div></a>
              </li>
              <li>
                <a href="#"><div class="imgtw"></div></a>
              </li>
            </ul>
          </div>
        </div>
        <div class="footer-bottom">
          <p>&copy; 2024 Phongtro123. Tất cả quyền được bảo lưu.</p>
        </div>
      </div>
    </footer>
  </body>
  <script src="/Demo/script.js"></script>
</html>
