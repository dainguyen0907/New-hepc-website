<div class='login-form text-center p-5'>
    <form action="./dang-nhap" method="post">
        <img class="mb-3" src="./assets/images/logoEVNSPC.png" alt="" style="width:100px!important;height:100px">

        <?= view('alerts/alert') ?>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
            <label for="floatingInput">Email</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
            <label for="floatingPassword">Mật khẩu</label>
        </div>
        <?php if ($countLogin > 3): ?>
            <div class="form-floating my-3 ">
                <div class="g-recaptcha" data-sitekey="6LciBMsoAAAAAHa-1rjo8PT2ix2pxNT70JywBmCv"></div>
            </div>
        <?php endif; ?>
        <div class="my-3 text-start">
            <a href="./quen-mat-khau">Quên mật khẩu ?</a>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">ĐĂNG NHẬP</button>
    </form>
</div>