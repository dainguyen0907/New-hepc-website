<?php if ($News): ?>
    <?php foreach ($News as $n): ?>
        <div class="col-12 col-md-4">
            <div class="card" style="width: 100% ;">
                <img class="object-fit-cover"
                    src='<?= $n['img'] != "" ?  $n['img'] : "assets/images/logo.png" ?>'
                    class="card-img-top" alt="...">
                <div class="card-body">
                    <a href="./<?= $link?>/<?= $n['link_description'] ?>">
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
    <?php endforeach; ?>
<?php endif; ?>