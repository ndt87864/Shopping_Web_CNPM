<?php
function total_buy()
{
    $query = query("SELECT COUNT(id) as total FROM buy WHERE status='Đang xử lý'");
    confirm($query);
    while ($row = fetch_array($query)) {
        $total = $row["total"];
        return $total;
    }
}
function total_product()
{
    $query = query("SELECT COUNT(product_id) as total FROM products");
    confirm($query);
    // Xuất dữ liệu của mỗi hàng
    while ($row = fetch_array($query)) {
        $total = $row["total"];
        return $total;
    }
}
function total_id()
{
    $query = query("SELECT COUNT(user_id) as total FROM users");
    confirm($query);
    // Xuất dữ liệu của mỗi hàng
    while ($row = fetch_array($query)) {
        $total = $row["total"];
        return $total;
    }
}
function total_comment()
{
    $query = query("SELECT COUNT(report_id) as total FROM reports");
    confirm($query);
    // Xuất dữ liệu của mỗi hàng
    while ($row = fetch_array($query)) {
        $total = $row["total"];
        return $total;
    }
}
?>


<div class="row">
    <div class="col-lg-12">
        <h1>
            Giao diện chủ
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i>Công cụ
            </li>
        </ol>
        <div class="col-md-3">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-table fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">
                                <?php echo total_buy(); ?>
                            </div>
                            <div>Đơn hàng mới !</div>
                        </div>
                    </div>
                </div>
                <a href="index.php?admin_order">
                    <div class="panel-footer">
                        <span class="pull-left">Xem thêm </span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-list-ol fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">
                                <?php echo total_product(); ?>
                            </div>
                            <div>Sản phẩm!</div>
                        </div>
                    </div>
                </div>
                <a href="index.php?products">
                    <div class="panel-footer">
                        <span class="pull-left">Xem thêm</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user-cog fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">
                                <?php echo total_id(); ?>
                            </div>
                            <div>Tài khoản!</div>
                        </div>
                    </div>
                </div>
                <a href="index.php?users">
                    <div class="panel-footer">
                        <span class="pull-left">Xem thêm</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-blue">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="now-ui-icons ui-2_chat-round fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">
                                <?php echo total_comment(); ?>
                            </div>
                            <div>Đánh giá!</div>
                        </div>
                    </div>
                </div>
                <a href="index.php?comment">
                    <div class="panel-footer">
                        <span class="pull-left">Xem thêm</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-chart">
            <div class="card-header">
                <h4 class="card-title">Biểu đồ đơn hàng dựa theo trạng thái</h4>
            </div>
            <div class="card-body col-12">
                <div id="chart"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-chart">
            <div class="card-header">
                <h4 class="card-title"> Biểu đồ doanh thu dựa theo sản phẩm </h4>
            </div>
            <div class="card-body col-12">
                <div id="tchart"></div>

            </div>
        </div>
    </div>
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i>Đơn mới hoàn thành
            </li>
        </ol>
        <?php adct__revenue(); ?>
        <a href="index.php?revenue">
            <div class="panel-footer">
                <span class="pull-left">Xem thêm</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>
</div>

<!-- /.row -->