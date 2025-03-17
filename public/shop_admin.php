<?php require_once('..\kresources\config.php'); ?>
<?php include(TEMPLATE_FRONT . DS . 'header_admin.php');
?>
<br />
<div class="container">
    <div class="row">
        <br />
        <div class="col-lg-12">
            <h1>Tất cả sản phẩm</h1>
        </div>
    </div>
    <div class="row text-center">


        <?php get_products_in_admin_shop_page(); ?>
    </div>
</div>

<?php include(TEMPLATE_FRONT . DS . 'footer.php'); ?>