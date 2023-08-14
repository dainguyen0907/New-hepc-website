<div class="user-manager-page p-5">
<?= view('alerts/alert') ?>
    <div class="table-info">
        <div class="card easion-card">
            <div class="card-header">
                <div class="easion-card-icon">
                    <i class="fas fa-table"></i>
                </div>
                <div class="easion-card-title">LIÊN HỆ</div>
            </div>
            <div class="p-3">
                <table id="datatable" class="cell-border">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Họ và tên</th>
                            <th scope="col">Tiêu đề</th>
                            <th scope="col">Thời gian</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($contact as $h): ?>
                            <tr>
                                <td>
                                    <?= $h['id_lh'] ?>
                                </td>
                                <td>
                                    <?= $h['ten'] ?>
                                </td>
                                <td>
                                    <?= $h['tieude'] ?>
                                </td>
                                <td>
                                    <?= $h['ngay_lh'] ?>
                                </td>
                                <td class="<?= $h['trangthai'] == 1 ? 'text-success' : 'text-danger' ?>">
                                    <?= $h['trangthai'] == 1 ? 'Đã xử lý' : 'Chưa đọc' ?>
                                </td>
                                <td class='text-center'>
                                    <a href="./admin/contact/<?=$h['id_lh']?>" class="btn btn-primary" title="Xem nội dung" target="_blank"><i class="fa-solid fa-eye"></i></a>
                                    <?php if ($h['trangthai'] == '0'): ?>
                                        <a href="./admin/contact/change/<?=$h['id_lh']?>" class="btn btn-success" title="Đã xử lý"><i
                                                class="fa-solid fa-check"></i></a>
                                    <?php endif; ?>
                                    <a class="btn btn-danger btn-del-confirm" title="Xóa liên hệ" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal" data-id="<?= $h['id_lh'] ?>"><i
                                            class="far fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= view('adminPage/modals/deleteModal',['name'=>'liên hệ','action'=>'admin/contact/delete'])?>