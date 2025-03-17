<link href="css/order.css" rel="stylesheet">
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="index.php?cat_product" method="post" enctype="multipart/form-data"
                        style="margin-left:14%;">
                        <label>Phân loại:</label><br>
                        <select name="product_category_id" id="" class="form-product" style="width:100px;height:37px;">
                            <option value="">Chọn danh mục</option>
                            <?php show_categories_add_product();
                            $_SESSION['product_category_id']; ?>
                        </select>
                        <input type="submit" name="up" class="btn btn-success" value="Lọc"><br>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-hover">
        <?php cat_product() ?>
    </table>

</div>
</div>