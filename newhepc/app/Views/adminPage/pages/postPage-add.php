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
                        <div class="easion-card-title"> Thông tin bài viết</div>
                    </div>
                    <div class="p-3">
                        <form action="<?= $action ?>" method="post" >
                            <?php if($mode=="change"):?>
                                <input type="hidden" id="id_bv" name="id_bv" value="<?= openssl_encrypt($new['id_bv'],$encrypt['cipher_algo'],$encrypt['passphrase'],$encrypt['options'],$encrypt['iv'] )?>">
                            <?php endif;?>
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label>Tiêu đề</label>
                                    <input name="heading_post" type="text" class="form-control" placeholder="Nhập tiêu đề" value="<?=$mode=="change"?$new['heading']:''?>"
                                        required>
                                </div>
                                <?php if($mode=="add"):?>
                                <div class="form-group col-12">
                                    <label>Phòng ban</label>
                                    <select name="group_post" class="form-select" id="group_select_in_newPage">
                                        <?php foreach ($groups as $n):?>
                                            <option value="<?=$n['id_pb']?>"  <?php  if($mode=='change'){if($n['id_pb']==$new['id_pb']){ echo 'selected';}} ?>><?=$n['phongban']?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group col-12">
                                    <label>Chuyên mục</label>
                                    <select name="group_post" class="form-select" id="catalogue_select_in_newPage">
                                        <?php foreach ($catalogue as $n):?>
                                            <option value="<?=$n['id_cmpb']?>"  <?php  if($mode=='change'){if($n['id_cmpb']==$new['id_cmpb']){ echo 'selected';}} ?>><?=$n['cmphongban']?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <?php endif;?>
                                <div class="form-group col-12">
                                    <label>Ảnh đại diện</label>
                                    <input name="image_post" type="text" class="form-control" placeholder="Nhập đường dẫn" value="<?=$mode=="change"?$new['img']:''?>">
                                </div>
                                <div class="form-group col-12">
                                    <label>Tập tin đính kèm</label>
                                    <input name="file_post" type="text" class="form-control" placeholder="Nhập đường dẫn" value="<?=$mode=="change"?$new['file']:''?>">
                                </div>
                                <div class="form-group col-12">
                                    <label>Tóm tắt</label>
                                    <textarea name="summarize_post" class="form-control" rows="5" placeholder="Nhập tóm tắt nội dung"><?=$mode=="change"?$new['summarize']:''?></textarea>
                                </div>
                                <div class="form-group col-12">
                                <label>Nội dung</label>
                                    <textarea name="content_post" class="form-control" id="editor" placeholder="Nhập tóm tắt nội dung"><?=$mode=="change"?$new['content']:''?></textarea>
                                </div>
                                <?php if($mode=="change"):?>
                                <div class="form-group col-12">
                                    <label>Lượt xem:</label>
                                    <input name="view_post" type="number" class="form-control" placeholder="Lượt xem" value="<?=$mode=="change"?$new['view']:''?>">
                                </div>
                                <?php endif;?>
                                
                            </div>
                            <button type="submit" class="btn btn-success"><?php if($mode=="add") {echo 'Tạo mới';} else {echo 'Cập nhật';}?></button>
                            <button type="reset" class="btn btn-secondary">Nhập lại</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>