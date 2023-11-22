<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="user-scalable=no, width=device-width, maximum-scale=1, minimum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="title" content="Trường Cao đẳng Điện lực Thành phố Hồ Chí Minh">
    <meta name="description"
        content="Trường Cao đẳng Điện lực Thành phố Hồ Chí Minh đào tạo trình độ trung cấp, cao đẳng các ngành về điện như: Công nghệ Kỹ thuật Điện – Điện tử, Điện công nghiệp, Lắp đặt bảo trì hệ thống năng lượng tái tạo, Công nghệ Kỹ thuật Điều khiển và Tự động hóa,… ">
    <base href="<?= base_url(); ?>">
    <link rel="icon" href="assets/images/LogoEVNSPC.png" type="image/icon type">
    <title>
        <?= $title; ?> - Trường Cao đẳng Điện lực Thành phố Hồ Chí Minh
    </title>
    <link rel="stylesheet" href="assets/css/hover-min.css" media="all">

    <link href="assets/fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="assets/fontawesome/css/brands.css" rel="stylesheet">
    <link href="assets/fontawesome/css/solid.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/css/myStyle.css">
    <link rel="stylesheet" href="assets/css/color.css">
</head>

<body>
    <?= $header ?>
    <?= $page ?>
    <?= $footer ?>
    <nav id="float-banner" class="text-center text-primary">
        <div class="w-100 h-100">
            <a href="https://www.facebook.com/DaoTaoHEPC/" target="blank" title="Trang facebook">
                <img src="assets/images/facebook.png" alt="Facebook"/></a>
        </div>
        <small class="fw-bold">Fanpage</small>
        <div class="w-100 h-100 mt-2">
            <a href="#"><img src="assets/images/facebook-messenger.png" alt="Messenger"/></a>
        </div>
        <small class="fw-bold">Messenger</small>
        <div class="w-100 h-100 mt-2">
            <a href="https://tuyensinh.hepc.edu.vn" target="blank" title="Tuyển sinh online"><img src="assets/images/write.png" alt="Tuyển sinh"/></a>
        </div>
        <small class="fw-bold">Tuyển sinh<br/>online</small>
        <div class="w-100 h-100 mt-2">
            <a href="https://vanbang.gdnn.gov.vn/" target="blank" title="Tra cứu văn bằng"><img src="assets/images/tracuu.png" alt="Tra cứu"/></a>
        </div>
        <small class="fw-bold">Tra cứu<br/>văn bằng</small>
    </nav>
    <script src="assets/js/jquery-3.7.0.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <?php foreach ($jsLib as $jsLink): ?>
        <script src="<?php echo $jsLink ?>"></script>
    <?php endforeach ?>
    <script src="assets/js/myScript.js"></script>
</body>

</html>