<?php if ($New != null): ?>
    <div class="new-detail">
        <h3>
            <?= $New['heading'] ?>
        </h3>
        <p class="text-end">(
            <?= $New['d_poss'] ?>)
        </p>
        <?= $New['content'] ?>
        <?php if($New['file']!=null):?>
            <iframe src="https://hepc.edu.vn/<?=$New['file']?>" width="100%" height="1080px"></iframe>
        <?php endif;?>
    </div>
    <div class="mb-3 text-end">Lượt xem:<?=$New['view']?></div>
<?php endif; ?>
<hr />
<?php if(isset($More)):?>
<p class="fw-bold">Xem thêm:</p>
<ul>
    <?php foreach ($More as $n): ?>
        <li> <a href="./<?= $link?>/<?= $n['link_description'] ?>" class='text-black'><?= $n['heading'] ?></a> </li>
    <?php endforeach; ?>
</ul>
<?php endif;?>