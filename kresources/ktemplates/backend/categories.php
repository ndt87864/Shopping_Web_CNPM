<?php add_category(); ?>

<div>
    <h1 class="">
        Danh mục sản phẩm
    </h1>
    <div class="col-md-4">
        <h3 class="bg-success">
            <?php display_message(); ?>
        </h3>
        <form action="" method="post">
            <div class="form-group">
                <label for="category-title">Loại</label>
                <input type="text" name="cat_title" class="form-control">
            </div>

            <div class="form-group">

                <input type="submit" name="add_category" class="btn btn-primary" value="Thêm danh mục">
            </div>


        </form>


    </div>


    <div class="col-md-8">

        <table class="table">
            <thead>

                <tr>
                    <th>id</th>
                    <th>Loại</th>
                    <th></th>
                </tr>
            </thead>


            <tbody>
                <?php show_categories_in_admin(); ?>
            </tbody>

        </table>

    </div>
</div>