<div class="user-manager-page p-5">
    <a href="admin/management/user/add" class="btn btn-success mb-3"> Thêm tài khoản</a>
    <?= view('alerts/alert') ?>
    <div class="table-info">
        <div class="card easion-card">
            <div class="card-header">
                <div class="easion-card-icon">
                    <i class="fas fa-table"></i>
                </div>
                <div class="easion-card-title">Quản lí tài khoản</div>
            </div>
            <div class="p-3">
                <table id="datatable" class="cell-border">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Email</th>
                            <th scope="col">Tên người dùng</th>
                            <th scope="col">Quyền</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($Users as $n): ?>
                            <tr>
                                <td>
                                    <?= $n['id_user'] ?>
                                </td>
                                <td>
                                    <?= $n['email'] ?>
                                </td>
                                <td>
                                    <?= $n['user'] ?>
                                </td>
                                <td>
                                    <?= $n['quyen'] ?>
                                </td>
                                <td>
                                    <?= $n['d_regis'] ?>
                                </td>
                                <td>
                                    <?= $n['status_user'] == '1' ? 'Đang sử dụng' : 'Vô hiệu hóa' ?>
                                </td>
                                <td class="text-center text-white">
                                    <a href="#" class="btn btn-success" title="Reset mật khẩu" data-bs-toggle="modal"
                                        data-bs-target="#resetPassModal"
                                        data-idUser="<?= openssl_encrypt($n['id_user'], $encrypt['cipher_algo'], $encrypt['passphrase'], $encrypt['options'], $encrypt['iv']) ?>">
                                        <i class="fa-solid fa-key"></i></a>
                                    <a class="btn btn-primary" onclick="window.open('admin/management/user/<?= $n['id_user'] ?>','UpdateMgs','width=700,height=500')"
                                        title="Cập nhật thông tin"><i class="fas fa-edit"></i></a>
                                    <?php if ($n['id_user'] != 1 && $n['id_user'] != session('userLogin')['id_user']): ?>
                                        <a class="btn btn-danger btn-del-confirm" title="Xóa tài khoản" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal" data-txtid="<?= $n['id_user'] ?>"
                                            data-id="<?= openssl_encrypt($n['id_user'], $encrypt['cipher_algo'], $encrypt['passphrase'], $encrypt['options'], $encrypt['iv']) ?>">
                                            <i class="far fa-trash-alt"></i></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= view('adminPage/modals/user_resetPassModal') ?>
<?= view('adminPage/modals/deleteModal', ['name' => 'tài khoản', 'action' => 'admin/management/user/delete']) ?>
<script>
    var resetPasswordModal = document.getElementById('resetPassModal')
    resetPasswordModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget
        var id = button.getAttribute('data-idUser')
        var modalID = resetPasswordModal.querySelector('#id_user')
        modalID.value = id
    })
</script>