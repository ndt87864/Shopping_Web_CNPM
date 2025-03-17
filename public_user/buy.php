<?php require_once('..\kresources\config.php'); ?>
<?php include(TEMPLATE_FRONT_USER . DS . 'header_user.php'); ?>
<?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
    add_order();
}
?>

<style>
    .gradient-custom {}
</style>

<div class="container">
    </br />
    <br />
    <div class="row">
        </br />
        <div class="card-header py-3" style="margin-left:25px;">
            <strong>
                <h1 class="text-left">ĐẶT HÀNG</h1>

            </strong>

        </div>
        <h4 class="text-center bg-danger">
            <?php display_message(); ?>
        </h4>

        <div class="container py-5">
            <div class="row d-flex justify-content-center my-4">
                <div class="col-md-8">
                    <div class="card mb-4"  style="border-radius:25px;" >
                        <div class="card-body">
                            <div class="bg-success" style="padding-top:12px; padding-bottom:2px;">
                                <p style="padding-bottom:8px;"><strong>&ensp;Địa chỉ khách hàng: </strong></p>
                            </div>
                            <br>
                            <p style="">
                                <?php buy_address(); ?>
                            </p>
                            <a href="user/index_user.php?address">
                                <div class="panel" style="padding-left:5px;">
                                    <span class="media-left" style="margin-left:5px;">Thay đổi địa chỉ </span>
                                    <span style="display:inline; padding-left:0px"><i class="fa fa-arrow-circle-right"></i></span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="card mb-4" style=" border-radius:25px; padding-top:30px;padding-bottom:25px; padding-left:50px; padding-right:50px;">
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="product_name">
                            <input type="hidden" name="price">
                            <input type="hidden" name="quantity">
                            <input type="hidden" name="amount">
                            <input type="hidden" name="photo">
                            <?php buy_cart(); ?>
                            <div class="col-md-4">
                                <div class="card" style="border-radius:25px;">
                                    <div class="card-body" style=" padding-left:15px;">
                                        <b>THANH TOÁN ĐƠN HÀNG</b>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card mb-4"  style="border-radius:25px;">
                                    <div class="card-body" style="padding-bottom:33px;">
                                        <ul class="list-group list-group-flush">
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                                <strong> Tổng số lượng : </strong>
                                                <span class="amount">
                                                    <?php
                                                    echo isset($_SESSION['item_quantity']) ? $_SESSION['item_quantity'] : $_SESSION['item_quantity'] = "0"; ?>
                                                </span>
                                            </li>
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                <strong>Phí vận chuyển :</strong>
                                                <span>Miễn phí</span>
                                            </li>
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                                <div>
                                                    <strong>Tổng thanh toán :&ensp;
                                                        <i class="text-warning">
                                                            <?php  echo number_format(isset($_SESSION['item_total']) ? $_SESSION['item_total'] : $_SESSION['item_total'] = "0"); ?>
                                                            VND
                                                        </i></strong>
                                                    <br>
                                                    <p class=" mb-0">( Mức giá Đã bao gồm thuế giá trị gia tăng VAT)</p>
                                                    <br>

                                                </div>
                                            </li>
                                        </ul>

                                        <?php return_cart() ?>
                                        <div class="form-group">
                                            <label for="direct"><input type="checkbox" id="direct" name="payment"> Thanh
                                                toán trực tiếp
                                            </label>
                                            <img class="me-2" width="45px"
                                                src="https://cdn-icons-png.flaticon.com/512/3796/3796142.png"
                                                alt="Thanh toán khi nhận hàng" /><br>
                                            <label for="redirect"><input type="checkbox" id="redirect" name="redirect">
                                                Thanh toán
                                                bằng
                                                VNPAY</label>
                                            <img class="me-2" width="45px"
                                                src="https://cdn.haitrieu.com/wp-content/uploads/2022/10/Logo-VNPAY-QR-1.png"
                                                alt="Ví Điện Tử VNPay" />
                                        </div>

                                        <script>
                                            var checkboxes = document.querySelectorAll('input[type=checkbox]');

                                            checkboxes.forEach(function (checkbox) {
                                                checkbox.addEventListener('change', function () {
                                                    checkboxes.forEach(function (c) {
                                                        if (c !== checkbox) c.checked = false;
                                                    });
                                                });
                                            });
                                        </script>

                                        <div id="buy-button" class="form-group" style="width: 100%;">

                                            <input type="submit" name="return_cart" class="btn btn-danger pull-left"
                                                value="Quay lại"  style="border-radius:25px;" >
                                            <input type="submit" name="add_order" class="btn btn-primary pull-right"
                                                value="Đặt hàng"  style="border-radius:25px;" >
                                        <div class="space" style="padding:33px"></div>
                                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include(TEMPLATE_FRONT_USER . DS . 'footer.php'); ?>