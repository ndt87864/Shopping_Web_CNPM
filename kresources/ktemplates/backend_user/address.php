<h1 style="padding-left:30px;">
  THÔNG TIN KHÁCH HÀNG</h1>
<p class="bg-success"></p>
<div class="col-md-12">
  <button type="button" class="btn btn-primary launch" data-toggle="modal" data-target="#staticBackdrop"  style="margin-left:1.5%;"> <i
      class="fa fa-plus"></i> Thêm thông tin tài khoản
  </button>
  <?php include(TEMPLATE_BACK_USER . '\add_address.php'); ?>


  <br />
  <div class="modal fade" id="staticBackdrop2" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel2" aria-hidden="true">
  <?php include(TEMPLATE_BACK_USER . '\edit_address.php'); ?>
  </div>
</div>
  <?php display_address(); ?>