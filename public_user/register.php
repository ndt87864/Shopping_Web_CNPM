<?php
require_once('..\kresources\config.php');
include(TEMPLATE_FRONT . DS . 'header.php');


?>

<div class="container">
    <h2 class="text-center bg-warning">
        <?php display_message(); ?>
    </h2>
    <div class="navbar-left">
        <div class="login100-pic js-tilt" data-tilt>
            <img src="./img/login.png" style="height:405px; background-color:white;">
        </div>
    </div>
    <div class="col-md-6 navbar-right">
          <h2 class="text-center"><b>ĐĂNG KÍ</b></h2><br />
        <div class="card mb-4">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <br />
                    <form action="" method="post" enctype="multipart/form-data">
                        <?php register_user(); ?>
                        <div class="col-md-6 navbar-left">
                            <div class="wrap-input100 validate-input"
                                data-validate="Valid email is required: ex@abc.xyz">
                                <input type="text" name="first_name" class=" input100" placeholder="Tên người dùng">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </span>
                            </div>
                            <br />
                            <div class="wrap-input100 validate-input"
                                data-validate="Valid email is required: ex@abc.xyz">
                                <input type="text" name="last_name" class=" input100" placeholder="Họ">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="wrap-input100 validate-input"
                                data-validate="Valid email is required: ex@abc.xyz">
                                <input type="date" name="birthday" class=" input100">
                                <span class="focus-input100"></span>
                            </div>
                            <br />
                            <div class="form-group">
                                <label class="fa fa-transgender-alt"></label>
                                <label for="sex">Giới tính :</label><br />
                                <input type="radio" name="sex" id="nam" value="nam"><label class="fa fa-mars"> Nam
                                </label>
                                &ensp;<input type="radio" name="sex" id="nu" value="nu"><label class="fa fa-venus">
                                    Nữ </label>
                                &ensp;<input type="radio" name="sex" id="khac" value="khac"><label
                                    class="fa fa-transgender-alt">
                                    Khác&ensp;</label>
                                <br>
                            </div>
                        </div>

                        <div class="col-md-6 navbar-right">
                            <div class="wrap-input100 validate-input"
                                data-validate="Valid email is required: ex@abc.xyz">
                                <input type="text" name="username" class=" input100" placeholder="Tên tài khoản">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-user-alt" aria-hidden="true"></i>
                                </span>
                            </div>
                            <br />
                            <div class="wrap-input100 validate-input"
                                data-validate="Valid email is required: ex@abc.xyz">
                                <input type="email" name="email" class=" input100" placeholder="Email">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                </span>
                            </div>
                            <br />
                            <div class="wrap-input100 validate-input" data-validate="Password is required">
                                <input class="input100" type="password" name="password" placeholder="Mật khẩu">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="form-group fa fa-file-image">
                                <label for="file">Hình ảnh:</label>
                                <input type="file" name="file">
                            </div>
                            <br>
                            <br />
                        </div>
                        <div class="container-login100-form-btn">
                            <input type="submit" name="register" class="login100-form-btn" value="Đăng kí">
                        </div>
                        <div class="text-left">
                            Bạn đã có tài khoản? <a href="login.php">Đăng nhập</a>
                        </div>
                        <br>
                    </form>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
</div>

</div>

<?php include(TEMPLATE_FRONT_USER . DS . 'footer.php'); ?>