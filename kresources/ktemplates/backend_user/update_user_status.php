<?php
require_once(__DIR__ . "/../../config.php");

if (isset($_GET['buy_code'])) {
    $buy_code = $_GET['buy_code'];

    $query_order_info = query("SELECT user_name, product_name, price, quantity, amount, photo, buyad,add_date FROM buy WHERE buy_code = '{$buy_code}'");
    confirm($query_order_info);
    $row = fetch_array($query_order_info);
    $user_name = $row['user_name'];
    $product_name = $row['product_name'];
    $price = $row['price'];
    $quantity = $row['quantity'];
    $amount = $row['amount'];
    $photo = $row['photo'];
    $buyad = $row['buyad'];
    $date = $row['add_date'];
    $query = query("UPDATE buy SET status = 'Đã hoàn thành', add_date ='{$date}', receive_date = CURRENT_TIMESTAMP WHERE buy_code = '{$buy_code}'");
    $query_orders = query("INSERT INTO orders (order_code,order_name, order_quantity, order_amount, order_status, order_currency) 
        VALUES ('{$buy_code}','{$product_name}', '{$quantity}', '{$amount}', 'Đã hoàn thành', 'VND')");
    $query_date = query("UPDATE orders SET get_date = CURRENT_TIMESTAMP WHERE order_code = '{$buy_code}'");
    confirm($query_orders);
    confirm($query);
    set_message("Cập nhật trạng thái thành công");
    redirect("index_user.php?delive");
}
?>