<!-- <link href="css/order.css" rel="stylesheet"> -->
<div class="container-fluid">
    <div class="row">
        <h1 class="col-12">
            DANH SÁCH SẢN PHẨM
        </h1>
        <div class="col-12">
            <h3 class="bg-success">
                <?php display_message(); ?>
            </h3>
            <h3 class="bg-success">
                <?php display_message(); ?>
            </h3>
        </div>


        <div class="col-md-6">
            <div class="card" style="border-radius: 15px;">
                <div class="card-body text-center" >
                    <form action="index.php?cat_product" method="post" enctype="multipart/form-data">
                        <label>Phân loại:</label><br>
                        <select name="product_category_id" id="" class="form-product" style="width:100px;height:37px;border-radius:15px;">
                            <option value="">Chọn danh mục</option>
                            <?php show_categories_add_product();
                            $_SESSION['product_category_id']; ?>
                        </select>
                        <input type="submit" name="up" class="btn btn-success" value="Lọc" style="border-radius:10px;"><br>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card" style="padding:3px; border-radius: 15px;">
                <div class="card-body">
                    <lable>Tìm kiếm sản phẩm</lable>
                    <form action="index.php?display_product" method="post" enctype="multipart/form-data">
                        <input type="search" class="form-group" name="search" placeholder="Tìm kiếm sản phẩm"
                            style="border:1px solid black;border-radius:15px; height:38px;">
                        <button type="submit" name="submit" class="btn btn-primary " style="border-radius:10px;">
                            <i class="now-ui-icons ui-1_zoom-bold"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <button onclick="printProducts()" class="btn btn-primary">In danh sách sản phẩm</button>
</div>
<div class="col-md-12" id="productData">
    <table class="table table-hover">
        <?php get_products_in_admin(); ?>
    </table>
    <script>
        function printProducts() {
            var printContents = document.getElementById("productData").innerHTML;
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
</div>