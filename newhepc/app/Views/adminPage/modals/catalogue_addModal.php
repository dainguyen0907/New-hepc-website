<div class="modal fade" id="addCatalogueModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thêm chuyên mục</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="admin/management/catalogue/add">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Tên chuyên mục:</label>
                        <input type="text" class="form-control" name="cataloguename" required>
                    </div>
                    <div class="mb-3">
                        <label>Phòng ban</label>
                        <select name="cataloguegroup" class="form-select" aria-label="Default select example">
                            <?php foreach($Groups as $n):?>
                                <option value="<?= $n['id_pb']?>"><?= $n['phongban']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </div>
            </form>
        </div>
    </div>
</div>