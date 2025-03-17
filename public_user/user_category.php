<?php require_once("..\kresources\config.php"); ?>
<?php if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    include(TEMPLATE_FRONT_USER . DS . 'header_user.php');
} else {
    include(TEMPLATE_FRONT . DS . 'header.php');
} ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h3>Danh sách sản phẩm</h3>
        </div>
    </div>
    <div class="row text-center">
        <?php get_products_in_category_page() ?>
    </div>
</div>
<?php include(TEMPLATE_FRONT_USER . DS . 'footer.php'); ?>