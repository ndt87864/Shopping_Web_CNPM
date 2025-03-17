<link href="css/order.css" rel="stylesheet">
<div class="container">

    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <lable>Tìm kiếm sản phẩm</lable>
                <form action="index.php?display_product" method="post" enctype="multipart/form-data">
                    <input type="search" class="form-group" name="search" placeholder="Tìm kiếm sản phẩm"
                        style="border:1px solid black;height:37px;">
                    <button type="submit" name="submit" class="btn btn-primary ">
                        <i class="now-ui-icons ui-1_zoom-bold"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
<table class="table table-hover">
    <?php 
        search_product();
    ?>
</table>

</div>