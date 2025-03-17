<?php require_once('..\kresources\config.php'); ?>
<?php include(TEMPLATE_FRONT . DS . 'header.php'); ?>
<?php
function user()
{
    $email = $_SESSION['email'];
    $query = query("SELECT * FROM users WHERE email = '{$email}' ");
    confirm($query);

    $row = fetch_array($query);

    $username = $row['username'];
    // Retrieve the image path from the database
    $user_photo = $row['user_photo'];
    $user = <<<DELIMETER
                <div class="text-center">
                <div ><img src='../kresources/uploads/{$user_photo}' class="img-circle" style="width: 100px; height: 100px; border: 3px solid white;"></div>

                    <div><strong class="text-warning">Tài khoản: </strong>{$username}</div>
                    
                </div>
            DELIMETER;

    echo $user;
}
?>
<!-- Page Content -->
<div class="container">
    </br />
    <br />
    <header>
        <br />
        <h1 class="text-center">Tạo mật khẩu mới</h1>
        <h2 class="text-center bg-warning">
            <?php display_message(); ?>
        </h2>
    </header>
    <div class="col-sm-6 col-lg-6 col-sm-offset-3">
        <div class="panel panel-login">
            <div class="card mb-5">
                <div class="card-body">
                    <?php user(); ?>
                    <br />
                    <form class="" action="" method="post" enctype="multipart/form-data">
                        <?php create_pw(); ?>
                        <div class="wrap-input100 validate-input" data-validate="Password is required">
                            <input class="input100" type="password" name="password" placeholder="Mật khẩu">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="wrap-input100 validate-input" data-validate="Password is required">
                            <input class="input100" type="password" name="re_pw" placeholder="Nhập lại mật khẩu">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="container-login100-form-btn">
                            <input type="submit" name="up_pw" class="login100-form-btn" value="Cập nhật">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include(TEMPLATE_FRONT_USER . DS . 'footer.php'); ?>