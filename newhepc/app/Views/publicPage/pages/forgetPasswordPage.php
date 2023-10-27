<div class='login-form text-center p-5'>
    <form action="./quen-mat-khau" method="post">
        <img class="mb-3" src="./assets/images/logoEVNSPC.png" alt="" style="width:100px!important;height:100px">

        <?= view('alerts/alert') ?>
        <div class="mb-3">
            <strong>Hãy nhập email đã đăng ký.</strong>
        </div>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
            <label for="floatingInput">Email</label>
        </div>
        <div class="form-floating mb-3 ">
            <div class="g-recaptcha" data-sitekey="6Lf47M0oAAAAAE88yXuT3fCIeYZTUHcR6Nnjc9j_"></div>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Xác nhận</button>
    </form>
</div>