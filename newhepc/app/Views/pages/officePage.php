<?= view('layouts/banner', ["Banner" => $Banner]) ?>
<?php if ($image): ?>
    <section id="office-image">
        <img src="<?= $image ?>" width="100%">
    </section>
<?php endif; ?>
<section id="first-office-news">
    <div class="banner">
        <h2>
            <?= $f_name_catalogue ?>
        </h2>
    </div>
    <div class="container">
        <div class="row">
            <?php foreach ($f_news as $n): ?>
                <div class="col-12 col-md-3 mb-3">
                    <div class="card" style="width: 100%; height:250px">
                        <img src="<?= $n['img'] != '' ? $n['img'] : 'assets/images/logo.png' ?>"
                            class="card-img-top object-fit-cover" alt="">
                        <div class="card-body">
                            <a href="<?= $link . $n['link_description'] ?>">
                                <p class="card-text">
                                    <small>
                                        <?= $n['d_poss'] ?>
                                    </small>
                                </p>
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
        </div>
    </div>
    <div class="more mb-3">
        <a href="./cong-doan/<?= $f_link ?>" type="button" class="btn btn-info hvr-radial-out">Xem thêm</a>
    </div>
</section>
<section id="second-office-news">
    <div class="banner">
        <h2>
            <?= $s_name_catalogue ?>
        </h2>
    </div>
    <div class="container">
        <div class="row">
            <?php foreach ($s_news as $n): ?>
                <div class="col-12 col-md-3 mb-3">
                    <div class="card" style="width: 100%; height:250px">
                        <img src="<?= $n['img'] != '' ? $n['img'] : 'assets/images/logo.png' ?>"
                            class="card-img-top object-fit-cover" alt="">
                        <div class="card-body">
                            <a href="<?= $link . $n['link_description'] ?>">
                                <p class="card-text">
                                    <small>
                                        <?= $n['d_poss'] ?>
                                    </small>
                                </p>
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
        </div>
    </div>
    <div class="more pb-3">
        <a href="./cong-doan/<?= $s_link ?>" type="button" class="btn btn-info hvr-radial-out">Xem thêm</a>
    </div>
</section>

<section id="image-catalogue" class="pb-3">
    <div class="banner">
        <h2>
            Hình ảnh
        </h2>
    </div>
    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class=row>
                    <div class="card col-4 border-0 p-2">
                        <a href="" data-bs-toggle="modal" data-bs-target="#imageModal"
                            data-bs-whatever="https://www.simplilearn.com/ice9/free_resources_article_thumb/what_is_image_Processing.jpg"><img
                                src="https://www.simplilearn.com/ice9/free_resources_article_thumb/what_is_image_Processing.jpg"
                                class="d-block w-100" alt="..."></a>
                    </div>
                    <div class="card col-4 border-0 p-2">
                        <a href="" data-bs-toggle="modal" data-bs-target="#imageModal"
                            data-bs-whatever="https://dfstudio-d420.kxcdn.com/wordpress/wp-content/uploads/2019/06/digital_camera_photo-1080x675.jpg"><img
                                src="https://dfstudio-d420.kxcdn.com/wordpress/wp-content/uploads/2019/06/digital_camera_photo-1080x675.jpg"
                                class="d-block w-100" alt="..."></a>
                    </div>
                    <div class="card col-4 border-0 p-2">
                        <a href="" data-bs-toggle="modal" data-bs-target="#imageModal"
                            data-bs-whatever="https://imgv3.fotor.com/images/blog-cover-image/part-blurry-image.jpg"><img
                                src="https://imgv3.fotor.com/images/blog-cover-image/part-blurry-image.jpg"
                                class="d-block w-100" alt="..."></a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class=row>
                    <div class="card col-4 border-0 p-2">
                        <a href="" data-bs-toggle="modal" data-bs-target="#imageModal"
                            data-bs-whatever="https://www.simplilearn.com/ice9/free_resources_article_thumb/what_is_image_Processing.jpg"><img
                                src="https://www.simplilearn.com/ice9/free_resources_article_thumb/what_is_image_Processing.jpg"
                                class="d-block w-100" alt="..."></a>
                    </div>
                    <div class="card col-4 border-0 p-2">
                        <a href="" data-bs-toggle="modal" data-bs-target="#imageModal"
                            data-bs-whatever="https://dfstudio-d420.kxcdn.com/wordpress/wp-content/uploads/2019/06/digital_camera_photo-1080x675.jpg"><img
                                src="https://dfstudio-d420.kxcdn.com/wordpress/wp-content/uploads/2019/06/digital_camera_photo-1080x675.jpg"
                                class="d-block w-100" alt="..."></a>
                    </div>
                    <div class="card col-4 border-0 p-2">
                        <a href="" data-bs-toggle="modal" data-bs-target="#imageModal"
                            data-bs-whatever="https://imgv3.fotor.com/images/blog-cover-image/part-blurry-image.jpg"><img
                                src="https://imgv3.fotor.com/images/blog-cover-image/part-blurry-image.jpg"
                                class="d-block w-100" alt="..."></a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class=row>
                    <div class="card col-4 border-0 p-2">
                        <a href="" data-bs-toggle="modal" data-bs-target="#imageModal"
                            data-bs-whatever="https://www.simplilearn.com/ice9/free_resources_article_thumb/what_is_image_Processing.jpg"><img
                                src="https://www.simplilearn.com/ice9/free_resources_article_thumb/what_is_image_Processing.jpg"
                                class="d-block w-100" alt="..."></a>
                    </div>
                    <div class="card col-4 border-0 p-2">
                        <a href="" data-bs-toggle="modal" data-bs-target="#imageModal"
                            data-bs-whatever="https://dfstudio-d420.kxcdn.com/wordpress/wp-content/uploads/2019/06/digital_camera_photo-1080x675.jpg"><img
                                src="https://dfstudio-d420.kxcdn.com/wordpress/wp-content/uploads/2019/06/digital_camera_photo-1080x675.jpg"
                                class="d-block w-100" alt="..."></a>
                    </div>
                    <div class="card col-4 border-0 p-2">
                        <a href="" data-bs-toggle="modal" data-bs-target="#imageModal"
                            data-bs-whatever="https://imgv3.fotor.com/images/blog-cover-image/part-blurry-image.jpg"><img
                                src="https://imgv3.fotor.com/images/blog-cover-image/part-blurry-image.jpg"
                                class="d-block w-100" alt="..."></a>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <?= view('modal/image_modal') ?>
</section>