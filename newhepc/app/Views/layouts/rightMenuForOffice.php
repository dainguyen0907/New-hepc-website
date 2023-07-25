<div class="the-current-date fst-italic text-center">
        <?php
        $date = date('d/m/y H:i:s', time());
        $today = DateTime::createFromFormat('d/m/y H:i:s', $date);
        $zone_Asia_Ho_Chi_Minh = new DateTimeZone('Asia/Ho_Chi_Minh');
        $today->setTimezone($zone_Asia_Ho_Chi_Minh);
        if ($today): ?>
                <?= $today->format('l, d/m/y H:i:s') ?> GMT+ 7
        <?php endif; ?>
</div>
<div class="list-group">
        <?php if($catalogues):
            foreach($catalogues as $c):?>
        <a href="#" class="list-group-item list-group-item-secondary text-black"><i
                        class="fa-solid fa-angles-right"></i> <?= $c['name']?></a>
            <?php endforeach;?>
        <?php endif; ?>
</div>
<div class="list-group list-group-flush">
        <span class="list-group-item list-group-item-border text-center fw-bold fs-4">CHUYÊN MỤC</span>
        <a href="./gioi-thieu/So-do-to-chuc" class="list-group-item list-group-item-border text-black"><i
                        class="fa-solid fa-angles-right"></i> Giới thiệu</a>
        <a href="./tin-tuc" class="list-group-item list-group-item-border text-black"><i
                        class="fa-solid fa-angles-right"></i> Tin tức</a>
        <a href="./thong-bao" class="list-group-item list-group-item-border text-black"><i
                        class="fa-solid fa-angles-right"></i> Thông báo</a>
        <a href="./tuyen-sinh" class="list-group-item list-group-item-border text-black"><i
                        class="fa-solid fa-angles-right"></i> Tuyển sinh</a>
        <a href="./tuyen-dung" class="list-group-item list-group-item-border text-black"><i
                        class="fa-solid fa-angles-right"></i> Tuyển dụng</a>
        <a href="./hoat-dong-doan" class="list-group-item list-group-item-border text-black"><i
                        class="fa-solid fa-angles-right"></i> Hoạt động đoàn</a>
        <a href="./cong-doan" class="list-group-item list-group-item-border text-black"><i
                        class="fa-solid fa-angles-right"></i> Công đoàn</a>
</div>

<div class=" list-group  list-group-flush newest-announcement">
        <span class="list-group-item list-group-item-border text-center fw-bold fs-4">THÔNG BÁO MỚI NHẤT</span>
        <?php foreach ($Newest as $n): ?>
                <a href="./thong-bao/<?= $n['link_description'] ?>" class="list-group-item list-group-item-border text-black"><i
                                class="fa-brands fa-hotjar text-red"></i>
                        <?= $n['heading'] ?>
                </a>
        <?php endforeach; ?>

        <a href="./anounce" class="list-group-item list-group-item-border text-black text-end"><i
                        class="fa-solid fa-angles-right"></i> Xem thêm</a>
</div>