<header class="dash-toolbar">
    <a href="javascript::void()" class="menu-toggle">
        <i class="fas fa-bars"></i>
    </a>
    <a href="javascript::void()" class="searchbox-toggle">
        <i class="fas fa-search"></i>
    </a>
    <form class="searchbox" action="javascript::void()">
        <a href="javascript::void()" class="searchbox-toggle"> <i class="fas fa-arrow-left"></i> </a>
        <button type="submit" class="searchbox-submit"> <i class="fas fa-search"></i> </button>
        <input type="text" class="searchbox-input" placeholder="Nhập thông tin tìm kiếm">
    </form>
    <div class="tools">
        <div class='fs-5 text-center'> Xin chào ,<?= session('userLogin')?session('userLogin')['name']:''?></div>
        <div class="dropdown tools-item">
            <a href="#" class="" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                <a class="dropdown-item" data-toggle="modal" data-target="#changePasswordModal">Đổi mật khẩu</a>
                <a class="dropdown-item" href="logout">Đăng xuất</a>
            </div>
        </div>
    </div>
</header>