<div class="navbar-header" style="font-size:150%;margin-top:15px;margin-right:900px; padding-left:0px">
     <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="index_user.php">User</a>
     <a class="navbar-brand" href="..\index_user.php">Trang chủ</a>
</div>
<!-- Top Menu Items -->
<ul class="nav navbar-right top-nav" style="font-size:150%;">
    <a href="#" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo user_name(); ?> <b class="caret"></b></a>
        <ul class="dropdown-menu" style="background: black; color:white;">
            <li>
                <a href="logout.php"><i class="fa fa-fw fa-sign-out"></i>Thoát</a>
            </li>
        </ul>
</ul>