<?php
require_once("..\..\config.php");

if (isset($_GET['id'])) {
    $query1 = query("SELECT * FROM buy WHERE id = " . escape_string($_GET['id']));
    $row = fetch_array($query1);
    $title = $row["product_name"];
    $new_quantity = $row["quantity"];
    $price = $row["price"];
    $query3 = query("SELECT * FROM products WHERE product_title='$title'");
    confirm($query3);
    $product = fetch_array($query3);
    $id = $product['product_id'];
    $query4 = query("SELECT * FROM amount WHERE product_id = '$id'");
    confirm($query4);
    $amount = fetch_array($query4);
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $current = time();
    $current_time = date('Y-m-d H:i:s', $current);
    $start_date = $amount['start_date'];
    $end_date = $amount['end_date'];
    if ($amount['sale_price'] == $price && ($current_time > $start_date && $current_time < $end_date)) {
        $amounts = $amount['sale_quantity'] + $row["quantity"];
        $query_amount = "UPDATE amount SET sale_quantity = {$amounts} WHERE product_id = " . $id;
        $query_sale = query($query_amount);
        confirm($query_sale);
    }
    $quan = $amount['product_quantity'] + $new_quantity;
    $query2 = "UPDATE amount SET product_quantity = {$quan} WHERE product_id = " . $id;
    $query_result = query($query2);
    confirm($query_result);
    $query = query("DELETE FROM buy WHERE id = " . escape_string($_GET['id']) . "");
    confirm($query);
    set_message("đã xóa");
    redirect("..\..\..\public_user\user\index_user.php?order");
} else {
    redirect("..\..\..\public_user\user\index_user.php?order");

}
?>