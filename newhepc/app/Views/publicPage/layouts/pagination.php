<?php $pager->setSurroundCount(0) ?>
<div class="news-pagination">
    <nav aria-label="...">
        <ul class="pagination">
            <?php if ($pager->hasPrevious()): ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $pager->getPrevious() ?>">< </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="<?= $pager->getFirst() ?>"><< </a>
                </li>
            <?php endif; ?>

            <?php if ($pager->getCurrentPageNumber() > 2): ?>
                <li class="page-item">
                    <span class="page-link" href="#">...</span>
                </li>
            <?php endif;?>
            <?php if ($pager->getCurrentPageNumber() != 1): ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $pager->getPrevious() ?>"><?= $pager->getPreviousPageNumber() ?></a>
                </li>
            <?php endif; ?>
            <li class="page-item active" aria-current="page">
                <a class="page-link" href="javascript:window.location.reload(true)"><?= $pager->getCurrentPageNumber() ?></a>
            </li>
            <?php if ($pager->getCurrentPageNumber() != $pager->getPageCount()): ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $pager->getNext() ?>"><?= $pager->getNextPageNumber() ?></a>
                </li>
                <?php if ($pager->getPageCount()>3): ?>
                <li class="page-item">
                    <span class="page-link" href="#">...</span>
                </li>
            <?php endif;?>
            <?php endif; ?>
            
            <?php if ($pager->hasNext()): ?>
                <li class="page-item ">
                    <a class="page-link" href="<?= $pager->getLast() ?>">>></a>
                </li>
                <li class="page-item ">
                    <a class="page-link" href="<?= $pager->getNext() ?>">></a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>