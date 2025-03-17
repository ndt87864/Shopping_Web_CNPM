<p style="margin-left:25px;"><h1>CHỈNH SỬA NỘI DUNG TRANG CHỦ</h1></p>
<div class="container-fluid">
  <div class="row">
  
  <br>
    <h3 class="bg-success">
      <?php display_message(); ?>
    </h3>

    <div class="col-xs-3" style="border: 1px solid; border-radius:25px;margin-left:55px;margin-right:75px;margin-bottom:25px; padding-top: 55px; padding-left:25px;">

      <form action="" method="post" enctype="multipart/form-data">
        <?php add_slides(); ?>
        <div>
          <input type="file" name="file">
        </div>
        <br>
        <div class="form-group">
          <label for="title">Số thứ tự Banner: </label>
          <input type="text" name="slide_title" class="form-control">
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-primary btn-lg" name="add_slide" value="Lưu" style="border-radius: 25px;">
        </div>
      </form>

    </div>


    <div class="col-xs-8">
      <?php get_current_slide_in_admin() ?>
    </div>

  </div><!-- ROW-->

  <div class="space-box" style="padding:15px;"></div>

  <p style="margin-top: 15px; margin-left:25px;"><h1>BANNER ĐÃ THÊM</h1></p>

  <div class="row" style="margin-left: 22px;">
    <?php get_slide_thumbnails(); ?>
  </div>
</div>