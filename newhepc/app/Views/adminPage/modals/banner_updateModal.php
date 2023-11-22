<div class="modal fade" id="updateBannerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cập nhật</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="admin/management/banner/update">
                <input type="hidden" name="bannerid" id="id_banner">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Đường dẫn ảnh:</label>
                        <input type="text" class="form-control" name="bannerlink" id="link_banner" required>
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label">Đường dẫn bài viết:</label>
                        <input type="text" class="form-control" name="postlink" id="post_link">
                    </div>
                    <div class="mb-3">
                        <label> Trạng thái</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status_banner" value="1" id="active_banner">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Đang hoạt động
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status_banner" value="0" id="inactive_banner">
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