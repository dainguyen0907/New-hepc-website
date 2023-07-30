<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <base href="<?= base_url() ?>">
    <title>
        <?= $title ?>
    </title>
    <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600|Open+Sans:400,600,700" rel="stylesheet"> 
    <link rel="stylesheet" href="assets/css/easion.min.css">
    <link rel="stylesheet" href="assets/css/myStyle.css">
    <?php foreach ($cssLib as $cssLink): ?>
        <link rel="stylesheet" href="<?php echo $cssLink ?>">
    <?php endforeach ?>
</head>

<body>
    <div class="dash">
        <?= $leftMenu ?>
        <div class="dash-app">
            <?= $header ?>
            <?= $content ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="assets/js/jquery-3.7.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <?php foreach ($jsLib as $jsLink): ?>
        <script src="<?php echo $jsLink ?>"></script>
    <?php endforeach ?>
    <script src="assets/js/easion.js"></script>
    <script src="assets/js/dataTable.js"></script>
</body>

</html>