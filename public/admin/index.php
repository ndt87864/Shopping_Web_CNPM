<?php require_once('..\..\kresources\config.php'); ?>
<?php include(TEMPLATE_BACK . '\header.php'); ?>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['username'])) {
    $_SESSION['username'] = $username;
    redirect('..\..\public');
}
?>

    <div class="container-fluid">
        <?php
        if ($_SERVER['REQUEST_URI'] == "/Shopping_Web_CNPM/public/admin/" || $_SERVER['REQUEST_URI'] == "/Shopping_Web_CNPM/public/admin/index.php") {
            include(TEMPLATE_BACK . '/admin_ct.php');
        }
        if (isset($_GET['order_id'])) {
            include(TEMPLATE_BACK . '/update_status.php');
        }
        // Hiển thị trang orders
        if (isset($_GET['revenue'])) {
            include(TEMPLATE_BACK . '/revenue.php');
        }
        if (isset($_GET['custom_day'])) {
            include(TEMPLATE_BACK . '/custom_day.php');
        }
        if (isset($_GET['day'])) {
            include(TEMPLATE_BACK . '/day.php');
        }

        if (isset($_GET['month'])) {
            include(TEMPLATE_BACK . '/month.php');
        }

        if (isset($_GET['year'])) {
            include(TEMPLATE_BACK . '/year.php');
        }


        if (isset($_GET['admin_order'])|| isset($_GET['ad_order'])) {
            
            include(TEMPLATE_BACK . '/admin_order.php');
        }
        if (isset($_GET['order_code'])) {
            include(TEMPLATE_BACK . '/search_order.php');
        }
        if (isset($_GET['ad_process'])) {
            
            
            include(TEMPLATE_BACK  . '\ad_process.php');
        }
        
        if (isset($_GET['ad_confirm'])) {
            
            include(TEMPLATE_BACK  . '\ad_confirm.php');
        }
        
        if (isset($_GET['ad_ship'])) {
            
            include(TEMPLATE_BACK  . '\ad_ship.php');
        }
        
        if (isset($_GET['ad_delive'])) {
            
            include(TEMPLATE_BACK  . '\ad_delive.php');
        }
        // Hiển thị trang products
        if (isset($_GET['products'])) {
            include(TEMPLATE_BACK . '/products.php');
        }
        if (isset($_GET['amount'])) {
            include(TEMPLATE_BACK . '/amount.php');
        }
        //trang hien thị comment
        if (isset($_GET['comment'])) {
            include(TEMPLATE_BACK . '/comment.php');
        }
        //trang hien thị comment
        if (isset($_GET['display_comment'])) {
            include(TEMPLATE_BACK . '/display_comment.php');
        }
        //sp tìm kiếm được
        if (isset($_POST['submit'])) {
            include(TEMPLATE_BACK . '/display_product.php');
        }
        //sp theo bộ lọc
        if (isset($_POST['up'])) {
            include(TEMPLATE_BACK . '/cat_product.php');
        }
        // Hiển thị trang categories
        if (isset($_GET['categories'])) {
            include(TEMPLATE_BACK . '/categories.php');
        }
        // Hiển thị trang chỉnh sửa sản phẩm
        if (isset($_GET['edit_product'])) {
            include(TEMPLATE_BACK . '/edit_product.php');
        }
        if (isset($_GET['edit_amount'])) {
            include(TEMPLATE_BACK . '/edit_amount.php');
        }
        if (isset($_GET['flash_sale'])) {
            include(TEMPLATE_BACK . '/flash_sale.php');
        }

        // Hiển thị trang thêm sản phẩm
        if (isset($_GET['add_product'])) {
            include(TEMPLATE_BACK . '/add_product.php');
        }

        // Hiển thị trang users
        if (isset($_GET['users'])) {
            include(TEMPLATE_BACK . '/users.php');
        }

        // Hiển thị trang  người dùng đơn
        if (isset($_GET['detail_id'])) {
            include(TEMPLATE_BACK . '/detail_user.php');
        }

        // Hiển thị trang chỉnh sửa người dùng
        if (isset($_GET['edit_users'])) {
            include(TEMPLATE_BACK . '/edit_users.php');
        }
        if (isset($_GET['support'])) {
            include(TEMPLATE_BACK . '/support.php');
        }
        if (isset($_GET['message_id'])) {
            include(TEMPLATE_BACK . '/messages.php');
        }
        // Hiển thị trang slide mới
        if (isset($_GET['slides'])) {
            include(TEMPLATE_BACK . '/slides.php');
        }

        // Hiển thị trang xóa slide
        if (isset($_GET['delete_slide_id'])) {
            include(TEMPLATE_BACK . '/delete_slide.php');
        }
        ?>
    </div>
<?php include(TEMPLATE_BACK . '/footer.php'); ?>