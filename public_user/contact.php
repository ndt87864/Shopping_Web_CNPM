<?php require_once("..\kresources\config.php"); ?>
<?php if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
  include(TEMPLATE_FRONT_USER . DS . 'header_user.php');
} else {
  include(TEMPLATE_FRONT . DS . 'header.php');
} ?>

<link href="css/login.css" rel="stylesheet">
<div class="container" style="margin-top: 50px;">
  <div class="navbar-left" style="margin-left:5px; margin-top:115px; margin-right: 55px;">
    <div class="login100-pic js-tilt" data-tilt>
      <img src="./img/undraw-contact.svg" alt="một thứ gì đó giống với thể loại NTR">
    </div>
  </div>
  <div style="padding-left:35px;"></div>
  <div class="col-md-8">
    <h2 class="text-center"><b>LIÊN HỆ VỚI CHÚNG TÔI</b></h2><br />
        <h2 class="text-center bg-warning">
          <?php display_message(); ?>
        </h2>
    <div class="card mb-6" style="border-radius: 25px; padding-bottom:15px; padding-right:25px;">
      <div class="card-body">
        <br>
        <form name="sentMessage" id="contactForm" method="post">
          <?php request_to_admin(); ?>
          <strong style="margin-left: 30px;">
            <span>Thời gian phản hồi trung bình 1-3 ngày</span>
            <br />
            <br />
          </strong>
          <div class="col-md-6 navbar-center" >
            <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
              <input class="input100" type="text" name="name" id="name" placeholder="Tên của bạn">
              <span class="focus-input100"></span>
              <span class="symbol-input100">
                <i class="fa fa-user" aria-hidden="true"></i>
              </span>
            </div>
            <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
              <input class="input100" type="text" name="email" id="email" placeholder="Nhập Email">
              <span class="focus-input100"></span>
              <span class="symbol-input100">
                <i class="fa fa-envelope" aria-hidden="true"></i>
              </span>
            </div>
            <div class="wrap-input100 validate-input" data-validate="">
              <input class="input100" type="text" name="subject" placeholder="Mô tả yêu cầu *" id="subject" required
                data-validation-required-message="Nhập mô tả yêu cầu !">
              <span class="focus-input100"></span>
              <span class="symbol-input100">
                <i class="fa fa-request" aria-hidden="true"></i>
              </span>
            </div>
          </div>

          <div class="col-md-6 navbar-right">
            <div class="wrap-input100 validate-input" data-validate="" style=" padding-top:2px;">
              <textarea class="typography-line" name="message" placeholder="  Lời nhắn của bạn *" id="message" cols="40"
                rows="8" required data-validation-required-message="Hãy nhập vào lời nhắn của bạn."
                style="border:1px solid black;border-radius:15px; margin-right:15px;"></textarea>
              <span class="focus-input100"></span>
            </div>
            <br>
          </div>
          <div class="container-login100-form-btn">
            <button type="submit" name="submit" class="login100-form-btn" style="width:50%; margin-left:8px;">Gửi yêu cầu</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--===============================================================================================-->
  <script src="vendor/tilt/tilt.jquery.min.js"></script>
  <script>
    $('.js-tilt').tilt({
      scale: 1.1
    })
  </script>
  <!--===============================================================================================-->
  <script src="js/main.js"></script>


<?php include(TEMPLATE_FRONT_USER . DS . 'footer.php'); ?>
