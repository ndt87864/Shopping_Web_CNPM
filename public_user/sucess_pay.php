<?php require_once('..\kresources\config.php'); ?>

<?php require_once('..\kresources\cart.php'); ?>
<?php include(TEMPLATE_FRONT_USER . DS . 'header_user.php'); ?>
<?php
if (isset($_GET['vnp_ResponseCode']) && $_GET['vnp_ResponseCode'] == '00') {
    global $connection;
    $item_quantity = 0;
    $user_name = "";
    $user_id = $_SESSION['user_id'];
    $buy_codes = array();
    $query_user = query("SELECT username FROM users WHERE user_id = " . escape_string($user_id));
    confirm($query_user);
    while ($row_user = fetch_array($query_user)) {
        $user_name = $row_user['username'];
    }
    foreach ($_SESSION['selected_products'] as $selected_product) {
        $query = query("SELECT * FROM amount WHERE product_id = " . escape_string($selected_product));
        confirm($query);
        while ($row = fetch_array($query)) {
            $product_id = $row['product_id'];
            $product_photo = show_product_photo($product_id);
            $product_title = show_product_title($product_id);
            $buy_code = rand(100000000, 987654567);
            $buy_codes[] = $buy_code;
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $current = time();
            $current_time = date('Y-m-d H:i:s', $current);
            $start_date = $row['start_date'];
            $end_date = $row['end_date'];
            if ($current_time >= $start_date && $current_time < $end_date && $row['sale_quantity'] > 0) {
                $price = $row['sale_price'];
                $sub = $row['sale_price'] * $_SESSION["product_" . $selected_product];
            } else {
                $price = $row['product_price'];
                $sub = $row['product_price'] * $_SESSION["product_" . $selected_product];

            }
            $query2 = "INSERT INTO buy(buy_code,user_name, product_name, price, quantity, amount, status,payment , photo, buyad)
            VALUES('{$buy_code}','{$user_name}', '{$product_title}', '{$price}', '{$_SESSION["product_" . $selected_product]}',
           '{$sub}', 'Đang xử lý', 'vnpay', '{$product_photo}', '{$_SESSION['fulladdress']}')";
            confirm($query2);
            $result = mysqli_query($connection, $query2);
            if (!$result) {
                die('Query FAILED' . mysqli_error($connection));
            }
            unset($_SESSION['item_quantity']);
            unset($_SESSION['item_total']);

            // Trừ số lượng sản phẩm trong cơ sở dữ liệu
            if ($current_time >= $start_date && $current_time < $end_date) {
                $query4 = "UPDATE amount
                    SET sale_quantity = sale_quantity - {$_SESSION["product_" . $selected_product]} ,
                    product_quantity = product_quantity - {$_SESSION["product_" . $selected_product]} 
                    WHERE product_id = {$selected_product}";
                unset($_SESSION["product_" . $selected_product]);
                confirm($query4);
                $result3 = mysqli_query($connection, $query4);
                if (!$result3) {
                    die('Query FAILED' . mysqli_error($connection));
                }
            } else {
                $query4 = "UPDATE amount 
                    SET product_quantity = product_quantity - {$_SESSION["product_" . $selected_product]} 
                     WHERE product_id = {$selected_product}";
                unset($_SESSION["product_" . $selected_product]);
                confirm($query4);
                $result3 = mysqli_query($connection, $query4);
                if (!$result3) {
                    die('Query FAILED' . mysqli_error($connection));
                }

            }
        }
    }
    $buy_codes_string = implode(',', $buy_codes);
    echo "<script>window.location='thank_you.php?buy_codes=$buy_codes_string';</script>";
} elseif ($_GET['vnp_ResponseCode'] != '00') {
    echo "<script>alert('Thanh toán không thành công!trở lại giỏ hàng'); window.location='checkout.php';</script>";
}
?>