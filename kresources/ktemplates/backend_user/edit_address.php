<?php function extra_name()
{
    if (isset($_GET['id'])) {
        $query = query("SELECT * FROM address WHERE id = " . escape_string($_GET['id']) . "");
        confirm($query);
        while ($row = fetch_array($query)) {
            $fullname = escape_string($row['fullname']);
            return $fullname;
        }
    }
}

function extra_phone()
{
    if (isset($_GET['id'])) {
        $query = query("SELECT * FROM address WHERE id = " . escape_string($_GET['id']) . "");
        confirm($query);
        while ($row = fetch_array($query)) {
            $phone = escape_string($row['phone']);
            return $phone;
        }
    }
}

function extra_province()
{
    if (isset($_GET['id'])) {
        $query = query("SELECT * FROM address WHERE id = " . escape_string($_GET['id']) . "");
        confirm($query);
        while ($row = fetch_array($query)) {
            $province = escape_string($row['province']);
            return $province;
        }
    }
}

function extra_district()
{
    if (isset($_GET['id'])) {
        $query = query("SELECT * FROM address WHERE id = " . escape_string($_GET['id']) . "");
        confirm($query);
        while ($row = fetch_array($query)) {
            $district = escape_string($row['district']);
            return $district;
        }
    }
}

function extra_ward()
{
    if (isset($_GET['id'])) {
        $query = query("SELECT * FROM address WHERE id = " . escape_string($_GET['id']) . "");
        confirm($query);
        while ($row = fetch_array($query)) {
            $ward = escape_string($row['ward']);
            return $ward;
        }
    }
}

function extra_address()
{
    if (isset($_GET['id'])) {
        $query = query("SELECT * FROM address WHERE id = " . escape_string($_GET['id']) . "");
        confirm($query);
        while ($row = fetch_array($query)) {
            $address = escape_string($row['address']);
            return $address;
        }
    }
}
?>
<div class="col-md-12">
    <div class="modal-content"  style="margin-bottom:25px; border-radius: 25px;">
        <div class="modal-body">
            <form action="" method="post" enctype="multipart/form-data">
                <?php update_address() ?>
                <h6 class="text-center" style="margin-top:5px;margin-bottom:5px;margin-left:10px; margin-right:10px;">
                    Chỉnh sửa thông tin nhận hàng:
                </h6>
                <br>
                <div class="col-md-12">
                    <div class="form-group col-md-6">
                        <label class="fa fa-h-square"></label>
                        <label for="fullname">Họ và tên:</label><br />
                        <input type="text" id="fullname" name="fullname" class="form-control"
                            value="<?php echo extra_name(); ?>"><br><br>
                    </div>
                    <!-- <div class="box-space" style="padding-left:25px; padding-right:25px;"></div> -->
                    <div class="form-group col-md-6">
                        <label class="fa fa-phone"></label>
                        <label for="phone">Số điện thoại:</label><br />
                        <input type="text" id="phone" name="phone" class="form-control"
                            value="<?php echo extra_phone(); ?>"><br><br>
                    </div>
                </div>
                <br />
                <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="fa fa-map-marked-alt"></label>
                                <label class="text-left" for="province">Tỉnh/ Thành phố:</label><br />
                                <input type="text" id="province" name="province" class="form-control"
                                    value="<?php echo extra_province(); ?>"><br><br>
                            </div>
                            <div class="form-group">
                                <label class="fa fa-fw far fa-map-marker-alt"></label>
                                <label for="district">Quận/Huyện</label><br />
                                <input type="text" id="district" name="district" class="form-control"
                                    value="<?php echo extra_district(); ?>"><br><br>
                            </div>
                            <div class="form-group">
                                <label class="fa fa-fw far fa-map-marker"></label>
                                <label for="ward">Phường/Xã:</label><br />
                                <input type="text" id="ward" name="ward" class="form-control"
                                    value="<?php echo extra_ward(); ?>"><br><br>
                            </div>
                            <div class="form-group">
                                <label class="fa fa-map-marked"></label>
                                <label for="address">Địa chỉ cụ thể:</label><br />
                                <input type="text" id="address" name="address" class="form-control"
                                    value="<?php echo extra_address(); ?>"><br><br>
                            </div>
                            <div class="form-group d-flex justify-content-between">
                                <a id="user-id" class="btn btn-danger" href="index_user.php?address" style="border-radius:25px;">Quay lại</a>
                                <input type="submit" name="update_address" class="btn btn-primary" value="Lưu" style="border-radius:25px;">
                            </div>
                        </div>        
                </div>
                
            </form>
        </div>
    </div>
</div>