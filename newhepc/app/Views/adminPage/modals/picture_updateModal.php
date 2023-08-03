<div class="modal fade" id="updatePictureModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cập nhật video</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="admin/control/picture/update">
                <input type="hidden" name="pictureid" id="id_picture">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Đường dẫn ảnh:</label>
                        <input type="text" class="form-control" name="picturelink" required id="link_picture">
                    </div>
                    <div class="mb-3">
                    <label>Phòng ban</label>
                        <select name="picturegroup" class="form-select" aria-label="Default select example" id="group_picture">
                            <?php foreach ($Groups as $n): ?>
                                <option value="<?= $n['id_pb'] ?>"><?= $n['phongban'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label> Trạng thái</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status_picture" value="1" id="active_picture">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Đang hoạt động
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status_picture" value="0" id="inactive_picture">
                            <label class="form-check-label" for="flexRadioDefault2">
                                Vô hiệu hóa
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label> Kiểm duyệt</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="censor_picture" value="1" id="censor_picture">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Đã duyệt
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="censor_picture" value="0" id="uncensored_picture">
                            <label class="form-check-label" for="flexRadioDefault2">
                                Chưa duyệt
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <img src="" alt="" width="100%" id="file_picture">
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