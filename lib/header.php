<?php
if(!defined('IN_SITE')) die('Error: restricted access');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="description" content="<?php echo $sys['description'];?>" />
    <title><?php echo $sys['title'];?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="<?php echo homeurl();?>theme/theme.css" type="text/css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="<?php echo homeurl();?>js/datatables.min.js"></script>
</head>
<body>
    <div class="sticky-fixed">
        <div class="menu-close">
           <i class="fas fa-times"></i>
        </div>
    </div>
    <div class="header-top-area">
        <div class="container">
            <span><i class="fa fa-phone"></i><?php echo $sys['phone'];?></span>
            <span><i class="fa fa-envelope"></i><?php echo $sys['email'];?></span>
        </div>
    </div>
    <header>
        <div class="header-container">
            <nav>
                <div class="logo"><a href="<?php echo homeurl();?>"><img src="<?php echo homeurl();?>public/logo.png"></a></div>
                <ul class="navbar">
                    <div class="logo-sm">
                        <a href="<?php echo homeurl();?>"><img src="<?php echo homeurl();?>public/logo.png"></a>
                    </div>
                    <li class="navbar-item">
                        <a href="<?php echo homeurl();?>" class="navbar-link">Trang chủ</a>
                    </li>
                    <?php
                    if($user_id)
                    {
                        ?>
                        <li class="navbar-item has-sub">
                            <a class="navbar-link btn-lg"><?php echo $datauser['a_username']; ?><i class="fas fa-angle-down"></i></a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="<?php echo homeurl();?>publisher/overview">Trang tổng quan</a>
                                </li>
                                <?php
                                if($rights == 9)
                                {
                                    ?>
                                    <li>
                                    <a href="<?php echo homeurl();?>master" target="_blank">Quản trị hệ thống</a>
                                </li>
                                    <?php
                                }
                                ?>
                                <li>
                                    <a href="<?php echo homeurl();?>dang-xuat.html">Đăng xuất</a>
                                </li>
                            </ul>
                        </li>
                        <?php
                    }
                    ?>
                    <li class="navbar-item">
                        <a href="<?php echo homeurl();?>chinh-sach" class="navbar-link">Chính sách</a>
                    </li>
                    <li class="navbar-item">
                        <a href="<?php echo homeurl();?>huong-dan-su-dung" class="navbar-link">Hướng dẫn</a>
                    </li>
                    <?php
                    if(!$user_id)
                    {
                        ?>
                        <li class="navbar-item">
                            <a href="<?php echo homeurl();?>register" class="navbar-link btn-lg">Đăng ký</a>
                        </li>
                        <li class="navbar-item">
                            <a href="<?php echo homeurl();?>dang-nhap.html" class="navbar-link btn-lg">Đăng nhập</a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
                <div class="menu">
                    <i class="fas fa-bars"></i>
                </div>
            </nav>
        </div>
    </header>