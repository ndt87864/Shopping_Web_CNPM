<?php require_once('..\kresources\config.php'); ?>
<?php if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    include(TEMPLATE_FRONT_USER . DS . 'header_user.php');
} else {
    include(TEMPLATE_FRONT . DS . 'header.php');
} ?>

<!-- Page Content -->
<div class="container">
    </br />
    <br />
    <div class="col-md-12">
        <div class="row carousel-holder">
            </br />
            <?php include(TEMPLATE_FRONT_USER . DS . 'user_side_nav.php'); ?>
            <div class="col-md-9">

                <!--Carouse-->
                <?php include(TEMPLATE_FRONT_USER . DS . 'user_slider.php'); ?>

            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="col-md-12">
        <div class="row carousel-holder">
            <?php include(TEMPLATE_FRONT_USER . DS . 'user_products.php');
            if (isset($_GET['address'])) {
                include(TEMPLATE_BACK_USER . '\address.php');
            }?>
        </div>
    </div>
</div>
<!-- /.container -->

<?php include(TEMPLATE_FRONT_USER . DS . 'footer.php'); ?>