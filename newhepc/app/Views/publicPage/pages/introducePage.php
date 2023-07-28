<?= view('publicPage/layouts/banner', ["Banner" => $Banner]) ?>
<section id="category-list">
    <div class="container">
        <div class="row">
            <div class="all-news col-12 col-md-8">
                <?php if ($detail != null): ?>
                    <div class="new-detail">
                        <h3>
                            <?= $detail['heading'] ?>
                        </h3>
                        <p class="text-end">(<?= $detail['d_poss'] ?>)
                        </p>
                        <?= $detail['content'] ?>
                    </div>
                <?php endif; ?>

            </div>
            <div class="hot-news col-12 col-md-4">
                <div class="introduce-area list-group list-group-flush">
                    <?php foreach ($introduces as $n): ?>
                        <a class="text-black list-group-item" href="gioi-thieu/<?= $n['link_description']?>"><i class="fa-solid fa-angles-right"></i> <?= $n['heading'] ?></a>
                    <?php endforeach; ?>
                </div>
                
                
            </div>
        </div>
    </div>
</section>