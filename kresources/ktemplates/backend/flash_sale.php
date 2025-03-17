<?php
function extra_title()
{
    if (isset($_GET['id'])) {
        $query = query("SELECT * FROM products WHERE product_id = " . escape_string($_GET['id']) . "");
        confirm($query);
        while ($row = fetch_array($query)) {
            $product_title = escape_string($row['product_title']);
            return $product_title;
        }
    }
}
function extra_quantity()
{
    if (isset($_GET['id'])) {
        $query = query("SELECT * FROM amount WHERE product_id = " . escape_string($_GET['id']) . "");
        confirm($query);
        while ($row = fetch_array($query)) {
            if ($row['sale_price'] != 0) {
                $product_quantity = escape_string($row['sale_quantity']);
            } else {
                $product_quantity = escape_string($row['product_quantity']);
            }
            return $product_quantity;
        }
    }
}
function extra_price()
{
    if (isset($_GET['id'])) {
        $query = query("SELECT * FROM amount WHERE product_id = " . escape_string($_GET['id']) . "");
        confirm($query);
        while ($row = fetch_array($query)) {
            if ($row['sale_price'] != 0) {

                $product_price = escape_string($row['sale_price']);
            } else {

                $product_price = escape_string($row['product_price']);
            }
            return $product_price;
        }
    }
}
function extra_start()
{
    if (isset($_GET['id'])) {
        $query = query("SELECT * FROM amount WHERE product_id = " . escape_string($_GET['id']) . "");
        confirm($query);
        while ($row = fetch_array($query)) {
            ;
            $start_date = date('Y-m-d', strtotime($row['start_date']));
            return $start_date;
        }
    }
}
function extra_end()
{
    if (isset($_GET['id'])) {
        $query = query("SELECT * FROM amount WHERE product_id = " . escape_string($_GET['id']) . "");
        confirm($query);
        while ($row = fetch_array($query)) {
            $end_date = date('Y-m-d', strtotime($row['end_date']));
            return $end_date;
        }
    }
}
function extra_image()
{
    if (isset($_GET['id'])) {
        $query = query("SELECT * FROM products WHERE product_id = " . escape_string($_GET['id']) . "");
        confirm($query);
        while ($row = fetch_array($query)) {
            $product_image = escape_string($row['product_image']);
            $product_image = display_images($product_image);
            return $product_image;
        }
    }
}

?>
<div class="container">

    <div class="row">
        <h1 class="">
            Tạo giảm giá sản phẩm
        </h1>
    </div>

    <?php
    update_sale();
    ?>
    <div class="card user-card-full" style="border-radius:25px;">
        <div class="row m-l-0 m-r-0">
            <div class="col-sm-4 user-profile">
                <div class="card-block text-center text-white">
                    <div class="m-b-25">
                        <img src="..\..\kresources\<?php echo extra_image(); ?>">
                    </div>
                    <br />
                    <h6 class="col-md-12 text-center" style="color:black;">
                        <?php echo extra_title(); ?>
                    </h6>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card-block" style="margin-top: 5px;">
                    <form action="" method="post" enctype="multipart/form-data">

                        <div class="row">
                            <div class="col-sm-12">
                                <p class="m-b-10 f-w-600">Thời gian bắt đầu <i class="fas fa-calculator"></i>:</p>
                                <input type="date" name="start_date" class="form-control"
                                    value="<?php echo extra_start(); ?>">
                            </div>
                            <div class="col-sm-12">
                                <p class="m-b-10 f-w-600">Thời gian kết thúc <i class="fas fa-calculator"></i>:</p>
                                <input type="date" name="end_date" class="form-control"
                                    value="<?php echo extra_end(); ?>">
                            </div>
                        </div>
                        <div style="padding:43px;"></div>
                        <hr style="width:100%">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="product-price" style="color:black;">Giá <i class="fas fa-hand-holding-usd"></i></label>
                                <input name="sale_price" class="form-control" value=" <?php echo extra_price(); ?>">
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="product-title" style="color:black;"> Số lượng <i class="fas fa-sort-numeric-up"></i></label>
                                <input type="number" name="sale_quantity" class="form-control"
                                    value="<?php echo extra_quantity(); ?>">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <input type="submit" name="sale" class="btn btn-primary pull-right" value="Cập nhật" style="border-radius:15px;">
                            <a id="user-id" class="btn btn-danger pull-left" href="index.php?amount" style="border-radius:15px;">Quay lại</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>