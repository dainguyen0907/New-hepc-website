<?php if($Banners !=null):?>
<section id="slide-bar">
    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php foreach ($Banners as $b):?>
            <div class="carousel-item active" data-bs-interval="10000">
                <img src="<?= $b['file']?>" class="d-block w-100" alt="...">
            </div>
            <?php endforeach;?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>
<?php endif;?>
<section id="introduce">
    <div class="container">
        <span>
            <h2>Giới thiệu</h2>
        </span>
        <div class="intro-content row">
            <div class="into-left col-lg-7 col-xs-12">
                <p>TRƯỜNG CAO ĐẲNG ĐIỆN LỰC <br /> THÀNH PHỐ HỒ CHÍ MINH</p>
                <img src="assets/images/unnamed.png" alt="Tàm nhìn và sứ mạng">
            </div>
            <div class="intro-right col-lg-5 col-xs-12">
                <img src="assets/images/school1.png" alt="Tàm nhìn và sứ mạng">
                <img src="assets/images/school2.png" alt="Tàm nhìn và sứ mạng">
                <img src="assets/images/school3.png" alt="Tàm nhìn và sứ mạng">
            </div>
        </div>
    </div>
</section>
<section id="activity">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-2 hvr-overline-from-center">
                <a href="./tuyen-sinh"><img src="assets/images/hdd.gif" alt="Tuyển sinh">
                    <span>Tuyển sinh</span>
                </a>
            </div>
            <div class="col-12 col-md-2 hvr-overline-from-center">
                <a href="./tuyen-dung"><img src="assets/images/homthu.png" alt="Tuyển dụng">
                    <p>Tuyển dụng</p>
                </a>
            </div>
            <div class="col-12 col-md-2 hvr-overline-from-center">
                <a href="http://daotao.hepc.edu.vn/"><img src="assets/images/dt.png" alt="Đào tạo">
                    <p>Đào tạo</p>
                </a>
            </div>
            <div class="col-12 col-md-2 hvr-overline-from-center">
                <a href="http://thuvienso.hepc.edu.vn/"><img src="assets/images/trungtam.png" alt="Thư viện số">
                    <p>Thư viện số</p>
                </a>
            </div>
            <div class="col-12 col-md-2 hvr-overline-from-center">
                <a href="./hoat-dong-doan"><img src="assets/images/hdd.png" alt="Hoạt động đoàn">
                    <p>Hoạt động đoàn</p>
                </a>
            </div>
            <div class="col-12 col-md-2 hvr-overline-from-center">
                <a href="./cong-doan"><img src="assets/images/cd.png" alt="Công đoàn">
                    <p>Công đoàn</p>
                </a>
            </div>
        </div>
    </div>
</section>
<section id="news">
    <div class="banner">
        <h2>Tin tức</h2>
    </div>
    <div class="container">
        <div class="row"><?php foreach($News as $n):?>
            <div class="col-12 col-md-3" style="margin-bottom: 10px;">
                <div class="card">
                    <img class="object-fit-cover" src="<?= $n['img']!=''? $n['img']:'assets/images/logo.png'?>" class="card-img-top" alt="">
                    <div class="card-body">
                        <a href="./tin-tuc/<?= $n['link_description']?>">
                            <small class="text-body-secondary">(<?= $n['d_poss']?>)</small>
                            <h4 class="card-title"><?= $n['heading']?></h4>
                            <p class="card-text"><?= $n['summarize']?></p>
                        </a>

                    </div>
                </div>
            </div>
            <?php endforeach;?>
        </div>
    </div>
    <div class="more">
        <a type="button" class="btn btn-info fw-bold hvr-radial-out" href="./tin-tuc" style="color:#fff;">Xem thêm</a>
    </div>
</section>
<section id="anouncements">
    <div class="banner">
        <h2>Thông báo</h2>
    </div>
    <div class="container">
        <div class="row">
            <?php foreach($Anouncements as $anounce):?>
            <div class="col-12 col-md-3" style="margin-bottom: 10px;">
                <div class="card text-center">
                    <img class="object-fit-cover" src="<?= $anounce['img']!=''? $anounce['img']:'assets/images/thongbao.png'?>" class="card-img-top" alt="">
                    <div class="card-body">
                        <a href="./thong-bao/<?= $anounce['link_description']?>">
                            <h5 class="card-title"><?= $anounce['heading']?></h5>
                        </a>
                        <span style='font-size: 12px;'>(<?= $anounce['d_poss']?>)</span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </div>
    <div class="more">
    <a type="button" class="btn btn-info fw-bold hvr-radial-out" href="./thong-bao" style="color:#fff;">Xem thêm</a>
    </div>
</section>
<section id="admissions">
    <div class="banner">
        <h2>Tuyển sinh - Tuyển dụng</h2>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-7">
                <?php if($Admissions!=null):?>
                <?php foreach($Admissions as $a): ?>
                <div class="card border-light mb-3">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <img class="object-fit-cover" src="<?= $a['img']!=''? $a['img']:'assets/images/thongbao.png'?>" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <a href="./tuyen-sinh/<?=$a['link_description']?>">
                                    <h5 class="card-title"><?= $a['heading']?>
                                    </h5>
                                </a>
                                <p class="card-text"><small class="text-body-secondary"><?= $a['d_poss']?></small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
                <?php endif;?>
                

            </div>
            <div class="col-12 col-md-5">
                <span><i class="fa-solid fa-user-graduate"></i><br />Thông tin tuyển dụng</span><br /><br />
                <?php if($Recruitments):?>
                <?php foreach($Recruitments as $r):?>
                <div class='card'>
                    <div class='card-body'>
                    <i class="fa-solid fa-calendar"></i> <small><?=$r['d_poss']?></small> 
                    <h4> <a href="./tuyen-dung/<?=$r['link_description']?>"><?= $r['heading']?></a> </h4>
                    </div>
                </div>
                <hr/>
                <?php endforeach;?>
                <?php endif;?>
            </div>
        </div>
    </div>
</section>
<section id="videos">
    <div class="banner">
        <h2>Videos</h2>
    </div>
    <div class="container">
        <div class="row">
            <?php if($Videos!=null):?>
            <?php foreach($Videos as $v):?>
            <div class="col-12 col-md-4">
                <?= $v['file'] ?>
            </div>
            <?php endforeach;?>
            <?php else:?>
            <div class='text-center'><p class='text-uppercase fs-3 fw-bold'>KHÔNG TÌM THẤY VIDEO</p></div>
            <?php endif;?>
        </div>
    </div>
</section>