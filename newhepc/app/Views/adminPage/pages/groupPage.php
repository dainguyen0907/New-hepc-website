<div class="user-manager-page p-5">
    <a href="" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addGroupModal"> Thêm phòng ban</a>
    <?= view('alerts/alert') ?>
    <div class="table-info">
        <div class="card easion-card">
            <div class="card-header">
                <div class="easion-card-icon">
                    <i class="fas fa-table"></i>
                </div>
                <div class="easion-card-title">Quản lí phòng ban</div>
            </div>
            <div class="p-3">
                <table id="datatable" class="cell-border">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Tên phòng</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($groups as $n): ?>
                            <tr>
                                <td>
                                    <?= $n['id_pb'] ?>
                                </td>
                                <td>
                                    <?= $n['phongban'] ?>
                                </td>
                                <td class="<?= $n['status_pb'] == 1 ? 'text-success' : 'text-danger' ?>">
                                    <?= $n['status_pb'] == 1 ? 'Hoạt động' : 'Vô hiệu hóa' ?>
                                </td>
                                <td class="text-center">
                                    <?php if ($n['status_pb'] == 1): ?>
                                        <a href="admin/management/group/change/<?=$n['id_pb']?>" class="btn btn-warning" title="Vô hiệu hóa">
                                            <i class="fa-solid fa-x"></i></a>
                                    <?php else: ?>
                                        <a href="admin/management/group/change/<?=$n['id_pb']?>" class="btn btn-success" title="Kích hoạt">
                                            <i class="fa-solid fa-check"></i></a>
                                    <?php endif; ?>

                                    <?php if ($n['id_pb'] > 17): ?>
                                        <a class="btn btn-danger btn-del-confirm" title="Xóa phòng ban"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal" 
                                            data-txtid="<?=$n['id_pb']?>"
                                            data-id="<?= openssl_encrypt($n['id_pb'], $encrypt['cipher_algo'], $encrypt['passphrase'], $encrypt['options'], $encrypt['iv']) ?>">
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
<?= view('adminPage/modals/group_addModal')?>
<?= view('adminPage/modals/deleteModal',['name'=>'phòng ban','action'=>'admin/management/group/delete'])?>
