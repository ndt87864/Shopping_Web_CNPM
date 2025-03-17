<?php require_once("..\..\config.php");


if(isset($_GET['report_id'])) {
$name_query=query("SELECT* FROM reports WHERE report_id = " . escape_string($_GET['report_id']) . " ");
confirm($name_query);
$row = fetch_array($name_query);
$name=$row["product_name"];
$query = query("DELETE FROM reports WHERE report_id = " . escape_string($_GET['report_id']) . " ");
confirm($query);
set_message("Đã xóa comment");
redirect("..\..\..\public\admin\index.php?display_comment&product_name=" .$name. "");
} else {
redirect("..\..\..\public\admin\index.php?display_comment&product_name=" .$name. "");
}
?>