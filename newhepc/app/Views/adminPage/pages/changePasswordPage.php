<main class="dash-content">
    <div class="container-fluid">
        <?= view('alerts/alert') ?>
        <div class="row">
            <div class="col-xl-12">
                <div class="card easion-card">
                    <div class="card-header">
                        <div class="easion-card-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <div class="easion-card-title"> Thông tin tài khoản</div>
                    </div>
                    <div class="p-3">
                        <form action="./admin/changepassword" method="post">
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label>Mật khẩu cũ</label>
                                    <input name="old_password" type="password" class="form-control"
                                        placeholder="Nhập mật khẩu cũ" required>
                                </div>
                                <div class="form-group col-12">
                                    <label>Mật khẩu mới</label>
                                    <input name="new_password" type="password" class="form-control"
                                        placeholder="Nhập mật khẩu mới" required>
                                </div>
                                <div class="form-group col-12">
                                    <label>Xác nhận mật khẩu</label>
                                    <input name="re_password" type="password" class="form-control"
                                        placeholder="Xác nhận mật khẩu mới" required>
                                </div>
                                <div class="form-group col-12">
                                    <strong>Lưu ý:</strong>
                                    <ul>
                                        <li>Mật khẩu có độ dài tối thiểu 10 ký tự.</li>
                                        <li>Mật khẩu phải chứa ký tự đặc biệt, chữ thường và chữ viết hoa.</li>
                                        <li>Mật khẩu mới không trùng với mật khẩu cũ</li>
                                    </ul>
                                </div>

                            </div>
                            <button type="submit" class="btn btn-success">Cập nhật</button>
                            <button type="reset" class="btn btn-secondary">Nhập lại</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>