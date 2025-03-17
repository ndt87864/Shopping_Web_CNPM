<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li>
            <a href="index.php">
                <i class="now-ui-icons design_app"></i>
                <p>Tổng Quan</p>
            </a>
        </li>
        <li class="">
            <a href="index.php?comment">
                <i class="now-ui-icons ui-2_chat-round"></i>
                <p>Thống kê comment</p>
            </a>
        </li>
        <li class="">
            <a href="index.php?revenue">
                <i class="now-ui-icons education_atom"></i>
                <p>Thống kê doanh thu</p>
            </a>
        </li>

        <li>
        <div style="display: flex;">
             <a href="index.php?admin_order" class="col-6">
        <div class="d-flex align-items-center">
            <i class="now-ui-icons files_paper"></i>
            <p>Đơn hàng</p>
        </div>
    </a>
    <p class="col-6" onclick="toggleUl()"> <i class="fa fa-plus"></i></p>
</div>

            <ul id="menu" style="display:none;padding-left:50px;">
                <li><a class="nav-link" href="index.php?ad_process">
                        <div class="text-left">
                            <p>Đang chờ xử lý</p>
                        </div>
                    </a></li>
                <li><a class="nav-link" href="index.php?ad_confirm">
                        <div class="text-left">
                            <p>Đã xác nhận</p>
                        </div>
                    </a></li>
                <li><a class="nav-link" href="index.php?ad_ship">
                        <div class="text-left">
                            <p>Đang giao hàng</p>
                        </div>
                    </a></li>
                <li><a class="nav-link" href="index.php?ad_delive">
                        <div class="text-left">
                            <p>Đã hoàn thành</p>
                        </div>
                    </a></li>
            </ul>

        </li>
        <li>
            <a href="index.php?products">
                <i class="now-ui-icons education_paper"></i>
                <p>danh sách sản phẩm</p>
            </a>
        </li>
        <li>
            <a href="index.php?add_product">
                <i class="now-ui-icons ui-1_simple-add "></i>
                <p>Thêm sản phẩm</p>
            </a>
        </li>
        <li>
            <a href="index.php?categories">
                <i class="now-ui-icons design_bullet-list-67"></i>
                <p>Danh mục sản phẩm</p>
            </a>
        </li>
        <li>
            <a href="index.php?users">
                <i class="now-ui-icons users_single-02"></i>
                <p>tài khoản</p>
            </a>
        </li>
        <li>
            <a href="index.php?support">
                <i class="fa fa-fw fa-users-cog"></i>
                <p>Hỗ trợ người dùng</p>
            </a>
        </li>
        <li>
            <a href="index.php?slides">
                <i class="now-ui-icons text_caps-small"></i>
                <p>Nội dung trên shop</p>
            </a>
        </li>
    </ul>

    <div class="container">
        <div class="sidebar" data-color="blue">
            <div class="sidebar-wrapper" id="sidebar-wrapper">
                <ul class="nav">
                    <li>
                        <a href="index.php">
                            <i class="now-ui-icons design_app"></i>
                            <p>Tổng Quan</p>
                        </a>
                    </li>
                    <li class="">
                        <a href="index.php?comment">
                            <i class="now-ui-icons ui-2_chat-round"></i>
                            <p>Thống kê comment</p>
                        </a>
                    </li>
                    <li class="">
                        <a href="index.php?revenue">
                            <i class="now-ui-icons education_atom"></i>
                            <p>Thống kê doanh thu</p>
                        </a>
                    </li>
                    <li onmouseover="showSubMenu()" onmouseout="hideSubMenu()">
                        <a href="index.php?admin_order">
                            <div class="d-flex align-items-center">
                                <i class="now-ui-icons files_paper"></i>
                                <p>Đơn hàng</p>
                            </div>
                        </a>
                        <ul id="subMenu" style="display:none;">
                            <li><a class="nav-link" href="index.php?ad_process">
                                    <div class="text-left">
                                        <p>Đang chờ xử lý</p>
                                    </div>
                                </a></li>
                            <li><a class="nav-link" href="index.php?ad_confirm">
                                    <div class="text-left">
                                        <p>Đã xác nhận</p>
                                    </div>
                                </a></li>
                            <li><a class="nav-link" href="index.php?ad_ship">
                                    <div class="text-left">
                                        <p>Đang giao hàng</p>
                                    </div>
                                </a></li>
                            <li><a class="nav-link" href="index.php?ad_delive">
                                    <div class="text-left">
                                        <p>Đã hoàn thành</p>
                                    </div>
                                </a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="index.php?products">
                            <i class="now-ui-icons education_paper"></i>
                            <p>danh sách sản phẩm</p>
                        </a>
                    </li>
                    <li>
                        <a href="index.php?amount">
                            <i class="now-ui-icons education_paper"></i>
                            <p>Kho hàng và giảm giá</p>
                        </a>
                    </li>
                    <li>
                        <a href="index.php?add_product">
                            <i class="now-ui-icons ui-1_simple-add "></i>
                            <p>Thêm sản phẩm</p>
                        </a>
                    </li>
                    <li>
                        <a href="index.php?categories">
                            <i class="now-ui-icons design_bullet-list-67"></i>
                            <p>Danh mục sản phẩm</p>
                        </a>
                    </li>
                    <li>
                        <a href="index.php?users">
                            <i class="now-ui-icons users_single-02"></i>
                            <p>tài khoản</p>
                        </a>
                    </li>
                    <li>
                        <a href="index.php?support">
                            <i class="fa fa-fw fa-users-cog"></i>
                            <p>Hỗ trợ người dùng</p>
                        </a>
                    </li>
                    <li>
                        <a href="index.php?slides">
                            <i class="now-ui-icons text_caps-small"></i>
                            <p>Nội dung trên shop</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</div>
<script>
    function toggleUl() {
        var ul = document.getElementById("menu");
        if (ul.style.display === "none") {
            ul.style.display = "block";
        } else {
            ul.style.display = "none";
        }
    }
    function showSubMenu() {
        var subMenu = document.getElementById("subMenu");
        subMenu.style.display = "block";
    }

    function hideSubMenu() {
        var subMenu = document.getElementById("subMenu");
        subMenu.style.display = "none";
    }
</script>