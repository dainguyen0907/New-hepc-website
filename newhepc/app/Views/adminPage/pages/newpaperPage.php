<div class="user-manager-page p-5">
    <?= view('alerts/alert') ?>
    <?php if ($role == 'admin' || $role == 'leader'): ?>
        <div class="mb-3 col-6">
            <label>Phòng ban</label>
            <select class="form-select" id="group_select_in_newPage">
                <?php if ($role == 'admin' || session('userLogin')['id_pb'] == 8): ?>
                    <option value="-1">Tất cả</option>
                <?php endif; ?>
                <?php foreach ($groups as $n): ?>
                    <option value="<?= $n['id_pb'] ?>"><?= $n['phongban'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    <?php endif; ?>
    <div class="table-info">
        <div class="card easion-card">
            <div class="card-header">
                <div class="easion-card-icon">
                    <i class="fas fa-table"></i>
                </div>
                <div class="easion-card-title">Quản lí bài viết</div>
            </div>
            <div class="p-3">
                <table id="datatable" class="cell-border">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Tiêu đề</th>
                            <th scope="col">Người viết</th>
                            <th scope="col">Chuyên mục</th>
                            <th scope="col">Ngày viết</th>
                            <th scope="col">Lượt xem</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Kiểm duyệt</th>
                            <th scope="col">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($news as $n): ?>
                            <tr>
                                <td>
                                    <?= $n['id_bv'] ?>
                                </td>
                                <td>
                                    <?= $n['heading'] ?>
                                </td>
                                <td>
                                    <?= $n['user'] ?>
                                </td>
                                <td>
                                    <?= $n['cmphongban'] ?>
                                </td>
                                <td>
                                    <?= $n['d_poss'] ?>
                                </td>
                                <td>
                                    <?= $n['view'] ?>
                                </td>
                                <td class="<?= $n['status_bv'] == 1 ? 'text-success' : 'text-danger' ?>">
                                    <?= $n['status_bv'] == 1 ? 'Hoạt động' : 'Vô hiệu hóa' ?>
                                </td>
                                <td class="<?= $n['censor_bv'] == 1 ? 'text-success' : 'text-danger' ?>">
                                    <?= $n['censor_bv'] == 1 ? 'Đã duyệt' : 'Chưa duyệt' ?>
                                </td>
                                <td class="text-center text-white">
                                <?php if (($role == 'admin' || $role == 'leader')&&$n['censor_bv']==0): ?>
                                    <a href="./admin/control/pass/<?= $n['id_bv'] ?>" class="btn btn-success mb-3"
                                        title="Duyệt bài">
                                        <i class="fa-solid fa-check"></i></a>
                                    <a href="./admin/control/failed/<?= $n['id_bv'] ?>" class="btn btn-danger mb-3"
                                        title="Không duyệt">
                                        <i class="fa-solid fa-x"></i></a>
                                <?php endif;?>
                                <a class="btn btn-primary mb-3" onclick="window.open('./admin/post/<?= $n['id_bv']?>','UpdateMgs','width=700,height=500')"
                                        title="Cập nhật thông tin">
                                        <i class="fas fa-edit"></i></a>
                                <?php if ($role != 'leader'): ?>
                                    <a class="btn btn-danger btn-del-confirm mb-3" title="Xóa bài viết" 
                                    data-bs-toggle="modal" data-bs-target="#deleteModal"  data-txtid="<?=$n['id_bv']?>"
                                    data-id="<?= openssl_encrypt($n['id_bv'], $encrypt['cipher_algo'], $encrypt['passphrase'], $encrypt['options'], $encrypt['iv']) ?>">
                                        <i class="far fa-trash-alt"></i></a>
                                <?php endif;?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= view('adminPage/modals/deleteModal', ['name' => 'Bài viết', 'action' => 'admin/control/post/delete']) ?>