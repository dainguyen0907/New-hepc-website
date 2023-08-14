<header class="dash-toolbar">
    <a href="javascript::void()" class="menu-toggle">
        <i class="fas fa-bars"></i>
    </a>
    <a href="javascript::void()" class="searchbox-toggle">
        <i class="fas fa-search"></i>
    </a>
    
    <div class="tools">
        <div class='fs-5 text-center d-flex align-items-center'> Xin chào, <?= session('userLogin')?session('userLogin')['user']:''?></div>
        <div class="dropdown tools-item mx-3">
            <a href="#" class="nav-link dropdown-toggle">
                <i class="fas fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                <a href="./admin/changepassword" class="dropdown-item">Đổi mật khẩu</a>
                <a class="dropdown-item" href="thoat">Đăng xuất</a>
            </div>
        </div>
    </div>
</header>