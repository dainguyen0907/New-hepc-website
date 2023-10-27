<div class="modal fade" id="resetPassModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rest password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="admin/management/user/resetPassword">
                <div class="modal-body">
                    <input type="hidden" id="id_user" name="id_user">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Mật khẩu:</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Xác nhận mật khẩu:</label>
                        <input type="password" class="form-control" name="repassword">
                    </div>
                    <div class="mb-3">
                        <strong>Lưu ý:</strong>
                        <ul>
                            <li>Mật khẩu có độ dài tối thiểu 10 ký tự.</li>
                            <li>Mật khẩu phải chứa ký tự đặc biệt, chữ thường và chữ viết hoa.</li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>