<div class="user-manager-page p-5">
    <a href="" class="btn btn-success mb-3"> Thêm tài khoản</a>
    <div class="table-info">
        <div class="card easion-card">
            <div class="card-header">
                <div class="easion-card-icon">
                    <i class="fas fa-table"></i>
                </div>
                <div class="easion-card-title">Lịch chiếu</div>
            </div>
            <div class="card-body ">
                <table id="datatable" class="cell-border">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Email</th>
                            <th scope="col">Tên người dùng</th>
                            <th scope="col">Quyền</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($Users as $n):?>
                        <tr>
                            <td>
                                <?= $n['id_user']?>
                            </td>
                            <td>
                            <?= $n['email']?>
                            </td>
                            <td>
                            <?= $n['name']?>
                            </td>
                            <td>
                            <?= $n['name']?>
                            </td>
                            <td>
                            <?= $n['status']=='1'?'Đang sử dụng':'Vô hiệu hóa'?>
                            </td>
                            <td class="text-center">
                                <a href="comment-edit.html" class="btn btn-success" title="Reset mật khẩu"><i class="fa-solid fa-key"></i></a>
                                <a href="comment-edit.html" class="btn btn-primary" title="Cập nhật thông tin"><i class="fas fa-edit"></i></a>
                                <a class="btn btn-danger btn-del-confirm" title="Xóa tài khoản"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>