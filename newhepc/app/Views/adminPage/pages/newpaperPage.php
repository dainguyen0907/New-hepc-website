<div class="user-manager-page p-5">
    <?= view('alerts/alert') ?>
    <div class="mb-3 col-6">
        <label>Phòng ban</label>
        <select class="form-select" id="group_select_in_newPage">
            <option value="-1">Tất cả</option>
            <?php foreach ($groups as $n): ?>
                <option value="<?=$n['id_pb']?>"><?=$n['phongban']?></option>
            <?php endforeach; ?>
        </select>
    </div>
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
                    <tbody >
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
                                <td class="text-center">
                                    <a href="" class="btn btn-primary mb-3" title="Cập nhật thông tin">
                                        <i class="fas fa-edit"></i></a>

                                    <a class="btn btn-danger btn-del-confirm mb-3" title="Xóa bài viết">
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