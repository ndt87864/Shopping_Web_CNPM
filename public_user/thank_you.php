<?php require_once("..\kresources\config.php"); ?>
<?php if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    include(TEMPLATE_FRONT_USER . DS . 'header_user.php');
} else {
    include(TEMPLATE_FRONT . DS . 'header.php');
} ?>
<link href="css/thankyou.css" rel="stylesheet">
<div class="container">
    <br />
    <div class="row">
        <br />
        <div style="margin-left:35px;">
            <h2 class="text-center" ><b> CẢM ƠN BẠN ĐÃ MUA HÀNG !</b></h2>
        </div>
          <br />
        <div class="container py-4" style="margin-left:21%;margin-right:29%;">
            <div class="row d-flex justify-content-center my-4" style="width:100%;">
                <div class="col-md-6 custom-col" >
                    <div class="card mb-5" style="margin-left:50px;">
                        <div class="card-body">
                            <div class="mb-5 text-center">
                                <br />
                                <svg xmlns="http://www.w3.org/2000/svg" class="text-success" width="100" height="90"
                                    fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16"  style=''>
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                                </svg>
                                <br>
                            </div>
                            <div class="text-center" style="margin-right:5px;" >
                                <strong>
                                <div style="padding:5px"></div>
                                    <h1>
                                        <p>ĐẶT HÀNG THÀNH CÔNG !</p>
                                    </h1>
                                    <span>
                                    
                                        <p>Mã đơn hàng của bạn là: #<?php echo $_GET['buy_codes'];?></p>
                                    </span>
                                    <div style="padding:3px"></div>
                                </strong>
                                <p>Đơn hàng sẽ được chuẩn bị và giao trong vòng 1-2 ngày kể từ khi xác nhận</p>
                            </div>
                            <br>
                            
                                <a href='index_user.php' class='btn btn-primary' style='margin-left:123px;margin-right:15px; padding-top: 12px; padding-bottom:8px;'>Trang chủ</a>
                                <a href='..\public_user\user\index_user.php?order' class='btn btn-success' style='margin-right:15px;padding-top: 12px; padding-bottom:8px;' >Trang Đơn Hàng</a>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include(TEMPLATE_FRONT_USER . DS . 'footer.php'); ?>