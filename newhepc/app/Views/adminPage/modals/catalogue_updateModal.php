<div class="modal fade" id="updateCatalogueModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cập nhật chuyên mục</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="admin/management/catalogue/update">
                <input type="hidden" name="catalogueid" id="id_catalogue">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Tên chuyên mục:</label>
                        <input type="text" class="form-control" name="cataloguename" id="name_catalogue"required>
                    </div>
                    <div class="mb-3">
                        <label>Phòng ban</label>
                        <select name="cataloguegroup" class="form-select" aria-label="Default select example" id="group_catalogue">
                            <?php foreach ($Groups as $n): ?>
                                <option value="<?= $n['id_pb'] ?>"><?= $n['phongban'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label> Trạng thái</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status_catalogue" value="1" id="active_catalogue">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Đang hoạt động
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status_catalogue" value="0" id="inactive_catalogue">
                            <label class="form-check-label" for="flexRadioDefault2">
                                Vô hiệu hóa
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>