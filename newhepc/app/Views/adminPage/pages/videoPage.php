<div class="user-manager-page p-5">
    <a href="" class="btn btn-success mb-3"> Thêm video</a>
    <?= view('alerts/alert') ?>
    <div class="table-info">
        <div class="card easion-card">
            <div class="card-header">
                <div class="easion-card-icon">
                    <i class="fas fa-table"></i>
                </div>
                <div class="easion-card-title">Quản lí video</div>
            </div>
            <div class="p-3">
                <table id="datatable" class="cell-border">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Người đăng</th>
                            <th scope="col">Tên video</th>
                            <th scope="col">Đường dẫn</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($videos as $n): ?>
                            <tr>
                                <td>
                                    <?= $n['id_vd'] ?>
                                </td>
                                <td>
                                    <?= $n['user'] ?>
                                </td>
                                <td>
                                    <?= $n['video'] ?>
                                </td>
                                <td>
                                    <?=$n['file_vd']?>
                                </td>
                                <td class="<?= $n['status_vd'] == 1 ? 'text-success' : 'text-danger' ?>">
                                    <?= $n['status_vd'] == 1 ? 'Hoạt động' : 'Vô hiệu hóa' ?>
                                </td>
                                <td class="text-center">
                                    <a href="" class="btn btn-primary mb-3" title="Cập nhật thông tin" >
                                        <i class="fas fa-edit"></i></a>
                                    <a class="btn btn-danger btn-del-confirm mb-3" title="Xóa video">
                                        <i class="far fa-trash-alt"></i></a>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>