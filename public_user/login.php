 <?php require_once('..\kresources\config.php'); ?>
<?php if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
  include(TEMPLATE_FRONT . DS . 'header_admin.php');
} else {
  include(TEMPLATE_FRONT . DS . 'header.php');
} ?>
  <div class="limiter">
    <div class="container-login100">
      <h2 class="text-center bg-warning">
        <?php display_message(); ?>
      </h2>
      <div class="wrap-login100">
        <div class="login100-pic js-tilt" data-tilt style="margin-top:90px;">
          <img src="./img/login.png" style="height:405px; background-color:white;">
        </div>
        <div class="col-md-6">
          <h2 class="text-center" style="margin-top:35px;"><b>ĐĂNG NHẬP</b></h2><br />
          <div class="card mb-4" style="border-radius:25px;">
            <div class="card-body">
              <ul class="list-group list-group-flush" style="margin-left:10px;">
                <br />
                <form class="login100-form validate-form" method="post" enctype="multipart/form-data">
                  <?php login_user(); ?>

                  <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                    <input type="text" name="username" class=" input100" placeholder="Tên tài khoản">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                      <i class="fa fa-user-alt" aria-hidden="true"></i>
                    </span>
                  </div>

                  <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <input class="input100" type="password" name="password" placeholder="Mật khẩu">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                      <i class="fa fa-lock" aria-hidden="true"></i>
                    </span>
                  </div>
                  <br>
                  <div class="container-login100-form-btn">
                    <input type="submit" name="submit" class="login100-form-btn" value="Đăng nhập">
                  </div>
                  <br>
                  <div class="text-center">
                    <h2>
                      <a class="txt2 text-center" href="forgot.php">
                        Quên tài khoản hoặc mật khẩu ?
                      </a>
                      <br>
                      <a class="txt2 text-center" href="register.php">
                        Chưa có tài khoản? Đăng kí
                      </a>
                    </h2>
                  </div>
                </form>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    $('.js-tilt').tilt({
      scale: 1.1
    })
  </script>

<?php include(TEMPLATE_FRONT_USER . DS . 'footer.php'); ?>