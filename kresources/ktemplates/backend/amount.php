<div class="container-fluid">
    <div class="row">
        <h1 class="col-12">
            Quản lý kho hàng
        </h1>
        <div class="col-12">
            <h3 class="bg-success">
                <?php display_message(); ?>
            </h3>
            <h3 class="bg-success">
                <?php display_message(); ?>
            </h3>
        </div>

        <div class="col-md-12" id="productData">
            <table class="table table-hover" style="border-radius:15px;">
                <?php get_products_amount_in_admin(); ?>
            </table>
        </div>
    </div>
</div>