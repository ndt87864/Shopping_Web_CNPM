<?php
require_once(__DIR__ . "/../../config.php");

if (isset($_GET['order_id']) && isset($_POST['edit_status'])) {
    $status = $_POST['status'];
    $id = $_GET['order_id'];

    $page = $_SESSION["page"];
    // Truy vấn dữ liệu từ cơ sở dữ liệu để lấy thông tin về đơn hàng
    $query_order_info = query("SELECT  buy_code,user_name, product_name, price, quantity, amount, status, photo, buyad,add_date FROM buy WHERE id = '{$id}'");
    confirm($query_order_info);
    $row = fetch_array($query_order_info);
    $buy_code = $row['buy_code'];
    $user_name = $row['user_name'];
    $product_name = $row['product_name'];
    $price = $row['price'];
    $quantity = $row['quantity'];
    $amount = $row['amount'];
    $photo = $row['photo'];
    $buyad = $row['buyad'];
    $date = $row['add_date'];

    if ($status == 'Đã hoàn thành') {
        $query = query("UPDATE buy SET status = '{$status}', add_date ='{$date}', receive_date = CURRENT_TIMESTAMP WHERE id = '{$id}'");
        $query_orders = query("INSERT INTO orders (order_code,order_name, order_quantity, order_amount, order_status, order_currency) 
        VALUES ('{$buy_code}','{$product_name}', '{$quantity}', '{$amount}', '{$status}', 'VND')");
        $query_date = query("UPDATE orders SET get_date = CURRENT_TIMESTAMP WHERE order_id = '{$product_name}'");
        confirm($query_orders);
    } else {
        $query = query("UPDATE buy SET status = '{$status}' WHERE id = '{$id}'");
    }
    confirm($query);
    set_message("Cập nhật trạng thái thành công");
    if ($page == 6) {
        $link = 'index.php?admin_order';
    } elseif ($page == 7) {
        $link = 'index.php?ad_process';
    } elseif ($page == 8) {
        $link = 'index.php?ad_confirm';
    } elseif ($page == 9) {
        $link = 'index.php?ad_ship';
    } elseif ($page == 10) {
        $link = 'index.php?ad_delive';
    } elseif ($page == 11) {
        $link = 'index.php?order_code=' .$buy_code. '';
    }
    redirect("../admin/$link");
}
?>