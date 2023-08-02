<div class="user-manager-page p-5">
    <a href="" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addCatalogueModal"> Thêm chuyên mục
        mới</a>
    <?= view('alerts/alert') ?>
    <div class="table-info">
        <div class="card easion-card">
            <div class="card-header">
                <div class="easion-card-icon">
                    <i class="fas fa-table"></i>
                </div>
                <div class="easion-card-title">Quản lí chuyên mục</div>
            </div>
            <div class="p-3">
                <table id="datatable" class="cell-border">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Tên phòng ban</th>
                            <th scope="col">Link</th>
                            <th scope="col">Phòng ban</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($Catalogues as $n): ?>
                            <tr>
                                <td>
                                    <?= $n['id_cmpb'] ?>
                                </td>
                                <td>
                                    <?= $n['cmphongban'] ?>
                                </td>
                                <td>
                                    <?= $n['link'] ?>
                                </td>
                                <td>
                                    <?= $n['phongban'] ?>
                                </td>
                                <td class="<?= $n['status_cmpb'] == 1 ? 'text-success' : 'text-danger' ?>">
                                    <?= $n['status_cmpb'] == 1 ? 'Hoạt động' : 'Vô hiệu hóa' ?>
                                </td>
                                <td class="text-center">
                                    <a href="" class="btn btn-primary" title="Cập nhật thông tin" data-bs-toggle="modal" data-bs-target="#updateCatalogueModal" 
                                    data-id="<?=$n['id_cmpb']?>"  data-name="<?=$n['cmphongban']?>" data-group="<?=$n['id_pb']?>"  data-status="<?=$n['status_cmpb'] ?>">
                                        <i class="fas fa-edit"></i></a>
                                    <a class="btn btn-danger btn-del-confirm" title="Xóa chuyên mục" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?=$n['id_cmpb']?>">
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
<?= view('adminPage/modals/catalogue_addModal') ?>
<?= view('adminPage/modals/catalogue_updateModal') ?>
<?= view('adminPage/modals/deleteModal',['name'=>'chuyên mục','action'=>'admin/management/catalogue/delete'])?>

<script>
    var resetPasswordModal = document.getElementById('updateCatalogueModal')
    resetPasswordModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget
        var id = button.getAttribute('data-id')
        var name = button.getAttribute('data-name')
        var group = button.getAttribute('data-group')
        var status = button.getAttribute('data-status')

        var modalID = resetPasswordModal.querySelector('#id_catalogue')
        var modalName = resetPasswordModal.querySelector('#name_catalogue')
        var modalGroup = resetPasswordModal.querySelector('#group_catalogue')
        var modalActive = resetPasswordModal.querySelector('#active_catalogue')
        var modalInactive = resetPasswordModal.querySelector('#inactive_catalogue')

        modalID.value = id
        modalName.value=name
        modalGroup.value=group
        if(status==1){
            modalActive.setAttribute('checked','checked')
        }else
        {
            modalInactive.setAttribute('checked','checked')
        }

    })
</script>