<main class="dash-content">
    <div class="container-fluid">
        <h1 class="dash-title">
            <?= $title ?>
        </h1>
        <?= view('alerts/alert')?>
        <div class="row">
            <div class="col-xl-12">
                <div class="card easion-card">
                    <div class="card-header">
                        <div class="easion-card-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <div class="easion-card-title"> Thông tin video</div>
                    </div>
                    <div class="p-3">
                        <form action="./admin/management/video/update" method="post" >
                            <input type="hidden" name="videoid" value="<?=$video['id_vd']?>">
                            <div class="form-row">
                                <div class="form-group col-12">
                                <label>Tên video</label>
                                    <input name="videoname" type="text" class="form-control" placeholder="Nhập tên video" value="<?=$video['video']?>"
                                        required>
                                </div>
                                <div class="form-group col-12">
                                <label>Đường dẫn</label>
                                    <textarea name="videolink" type="text" class="form-control" rows="5" placeholder="Nhập tên video" required>
                                        <?=$video['file_vd']?>
                                    </textarea>
                                </div>
                                <div class="form-group col-6">
                                    <label> Trạng thái</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="videostatus" value="1"
                                        <?php if($video['status_vd']==1){echo 'checked';} else echo'checked';?>>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Đang hoạt động
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="videostatus" value="0"
                                        <?php  if($video['status_vd']==0){echo 'checked';}?>>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Vô hiệu hóa
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <?=$video['file_vd']?>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Cập nhật</button>
                            <button type="reset" class="btn btn-secondary">Nhập lại</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>