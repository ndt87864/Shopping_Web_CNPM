
<div class="col-md-12">

    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form method="GET" action="index.php?search_order">
                    <label for="search_input">Nhập ID hoặc mã mua:</label>
                    <input type="text" class="form-control" name="order_code"
                        placeholder="Nhập ID hoặc mã tracking đơn hàng"
                        style="border:1px solid black;height:37px;border-radius:15px;">
                </form>
            </div>
        </div>
    </div>

<?php search_order() ?>
</div>