<div class="modal fade" id="addBannerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thêm banner mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="admin/management/banner/add">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="col-form-label">Đường dẫn hình ảnh:</label>
                        <input type="text" class="form-control" name="bannerlink" required>
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label">Đường dẫn bài viết:</label>
                        <input type="text" class="form-control" name="postlink">
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