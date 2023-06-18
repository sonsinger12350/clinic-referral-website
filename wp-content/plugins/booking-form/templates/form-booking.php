<form id="book-exam-form" method="POST">
    <div class="form-body">
        <div class="process-line">
            <div class="process-item process-1 active">
                <p>1. DỊCH VỤ</p>
                <div class="process-bar"></div>
            </div>
            <div class="process-item process-2">
                <p>2. THỜI GIAN</p>
                <div class="process-bar"></div>
            </div>
            <div class="process-item process-3">
                <p>3. THÔNG TIN</p>
                <div class="process-bar"></div>
            </div>
            <div class="process-item process-4">
                <p>4. HOÀN THÀNH</p>
                <div class="process-bar"></div>
            </div>
        </div>
        <div class="step-body step-1 active">
            <div class="process-line list-select" style="margin-top: 20px">
                <div class="process-item">
                    <label class="label-select" for="category">DANH MỤC</label>
                    <select name="book[category]" id="category" class="custom-select">
                        <option value="" selected hidden disabled>Lựa chọn danh mục</option>
                        <option value="1">NIỀNG RĂNG</option>
                        <option value="2">PHỤC HÌNH RĂNG</option>
                        <option value="3">NHA KHOA THẨM MỸ</option>
                        <option value="4">NHA KHOA TỔNG QUÁT</option>
                        <option value="5">NHA KHOA TRẺ EM</option>
                    </select>
                    <span class="invalid-feedback"></span>
                </div>
                <div class="process-item">
                    <label class="label-select" for="service">DỊCH VỤ</label>
                    <select name="book[service]" id="service" class="custom-select">
                        <option value="" selected hidden disabled>Lựa chọn dịch vụ</option>
                        <option value="1">Điều trị tủy răng</option>
                        <option value="2">Điều trị viêm nướu - viêm nha chu</option>
                        <option value="3">Cạo vôi - đánh bóng răng</option>
                        <option value="4">Nhổ răng khôn</option>
                        <option value="5">Nhổ răng vĩnh viễn</option>
                        <option value="6">Trám răng sâu</option>
                        <option value="7">Chụp X-Quang nha khoa</option>
                        <option value="8">Khám tổng quát miễn phí</option>
                    </select>
                    <span class="invalid-feedback"></span>
                </div>
                <div class="process-item">
                    <label class="label-select" for="branch">CHI NHÁNH</label>
                    <select name="book[branch]" id="branch" class="custom-select">
                        <option value="" selected hidden disabled>Lựa chọn cơ sở điều trị</option>
                        <option value="1">51 Quốc Lộ 1K, P. Linh Xuân, TP Thủ Đức</option>
                        <option value="2">20 Đường M, Khu TTHC Dĩ An, TP Dĩ An</option>
                    </select>
                    <span class="invalid-feedback"></span>
                </div>
            </div>
        </div>
        <div class="step-body step-2 ">
            <div style="margin-bottom: 10px">
                Quý khách có thể tìm thấy danh sách các khoảng thời gian khả dụng cho <b>Khám tổng quát miễn phí</b> tại Nha Khoa LINH XUÂN - Cơ sở: <b>Lựa chọn cơ sở điều trị</b>. Vui lòng nhấp vào một khoảng thời gian để tiến hành đặt hẹn.
            </div>
            <div class="choose-date">
                <div class="date">
                    <input type="text" class="pick-date" name="book[booking_date]" hidden>
                </div>
                <div class="list-time">
                    <input type="text" name="book[booking_time]" hidden>
                    <button class="btnPickTime" disabled><span>T6, Th6 30</span></button>
                    <?php
                        foreach($listTime as $v) {
                            $btnPickTime = '<button class="btnPickTime" value="'.$v.'" type="button">';
                            $btnPickTime .= '<div class="time-pick"><div class="icon-time-pick"><div class="icon-time-pick-active"></div></div><span>'.$v.'</span></div></button>';
                            echo $btnPickTime;
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="step-body step-3 ">
            <div>
                Quý khách đã chọn đặt hẹn cho <b id="service-picked">Khám tổng quát miễn phí</b> tại Nha Khoa LINH XUÂN - Cơ sở: <b id="branch-picked">51 Quốc Lộ 1K, P. Linh Xuân, TP Thủ Đức</b> vào lúc <b id="time-picked">16:30</b> ngày <b id="date-picked">17/06/2023</b>. Quý khách vui lòng cung cấp thông tin chi tiết trong biểu mẫu bên dưới để hoàn tất đặt hẹn.
            </div>
            <div class="process-line list-input" style="margin-top: 20px">
                <div class="process-item">
                    <label class="label-input" for="full_name">HỌ TÊN</label>
                    <input type="text" name="book[full_name]" id="full_name" value="Sơn" class="custom-input" placeholder="Nhập họ và tên" autocomplete="on">
                    <span class="invalid-feedback"></span>
                </div>
                <div class="process-item">
                    <label class="label-input" for="mobile">ĐIỆN THOẠI</label>
                    <input type="text" name="book[mobile]" id="mobile" value="0835912174" class="custom-input" placeholder="Nhập số điện thoại" autocomplete="on">
                    <span class="invalid-feedback"></span>
                </div>
                <div class="process-item">
                    <label class="label-input" for="email">EMAIL</label>
                    <input type="text" name="book[email]" id="email" value="sonle12350@gmail.com" class="custom-input" placeholder="Nhập email" autocomplete="on">
                    <span class="invalid-feedback"></span>
                </div>
            </div>
        </div>
        <div class="step-body step-4">
            <div>
                Xin chân thành cảm ơn Quý khách! Đặt hẹn của Quý khách đã hoàn tất. Rất hy vọng được tiếp đón Quý khách thật chu đáo tại Nha Khoa LINH XUÂN. Hẹn gặp lại Quý khách!
            </div>
        </div>
    </div>
    <div class="form-footer">
        <div class="step-footer step-1 active">
            <button type="button" class="back-step d-none">Quay lại</button>
            <button type="button" class="next-step" value="1">Tiếp theo</button>
        </div>
        <div class="step-footer step-2 ">
            <button type="button" class="back-step" value="1">Quay lại</button>
        </div>
        <div class="step-footer step-3 ">
            <button type="button" class="back-step" value="2">Quay lại</button>
            <button type="button" class="next-step" value="3">Tiếp theo</button>
        </div>
    </div>
</form>