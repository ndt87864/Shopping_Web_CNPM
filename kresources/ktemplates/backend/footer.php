<?php
$query = query("SELECT status, COUNT(*) as value FROM buy GROUP BY status");
confirm($query);

$data = '';
while ($row = fetch_array($query)) {
  $data .= "{ status: '" . $row['status'] . "',<br> value: " . $row['value'] . "},<br>";
}
$data = substr($data, 0, -2);
?>


<footer class="bg-primary text-center text-lg-start text-white">
  <!-- Grid container -->
  <div class="container p-4">
    <!--Grid row-->
    <div class="row my-4">
      <!--Grid column-->
      <div class="col-lg-3 col-md-6 mb-4 mb-md-0">

        <div
          class="rounded-circle bg-white shadow-1-strong d-flex align-items-center justify-content-center mb-4 mx-auto"
          style="width: 150px; height: 120px;">
          <img src="../../kresources/uploads/toy1.jpg" alt="" loading="lazy" />
        </div>

        <p class="text-center" style="color:white">Dự án thực hiện bởi Nhóm 1 - DH11C12 </p>

        <ul class="list-unstyled d-flex flex-row justify-content-center">
          <li>
            <a class="text-white px-2" href="#!">
              <i class="" src="https://github.githubassets.com/assets/GitHub-Mark-ea2971cee799.png"></i>
            </a>
          </li>

      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
        <h5 class="text-uppercase mb-4">Các thành viên</h5>

        <ul class="list-unstyled">
          <li class="mb-2">
            <a href="#!" class="text-white"> Trưởng Nhóm : Nguyễn Trần Trung</a>
          </li>
          <li class="mb-2">
            <a href="#!" class="text-white"> Thiết Kế Giao Diện : Lê Việt Thuyên </a>
          </li>
          <li class="mb-2">
            <a href="#!" class="text-white"> Thiết kế chức năng : Nguyễn Đình Trung </a>
          </li>
          <li class="mb-2">
            <a href="#!" class="text-white"> Phân tích và tài liệu : Đỗ Minh Vũ</a>
          </li>
          <li class="mb-2">
            <a href="#!" class="text-white"> Phân tích và tài liệu : Lê Văn Minh</a>
          </li>
        </ul>
      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
        <h5 class="text-uppercase mb-4">Thực hiện bằng :</h5>
        <ul class="list-unstyled">
          <li class="mb-2">
            <a href="#!" class="text-white"><i class=""></i>PHP & Bootstrap</a>
          </li>
        </ul>
        </h5>
      </div>
      <!-- <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
          <h5 class="text-uppercase mb-4">Animals</h5>

          <ul class="list-unstyled">
            <li class="mb-2">
              <a href="#!" class="text-white"><i class=""></i>Khong co gi het</a>
            </li>
            <li class="mb-2">
              <a href="#!" class="text-white"><i class=""></i>chi la demo thoi</a>
            </li>
            <li class="mb-2">
              <a href="#!" class="text-white"><i class=""></i>thay gi thi thay</a>
            </li>
            <li class="mb-2">
              <a href="#!" class="text-white"><i class=""></i>khong quan trong</a>
            </li>
            <li class="mb-2">
              <a href="#!" class="text-white"><i class=""></i>boi vis</a>
            </li>
            <li class="mb-2">
              <a href="#!" class="text-white"><i class=""></i>ai roi cung bi NTR thoi</a>
            </li>
          </ul>
        </div> -->
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
        <h5 class="text-uppercase mb-4">Liên hệ</h5>

        <ul class="list-unstyled">
          <li>
            <p style="color:white"><i class="fas fa-map-marker-alt pe-2" style="color:white"></i> Hà Nội , Việt Nam</p>
          </li>
          <li>
            <p style="color:white"><i class="fas fa-phone pe-2" style="color:white"></i> 1900 100 thấy</p>
          </li>
          <li>
            <p style="color:white"><i class="fas fa-envelope pe-2 mb-0" style="color:white"></i>
              trungnguyenNTR@gmail.com</p>
          </li>
        </ul>
      </div>
      <!--Grid column-->
    </div>
    <!--Grid row-->
  </div>
  <!-- Grid container -->

  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
    © 9/2023 Dự án thực hiện & thiết kế bởi Nhóm 1 DH11C12
  </div>
  <!-- Copyright -->
</footer>


<!-- /#wrapper -->

<script src="../assets/js/core/jquery.min.js"></script>
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<script src="../assets/js/plugins/chartjs.min.js"></script>
<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"
  integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<?php
$query = query("SELECT status, COUNT(*) as value FROM buy GROUP BY status");
confirm($query);
$query_total = query("SELECT id, COUNT(*) as total FROM buy");
confirm($query_total);
$row_total = fetch_array($query_total);
$total = $row_total["total"];
$data = array();
while ($row = fetch_array($query)) {
  $percent = round(($row['value'] / $total) * 100, 2);
  $data[] = array('status' => $row['status'], 'value' => $percent . '%');
}

$query1 = query("SELECT order_name, COUNT(order_name) as count, SUM(order_amount) as total_amount FROM orders GROUP BY order_name");
confirm($query1);

$data_bar = array();
while ($row = fetch_array($query1)) {
  $data_bar[] = array('order_name' => $row['order_name'], 'count' => $row['count'], 'total_amount' => $row['total_amount']);
}

?>
<script type="text/javascript">
  $(function () {
    var data = <?php echo json_encode($data); ?>;

    Morris.Donut({
      element: 'chart',
      data: data,
      formatter: function (value, data) {
        if (data !== null) {
          return data.status + ': ' + value;
        } else {
          return value;
        }
      }
    });
  });
  new Morris.Bar({
    element: 'tchart',
    data: <?php echo json_encode($data_bar); ?>,
    xkey: 'order_name',
    ykeys: ['count', 'total_amount'],
    labels: ['số lượng', 'Doanh thu']
  });
</script>
</body>

</html>

</body>

</html>