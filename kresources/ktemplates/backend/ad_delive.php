<?php function total_delive()
{
    $query = query("SELECT COUNT(id) as total FROM buy WHERE status='Đã hoàn thành'");
    confirm($query);
    while ($row = fetch_array($query)) {
        $total = $row["total"];
        return $total;
    }
}?>
<h1 class="text-center ">
   Đã hoàn thành(<?php echo total_delive()?>)
</h1>
<h4 class="bg-success" align="center">
   <?php display_message(); ?>
</h4>
<div class="container">
   <div class="navbar navbar-cat">

      <p>Xem dưới dạng bảng&ensp;
      <div class="toggle-btn">
         <div class="inner-circle"></div>
      </div>
      </p>
   </div>

</div>
<div class="container col-12" style="display:block;">
   <?php display_ad_delive(); ?>
</div>
<div class="container col-md-12" style="display:none;">
   <div class="rounded">
      <table class="table table-hover">
         <thead>
            <tr>
               <th>Mã đơn hàng</th>
               <th>tên sản phẩm</th>
               <th>Đơn giá</th>
               <th>Số lượng</th>
               <th>Thành tiền</th>
               <th>Người nhận</th>
               <th>Trạng thái</th>
               <th>Thời gian nhận hàng:</th>
               <th>Hủy đơn</th>
            </tr>
         </thead>
         <?php display_list_delive() ?>
      </table>
      <br>
      <br>
   </div>
</div>

<script>
   document.querySelector('.toggle-btn').addEventListener('click', function () {
      this.classList.toggle('active');
      var container = document.querySelector('.container.col-12');
      var containerMt5 = document.querySelector('.container.col-md-12');
      if (this.classList.contains('active')) {
         container.style.display = 'none';
         containerMt5.style.display = 'block';
      } else {
         container.style.display = 'block';
         containerMt5.style.display = 'none';
      }
   });
</script>