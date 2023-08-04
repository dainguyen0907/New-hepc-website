<div class="dash-nav dash-nav-dark">
    <header>
        <a href="javascript::void()" class="menu-toggle">
            <i class="fas fa-bars"></i>
        </a>
        <a href="#" class="easion-logo"> Trang chủ</span></a>
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
                <a href="./admin/management/group" class="dash-nav-dropdown-item">Phòng ban</a>
                <a href="./admin/management/catalogue" class="dash-nav-dropdown-item">Chuyên mục</a>
                <a href="<?= base_url() . "" ?>" class="dash-nav-dropdown-item">Bài viết</a>
                <a href="./admin/management/banner" class="dash-nav-dropdown-item">Banner Quảng cáo</a>
                <a href="./admin/management/video" class="dash-nav-dropdown-item">Video clip</a>
                <a href="./admin/management/picture" class="dash-nav-dropdown-item">Ảnh hoạt động</a>
                <a href="./admin/management/history" class="dash-nav-dropdown-item">Nhật ký</a>   
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
                <a href="./admin/Mypicture" class="dash-nav-dropdown-item">Ảnh cá nhân</a>
                <a href="./admin/control/Grouppicture" class="dash-nav-dropdown-item">Ảnh phòng ban</a>
            </div>
        </div>
        <?php if(session('userLogin')['id_q']==1||session('userLogin')['id_q']==2):?>
        <div class="dash-nav-dropdown">
            <a href="javascript::void(0)" class="dash-nav-item dash-nav-dropdown-toggle position-relative">
                <?php if(count($cencor_pic)>0):?>
                <span class="position-absolute top-0 start-100 translate-middle badge border border-light rounded-circle bg-danger p-2"><span
                        class="visually-hidden">unread messages</span></span>
                <?php endif;?>
                <i class="fa-solid fa-check-to-slot"></i> Kiểm duyệt</a>
            <div class="dash-nav-dropdown-menu">
                <a href="./admin/control/Censorpicture" class="dash-nav-dropdown-item">
                <?php if(count($cencor_pic)>0):?>
                    <span class=" badge rounded-pill bg-danger"><?=count($cencor_pic)?></span> 
                <?php endif; ?>Ảnh hoạt động</a>
                <a href="<?= base_url() . "" ?>" class="dash-nav-dropdown-item">
                    <span class=" badge rounded-pill bg-danger">99</span>Bài viết</a>
            </div>
        </div>
        <?php endif;?>


    </nav>
</div>