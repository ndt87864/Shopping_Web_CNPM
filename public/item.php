<?php require_once('..\kresources\config.php'); ?>


<?php if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    include(TEMPLATE_FRONT . DS . 'header_admin.php');
} else {
    include(TEMPLATE_FRONT . DS . 'header.php');
} ?>
<div class="container-fluid">
    </br />
    <br />
    <br />
    <?php include(TEMPLATE_FRONT . DS . 'side_nav.php'); ?>
    <?php
    $query = query("SELECT * FROM products WHERE product_id=" . escape_string($_GET['id']) . " ");
    confirm($query);
    while ($row = fetch_array($query)):

        $product_id = $row['product_id'];
        $product_query = query("SELECT * FROM amount WHERE product_id = '{$product_id}' ");
        confirm($product_query);
        $products_row = fetch_array($product_query); ?>

        <div class="container col-md-9">
            <section class="py-5">
                <div class="container">
                    <div class="row gx-5">
                        <aside class="col-lg-6">
                            <div class="border rounded-4 mb-3 d-flex justify-content-center">
                                <a data-fslightbox="mygalley" class="rounded-4" target="_blank" data-type="image" href="#">
                                    <img class="img-responsive"
                                        src="..\kresources\<?php echo display_images($row['product_image']); ?>" alt="">
                                </a>
                            </div>
                            <div class="d-flex justify-content-center mb-3">

                            </div>
                            <!-- thumbs-wrap.// -->
                            <!-- gallery-wrap .end// -->
                        </aside>
                        <main class="col-lg-6">
                            <div class="ps-lg-3">
                                <h4 class="title text-dark">
                                    <?php echo $row['product_title'] ?>
                                </h4>
                                <div class="d-flex flex-row my-3">
                                    <div class="text-warning">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <span class="ms-1">
                                            4.5
                                        </span>
                                    </div>
                                    <span class="text-muted"><i class="fas fa-shopping-basket fa-sm mx-1"></i>Đã bán
                                        999+</span>
                                    <?php if (!empty($products_row) && $products_row['product_quantity'] > 0) { ?>
                                        <span class="text-success ms-2">Sẵn hàng</span>
                                    <?php } else { ?>

                                        <span class="text-danger ms-2">Đã hết hàng</span>
                                    <?php }
                                    ?>
                                </div>

                                <div class="mb-3">
                                    <span class="h5">
                                        <p style=" text-color: black ;font-weight: bold ;font-size: 35px;">
                                            <?php
                                            date_default_timezone_set('Asia/Ho_Chi_Minh');
                                            $current = time();
                                            $current_time = date('Y-m-d 00:00:00', $current);
                                            $start_date = $products_row['start_date'];
                                            $end_date = $products_row['end_date'];
                                            if ($current_time >= $start_date && $current_time < $end_date && $products_row['sale_quantity'] > 0) {
                                                echo number_format($products_row['sale_price']);
                                            } else {
                                                echo number_format($products_row['product_price']);
                                            } ?> VND
                                        </p>
                                    </span>
                                    <!--<span class="text-muted">/per box</span>-->
                                </div>

                                <p>
                                    <?php echo $row['short_desc'] ?>
                                </p>

                                <div class="row" style="padding-left: 15px;">
                                    <dt class="col-3">Nhà sản xuất :</>
                                    <dd class="col-9">Bandai Namco</dd>

                                    <dt class="col-3">Giao hàng bởi :</dt>
                                    <dd class="col-9"> Chicken Hobby</dd>

                                    <dt class="col-3">Độ tuổi phù hợp</dt>
                                    <dd class="col-9">Trên 10 tuổi</dd>

                                    <dt class="col-3">Người Bán</dt>
                                    <dd class="col-9">NTR</dd>
                                </div>
                                <hr />

                                <div class="row mb-4">
                                    <!-- col.// -->
                                    <div class="col-md-4 col-6 mb-3">
                                        <form action="">
                                            <div class="form-group">
                                                <?php if ($products_row['product_quantity'] <= 0) { ?>
                                                    <span class="text-danger ms-2">Cần cập nhật</span>
                                                <?php } ?>
                                            </div>
                                        </form>

                                    </div>
                                </div>

                            </div>
                        </main>
                    </div>
                </div>
            </section>
            <br />
            <div class="row">

                <div role="tabpanel">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab"
                                data-toggle="tab">Mô tả sản phẩm </a></li>
                        <li role="presentation"><a href="#comment" aria-controls="comment" role="tab" data-toggle="tab">Đánh
                                giá</a></li>
                        <li role="presentation"><a href="#ship" aria-controls="ship" role="tab" data-toggle="tab">Thông tin
                                khác</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <p>
                                <?php echo $row['product_description'] ?>
                            </p>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="comment">
                            <div role="tabpanel">
                                <ul class="nav nav-tabs" role="tablist">
                                    <table class="table table-bordered">
                                        <th>
                                            <a href="#all" aria-controls="all" role="tab" data-toggle="tab">Tất cả</a>
                                        </th>
                                        <th>
                                            <a href="#5star" aria-controls="5star" role="tab" data-toggle="tab">5 sao</a>
                                        </th>
                                        <th>
                                            <a href="#4star" aria-controls="4star" role="tab" data-toggle="tab">4 sao</a>
                                        </th>
                                        <th>
                                            <a href="#3star" aria-controls="3star" role="tab" data-toggle="tab">3 sao</a>
                                        </th>
                                        <th>
                                            <a href="#2star" aria-controls="2star" role="tab" data-toggle="tab">2 sao</a>
                                        </th>
                                        <th>
                                            <a href="#star" aria-controls="star" role="tab" data-toggle="tab">1 sao</a>
                                        </th>
                                    </table>
                                </ul>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="all">
                                        <?php display_report() ?>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="5star">
                                        <?php display_5() ?>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="4star">
                                        <?php display_4() ?>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="3star">
                                        <?php display_3() ?>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="2star">
                                        <?php display_2() ?>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="star">
                                        <?php display_1() ?>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div role="tabpanel" class="tab-pane" id="ship">
                            <p>
                                sản phẩm chính hãng nhập khẩu nguyên chiếc tại Việt Nam
                            </p>
                            <div class="row mb-2">
                                <div class="col-12 col-md-6 mb-0">
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-check text-success me-2"></i>Giao hàng ngay trong
                                            2h</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Chế độ bảo hành cho
                                            sản phẩm gặp lỗi do vận chuyển</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Hỗ trợ hướng dẫn cách
                                            chơi</li>
                                    </ul>
                                </div>
                            </div>

                        </div>

                    </div>


                </div>
            </div>
            <!-- /.container -->
        </div>
    <?php endwhile; ?>

</div>
<?php include(TEMPLATE_FRONT_USER . DS . 'footer.php'); ?>