<div class="user-manager-page p-5">
    <?php if($role=='user'): ?>
        <a href="" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addPictureModal"> Thêm ảnh mới</a>
    <?php endif?>
    <?= view('alerts/alert') ?>
    <div class="table-info">
        <div class="card easion-card">
            <div class="card-header">
                <div class="easion-card-icon">
                    <i class="fas fa-table"></i>
                </div>
                <div class="easion-card-title">Quản lí ảnh hoạt động</div>
            </div>
            <div class="p-3">
                <table id="datatable" class="cell-border">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Người đăng</th>
                            <th scope="col">Phòng</th>
                            <th scope="col">Ảnh</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Kiểm duyệt</th>
                            <th scope="col">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pictures as $n): ?>
                            <tr>
                                <td>
                                    <?= $n['id_anh'] ?>
                                </td>
                                <td>
                                    <?= $n['user'] ?>
                                </td>
                                <td>
                                    <?= $n['phongban'] ?>
                                </td>
                                </td>
                                <td>
                                    <img src="<?= $n['anh'] ?>" width="100%">
                                </td>
                                <td class="<?= $n['status_anh'] == 1 ? 'text-success' : 'text-danger' ?>">
                                    <?= $n['status_anh'] == 1 ? 'Hoạt động' : 'Vô hiệu hóa' ?>
                                </td>
                                <td class="<?= $n['censor_anh'] == 1 ? 'text-success' : 'text-danger' ?>">
                                    <?= $n['censor_anh'] == 1 ? 'Đã duyệt' : 'Chưa duyệt' ?>
                                </td>
                                <td class="text-center">
                                    <?php if($role=='admin'||$role=='leader'): ?>
                                    <a href="" class="btn btn-primary mb-3" title="Cập nhật thông tin" data-bs-toggle="modal"
                                    data-bs-target="#updatePictureModal" data-id="<?=$n['id_anh'] ?>" data-link="<?= $n['anh'] ?>"
                                    data-status="<?= $n['status_anh'] ?>" data-censor="<?= $n['censor_anh'] ?>" data-group="<?= $n['id_p'] ?>"
                                    ><i class="fas fa-edit"></i></a></a>
                                    <?php endif;?>

                                    <a class="btn btn-danger btn-del-confirm mb-3" title="Xóa ảnh" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal" data-id="<?= $n['id_anh'] ?>">
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
<?php if($role=='user'): ?>
    <?= view('adminPage/modals/picture_addModal')?>
<?php endif?>
<?php if($role=='admin'||$role=='leader'): ?>
    <?= view('adminPage/modals/picture_updateModal')?>
<?php endif;?>
    <?= view('adminPage/modals/deleteModal', ['name' => 'Ảnh', 'action' => 'admin/picture/delete']) ?>
<?php if($role=='admin'||$role=='leader'): ?>
<script>
    var updatePictureModal = document.getElementById('updatePictureModal')
    updatePictureModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget
        var id = button.getAttribute('data-id')
        var link = button.getAttribute('data-link')
        var group = button.getAttribute('data-group')
        var status = button.getAttribute('data-status')
        var censor = button.getAttribute('data-censor')
        var modalID = updatePictureModal.querySelector('#id_picture')
        var modallink = updatePictureModal.querySelector('#link_picture')
        var modalgroup = updatePictureModal.querySelector('#group_picture')
        var modalfile = updatePictureModal.querySelector('#file_picture')
        var modalactive = updatePictureModal.querySelector('#active_picture')
        var modalinactive = updatePictureModal.querySelector('#inactive_picture')
        var modalcensor = updatePictureModal.querySelector('#censor_picture')
        var modaluncensored = updatePictureModal.querySelector('#uncensored_picture')
        modalID.value=id
        modallink.value=link
        modalgroup.value=group
        modalfile.setAttribute('src',link)
        if(status==1){
            modalactive.setAttribute('checked','checked')
        }else
        {
            modalinactive.setAttribute('checked','checked')
        }
        if(censor==1){
            modalcensor.setAttribute('checked','checked')
        }else
        {
            modaluncensored.setAttribute('checked','checked')
        }
    })
</script>
<?php endif;?>
