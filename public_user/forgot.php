<?php require_once('..\kresources\config.php'); ?>
<?php include(TEMPLATE_FRONT . DS . 'header.php'); ?>
<!-- Page Content -->
<div class="container">
    </br />
    <br />
    <header>
        <br />
        <h1 class="text-center">Lấy lại mật khẩu</h1>
        <h2 class="text-center bg-warning">
            <?php display_message(); ?>
        </h2>
    </header>
    <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-login">
            <div class="card mb-5">
                <div class="card-body text-center">
                    <h4> <label for="email">Email:</label></h4>
                    <form class="" action="" method="post">
                        <?php send_otp(); ?>
                        <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                            <input class="input100" type="text" name="email" placeholder="Nhập Email">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </span>
                        </div>
                        <br>
                        <div class="container-login100-form-btn">
                            <input type="submit" name="forgot" class="login100-form-btn" value="Tiếp theo">
                        </div>
                        <br />
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include(TEMPLATE_FRONT_USER . DS . 'footer.php'); ?>