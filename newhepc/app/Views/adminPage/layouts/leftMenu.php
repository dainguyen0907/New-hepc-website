<div class="dash-nav dash-nav-dark">
    <header>
        <a href="javascript::void()" class="menu-toggle">
            <i class="fas fa-bars"></i>
        </a>
        <a href="<?= base_url() . "admin" ?>" class="easion-logo"> Quản trị</span></a>
    </header>
    <nav class="dash-nav-list">
        <a href="<?= base_url() . "admin" ?>" class="dash-nav-item">
            <i class="fas fa-home"></i> Thống kê </a>
        <?php if(session('userLogin')['id_q']==1):?>
        <div class="dash-nav-dropdown">
            <a href="javascript::void(0)" class="dash-nav-item dash-nav-dropdown-toggle">
                <i class="fa-solid fa-gear"></i> Quản trị </a>
            <div class="dash-nav-dropdown-menu">
                <a href="./admin/management/user" class="dash-nav-dropdown-item">Tài khoản</a>
                <a href="<?= base_url() . "" ?>" class="dash-nav-dropdown-item">Phòng ban</a>
                <a href="<?= base_url() . "" ?>" class="dash-nav-dropdown-item">Chuyên mục</a>
                <a href="<?= base_url() . "" ?>" class="dash-nav-dropdown-item">Bài viết</a>
                <a href="<?= base_url() . "" ?>" class="dash-nav-dropdown-item">Banner Quảng cáo</a>
                <a href="<?= base_url() . "" ?>" class="dash-nav-dropdown-item">Video clip</a>
                <a href="./admin/management/history" class="dash-nav-dropdown-item">Nhật ký</a>
                <a href="<?= base_url() . "" ?>" class="dash-nav-dropdown-item">Ảnh hoạt động</a>
            </div>
        </div>
        <?php endif;?>
        <div class="dash-nav-dropdown">
            <a href="javascript::void(0)" class="dash-nav-item dash-nav-dropdown-toggle">
                <i class="fa-solid fa-pen-to-square"></i> Viết bài </a>
            <div class="dash-nav-dropdown-menu">
                <a href="<?= base_url() . "" ?>" class="dash-nav-dropdown-item">Danh sách</a>
                <a href="<?= base_url() . "" ?>" class="dash-nav-dropdown-item">Viết bài</a>
            </div>
        </div>
        <div class="dash-nav-dropdown">
            <a href="javascript::void(0)" class="dash-nav-item dash-nav-dropdown-toggle">
                <i class="fa-solid fa-image"></i> Ảnh hoạt động </a>
            <div class="dash-nav-dropdown-menu">
                <a href="<?= base_url() . "" ?>" class="dash-nav-dropdown-item">Danh sách</a>
                <a href="<?= base_url() . "" ?>" class="dash-nav-dropdown-item">Thêm ảnh</a>
            </div>
        </div>
        <?php if(session('userLogin')['id_q']==1||session('userLogin')['id_q']==2):?>
        <div class="dash-nav-dropdown">
            <a href="javascript::void(0)" class="dash-nav-item dash-nav-dropdown-toggle position-relative">
                <span
                    class="position-absolute top-0 start-100 translate-middle badge border border-light rounded-circle bg-danger p-2"><span
                        class="visually-hidden">unread messages</span></span>
                <i class="fa-solid fa-check-to-slot"></i> Kiểm duyệt</a>
            <div class="dash-nav-dropdown-menu">
                <a href="<?= base_url() . "" ?>" class="dash-nav-dropdown-item">
                    <span class=" badge rounded-pill bg-danger">99</span> Bài viết</a>
                <a href="<?= base_url() . "" ?>" class="dash-nav-dropdown-item">
                    <span class=" badge rounded-pill bg-danger">99</span>Ảnh hoạt động</a>
            </div>
        </div>
        <?php endif;?>


    </nav>
</div>