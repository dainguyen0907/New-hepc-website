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
                        <div class="easion-card-title"> Thông tin tài khoản</div>
                    </div>
                    <div class="p-3">
                        <form action="<?= $action ?>" method="post" >
                            <?php if($mode=="change"):?>
                                <input type="hidden" id="id_user" name="id_user" value="<?= openssl_encrypt($user['id_user'],$encrypt['cipher_algo'],$encrypt['passphrase'],$encrypt['options'],$encrypt['iv'] )?>">
                            <?php endif;?>
                            <div class="form-row">
                                <?php if($mode=="add"):?>
                                <div class="form-group col-md-6">
                                    <label>Email</label>
                                    <input name="email_user" type="email" class="form-control" placeholder="Nhập email" value="<?=$mode=="change"?$user['email']:''?>"
                                        required>
                                </div>
                                <?php endif;?>
                                <div class="form-group col-md-6">
                                    <label>Tên người dùng</label>
                                    <input name="name_user" type="text" class="form-control" value="<?=$mode=="change"?$user['user']:''?>"
                                        placeholder="Nhập tên người dùng" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Địa chỉ</label>
                                    <input name="address_user" type="text" class="form-control" value="<?=$mode=="change"?$user['address']:''?>"
                                        placeholder="Nhập địa chỉ">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Giới tính</label>
                                    <select name="gender_user" class="form-select" aria-label="Default select example">
                                        <option value="0"  <?php  if($mode=='change'){if($user['gender']==0){ echo 'selected';}} ?>>Nữ</option>
                                        <option value="1" <?php  if($mode=='change'){if($user['gender']==1){ echo 'selected';}} ?>>Nam</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Ngày sinh</label>
                                    <input name="birthday_user" type="date" class="form-control" placeholder="Ngày sinh" value="<?=$mode=="change"?$user['birthday']:''?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Quyền</label>
                                    <select name="roles_user" class="form-select" aria-label="Default select example">
                                        <?php if($mode=="change"):?>
                                            <?php foreach($pq as $q):?>
                                                <option value="<?=$q['id_q']?>" <?php  if($user['id_q']==$q['id_q']){ echo 'selected';} ?>><?=$q['quyen']?></option>
                                            <?php endforeach;?>
                                        <?php else: ?>
                                            <?php foreach($pq as $q):?>
                                                <option value="<?=$q['id_q']?>" ><?=$q['quyen']?></option>
                                            <?php endforeach;?>
                                        <?php endif;?>
                                        
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Phòng ban</label>
                                    <select name="group_user" class="form-select" aria-label="Default select example">
                                        <?php if($mode=="change"):?>
                                            <?php foreach($pb as $p):?>
                                            <option value="<?= $p['id_pb']?>" <?php  if($user['id_pb']==$p['id_pb']){ echo 'selected';} ?>><?= $p['phongban']?></option>
                                            <?php endforeach;?>
                                        <?php else:?>
                                            <?php foreach($pb as $p):?>
                                                <option value="<?= $p['id_pb']?>"><?= $p['phongban']?></option>
                                            <?php endforeach;?>
                                        <?php endif;?>
                                    </select>
                                </div>
                                <?php if($mode=="add"):?>
                                <div class="form-group col-md-6">
                                    <label>Mật khẩu</label>
                                    <input name="password" type="password" class="form-control" placeholder="Nhập mật khẩu mới"
                                        required>
                                </div>
                                <?php endif;?>
                                <div class="form-group col-md-6">
                                    <label> Trạng thái</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status_user" value="1"
                                        <?php if($mode=="change"){ if($user['status_user']==1){echo 'checked';}} else echo'checked';?>>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Đang hoạt động
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status_user" value="0"
                                        <?php if($mode=="change"){ if($user['status_user']==0){echo 'checked';}}?>>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Vô hiệu hóa
                                        </label>
                                    </div>
                                </div>
                                
                            </div>
                            <button type="submit" class="btn btn-success"><?php if($mode=="add") echo 'Tạo mới'; else echo 'Cập nhật';?></button>
                            <button type="reset" class="btn btn-secondary">Nhập lại</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>