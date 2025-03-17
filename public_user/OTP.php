<?php require_once('..\kresources\config.php'); ?>
<?php include(TEMPLATE_FRONT . DS . 'header.php'); ?>

<!-- Page Content -->
<div class="container">
    </br />
    <br />
    <header>
        <br />
        <h1 class="text-center">Nhập mã OTP nhận từ email</h1>
        <h2 class="text-center bg-warning">
            <?php display_message(); ?>
            <div id="countdown"></div>
        </h2>
    </header>
    <br />
    <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-login">
            <div class="card mb-5">
                <div class="card-body text-center">
                    <label for="otp">
                        <h4 class="text-center">OTP</h4>
                    </label>
                    <form class="" action="" method="post">
                        <?php otp_check(); ?>

                        <div class="wrap-input100 validate-input" data-validate="Password is required">
                            <input class="input100" type="text" name="otp">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
                        </div>
                        <br />
                        <div class="container-login100-form-btn">
                            <input type="submit" id="new_submit" name="re_otp" class="login100-form-btn"
                                value="Gửi lại mã" style="display: none">
                        </div>
                        <div class="container-login100-form-btn">
                            <input type="submit" id="submit" name="submit" class="login100-form-btn" value="Xác minh"
                                style="display: block">
                        </div>
                        <br />
                    </form>
                    <script type="text/javascript">
                        var timeleft = 60;
                        var downloadTimer = setInterval(function () {
                            if (timeleft <= 0) {
                                clearInterval(downloadTimer);
                                document.getElementById("countdown").innerHTML = "Hết hiệu lực!";
                                document.getElementById("submit").style.display = "none";
                                document.getElementById("new_submit").style.display = "block";
                            } else {
                                document.getElementById("countdown").innerHTML = timeleft + " giây còn lại";
                            }
                            timeleft -= 1;
                        }, 1000);
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include(TEMPLATE_FRONT_USER . DS . 'footer.php'); ?>