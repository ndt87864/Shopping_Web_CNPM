<div class="col-md-12">

    <div class="row">
        <h1 class="" style="padding-left:20px;">
            THÊM SẢN PHẨM
            <?php add_product(); ?>
        </h1>
    </div>


    <form action="" method="post" enctype="multipart/form-data">
        <div class="col-md-8">
            <div class="form-group">
                <label for="product-title"><i class="fa fa-tag"></i> Tên sản phẩm</label>
                <input type="text" name="product_title" class="form-control">
            </div>
            <div class="form-group">
                <label for="product-title"><i class="now-ui-icons location_bookmark"></i> Giới thiệu qua</label><br />
                <textarea name="short_desc" id="" cols="30" rows="3" class="typography-line" style="border-radius:15px;"></textarea>
            </div>
            <div class="form-group">
                <label for="product-title"><i class="now-ui-icons travel_info"></i> Mô tả</label><br />
                <textarea name="product_description" id="" cols="50" rows="10" class="typography-line" style="border-radius:15px;"></textarea>
            </div>
        </div>
        <aside id="admin_sidebar" class="col-md-4">
            <div class="form-group row">
                <div class="col-xs-6">
                    <label for="product-price"><i class="fa fa-fas fa-usd-square"></i> Mức giá</label>
                    <input type="number" name="product_price" class="form-control" size="60">
                </div>
            </div>
            <div class="form-group">
                <label for="product-title"><i class="fa fa-fal fa-pen"></i> Số lượng</label>
                <input type="number" name="product_quantity" class="form-control">
            </div>
            <div class="form-group">
                <label for="product-title"><i class="fa fa-list"></i> Phân loại</label>
                <select name="product_category_id" id="" class="form-control">
                    <option value="<?php echo $product_category_id; ?>">Chọn danh mục</option>
                    <?php show_categories_add_product(); ?>
                </select>
            </div>
            <div>
                <label for="product-title"><i class="fa fa-image"></i> Hình ảnh</label>
                <input type="file" name="file" >
            </div>
            <div style="padding:10px;"></div>
            <div class="form-group">
                <input type="submit" name="publish" class="btn btn-primary btn-lg" value=" Thêm sản phẩm" style=" margin-left: 25px; border-radius:25px;"></br>
                <input type="submit" name="draft" class='btn btn-warning btn-lg' value=" Lưu dưới dạng bản nháp" style="border-radius:25px;"></i>
            </div>
        </aside>
    </form>
</div>