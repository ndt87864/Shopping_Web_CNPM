<?php add_address() ?>

<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body ">
                <form action="" method="post" enctype="multipart/form-data">
                    <h6 class="">
                        Thêm thông tin nhận hàng:
                    </h6>
                    <div class="col-md-12">
                        <div class="form-group col-md-6">
                            <label class="fa fa-h-square"></label>
                            <label for="fullname">Họ và tên:</label><br />
                            <input type="text" id="fullname" name="fullname" class="form-control"><br><br>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="fa fa-phone"></label>
                            <label for="phone">Số điện thoại:</label><br />
                            <input type="text" id="phone" name="phone" class="form-control">
                        </div>
                    </div>
                    <br />
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="fa fa-map-marked-alt"></label>
                            <label class="text-left" for="province">Tỉnh/Thành phố:</label><br />
                            <input type="text" id="province" name="province" class="form-control"><br><br>
                        </div>
                        <div class="form-group">
                            <label class="fa fa-fw far fa-map-marker-alt"></label>
                            <label for="district">Quận/Huyện</label><br />
                            <input type="text" id="district" name="district" class="form-control"><br><br>
                        </div>
                        <div class="form-group">
                            <label class="fa fa-fw far fa-map-marker"></label>
                            <label for="ward">Phường/Xã:</label><br />
                            <input type="text" id="ward" name="ward" class="form-control"><br><br>
                        </div>
                        <div class="form-group">
                            <label class="fa fa-map-marked"></label>
                            <label for="address">Địa chỉ cụ thể:</label><br />
                            <input type="text" id="address" name="address" class="form-control"><br><br>
                        </div>
                        <div class="form-group d-flex justify-content-between">
                            <a id="user-id" class="btn btn-danger" href="index_user.php?address">Quay lại</a>
                            <input type="submit" name="add_address" class="btn btn-primary" value="Lưu">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>