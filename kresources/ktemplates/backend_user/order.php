
<h1 class="text-center ">
   Đơn hàng
</h1>
<div class="col-md-12">

   <div>
      <h4 class="bg-success" align="center">
         <?php display_message(); ?>
      </h4>
   </div>
   <div class="card mb-4" style="border-radius:25px;">
      <div class="card-body" style="margin-left:15px;">
         <div style="width: 100%;" >
            <div style="display: flex; justify-content: space-between;" style="border-radius:25px;">
               <a href="index_user.php?order" class="custom-link">
                  <h4>Tất cả</h4>
               </a>
               <a href="index_user.php?process" class="custom-link">
                  <h4>Đang chờ xử lý</h4>
               </a>
               <a href="index_user.php?confirm" class="custom-link">
                  <h4>Đã xác nhận </h4>
               </a>
               <a href="index_user.php?ship" class="custom-link">
                  <h4>Đang giao hàng</h4>
               </a>
               <a href="index_user.php?delive" class="custom-link">
                  <h4>Đã hoàn thành</h4>
               </a>
            </div>
         </div>
      </div>
   </div>
   <?php display_order(); ?>
</div>