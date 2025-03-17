<?php require_once('..\..\kresources\config.php'); ?>
<?php include(TEMPLATE_BACK_USER . '\header_user.php'); ?>
<?php if (!isset($_SESSION['username'])) {
    redirect('..\..\public_user\index_user.php');
}

?>

    <div class="container-fluid">


        <?php
        if ($_SERVER['REQUEST_URI'] == "/Shopping_Web_CNPM/public_user/user/" || $_SERVER['REQUEST_URI'] == "/Shopping_Web_CNPM/public_user/user/index_user.php") {
            include(TEMPLATE_BACK_USER  . '\user.php');
        }
        //orders******************************************************************************
        if (isset($_GET['cus_support'])) {
            include(TEMPLATE_BACK_USER  . '\cus_support.php');
        }
        if (isset($_GET['message_id'])) {
            include(TEMPLATE_BACK_USER . '/message.php');
        }
        if (isset($_GET['chat'])) {
            include(TEMPLATE_BACK_USER . '/chat.php');
        }
        if (isset($_GET['order'])) {
            include(TEMPLATE_BACK_USER  . '\order.php');
        }
        if (isset($_GET['process'])) {
            include(TEMPLATE_BACK_USER  . '\process.php');
        }
        
        if (isset($_GET['confirm'])) {
            include(TEMPLATE_BACK_USER  . '\confirm.php');
        }
        
        if (isset($_GET['ship'])) {
            include(TEMPLATE_BACK_USER  . '\ship.php');
        }
        
        if (isset($_GET['delive'])) {
            include(TEMPLATE_BACK_USER  . '\delive.php');
        }
        
        if (isset($_GET['detail_order'])) {
            include(TEMPLATE_BACK_USER . '/detail_order.php');
        }
        if (isset($_GET['report'])) {
            include(TEMPLATE_BACK_USER . '/report.php');
        }
        if (isset($_GET['update_user_status'])) {
            include(TEMPLATE_BACK_USER . '/update_user_status.php');
        }
        //adding products**********************************************************************
        //users*******************************************************************************
        if (isset($_GET['id'])) {
            include(TEMPLATE_BACK_USER  . '\edit_address.php');
        }
        if (isset($_GET['address'])) {
            include(TEMPLATE_BACK_USER  . '\address.php');
        }

        if (isset($_GET['edit_user'])) {
            include(TEMPLATE_BACK_USER  . '\edit_user.php');
        }
        if (isset($_GET['add_address'])) {
            include(TEMPLATE_BACK_USER  . '\add_address.php');
        }




        ?>
    </div>
<!-- /#page-wrapper -->
<?php include(TEMPLATE_BACK_USER . '\footer_user.php'); ?>