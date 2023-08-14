<div class="user-manager-page p-5">
    <a href="" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addBannerModal"> Thêm Banner Quảng
        cáo</a>
    <?= view('alerts/alert') ?>
    <div class="table-info">
        <div class="card easion-card">
            <div class="card-header">
                <div class="easion-card-icon">
                    <i class="fas fa-table"></i>
                </div>
                <div class="easion-card-title">Quản lí Banner quảng cáo</div>
            </div>
            <div class="p-3">
                <table id="datatable" class="cell-border">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Người đăng</th>
                            <th scope="col">Link</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($banners as $n): ?>
                            <tr>
                                <td>
                                    <?= $n['id_banner'] ?>
                                </td>
                                <td>
                                    <?= $n['user'] ?>
                                </td>
                                <td>
                                    </span><?= $n['file'] ?>
                                </td>
                                <td>
                                    <img src="<?= $n['file'] ?>" width="80%">
                                </td>
                                <td class="<?= $n['status_banner'] == 1 ? 'text-success' : 'text-danger' ?>">
                                    <?= $n['status_banner'] == 1 ? 'Hoạt động' : 'Vô hiệu hóa' ?>
                                </td>
                                <td class="text-center">
                                    <a href="" class="btn btn-primary mb-3" title="Cập nhật thông tin" data-bs-toggle="modal"
                                        data-bs-target="#updateBannerModal" data-name="<?=$n['file']?>" data-status="<?=$n['status_banner']?>"
                                        data-id="<?= openssl_encrypt($n['id_banner'], $encrypt['cipher_algo'], $encrypt['passphrase'], $encrypt['options'], $encrypt['iv']) ?>">
                                        <i class="fas fa-edit"></i></a>
                                    <a class="btn btn-danger btn-del-confirm mb-3" title="Xóa banner" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal" data-txtid="<?=$n['id_banner']?>"
                                        data-id="<?= openssl_encrypt($n['id_banner'], $encrypt['cipher_algo'], $encrypt['passphrase'], $encrypt['options'], $encrypt['iv']) ?>">
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
<?= view('adminPage/modals/banner_addModal') ?>
<?= view('adminPage/modals/banner_updateModal') ?>
<?= view('adminPage/modals/deleteModal', ['name' => 'Banner', 'action' => 'admin/management/banner/delete']) ?>

<script>
    var updateBannerModal = document.getElementById('updateBannerModal')
    updateBannerModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget
        var id = button.getAttribute('data-id')
        var name = button.getAttribute('data-name')
        var status = button.getAttribute('data-status')

        var modalID = updateBannerModal.querySelector('#id_banner')
        var modalName = updateBannerModal.querySelector('#link_banner')
        var modalActive = updateBannerModal.querySelector('#active_banner')
        var modalInactive = updateBannerModal.querySelector('#inactive_banner')

        modalID.value = id
        modalName.value=name
        if(status==1){
            modalActive.setAttribute('checked','checked')
        }else
        {
            modalInactive.setAttribute('checked','checked')
        }

    })
</script>