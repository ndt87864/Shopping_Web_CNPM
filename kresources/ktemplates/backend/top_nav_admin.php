<div class="navbar-header" style="font-size:150%;margin-top:15px;margin-right:900px; padding-left:0px">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand text-left" href="index.php" >ADMIN</a>
    <a class="navbar-brand" href="..\index.php">Trang chủ</a>
</div>
<div class="nav navbar-right top-nav" style="font-size:150%;margin-right:0px;">
    <a href="#" data-toggle="dropdown"><i class="fa fa-user-circle"></i>
        <?php echo user_name(); ?> <b class="caret"></b>
    </a>
    <ul class="dropdown-menu">
        <li>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Thoát</a>
        </li>
    </ul>
</div>