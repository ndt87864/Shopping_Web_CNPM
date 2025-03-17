<!-- <link href="css/order.css" rel="stylesheet"> -->
<h1 class="col-12">
    THỐNG KÊ DOANH SỐ
</h1>
<div class="col-12">
    <h3 class="bg-success">
        <?php display_message(); ?>
    </h3>
    <h3 class="bg-success">
        <?php display_message(); ?>
    </h3>
</div>
<div class="navbar" style="border-radius:25px;">

    <div class="col-md-7">
        <button onclick="printday()" class="btn btn-primary" style="margin-bottom:15px;margin-left:15px;">In doanh
            thu</button>
            <br />
        <select id="selectOption">
            <option value='day'>Hiển thị theo ngày</option>
            <option value='month'>Hiển thị theo tháng</option>
            <option value='year'>Hiển thị theo năm</option>
            <option value='revenue'>Hiển thị tất cả</option>
        </select>
        <script>
            document.getElementById('selectOption').addEventListener('change', function () {
                var selectedOption = this.value;
                if (selectedOption === 'revenue') {
                    window.location.href = 'index.php?revenue';
                } else {
                    window.location.href = 'index.php?' + selectedOption;
                }
            });
        </script>
    </div>
    <form action="index.php?custom_day" method="post" class="col-md-5">


        <h4 class="text-left">Hiển thị doanh thu tùy chọn :</h4>
        <div class="row">
            <div class="col-sm-5">
                <p class="m-b-10 f-w-600">Thời gian bắt đầu <i class="fas fa-calculator"></i>:</p>
                <input type="date" name="start_revenue" class="form-control">
                <p class="m-b-10 f-w-600">Thời gian kết thúc <i class="fas fa-calculator"></i>:</p>
                <input type="date" name="end_revenue" class="form-control">
            </div>
            <div class="col-sm-5">
                <br />
                <input type="submit" name="cus_revenue" class="btn btn-primary" value="Xem" style="border-radius:15px;">
            </div>
        </div>
    </form>
</div>
<div class="col-md-12" id="dayData">
    <?php display_day(); ?>
</div>
<script>
    function printday() {
        var printContents = document.getElementById("dayData").innerHTML;
        var printWindow = window.open('', '_blank');

        printWindow.document.open();
        printWindow.document.write('<html><head><title>Hóa đơn chi tiết</title>');
        printWindow.document.write('<style>table {border-collapse: collapse; width: 100%;}');
        printWindow.document.write(' table, th, td {border: 1px solid black; padding: 10px;}</style></head><body>');
        printWindow.document.write(printContents);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }
</script>