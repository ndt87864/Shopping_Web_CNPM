<?php require_once('config.php'); ?>

<?php

if (isset($_GET['add'])) {

  $query = query("SELECT * FROM amount WHERE product_id=" . escape_string($_GET['add']) . " ");
  confirm($query);

  while ($row = fetch_array($query)) {
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $current = time();
    $current_time = date('Y-m-d H:i:s', $current);
    $start_date = $row['start_date'];
    $end_date = $row['end_date'];
    $sale_price = number_format($row['sale_price']);
    if ($current_time >= $start_date && $current_time < $end_date && $row['sale_quantity'] > 0) {
      if ($row['sale_quantity'] != $_SESSION['product_' . $_GET['add']]) {

        $_SESSION['product_' . $_GET['add']] += 1;
        redirect("..\public_user\checkout.php");

      } else {

        set_message("Bạn chỉ có thể mua tối đa " . $row['sale_quantity'] . " sản phẩm " . "{$row['product_title']}" . " khuyến mãi");
        redirect("..\public_user\checkout.php");
      }
    } else {
      if ($row['product_quantity'] != $_SESSION['product_' . $_GET['add']]) {

        $_SESSION['product_' . $_GET['add']] += 1;
        redirect("..\public_user\checkout.php");

      } else {

        set_message("Chúng tôi chỉ còn  " . $row['product_quantity'] . " " . "{$row['product_title']}" . " có sẵn");
        redirect("..\public_user\checkout.php");
      }
    }

  }
}

if (isset($_GET['remove'])) {
  if ($_SESSION['product_' . $_GET['remove']] <= 1) {
    set_message("Không thể giảm số lượng khi còn 1 sản phẩm");
    redirect("..\public_user\checkout.php");
    unset($_SESSION['item_total']);
    unset($_SESSION['item_quantity']);
  } else {
    $_SESSION['product_' . $_GET['remove']]--;
    redirect("..\public_user\checkout.php");
  }
}
if (isset($_GET['delete'])) {

  $_SESSION['product_' . $_GET['delete']] = '0';
  unset($_SESSION['item_total']);
  unset($_SESSION['item_quantity']);

  redirect("..\public_user\checkout.php");


}

function cart()
{
  $total = 0;
  $item_quantity = 0;
  $item_name = 1;
  $item_number = 1;
  $amount = 1;
  $quantity = 1;
  $dem = 0;
  echo "<div class='card-body'><input type='checkbox' id='select-all' name='select_all'> Chọn tất cả <br />";
  foreach ($_SESSION as $name => $value) {
    if ($value > 0) {
      if (substr($name, 0, 8) == "product_") {
        $length = strlen($name);
        $id = substr($name, 8, $length);
        $query = query("SELECT * FROM amount WHERE product_id = " . escape_string($id) . " ");
        confirm($query);

        while ($row = fetch_array($query)) {
          $product_id=$row['product_id'];
          $item_quantity += $value;
          $product_photo = show_product_photo($product_id);
          $product_title=show_product_title($product_id);
          date_default_timezone_set('Asia/Ho_Chi_Minh');
          $current = time();
          $current_time = date('Y-m-d H:i:s', $current);
          $start_date = $row['start_date'];
          $end_date = $row['end_date'];
          $sale_price = number_format($row['sale_price']);
          if (($current_time >= $start_date && $current_time < $end_date) && $row['sale_quantity'] > 0) {
            $price = $sale_price;
            $sub = $row['sale_price'] * $value;
          } else {
            $price = number_format($row['product_price']);
            $sub = $row['product_price'] * $value;

          }
          $product = <<<DELIMETER
     
  <input type='checkbox' name='product_select[]' value='{$product_id}'> Chọn sản phẩm 
          <!-- thẻ sản phẩm cần thay thế bởi function php cart() -->
          <div class="row">
            <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
              <!-- Image -->
              <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
              <img width='100' src='../kresources/uploads/{$product_photo}'
                  alt="Blue Jeans Jacket" />
                <a href="#!">
                  <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                </a>
              </div>
              <!-- Image -->
            </div>

            <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
              <!-- Data -->
              <p><strong>{$product_title}</strong></p>
              <p>Color: blue</p>
              <p>Size: M</p>
              <a  class="btn btn-primary btn-sm me-1 mb-2" href='..\kresources\cart.php?delete={$product_id}' 
               onclick=\"return confirm('Bạn có chắc chắn muốn xóa không?')\">
              <i class="fas fa-trash"></i></a>
            </div>
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
              <span>Giá :</span>
              <p class="text-start text-md-center">
                <strong>{$price} VND</strong>
              </p>
            </div>
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
              <div class="d-flex mb-4" style="max-width: 300px">
                <a class='btn btn-success' href='..\kresources\cart.php?add={$product_id}'>
                <span class='glyphicon glyphicon-plus'></span></a>
                <a class="btn btn-warning px-3 me-2" href='..\kresources\cart.php?remove={$product_id}'>
                <span class='glyphicon glyphicon-minus'></span></a> 
                <div class="form-outline">
                  <label class="form-label" for="form1" style="padding-right:10px;">Số lượng:</label>
                  <input id="form1" min="0" name="quantity" rows="10" value="{$value}" type="number" class="form-control"/>
                </div>
                <br>
              </div>
            </div>
          </div>
  
<input type='hidden' name='item_name_{$item_name}' value='{$product_title}'>
<input type='hidden' name='item_number_{$item_number}' value='{$product_id}'>
<input type='hidden' name='amount_{$amount}' value='{$price}'>
<input type='hidden' name='quantity_{$quantity}' value='{$value}'>
 
DELIMETER;
          echo $product;
          $item_name++;
          $item_number++;
          $quantity++;

        }
        $_SESSION['item_total'] = $total += $sub;
        $_SESSION['item_quantity'] = $item_quantity;
        $dem++;
      }

    }
  }
  if ($dem == 0) {
    echo "<h2 class='text-center '>Không có sản phẩm</h2> ";
  }
  echo "</div>
  </div>";

  echo "<script>
  document.addEventListener('DOMContentLoaded', function() {
    var selectAllCheckbox = document.getElementById('select-all');
    var checkboxes = document.getElementsByName('product_select[]');
  
    selectAllCheckbox.checked = true;
  
    for (var i = 0; i < checkboxes.length; i++) {
      checkboxes[i].checked = true;
    }
  
    selectAllCheckbox.addEventListener('change', function() {
      for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = this.checked;
      }
    });
  
    for (var i = 0; i < checkboxes.length; i++) {
      checkboxes[i].addEventListener('change', function() {
        var isAllChecked = true;
        for (var j = 0; j < checkboxes.length; j++) {
          if (!checkboxes[j].checked) {
            isAllChecked = false;
            break;
          }
        }
        selectAllCheckbox.checked = isAllChecked;
      });
    }
  });
  
</script>";
}
function buy()
{
  if (isset($_POST['buy']) && $_SESSION['item_quantity'] > 0) {
    header("Location:buy.php");
    $_SESSION['selected_products'] = array();
    foreach ($_POST['product_select'] as $selected_product) {
      array_push($_SESSION['selected_products'], $selected_product);
    }

    exit;
  }
}
function return_cart()
{
  if (isset($_POST['return_cart'])) {
    header("Location:checkout.php");
    exit;
  }
}
function buy_cart()
{
  if (isset($_SESSION['selected_products']) && count($_SESSION['selected_products']) > 0) {
    $item_quantity = 0;
    foreach ($_SESSION['selected_products'] as $selected_product) {
      $query = query("SELECT * FROM amount WHERE product_id = " . escape_string($selected_product));
      confirm($query);
      while ($row = fetch_array($query)) {
        $product_id=$row['product_id'];
        $product_photo = show_product_photo($product_id);
        $product_title=show_product_title($product_id);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $current = time();
        $current_time = date('Y-m-d H:i:s', $current);
        $start_date = $row['start_date'];
        $end_date = $row['end_date'];
        if ($current_time >= $start_date && $current_time < $end_date && $row['sale_quantity'] > 0) {
          $price = number_format($row['sale_price']);
          $sub = $row['sale_price'] * $_SESSION["product_" . $selected_product];
        } else {
          $price = number_format($row['product_price']);
          $sub = $row['product_price'] * $_SESSION["product_" . $selected_product];
        }
        $s = number_format($sub);
        $item_quantity += $_SESSION["product_" . $selected_product];
        $product = <<<DELIMETER
        <div class="row">
          <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
            <!-- Image -->
            <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
            <img width='100' src = '../kresources/uploads/{$product_photo}'
                alt="F5 đi anh em êi" />
              <a href="#!">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
              </a>
            </div>
            <!-- Image -->
          </div>

          <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
            <!-- Data -->
            <p><strong>{$product_title}</strong></p>
            <p>Bán và giao hàng bởi NTR</p>
            <p>Phân loại : Sẵn hàng</p>
          </div>
          <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
            <span>Giá :</span>
            <p class="text-start text-md-center">
              <strong class="text-warning">{$price} VND</strong>
            </p>
          </div>
          <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
            <div class="d-flex mb-4" style="max-width: 300px">
              <div class="form-outline">
                <label class="form-label" for="form1" style="padding-right:10px;">
                Số lượng:  <strong class=" text-danger">{$_SESSION["product_" . $selected_product]}</strong></label>
              </div>
              <div class="form-outline">
                <label class="form-label" for="form1" style="padding-right:10px;">
                Thành tiền :</label><br>
                 <strong class="text-primary">{$s} VND</strong>
              </div>
              <br>
            </div>
          </div>
        </div>
        DELIMETER;
        echo $product;
      }
    }
    echo "</div>
    </div>";
  } else {
    echo "<script type='text/javascript'>";
    echo "var confirmResult = confirm('Không có sản phẩm được chọn trong giỏ hàng! Bạn có muốn đến gian hàng không( OK đến trang mua sắm || Cancel để trở lại giỏ hàng.)');";
    echo "if (confirmResult) {";
    echo "window.location = 'shop.php';";
    echo "} else {";
    echo "window.location = 'checkout.php';";
    echo "}";
    echo "</script>";
  }

}
