<?php 
function total_buy()
{
    $query = query("SELECT COUNT(id) as total FROM buy");
    confirm($query);
    while ($row = fetch_array($query)) {
        $total = $row["total"];
        return $total;
    }
}?>
<div class="container">
   <h1 class="text-center">
      ĐƠN HÀNG (<?php echo total_buy() ?>)
   </h1>
   <div class="navbar" style="border-radius:25px;">
      <form method="GET" action="index.php?search_order" class="col-md-3">
         <label for="search_input" style="padding-left:5px;">Nhập ID hoặc mã đơn hàng:</label>
         <input type="text" class="form-control" name="order_code" placeholder="Nhập ID hoặc mã tracking đơn hàng"
            style="border:1px solid black;height:37px;border-radius:15px;">
      </form>
      <form method="post" enctype="multipart/form-data" class="col-md-3">

         <h4 class="text-left">CHỈNH SỬA TRẠNG THÁI ĐƠN HÀNG :</h4>
         <label>Mã đơn hàng: </label>
         <br>
         <input type="text" name="buy_code" style="border: 1px solid black;border-radius: 25px;">
         <div class="space-box" style="padding:5px;"></div>
         <label>Trạng thái:</label><br />
         <div style="border-radius:25px;">
            <?php update_status() ?>
         </div>
         <select name='status' class="form control" style="border-radius:15px;">
            <option value='Đang xử lý'>Đang xử lý</option>
            <option value='Đã xác nhận'>Đã xác nhận</option>
            <option value='Đang giao hàng'>Đang giao hàng</option>
            <option value='Đã hoàn thành'>Đã hoàn thành</option>
         </select><br />
         <input type='submit' name='update_status' class='btn btn-success' value='Lưu' style="border-radius: 25px;">

      </form>
   </div>
   <div style="display: inline-block; margin-bottom:10px;margin-left:30px;">
      <p>Xem dưới dạng bảng</p>
   </div>
   <div class="toggle-btn" style="display: inline-block;">
      <div class="inner-circle"></div>
   </div>

   <div class="container col-12" style="display:block; border-radius:25px;">
      <?php display_adorder(); ?>
   </div>
   <div class="container col-md-12" style="display:none;">
      <div class="row">
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
                  <th>Thời gian đặt hàng:</th>
                  <th>Thời gian nhận hàng:</th>
                  <th>Hủy đơn</th>
               </tr>
            </thead>
            <?php display_list_adorder() ?>
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
</div>