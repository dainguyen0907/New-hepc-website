<div class="p-3">
    <div class="p-5 text-center text-primary">
        <strong class="fs-3">GỬI THÔNG TIN LIÊN HỆ</strong>
    </div>
    <?=view('alerts/alert')?>
    <form action="./lien-he/add" method="post">
        <?php if(isset($phongban)):?>
        <div class="mb-3">
            <label>Phòng ban cần liên hệ:</label>
            <select name="group_contact" class="form-control">
                <?php foreach($phongban as $n):?>
                <option value="<?=$n['id_pb']?>"><?= $n['phongban']?></option>
                <?php endforeach;?>
            </select>
        </div>
        <?php endif;?>
        <div class="mb-3">
            <label>Tên người gửi:</label>
            <input type="text" class="form-control" name="name_contact" required>
        </div>
        <div class="mb-3">
            <label>Số điện thoại:</label>
            <input type="number" class="form-control" name="number_contact" required>
        </div>
        <div class="mb-3">
            <label>Email:</label>
            <input type="email" class="form-control" name="email_contact" required>
        </div>
        <div class="mb-3">
            <label>Tiêu đề:</label>
            <input type="text" class="form-control" name="heading_contact" required>
        </div>
        <div class="mb-3">
            <label>Nội dung: </label>
            <textarea name="content_contact" rows="5" class="form-control" required></textarea>
        </div>
        <div class="mb-3 text-end">
            <div class="g-recaptcha" data-sitekey="6LcMld4oAAAAALhV2efu_fPwGbV5jS7F5XOmgVF_"></div>
            <button type="submit" class="btn btn-primary" data-sitekey="">Gửi phản hồi</button>
        </div>
    </form>
    <hr />
    <p>
        <strong>Lưu ý:</strong>
    <ul>
        <li>Vui lòng nhập đầy đủ các thông tin liên hệ.</li>
        <li>Không gửi tin liên tục. Mỗi tin nhắn cách nhau tối thiểu 15 phút.</li>
        <li>Thông tin của bạn chỉ dùng cho mục đích liên hệ, không dùng cho mục đích thương mại.</li>
        <li>Liên hệ đến địa chỉ: 554 Hà Huy Giáp - Phường Thạnh Lộc - Quận 12 - Thành phố Hồ Chí Minh để nhận hỗ trợ trực tiếp.</li>
    </ul>
    </p>
</div>