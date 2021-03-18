<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CapheBank - Quản lý hệ thống</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/lib/datatable/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="<?php echo homeurl();?>js/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="<?php echo homeurl();?>js/sweetalert2.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo homeurl();?>js/moment.min.js"></script>
    <script type="text/javascript" src="<?php echo homeurl();?>js/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo homeurl();?>js/daterangepicker.css" />
</head>
<?php
$paymentWaiting = db_count('tb_payment','payment_id',array('status' => '0'));
$loanWaiting = db_count('loan','loan_id',array('l_status' => '0'));
?>
<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li <?php echo ($module == "common" && $action == "dashbroad") ? 'class="active"' : '';?>>
                        <a href="index.php"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                    </li>
                    <li class="menu-title">Đơn vay</li><!-- /.menu-title -->
                    <li <?php echo ($module == "orders" && $action == "overview") ? 'class="active"' : '';?>>
                        <a href="?m=orders&a=overview"> <i class="menu-icon fa fa-tachometer"></i>Tổng quan 
                        <span class="badge badge-warning"><?php echo $loanWaiting;?> </span>
                    </a>
                    </li>
                    <li <?php echo ($module == "orders" && $action == "report") ? 'class="active"' : '';?>>
                        <a href="?m=orders&a=report"> <i class="menu-icon ti-email"></i> Báo cáo</a>
                    </li>

                    <li class="menu-title">Cộng tác viên</li><!-- /.menu-title -->
                    <li <?php echo ($module == "users" && $action == "overview") ? 'class="active"' : '';?>>
                        <a href="?m=users&a=overview"> <i class="menu-icon ti-user"></i>Danh sách </a>
                    </li>
                    <li <?php echo ($module == "users" && $action == "search") ? 'class="active"' : '';?>>
                        <a href="?m=users&a=search"> <i class="menu-icon ti-search"></i>Tìm kiếm </a>
                    </li>
                    <li <?php echo ($module == "payment" && $action == "overview") ? 'class="active"' : '';?>>
                        <a href="?m=payment&a=overview"> <i class="menu-icon ti-credit-card"></i>Đơn rút tiền 
                        <span class="badge badge-danger"><?php echo $paymentWaiting;?> </span> </a>
                    </li>
                    <li class="menu-title">Bài viết</li><!-- /.menu-title -->
                    <li <?php echo ($module == "articles" && $action == "create") ? 'class="active"' : '';?>>
                        <a href="?m=articles&a=create"> <i class="menu-icon ti-write"></i>Tạo chủ đề mới </a>
                    </li>
                    <li <?php echo ($module == "articles" && $action == "overview") ? 'class="active"' : '';?>>
                    <a href="?m=articles&a=overview"> <i class="menu-icon ti-book"></i>Danh sách</a>
                    </li>
                    <li class="menu-title">Hệ thống</li><!-- /.menu-title -->
                    <li <?php echo ($module == "system" && $action == "overview") ? 'class="active"' : '';?>>
                        <a href="?m=system&a=overview"> <i class="menu-icon ti-info-alt"></i>Thông tin trang web </a>
                    </li>
                    <li <?php echo ($module == "contact" && $action == "overview") ? 'class="active"' : '';?>>
                        <a href="?m=contact&a=overview"> <i class="menu-icon ti-mobile"></i>Liên hệ & hỗ trợ </a>
                    </li>
                    <li <?php echo ($module == "system" && $action == "slide") ? 'class="active"' : '';?>>
                        <a href="?m=system&a=slide"> <i class="menu-icon ti-gallery"></i>Slide trang web </a>
                    </li>
                    <li>
                        <a href="?m=question&a=overview"> <i class="menu-icon ti-help-alt"></i>Câu hỏi thường gặp </a>
                    </li>
                    <li <?php echo ($module == "system" && $action == "policy") ? 'class="active"' : '';?>>
                        <a href="?m=system&a=policy"> <i class="menu-icon ti-marker"></i>Chính sách </a>
                    </li>
                    <li <?php echo ($module == "system" && $action == "terms") ? 'class="active"' : '';?>>
                        <a href="?m=system&a=terms"> <i class="menu-icon ti-marker"></i>Điều khoản </a>
                    </li>
                    <li <?php echo ($module == "system" && $action == "guide") ? 'class="active"' : '';?>>
                        <a href="?m=system&a=guide"> <i class="menu-icon ti-marker"></i>Hướng dẫn </a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="./"><img src="<?php echo homeurl();?>public/logo.png" style="width: 80px;" alt="Logo"></a>
                    <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form action="" class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>
                    </div>

                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#"><i class="fa fa- user"></i>My Profile</a>

                            <a class="nav-link" href="#"><i class="fa fa -cog"></i>Cài đặt</a>

                            <a class="nav-link" href="<?php echo homeurl();?>dang-xuat.html"><i class="fa fa-power -off"></i>Thoát</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>
        <!-- /#header -->
        <!-- Content -->
        <div class="content">