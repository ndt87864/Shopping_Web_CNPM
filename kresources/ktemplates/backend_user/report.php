<div class="col-md-12">
    <div class="modal-content">
        <div class="modal-body ">
            <h1 class="">
                Đánh giá đơn hàng
            </h1>
            <?php display_order_from_report(); ?>
            <?php
            $rate = 5; // Đặt giá trị ban đầu là 5
            echo "<p style='display: inline;'>Chất lượng sản phẩm: </p>";
            for ($x = 0; $x < $rate; $x++) {

                echo '<i class="fa-star ' . ($x < $rate ? 'fas text-warning' : 'far') . '" data-index="' . $x . '" ></i>';
            }
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <?php add_report() ?>

                <input type="hidden" name="star" id="rate" value="<?php echo $rate; ?>">
                <script>
                    var stars = document.querySelectorAll('.fa-star');
                    for (var i = 0; i < stars.length; i++) {
                        stars[i].addEventListener('click', function () {
                            var index = this.getAttribute('data-index');
                            document.getElementById('rate').value = index + 1;
                            for (var j = 0; j < stars.length; j++) {
                                stars[j].className = 'fa-star ' + (j <= index ? 'fas text-warning' : 'far');
                            }
                        });
                    }
                </script>
                <div class="form-group">
                    <label class="fa fa-pen"></label>
                    <label for="comment">Viết đánh giá:</label><br />
                    <textarea name="comment" cols="50" rows="10" class="typography-line"
                        style="border:1px solid black;"></textarea>
                </div>
                <div class="form-group fa fa-file-image">
                    <label for="file">Hình ảnh:</label>
                    <input type="file" name="file">
                </div>
                <div class="form-group text-left">
                    <input type="submit" name="report_product" class="btn btn-primary" value="Đánh giá">
                </div>
            </form>
        </div>
    </div>
</div>