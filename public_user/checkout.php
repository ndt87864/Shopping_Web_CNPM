<?php require_once('..\kresources\config.php'); ?>
<?php if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
  include(TEMPLATE_FRONT_USER . DS . 'header_user.php');
} else {
  include(TEMPLATE_FRONT . DS . 'header.php');
} ?>

<div class="container">
  </br />
  <br />
  <div class="row">
    </br />
    <h4 class="text-center bg-danger">
      <?php display_message(); ?>
    </h4>
    <div class="container py-5">
      <div class="row d-flex justify-content-center my-4">
        <div class="col-md-8">
          <div class="card mb-4">
            <div class="card-header py-3">
              <strong>
                <h1 class="mb-0" style="padding-bottom: 0px;">Giỏ Hàng</h1>
              </strong>
            </div>
            <form action="" method="post">
              <?php cart(); ?>
              <div class="card mb-4">
                <div class="card-body">
                  <div class="bg-warning form-control" style="padding-top:8px; padding-bottom:8px;">
                    <p><strong>Miễn phí vận chuyển cho đơn hàng giá trị từ 450.000</strong></p>
                  </div>
                  <br>
                  <p><strong>Giao Hàng Dự Kiến</strong></p>
                  <ul>
                    <li>
                      <p class="mb-0">Nội miền : 1-3 ngày</p>
                    </li>
                    <li>
                      <p class="mb-0">Liên miền : 3-5 ngày</p>
                    </li>
                    <li>
                      <p class="mb-0">Quốc Tế : 10-30 ngày tuỳ vùng</p>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="card mb-4 mb-lg-0">
                <div class="card-body">
                  <div class="bg-warning form-control" style="padding-top:8px; padding-bottom:8px;">
                    <p><strong>Chúng tôi chấp nhận các hình thức thanh toán :</strong></p>
                  </div>
                  <br>
                  <ul>
                    <li>Thanh toán khi nhận hàng (COD)
                      <img class="me-2" width="45px" src="https://cdn-icons-png.flaticon.com/512/3796/3796142.png"
                        alt="Thanh toán khi nhận hàng" />
                    </li>
                    <li>Thanh toán qua ví điện tử VNPay
                      <img class="me-2" width="45px"
                        src="https://cdn.haitrieu.com/wp-content/uploads/2022/10/Logo-VNPAY-QR-1.png"
                        alt="Ví Điện Tử VNPay" />
                    </li>
                  </ul>
                  <br>
                </div>
              </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-body" style="padding-left:25px; position:center;">
                <b>THANH TOÁN ĐƠN HÀNG</b>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card mb-4">

              <div class="card-body">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                    <strong> Số lượng : </strong>
                    <span class="amount">
                      <?php
                      echo isset($_SESSION['item_quantity']) ? $_SESSION['item_quantity'] : $_SESSION['item_quantity'] = "0"; ?>
                    </span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                    <strong>Phí vận chuyển :</strong>
                    <span>Miễn phí</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                    <div>
                      <strong>Tổng thanh toán :&ensp;
                       <i class="text-warning"> <?php echo number_format(isset($_SESSION['item_total']) ? $_SESSION['item_total'] : $_SESSION['item_total'] = "0"); ?> VND
                      </i></strong>
                      <br>
                      <p class=" mb-0">( Mức giá Đã bao gồm thuế giá trị gia tăng VAT)</p>
                          <br>

                      </div>
                  </li>
                </ul>
                <form action="" method="post">
                  <?php buy(); ?>
                  <div class="form-group text-left">
                    <input type="submit" name="buy" class="btn btn-primary btn-lg btn-block" value="MUA HÀNG"></br>
                  </div>
                </form>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>







<?php include(TEMPLATE_FRONT_USER . DS . 'footer.php'); ?>