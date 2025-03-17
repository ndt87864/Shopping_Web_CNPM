<h1 class="text-center">
   Chi tiết đơn hàng
</h1>
<h4 class="bg-success" align="center">
   <?php display_message(); ?>
</h4>

<div class="container">
   <?php detail_order(); ?>
</div>

<script>
   function printOrder() {
      var printContents = document.getElementById("orderData").innerHTML;
      var printWindow = window.open();

      printWindow.document.open();
      printWindow.document.write('<html><head><title>Hóa đơn chi tiết</title>');
      printWindow.document.write('<style>hr {border: block; border-top: 1px solid black;width:100%;} table {width: 100%;} td, th {text-align: left; padding: 8px;}</style></head><body>');
      printWindow.document.write(printContents.replace(/\\n/g, '<hr>'));
      printWindow.document.write('</body></html>');
      printWindow.document.close();

      printWindow.print();
      printWindow.close();
   }
</script>

