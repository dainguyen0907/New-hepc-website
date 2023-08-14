<main class="dash-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card easion-card">
                    <div class="card-header">
                        <div class="easion-card-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <div class="easion-card-title"> Thông tin liên hệ</div>
                    </div>
                    <div class="p-3">
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label>Tên người gửi:</label>
                                <input type="text" class="form-control"  value="<?=$contactDetail['ten']?>">
                            </div>
                            <div class="form-group col-12">
                                <label>Số điện thoại:</label>
                                <input type="text" class="form-control" value="<?=$contactDetail['sdt']?>">
                            </div>
                            <div class="form-group col-12">
                                <label>Email:</label>
                                <input type="text" class="form-control" value="<?=$contactDetail['mail']?>">
                            </div>
                            <div class="form-group col-12">
                                <label>Ngày liên hệ:</label>
                                <input type="text" class="form-control" value="<?=$contactDetail['ngay_lh']?>">
                            </div>
                            <div class="form-group col-12">
                                <label>Tiêu đề:</label>
                                <input type="text" class="form-control" value="<?=$contactDetail['tieude']?>">
                            </div>
                            <div class="form-group col-12">
                                <label>Nội dung:</label>
                                <textarea class="form-control" cols="30" rows="10" ><?=$contactDetail['noidung']?></textarea>
                            </div>
                            

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>