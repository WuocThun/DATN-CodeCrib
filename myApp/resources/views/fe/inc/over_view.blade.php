<section class="stats-testimonials">
    <div class="container stats-container">
        <h2>Tại sao lại chọn CodeCrib.com?</h2>
        <p>Chúng tôi biết bạn có rất nhiều lựa chọn, nhưng CodeCrib.com tự hào là trang web đứng top google về các từ khóa: cho thuê phòng trọ, nhà trọ, thuê nhà nguyên căn, cho thuê căn hộ, tìm người ở ghép, cho thuê mặt bằng... Vì vậy tin của bạn đăng trên website sẽ tiếp cận được với nhiều khách hàng hơn, do đó giao dịch nhanh hơn, tiết kiệm chi phí hơn.</p>

        <div class="stats">
            <div class="stat-item">
                <h3>{{$getAllUser ?? '0'}}+</h3>
                <p>Thành viên</p>
            </div>
            <div class="stat-item">
                <h3>{{$getAllRooms ?? '0'}}+</h3>
                <p>Tin đăng cho thuê trọ</p>
            </div>
            <div class="stat-item">
                <h3>{{$getMotel ?? '0'}}+</h3>
                <p>Phòng trọ cần người đăng ký</p>
            </div>
            <div class="stat-item">
                <h3>{{$getUserMotel ??'0'}}+</h3>
                <p>Các phòng tìm kiếm người ở ghép</p>
            </div>
        </div>
    </div>

    <!-- Testimonials -->
    <div class="container testimonials-container">
        <h2>Chi phí thấp, hiệu quả tối đa</h2>
        <div class="testimonial">
            <p>"Trước khi biết website CodeCrib, mình phải tốn nhiều công sức và chi phí cho việc đăng tin cho thuê: từ việc phát tờ rơi, dán giấy, và đăng lên các website khác nhưng hiệu quả không cao. Từ khi biết website CodeCrib.com, mình đã thử đăng tin lên và đánh giá hiệu quả khá cao trong khi chi phí khá thấp, không còn tình trạng phòng trống kéo dài."</p>
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
                <img src="{{asset('uploads/fe/img/support-bg.jpg')}}" alt="Support team" />
            </div>
            <p>Liên hệ với chúng tôi nếu bạn cần hỗ trợ:</p>
            <div class="support-categories">
                <div class="support-category">
                    <h4>HỖ TRỢ ĐĂNG TIN</h4>
                    <p>Điện thoại: 0906138104<br>Zalo: 0906138104</p>
                </div>
                <div class="support-category">
                    <h4>HỖ TRỢ THANH TOÁN</h4>
                    <p>Điện thoại: 0906138104<br>Zalo: 0906138104</p>
                </div>
                <div class="support-category">
                    <h4>PHẢN ÁNH/KHIẾU NẠI</h4>
                    <p>Điện thoại: 0906138104<br>Zalo: 0906138104</p>
                </div>
            </div>
            <button class="support-btn">Gửi liên hệ</button>
        </div>
    </div>

</section>
