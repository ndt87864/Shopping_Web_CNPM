<?php require_once('config.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception; ?>
<?php
//Helper Function

///below global variable upload
$upload_path = "uploads";
//chuyển đến đường link
function redirect($location)
{
    header("Location: $location ");
}

//thông báo
function set_message($msg)
{

    if (!empty($msg)) {
        $_SESSION['message'] = $msg;
    } else {
        $msg = "";
    }
}

//########################################


//########################################
//########################################


//########################################
//Thông báo sai mật khẩu
function display_message()
{
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }

}
//########################################


//#######################################
//########################################
//lấy dữ liệu db

function query($sql)
{
    global $connection;
    return mysqli_query($connection, $sql);
}
//#######################################

//########################################
//thông báo lỗi db
function confirm($results)
{
    global $connection;
    if (!$results) {
        die("LỖI!" . mysqli_error($connection));
    }

}
//########################################

//#######################################
//kết nối đến db vs gt dc lấy
function escape_string($string)
{
    global $connection;
    return mysqli_real_escape_string($connection, $string);
}
//#########################################

//#######################################
//lấy chuỗi dl db
function fetch_array($results)
{
    return mysqli_fetch_array($results);
}
//#########################################
//**********************************************************************FRONTEND FUNCTIONS************************************
//########################################
//ht sp ở home
function get_product()
{
    $query = query("SELECT * FROM products");
    confirm($query);

    $rows = mysqli_num_rows($query); // Get total of mumber of rows from the database
    if (isset($_GET['page'])) { //get page from URL if its there
        $page = preg_replace('#[^0-9]#', '', $_GET['page']); //filter everything but numbers
    } else { // If the page url variable is not present force it to be number 1
        $page = 1;
    }
    $perPage = 8; // Items per page here 
    $lastPage = ceil($rows / $perPage); // Get the value of the last page
// Be sure URL variable $page(page number) is no lower than page 1 and no higher than $lastpage
    if ($page < 1) { // If it is less than 1
        $page = 1; // force if to be 1
    } elseif ($page > $lastPage) { // if it is greater than $lastpage
        $page = $lastPage; // force it to be $lastpage's value
    }
    $middleNumbers = ''; // Initialize this variable

    // This creates the numbers to click in between the next and back buttons
    $sub1 = $page - 1;
    $sub2 = $page - 2;
    $add1 = $page + 1;
    $add2 = $page + 2;

    if ($page == 1) {
        $middleNumbers .= '<li class="page-item active"><a>' . $page . '</a></li>';
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $add1 . '">' . $add1 . '</a></li>';
    } elseif ($page == $lastPage) {
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $sub1 . '">' . $sub1 . '</a></li>';
        $middleNumbers .= '<li class="page-item active"><a>' . $page . '</a></li>';
    } elseif ($page > 2 && $page < ($lastPage - 1)) {
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $sub2 . '">' . $sub2 . '</a></li>';
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $sub1 . '">' . $sub1 . '</a></li>';
        $middleNumbers .= '<li class="page-item active"><a>' . $page . '</a></li>';
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $add1 . '">' . $add1 . '</a></li>';
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $add2 . '">' . $add2 . '</a></li>';
    } elseif ($page > 1 && $page < $lastPage) {
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page= ' . $sub1 . '">' . $sub1 . '</a></li>';
        $middleNumbers .= '<li class="page-item active"><a>' . $page . '</a></li>';
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $add1 . '">' . $add1 . '</a></li>';
    }
    // This line sets the "LIMIT" range... the 2 values we place to choose a range of rows from database in our query
    $limit = 'LIMIT ' . ($page - 1) * $perPage . ',' . $perPage;
    // $query2 is what we will use to to display products with out $limit variable
    $query2 = query(" SELECT * FROM products $limit");
    confirm($query2);
    $outputPagination = ""; // Initialize the pagination output variable
// if($lastPage != 1){
//    echo "Page $page of $lastPage";
// }
    // If we are not on page one we place the back link

    if ($page != 1) {
        $prev = $page - 1;
        $outputPagination .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $prev . '">Back</a></li>';
    }
    // Lets append all our links to this variable that we can use this output pagination

    $outputPagination .= $middleNumbers;
    // If we are not on the very last page we the place the next link

    if ($page != $lastPage) {
        $next = $page + 1;
        $outputPagination .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $next . '">Next</a></li>';
    }
    $count = 0;
    while ($row = fetch_array($query2)) {
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        if (strlen($product_title) > 15) { // Giới hạn độ dài của product_title
            $product_title = substr($product_title, 0, 15) . '...'; // Cắt chuỗi và thêm elipsis
        }
        $product_query = query("SELECT * FROM amount WHERE product_id = '{$product_id}' ");
        confirm($product_query);
        $products_row = fetch_array($product_query);
        $product_photo = display_images($row['product_image']);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $current = time();
        $current_time = date('Y-m-d H:i:s', $current);
        $start_date = $products_row['start_date'];
        $end_date = $products_row['end_date'];
        $sale_price = number_format($products_row['sale_price']);
        $price = number_format($products_row['product_price']);
        $percent = round(100 - (($products_row['sale_price'] / $products_row['product_price']) * 100));
        if ($current_time >= $start_date && $current_time < $end_date && $products_row['sale_quantity'] > 0) {
            $products = <<<DELIMETER
            <div class="col-sm-3 col-lg-3 col-md-3">
                <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
                    <div class="col pd-cart" >
                        <div class="card h-100 shadow-sm" style="border-radius: 25px;">
                            <div class="card-body">
                                    
                                    <a href="item.php?id={$row['product_id']}">
                                    <img src="../kresources/{$product_photo}" alt="" class="center-block" style="width: 80%; height: 162px;"></a>
                                    <h4 class="card-title text-center">
                                        <a href="item.php?id={$row['product_id']}">{$product_title}</a>
                                    </h4>
                                <div class="clearfix mb-3 text-center"> 
                                        
                                     <s >{$price} đ</s><br>
                                     
                                    <span class="price-btn float-none badge rounded-pill bg-success" style="border-radius: 25px;">
                                   <i class="fas fa-bolt"> -$percent%</i>
                                   {$sale_price} Đồng</span>
                                    <div style="padding: 2px;"></div>
                                </div>
                                <div class="d-grid gap-2 my-4 text-center">  
                                    <a class="btn btn-primary"  href="item.php?id={$row['product_id']}" style="border-radius: 25px;" >Xem thêm</a> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            DELIMETER;
        } else {
            $product_price = <<<DELIMETER
            <span class="price-btn float-none badge rounded-pill bg-success" style="border-radius: 25px;">
            {$price} Đồng</span>
            
            DELIMETER;
            if ($products_row['product_quantity'] > 0) {
                $products = <<<DELIMETER
            <div class="col-sm-3 col-lg-3 col-md-3" >
                <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
                    <div class="col pd-cart">
                        <div class="card h-100 shadow-sm"  style="border-radius: 25px;">
                            <div class="card-body">
                                    <a href="item.php?id={$row['product_id']}">
                                    <img src="../kresources/{$product_photo}" alt="" class="center-block" style="width: 80%; height: 182px;"></a>
                                    <h4 class="card-title text-center">
                                        <a href="item.php?id={$row['product_id']}">{$product_title}</a>
                                    </h4>
                                <div class="clearfix mb-3 text-center"> 
                                        $product_price
                                    <div style="padding: 2px;"></div>
                                </div>
                                <div class="d-grid gap-2 my-4 text-center">  
                                    <a class="btn btn-primary"  href="item.php?id={$row['product_id']}" style="border-radius: 25px;" >Xem thêm</a> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            DELIMETER;
            } else {
                $products = <<<DELIMETER
            <div class="col-sm-3 col-lg-3 col-md-3">
                <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
                    <div class="col pd-cart">
                        <div class="card h-100 shadow-sm"  style="border-radius: 25px;">
                            <div class="card-body">
                                
                                    <a href="item.php?id={$row['product_id']}"><img src="../kresources/{$product_photo}" alt="" style="width: 282px; height: 182px;"></a>
                                    <h4 class="card-title text-center">
                                    <a href="item.php?id={$row['product_id']}">{$product_title}</a>
                                    </h4>
                                <div class="clearfix mb-3 text-center"> 
                                    <span class="price-btn float-none badge rounded-pill bg-success" style="border-radius: 25px;">{$price} Đồng</span>
                                    <div style="padding: 2px;"></div>
                                </div>
                                <div class="d-grid gap-2 my-4 text-center">
                                    <a href="item.php?id={$row['product_id']}" class="btn btn-primary bold-btn" style="border-radius: 25px;">Hết hàng</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            DELIMETER;
            }
        }
        if ($count % 4 == 0) {
            echo '<div class="row">';
        }
        echo $products;

        $count++;
        if ($count % 4 == 0) {
            echo '</div>';
        }
    }
    echo "<div class='text-center'><ul class='pagination'>{$outputPagination}</ul></div>";
}

//ht sp ở home user
function get_user_product()
{
    $query = query("SELECT * FROM products");
    confirm($query);

    $rows = mysqli_num_rows($query); // Get total of mumber of rows from the database
    if (isset($_GET['page'])) { //get page from URL if its there
        $page = preg_replace('#[^0-9]#', '', $_GET['page']); //filter everything but numbers
    } else { // If the page url variable is not present force it to be number 1
        $page = 1;
    }
    $perPage = 8; // Items per page here 
    $lastPage = ceil($rows / $perPage); // Get the value of the last page
// Be sure URL variable $page(page number) is no lower than page 1 and no higher than $lastpage
    if ($page < 1) { // If it is less than 1
        $page = 1; // force if to be 1
    } elseif ($page > $lastPage) { // if it is greater than $lastpage
        $page = $lastPage; // force it to be $lastpage's value
    }
    $middleNumbers = ''; // Initialize this variable

    // This creates the numbers to click in between the next and back buttons
    $sub1 = $page - 1;
    $sub2 = $page - 2;
    $add1 = $page + 1;
    $add2 = $page + 2;

    if ($page == 1) {
        $middleNumbers .= '<li class="page-item active"><a>' . $page . '</a></li>';
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $add1 . '">' . $add1 . '</a></li>';
    } elseif ($page == $lastPage) {
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $sub1 . '">' . $sub1 . '</a></li>';
        $middleNumbers .= '<li class="page-item active"><a>' . $page . '</a></li>';
    } elseif ($page > 2 && $page < ($lastPage - 1)) {
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $sub2 . '">' . $sub2 . '</a></li>';
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $sub1 . '">' . $sub1 . '</a></li>';
        $middleNumbers .= '<li class="page-item active"><a>' . $page . '</a></li>';
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $add1 . '">' . $add1 . '</a></li>';
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $add2 . '">' . $add2 . '</a></li>';
    } elseif ($page > 1 && $page < $lastPage) {
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page= ' . $sub1 . '">' . $sub1 . '</a></li>';
        $middleNumbers .= '<li class="page-item active"><a>' . $page . '</a></li>';
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $add1 . '">' . $add1 . '</a></li>';
    }
    // This line sets the "LIMIT" range... the 2 values we place to choose a range of rows from database in our query
    $limit = 'LIMIT ' . ($page - 1) * $perPage . ',' . $perPage;
    // $query2 is what we will use to to display products with out $limit variable
    $query2 = query(" SELECT * FROM products $limit");
    confirm($query2);
    $outputPagination = ""; // Initialize the pagination output variable
// if($lastPage != 1){
//    echo "Page $page of $lastPage";
// }
    // If we are not on page one we place the back link

    if ($page != 1) {
        $prev = $page - 1;
        $outputPagination .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $prev . '">Back</a></li>';
    }
    // Lets append all our links to this variable that we can use this output pagination

    $outputPagination .= $middleNumbers;
    // If we are not on the very last page we the place the next link

    if ($page != $lastPage) {
        $next = $page + 1;
        $outputPagination .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $next . '">Next</a></li>';
    }
    $count = 0;
    while ($row = fetch_array($query2)) {
        $link = isset($_SESSION['username']) && !empty($_SESSION['username'])
            ? "..\kresources\cart.php?add={$row['product_id']}"
            : "javascript:alert('Cần đăng nhập để đặt hàng!');window.location.href='login.php';";
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        if (strlen($product_title) > 15) { // Giới hạn độ dài của product_title
            $product_title = substr($product_title, 0, 15) . '...'; // Cắt chuỗi và thêm elipsis
        }
        $product_query = query("SELECT * FROM amount WHERE product_id = '{$product_id}' ");
        confirm($product_query);
        $products_row = fetch_array($product_query);
        $product_photo = display_images($row['product_image']);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $current = time();
        $current_time = date('Y-m-d H:i:s', $current);
        $start_date = $products_row['start_date'];
        $end_date = $products_row['end_date'];
        $sale_price = number_format($products_row['sale_price']);
        $price = number_format($products_row['product_price']);
        $percent = round(100 - (($products_row['sale_price'] / $products_row['product_price']) * 100));
        if ($current_time >= $start_date && $current_time < $end_date && $products_row['sale_quantity'] > 0) {
            $products = <<<DELIMETER
            <div class="col-sm-3 col-lg-3 col-md-3">
                <div class="col pd-cart" >
                    <div class="card h-100 shadow-sm"  style="border-radius: 25px;background: linear-gradient(to right, #ff9966, #ff5e62);">
            <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
                        <div class="card-body" style="">
                            <a href="item_user.php?id={$row['product_id']}">
                            <img src="../kresources/{$product_photo}" alt="" class="center-block" style="width: 80%; height: 165px;"></a>
                            <h4 class="card-title text-center">
                                <a href="item_user.php?id={$row['product_id']}">{$product_title}</a>
                            </h4>
                            <div class="clearfix mb-3 text-center"> 
                                <s >{$price} đ</s><br>
                                <span class="price-btn float-none badge rounded-pill bg-success" style="border-radius: 25px;">
                                <i class="fas fa-bolt"> -$percent%</i>
                                {$sale_price} Đồng</span>
                                <div style="padding: 2px;"></div>
                            </div>
                            <div class="d-grid gap-2 my-4 text-center">  
                                <a href="{$link}" class="btn btn-warning" style="border-radius: 25px;">Đặt Mua Ngay</a>   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       DELIMETER;
        } else {
            if ($products_row['product_quantity'] > 0) {
                $products = <<<DELIMETER
            <div class="col-sm-3 col-lg-3 col-md-3" >
                <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
                    <div class="col pd-cart">
                        <div class="card h-100 shadow-sm"  style="border-radius: 25px;">
                            <div class="card-body">
                                    <a href="item_user.php?id={$row['product_id']}">
                                    <img src="../kresources/{$product_photo}" alt="" class="center-block" style="width: 80%; height: 182px;"></a>
                                    <h4 class="card-title text-center">
                                        <a href="item_user.php?id={$row['product_id']}">{$product_title}</a>
                                    </h4>
                                <div class="clearfix mb-3 text-center"> 
                                    <span class="price-btn float-none badge rounded-pill bg-success" style="border-radius: 25px;">{$price} Đồng</span>
                                    <div style="padding: 2px;"></div>
                                </div>
                                <div class="d-grid gap-2 my-4 text-center">
                                    <a href="{$link}" class="btn btn-warning" style="border-radius: 25px;">Đặt Mua Ngay</a>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            DELIMETER;
            } else {
                $products = <<<DELIMETER
            <div class="col-sm-3 col-lg-3 col-md-3">
                <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
                    <div class="col pd-cart">
                        <div class="card h-100 shadow-sm"  style="border-radius: 25px;">
                            <div class="card-body">
                                
                                    <a href="item.php?id={$row['product_id']}"><img src="../kresources/{$product_photo}" alt="" style="width: 282px; height: 182px;"></a>
                                    <h4 class="card-title text-center">
                                    <a href="item_user.php?id={$row['product_id']}">{$product_title}</a>
                                    </h4>
                                <div class="clearfix mb-3 text-center"> 
                                    <span class="price-btn float-none badge rounded-pill bg-success" style="border-radius: 25px;">{$price} Đồng</span>
                                    <div style="padding: 2px;"></div>
                                </div>
                                <div class="d-grid gap-2 my-4 text-center">
                                    <a href="item_user.php?id={$row['product_id']}" class="btn btn-primary bold-btn" style="border-radius: 25px;">Hết hàng</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            DELIMETER;
            }
        }
        if ($count % 4 == 0) {
            echo '<div class="row">';
        }

        echo $products;

        $count++;
        if ($count % 4 == 0) {
            echo '</div>';
        }
    }
    echo "<div class='text-center'><ul class='pagination'>{$outputPagination}</ul></div>";
}
// danh mục home
function get_categories()
{
    $query = query("SELECT * FROM categories");
    confirm($query);
    while ($row = fetch_array($query)) {
        $category_links = <<<DELIMETER
<a href='user_category.php?id={$row['cat_id']}' class='list-group-item'>{$row['cat_title']}</a>
DELIMETER;
        echo $category_links;
    }
}
//danh mục home user
function get_admin_categories()
{
    $query = query("SELECT * FROM categories");
    confirm($query);
    while ($row = fetch_array($query)) {
        $category_links = <<<DELIMETER
<a href='category.php?id={$row['cat_id']}' class='list-group-item'>{$row['cat_title']}</a>
DELIMETER;
        echo $category_links;
    }
}
//#########################################

//#######################################
//hien thị sp ở trang danh mục
function get_products_in_ad_category_page()
{
    $query = query("SELECT * FROM products WHERE product_category_id=" . escape_string($_GET['id']) . " ");
    confirm($query);
    $count = 0;
    while ($row = fetch_array($query)) {
        $product_photo = display_images($row['product_image']);
        $category_page = <<<DELIMETER
        <div class="col-sm-3 col-lg-3 col-md-3">
        <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
                <div class="col pd-cart">
                    <div class="card h-100 shadow-sm" style="border-radius:25px;">
                        <div class="card-body">
                                <a href="item.php?id={$row['product_id']}"><img src="../kresources/{$product_photo}" alt="" style="width: 282px; height: 182px;"></a>
                                <h4 class="card-title text-center">
                                    <a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
                                </h4>
                            <p>{$row['short_desc']}.</p>
                            <div class="d-grid gap-2 my-4 text-center">
                                <a class="btn btn-primary"  href="item.php?id={$row['product_id']}" >Xem thêm</a> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
DELIMETER;
        if ($count % 4 == 0) {
            echo '<div class="row">';
        }

        echo $category_page;

        $count++;
        if ($count % 4 == 0) {
            echo '</div>';
        }
    }
}
// ht sp ở danh mục user
function get_products_in_category_page()
{
    $query = query("SELECT * FROM products WHERE product_category_id=" . escape_string($_GET['id']) . " ");
    confirm($query);
    $count = 0;
    while ($row = fetch_array($query)) {
        $product_id = $row['product_id'];
        $product_photo = display_images($row['product_image']);
        $product_query = query("SELECT * FROM amount WHERE product_id = '{$product_id}' ");
        confirm($product_query);
        $products_row = fetch_array($product_query);
        if ($products_row['product_quantity'] > 0) {
            $category_page = <<<DELIMETER
            <div class="col-sm-3 col-lg-3 col-md-3">
                <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
                        <div class="col pd-cart">
                            <div class="card h-100 shadow-sm" style="border-radius: 25px;">
                                <div class="card-body">
                                    
                                        <a href="item_user.php?id={$row['product_id']}"><img src="../kresources/{$product_photo}" alt="" style="width: 282px; height: 182px;"></a>
                                        <h4 class="card-title text-center">
                                        <a href="item_user.php?id={$row['product_id']}">{$row['product_title']}</a>
                                        </h4>
                                    <div class="d-grid gap-2 my-4 text-center">
                                        <a class="btn btn-primary"  href="item_user.php?id={$row['product_id']}" style="border-radius: 25px;" >Xem thêm</a> 
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
           DELIMETER;
        } else {
            $category_page = <<<DELIMETER
            <div class="col-sm-3 col-lg-3 col-md-3" style="border-radius:25px;">
                <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
                        <div class="col pd-cart">
                            <div class="card h-100 shadow-sm" style="border-radius: 25px;">
                                <div class="card-body">
                                    
                                        <a href="item_user.php?id={$row['product_id']}"><img src="../kresources/{$product_photo}" alt="" style="width: 282px; height: 182px;"></a>
                                        <h4 class="card-title text-center">
                                        <a href="item_user.php?id={$row['product_id']}">{$row['product_title']}</a>
                                        </h4>
                                    <div class="d-grid gap-2 my-4 text-center">
                                        <a class="btn btn-danger"  href="item_user.php?id={$row['product_id']}" style="border-radius: 25px;" >Hết hàng</a> 
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
           DELIMETER;
        }
        if ($count % 4 == 0) {
            echo '<div class="row">';
        }

        echo $category_page;

        $count++;
        if ($count % 4 == 0) {
            echo '</div>';
        }
    }
}
//sp theo danh mục ở admin 
function cat_product()
{
    if (isset($_POST['up'])) {
        $product_category_id = escape_string($_POST['product_category_id']);
        if (empty($product_category_id)) {
            echo "<br/><h1 class='text-center'>Không có dữ liệu danh mục</h1>";
            return;
        }

        $query = query("SELECT * FROM products WHERE product_category_id=" . $product_category_id . " ");
        confirm($query);
        echo "
    <thead>
        <tr>
           <th>Id</th>
           <th>Tên sản phẩm</th>
           <th></th>
        </tr>
    </thead>";

        echo "<tbody ";
        while ($row = fetch_array($query)) {
            $product_photo = display_images($row['product_image']);
            $products = <<<DELIMETER
        <tr class="cell-1">
            <td>{$row['product_id']}</td>
            <td><a href="index.php?edit_product&id={$row['product_id']}&cat_id={$row['product_category_id']}"><p>{$row['product_title']}</p>
            </a><div><img src="../../kresources/{$product_photo}" alt="" style="width: 282px; height: 182px;"></div></td>
            <td>
                <a class="btn btn-danger" href="..\..\kresources\ktemplates\backend\delete_product.php?id={$row['product_id']}">
                    <span class="glyphicon glyphicon-remove"></span>
                </a>
            </td>
       </tr>
    DELIMETER;
        }

        echo $products;
        echo "</tbody>";
    }

}

//#########################################

//#######################################
//hiện sp ở shop
function get_products_in_shop_page()
{
    $query = query("SELECT * FROM products ");
    confirm($query);

    $count = 0; // Số sản phẩm hiện tại trong dòng
    while ($row = fetch_array($query)) {
        $short_desc = $row['short_desc'];
        if (strlen($short_desc) > 50) { // Giới hạn độ dài của short_desc
            $short_desc = substr($short_desc, 0, 50) . '...'; // Cắt chuỗi và thêm elipsis
        }
        $product_photo = display_images($row['product_image']);
        $link = isset($_SESSION['username']) && !empty($_SESSION['username'])
            ? "..\kresources\cart.php?add={$row['product_id']}"
            : "javascript:alert('Cần đăng nhập để đặt hàng!');window.location.href='login.php';";

        $product_id = $row['product_id'];
        $product_photo = display_images($row['product_image']);
        $product_title = $row['product_title'];
        if (strlen($product_title) > 15) { // Giới hạn độ dài của product_title
            $product_title = substr($product_title, 0, 15) . '...'; // Cắt chuỗi và thêm elipsis
        }
        $product_query = query("SELECT * FROM amount WHERE product_id = '{$product_id}' ");
        confirm($product_query);
        $products_row = fetch_array($product_query);
        if ($products_row['product_quantity'] <= 0) {
            $category_page = <<<DELIMETER
            
            <div class="col-sm-3 col-lg-3 col-md-3">
            <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
                    <div class="col pd-cart">
                        <div class="card h-100 shadow-sm" style="border-radius:25px;">
                            <div class="card-body">
                                    <a href="item_user.php?id={$row['product_id']}"><img src="../kresources/{$product_photo}" alt="" style="width: 282px; height: 182px;"></a>
                                        <h4 class="card-title text-center">
                                        <a href="item_user.php?id={$row['product_id']}">{$product_title}</a>
                                        </h4>
                                        <div class="d-grid gap-2 my-4 text-center">
                                            <a  href="item_user.php?id={$row['product_id']}"  class="btn btn-primary" style="border-radius:25px;">Đã hết hàng</a>  
                                            </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
                           
            DELIMETER;
        } else {
            $category_page = <<<DELIMETER
            <div class="col-sm-3 col-lg-3 col-md-3" style="border-radius:25px;">
            <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
                    <div class="col pd-cart">
                        <div class="card h-100 shadow-sm" style="border-radius:25px;">
                            <div class="card-body">
                                    <a href="item_user.php?id={$row['product_id']}"><img src="../kresources/{$product_photo}" alt="" style="width: 282px; height: 182px;">
                                <h4 class="card-title text-center">
                                    <a href="item_user.php?id={$row['product_id']}">{$product_title}</a>
                                </h4></a>
                                <div class="d-grid gap-2 my-4 text-center">  
                                    <a class="btn btn-primary"  href="item_user.php?id={$row['product_id']}" style="border-radius:25px;">Xem thêm</a> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            DELIMETER;
        }
        if ($count % 4 == 0) {
            echo '<div class="row">';
        }

        echo $category_page;

        $count++;
        if ($count % 4 == 0) {
            echo '</div>';
        }
    }
}
// hiện sp ở shop ad
function get_products_in_admin_shop_page()
{
    $query = query("SELECT * FROM products ");
    confirm($query);

    $count = 0; // Số sản phẩm hiện tại trong dòng
    while ($row = fetch_array($query)) {
        $short_desc = $row['short_desc'];
        if (strlen($short_desc) > 50) { // Giới hạn độ dài của short_desc
            $short_desc = substr($short_desc, 0, 50) . '...'; // Cắt chuỗi và thêm elipsis
        }
        $product_title = $row['product_title'];
        if (strlen($product_title) > 15) { // Giới hạn độ dài của product_title
            $product_title = substr($product_title, 0, 15) . '...'; // Cắt chuỗi và thêm elipsis
        }
        $product_photo = display_images($row['product_image']);
        $product_id = $row['product_id'];
        $product_photo = display_images($row['product_image']);
        $product_query = query("SELECT * FROM amount WHERE product_id = '{$product_id}' ");
        confirm($product_query);
        $products_row = fetch_array($product_query);
        $category_page = <<<DELIMETER
        <div class="col-sm-3 col-lg-3 col-md-3">
            <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
                    <div class="col pd-cart">
                        <div class="card h-100 shadow-sm" style="border-radius:25px;">
                            <div class="card-body">
                                    <a href="item.php?id={$row['product_id']}"><img src="../kresources/{$product_photo}" alt="" style="width: 282px; height: 182px;"></a>
                                        <h4 class="card-title text-center">
                                            <a href="item.php?id={$row['product_id']}">{$product_title}</a>
                                        </h4>
                                        <div class="d-grid gap-2 my-4 text-center">
                                            <a class="btn btn-primary"  href="item.php?id={$row['product_id']}" style="border-radius: 25px;">Xem thêm</a> 
                                        </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
DELIMETER;
        if ($count % 4 == 0) {
            echo '<div class="row">';
        }

        echo $category_page;

        $count++;
        if ($count % 4 == 0) {
            echo '</div>';
        }
    }
}

//*************************Adding Products in Admin*************************************************************************8
//theem sanr phaamr 
function add_product()
{
    if (isset($_POST['publish'])) {

        $product_title = escape_string($_POST['product_title']);
        $product_category_id = escape_string($_POST['product_category_id']);
        $product_price = escape_string($_POST['product_price']);
        $product_quantity = escape_string($_POST['product_quantity']);
        $product_description = escape_string($_POST['product_description']);
        $short_desc = escape_string($_POST['short_desc']);
        //********************************************************************************special zone the image uploading zone ******************


        $product_image = ($_FILES['file']['name']);
        $image_temp_location = ($_FILES['file']['tmp_name']);
        $final_destination = UPLOAD_DIRECTORY . DS . $product_image;
        move_uploaded_file($image_temp_location, $final_destination);

        //****************************************************************************************************************************************
        $query = query("SELECT * FROM products WHERE product_title = '{$product_title}'");
        confirm($query);
        if (mysqli_num_rows($query) > 0) {
            // Nếu dữ liệu đã tồn tại, hiển thị thông báo yêu cầu nhập lại
            $existing_info = [];
            while ($row = fetch_array($query)) {
                if ($row['product_title'] == $product_title) {
                    $existing_info[] = 'Tên sản phẩm';
                }
            }
            redirect("index.php?add_product");
            $error_message = implode(' và ', $existing_info) . " đã tồn tại, vui lòng nhập lại.";
            set_message($error_message);
        } else {
            // Kiểm tra các trường bắt buộc có giá trị hay không
            if (empty($product_title) || empty($product_category_id) || empty($short_desc) || empty($product_quantity) || empty($product_price)) {
                // Nếu có trường bắt buộc để trống, hiển thị thông báo lỗi
                echo "<script>alert('Vui lòng điền đầy đủ thông tin!');</script>";
            } else {
                $query = query("INSERT INTO products(product_title,product_category_id,product_description,short_desc,product_image)VALUES('{$product_title}','{$product_category_id}','{$product_description}','{$short_desc}','{$product_image}')");
                $last_id = last_id();
                confirm($query);
                $query_amount = query("INSERT INTO amount(product_id,product_price,product_quantity)VALUES('{$last_id}','{$product_price}','{$product_quantity}')");
                confirm($query_amount);
                set_message("đã thêm sản phẩm có id: {$last_id}");
                redirect("index.php?products");
            }
        }

    }

}
//hiện loại sản phẩm
function show_product_category_title($product_category_id)
{
    $category_query = query("SELECT * FROM categories WHERE cat_id = '{$product_category_id}' ");
    confirm($category_query);

    while ($categories_row = fetch_array($category_query)) {
        return $categories_row['cat_title'];
    }
}
function show_product_title($product_id)
{
    $product_query = query("SELECT * FROM products WHERE product_id = '{$product_id}' ");
    confirm($product_query);

    while ($products_row = fetch_array($product_query)) {
        return $products_row['product_title'];
    }
}
function show_product_photo($product_id)
{
    $product_query = query("SELECT * FROM products WHERE product_id = '{$product_id}' ");
    confirm($product_query);

    while ($products_row = fetch_array($product_query)) {
        return $products_row['product_image'];
    }
}
//hiển thị sản phẩm admin
function get_products_in_admin()
{

    $query = query("SELECT * FROM products");
    confirm($query);
    //$category = show_product_category_title['product_category_id'];
    echo "
    <thead>

    <tr>
           <th>Id</th>
           <th>Tên sản phẩm</th>
           <th>Phân loại</th>
           <th>Hình ảnh</th>
           <th>&ensp;</th>
      </tr>
    </thead>";
    while ($row = fetch_array($query)) {

        //***********************************************************
        $result_product = $row['product_category_id'];
        $category = show_product_category_title($result_product);
        $product_photo = display_images($row['product_image']);
        $products = <<<DELIMITER
            <tbody>
                <tr class="cell-1">
                    <td>{$row['product_id']}</td>
    
                    <td><a class='custom-link' href="index.php?edit_product&id={$row['product_id']}">
                        <h6>{$row['product_title']}</h6></a></td>
                    <td>{$category}</td>
                    <td><img width='100' src="../../kresources/{$product_photo}" alt=""></td>
                    <td>
                        <a class="btn btn-danger" href="../../kresources/ktemplates/backend/delete_product.php?id={$row['product_id']}"
                        onclick="return confirm('Bạn có chắc chắn muốn xóa không?')"><span class="glyphicon glyphicon-remove"></span></a>
                    </td>
                </tr>
            </tbody>
        DELIMITER;
        echo $products;
    }
    echo "";
}
function get_products_amount_in_admin()
{
    $count = 0;
    $query = query("SELECT * FROM amount");
    confirm($query);
    if (mysqli_num_rows($query) > 0) {
        while ($row = fetch_array($query)) {
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $current = time();
            $current_time = date('Y-m-d H:i:s', $current);
            $start_date = $row['start_date'];
            $end_date = $row['end_date'];
            if ($row['sale_quantity'] > 0 && ($current_time > $start_date && $current_time < $end_date)) {
                $count = 1;
            }
        }
    }
    if ($count == 1) {
        $query = query("SELECT * FROM amount");
        confirm($query);
        echo "
    <thead>

    <tr>
           <th>Id</th>
           <th>Tên sản phẩm</th>
           <th>Giá gốc</th>
           <th>Số lượng</th>
           <th>Giá sale</th>
           <th>Số lượng sale</th>
           <th>Ngày bắt đầu sale</th>
           <th>Ngày kết thúc sale</th>
           <th>&ensp;</th>
      </tr>
    </thead>";
        while ($row = fetch_array($query)) {
            $product_id = $row['product_id'];
            $product_title = show_product_title($product_id);
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $current = time();
            $current_time = date('Y-m-d H:i:s', $current);
            $sale_price = number_format($row['sale_price']);
            $sale_quantity = $row['sale_quantity'];
            $price = number_format($row['product_price']);
            $quantity = $row['product_quantity'];
            if ($row['sale_quantity'] > 0 && ($current_time > $row['start_date'] && $current_time < $row['end_date'])) {
                $start_date_timestamp = strtotime($row['start_date']);
                $end_date_timestamp = strtotime($row['end_date']);

                $start_date = date('d-m-Y', $start_date_timestamp);
                $end_date = date('d-m-Y', $end_date_timestamp);
                $sale = <<<DELIMITER
                        <td class="text-warning">{$sale_price} Đồng</td>
                        <td class="text-warning">{$sale_quantity}</td>
                        <td class="text-warning">{$start_date}</td>
                        <td class="text-warning">{$end_date}</td>
                DELIMITER;
            } else {
                $sale = <<<DELIMITER
                        <td>{$sale_price}</td>
                        <td>{$sale_quantity}</td>
                        <td>00-00-0000</td>
                        <td>00-00-0000</td>
                DELIMITER;
            }
            $products = <<<DELIMITER
            <tbody>
                <tr class="cell-1">
                    <td>{$product_id}</td>
                    <td><a class='custom-link' href="index.php?edit_amount&id={$product_id}">
                        <h6>{$product_title}</h6></a></td>
                    <td>{$price} Đồng</td>
                    <td>{$quantity}</td>
                    $sale
                    <td>
                        <a class="btn btn-success" href="index.php?flash_sale&id={$row['product_id']}" style="border-radius:15px;">tạo giảm giá </a>
                    </td>
                </tr>
            </tbody>
        DELIMITER;
            echo $products;
        }
        echo "";
    } elseif ($count == 0) {
        $query = query("SELECT * FROM amount");
        confirm($query);
        echo "
        <thead>
    
        <tr>
               <th>Id</th>
               <th>Tên sản phẩm</th>
               <th>Mức giá</th>
               <th>Số lượng</th>
               <th>&ensp;</th>
          </tr>
        </thead>";
        while ($row = fetch_array($query)) {
            $product_id = $row['product_id'];
            $product_title = show_product_title($product_id);
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $current = time();
            $current_time = date('Y-m-d H:i:s', $current);
            $start_date = $row['start_date'];
            $end_date = $row['end_date'];
            if ($row['sale_quantity'] > 0 && ($current_time > $start_date && $current_time < $end_date)) {
                $price = number_format($row['sale_price']);
                $quantity = $row['sale_quantity'];
            } else {
                $price = number_format($row['product_price']);
                $quantity = $row['product_quantity'];
            }

            $products = <<<DELIMITER
                <tbody>
                    <tr class="cell-1">
                    <td>{$product_id}</td>
                    <td><a class='custom-link' href="index.php?edit_amount&id={$product_id}">
                        <h6>{$product_title}</h6></a>
                    </td>
                    <td>{$price} Đồng</td>
                    <td>{$quantity}</td>
                    <td>
                        <a class="btn btn-success" href="index.php?flash_sale&id={$row['product_id']}">tạo giảm giá </a>
                    </td>
                    </tr>
                </tbody>
            DELIMITER;
            echo $products;
        }
        echo "";

    }
}

//hiển thị danh mục sp đã có
function show_categories_add_product()
{
    $query = query("SELECT * FROM categories");
    confirm($query);
    while ($row = fetch_array($query)) {
        $category_options = <<<DELIMETER
    <option value="{$row['cat_id']}">{$row['cat_title']}</option>
           
DELIMETER;
        echo $category_options;
    }
}
//***************************************************Updating Products Code In Admin Page  ***************************************
function update_product()
{
    if (isset($_POST['update'])) {
        $product_title = escape_string($_POST['product_title']);
        if (empty($product_category_id)) {
            $get_cat = query("SELECT product_category_id FROM products WHERE product_id =" . escape_string($_GET['id']) . "");
            confirm($get_cat);
            $row = fetch_array($get_cat);
            $product_category_id = $row['product_category_id'];
        } else {
            $product_category_id = escape_string($_POST['product_category_id']);
        }
        $product_description = escape_string($_POST['product_description']);
        $short_desc = escape_string($_POST['short_desc']);
        $product_image = $_FILES['file']['name'];
        $image_temp_location = $_FILES['file']['tmp_name'];
        $final_destination = UPLOAD_DIRECTORY . DS . $product_image;
        move_uploaded_file($image_temp_location, $final_destination);

        if (empty($product_image)) {
            $get_pic = query("SELECT product_image FROM products WHERE product_id =" . escape_string($_GET['id']) . "");
            confirm($get_pic);
            $row = fetch_array($get_pic);
            $product_image = $row['product_image'];
        }
        $query = "UPDATE products SET ";
        $query .= "product_title          = '{$product_title}'            , ";
        $query .= "product_category_id    = '{$product_category_id}'      , ";
        $query .= "product_description    = '{$product_description}'      , ";
        $query .= "short_desc             = '{$short_desc}'               , ";
        $query .= "product_image          = '{$product_image}'              ";
        $query .= "WHERE product_id= " . escape_string($_GET['id']);
        $send_update_query = query($query);
        confirm($send_update_query);
        set_message("Products has been updated !");
        redirect("index.php?products");

    }

}

function update_amount()
{
    if (isset($_POST['amount'])) {
        $product_price = escape_string($_POST['product_price']);
        $product_quantity = escape_string($_POST['product_quantity']);
        $query = "UPDATE amount SET ";
        $query .= "product_price          = '{$product_price}'            , ";
        $query .= "product_quantity       = '{$product_quantity}'         ";
        $query .= "WHERE product_id= " . escape_string($_GET['id']);
        $send_update_query = query($query);
        confirm($send_update_query);
        set_message("Đã sửa danh sách thành công!");
        redirect("index.php?amount");

    }

}
function update_sale()
{
    if (isset($_POST['sale'])) {
        $query = query("SELECT * FROM amount WHERE product_id = " . escape_string($_GET['id']) . "");
        confirm($query);
        $row = fetch_array($query);
        $product_quantity = escape_string($row['product_quantity']);
        $sale_price = escape_string($_POST['sale_price']);
        $sale_quantity = escape_string($_POST['sale_quantity']);
        $start_date = date('Y-m-d 00:00:00', strtotime($_POST['start_date']));
        $end_date = date('Y-m-d 00:00:00', strtotime($_POST['end_date']));
        if ($sale_price < $row['product_price'] && $sale_quantity <= $product_quantity) {
            $query = "UPDATE amount SET ";
            $query .= "sale_price          = '{$sale_price}'            , ";
            $query .= "sale_quantity       = '{$sale_quantity}'         , ";
            $query .= "end_date             = '{$end_date}'               , ";
            $query .= "start_date           = '{$start_date}'              ";
            $query .= "WHERE product_id= " . escape_string($_GET['id']);
            $send_update_query = query($query);
            confirm($send_update_query);
            set_message("Đã thêm vào danh sách khuyến mãi!");
            redirect("index.php?amount");
        } else {
            echo "<script>alert('Vui lòng nhập giá và số lượng sale ít hơn hoặc bằng giá trị có sẵn!');</script>";
        }

    }

}
//*************************************************Category Zone Under The Admin Page ********************************************************//
//hiển thị danh mục sp
function show_categories_in_admin()
{



    $query = "SELECT * FROM categories";
    $category_query = query($query);
    confirm($query);
    while ($row = fetch_array($category_query)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        $category_admin = <<<DELIMETER
<tr>
    <td>{$cat_id}</td>
    <td>{$cat_title}</td>
    <td><a class="btn btn-danger" href = "..\..\kresources\ktemplates\backend\delete_category.php?id={$row['cat_id']}"
    onclick="return confirm('Bạn có chắc chắn muốn xóa không?')"><span class = " glyphicon glyphicon-remove"></span></a></td>
</tr>
DELIMETER;

        echo $category_admin;
    }
}
// thêm danh mục
function add_category()
{
    if (isset($_POST['add_category'])) {
        $cat_title = escape_string($_POST['cat_title']);
        if (empty($cat_title) || $cat_title == "") {
            echo "<p class= 'bg-danger' >kHÔNG THỂ ĐỂ TRỐNG, THỬ LẠI! </p> ";
        } else {
            $query = query("INSERT INTO categories(cat_title) VALUES('{$cat_title}')");
            confirm($query);
            set_message("Category Created !");
        }
    }
}


//tim kiem sản phẩm ở admin
function search_product()
{
    $connection = mysqli_connect('localhost', 'root', '', 'toy');
    if ($connection === false) {
        die("Lỗi kết nối database: " . mysqli_connect_error());
    }

    if (isset($_POST['submit'])) {
        $keyword = $_POST['search'];
        $query = $connection->prepare("SELECT * FROM products WHERE  product_title LIKE ?");
        confirm($query);
        $keyword = '%' . $keyword . '%';
        $query->bind_param("s", $keyword);
        $query->execute();
        $result = $query->get_result();
        echo "
    <thead>

    <tr>
           <th>Id</th>
           <th>Tên sản phẩm</th>
           <th>Phân loại</th>
           <th></th>
      </tr>
    </thead>";
        echo "<tbody ";
        if ($result->num_rows > 0) {
            echo "<ul>";
            while ($row = $result->fetch_assoc()) {
                $result_product = $row['product_category_id'];
                $category = show_product_category_title($result_product);
                $product_photo = display_images($row['product_image']);

                $products = <<<DELIMETER
                <tr class="cell-1">
                    <td> {$row['product_id']}</td>
                    <td><a href="index.php?edit_product&id={$row['product_id']}&cat_id={$row['product_category_id']}"><p>{$row['product_title']}</p>
                    </a><div><img src="../../kresources/{$product_photo}" alt="" style="width: 282px; height: 182px;"></div></td>
                    <td>{$category}</td>
                    <td>
                    <a class="btn btn-danger" href = "..\..\kresources\ktemplates\backend\delete_product.php?id={$row['product_id']}">
                    <span class = " glyphicon glyphicon-remove"></span></a>
                    </td>
               </tr>
            DELIMETER;
                echo $products;
            }
            echo "</tbody> ";

        } else {
            echo "<h2>Không tìm thấy sản phẩm nào.</h2>";
        }
    }

}


//tìm kiếm sp

function search($keyword)
{
    $connection = mysqli_connect('localhost', 'root', '', 'toy');
    if ($connection === false) {
        die("Lỗi kết nối database: " . mysqli_connect_error());
    }

    if (isset($_POST['submit'])) {
        $keyword = $_POST['search'];
        $query = $connection->prepare("SELECT * FROM products WHERE product_title LIKE ?");
        confirm($query);
        $keyword = '%' . $keyword . '%';
        $query->bind_param("s", $keyword);
        $query->execute();
        $result = $query->get_result();
        if ($result->num_rows > 0) {
            echo "<ul>";
            while ($row = $result->fetch_assoc()) {
                $short_desc = $row['short_desc'];
                if (strlen($short_desc) > 50) {
                    $short_desc = substr($short_desc, 0, 50) . '...';
                }
                $product_photo = display_images($row['product_image']);
                $link = isset($_SESSION['username']) && !empty($_SESSION['username'])
                    ? "..\kresources\cart.php?add={$row['product_id']}"
                    : "javascript:alert('Cần đăng nhập để đặt hàng!');window.location.href='login.php';";

                $product_id = $row['product_id'];
                $product_photo = display_images($row['product_image']);
                $product_title = $row['product_title'];
                if (strlen($product_title) > 15) { // Giới hạn độ dài của product_title
                    $product_title = substr($product_title, 0, 15) . '...'; // Cắt chuỗi và thêm elipsis
                }
                $product_query = query("SELECT * FROM amount WHERE product_id = '{$product_id}' ");
                confirm($product_query);
                $products_row = fetch_array($product_query);

                if (!empty($products_row) && $products_row['product_quantity'] <= 0) {
                    $category_page = <<<DELIMETER
                        
                        <div class="col-sm-3 col-lg-3 col-md-3">
                        <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
                                <div class="col pd-cart">
                                    <div class="card h-100 shadow-sm" style="border-radius: 25px;">
                                        <div class="card-body">
                                                <a href="item_user.php?id={$row['product_id']}"><img src="../kresources/{$product_photo}" alt="" style="width: 282px; height: 182px;"></a>
                                                    <h4 class="card-title text-center">
                                                    <a href="item_user.php?id={$row['product_id']}">{$row['product_title']}</a>
                                                    </h4>
                                                <br>
                                                <p>{$row['short_desc']}.</p>
                                                    <div class="d-grid gap-2 my-4 text-center">
                                                        <a  class="btn btn-primary">Đã hết hàng</a> 
                                                        <a class="btn btn-primary"  href="item_user.php?id={$row['product_id']}" >Xem thêm</a> 
                                                        </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                                       
                        DELIMETER;
                } else {
                    $category_page = <<<DELIMETER
                        <div class="col-sm-3 col-lg-3 col-md-3">
                        <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
                                <div class="col pd-cart">
                                    <div class="card h-100 shadow-sm" style="border-radius:25px;">
                                        <div class="card-body">
                                                <a href="item_user.php?id={$row['product_id']}"><img src="../kresources/{$product_photo}" alt="" style="width: 282px; height: 182px;"></a>
                                                    <h4 class="card-title text-center">
                                                    <a href="item_user.php?id={$row['product_id']}">{$row['product_title']}</a>
                                                    </h4>
                                                <br>
                                                <p>{$row['short_desc']}.</p>
                                                    <div class="d-grid gap-2 my-4 text-center">
                                                        <a class="btn btn-primary"  href="item_user.php?id={$row['product_id']}" >Xem thêm</a> 
                                                    </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                        DELIMETER;
                }
                echo $category_page;
            }

        } else {
            echo "<h2>Không tìm thấy sản phẩm nào.</h2>";
        }
    }

}
// tìm sp ad
function search_ad($keyword)
{
    $connection = mysqli_connect('localhost', 'root', '', 'toy');
    if ($connection === false) {
        die("Lỗi kết nối database: " . mysqli_connect_error());
    }

    if (isset($_POST['submit'])) {
        $keyword = $_POST['search'];
        $query = $connection->prepare("SELECT * FROM products WHERE product_title LIKE ?");
        confirm($query);
        $keyword = '%' . $keyword . '%';
        $query->bind_param("s", $keyword);
        $query->execute();
        $result = $query->get_result();
        if ($result->num_rows > 0) {
            echo "<ul>";
            while ($row = $result->fetch_assoc()) {
                $short_desc = $row['short_desc'];
                if (strlen($short_desc) > 50) {
                    $short_desc = substr($short_desc, 0, 50) . '...';
                }
                $product_id = $row['product_id'];
                $product_photo = display_images($row['product_image']);
                $product_title = $row['product_title'];
                if (strlen($product_title) > 15) { // Giới hạn độ dài của product_title
                    $product_title = substr($product_title, 0, 15) . '...'; // Cắt chuỗi
                }
                $product_query = query("SELECT * FROM amount WHERE product_id = '{$product_id}' ");
                confirm($product_query);
                $products_row = fetch_array($product_query);

                if (!empty($products_row) && $products_row['product_quantity'] <= 0) {
                    $category_page = <<<DELIMETER
                        
                        <div class="col-sm-3 col-lg-3 col-md-3" >
                        <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
                                <div class="col pd-cart">
                                    <div class="card h-100 shadow-sm" style="border-radius:35px;">
                                        <div class="card-body">
                                                <a href="item.php?id={$row['product_id']}"><img src="../kresources/{$product_photo}" alt="" style="width: 282px; height: 182px;"></a>
                                                    <h4 class="card-title text-center">
                                                    <a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
                                                    </h4>
                                                <br>
                                                <p>{$row['short_desc']}.</p>
                                                    <div class="d-grid gap-2 my-4 text-center"> 
                                                        <a class="btn btn-primary"  href="item.php?id={$row['product_id']}" >Đã hết hàng</a> 
                                                        </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                                       
                        DELIMETER;
                } else {
                    $category_page = <<<DELIMETER
                        <div class="col-sm-3 col-lg-3 col-md-3">
                        <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
                                <div class="col pd-cart">
                                    <div class="card h-100 shadow-sm" style="border-radius:25px;">
                                        <div class="card-body">
                                                <a href="item.php?id={$row['product_id']}"><img src="../kresources/{$product_photo}" alt="" style="width: 282px; height: 182px;"></a>
                                                    <h4 class="card-title text-center">
                                                    <a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
                                                    </h4>
                                                <br>
                                                <p>{$row['short_desc']}.</p>
                                                    <div class="d-grid gap-2 my-4 text-center">
                                                        <a class="btn btn-primary"  href="item.php?id={$row['product_id']}" >Xem thêm</a> 
                                                    </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                        DELIMETER;
                }
                echo $category_page;
            }

        } else {
            echo "<h2>Không tìm thấy sản phẩm nào.</h2>";
        }
    }

}


//**********************************************************************ORDER FUNCTIONS************************************
//thêm dữ liệu đơn hàng và doanh thu
function add_order()
{
    global $connection;
    if (isset($_POST['add_order']) && isset($_POST['payment'])) {
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
            $buy_code = rand(100000000, 987654567);
            $_SESSION['buy_code'] = $buy_code;
            $buy_codes[] = $buy_code;
            $query = query("SELECT * FROM amount WHERE product_id = " . escape_string($selected_product));
            confirm($query);
            while ($row = fetch_array($query)) {
                $product_id = $row['product_id'];
                $product_photo = show_product_photo($product_id);
                $product_title = show_product_title($product_id);
                $item_quantity += $_SESSION["product_" . $selected_product];
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
               '{$sub}', 'Đang xử lý', 'Thanh toán trực tiếp', '{$product_photo}', '{$_SESSION['fulladdress']}')";

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
    } elseif (isset($_POST['add_order']) && isset($_POST['redirect'])) {
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $vnp_TmnCode = "N7VY01PV"; //Mã định danh merchant kết nối (Terminal Id)
        $vnp_HashSecret = "AAGIGCPBFGUVLTRZBYUSGNVHDHLEGINL"; //Secret key
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost/Shopping_Web_CNPM/public_user/sucess_pay.php";
        $vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
        $apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";
        $startTime = date("YmdHis");
        $expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));
        $total = 0;
        $item_quantity = 0;
        foreach ($_SESSION['selected_products'] as $selected_product) {
            $code = rand(100000000, 987654567);
            $_SESSION['code'] = $code;
            $query = query("SELECT * FROM amount WHERE product_id = " . escape_string($selected_product));
            confirm($query);
            while ($row = fetch_array($query)) {
                $item_quantity += $_SESSION["product_" . $selected_product];
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $current = time();
                $current_time = date('Y-m-d H:i:s', $current);
                $start_date = $row['start_date'];
                $end_date = $row['end_date'];
                $sale_price = number_format($row['sale_price']);
                if ($current_time >= $start_date && $current_time < $end_date && $row['sale_quantity'] > 0) {
                    $price = $sale_price;
                    $sub = $row['sale_price'] * $_SESSION["product_" . $selected_product];
                } else {
                    $price = number_format($row['product_price']);
                    $sub = $row['product_price'] * $_SESSION["product_" . $selected_product];
                }
                $total += $sub;
            }
        }
        $vnp_TxnRef = $code;
        $vnp_OrderInfo = "Thanh toan don hang";
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $total * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = '';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $vnp_ExpireDate = $expire;
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate" => $vnp_ExpireDate
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00'
            ,
            'message' => 'success'
            ,
            'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);

        }
    }
}
//hiển thị đơn hàng

function display_order()
{
    global $connection;
    $user_name = "";
    $user_id = $_SESSION['user_id'];
    $query_user = query("SELECT username FROM users WHERE user_id = " . escape_string($user_id));
    confirm($query_user);
    while ($row_user = fetch_array($query_user)) {
        $user_name = $row_user['username'];
    }

    $query = query("SELECT * FROM buy WHERE user_name = '{$user_name}' ORDER BY 
        CASE
            WHEN status = 'Đang xử lý' THEN 1
            WHEN status = 'Đã xác nhận' THEN 2
            WHEN status = 'Đang giao hàng' THEN 3
            ELSE 4
        END, id DESC");

    if (mysqli_num_rows($query) > 0) {
        while ($row = fetch_array($query)) {
            $count2 = 0;
            $price = number_format($row['price']);
            $amount = number_format($row['amount']);
            $status = $row['status'];
            $photo = display_images($row['photo']);
            if ($status == 'Đang xử lý') {
                $dis_status = <<<DELIMETER
                
                <li class="step0 text-muted " id="step1">ĐANG XỬ LÝ<i class='fa fa-redo'></i> </li>
                <li class="step0 text-muted  text-center" id="step2">ĐÃ XÁC NHẬN<br><i class='far fa-check-circle'></i></li>
                <li class="step0 text-muted text-center" id="step3">ĐANG GIAO HÀNG<br><i class='fa fa-truck-moving'></i></li>
                <li class="step0  text-muted text-right" id="step4">ĐÃ HOÀN THÀNH<br><i class='fa fa-clipboard-check'></i></li>
                DELIMETER;

                $comment = <<<DELIMETER
                &ensp;
                DELIMETER;
                $remove = <<<DELIMETER
                    <a class='text-right btn btn-danger' href='..\..\kresources\ktemplates\backend_user\delete_order.php?id={$row['id']}'
                    onclick="return confirm('Bạn có chắc chắn muốn hủy đơn không?')"><span class ='glyphicon glyphicon-remove'></span></a>
                    DELIMETER;
            } elseif ($status == 'Đã xác nhận') {
                $dis_status = <<<DELIMETER
                
                <li class="step0 active " id="step1">ĐANG XỬ LÝ<i class='fa fa-redo'></i> </li>
                <li class="step0 text-muted  text-center" id="step2">ĐÃ XÁC NHẬN<br><i class='far fa-check-circle'></i></li>
                <li class="step0 text-muted text-center" id="step3">ĐANG GIAO HÀNG<br><i class='fa fa-truck-moving'></i></li>
                <li class="step0  text-muted text-right" id="step4">ĐÃ HOÀN THÀNH<br><i class='fa fa-clipboard-check'></i></li>
                DELIMETER;

                $comment = <<<DELIMETER
                &ensp;
                DELIMETER;
                $remove = <<<DELIMETER
                  &ensp;
                DELIMETER;
            } elseif ($status == 'Đang giao hàng') {
                $dis_status = <<<DELIMETER
                
                <li class="step0 active " id="step1">ĐANG XỬ LÝ<i class='fa fa-redo'></i> </li>
                <li class="step0 active  text-center" id="step2">ĐÃ XÁC NHẬN<br><i class='far fa-check-circle'></i></li>
                <li class="step0 active text-center" id="step3">ĐANG GIAO HÀNG<br><i class='fa fa-truck-moving'></i></li>
                <li class="step0  text-muted text-right" id="step4">ĐÃ HOÀN THÀNH<br><i class='fa fa-clipboard-check'></i></li>
                DELIMETER;
                $comment = <<<DELIMETER
                &ensp;
                DELIMETER;
                $remove = <<<DELIMETER
                  &ensp;
                DELIMETER;
            } else {
                $query2 = query("SELECT report_code FROM reports WHERE product_name='{$row['product_name']}'");
                confirm($query2);
                $query2 = query("SELECT product_name FROM reports WHERE report_code='{$row['buy_code']}'");
                confirm($query2);
                while ($row_report = fetch_array($query2)) {
                    if (empty($row_report["product_name"])) {
                        $count2 = 0;
                    } else {
                        $count2 = 1;
                    }
                }
                $dis_status = <<<DELIMETER
                
                <li class="step0 active " id="step1">ĐANG XỬ LÝ<i class='fa fa-redo'></i> </li>
                <li class="step0 active  text-center" id="step2">ĐÃ XÁC NHẬN<br><i class='far fa-check-circle'></i></li>
                <li class="step0 active text-center" id="step3">ĐANG GIAO HÀNG<br><i class='fa fa-truck-moving'></i></li>
                <li class="step0  active text-right" id="step4">ĐÃ HOÀN THÀNH<br><i class='fa fa-clipboard-check'></i></li>
                DELIMETER;
                $remove = <<<DELIMETER
                  &ensp;
                DELIMETER;

                if ($count2 == 0) {
                    $comment = <<<DELIMETER
                    <a class='text-right btn btn-danger' href='index_user.php?report&product_name={$row['product_name']}&buy_code={$row['buy_code']}'>Đánh giá</a>
                    DELIMETER;
                } else {

                    $comment = <<<DELIMETER
                &ensp;
                DELIMETER;
                }
            }
            $order = <<<DELIMETER
            <div class="col-md-12 d-sm-flex justify-content-center" style="border-radius:25px;">
            <div class="card px-2" style="border-radius:25px;">
               <div class="card-header bg-white" style="border-radius:25px;">
                  <div class="row justify-content-between">
                     <div class="col">
                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0"style="margin-left:10px;">
                           <strong> Mã đơn hàng :</strong>
                           <h4 class="font-weight-bold text-primary">
                           <a class='custom-link' href='index_user.php?detail_order&buy_code={$row['buy_code']}'>#{$row['buy_code']}</a></h4>
                        </li>
                     </div>
                  </div>
               </div>
               <div class="card-body">
                  <div class="media flex-column flex-sm-row">
                     <div class="col-md-6 navbar-left">
                        <img class="align-self-center img-fluid" src="../../kresources/$photo" width="180 " height="180">
                     </div>
                     <div class="media-body text-right">
                        <h5 class="bold">{$row['product_name']}</h5>
                        <p class="mt-3 mb-4 bold">Đơn giá: <span class="mt-5 text-warning">{$price} VND </p>
                        <p class="text-muted"> Số lượng : {$row['quantity']}</p>
                        <h5 class="mt-3 mb-4 bold">Thành tiền: <span class="mt-5 text-warning">{$amount} VND </h5>
                        $remove
                        $comment
                     </div>
                  </div>
               </div>
               <div class="row px-3">
                  <div class="col">
                     <ul id="progressbar">
                        $dis_status
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         DELIMETER;
            echo $order;
            $page = 1;
            $_SESSION["page"] = $page;
        }
    } else {
        echo "<tr><td colspan='3'>Không có đơn hàng</td></tr>";
    }
}
//hiển thị chi tiết đơn hàng
function detail_order()
{
    if (isset($_GET['buy_code'])) {
        $page = $_SESSION["page"];
        $id = $_GET['buy_code'];
        $query = query("SELECT  buy_code,vnpay_code, user_name, product_name, price, quantity, amount, status,payment, photo, buyad,add_date,receive_date FROM buy WHERE buy_code = '{$id}'");
        confirm($query);
        $row = fetch_array($query);
        $amount = number_format($row['amount']);
        $price = number_format($row['price']);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $addDate = $row['add_date'];
        $date = date('H:i:s d/m/Y', strtotime($row['add_date']));
        $new_date = date('H:i:s d/m/Y', strtotime("$addDate +3 days"));
        $get_date = date('H:i:s d/m/Y', strtotime($row['receive_date']));
        $status = $row['status'];
        $payment = $row['payment'];
        $photo = display_images($row['photo']);
        $count2 = 0;
        if ($page == 1) {
            $link = 'index_user.php?order';
        } elseif ($page == 2) {
            $link = 'index_user.php?process';
        } elseif ($page == 3) {
            $link = 'index_user.php?confirm';
        } elseif ($page == 4) {
            $link = 'index_user.php?ship';
        } elseif ($page == 5) {
            $link = 'index_user.php?delive';
        }
        if ($status == 'Đã hoàn thành') {
            $dt = <<<DELIMETER
            <tr>
                <td><strong> Thời gian đặt hàng : </strong></td>
                
                <td>$date </td>
            </tr>
            <br />
            <tr>
                <td><strong>Thời gian nhận hàng : </strong></td>
                
                <td>$get_date </td>
            </tr>
            DELIMETER;
            $dt1 = <<<DELIMETER
            
            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                <strong> Thời gian đặt hàng :</strong>
                <span class="font-weight-bold text-success">$date</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                <strong>Thời gian nhận hàng : </strong>
                <span class="font-weight-bold" style="color:#ff8206;">$get_date</span>
            </li>
            DELIMETER;
        } else {
            $dt = <<<DELIMETER
            <tr>
                <td><strong>Thời gian đặt hàng :</strong></td>
                
                <td>$date</td>
            </tr>
            <br />
            <tr>
                <td><strong>Giao hàng dự kiến: </strong></td>
                
                <td>$new_date </td>
            </tr>
          DELIMETER;
            $dt1 = <<<DELIMETER
          <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
            <strong> Thời gian đặt hàng:</strong>
            <span class="font-weight-bold text-success">$date</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
            <strong> Giao hàng dự kiến: </strong>
            <span class="font-weight-bold text-danger">$new_date </span>
          </li>
          DELIMETER;
        }
        if ($payment != "vnpay") {
            if ($status == "Đã hoàn thành" && $payment != "vnpay") {
                $dis_pay = <<<DELIMETER
                 <label style="color:black;"> Cảm ơn bạn đã mua hàng</label>
                 <img class="me-2" width="45px" src="https://cdn-icons-png.flaticon.com/512/3796/3796142.png"/>
                DELIMETER;
            } else {
                $dis_pay = <<<DELIMETER
             <label style="color:black;"> Vui lòng thanh toán $amount VND khi nhận hàng</label>
             <img class="me-2" width="45px" src="https://cdn-icons-png.flaticon.com/512/3796/3796142.png" />
            DELIMETER;
            }
        } else {
            $dis_pay = <<<DELIMETER
            <label style="color:black;">Đã thanh toán $amount VND qua VNPAY</label>
            <img class="me-2" width="45px"
               src="https://cdn.haitrieu.com/wp-content/uploads/2022/10/Logo-VNPAY-QR-1.png"/>
            DELIMETER;
        }
        if ($status == 'Đang xử lý') {
            $dis_status = <<<DELIMETER
            
            <ul id="progressbar" class="text-center">
            <li class="step0 text-muted " id="step1"> </li>
            <li class="step0 text-muted  text-center" id="step2"></li>
            <li class="step0 text-muted text-center" id="step3"></li>
            <li class="step0  text-muted text-right" id="step4"></li>
            </ul>
            DELIMETER;
            $comment = <<<DELIMETER
            &ensp;
            DELIMETER;
        } elseif ($status == 'Đã xác nhận') {
            $dis_status = <<<DELIMETER
            
            <ul id="progressbar" class="text-center">
            <li class="step0 active " id="step1"> </li>
            <li class="step0 text-muted  text-center" id="step2"></li>
            <li class="step0 text-muted text-center" id="step3"></li>
            <li class="step0  text-muted text-right" id="step4"></li>
            </ul>
            DELIMETER;
            $comment = <<<DELIMETER
            &ensp;
            DELIMETER;
        } elseif ($status == 'Đang giao hàng') {
            $dis_status = <<<DELIMETER
            <ul id="progressbar" class="text-center">
            <li class="step0 active " id="step1"></li>
            <li class="step0 active  text-center" id="step2"></li>
            <li class="step0 active text-center" id="step3"></li>
            <li class="step0  text-muted text-right" id="step4"></li>
            </ul>
            DELIMETER;
            $comment = <<<DELIMETER
            &ensp;
            DELIMETER;
        } else {
            $dis_status = <<<DELIMETER
            
            <ul id="progressbar" class="text-center">
            <li class="step0 active " id="step1"> </li>
            <li class="step0 active  text-center" id="step2"></li>
            <li class="step0 active text-center" id="step3"></li>
            <li class="step0  active text-right" id="step4"></li>
            </ul>
            DELIMETER;
            $query2 = query("SELECT product_name FROM reports WHERE report_code='{$row['buy_code']}'");
            confirm($query2);
            while ($row_report = fetch_array($query2)) {
                if (empty($row_report["product_name"])) {
                    $count2 = 0;
                } else {
                    $count2 = 1;
                }
            }
            if ($count2 == 0) {
                $comment = <<<DELIMETER
            <a class='text-right btn btn-danger' href='index_user.php?report&product_name={$row['product_name']}&buy_code={$row['buy_code']}'>Đánh giá</a>
            DELIMETER;
            } else {
                $comment = <<<DELIMETER
            &ensp;
            DELIMETER;
            }
        }
        $order = <<<DELIMETER
        <div class="container px-1 px-md-12 py-5 mx-auto">
        <div class="card">
           <!-- Add class 'active' to progress -->
           <div class="row d-flex justify-content-center">
              <div class="col-12">
                $dis_status
              </div>
           </div>
           <div class="row justify-content-between top">
              <div class="row d-flex icon-content">
                 <img class="icon" src="../../kresources/uploads/process.png">
                 <div class="d-flex flex-column">
                    <p class="font-weight-bold">Đang<br> xử lý</p>
                 </div>
              </div>
              <div class="row d-flex icon-content">
                 <img class="icon" src="../../kresources/uploads/confirm.png">
                 <div class="d-flex flex-column">
                    <p class="font-weight-bold">Đã<br> xác nhận</p>
                 </div>
              </div>
              <div class="row d-flex icon-content">
                 <img class="icon" src="../../kresources/uploads/ship.png">
                 <div class="d-flex flex-column">
                    <p class="font-weight-bold">Đang<br> giao hàng</p>
                 </div>
              </div>
              <div class="row d-flex icon-content">
                 <img class="icon" src="../../kresources/uploads/completed.png">
                 <div class="d-flex flex-column">
                    <p class="font-weight-bold">Đã<br> hoàn thành</p>
                 </div>
              </div>
           </div>
        </div>
     </div>
        <div class="col-md-6 d-sm-flex justify-content-center">
        <div class="card px-2">
           <div class="card-header bg-white">
              <div class="row justify-content-between">
                 <div class="col">
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                       <strong> Mã đơn hàng :</strong>
                       <span class="font-weight-bold text-primary">#{$row['buy_code']}</span>
                    </li>
                    $dt1
                 </div>
              </div>
           </div>
           <div class="card-body">
              <div class="media flex-column flex-sm-row">
                 <div class="media-body ">
                    <h5 class="bold">{$row['product_name']}</h5>
                    <p class="text-muted"> Số lượng: {$row['quantity']}</p>
                    <h4 class="mt-3 mb-4 bold"> <span class="mt-5 text-warning">{$price} VND </h4>
                    <p class="text-muted">Địa chỉ nhận hàng:</span></p>
                    <div class="col-md-11">{$row['buyad']}</div>
                 </div>
                 <div class="col-md-6">
                    <img class="align-self-center img-fluid" src="../../kresources/$photo" width="180 " height="180">
                 </div>
              </div>
           </div>
           <div class="row px-3">
              <div class="col">
              <button type="button" class="btn  btn-outline-primary d-flex" style="margin-left:125px; padding-top:25px;"><h5>Trạng thái: $status</h5></button>
              $comment    
              </div>
           </div>
        </div>
     </div>
     <div class="col-md-6 d-sm-flex justify-content-center">
        <div class="card">
           <div class="card-body" style="padding-left:25px; position:center;">
              <b>HÓA ĐƠN</b>
           </div>
        </div>
     </div>
     <div class="col-md-6 d-sm-flex" id="orderData">
        <div class="card mb-4">
           <div class="card-body">
              <table class='table table-hover'>
                 <tr>
                    <th class="text-left"> Tên sản phẩm: </th>
                    <td>{$row['product_name']}</td>
                 </tr>
                 <tr>
                    <th class="text-left"> Mã đơn hàng: </th>
                    <td>#{$row['buy_code']}</td>
                </tr>
                 $dt
                 <tr>
                    <th class="text-left"> Đơn giá : </th>
                    
                    <td class="amount text-success">$price VND</td>
                 </tr>
                 <tr>
                    <th class="text-left"> Số lượng : </th>
                    
                    <td class="amount">
                       {$row['quantity']}
                    </td>
                 </tr>
                 <tr>
                    <th class="text-left">Phí vận chuyển :</th>
                    
                    <td>Miễn phí</td>
                 </tr>
                 <tr>
                    <div>
                       <th class="text-left">Tổng thanh toán :</th>
                       
                          <td class="text-warning">
                             $amount VND
                          </td>
                    </div>
                 </tr>
                 <tr>
                    (Mức giá Đã bao gồm thuế giá trị gia tăng VAT)
                 </tr>
                 <br>
              </table>
  
              <div class="form-group">
                 $dis_pay
              </div>
           </div>
        </div>
    </div>
    DELIMETER;
        echo $order;
        if ($status == 'Đã hoàn thành') {
            echo '
            <div class="col-md-6 d-sm-flex justify-content-center">
               <div class="card">
                   <div class="form-group" style="width: 100%;">
                     <a href="' . $link . '" class="btn btn-warning navbar-left text-white">QUAY LẠI</a>
                     <button class="btn btn-primary navbar-right text-white" onclick="printOrder()">In hóa đơn</button>
                  </div>
               </div>
            </div>';
        } else {
            echo '
            <div class="col-md-6 d-sm-flex justify-content-center">
               <div class="card">
                   <div class="form-group" style="width: 100%;">
                     <a href="' . $link . '" class="btn btn-warning text-white col-md-12" style="border-radius:15px;">QUAY LẠI</a>
                  </div>
               </div>
            </div>';
        }

    }
}
//hiển thị đơn hàng chờ hoặc đã xác nhận 
function display_process()
{
    global $connection;
    $user_name = "";

    // Lấy username từ bảng users
    $user_id = $_SESSION['user_id']; // Giả sử user_id đã được lưu trữ trong session
    $query_user = query("SELECT username FROM users WHERE user_id = " . escape_string($user_id));
    confirm($query_user);
    while ($row_user = fetch_array($query_user)) {
        $user_name = $row_user['username'];
    }

    $query = query("SELECT * FROM buy WHERE user_name = '{$user_name}' ORDER BY add_date DESC");
    // Kiểm tra xem có dữ liệu hay không
    if (mysqli_num_rows($query) > 0) {

        while ($row = fetch_array($query)) {
            $amount = number_format($row['amount']);
            $price = number_format($row['price']);
            $status = $row['status'];
            $photo = display_images($row['photo']);
            if ($status == 'Đang xử lý') {
                $order = <<<DELIMETER
                <div class="col-md-12 d-sm-flex justify-content-center">
                <div class="card px-2">
                   <div class="card-header bg-white">
                      <div class="row justify-content-between">
                         <div class="col">
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                               <strong> Mã đơn hàng :</strong>
                               <h4 class="font-weight-bold text-primary">
                               <a class='custom-link' href='index_user.php?detail_order&buy_code={$row['buy_code']}'>{$row['buy_code']}</a></h4>
                            </li>
                         </div>
                      </div>
                   </div>
                   <div class="card-body">
                      <div class="media flex-column flex-sm-row">
                         <div class="col-md-6 navbar-left">
                            <img class="align-self-center img-fluid" src="../../kresources/$photo" width="180 " height="180">
                         </div>
                         <div class="media-body text-right">
                            <h5 class="bold">{$row['product_name']}</h5>
                            <p class="mt-3 mb-4 bold">Đơn giá: <span class="mt-5 text-warning">{$price} VND </p>
                            <p class="text-muted"> Số lượng: {$row['quantity']} sản phẩm</p>
                            <h5>Thành tiền: <span class="mt-5 text-warning">{$amount} VND </h5>
                            <a class='text-right btn btn-danger' href='..\..\kresources\ktemplates\backend_user\delete_order.php?id={$row['id']}'
                            onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng không?')"><span class ='glyphicon glyphicon-remove'></span></a>
                         </div>
                      </div>
                   </div>
                   <div class="row px-3">
                      <div class="col">
                         <ul id="progressbar">
                         <li class="step0 text-muted " id="step1">ĐANG XỬ LÝ<i class='fa fa-redo'></i> </li>
                         <li class="step0 text-muted  text-center" id="step2">ĐÃ XÁC NHẬN<br><i class='far fa-check-circle'></i></li>
                         <li class="step0 text-muted text-center" id="step3">ĐANG GIAO HÀNG<br><i class='fa fa-truck-moving'></i></li>
                         <li class="step0  text-muted text-right" id="step4">ĐÃ HOÀN THÀNH<br><i class='fa fa-clipboard-check'></i></li>
                         </ul>
                      </div>
                   </div>
                </div>
             </div>
             DELIMETER;
                echo $order;
                $page = 2;
                $_SESSION["page"] = $page;
            }
        }
    } else {
        echo "<tr><td colspan='3'>Không có đơn hàng</td></tr>";
    }
}
//hiển thị đơn hàng đã được xác nhận
function display_confirm()
{
    global $connection;
    $user_name = "";

    // Lấy username từ bảng users
    $user_id = $_SESSION['user_id']; // Giả sử user_id đã được lưu trữ trong session
    $query_user = query("SELECT username FROM users WHERE user_id = " . escape_string($user_id));
    confirm($query_user);
    while ($row_user = fetch_array($query_user)) {
        $user_name = $row_user['username'];
    }

    $query = query("SELECT * FROM buy WHERE user_name = '{$user_name}' ORDER BY add_date DESC");
    // Kiểm tra xem có dữ liệu hay không
    if (mysqli_num_rows($query) > 0) {

        while ($row = fetch_array($query)) {
            $amount = number_format($row['amount']);
            $price = number_format($row['price']);
            $date = $row['add_date'];
            $status = $row['status'];
            $photo = display_images($row['photo']);
            if ($status == 'Đã xác nhận') {
                $order = <<<DELIMETER
                <div class="col-md-12 d-sm-flex justify-content-center">
                <div class="card px-2">
                   <div class="card-header bg-white">
                      <div class="row justify-content-between">
                         <div class="col">
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                               <strong> Mã đơn hàng :</strong>
                               <h4 class="font-weight-bold text-primary">
                               <a class='custom-link' href='index_user.php?detail_order&buy_code={$row['buy_code']}'>#{$row['buy_code']}</a></h4>
                            </li>
                         </div>
                      </div>
                   </div>
                   <div class="card-body">
                      <div class="media flex-column flex-sm-row">
                         <div class="col-md-6 navbar-left">
                            <img class="align-self-center img-fluid" src="../../kresources/$photo" width="180 " height="180">
                         </div>
                         <div class="media-body text-right">
                            <h5 class="bold">{$row['product_name']}</h5>
                            <p class="mt-3 mb-4 bold">Đơn giá: <span class="mt-5 text-warning">{$price} VND </p>
                            <p class="text-muted"> Số lượng: {$row['quantity']} sản phẩm</p>
                            <h5 class="">Thành tiền: <span class="mt-5 text-warning">{$amount} VND </h5>
                         </div>
                      </div>
                   </div>
                   <div class="row px-3">
                      <div class="col">
                         <ul id="progressbar">
                         <li class="step0 active " id="step1">ĐANG XỬ LÝ<i class='fa fa-redo'></i> </li>
                         <li class="step0 text-muted  text-center" id="step2">ĐÃ XÁC NHẬN<br><i class='far fa-check-circle'></i></li>
                         <li class="step0 text-muted text-center" id="step3">ĐANG GIAO HÀNG<br><i class='fa fa-truck-moving'></i></li>
                         <li class="step0  text-muted text-right" id="step4">ĐÃ HOÀN THÀNH<br><i class='fa fa-clipboard-check'></i></li>
                         </ul>
                      </div>
                   </div>
                </div>
             </div>
             DELIMETER;
                echo $order;
                $page = 3;
                $_SESSION["page"] = $page;
            }
        }
    } else {
        echo "<tr><td colspan='3'>Không có đơn hàng</td></tr>";
    }
}
//hiển thị đơn hàng đang được giao
function display_ship()
{
    global $connection;
    $user_name = "";

    // Lấy username từ bảng users
    $user_id = $_SESSION['user_id']; // Giả sử user_id đã được lưu trữ trong session
    $query_user = query("SELECT username FROM users WHERE user_id = " . escape_string($user_id));
    confirm($query_user);
    while ($row_user = fetch_array($query_user)) {
        $user_name = $row_user['username'];
    }

    $query = query("SELECT * FROM buy WHERE user_name = '{$user_name}' ORDER BY add_date DESC");
    // Kiểm tra xem có dữ liệu hay không
    if (mysqli_num_rows($query) > 0) {
        $count = 0;

        while ($row = fetch_array($query)) {
            $amount = number_format($row['amount']);
            $price = number_format($row['price']);
            $status = $row['status'];
            $photo = display_images($row['photo']);
            if ($status == 'Đang giao hàng') {
                $count++;
                $order = <<<DELIMETER
                <div class="col-md-12 d-sm-flex justify-content-center">
                <div class="card px-2">
                   <div class="card-header bg-white">
                      <div class="row justify-content-between">
                         <div class="col">
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                               <strong> Mã đơn hàng :</strong>
                               <h4 class="font-weight-bold text-primary">
                               <a class='custom-link' href='index_user.php?detail_order&buy_code={$row['buy_code']}'>#{$row['buy_code']}</a></h4>
                            </li>
                         </div>
                      </div>
                   </div>
                   <div class="card-body">
                      <div class="media flex-column flex-sm-row">
                         <div class="col-md-6 navbar-left">
                            <img class="align-self-center img-fluid" src="../../kresources/$photo" width="180 " height="180">
                         </div>
                         <div class="media-body text-right">
                            <h5 class="bold">{$row['product_name']}</h5>
                            <p class="mt-3 mb-4 bold">Đơn giá: <span class="mt-5 text-warning">{$price} VND </p>
                            <p class="text-muted"> Số lượng: {$row['quantity']} sản phẩm</p>
                            <h5 class="mt-3 mb-4 bold">Thành tiền: <span class="mt-5 text-warning">{$amount} VND </h5>
                            <form class="media-body text-right" id='form{$row['buy_code']}' action='index_user.php?update_user_status&buy_code={$row['buy_code']}' method='post' enctype='multipart/form-data'>
                                <input type='hidden' name='status'  value='Đã hoàn thành'>
                                <input type='submit' name='edit_status' class='btn  btn-success' value='Đã nhận được hàng' onclick="return confirm('Bạn đã nhận được đơn hàng và hoàn tất thanh toán? ')">
                               
                            </form>
                         </div>
                      </div>
                   </div>
                   <div class="row px-3">
                      <div class="col">
                         <ul id="progressbar">
                         <li class="step0 active" id="step1">ĐANG XỬ LÝ<i class='fa fa-redo'></i> </li>
                         <li class="step0 active  text-center" id="step2">ĐÃ XÁC NHẬN<br><i class='far fa-check-circle'></i></li>
                         <li class="step0 active text-center" id="step3">ĐANG GIAO HÀNG<br><i class='fa fa-truck-moving'></i></li>
                         <li class="step0  text-muted text-right" id="step4">ĐÃ HOÀN THÀNH<br><i class='fa fa-clipboard-check'></i></li>
                         </ul>
                      </div>
                   </div>
                </div>
             </div>
             DELIMETER;
                echo $order;
                $page = 4;
                $_SESSION["page"] = $page;
            }
        }
    }
    if ($count == 0) {
        echo "<tr><td colspan='3'>Không có đơn hàng</td></tr>";
    }
}
//hiển thị đơn hàng đã hoàn thành
function display_delive()
{
    global $connection;
    $user_name = "";
    // Lấy username từ bảng users
    $user_id = $_SESSION['user_id']; // Giả sử user_id đã được lưu trữ trong session
    $query_user = query("SELECT username FROM users WHERE user_id = " . escape_string($user_id));
    confirm($query_user);
    while ($row_user = fetch_array($query_user)) {
        $user_name = $row_user['username'];
    }

    $query = query("SELECT * FROM buy WHERE user_name = '{$user_name}' ORDER BY add_date DESC");
    // Kiểm tra xem có dữ liệu hay không
    if (mysqli_num_rows($query) > 0) {
        $count = 0;

        while ($row = fetch_array($query)) {
            $count2 = 0;
            $amount = number_format($row['amount']);
            $price = number_format($row['price']);
            $status = $row['status'];
            $photo = display_images($row['photo']);
            $count++;
            if ($status == 'Đã hoàn thành') {
                $query2 = query("SELECT product_name FROM reports WHERE report_code='{$row['buy_code']}'");
                confirm($query2);
                while ($row_report = fetch_array($query2)) {
                    if (empty($row_report["product_name"])) {
                        $count2 = 0;
                    } else {
                        $count2 = 1;
                    }
                }
                if ($count2 == 0) {
                    $comment = <<<DELIMETER
                    <div class="modal fade" id="staticBackdropReport" data-backdrop="static" data-keyboard="false" tabindex="-1"
                      aria-labelledby="staticBackdropLabelReport" aria-hidden="true">
                      <a href="index_user.php?report&product_name={$row['product_name']}&buy_code={$row['buy_code']}"></a>
                    </div>
                    <div class="col my-auto"  style="border-radius:25px;">
                      <h5><strong>
                      <a class="custom-link" href="index_user.php?report&product_name={$row['product_name']}&buy_code={$row['buy_code']}">Đánh giá</a>
                      </strong></h5>
                    </div>
                    DELIMETER;
                } else {
                    $comment = <<<DELIMETER
                    &ensp;
                    DELIMETER;
                }
                $order = <<<DELIMETER
                <div class="col-md-12 d-sm-flex justify-content-center">
                <div class="card px-2">
                   <div class="card-header bg-white">
                      <div class="row justify-content-between">
                         <div class="col">
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                               <strong> Mã đơn hàng :</strong>
                               <h4 class="font-weight-bold text-primary">
                               <a class='custom-link' href='index_user.php?detail_order&buy_code={$row['buy_code']}'>#{$row['buy_code']}</a></h4>
                            </li>
                         </div>
                      </div>
                   </div>
                   <div class="card-body">
                      <div class="media flex-column flex-sm-row">
                         <div class="col-md-6 navbar-left">
                            <img class="align-self-center img-fluid" src="../../kresources/$photo" width="180 " height="180">
                         </div>
                         <div class="media-body text-right">
                            <h5 class="bold">{$row['product_name']}</h5>
                            <p class="mt-3 mb-4 bold">Đơn giá: <span class="mt-5 text-warning">{$price} VND </p>
                            <p class="text-muted"> Số lượng: {$row['quantity']} sản phẩm</p>
                            <h5 class="mt-3 mb-4 bold">Thành tiền: <span class="mt-5 text-warning">{$amount} VND </h5>
                            $comment
                         </div>
                      </div>
                   </div>
                   <div class="row px-3">
                      <div class="col">
                         <ul id="progressbar">
                         <li class="step0 active" id="step1">ĐANG XỬ LÝ<i class='fa fa-redo'></i> </li>
                         <li class="step0 active  text-center" id="step2">ĐÃ XÁC NHẬN<br><i class='far fa-check-circle'></i></li>
                         <li class="step0 active text-center" id="step3">ĐANG GIAO HÀNG<br><i class='fa fa-truck-moving'></i></li>
                         <li class="step0 active text-right" id="step4">ĐÃ HOÀN THÀNH<br><i class='fa fa-clipboard-check'></i></li>
                         </ul>
                      </div>
                   </div>
                </div>
             </div>
             DELIMETER;
                echo $order;
                $page = 5;
                $_SESSION["page"] = $page;
            }
        }
    }
    if ($count == 0) {
        echo "<tr><td colspan='3'>Không có đơn hàng</td></tr>";
    }
}
/********************************HIỂN THỊ TRANG ĐƠN HÀNG DẠNG FULL*************************** */
//hiển thị đơn hàng ad
function display_adorder()
{
    $query = query("SELECT * FROM buy ORDER BY 
    CASE
            WHEN status = 'Đang xử lý' THEN 1
            WHEN status = 'Đã xác nhận' THEN 2
            WHEN status = 'Đang giao hàng' THEN 3
            ELSE 4
    END,id DESC");
    confirm($query);

    if (mysqli_num_rows($query) > 0) {


        while ($row = fetch_array($query)) {
            $photo = display_images($row['photo']);
            $price = number_format($row['price']);
            $id = $row['id'];
            $address = nl2br($row['buyad']);
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $addDate = $row['add_date'];
            $date = date('H:i:s d/m/Y', strtotime($row['add_date']));
            $newDate = date('d/m/Y', strtotime("$addDate +3 days"));
            $get_date = date('H:i:s d/m/Y', strtotime($row['receive_date']));
            $status = $row['status'];
            $amount = number_format($row['amount']);
            if ($status == 'Đang xử lý') {
                $admin_status = <<<DELIMETER
                <form id='form{$row['id']}' action='index.php?update_status&order_id={$row['id']}' method='post' enctype='multipart/form-data'>
                        <input type='hidden' name='status' value='Đã xác nhận'>
                    <div class='form-group text-left'>
                        <input type='submit' name='edit_status' class='btn btn' value='{$row['status']}'
                         onclick="return confirm('Bạn có muốn làm mới trạng thái đơn hàng?')">
                    </div>
                </form> 
                DELIMETER;
                $display_date = <<<DELIMETER
                <div class="col"> <strong>Thời gian đặt hàng:</strong> <br>$date</div>
                <div class="col"> <strong>Giao hàng dự kiến:</strong> <br>$newDate </i></div>
                DELIMETER;
                $dis_status = <<<DELIMETER
                
                <ul id="progressbar" class="text-center">
                <li class="step0 text-muted " id="step1"> </li>
                <li class="step0 text-muted  text-center" id="step2"></li>
                <li class="step0 text-muted text-center" id="step3"></li>
                <li class="step0  text-muted text-right" id="step4"></li>
                </ul>
                DELIMETER;
            } elseif ($status == 'Đã xác nhận') {
                $admin_status = <<<DELIMETER
                <form id='form{$row['id']}' action='index.php?update_status&order_id={$row['id']}' method='post' enctype='multipart/form-data'>
                        <input type='hidden' name='status' value='Đang giao hàng'>
                    <div class='form-group text-left'>
                        <input type='submit' name='edit_status' class='btn btn-danger' value='{$row['status']}' 
                        onclick="return confirm('Bạn có muốn làm mới trạng thái đơn hàng?')>
                    </div>
                </form> 
                DELIMETER;
                $display_date = <<<DELIMETER
                <div class="col"> <strong>Thời gian đặt hàng:</strong> <br>$date</div>
                <div class="col"> <strong>Giao hàng dự kiến:</strong> <br>$newDate </i></div>
                DELIMETER;
                $dis_status = <<<DELIMETER
                
                <ul id="progressbar" class="text-center">
                <li class="step0 active " id="step1"> </li>
                <li class="step0 text-muted  text-center" id="step2"></li>
                <li class="step0 text-muted text-center" id="step3"></li>
                <li class="step0  text-muted text-right" id="step4"></li>
                </ul>
                DELIMETER;
            } elseif ($status == 'Đang giao hàng') {
                $admin_status = <<<DELIMETER
                <form id='form{$row['id']}' action='index.php?update_status&order_id={$row['id']}' method='post' enctype='multipart/form-data'>
                        <input type='hidden' name='status' value='Đã hoàn thành'>
                    <div class='form-group text-left'>
                        <input type='submit' name='edit_status' class='btn btn-success' value='{$row['status']}' 
                        onclick="return confirm('Bạn có muốn làm mới trạng thái đơn hàng?')>
                    </div>
                </form> 
                DELIMETER;
                $display_date = <<<DELIMETER
                <div class="col"> <strong>Thời gian đặt hàng:</strong> <br>$date</div>
                <div class="col"> <strong>Giao hàng dự kiến:</strong> <br>$newDate </i></div>
                DELIMETER;
                $dis_status = <<<DELIMETER
                
                <ul id="progressbar" class="text-center">
                <li class="step0 active  " id="step1"> </li>
                <li class="step0 active  text-center" id="step2"></li>
                <li class="step0 active text-center" id="step3"></li>
                <li class="step0  text-muted text-right" id="step4"></li>
                </ul>
                DELIMETER;
            } else {
                $admin_status = <<<DELIMETER
                <div class='btn btn-primary'>{$row['status']}</div>
                DELIMETER;
                $display_date = <<<DELIMETER
                <div class="col"> <strong>Thời gian đặt hàng:</strong> <br>$date</div>
                <div class="col"> <strong>Thời gian nhận hàng:</strong> <br> $get_date</i></div>
                DELIMETER;
                $dis_status = <<<DELIMETER
                
                <ul id="progressbar" class="text-center">
                <li class="step0 active  " id="step1"> </li>
                <li class="step0  active   text-center" id="step2"></li>
                <li class="step0  active text-center" id="step3"></li>
                <li class="step0   active text-right" id="step4"></li>
                </ul>
                DELIMETER;
            }
            $admin_order = <<<DELIMETER
            
            <article class="card" style="border-radius: 25px;">
            <div class="card-body" style="border-radius: 25px;">
            <h5 style="margin-left:10px;">ID: $id</h5>
            <article class="card">
               <div class="card-body row" style="border-radius: 15px;">
                  $display_date
                  
                  <div class="col"> <strong>Trạng thái:</strong> <br>$admin_status  </div>
                  <div class="col"> <strong>Mã đơn hàng :</strong> <br>#{$row['buy_code']}</div>
               </div>
            </article>
            <ul class="row">
               <li class="col-md-5">
                  <figure class="itemside mb-3">
                     <div class="aside">
                        <img src="../../kresources/$photo" class="img-sm border">
                     </div>
                     <figcaption class="info align-self-center">
                        <p class="title">{$row['product_name']} <br> Số lượng : {$row['quantity']}</p> <span class="text-muted">Giá : $price VND
                        </span>
                     </figcaption>
                  </figure>
               </li>
               <li class="col-md-5">
                  <figure class="itemside mb-3">
                     <div class="aside"><img src="../../kresources/uploads/location.jpg" class="img-sm border"></div>
                     <figcaption class="info align-self-center">
                        <p class="title" style="margin-left:25px;">Địa chỉ nhận hàng: <br></p> <span class="text-muted">$address</span>
                     </figcaption>
                  </figure>
               </li>
               <li class="col-md-2">
                  <figure class="itemside mb-3">
                  <a class='text-right btn btn-danger' href='..\..\kresources\ktemplates\backend\delete_ad_order.php?id={$row['id']}'
                  onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng không?')">hủy đơn </a>
                  </figure>
               </li>
               <br />
               <h6 class="text-warring" style="margin-left:15px;"> Tổng tiền : $amount VND</h6>
            </ul>
            <hr>
            <div>
             $dis_status
            </div>
            <div class="row justify-content-between top">
               <div class="row d-flex icon-content">
                  <img class="icon" src="../../kresources/uploads/process.png">
                  <div class="d-flex flex-column">
                     <p class="font-weight-bold">Đang<br> xử lý</p>
                  </div>
               </div>
               <div class="row d-flex icon-content">
                  <img class="icon" src="../../kresources/uploads/confirm.png">
                  <div class="d-flex flex-column">
                     <p class="font-weight-bold">Đã<br> xác nhận</p>
                  </div>
               </div>
               <div class="row d-flex icon-content">
                  <img class="icon" src="../../kresources/uploads/ship.png">
                  <div class="d-flex flex-column">
                     <p class="font-weight-bold">Đang<br> giao hàng</p>
                  </div>
               </div>
               <div class="row d-flex icon-content">
                  <img class="icon" src="../../kresources/uploads/completed.png">
                  <div class="d-flex flex-column">
                     <p class="font-weight-bold">Đã<br> hoàn thành</p>
                  </div>
               </div>
            </div>
            </div>
         </article>
         DELIMETER;
            echo $admin_order;
            $page = 6;
            $_SESSION["page"] = $page;

        }
    } else {
        echo "<br><h4 class='text-center' colspan='4'><strong>Không có đơn hàng</strong></h4>";
    }
}
//search đơn hàng:
function search_order()
{
    if (isset($_GET["order_code"])) {
        $id = $_GET["order_code"];
        $query = query("SELECT id,buy_code,vnpay_code,
         user_name, product_name, price, quantity, amount, 
         status,payment, photo, buyad,add_date,receive_date FROM buy WHERE buy_code = '{$id}' OR id='{$id}'");
        confirm($query);
        $row = fetch_array($query);
        $photo = display_images($row['photo']);
        $price = number_format($row['price']);
        if (!empty($row['id']))
            $id = $row['id'];
        $address = nl2br($row['buyad']);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $addDate = $row['add_date'];
        $date = date('H:i:s d/m/Y', strtotime($row['add_date']));
        $newDate = date('d/m/Y', strtotime("$addDate +3 days"));
        $get_date = date('H:i:s d/m/Y', strtotime($row['receive_date']));
        $status = $row['status'];
        $amount = number_format($row['amount']);
        if ($status == 'Đang xử lý') {
            $admin_status = <<<DELIMETER
            <form id='form{$row['id']}' action='index.php?update_status&order_id={$row['id']}' method='post' enctype='multipart/form-data'>
                    <input type='hidden' name='status' value='Đã xác nhận'>
                <div class='form-group text-left'>
                    <input type='submit' name='edit_status' class='btn btn' value='{$row['status']}' onclick="return confirm('Bạn có muốn làm mới trạng thái đơn hàng?')">
                </div>
            </form> 
            DELIMETER;
            $display_date = <<<DELIMETER
            <div class="col"> <strong>Thời gian đặt hàng:</strong> <br>$date</div>
            <div class="col"> <strong>Giao hàng dự kiến</strong> <br>$newDate </i></div>
            DELIMETER;
            $dis_status = <<<DELIMETER
            
            <ul id="progressbar" class="text-center">
            <li class="step0 text-muted " id="step1"> </li>
            <li class="step0 text-muted  text-center" id="step2"></li>
            <li class="step0 text-muted text-center" id="step3"></li>
            <li class="step0  text-muted text-right" id="step4"></li>
            </ul>
            DELIMETER;
        } elseif ($status == 'Đã xác nhận') {
            $admin_status = <<<DELIMETER
            <form id='form{$row['id']}' action='index.php?update_status&order_id={$row['id']}' method='post' enctype='multipart/form-data'>
                    <input type='hidden' name='status' value='Đang giao hàng'>
                <div class='form-group text-left'>
                    <input type='submit' name='edit_status' class='btn btn-danger' value='{$row['status']}' onclick="return confirm('Bạn có muốn làm mới trạng thái đơn hàng?')>
                </div>
            </form> 
            DELIMETER;
            $display_date = <<<DELIMETER
            <div class="col"> <strong>Thời gian đặt hàng:</strong> <br>$date</div>
            <div class="col"> <strong>Giao hàng dự kiến</strong> <br>$newDate </i></div>
            DELIMETER;
            $dis_status = <<<DELIMETER
            
            <ul id="progressbar" class="text-center">
            <li class="step0 active " id="step1"> </li>
            <li class="step0 text-muted  text-center" id="step2"></li>
            <li class="step0 text-muted text-center" id="step3"></li>
            <li class="step0  text-muted text-right" id="step4"></li>
            </ul>
            DELIMETER;
        } elseif ($status == 'Đang giao hàng') {
            $admin_status = <<<DELIMETER
            <form id='form{$row['id']}' action='index.php?update_status&order_id={$row['id']}' method='post' enctype='multipart/form-data'>
                    <input type='hidden' name='status' value='Đã hoàn thành'>
                <div class='form-group text-left'>
                    <input type='submit' name='edit_status' class='btn btn-success' value='{$row['status']}' onclick="return confirm('Bạn có muốn làm mới trạng thái đơn hàng?')>
                </div>
            </form> 
            DELIMETER;
            $display_date = <<<DELIMETER
            <div class="col"> <strong>Thời gian đặt hàng:</strong> <br>$date</div>
            <div class="col"> <strong>Giao hàng dự kiến</strong> <br>$newDate </i></div>
            DELIMETER;
            $dis_status = <<<DELIMETER
            
            <ul id="progressbar" class="text-center">
            <li class="step0 active  " id="step1"> </li>
            <li class="step0 active  text-center" id="step2"></li>
            <li class="step0 active text-center" id="step3"></li>
            <li class="step0  text-muted text-right" id="step4"></li>
            </ul>
            DELIMETER;
        } else {
            $admin_status = <<<DELIMETER
            <div class='btn btn-primary'>{$row['status']}</div>
            DELIMETER;
            $display_date = <<<DELIMETER
            <div class="col"> <strong>Thời gian đặt hàng:</strong> <br>$date</div>
            <div class="col"> <strong>Thời gian nhận hàng:</strong> <br> $get_date</i></div>
            DELIMETER;
            $dis_status = <<<DELIMETER
            
            <ul id="progressbar" class="text-center">
            <li class="step0 active  " id="step1"> </li>
            <li class="step0  active   text-center" id="step2"></li>
            <li class="step0  active text-center" id="step3"></li>
            <li class="step0   active text-right" id="step4"></li>
            </ul>
            DELIMETER;
        }
        $admin_order = <<<DELIMETER
        
        <article class="card">
        <div class="card-body">
        <h5>ID:$id</h5>
        <article class="card">
           <div class="card-body row">
              $display_date
              <div class="col"> <strong>Trạng thái:</strong> <br>$admin_status  </div>
              <div class="col"> <strong>Mã đơn hàng :</strong> <br>#{$row['buy_code']}</div>
           </div>
        </article>
        <ul class="row">
           <li class="col-md-5">
              <figure class="itemside mb-3">
                 <div class="aside">
                    <img src="../../kresources/$photo" class="img-sm border">
                 </div>
                 <figcaption class="info align-self-center">
                    <p class="title">{$row['product_name']} <br> Số lượng: {$row['quantity']} sản phẩm</p> <span class="text-muted">giá:$price VND
                    </span>
                 </figcaption>
              </figure>
           </li>
           <li class="col-md-5">
              <figure class="itemside mb-3">
                 <div class="aside"><img src="../../kresources/uploads/location.jpg" class="img-sm border"></div>
                 <figcaption class="info align-self-center">
                    <p class="title">Địa chỉ nhận hàng: <br></p> <span class="text-muted">$address</span>
                 </figcaption>
              </figure>
           </li>
           <li class="col-md-2">
              <figure class="itemside mb-3">
              <a class='text-right btn btn-danger' href='..\..\kresources\ktemplates\backend\delete_ad_order.php?id={$row['id']}'
              onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng không?')">hủy đơn </a>
              </figure>
           </li>
           <br />
           <h6 class="text-warring" style="margin-left:1%;">Tổng tiền :$amount VND</h6>
        </ul>
        <hr>
        <div>
         $dis_status
        </div>
        <div class="row justify-content-between top">
           <div class="row d-flex icon-content">
              <img class="icon" src="../../kresources/uploads/process.png">
              <div class="d-flex flex-column">
                 <p class="font-weight-bold">Đang<br> xử lý</p>
              </div>
           </div>
           <div class="row d-flex icon-content">
              <img class="icon" src="../../kresources/uploads/confirm.png">
              <div class="d-flex flex-column">
                 <p class="font-weight-bold">Đã<br> xác nhận</p>
              </div>
           </div>
           <div class="row d-flex icon-content">
              <img class="icon" src="../../kresources/uploads/ship.png">
              <div class="d-flex flex-column">
                 <p class="font-weight-bold">Đang<br> giao hàng</p>
              </div>
           </div>
           <div class="row d-flex icon-content">
              <img class="icon" src="../../kresources/uploads/completed.png">
              <div class="d-flex flex-column">
                 <p class="font-weight-bold">Đã<br> hoàn thành</p>
              </div>
           </div>
        </div>
        </div>
     </article>
     DELIMETER;
        echo $admin_order;
        $page = 11;
        $_SESSION["page"] = $page;
    }
}

//hiển thị đơn hàng đang chờ xử lý:
function display_ad_process()
{
    $count = 0;
    $query = query("SELECT * FROM buy ORDER BY id DESC");
    confirm($query);

    if (mysqli_num_rows($query) > 0) {


        while ($row = fetch_array($query)) {
            $photo = display_images($row['photo']);
            $price = number_format($row['price']);
            $id = $row['id'];
            $address = nl2br($row['buyad']);
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $addDate = $row['add_date'];
            $date = date('H:i:s d/m/Y', strtotime($row['add_date']));
            $newDate = date('d/m/Y', strtotime("$addDate +3 days"));
            $status = $row['status'];
            $amount = number_format($row['amount']);
            if ($status == 'Đang xử lý') {
                $admin_status = <<<DELIMETER
                <form id='form{$row['id']}' action='index.php?update_status&order_id={$row['id']}' method='post' enctype='multipart/form-data'>
                        <input type='hidden' name='status' value='Đã xác nhận'>
                    <div class='form-group text-left'>
                        <input type='submit' name='edit_status' class='btn btn' value='{$row['status']}' onclick="return confirm('Bạn có muốn làm mới trạng thái đơn hàng?')">
                    </div>
                </form> 
                DELIMETER;
                $display_date = <<<DELIMETER
                <div class="col"> <strong>Thời gian đặt hàng:</strong> <br>$date</div>
                <div class="col"> <strong>Giao hàng dự kiến :</strong> <br>$newDate </i></div>
                DELIMETER;
                $admin_order = <<<DELIMETER
                
                <article class="card" style="border-radius:25px;">
                <div class="card-body">
                <h5 style="margin-left:10px;">ID: $id</h5>
                <article class="card">
                   <div class="card-body row" style="border-radius:15px;">
                      $display_date
                      <div class="col"> <strong>Trạng thái:</strong> <br>$admin_status </div>
                      <div class="col"> <strong>Mã đơn hàng :</strong> <br>#{$row['buy_code']}</div>
                   </div>
                </article>
                <ul class="row">
                   <li class="col-md-5">
                      <figure class="itemside mb-3">
                         <div class="aside">
                            <img src="../../kresources/$photo" class="img-sm border">
                         </div>
                         <figcaption class="info align-self-center">
                            <p class="title">{$row['product_name']} <br> Số lượng: {$row['quantity']}</p> <span class="text-muted">Giá: $price VND
                            </span>
                         </figcaption>
                      </figure>
                   </li>
                   <li class="col-md-5">
                      <figure class="itemside mb-3">
                         <div class="aside"><img src="../../kresources/uploads/location.jpg" class="img-sm border"></div>
                         <figcaption class="info align-self-center">
                            <p class="title" style="margin-left:5px;">Địa chỉ nhận hàng: <br></p>
                            <span class="text-muted" style="margin-left: 5px;">$address</span>
                         </figcaption>
                      </figure>
                   </li>
                   <li class="col-md-2">
                      <figure class="itemside mb-3">
                      <a class='text-right btn btn-danger' href='..\..\kresources\ktemplates\backend\delete_ad_order.php?id={$row['id']}'
                      onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng không?')">hủy đơn </a>
                      </figure>
                   </li>
                   <br />
                   <h6 class="text-warring" style="margin-left:1%;">Tổng tiền: $amount VND</h6>
                </ul>
                <hr>
             </div>
             </article>
             DELIMETER;
                echo $admin_order;
                $count++;
                $page = 7;
                $_SESSION["page"] = $page;

            }
        }
    }
    if ($count == 0) {
        echo "<br><h4 class='text-center' colspan='4'><strong>Không có đơn hàng</strong></h4>";
    }
}
//Hiển thị đơn hàng theo trạng thái : đã xác nhận

function display_ad_confirm()
{
    $count = 0;
    $query = query("SELECT * FROM buy ORDER BY id DESC");
    confirm($query);

    if (mysqli_num_rows($query) > 0) {


        while ($row = fetch_array($query)) {
            $photo = display_images($row['photo']);
            $price = number_format($row['price']);
            $id = $row['id'];
            $address = nl2br($row['buyad']);
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $addDate = $row['add_date'];
            $date = date('H:i:s d/m/Y', strtotime($row['add_date']));
            $newDate = date('d/m/Y', strtotime("$addDate +3 days"));
            $amount = number_format($row['amount']);
            $status = $row['status'];
            if ($status == 'Đã xác nhận') {
                $admin_status = <<<DELIMETER
                    <form id='form{$row['id']}' action='index.php?update_status&order_id={$row['id']}' method='post' enctype='multipart/form-data'>
                            <input type='hidden' name='status' value='Đang giao hàng'>
                        <div class='form-group text-left'>
                            <input type='submit' name='edit_status' class='btn  btn-danger' value='{$row['status']}' onclick="return confirm('Bạn có muốn làm mới trạng thái đơn hàng?')">
                        </div>
                    </form>  
                    DELIMETER;
                $display_date = <<<DELIMETER
                    <div class="col"> <strong>Thời gian đặt hàng:</strong> <br>$date</div>
                    <div class="col"> <strong>Giao hàng dự kiến:</strong> <br>$newDate </i></div>
                    DELIMETER;
                $admin_order = <<<DELIMETER
                
                <article class="card" style="border-radius:25px;">
                <div class="card-body">
                <h5 style="margin-left:10px;">ID: $id</h5>
                <article class="card">
                   <div class="card-body row" style="border-radius:15px;">
                      $display_date
                      <div class="col"> <strong>Trạng thái:</strong> <br> $admin_status  </div>
                      <div class="col"> <strong>Mã đơn hàng :</strong> <br>#{$row['buy_code']}</div>
                   </div>
                </article>
                <ul class="row">
                   <li class="col-md-5">
                      <figure class="itemside mb-3">
                         <div class="aside">
                            <img src="../../kresources/$photo" class="img-sm border">
                         </div>
                         <figcaption class="info align-self-center">
                            <p class="title">{$row['product_name']} <br> Số lượng: {$row['quantity']}</p> <span class="text-muted">Giá: $price VND
                            </span>
                         </figcaption>
                      </figure>
                   </li>
                   <li class="col-md-5">
                      <figure class="itemside mb-3">
                         <div class="aside"><img src="../../kresources/uploads/location.jpg" class="img-sm border"></div>
                         <figcaption class="info align-self-center">
                            <p class="title" style="margin-left:5px;"> Địa chỉ nhận hàng: <br></p>
                            <span class="text-muted" style="margin-right:15px;">$address</span>
                         </figcaption>
                      </figure>
                   </li>
                   <li class="col-md-2">
                      <figure class="itemside mb-3">
                      <a class='text-right btn btn-danger' href='..\..\kresources\ktemplates\backend\delete_ad_order.php?id={$row['id']}'
                      onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng không?')">hủy đơn </a>
                      </figure>
                   </li>
                   <br />
                   <h6 class="text-warring" style="margin-left:1%;">Tổng tiền: $amount VND</h6>
                </ul>
                <hr>
             </div>
             </article>
             DELIMETER;
                echo $admin_order;
                $count++;
                $page = 8;
                $_SESSION["page"] = $page;

            }
        }
    }
    if ($count == 0) {
        echo "<br><h4 class='text-center' colspan='4'><strong>Không có đơn hàng</strong></h4>";
    }
}
//Hiển thị đơn hàng theo trạng thái đang vận chuyển
function display_ad_ship()
{
    $count = 0;
    $query = query("SELECT * FROM buy ORDER BY id DESC");
    confirm($query);

    if (mysqli_num_rows($query) > 0) {


        while ($row = fetch_array($query)) {
            $photo = display_images($row['photo']);
            $price = number_format($row['price']);
            $id = $row['id'];
            $address = nl2br($row['buyad']);
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $addDate = $row['add_date'];
            $date = date('H:i:s d/m/Y', strtotime($row['add_date']));
            $newDate = date('d/m/Y', strtotime("$addDate +3 days"));
            $amount = number_format($row['amount']);
            $status = $row['status'];
            if ($status == 'Đang giao hàng') {
                $admin_status = <<<DELIMETER
                <form id='form{$row['id']}' action='index.php?update_status&order_id={$row['id']}' method='post' enctype='multipart/form-data'>
                        <input type='hidden' name='status'  value='Đã hoàn thành'>
                    <div class='form-group text-left'>
                        <input type='submit' name='edit_status' class='btn  btn-success' value='{$row['status']}' onclick="return confirm('Bạn có muốn làm mới trạng thái đơn hàng?')">
                    </div>
                </form> 
                DELIMETER;
                $display_date = <<<DELIMETER
                <div class="col"> <strong>Thời gian đặt hàng:</strong> <br>$date</div>
                <div class="col"> <strong>Giao hàng dự kiến:</strong> <br>$newDate </i></div>
                DELIMETER;
                $admin_order = <<<DELIMETER
                
                <article class="card" style="border-radius:25px;">
                <div class="card-body">
                <h5 style="margin-left:10px;">ID: $id</h5>
                <article class="card">
                   <div class="card-body row" style="border-radius:15px;">
                      $display_date
                      
                      <div class="col"> <strong>Trạng thái:</strong> <br>$admin_status  </div>
                      <div class="col"> <strong>Mã đơn hàng :</strong> <br>#{$row['buy_code']}</div>
                   </div>
                </article>
                <ul class="row">
                   <li class="col-md-5">
                      <figure class="itemside mb-3">
                         <div class="aside">
                            <img src="../../kresources/$photo" class="img-sm border">
                         </div>
                         <figcaption class="info align-self-center">
                            <p class="title">{$row['product_name']} <br> Số lượng: {$row['quantity']}</p> <span class="text-muted">Giá: $price VND
                            </span>
                         </figcaption>
                      </figure>
                   </li>
                   <li class="col-md-5">
                      <figure class="itemside mb-3">
                         <div class="aside"><img src="../../kresources/uploads/location.jpg" class="img-sm border"></div>
                         <figcaption class="info align-self-center">
                            <p class="title" style="margin-left:5px;">Địa chỉ nhận hàng: <br></p> <span class="text-muted">$address</span>
                         </figcaption>
                      </figure>
                   </li>
                   <li class="col-md-2">
                      <figure class="itemside mb-3">
                      <a class='text-right btn btn-danger' href='..\..\kresources\ktemplates\backend\delete_ad_order.php?id={$row['id']}'
                      onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng không?')">hủy đơn </a>
                      </figure>
                   </li>
                   <br />
                   <h6 class="text-warring" style="margin-left:1%;">Tổng tiền: $amount VND</h6>
                </ul>
                <hr>
             </div>
             </article>
             DELIMETER;
                echo $admin_order;
                $count++;
                $page = 9;
                $_SESSION["page"] = $page;

            }
        }
    }
    if ($count == 0) {
        echo "<br><h4 class='text-center' colspan='4'><strong>Không có đơn hàng</strong></h4>";
    }
}
//Hiển thị danh sách đơn hàng theo trạng thái đã hoàn thành
function display_ad_delive()
{
    $count = 0;
    $query = query("SELECT * FROM buy ORDER BY id DESC");
    confirm($query);

    if (mysqli_num_rows($query) > 0) {


        while ($row = fetch_array($query)) {
            $photo = display_images($row['photo']);
            $price = number_format($row['price']);
            $id = $row['id'];
            $address = nl2br($row['buyad']);
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $addDate = $row['add_date'];
            $date = date('H:i:s d/m/Y', strtotime($row['add_date']));
            $get_date = date('H:i:s d/m/Y', strtotime($row['receive_date']));
            $status = $row['status'];
            $amount = number_format($row['amount']);
            if ($status == 'Đã hoàn thành') {

                $admin_status = <<<DELIMETER
                <div class='btn btn-primary'>{$row['status']}</div>
                DELIMETER;
                $display_date = <<<DELIMETER
                <div class="col"> <strong>Thời gian đặt hàng:</strong> <br>$date</div>
                <div class="col"> <strong>Giao hàng dự kiến:</strong> <br> $get_date</i>
                DELIMETER;
                $admin_order = <<<DELIMETER
                
                <article class="card">
                <div class="card-body">
                <h5 style="margin-left:10px;">ID: $id</h5>
                <article class="card">
                   <div class="card-body row" style="border-radius:15px;">
                      $display_date
                      </div>
                      <div class="col"> <strong>Trạng thái:</strong> <br>$admin_status  </div>
                      <div class="col"> <strong>Mã đơn hàng :</strong> <br>#{$row['buy_code']}</div>
                   </div>
                </article>
                <ul class="row">
                   <li class="col-md-5">
                      <figure class="itemside mb-3">
                         <div class="aside">
                            <img src="../../kresources/$photo" class="img-sm border">
                         </div>
                         <figcaption class="info align-self-center">
                            <p class="title">{$row['product_name']} <br> Số lượng: {$row['quantity']} sản phẩm</p> <span class="text-muted">giá:$price VND
                            </span>
                         </figcaption>
                      </figure>
                   </li>
                   <li class="col-md-5">
                      <figure class="itemside mb-3">
                         <div class="aside"><img src="../../kresources/uploads/location.jpg" class="img-sm border"></div>
                         <figcaption class="info align-self-center">
                            <p class="title">Địa chỉ nhận hàng: <br></p> <span class="text-muted">$address</span>
                         </figcaption>
                      </figure>
                   </li>
                   <li class="col-md-2">
                      <figure class="itemside mb-3">
                      <a class='text-right btn btn-danger' href='..\..\kresources\ktemplates\backend\delete_ad_order.php?id={$row['id']}'
                      onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng không?')">hủy đơn </a>
                      </figure>
                   </li>
                   <br />
                   <h6 class="text-warring" style="margin-left:1%;">Tổng tiền :$amount VND</h6>
                </ul>
                <hr>
             </div>
             </article>
             DELIMETER;
                echo $admin_order;
                $count++;
                $page = 10;
                $_SESSION["page"] = $page;

            }
        }
    }
    if ($count == 0) {
        echo "<br><h4 class='text-center' colspan='4'><strong>Không có đơn hàng</strong></h4>";
    }
}
/*************************************HIỂN THỊ TRANG ĐƠN HÀNG DẠNG LIST**************** */
//HIỂN THỊ TẤT CẢ ĐƠN

function display_list_adorder()
{
    $query = query("SELECT * FROM buy ORDER BY 
    CASE
            WHEN status = 'Đang xử lý' THEN 1
            WHEN status = 'Đã xác nhận' THEN 2
            WHEN status = 'Đang giao hàng' THEN 3
            ELSE 4
    END,id DESC");
    confirm($query);

    if (mysqli_num_rows($query) > 0) {


        while ($row = fetch_array($query)) {
            $price = number_format($row['price']);
            $id = $row['id'];
            $address = nl2br($row['buyad']);
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $addDate = $row['add_date'];
            $date = date('H:i:s d/m/Y', strtotime($row['add_date']));
            $newDate = date('d/m/Y', strtotime("$addDate +3 days"));
            $get_date = date('H:i:s d/m/Y', strtotime($row['receive_date']));
            $status = $row['status'];
            $amount = number_format($row['amount']);
            if ($status == 'Đang xử lý') {
                $admin_status = <<<DELIMETER
                <td><form id='form{$row['id']}' action='index.php?update_status&order_id={$row['id']}' method='post' enctype='multipart/form-data'>
                        <input type='hidden' name='status' value='Đã xác nhận'>
                    <div class='form-group text-left'>
                        <input type='submit' name='edit_status' class='btn btn' value='{$row['status']}' onclick="return confirm('Bạn có muốn làm mới trạng thái đơn hàng?')">
                    </div>
                </form></td>
                <td>$date</td>
                <td>Dự kiến :$newDate</td> 
                DELIMETER;
            } elseif ($status == 'Đã xác nhận') {
                $admin_status = <<<DELIMETER
                <td><form id='form{$row['id']}' action='index.php?update_status&order_id={$row['id']}' method='post' enctype='multipart/form-data'>
                        <input type='hidden' name='status' value='Đang giao hàng'>
                    <div class='form-group text-left'>
                        <input type='submit' name='edit_status' class='btn btn-danger' value='{$row['status']}' onclick="return confirm('Bạn có muốn làm mới trạng thái đơn hàng?')">
                    </div>
                </form></td>
                <td>$date</td>
                <td>Dự kiến :$newDate</td> 
                DELIMETER;
            } elseif ($status == 'Đang giao hàng') {
                $admin_status = <<<DELIMETER
                <td><form id='form{$row['id']}' action='index.php?update_status&order_id={$row['id']}' method='post' enctype='multipart/form-data'>
                        <input type='hidden' name='status' value='Đã hoàn thành'>
                    <div class='form-group text-left'>
                        <input type='submit' name='edit_status' class='btn btn-success'  value='{$row['status']}' onclick="return confirm('Bạn có muốn làm mới trạng thái đơn hàng?')">
                    </div>
                </form></td>
                <td>$date</td>
                <td>Dự kiến :$newDate</td> 
                DELIMETER;
            } else {
                $admin_status = <<<DELIMETER
                <td><div class='btn btn-primary'>{$row['status']}</div></td>
                <td>$date</td>
                <td>$get_date</td>
                DELIMETER;
            }
            $admin_order = <<<DELIMETER
            
         <tbody>
            <tr class="cell-1">
               <td>$id
                </td>
                <td>{$row['product_name']}</td>
                <td>{$row['quantity']} sản phẩm</td>
                <td>$price VND</td>
                
                  <td>$amount</td>
                  <td><span class="badge badge-success"></span>$address</td>
                  $admin_status
                  <td>
                  <a class='text-right btn btn-danger' href='..\..\kresources\ktemplates\backend\delete_ad_order.php?id={$row['id']}'
                  onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng không?')">hủy đơn </a>
                  </td>
               </tr>
               </tbody>
         DELIMETER;
            echo $admin_order;
            $page = 6;
            $_SESSION["page"] = $page;

        }
    } else {
        echo "<br><h4 class='text-center' colspan='4'><strong>Không có đơn hàng</strong></h4>";
    }
}
//HIỂN THỊ ĐƠN ĐANG XỬ LÍ

function display_list_process()
{
    $query = query("SELECT * FROM buy ORDER BY 
    CASE
            WHEN status = 'Đang xử lý' THEN 1
            WHEN status = 'Đã xác nhận' THEN 2
            WHEN status = 'Đang giao hàng' THEN 3
            ELSE 4
    END,id DESC");
    confirm($query);

    if (mysqli_num_rows($query) > 0) {


        while ($row = fetch_array($query)) {
            $price = number_format($row['price']);
            $id = $row['id'];
            $address = nl2br($row['buyad']);
            $date = date('H:i:s d/m/Y', strtotime($row['add_date']));
            $get_date = date('H:i:s d/m/Y', strtotime($row['receive_date']));
            $status = $row['status'];
            $amount = number_format($row['amount']);
            if ($status == 'Đang xử lý') {
                $admin_status = <<<DELIMETER
                <td><form id='form{$row['id']}' action='index.php?update_status&order_id={$row['id']}' method='post' enctype='multipart/form-data'>
                        <input type='hidden' name='status' value='Đã xác nhận'>
                    <div class='form-group text-left'>
                        <input type='submit' name='edit_status' class='btn btn' value='{$row['status']}' onclick="return confirm('Bạn có muốn làm mới trạng thái đơn hàng?')">
                    </div>
                </form></td>
                <td>$date</td> 
                DELIMETER;


                $admin_order = <<<DELIMETER
            
         <tbody class="table-body">
            <tr class="cell-1">
               <td>$id
                </td>
                <td>{$row['product_name']}</td>
                <td>$amount</td>
                <td>{$row['quantity']}</td>
                <td>$price VND</td>
                  <td><span class="badge badge-success"></span>$address</td>
                  $admin_status
                  <td>
                  <a class='text-right btn btn-danger' href='..\..\kresources\ktemplates\backend\delete_ad_order.php?id={$row['id']}'
                  onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng không?')">hủy đơn </a>
                  </td>
               </tr>
               </tbody>
         DELIMETER;
                echo $admin_order;
                $page = 7;
                $_SESSION["page"] = $page;

            }
        }
    } else {
        echo "<br><h4 class='text-center' colspan='4'><strong>Không có đơn hàng</strong></h4>";
    }
}
//HIỂN THỊ ĐƠN ĐÃ XÁC NHẬN
function display_list_confirm()
{
    $query = query("SELECT * FROM buy ORDER BY 
    CASE
            WHEN status = 'Đang xử lý' THEN 1
            WHEN status = 'Đã xác nhận' THEN 2
            WHEN status = 'Đang giao hàng' THEN 3
            ELSE 4
    END,id DESC");
    confirm($query);

    if (mysqli_num_rows($query) > 0) {


        while ($row = fetch_array($query)) {
            $price = number_format($row['price']);
            $id = $row['id'];
            $address = nl2br($row['buyad']);
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $date = date('H:i:s d/m/Y', strtotime($row['add_date']));
            $status = $row['status'];
            $amount = number_format($row['amount']);
            if ($status == 'Đã xác nhận') {
                $admin_status = <<<DELIMETER
                <td><form id='form{$row['id']}' action='index.php?update_status&order_id={$row['id']}' method='post' enctype='multipart/form-data'>
                        <input type='hidden' name='status' value='Đang giao hàng'>
                    <div class='form-group text-left'>
                        <input type='submit' name='edit_status' class='btn btn-danger' value='{$row['status']}' onclick="return confirm('Bạn có muốn làm mới trạng thái đơn hàng?')">
                    </div>
                </form></td>
                <td>$date</td>
                DELIMETER;
                $admin_order = <<<DELIMETER
            
         <tbody class="table-body">
            <tr class="cell-1">
               <td>$id
                </td>
                <td>{$row['product_name']}</td>
                <td>$amount</td>
                <td>{$row['quantity']}</td>
                <td>$price VND</td>
                  <td><span class="badge badge-success"></span>$address</td>
                  $admin_status
                  <td>
                  <a class='text-right btn btn-danger' href='..\..\kresources\ktemplates\backend\delete_ad_order.php?id={$row['id']}'
                  onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng không?')">hủy đơn </a>
                  </td>
               </tr>
               </tbody>
         DELIMETER;
                echo $admin_order;
                $page = 8;
                $_SESSION["page"] = $page;

            }
        }
    } else {
        echo "<br><h4 class='text-center' colspan='4'><strong>Không có đơn hàng</strong></h4>";
    }
}
//HIỂN THỊ ĐƠN ĐANG GIAO
function display_list_ship()
{
    $query = query("SELECT * FROM buy ORDER BY 
    CASE
            WHEN status = 'Đang xử lý' THEN 1
            WHEN status = 'Đã xác nhận' THEN 2
            WHEN status = 'Đang giao hàng' THEN 3
            ELSE 4
    END,id DESC");
    confirm($query);

    if (mysqli_num_rows($query) > 0) {


        while ($row = fetch_array($query)) {
            $price = number_format($row['price']);
            $id = $row['id'];
            $address = nl2br($row['buyad']);
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $date = date('H:i:s d/m/Y', strtotime($row['add_date']));
            $status = $row['status'];
            $amount = number_format($row['amount']);
            if ($status == 'Đang giao hàng') {
                $admin_status = <<<DELIMETER
                <td><form id='form{$row['id']}' action='index.php?update_status&order_id={$row['id']}' method='post' enctype='multipart/form-data'>
                        <input type='hidden' name='status' value='Đã hoàn thành'>
                    <div class='form-group text-left'>
                        <input type='submit' name='edit_status' class='btn btn-success'  value='{$row['status']}' onclick="return confirm('Bạn có muốn làm mới trạng thái đơn hàng?')">
                    </div>
                </form></td>
                <td>$date</td>
                DELIMETER;

                $admin_order = <<<DELIMETER
            
         <tbody class="table-body">
            <tr class="cell-1">
               <td>$id
                </td>
                <td>{$row['product_name']}</td>
                <td>$amount</td>
                <td>{$row['quantity']}</td>
                <td>$price VND</td>
                  <td><span class="badge badge-success"></span>$address</td>
                  $admin_status
                  <td>
                  <a class='text-right btn btn-danger' href='..\..\kresources\ktemplates\backend\delete_ad_order.php?id={$row['id']}'
                  onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng không?')">hủy đơn </a>
                  </td>
               </tr>
               </tbody>
         DELIMETER;
                echo $admin_order;
                $page = 9;
                $_SESSION["page"] = $page;

            }
        }
    } else {
        echo "<br><h4 class='text-center' colspan='4'><strong>Không có đơn hàng</strong></h4>";
    }
}
//HIỂN THỊ ĐƠN ĐÃ HOÀN THÀNH
function display_list_delive()
{
    $query = query("SELECT * FROM buy ORDER BY 
    CASE
            WHEN status = 'Đang xử lý' THEN 1
            WHEN status = 'Đã xác nhận' THEN 2
            WHEN status = 'Đang giao hàng' THEN 3
            ELSE 4
    END,id DESC");
    confirm($query);

    if (mysqli_num_rows($query) > 0) {


        while ($row = fetch_array($query)) {
            $price = number_format($row['price']);
            $id = $row['id'];
            $address = nl2br($row['buyad']);
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $get_date = date('H:i:s d/m/Y', strtotime($row['receive_date']));
            $status = $row['status'];
            $amount = number_format($row['amount']);
            if ($status == 'Đã hoàn thành') {
                $admin_status = <<<DELIMETER
                <td><div class='btn btn-primary'>{$row['status']}</div></td>
                <td>$get_date</td>
                DELIMETER;
                $admin_order = <<<DELIMETER
            
         <tbody class="table-body">
            <tr class="cell-1">
               <td>$id
                </td>
                <td>{$row['product_name']}</td>
                <td>$amount</td>
                <td>{$row['quantity']}</td>
                <td>$price VND</td>
                <td><span class="badge badge-success"></span>$address</td>
                $admin_status
                <td>
                <a class='text-right btn btn-danger' href='..\..\kresources\ktemplates\backend\delete_ad_order.php?id={$row['id']}'
                onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng không?')">hủy đơn </a>
                </td>
            </tr>
         </tbody>
         DELIMETER;
                echo $admin_order;
                $page = 10;
                $_SESSION["page"] = $page;

            }
        }
    } else {
        echo "<br><h4 class='text-center' colspan='4'><strong>Không có đơn hàng</strong></h4>";
    }
}
/***************************************************************************************** */
//cập nhật trạng thái đơn hàng theo id
function update_status()
{
    if (isset($_POST['update_status']) && isset($_POST['buy_code'])) {
        $status = $_POST['status'];
        $code = $_POST['buy_code'];

        // Truy vấn dữ liệu từ cơ sở dữ liệu để lấy thông tin về đơn hàng
        $query_order_info = query("SELECT  user_name, product_name, price, quantity, amount, status, photo, buyad,add_date FROM buy WHERE buy_code = '{$code}'");
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

        if ($status == 'Đã hoàn thành') {
            $query = query("UPDATE buy SET status = '{$status}', add_date ='{$date}', receive_date = CURRENT_TIMESTAMP WHERE buy_code = '{$code}'");
            $query_orders = query("INSERT INTO orders (order_code,order_name, order_quantity, order_amount, order_status, order_currency) 
            VALUES ('{$code}','{$product_name}', '{$quantity}', '{$amount}', '{$status}', 'VND')");
            $query_date = query("UPDATE orders SET get_date = CURRENT_TIMESTAMP WHERE order_id = '{$product_name}'");
            confirm($query_orders);
        } else {
            $query = query("UPDATE buy SET status = '{$status}' WHERE buy_code = '{$code}'");
        }
        confirm($query);
        set_message("Cập nhật trạng thái thành công");
        redirect("../admin/index.php?admin_order");
    }

}
//Cập nhật trạng thái đơn hàng
//hiện doanh thu
function display_revenue()
{
    $query = query("SELECT * FROM orders");
    confirm($query);

    $revenue = array(); // Mảng để lưu trữ thông tin của các đơn hàng
    echo "<table class='table table-hover'>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã đơn hàng</th>
                    <th>Tên</th>
                    <th>Số lượng</th>
                    <th>Số tiền</th>
                    <th>Đơn vị</th>
                    <th>Trạng thái</th>
                    <th>Ngày cập nhật </th>
                    <th></th>
                </tr>
            </thead>
            <tbody>";

    while ($row = fetch_array($query)) {
        $order_id = $row['order_id'];
        $order_code = $row['order_code'];
        $order_name = $row['order_name'];
        $order_quantity = $row['order_quantity'];
        $order_amount = $row['order_amount'];
        $order_status = $row['order_status'];
        $order_currency = $row['order_currency'];
        $get_date = date('H:i:s d/m/Y', strtotime($row['get_date']));

        if (array_key_exists($order_name, $revenue)) {
            $revenue[$order_name]['order_quantity'] += $order_quantity;
            $revenue[$order_name]['order_amount'] += $order_amount;
        } else {
            $revenue[$order_name] = array(
                'order_id' => $order_id,
                'order_quantity' => $order_quantity,
                'order_amount' => $order_amount,
                'order_status' => $order_status,
                'order_currency' => $order_currency,
            );
        }

        echo "<tr class='cell-1'>
         <td>{$order_id}</td>
         <td>{$order_code}</td>
        <td>{$order_name}</td>
        <td>{$order_quantity}</td>
        <td>{$order_amount}</td>
        <td>{$order_currency}</td>
        <td>{$order_status}</td>
        <td>{$get_date}</td>
        <td><a class='btn btn-danger' href='..\..\kresources\ktemplates\backend\delete_revenue.php?order_id={$order_id}' 
        onclick=\"return confirm('Bạn có chắc chắn muốn xóa không?')\"><span class='glyphicon glyphicon-remove'></span></a></td>
    </tr>";
    }

    foreach ($revenue as $name => $data) {
        $order_id = $data['order_id'];
        $order_quantity = $data['order_quantity'];
        $order_amount = number_format($data['order_amount']);
        $order_status = $data['order_status'];
        $order_currency = $data['order_currency'];

    }

    echo "</tbody></table>";
}

function display_custom_day()
{
    if (isset($_POST['cus_revenue'])) {
        $start_revenue = $_POST['start_revenue'];
        $end_revenue = $_POST['end_revenue'];
        $query = query("SELECT * FROM orders");
        confirm($query);

        $revenue = array(); // Mảng để lưu trữ thông tin của các đơn hàng
        echo "<table class='table table-hover'>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã đơn hàng</th>
                    <th>Tên</th>
                    <th>Số lượng</th>
                    <th>Số tiền</th>
                    <th>Đơn vị</th>
                    <th>Trạng thái</th>
                    <th>Ngày cập nhật </th>
                    <th></th>
                </tr>
            </thead>
            <tbody>";

        while ($row = fetch_array($query)) {
            $order_id = $row['order_id'];
            $order_code = $row['order_code'];
            $order_name = $row['order_name'];
            $order_quantity = $row['order_quantity'];
            $order_amount = $row['order_amount'];
            $order_status = $row['order_status'];
            $order_currency = $row['order_currency'];
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $get_date = date('H:i:s d/m/Y', strtotime($row['get_date']));
            $date = date('Y-m-d', strtotime($row['get_date']));
            if ($date <= $end_revenue && $date >= $start_revenue) {
                if (array_key_exists($order_name, $revenue)) {
                    $revenue[$order_name]['order_quantity'] += $order_quantity;
                    $revenue[$order_name]['order_amount'] += $order_amount;
                } else {
                    $revenue[$order_name] = array(
                        'order_id' => $order_id,
                        'order_quantity' => $order_quantity,
                        'order_amount' => $order_amount,
                        'order_status' => $order_status,
                        'order_currency' => $order_currency,
                    );
                }

                echo "<tr class='cell-1'>
         <td>{$order_id}</td>
         <td>{$order_code}</td>
        <td>{$order_name}</td>
        <td>{$order_quantity}</td>
        <td>{$order_amount}</td>
        <td>{$order_currency}</td>
        <td>{$order_status}</td>
        <td>{$get_date}</td>
        <td><a class='btn btn-danger' href='..\..\kresources\ktemplates\backend\delete_revenue.php?order_id={$order_id}' 
        onclick=\"return confirm('Bạn có chắc chắn muốn xóa không?')\"><span class='glyphicon glyphicon-remove'></span></a></td>
    </tr>";
            }

        }
        foreach ($revenue as $name => $data) {
            $order_id = $data['order_id'];
            $order_quantity = $data['order_quantity'];
            $order_amount = number_format($data['order_amount']);
            $order_status = $data['order_status'];
            $order_currency = $data['order_currency'];

        }

        echo "</tbody></table>";
    }
}

function display_day()
{
    $query = query("SELECT * FROM orders");
    confirm($query);

    $revenue = array(); // Mảng để lưu trữ thông tin của các đơn hàng
    echo "<table class='table table-hover'>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã đơn hàng</th>
                    <th>Tên</th>
                    <th>Số lượng</th>
                    <th>Số tiền</th>
                    <th>Đơn vị</th>
                    <th>Trạng thái</th>
                    <th>Ngày cập nhật </th>
                    <th></th>
                </tr>
            </thead>
            <tbody>";

    while ($row = fetch_array($query)) {
        $order_id = $row['order_id'];
        $order_code = $row['order_code'];
        $order_name = $row['order_name'];
        $order_quantity = $row['order_quantity'];
        $order_amount = $row['order_amount'];
        $order_status = $row['order_status'];
        $order_currency = $row['order_currency'];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $get_date = date('H:i:s d/m/Y', strtotime($row['get_date']));
        $date = date('d/m/Y', strtotime($row['get_date']));
        $newDate = date('d/m/Y');
        if ($date == $newDate) {
            if (array_key_exists($order_name, $revenue)) {
                $revenue[$order_name]['order_quantity'] += $order_quantity;
                $revenue[$order_name]['order_amount'] += $order_amount;
            } else {
                $revenue[$order_name] = array(
                    'order_id' => $order_id,
                    'order_quantity' => $order_quantity,
                    'order_amount' => $order_amount,
                    'order_status' => $order_status,
                    'order_currency' => $order_currency,
                );
            }

            echo "<tr class='cell-1'>
         <td>{$order_id}</td>
         <td>{$order_code}</td>
        <td>{$order_name}</td>
        <td>{$order_quantity}</td>
        <td>{$order_amount}</td>
        <td>{$order_currency}</td>
        <td>{$order_status}</td>
        <td>{$get_date}</td>
        <td><a class='btn btn-danger' href='..\..\kresources\ktemplates\backend\delete_revenue.php?order_id={$order_id}' 
        onclick=\"return confirm('Bạn có chắc chắn muốn xóa không?')\"><span class='glyphicon glyphicon-remove'></span></a></td>
    </tr>";
        }

    }
    foreach ($revenue as $name => $data) {
        $order_id = $data['order_id'];
        $order_quantity = $data['order_quantity'];
        $order_amount = number_format($data['order_amount']);
        $order_status = $data['order_status'];
        $order_currency = $data['order_currency'];

    }

    echo "</tbody></table>";
}
function display_month()
{
    $query = query("SELECT * FROM orders");
    confirm($query);

    $revenue = array(); // Mảng để lưu trữ thông tin của các đơn hàng
    echo "<table class='table table-hover'>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã đơn hàng</th>
                    <th>Tên</th>
                    <th>Số lượng</th>
                    <th>Số tiền</th>
                    <th>Đơn vị</th>
                    <th>Trạng thái</th>
                    <th>Ngày cập nhật </th>
                    <th></th>
                </tr>
            </thead>
            <tbody>";

    while ($row = fetch_array($query)) {
        $order_id = $row['order_id'];
        $order_code = $row['order_code'];
        $order_name = $row['order_name'];
        $order_quantity = $row['order_quantity'];
        $order_amount = $row['order_amount'];
        $order_status = $row['order_status'];
        $order_currency = $row['order_currency'];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $get_date = date('H:i:s d/m/Y', strtotime($row['get_date']));
        $date = date('m/Y', strtotime($row['get_date']));
        $newDate = date('m/Y');
        if ($date == $newDate) {

            if (array_key_exists($order_name, $revenue)) {
                $revenue[$order_name]['order_quantity'] += $order_quantity;
                $revenue[$order_name]['order_amount'] += $order_amount;
            } else {
                $revenue[$order_name] = array(
                    'order_id' => $order_id,
                    'order_quantity' => $order_quantity,
                    'order_amount' => $order_amount,
                    'order_status' => $order_status,
                    'order_currency' => $order_currency,
                );
            }

            echo "<tr class='cell-1'>
         <td>{$order_id}</td>
         <td>{$order_code}</td>
        <td>{$order_name}</td>
        <td>{$order_quantity}</td>
        <td>{$order_amount}</td>
        <td>{$order_currency}</td>
        <td>{$order_status}</td>
        <td>{$get_date}</td>
        <td><a class='btn btn-danger' href='..\..\kresources\ktemplates\backend\delete_revenue.php?order_id={$order_id}' 
        onclick=\"return confirm('Bạn có chắc chắn muốn xóa không?')\"><span class='glyphicon glyphicon-remove'></span></a></td>
        </tr>";
        }
    }
    foreach ($revenue as $name => $data) {
        $order_id = $data['order_id'];
        $order_quantity = $data['order_quantity'];
        $order_amount = number_format($data['order_amount']);
        $order_status = $data['order_status'];
        $order_currency = $data['order_currency'];

    }

    echo "</tbody></table>";
}
function display_year()
{
    $query = query("SELECT * FROM orders");
    confirm($query);

    $revenue = array(); // Mảng để lưu trữ thông tin của các đơn hàng
    echo "<table class='table table-hover'>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã đơn hàng</th>
                    <th>Tên</th>
                    <th>Số lượng</th>
                    <th>Số tiền</th>
                    <th>Đơn vị</th>
                    <th>Trạng thái</th>
                    <th>Ngày cập nhật </th>
                    <th></th>
                </tr>
            </thead>
            <tbody>";

    while ($row = fetch_array($query)) {
        $order_id = $row['order_id'];
        $order_code = $row['order_code'];
        $order_name = $row['order_name'];
        $order_quantity = $row['order_quantity'];
        $order_amount = $row['order_amount'];
        $order_status = $row['order_status'];
        $order_currency = $row['order_currency'];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $get_date = date('H:i:s d/m/Y', strtotime($row['get_date']));
        $date = date('Y', strtotime($row['get_date']));
        $newDate = date('Y');
        if ($date == $newDate) {

            if (array_key_exists($order_name, $revenue)) {
                $revenue[$order_name]['order_quantity'] += $order_quantity;
                $revenue[$order_name]['order_amount'] += $order_amount;
            } else {
                $revenue[$order_name] = array(
                    'order_id' => $order_id,
                    'order_quantity' => $order_quantity,
                    'order_amount' => $order_amount,
                    'order_status' => $order_status,
                    'order_currency' => $order_currency,
                );
            }

            echo "<tr class='cell-1'>
         <td>{$order_id}</td>
         <td>{$order_code}</td>
        <td>{$order_name}</td>
        <td>{$order_quantity}</td>
        <td>{$order_amount}</td>
        <td>{$order_currency}</td>
        <td>{$order_status}</td>
        <td>{$get_date}</td>
        <td><a class='btn btn-danger' href='..\..\kresources\ktemplates\backend\delete_revenue.php?order_id={$order_id}' 
        onclick=\"return confirm('Bạn có chắc chắn muốn xóa không?')\"><span class='glyphicon glyphicon-remove'></span></a></td>
    </tr>";
        }
    }
    foreach ($revenue as $name => $data) {
        $order_id = $data['order_id'];
        $order_quantity = $data['order_quantity'];
        $order_amount = number_format($data['order_amount']);
        $order_status = $data['order_status'];
        $order_currency = $data['order_currency'];

    }

    echo "</tbody></table>";
}

function adct__revenue()
{
    $query = query("SELECT * FROM orders ORDER BY order_id DESC LIMIT 5");
    confirm($query);

    $revenue = array(); // Mảng để lưu trữ thông tin của các đơn hàng
    echo "<table class='table table-hover'>
            <thead>
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Tên</th>
                    <th>Số lượng</th>
                    <th>Số tiền</th>
                    <th>Đơn vị</th>
                    <th>Trạng thái</th>
                    <th>Ngày cập nhật </th>
                </tr>
            </thead>
            <tbody>";

    while ($row = fetch_array($query)) {
        $order_code = $row['order_code'];
        $order_name = $row['order_name'];
        $order_quantity = $row['order_quantity'];
        $order_amount = $row['order_amount'];
        $order_status = $row['order_status'];
        $order_currency = $row['order_currency'];
        $get_date = date('H:i:s d/m/Y', strtotime($row['get_date']));

        if (array_key_exists($order_name, $revenue)) {
            $revenue[$order_name]['order_quantity'] += $order_quantity;
            $revenue[$order_name]['order_amount'] += $order_amount;
        } else {
            $revenue[$order_name] = array(
                'order_quantity' => $order_quantity,
                'order_amount' => $order_amount,
                'order_status' => $order_status,
                'order_currency' => $order_currency,
            );
        }

        echo "<tr>
         <td>{$order_code}</td>
        <td>{$order_name}</td>
        <td>{$order_quantity}</td>
        <td>{$order_amount}</td>
        <td>{$order_currency}</td>
        <td>{$order_status}</td>
        <td>{$get_date}</td>
        <td><a class='btn btn-danger' href='..\..\kresources\ktemplates\backend\delete_revenue.php?name={$order_name}' 
        onclick=\"return confirm('Bạn có chắc chắn muốn xóa không?')\"><span class='glyphicon glyphicon-remove'></span></a></td>
    </tr>";
    }

    foreach ($revenue as $name => $data) {
        $order_quantity = $data['order_quantity'];
        $order_amount = number_format($data['order_amount']);
        $order_status = $data['order_status'];
        $order_currency = $data['order_currency'];

    }

    echo "</tbody></table>";
}
//#########################################
//**********************************************************************USER FUNCTIONS************************************
//#######################################
//Thêm tài khoản từ trang admin
function add_user()
{


    if (isset($_POST['add_user'])) {

        $user_level = escape_string($_POST['user_level']);

        $first_name = escape_string($_POST['first_name']);
        $last_name = escape_string($_POST['last_name']);
        $username = escape_string($_POST['username']);
        $email = escape_string($_POST['email']);
        $password = escape_string($_POST['password']);
        $user_sex = escape_string($_POST['sex']);
        $birthday = escape_string($_POST['birthday']);
        $user_photo = ($_FILES['file']['name']);
        $image_temp_location = ($_FILES['file']['tmp_name']);
        $final_destination = UPLOAD_DIRECTORY . DS . $user_photo;
        move_uploaded_file($image_temp_location, $final_destination);
        $query = query("SELECT * FROM users WHERE email = '{$email}' OR username = '{$username}'");
        confirm($query);
        if (mysqli_num_rows($query) > 0) {
            // Nếu dữ liệu đã tồn tại, hiển thị thông báo yêu cầu nhập lại
            $existing_info = [];
            while ($row = fetch_array($query)) {
                if ($row['email'] == $email) {
                    $existing_info[] = 'Địa chỉ email';
                }
                if ($row['username'] == $username) {
                    $existing_info[] = 'Tên tài khoản';
                }
            }
            $error_message = implode(' và ', $existing_info) . " đã tồn tại, vui lòng nhập lại.";
            set_message($error_message);
        } else {
            if (empty($first_name) || empty($last_name) || empty($username) || empty($email) || empty($password) || empty($birthday)) {
                // Nếu có trường bắt buộc để trống, hiển thị thông báo lỗi
                set_message("Vui lòng điền đầy đủ thông tin.");
            } else {
                $query = query("INSERT INTO users(user_level,first_name,last_name,username,email, birthday,password,user_photo,sex) 
                VALUES('{$user_level}','{$first_name}','{$last_name}','{$username}','{$email}','$birthday','{$password}','$user_photo','{$user_sex}') ");
                confirm($query);

                set_message("USER CREATED");

                redirect("index.php?users");
            }
        }
    }

}
// người dùng đăng kí tài khoản mới
function register_user()
{
    if (isset($_POST['register'])) {
        $user_level = 1; // Thêm mặc định cho user_level là 1 nếu không có giá trị được gửi lên
        $first_name = escape_string($_POST['first_name']);
        $last_name = escape_string($_POST['last_name']);
        $username = escape_string($_POST['username']);
        $email = escape_string($_POST['email']);
        $password = escape_string($_POST['password']);
        $user_photo = ($_FILES['file']['name']);
        $user_sex = escape_string($_POST['sex']);
        $birthday = escape_string($_POST['birthday']);
        $image_temp_location = ($_FILES['file']['tmp_name']);
        $final_destination = UPLOAD_DIRECTORY . DS . $user_photo;
        move_uploaded_file($image_temp_location, $final_destination);

        // Kiểm tra dữ liệu có khớp với database hay không
        $query = query("SELECT * FROM users WHERE email = '{$email}' OR username = '{$username}'");
        confirm($query);
        if (mysqli_num_rows($query) > 0) {
            // Nếu dữ liệu đã tồn tại, hiển thị thông báo yêu cầu nhập lại
            $existing_info = [];
            while ($row = fetch_array($query)) {
                if ($row['email'] == $email) {
                    $existing_info[] = 'Địa chỉ email';
                }
                if ($row['username'] == $username) {
                    $existing_info[] = 'Tên tài khoản';
                }
            }
            $error_message = implode(' và ', $existing_info) . " đã tồn tại, vui lòng nhập lại.";
            set_message($error_message);
            redirect("register.php");
        } else {
            // Kiểm tra các trường bắt buộc có giá trị hay không
            if (empty($first_name) || empty($last_name) || empty($username) || empty($email) || empty($password) || empty($birthday)) {
                // Nếu có trường bắt buộc để trống, hiển thị thông báo lỗi
                set_message("Vui lòng điền đầy đủ thông tin.");
            } else {
                $query = query("INSERT INTO users(user_level,first_name,last_name,username,email, birthday,password,user_photo,sex) 
                VALUES('{$user_level}','{$first_name}','{$last_name}','{$username}','{$email}','$birthday','{$password}','$user_photo','{$user_sex}') ");
                confirm($query);
                set_message("TẠO TÀI KHOẢN THÀNH CÔNG");
                redirect("login.php");
            }
        }
    }
}
//the log in to the system
function login_user()
{
    if (isset($_POST['submit'])) {
        $username = escape_string($_POST['username']);
        $password = escape_string($_POST['password']);

        $query = query("SELECT * FROM users WHERE username ='{$username}' AND password='{$password}' ");
        confirm($query);
        if (mysqli_num_rows($query) == 0) {
            set_message("TÀI KHOẢN HOẶC MẬT KHẨU KHÔNG CHÍNH XÁC, VUI LÒNG ĐĂNG NHẬP LẠI!");
            redirect("login.php");
        } else {
            $row = fetch_array($query);
            $user_level = $row['user_level'];
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $row['user_id'];
            if ($user_level == 2) {
                redirect("..\public\index.php");
            } else if ($user_level == 1) {
                redirect("index_user.php");
            }
        }
    }
}
//gửi otp
function send_otp()
{

    if (isset($_POST['forgot'])) {

        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';
        $mail = new PHPMailer(true);
        global $connection;
        $forgot_code = rand(1000, 9999);
        $email = escape_string($_POST['email']);
        $message = $forgot_code;
        $query = query("SELECT * FROM users WHERE email='{$email}' ");
        confirm($query);
        if (mysqli_num_rows($query) == 0) {
            set_message("EMAIL KHÔNG CHÍNH XÁC, VUI LÒNG ĐĂNG NHẬP LẠI!");
            redirect("forgot.php");
        } else {
            try {
                //Server settings
                $mail->SMTPDebug = 0;
                $mail->isSMTP(); // Sử dụng SMTP để gửi mail
                $mail->Host = 'smtp.gmail.com'; // Server SMTP của gmail
                $mail->SMTPAuth = true; // Bật xác thực SMTP
                $mail->Username = '21111064263@hunre.edu.vn'; // Tài khoản email
                $mail->Password = 'nnik jinu bgus qeyz'; // Mật khẩu ứng dụng ở bước 1 hoặc mật khẩu email
                $mail->SMTPSecure = 'ssl'; // Mã hóa SSL
                $mail->Port = 465; // Cổng kết nối SMTP là 465

                //Recipients
                $mail->setFrom('21111064263@hunre.edu.vn', 'ADMIN'); // Địa chỉ email và tên người gửi
                $mail->addAddress($email); // Địa chỉ mail và tên người nhận

                //Content
                $mail->isHTML(true); // Set email format to HTML
                $mail->Subject = 'MA OTP CUA BAN LA:'; // Tiêu đề
                $mail->Body = $message; // Nội dung
                $mail->send();
                echo "<script>window.location='OTP.php';</script>";
            } catch (Exception $e) {
                echo 'Gửi không thành công!Lỗi: ', $mail->ErrorInfo;
            }
        }
        $_SESSION['forgot_code'] = $forgot_code;
        $_SESSION['email'] = $email;
    }
}

// kiểm tra OTP
function otp_check()
{
    if (isset($_POST['submit'])) {
        global $connection;
        $otp = escape_string($_POST['otp']);
        if ($otp != $_SESSION['forgot_code']) {
            set_message("MÃ OTP KHÔNG CHÍNH XÁC , VUI LÒNG NHẬP LẠI!");
        } else {

            redirect("create_pw.php");
        }
    } elseif (isset($_POST['re_otp'])) {
        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';
        $mail = new PHPMailer(true);
        global $connection;
        $forgot_code = rand(1000, 9999);
        $_SESSION['forgot_code'] = $forgot_code;
        $email = $_SESSION['email'];
        $message = $forgot_code;
        try {
            //Server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP(); // Sử dụng SMTP để gửi mail
            $mail->Host = 'smtp.gmail.com'; // Server SMTP của gmail
            $mail->SMTPAuth = true; // Bật xác thực SMTP
            $mail->Username = '21111064263@hunre.edu.vn'; // Tài khoản email
            $mail->Password = 'nnik jinu bgus qeyz'; // Mật khẩu ứng dụng ở bước 1 hoặc mật khẩu email
            $mail->SMTPSecure = 'ssl'; // Mã hóa SSL
            $mail->Port = 465; // Cổng kết nối SMTP là 465

            //Recipients
            $mail->setFrom('21111064263@hunre.edu.vn', 'ADMIN'); // Địa chỉ email và tên người gửi
            $mail->addAddress($email); // Địa chỉ mail và tên người nhận

            //Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = 'Mã OTP lấy lại mật khẩu:'; // Tiêu đề
            $mail->Body = $message; // Nội dung
            $mail->send();
            echo "<h3 class='text-center'>Đã gửi lại mã</h2>";
            redirect('OTP.php');
        } catch (Exception $e) {
            echo 'Gửi không thành công!Lỗi: ', $mail->ErrorInfo;
        }
    }
}
//tạo mật khẩu mới 
function create_pw()
{
    if (isset($_POST['up_pw'])) {
        $email = $_SESSION['email'];
        $password = escape_string($_POST['password']);
        $re_pw = escape_string($_POST['re_pw']);
        if ($password != $re_pw) {
            set_message("MẬT KHẨU  VÀ MẬT KHẨU NHẬP LẠI PHẢI GIỐNG NHAU  , VUI LÒNG NHẬP LẠI!");
        } else {
            if (empty($re_pw) || empty($password)) {
                set_message("Vui lòng điền đầy đủ thông tin.");
            } else {
                $query = "UPDATE users SET 
                        password = '{$password}' 
                        WHERE email='{$email}'";

                $update_query = query($query);
                confirm($update_query);
                echo "<script>alert('Dữ liệu đã được cập nhật thành công!'); window.location='login.php';</script>";
            }
        }
    }
}
//hiển thị người dùng
function display_user()
{
    $username = $_SESSION['username'];
    $query = query("SELECT * FROM users WHERE username = '{$username}' ");
    confirm($query);

    $row = fetch_array($query);
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $email = $row['email'];
    $sex = $row['sex'];
    $birthday = date('d/m/Y', strtotime($row['birthday']));
    $user_photo = $row['user_photo'];
    $user = <<<DELIMETER
                <div class="page-content page-container" id="page-content">
        <div class="padding">
            <div class="row container d-flex justify-content-center">
                <div class="col-md-12">
                    <div class="card user-card-full" style="border-radius:25px;">
                        <div class="row m-l-0 m-r-0">
                            <div class="col-sm-4 bg-c-lite-green user-profile">
                                <div class="card-block text-center text-white" style="margin-left:15px;">
                                    <div class="m-b-25">
                                        <img class="img-radius" src="../../kresources/uploads/{$user_photo}">
                                    </div>
                                    <h6 class="f-w-600"> Tài khoản: $username</h6>
                                    <p>$email</p>
                                    <a href="index_user.php?edit_user&user_id={$row['user_id']}" style="color:white;"><i class="fa fa-edit"></i></a>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="card-block" style="margin-top: 5px;">
                                    <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Thông tin cá nhân</h6>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Tên: </p>
                                            <h6 class="text-muted f-w-400">$first_name</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Họ: </p>
                                            <h6 class="text-muted f-w-400">$last_name</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Giới tính: </p>
                                            <h6 class="text-muted f-w-400">$sex</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Ngày sinh:</p>
                                            <h6 class="text-muted f-w-400">$birthday</h6>
                                        </div>
                                    </div>
                                    <div style="padding:43px;"></div>
                                    <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Thông tin tài khoản</h6>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Tên tài khoản:</p>
                                            <h6 class="text-muted f-w-400">$username</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Email:</p>
                                            <h6 class="text-muted f-w-400">$email</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
 DELIMETER;

    echo $user;
}
//hiển thị các tài khoản đã có trong db
function display_users()
{

    $query = query("SELECT * FROM users ORDER BY user_level DESC");
    confirm($query);


    while ($row = fetch_array($query)) {

        $user_id = $row['user_id'];
        $user_level = $row['user_level'];
        $username = $row['username'];
        $email = $row['email'];
        $password = $row['password'];
        $user_photo = $row['user_photo'];
        if ($user_level == 1) {
            $level = <<<DELIMETER
                    <td>
                        <span class="text-primary">Người dùng</span>
                    </td>
            DELIMETER;
        } else {

            $level = <<<DELIMETER
                    <td>
                        <span class="text-danger">Quản trị viên</span>
                    </td>
            DELIMETER;
        }
        $user = <<<DELIMETER
        <tr>
          <td class="pl-4">$user_id</td>
          <td>
              <h5 class="font-medium mb-0">
              <img src='../../kresources/uploads/{$user_photo}' class="img-user">
              <br />$username</h5>
          </td>
          <td>
              <h5 class="font-medium mb-0">$password</h5>
          </td>
          $level
          <td>
              <span class="text-muted">$email</span>
          </td>
          <td>
            
            <a href="..\..\kresources\ktemplates\backend\delete_user.php?id={$row['user_id']}"
            onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
            <button type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-trash"></i></button></a>
            <button type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle ml-2">
            <a href="index.php?edit_users&user_id={$row['user_id']}"><i class="fa fa-edit"></i></a> </button>
            <a href="index.php?detail_users&detail_id={$row['user_id']}">
            <button type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-user"></i> </button></a>
          </td>
        </tr>
DELIMETER;

        echo $user;
    }
}
//hiển thị người dùng
function detail_user()
{
    if (isset($_GET['detail_id'])) {
        $user_id = $_GET['detail_id'];
        $query = query("SELECT * FROM users WHERE user_id = '{$user_id}' ");
        confirm($query);

        $row = fetch_array($query);
        $username = $row['username'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $email = $row['email'];
        $sex = $row['sex'];
        $birthday = $row['birthday'];
        $user_photo = $row['user_photo'];
        $user = <<<DELIMETER
                <div class="page-content" id="page-content" >
                <div class="" style="border-radius: 25px;">
                    <div class="row container d-flex justify-content-center" >
                        <div class="col-md-12">
                            <div class="card user-card-full">
                                <div class="row m-l-0 m-r-0">
                                    <div class="col-sm-4 bg-c-lite-green user-profile">
                                        <div class="card-block text-center text-white">
                                            <div class="m-b-25">
                                                <img class="img-radius" src="../../kresources/uploads/{$user_photo}">
                                            </div>
                                            <h6 class="f-w-600"> Tài khoản: $username</h6>
                                            <p>$email</p>
                                            <a href="index.php?edit_users&user_id={$row['user_id']}" style="color:white;"><i class="fa fa-edit"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-sm-8" style="border-radius: 25px;">
                                        <div class="card-block">
                                            <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Thông tin cá nhân</h6>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">Tên:</p>
                                                    <h6 class="text-muted f-w-400">$first_name</h6>
                                                </div>
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">Họ:</p>
                                                    <h6 class="text-muted f-w-400">$last_name</h6>
                                                </div>
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">Giới tính:</p>
                                                    <h6 class="text-muted f-w-400">$sex</h6>
                                                </div>
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">Ngày sinh:</p>
                                                    <h6 class="text-muted f-w-400">$birthday</h6>
                                                </div>
                                            </div>
                                            <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Thông tin tài khoản</h6>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">Tên tài khoản:</p>
                                                    <h6 class="text-muted f-w-400">$username</h6>
                                                </div>
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">Email:</p>
                                                    <h6 class="text-muted f-w-400">$email</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
 DELIMETER;

        echo $user;
    }
}
function edit_user()
{
    if (isset($_POST['update_user'])) {
        $user_id = $_SESSION['user_id'];
        $username = $_POST['username'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $birthday = $_POST['birthday'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user_photo = ($_FILES['file']['name']);
        if (empty($sex)) {
            $get_level = query("SELECT sex FROM users WHERE user_id =" . escape_string($_GET['user_id']) . "");
            confirm($get_level);
            $row = fetch_array($get_level);
            $sex = $row['sex'];
        } else {
            $sex = $_POST['sex'];
        }
        $image_temp_location = ($_FILES['file']['tmp_name']);
        $final_destination = UPLOAD_DIRECTORY . DS . $user_photo;
        move_uploaded_file($image_temp_location, $final_destination);
        if (empty($user_photo)) {
            $get_pic = query("SELECT user_photo FROM users WHERE user_id =" . escape_string($_GET['user_id']) . "");
            confirm($get_pic);
            $row = fetch_array($get_pic);
            $user_photo = $row['user_photo'];
        }
        $query = query("SELECT * FROM users WHERE email = '{$email}' OR username = '{$username}'");
        confirm($query);
        if (mysqli_num_rows($query) > 0) {
            while ($row = fetch_array($query)) {
                $query = "UPDATE users SET 
                    username = '{$username}',
                    first_name = '{$first_name}',
                    last_name = '{$last_name}',
                    sex = '{$sex}',
                    birthday= '{$birthday}',
                    email = '{$email}',
                    password = '{$password}',
                    user_photo = '{$user_photo}' 
                    WHERE user_id={$user_id}";

                $send_update_query = query($query);
                confirm($send_update_query);

                echo "<script>alert('Dữ liệu đã được cập nhật thành công!'); window.location='index_user.php';</script>";
            }
        }
    }
}


function edit()
{
    global $connection;
    if (isset($_POST['update_users'])) {
        $birthday = $_POST['birthday'];
        $username = $_POST['username'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        if (empty($_POST['user_level'])) {
            $get_level = query("SELECT user_level FROM users WHERE user_id =" . escape_string($_GET['user_id']) . "");
            confirm($get_level);
            $row = fetch_array($get_level);
            $user_level = $row['user_level'];
        } else {
            $user_level = $_POST['user_level'];
        }
        $user_photo = ($_FILES['file']['name']);
        $image_temp_location = ($_FILES['file']['tmp_name']);
        $final_destination = UPLOAD_DIRECTORY . DS . $user_photo;
        move_uploaded_file($image_temp_location, $final_destination);
        if (empty($user_photo)) {
            $get_pic = query("SELECT user_photo FROM users WHERE user_id =" . escape_string($_GET['user_id']) . "");
            confirm($get_pic);
            $row = fetch_array($get_pic);
            $user_photo = $row['user_photo'];
        }
        if (empty($_POST['sex'])) {
            $get_sex = query("SELECT sex FROM users WHERE user_id =" . escape_string($_GET['user_id']) . "");
            confirm($get_sex);
            $row = fetch_array($get_sex);
            $sex = $row['sex'];
        } else {
            $sex = $_POST['sex'];
        }
        $query = query("SELECT * FROM users WHERE email = '{$email}' OR username = '{$username}'");
        confirm($query);
        if (mysqli_num_rows($query) > 0) {
            $query = "UPDATE users SET 
                    user_level = '{$user_level}',
                    username = '{$username}',
                    first_name = '{$first_name}',
                    last_name = '{$last_name}',
                    sex = '{$sex}',
                    birthday= '{$birthday}',
                    email = '{$email}',
                    password = '{$password}',
                    user_photo = '{$user_photo}'
                    WHERE user_id = " . escape_string($_GET['user_id']) . "";

            $send_update_query = query($query);
            confirm($send_update_query);
            echo "<script>alert('Dữ liệu đã được cập nhật thành công!'); window.location='index.php?users';</script>";
        }
    }
}



//hiện tên người dùng trong trang quả lý
function user_name()
{
    $query = query("SELECT * FROM users WHERE username ='{$_SESSION['username']}' ");
    confirm($query);
    return $_SESSION['username'];
}



//#########################################

//#######################################
//#########################################

//#######################################
//gửi hỗ trợ đến admin
function request_to_admin()
{
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    $mail = new PHPMailer(true);
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        try {
            //Server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP(); // Sử dụng SMTP để gửi mail
            $mail->Host = 'smtp.gmail.com'; // Server SMTP của gmail
            $mail->SMTPAuth = true; // Bật xác thực SMTP
            $mail->Username = '21111064263@hunre.edu.vn'; // Tài khoản email
            $mail->Password = 'nnik jinu bgus qeyz'; // Mật khẩu ứng dụng ở bước 1 hoặc mật khẩu email
            $mail->SMTPSecure = 'ssl'; // Mã hóa SSL
            $mail->Port = 465; // Cổng kết nối SMTP là 465

            //Recipients
            $mail->setFrom($email, $name); // Địa chỉ email và tên người gửi
            $mail->addAddress('21111064263@hunre.edu.vn', 'ADMIN'); // Địa chỉ mail và tên người nhận

            //Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = $subject; // Tiêu đề
            $mail->Body = $message; // Nội dung
            $mail->send();
            set_message("Cảm ơn bạn đã đóng góp,chúng tôi sẽ phản hồi sớm nhất có thể");
            redirect("contact.php");
        } catch (Exception $e) {
            echo 'Gửi không thành công!Lỗi: ', $mail->ErrorInfo;
        }
    }
}


function last_id()
{
    global $connection;
    return mysqli_insert_id($connection);
}

//up ảnh
function display_images($pictures)
{
    global $upload_path;

    return $upload_path . DS . $pictures;
}
/******************ADDRESS Functions *******************/
//hiển thị địa chỉ, thông tin nhận hàng
function display_address()
{
    $username = "";
    $user_id = $_SESSION['user_id']; // Giả sử user_id đã được lưu trữ trong session
    $query_user = query("SELECT username FROM users WHERE user_id = " . escape_string($user_id));
    confirm($query_user);

    while ($row_user = fetch_array($query_user)) {
        $user_name = $row_user['username'];
    }

    if (isset($_SESSION['username']) && $_SESSION['username'] == $user_name) {
        $query_address = query("SELECT * FROM address WHERE username = '{$user_name}'");
        confirm($query_address);
        if (mysqli_num_rows($query_address) > 0) {
            while ($row = fetch_array($query_address)) {
                // Lấy thông tin địa chỉ từ cột
                $fullname = $row['fullname'];
                $phone = $row['phone'];
                $province = $row['province'];
                $district = $row['district'];
                $ward = $row['ward'];
                $address = $row['address'];
                if ($row['id'] == 1) {
                    $popup = <<<DELIMETER
                    <div class="col my-auto  border-line ">
                      <h5><strong><a class='text-primary custom-link' href='index_user.php?edit_address&id={$row['id']}'>Chỉnh sửa</a></strong></h5>
                    </div>
                    <div class="col  my-auto  border-line ">
                      <h5><strong><a class='text-danger custom-link' href='..\..\kresources\ktemplates\backend_user\delete_address.php?id={$row['id']}'
                      onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                      Xóa</a></strong></h5>
                    </div>
                    DELIMETER;
                } else {
                    $popup = <<<DELIMETER
                        <div class="col my-auto"  style="border-radius:25px;">
                          <h5><strong><a class='text-primary custom-link' href='index_user.php?edit_address&id={$row['id']}'>Chỉnh sửa</a></strong></h5>
                        </div>
                        <div class="col  my-auto  ">
                        <h5><strong><a class='text-danger custom-link' href='..\..\kresources\ktemplates\backend_user\delete_address.php?id={$row['id']}'
                        onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                        Xóa</a></strong</h5>
                        </div>
                        <div class="col my-auto">
                          <h5><strong><a class='text-success custom-link' href='..\..\kresources\ktemplates\backend_user\change_location.php?id={$row['id']}'
                          onclick="return confirm('Bạn có chắc chắn muốn đẩy địa chỉ này làm địa chỉ nhận hàng không ?')">
                          Đặt làm địa chỉ mặc định</a></strong></h5>
                        </div>
                  DELIMETER;
                }
                $dis_address = <<<DELIMETER
                <div class="container-fluid my-5 d-sm-flex justify-content-center" style="border-radius:25px; color: linear-gradient(0deg , #fff , 50% , #74a0ff);">
                    <div class="card px-2" style="border-radius: 25px;">
                    <div class="card-header bg-white" style="border-radius: 25px;">
                        <div class="row justify-content-between">
                        <div class="col">
                            <h5 class="text-muted"><span class="font-weight-bold text-dark">Họ và tên: </span>$fullname</h5>
                            <p class="text-muted"><span class="font-weight-bold text-dark"> Số điện thoại(+84):</span> $phone
                            </p>
                        </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="media flex-column flex-sm-row">
                        <div class="media-body ">
                            <h6 class="bold">Tỉnh / Thành phố:<span class="Today"> $province </span></h6>
                            <h6 class="bold">Quận /Huyện: <span class="Today">$district </span></h6>
                            <h6 class="bold">Xã / Phường:<span class="Today"> $ward </span></h6>
                            <p><strong  class="bold">Địa chỉ cụ thể:</strong> <span class="Today">$address</span></p>
                        </div>
                        </div>
                        <div class="card-footer  bg-white px-sm-3 pt-sm-4 px-0">
                        <div class="row text-center  ">
                            $popup
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            DELIMETER;
                echo $dis_address;
            }
        } else {
            echo "<h2 class='text-center'>Chưa thêm thông tin đơn hàng</h2>";
        }
    }
}



// hiện địa chỉ trong trang đặt hàng
function buy_address()
{
    $user_id = $_SESSION['user_id']; // Giả sử user_id đã được lưu trữ trong session
    $query_user = query("SELECT username FROM users WHERE user_id = " . escape_string($user_id));
    confirm($query_user);

    while ($row_user = fetch_array($query_user)) {
        $user_name = $row_user['username'];
    }

    if (isset($_SESSION['username']) && $_SESSION['username'] == $user_name) {
        $query_address = query("SELECT * FROM address WHERE username = '{$user_name}'");
        confirm($query_address);
        if ($row = fetch_array($query_address)) {
            $fullname = $row['fullname'];
            $phone = $row['phone'];
            $province = $row['province'];
            $district = $row['district'];
            $ward = $row['ward'];
            $address = $row['address'];

            $fulladdress = <<<DELIMETER
            <ul>
                    <li>
                      <p class="mb-0" style="margin-left:0px;"><strong>Họ và tên :</strong> {$fullname}</p>
                    </li>
                    <li>
                      <p class="mb-0" style="margin-left:0px;"><strong>SDT:</strong> {$phone}</p>
                    </li>
                    <li>
                      <p class="mb-0" style="margin-left:0px;"><strong>Địa chỉ:</strong> {$address}, {$ward}, {$district}, {$province}</p>
                    </li>
            </ul>
            <br>
            DELIMETER;

            echo $fulladdress;
            $fulladdress = "<ul><li>" . $fullname . "</li><li>" . $phone .
                "</li><li>" . $province . ";" . $district . ";" . $ward . ";" . $address . "</li></ul>";
            $_SESSION['fulladdress'] = $fulladdress;
        }
    } else {
        $addAddressLink = <<<DELIMETER

        <tr>
            <td><a href="user/index_user.php?add_address">Thêm địa chỉ</td>
        </tr>

        DELIMETER;

        echo $addAddressLink;
    }
}

//thêm địa chỉ
function add_address()
{
    if (isset($_POST['add_address'])) {
        // Lấy tên người dùng từ bảng users

        $user_name = "";
        $user_id = $_SESSION['user_id'];
        $query_user = query("SELECT username FROM users WHERE user_id = " . escape_string($user_id));
        confirm($query_user);
        while ($row_user = fetch_array($query_user)) {
            $user_name = $row_user['username'];
        }
        $fullname = escape_string($_POST['fullname']);
        $phone = escape_string($_POST['phone']);
        $province = escape_string($_POST['province']);
        $district = escape_string($_POST['district']);
        $ward = escape_string($_POST['ward']);
        $address = escape_string($_POST['address']);

        if (empty($fullname) || empty($phone) || empty($province) || empty($district) || empty($ward) || empty($address)) {
            echo "<h2 class='text-center bg-danger'>Các trường không được để trống</h2>";
        } else {
            // Thực hiện INSERT vào bảng address
            $query = query("INSERT INTO address(username, fullname, phone, province, district, ward, address) 
                            VALUES('{$user_name}', '{$fullname}', '{$phone}', '{$province}', '{$district}', '{$ward}', '{$address}')");
            confirm($query);
            echo "<script>alert('Dữ liệu đã được tạo thành công!'); window.location='index_user.php?address';</script>";

        }
    }
}

function update_address()
{
    if (isset($_POST['update_address'])) {
        $fullname = escape_string($_POST['fullname']);
        $phone = escape_string($_POST['phone']);
        $province = escape_string($_POST['province']);
        $district = escape_string($_POST['district']);
        $ward = escape_string($_POST['ward']);
        $address = escape_string($_POST['address']);
        $query = "UPDATE address SET 
                        fullname = '{$fullname}',
                        phone = '{$phone}',
                        province = '{$province}',
                        district = '{$district}',
                        ward = '{$ward}',
                        address = '{$address}'
                        WHERE id = " . escape_string($_GET['id']) . "";

        $send_update_query = query($query);
        confirm($send_update_query);
        echo "<script>alert('Dữ liệu đã được cập nhật thành công!'); window.location='index_user.php?address';</script>";
    }
}

/******************COMMENT Functions *******************/
//comment
function display_comment()
{
    $query = query("SELECT DISTINCT product_name FROM reports");
    confirm($query);
    while ($row = fetch_array($query)) {
        $product_name = $row['product_name'];
        $query2 = query("SELECT COUNT(report_id) as total FROM reports WHERE product_name = '{$product_name}'");
        confirm($query2);
        // Tính tổng số báo cáo cho sản phẩm
        $count = fetch_array($query2)['total'];
        $products = <<<DELIMETER
        <tr>
        <td><a href="index.php?display_comment&product_name={$product_name}">{$product_name}</td>
        <td>{$count}</td>
        </tr>
        DELIMETER;

        echo $products;
    }
}
//hiển thị comment theo product
function display_comment_product()
{
    if (isset($_GET['product_name'])) {
        $product_name = escape_string($_GET['product_name']);
        $query = query("SELECT * FROM reports WHERE product_name = '{$product_name}' ORDER BY 
        CASE
            WHEN star = '41' OR star = '5' THEN 1
            WHEN star = '31' THEN 2
            WHEN star = '21' THEN 3
            WHEN star = '11' THEN 4
            ELSE 5
        END");
        confirm($query);
        echo "<h2> " . $product_name . "</h2>";

        echo '<table class="table">';
        echo '<thead>';
        echo '<tr>';
        echo '<th scope="col">Tài khoản</th>';
        echo '<th scope="col">Đánh giá</th>';
        echo '<th scope="col">Thang đánh giá</th>';
        echo '<th scope="col">Ảnh phản hồi(nếu có) </th>';
        echo '<th scope="col">Xóa</th>';
        echo '</tr>';
        echo '</thead>';

        echo '<tbody>';
        while ($row = fetch_array($query)) {

            if ($row['star'] == 31) {
                $row['star'] = 4;
            } elseif ($row['star'] == 1) {
                $row['star'] = 3;
            } elseif ($row['star'] == 11) {
                $row['star'] = 2;
            } elseif ($row['star'] == 01) {
                $row['star'] = 1;
            } else {
                $row['star'] = 5;
            }
            echo '<tr>';
            echo '<td>' . $row['user_name'] . '</td>';
            echo '<td>' . $row['comment'] . '</td>';
            echo '<td>';
            for ($i = 0; $i < $row['star']; $i++) {
                echo '<i class="fas fa-star text-warning"></i>';
            }
            for ($i = 0; $i < 5 - $row['star']; $i++) {
                echo '<i class="far fa-star"></i>';
            }
            echo '</td>';

            if (!empty($row['report_file'])) {
                echo '<td>';
                echo "<img width='100' src='/Shopping_Web_CNPM/kresources/uploads/{$row['report_file']}'>";
                echo '</td>';
            } else {
                echo '<td>Không có ảnh</td>';
            }
            $delete = <<<DELIMETER
            <td><a class='btn btn-danger' href='..\..\kresources\ktemplates\backend\delete_comment.php?report_id={$row['report_id']}'">
            <span class='glyphicon glyphicon-remove'></span></a></td>
          DELIMETER;
            echo $delete;
            echo '</tr>';
        }
        echo '</tbody>';

        echo '</table>';
    }
}
//thêm đánh giá đơn hàng
function add_report()
{
    global $connection;
    if (isset($_POST["report_product"])) {
        $page = $_SESSION["page"];
        $user_name = $_SESSION["username"];
        $product_name = $_GET["product_name"];
        $code = $_GET['buy_code'];
        $star = $_POST["star"];
        $comment = $_POST["comment"];
        $report_file = ($_FILES['file']['name']);
        $image_temp_location = ($_FILES['file']['tmp_name']);
        $final_destination = UPLOAD_DIRECTORY . DS . $report_file;
        move_uploaded_file($image_temp_location, $final_destination);
        $query = "INSERT INTO reports(report_code, user_name,product_name, report_file, star, comment)
        VALUES ('$code', '$user_name', '$product_name', '$report_file', '$star', '$comment')";
        confirm($query);
        $result = mysqli_query($connection, $query);
        if (!$result) {
            die('Query FAILED' . mysqli_error($connection));
        } else {
            $_SESSION['report_code'] = $code;
            if ($page == 1) {
                redirect('index_user.php?order');
            } else {
                redirect('index_user.php?delive');
            }
        }
    }
}

function display_report()
{
    global $connection;
    $query = query("SELECT product_title FROM products WHERE product_id = '{$_GET['id']}'");
    confirm($query);
    $row = fetch_array($query);
    $product_title = $row["product_title"];
    $c = 0;
    $query2 = query("SELECT user_name,product_name, report_file, star, comment,date FROM reports WHERE product_name='{$product_title}'ORDER BY 
    CASE
        WHEN star = '41' OR star = '5' THEN 1
        WHEN star = '31' THEN 2
        WHEN star = '21' THEN 3
        WHEN star = '11' THEN 4
        ELSE 5
    END");
    confirm($query2);
    while ($row2 = fetch_array($query2)) {
        if (!empty($row2['star'])) {
            $c++;
            if ($row2['star'] == 31) {
                $row2['star'] = 4;
            } elseif ($row2['star'] == 21) {
                $row2['star'] = 3;
            } elseif ($row2['star'] == 11) {
                $row2['star'] = 2;
            } elseif ($row2['star'] == 01) {
                $row2['star'] = 1;
            } else {
                $row2['star'] = 5;
            }
            echo '<div class="report">';
            if (!empty($row2['user_name'])) {
                echo '<p>Tài khoản: ' . $row2['user_name'] . '</p>';
            }
            for ($i = 0; $i < $row2['star']; $i++) {
                echo '<i class="fas fa-star text-warning"></i>';
            }
            for ($i = 0; $i < 5 - $row2['star']; $i++) {
                echo '<i class="far fa-star"></i>';
            }
            echo '<p >&ensp;' . $row2['date'] . '</p>';
            if (!empty($row2['report_file'])) {
                echo '<p>Đánh giá: ' . $row2['comment'] . '</p>';
            }
            if (!empty($row2['report_file'])) {
                echo "<img width='100' src='../kresources/uploads/{$row2['report_file']}'>";
            }
            echo "<hr style='width:100%;'>";
            echo '</div>';
            $c++;
        }
    }
    if ($c == 0) {
        echo "<div class='col-md-5'><img width='400' src='../kresources/uploads/star.jpg'>
        <br><h4 class='text-center'>Chưa có đánh giá!</h4></div>";
    }
}
function display_5()
{
    global $connection;
    $query = query("SELECT product_title FROM products WHERE product_id = '{$_GET['id']}'");
    confirm($query);
    $row = fetch_array($query);
    $product_title = $row["product_title"];
    $query2 = query("SELECT user_name,product_name, report_file, star, comment,date FROM reports WHERE product_name='{$product_title}'");
    confirm($query2);
    $c = 0;
    while ($row2 = fetch_array($query2)) {
        if (!empty($row2['star']) && ($row2['star'] == 41 || $row2['star'] == 5)) {
            $row2['star'] = 5;
            echo '<div class="report">';
            if (!empty($row2['user_name'])) {
                echo '<p>Tài khoản: ' . $row2['user_name'] . '</p>';
            }
            for ($i = 0; $i < $row2['star']; $i++) {
                echo '<i class="fas fa-star text-warning"></i>';
            }
            for ($i = 0; $i < 5 - $row2['star']; $i++) {
                echo '<i class="far fa-star"></i>';
            }
            echo '<p >&ensp;' . $row2['date'] . '</p>';
            if (!empty($row2['report_file'])) {
                echo '<p>Đánh giá: ' . $row2['comment'] . '</p>';
            }
            if (!empty($row2['report_file'])) {
                echo "<img width='100' src='../kresources/uploads/{$row2['report_file']}'>";
            }
            echo "<hr style='width:100%;'>";
            echo '</div>';
            $c++;
        }
    }
    if ($c == 0) {
        echo "<div class='col-md-5'><img width='400' src='../kresources/uploads/star.jpg'>
        <br><h4 class='text-center'>Chưa có đánh giá!</h4></div>";
    }
}
function display_4()
{
    global $connection;
    $query = query("SELECT product_title FROM products WHERE product_id = '{$_GET['id']}'");
    confirm($query);
    $row = fetch_array($query);
    $product_title = $row["product_title"];
    $query2 = query("SELECT user_name,product_name, report_file, star, comment,date FROM reports WHERE product_name='{$product_title}'");
    confirm($query2);
    $c = 0;
    while ($row2 = fetch_array($query2)) {
        if (!empty($row2['star']) && $row2['star'] == 31) {
            $row2['star'] = 4;
            echo '<div class="report">';
            if (!empty($row2['user_name'])) {
                echo '<p>Tài khoản: ' . $row2['user_name'] . '</p>';
            }
            for ($i = 0; $i < $row2['star']; $i++) {
                echo '<i class="fas fa-star text-warning"></i>';
            }
            for ($i = 0; $i < 5 - $row2['star']; $i++) {
                echo '<i class="far fa-star"></i>';
            }
            echo '<p >&ensp;' . $row2['date'] . '</p>';
            if (!empty($row2['report_file'])) {
                echo '<p>Đánh giá: ' . $row2['comment'] . '</p>';
            }
            if (!empty($row2['report_file'])) {
                echo "<img width='100' src='../kresources/uploads/{$row2['report_file']}'>";
            }
            echo "<hr style='width:100%;'>";
            echo '</div>';
            $c++;
        }
    }
    if ($c == 0) {
        echo "<div class='col-md-5'><img width='400' src='../kresources/uploads/star.jpg'>
        <br><h4 class='text-center'>Chưa có đánh giá!</h4></div>";
    }
}
function display_3()
{
    global $connection;
    $query = query("SELECT product_title FROM products WHERE product_id = '{$_GET['id']}'");
    confirm($query);
    $row = fetch_array($query);
    $product_title = $row["product_title"];
    $query2 = query("SELECT user_name,product_name, report_file, star, comment,date FROM reports WHERE product_name='{$product_title}'");
    confirm($query2);
    $c = 0;
    while ($row2 = fetch_array($query2)) {
        if (!empty($row2['star']) && $row2['star'] == 21) {
            $row2['star'] = 3;
            echo '<div class="report">';
            if (!empty($row2['user_name'])) {
                echo '<p>Tài khoản: ' . $row2['user_name'] . '</p>';
            }
            for ($i = 0; $i < $row2['star']; $i++) {
                echo '<i class="fas fa-star text-warning"></i>';
            }
            for ($i = 0; $i < 5 - $row2['star']; $i++) {
                echo '<i class="far fa-star"></i>';
            }
            echo '<p >&ensp;' . $row2['date'] . '</p>';
            if (!empty($row2['report_file'])) {
                echo '<p>Đánh giá: ' . $row2['comment'] . '</p>';
            }
            if (!empty($row2['report_file'])) {
                echo "<img width='100' src='../kresources/uploads/{$row2['report_file']}'>";
            }
            echo "<hr style='width:100%;'>";
            echo '</div>';
            $c++;
        }
    }
    if ($c == 0) {
        echo "<div class='col-md-5'><img width='400' src='../kresources/uploads/star.jpg'>
        <br><h4 class='text-center'>Chưa có đánh giá!</h4></div>";
    }
}
function display_2()
{
    global $connection;
    $query = query("SELECT product_title FROM products WHERE product_id = '{$_GET['id']}'");
    confirm($query);
    $row = fetch_array($query);
    $product_title = $row["product_title"];
    $query2 = query("SELECT user_name,product_name, report_file, star, comment,date FROM reports WHERE product_name='{$product_title}'");
    confirm($query2);
    $c = 0;
    while ($row2 = fetch_array($query2)) {
        if (!empty($row2['star']) && $row2['star'] == 11) {
            $row2['star'] = 2;
            echo '<div class="report">';
            if (!empty($row2['user_name'])) {
                echo '<p>Tài khoản: ' . $row2['user_name'] . '</p>';
            }
            for ($i = 0; $i < $row2['star']; $i++) {
                echo '<i class="fas fa-star text-warning"></i>';
            }
            for ($i = 0; $i < 5 - $row2['star']; $i++) {
                echo '<i class="far fa-star"></i>';
            }
            echo '<p >&ensp;' . $row2['date'] . '</p>';
            if (!empty($row2['report_file'])) {
                echo '<p>Đánh giá: ' . $row2['comment'] . '</p>';
            }
            if (!empty($row2['report_file'])) {
                echo "<img width='100' src='../kresources/uploads/{$row2['report_file']}'>";
            }
            echo "<hr style='width:100%;'>";
            echo '</div>';
            $c++;
        }
    }
    if ($c == 0) {
        echo "<div class='col-md-5'><img width='400' src='../kresources/uploads/star.jpg'>
        <br><h4 class='text-center'>Chưa có đánh giá!</h4></div>";
    }
}
function display_1()
{
    global $connection;
    $query = query("SELECT product_title FROM products WHERE product_id = '{$_GET['id']}'");
    confirm($query);
    $row = fetch_array($query);
    $product_title = $row["product_title"];
    $query2 = query("SELECT user_name,product_name, report_file, star, comment,date FROM reports WHERE product_name='{$product_title}'");
    confirm($query2);
    $c = 0;
    while ($row2 = fetch_array($query2)) {
        if (!empty($row2['star']) && $row2['star'] == 01) {
            $row2['star'] = 1;
            echo '<div class="report">';
            if (!empty($row2['user_name'])) {
                echo '<p>Tài khoản: ' . $row2['user_name'] . '</p>';
            }
            for ($i = 0; $i < $row2['star']; $i++) {
                echo '<i class="fas fa-star text-warning"></i>';
            }
            for ($i = 0; $i < 5 - $row2['star']; $i++) {
                echo '<i class="far fa-star"></i>';
            }
            echo '<p >&ensp;' . $row2['date'] . '</p>';
            if (!empty($row2['report_file'])) {
                echo '<p>Đánh giá: ' . $row2['comment'] . '</p>';
            }
            if (!empty($row2['report_file'])) {
                echo "<img width='100' src='../kresources/uploads/{$row2['report_file']}'>";
            }
            echo "<hr style='width:100%;'>";
            echo '</div>';
            $c++;
        }
    }
    if ($c == 0) {
        echo "<div class='col-md-5'><img width='400' src='../kresources/uploads/star.jpg'>
        <br><h4 class='text-center'>Chưa có đánh giá!</h4></div>";
    }
}
function display_order_from_report()
{
    if (isset($_GET['product_name'])) {
        $id = $_GET['product_name'];
        $query = query("SELECT photo FROM buy WHERE product_name = '{$id}'");
        confirm($query);
        $row = fetch_array($query);
        $photo = display_images($row['photo']);
        echo "<table class='table table-hover'>";
        echo "<tr><h4><strong>{$id}</strong></h4><img width='100' src='../../kresources/{$photo}'></tr>";
        echo "</table>";

    }
}
/******************SLIDES Functions *******************/
//thêm slides
function add_slides()
{
    if (isset($_POST['add_slide'])) {
        $slide_title = escape_string($_POST['slide_title']);
        $slide_image = $_FILES['file']['name'];
        $slide_image_loc = $_FILES['file']['tmp_name'];
        if (empty($slide_title) || empty($slide_image)) {
            echo "<p class='bg-danger'>KHÔNG THỂ ĐỂ TRỐNG TRƯỜNG NÀY</p>";
        } else {
            $final_destination = UPLOAD_DIRECTORY . DS . $slide_image;
            move_uploaded_file($slide_image_loc, $final_destination);
            $query = query("INSERT INTO slides(slide_title, slide_image) VALUES('{$slide_title}', '{$slide_image}')");
            confirm($query);
            set_message("Slide đã được thêm");
            redirect("index.php?slides");
        }
    }
}

function get_current_slide_in_admin()
{
    $query = query("SELECT * FROM slides ORDER BY slide_id DESC LIMIT 1");
    confirm($query);

    while ($row = fetch_array($query)) {

        $slide_image = display_images($row['slide_image']);

        $slide_active_admin = <<<DELIMETER
    <img width='800' height='300' class="img-responsive" src="../../kresources/{$slide_image}" alt="">
DELIMETER;
        echo $slide_active_admin;
    }
}
function get_active_slide()
{
    $query = query("SELECT * FROM slides ORDER BY slide_id DESC LIMIT 1");
    confirm($query);
    while ($row = fetch_array($query)) {
        $slide_image = display_images($row['slide_image']);
        $slide_active = <<<DELIMETER
 <div class="item active">
    <img width='800' height='300' class="slide-image" src="../kresources/{$slide_image}" alt="">
</div>
DELIMETER;
        echo $slide_active;
    }

}



function get_slides()
{

    $query = query("SELECT * FROM slides");
    confirm($query);
    while ($row = fetch_array($query)) {
        $slide_image = display_images($row['slide_image']);
        $slides = <<<DELIMETER


<div class="item">
    <img width='800' height='300' class="slide-image"  src="../kresources/{$slide_image}" alt="">
</div>

DELIMETER;
        echo $slides;
    }

}


function get_slide_thumbnails()
{
    $query = query("SELECT * FROM slides ORDER BY slide_id ASC ");
    confirm($query);

    while ($row = fetch_array($query)) {

        $slide_image = display_images($row['slide_image']);

        $slide_thumb_admin = <<<DELIMETER


<div class="col-xs-6 col-md-3 image_container">
    
    <a href="index.php?delete_slide_id={$row['slide_id']}" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
        
         <img width='800' height='300' class="img-responsive slide_image" src="../../kresources/{$slide_image}" alt="">


    </a>

    <div class="caption">

    <p>{$row['slide_title']}</p>

    </div>


</div>
DELIMETER;

        echo $slide_thumb_admin;


    }

}
?>