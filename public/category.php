<?php require_once('..\kresources\config.php'); ?>
<?php include(TEMPLATE_FRONT.DS.'header_admin.php'); ?>

    <!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header -->
      

        <!-- Title -->
        <div class="row">
            <div class="col-lg-12">
                <h3>Danh Mục</h3>
            </div>
        </div>
        <!-- /.row -->

        <!-- Page Features -->
        <div class="row text-center">
       
       
       <?php get_products_in_ad_category_page()?>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->

        <!-- Footer -->
        
  <?php include(TEMPLATE_FRONT.DS.'footer.php'); ?>