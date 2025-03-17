<?php 
require_once("..\..\config.php");
if(isset($_GET['id'])){
$query = query("DELETE FROM products WHERE product_id = " .escape_string($_GET['id'])."");
confirm($query);
$amount_query = query("DELETE FROM amount WHERE product_id = " .escape_string($_GET['id'])."");
confirm($amount_query);
set_message("đã xóa sản phẩm");
redirect("..\..\..\public\admin\index.php?products");
}else{
redirect("..\..\..\public\admin\index.php?products");

}




?>