<div class='login-form text-center p-5'>
    <form action="./dang-nhap" method="post">
        <img class="mb-3" src="./assets/images/logoEVNSPC.png" alt="" width="100" height="100">
        <?= view('alerts/alert')?>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
            <label for="floatingInput">Email</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
            <label for="floatingPassword">Mật khẩu</label>
        </div>
        
        <div class="my-3 text-start">
            <a href="#">Quên mật khẩu ?</a>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">ĐĂNG NHẬP</button>
    </form>
</div>