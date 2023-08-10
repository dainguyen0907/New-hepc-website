<div class="input-group m-3">
    <input type="text" class="form-control" placeholder="Nhập từ khóa tìm kiếm" id="txt-search">
    <button class="btn btn-outline-primary text-center" type="button" id='btn-search'><i class="fa-solid fa-magnifying-glass"></i></button>
</div>
<?php if (isset($count)): ?>
    <p class="mb-0 p-1">Đã tìm được
        <?= $count ?> kết quả với từ khóa:
        <?= $key_word ?>
    </p>
<?php endif; ?>
<?php if ($News): ?>
    <?php foreach ($News as $n): ?>
        <div class="card" width='100%'>
            <div class="row g-0">
                <div class="col-md-4">
                    <img class="object-fit-cover" src='<?= $n['img'] != "" ? $n['img'] : "assets/images/logo.png" ?>'
                        class="card-img-top" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <a href="./<?= $link ?>/<?= $n['link_description'] ?>">
                            <p class="card-text"><small class="text-body-secondary">(
                                    <?= $n['d_poss'] ?>)
                                </small></p>
                            <h4 class="text-center">
                                <?= $n['heading'] ?>
                            </h4>
                            <p class="card-text">
                                <?= $n['summarize'] ?>
                            </p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>