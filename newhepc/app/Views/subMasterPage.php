<?= view('layouts/banner', ["Banner" => $Banner]) ?>
<section id="category-list">
    <div class="container">
        <div class="row">
            <div class="all-news col-12 col-md-8">
                <div class="row">
                    <?= $content?>
                </div>

                <?php if($Pager):?>
                <?= $Pager->links('default', 'custom_pagination') ?>
                <?php endif;?>

            </div>
            <div class="hot-news col-12 col-md-4">
                <?= $rightBanner?>
            </div>
        </div>
    </div>
</section>