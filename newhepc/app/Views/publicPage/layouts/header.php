<section id="header">
    <div class="container">
      <div class="top-header">
        <div class="top-header-element">
          <a href="https://smartevn.evn.com.vn/" target="_blank"><i class="fa-solid fa-person-chalkboard"></i> Giáo viên</a>
          <a href="https://daotao.hepc.edu.vn/" target="_blank"><i class="fa-solid fa-chalkboard-user"></i> Sinh viên</a>
          <a href="https://login.live.com/" target="_blank"><i class="fa-solid fa-envelope"></i> Email</a>
          <?php if(session('userLogin')):?>
            <a href="./admin"><i class="fa-solid fa-gear"></i> Quản trị</a>
            <a href="./thoat"><i class="fa-solid fa-arrow-right-from-bracket"></i> Thoát</a>
          <?php else:?>
            <a href="./dang-nhap"><i class="fa-solid fa-lock"></i> Đăng nhập</a>
          <?php endif?>
        </div>
      </div>
      <div class="company-name row">
        <div class="col-xl-1 col-lg-2 col-3 h-auto">
          <a href="#"><img src="assets/images/logoEVNSPC.png" alt="HEPC" class="w-100"/></a>
        </div>
        <div class="col-xl-11 col-lg-10 col-9 h-auto d-flex">
          <div class="text-center m-auto">
            <p class="text-light fw-bolder text-uppercase fs-6">TRƯỜNG CAO ĐẲNG ĐIỆN LỰC THÀNH PHỐ HỒ CHÍ MINH<br />
              <span class="text-orange fs-5">HO CHI MINH ELECTRIC POWER COLLEGE</span>
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="menu-bar">
    <div class="container">
      <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid" style="margin: -7px;">
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
            aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <ul class="navbar-nav me-auto my-2 my-lg-0" style="--bs-scroll-height: 100px; margin:auto">
                <li class="nav-item hvr-sweep-to-right">
                  <a class="nav-link" aria-current="page" href="./"><i class="fa-solid fa-house"></i></a>
                </li>
                <li class="nav-item dropdown">
                  <a href="javascript:window.location.reload(true)" class="nav-link dropdown-toggle hvr-sweep-to-right" >
                    Giới thiệu
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item hvr-sweep-to-right" href="./gioi-thieu/So-do-to-chuc">Sơ đồ tổ chức</a></li>
                    <li><a class="dropdown-item hvr-sweep-to-right" href="./gioi-thieu/Lich-su-hinh-thanh-Truong-Cao-dang-Dien-luc-Thanh-pho-Ho-Chi-Minh">Lịch sử hình thành</a></li>
                    <li><a class="dropdown-item hvr-sweep-to-right" href="./gioi-thieu/Thanh-tich-giang-day-va-nghien-cuu-(P1)">Thành tích</a></li>
                    <li><a class="dropdown-item hvr-sweep-to-right" href="./gioi-thieu/Tam-nhin-va-su-mang">Tầm nhìn và sứ mạng</a></li>
                  </ul>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle hvr-sweep-to-right" href="javascript:window.location.reload(true)">Chuyên trang</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item hvr-sweep-to-right"
                      href="./thoi-khoa-bieu">Thời khóa biểu</a></li>
                    <li><a class="dropdown-item hvr-sweep-to-right"
                      href="./lich-thi">Lịch thi</a></li>
                    <li><a class="dropdown-item hvr-sweep-to-right"
                      href="./bieu-mau">Biểu mẫu</a></li>
                    <li><a class="dropdown-item hvr-sweep-to-right"
                      href="./ba-cong-khai">3 công khai</a></li>
                  </ul>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle hvr-sweep-to-right" href="javascript:window.location.reload(true)">
                    Khoa chuyên ngành
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item hvr-sweep-to-right"
                        href="./khoa-htd">Khoa hệ thống điện</a></li>
                    <li><a class="dropdown-item hvr-sweep-to-right"
                        href="./khoa-ktcs">Khoa kỹ thuật cơ sở</a></li>
                    <li><a class="dropdown-item hvr-sweep-to-right"
                        href="./khoa-dcn">Khoa điện công nghiệp</a></li>
                    <li><a class="dropdown-item hvr-sweep-to-right"
                        href="./khoa-khcb-kt">Khoa khoa học cơ bản - kinh tế</a></li>
                    <li><a class="dropdown-item hvr-sweep-to-right"
                        href="./khoa-cndt-tdh">Khoa công nghệ Điện tử - Tự động hóa</a></li>
                    <li><a class="dropdown-item hvr-sweep-to-right"
                        href="./khoa-dtnc">Khoa đào tạo nâng cao</a></li>
                  </ul>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle hvr-sweep-to-right" href="javascript:window.location.reload(true)">
                    Phòng - Trung tâm
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item hvr-sweep-to-right"
                      href="./phong-dao-tao">Phòng Đào tạo</a></li>
                    <li><a class="dropdown-item hvr-sweep-to-right"
                      href="./phong-to-chuc">Phòng Tổ chức</a></li>
                    <li><a class="dropdown-item hvr-sweep-to-right"
                      href="./phong-tai-chinh">Phòng Kế hoạch - Tài chánh</a></li>
                    <li><a class="dropdown-item hvr-sweep-to-right"
                      href="./phong-qlkh">Phòng quản lý Kế hoạch - Quan hệ Quốc tế</a></li>
                    <li><a class="dropdown-item hvr-sweep-to-right"
                      href="./phong-qlhssv">Phòng quản lý Học sinh - Sinh viên</a></li>
                    <li><a class="dropdown-item hvr-sweep-to-right"
                      href="./phong-quan-tri">Phòng quản trị</a></li>
                    <li><a class="dropdown-item hvr-sweep-to-right"
                      href="./phong-tt-nangluong">Trung tâm Công nghệ Năng lượng</a></li>
                    <li><a class="dropdown-item hvr-sweep-to-right"
                      href="./phong-nn-tt">Trung tâm Ngoại ngữ Tin học</a></li>
                  </ul>
                </li>
                <li class="nav-item hvr-sweep-to-right">
                  <a class="nav-link" href="https://tuyensinh.hepc.edu.vn/" target="_blank">Tuyển sinh</a>
                </li>
                
                <li class="nav-item hvr-sweep-to-right">
                  <a class="nav-link" href="https://vanbang.gdnn.gov.vn/" target="_blank">Tra cứu văn bằng</a>
                </li>
                <li class="nav-item hvr-sweep-to-right">
                  <a class="nav-link" href="./lien-he">Liên hệ</a>
                </li>
                <li class="nav-item hvr-sweep-to-right">
                  <a class="nav-link" href="./tim-kiem"><i class="fa-solid fa-magnifying-glass"></i></a>
                </li>
              </ul>
            </div>

          </div>
        </div>
      </nav>
    </div>
  </section>