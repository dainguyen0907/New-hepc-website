<?php if (session('errorsMsg')): ?>
    <?php foreach (session('errorsMsg') as $error): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $error ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <?php break; ?>
<?php endforeach ?>
<?php endif ?>
<?php if (session('successMsg')): ?>
    <?php foreach (session('successMsg') as $success): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $success ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php break; ?>
<?php endforeach ?>
<?php endif ?>