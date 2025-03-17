<?php
function extra_name()
{
    if (isset($_GET['user_id'])) {
        $query = query("SELECT * FROM users WHERE user_id = " . escape_string($_GET['user_id']) . "");
        confirm($query);
        while ($row = fetch_array($query)) {
            $username = escape_string($row['username']);
            return $username;
        }
    }
}
function extra_bd()
{
    if (isset($_GET['user_id'])) {
        $query = query("SELECT * FROM users WHERE user_id = " . escape_string($_GET['user_id']) . "");
        confirm($query);
        while ($row = fetch_array($query)) {
            $birthday = escape_string($row['birthday']);
            return $birthday;
        }
    }
}
function extra_first()
{
    if (isset($_GET['user_id'])) {
        $query = query("SELECT * FROM users WHERE user_id = " . escape_string($_GET['user_id']) . "");
        confirm($query);
        while ($row = fetch_array($query)) {
            $first_name = escape_string($row['first_name']);
            return $first_name;
        }
    }
}
function extra_last()
{
    if (isset($_GET['user_id'])) {
        $query = query("SELECT * FROM users WHERE user_id = " . escape_string($_GET['user_id']) . "");
        confirm($query);
        while ($row = fetch_array($query)) {
            $last_name = escape_string($row['last_name']);
            return $last_name;
        }
    }
}
function extra_email()
{
    if (isset($_GET['user_id'])) {
        $query = query("SELECT * FROM users WHERE user_id = " . escape_string($_GET['user_id']) . "");
        confirm($query);
        while ($row = fetch_array($query)) {
            $email = escape_string($row['email']);
            return $email;
        }
    }
}
function extra_pwd()
{
    if (isset($_GET['user_id'])) {
        $query = query("SELECT * FROM users WHERE user_id = " . escape_string($_GET['user_id']) . "");
        confirm($query);
        while ($row = fetch_array($query)) {
            $password = escape_string($row['password']);
            return $password;
        }
    }
}
function extra_photo()
{
    if (isset($_GET['user_id'])) {
        $query = query("SELECT * FROM users WHERE user_id = " . escape_string($_GET['user_id']) . "");
        confirm($query);
        while ($row = fetch_array($query)) {
            $user_photo = escape_string($row['user_photo']);
            $user_photo = display_images($user_photo);
            return $user_photo;
        }
    }
}

?>
<form action="" method="post" enctype="multipart/form-data">
    <?php edit();?>
    <div class="page-content page-container" id="page-content">
        <div class="padding">
            <div class="row container d-flex justify-content-center">
                <div class="col-md-12">
                    <div class="card user-card-full">
                        <div class="row m-l-0 m-r-0">
                            <div class="col-sm-4 bg-c-lite-green user-profile">
                                <div class="card-block text-center text-white">
                                    <div class="m-b-25">
                                        <input type="file" name="file"><br>
                                        <img width='250' src="..\..\kresources\<?php echo extra_photo(); ?>" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="card-block">
                                    <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Thông tin cá nhân</h6>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Tên:</p>
                                            <h6 class="text-muted f-w-400">
                                                <input type="text" name="first_name" class="form-control"
                                                    value="<?php echo extra_first(); ?>">
                                            </h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Họ:</p>
                                            <h6 class="text-muted f-w-400">
                                                <input type="text" name="last_name" class="form-control"
                                                    value="<?php echo extra_last(); ?>">
                                            </h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Giới tính:</p><br />
                                            <input type="radio" name="sex" id="nam" value="nam"><label
                                                class="fa fa-mars"> Nam </label>
                                            &ensp;<input type="radio" name="sex" id="nu" value="nu"><label
                                                class="fa fa-venus"> Nữ </label>
                                            &ensp;<input type="radio" name="sex" id="khac" value="khac"><label
                                                class="fa fa-transgender-alt">
                                                Khác&ensp;
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Ngày sinh:</p>
                                            <h6 class="text-muted f-w-400">
                                                <input type="date" name="birthday" class="form-control"
                                                    value="<?php echo extra_bd(); ?>">
                                            </h6>
                                        </div>
                                    </div>
                                    <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Thông tin tài khoản</h6>
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="user_level">Level: </label>
                                            <div style="padding:5px;"></div>
                                            <select class="text-muted f-w-400" name='user_level'>
                                                <option value='1'>Người dùng</option>
                                                <option value='2'>Admin</option>
                                            </select>
                                            <br />
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Email:</p>
                                            <h6 class="text-muted f-w-400">
                                                <input type="email" name="email" class="form-control"
                                                    value="<?php echo extra_email(); ?>">
                                            </h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Tên tài khoản:</p>
                                            <h6 class="text-muted f-w-400">
                                                <input type="text" name="username" class="form-control"
                                                    value="<?php echo extra_name(); ?>">
                                            </h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Mật khẩu:</p>
                                            <h6 class="text-muted f-w-400">
                                                <input type="password" name="password" class="form-control"
                                                    value="<?php echo extra_pwd(); ?>">
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex justify-content-between">
                                        <a id="user-id" class="btn btn-danger" href="index.php?users">Quay
                                            lại</a>
                                        <input type="submit" name="update_users" class="btn btn-primary"
                                            value="Cập nhật">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>