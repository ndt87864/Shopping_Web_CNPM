<?php require_once('..\kresources\config.php'); ?>
<?php
if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    include(TEMPLATE_FRONT_USER . DS . 'header_user.php');
} else {
    include(TEMPLATE_FRONT . DS . 'header.php');
}
?>


<!-- Page Content -->
<div class="container">
    </br />
    <br />
    <!-- Title -->
    <div class="row">
        <div class="col-lg-12">
            <br />
            <h1>Toàn bộ sản phẩm</h1>
        </div>
    </div>
    <!-- /.row -->
    <!-- Page Features -->
    <div class="row" style="border-radius:25px;">
        <?php get_products_in_shop_page(); ?>
    </div>
    <!-- /.row -->
</div>
<!-- /.container -->

<!-- Footer -->

<?php include(TEMPLATE_FRONT_USER.DS.'footer.php'); ?>