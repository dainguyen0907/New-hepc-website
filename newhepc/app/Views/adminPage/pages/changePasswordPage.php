<main class="dash-content">
    <div class="container-fluid">
        <?= view('alerts/alert')?>
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
                                    <input name="old_password" type="password" class="form-control" placeholder="Nhập mật khẩu cũ"
                                        required>
                                </div>
                                <div class="form-group col-12">
                                    <label>Mật khẩu mới</label>
                                    <input name="new_password" type="password" class="form-control" placeholder="Nhập mật khẩu mới"
                                        required>
                                </div>
                                <div class="form-group col-12">
                                    <label>Xác nhận mật khẩu</label>
                                    <input name="re_password" type="password" class="form-control" placeholder="Xác nhận mật khẩu mới"
                                        required>
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