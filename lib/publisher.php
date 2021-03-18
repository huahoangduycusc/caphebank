<?php
if(!defined('IN_SITE')) die('Error: restricted access');
// check loop
LoanStatistic::checkCreateMonth();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="<?php echo homeurl();?>theme/main.css" type="text/css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="<?php echo homeurl();?>js/datatables.min.js"></script>
    <script type="text/javascript" src="<?php echo homeurl();?>js/moment.min.js"></script>
    <script type="text/javascript" src="<?php echo homeurl();?>js/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo homeurl();?>js/daterangepicker.css" />
</head>
<body class="overlay-scrollbar sidebar-expand">
    <!-- Navbar -->
    <div class="navbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="nav-link" id="hamburger">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
            <li class="nav-item">
                <img src="<?php echo homeurl();?>public/logo.png" class="logo" alt="">
            </li>
        </ul>
        <!-- nav right -->
        <ul class="navbar-nav nav-right">
            <li class="nav-item dropdown">
                <a href="#" class="nav-link">
                    <i class="fas fa-bell dropdown-toggle" data-toggle="notification-menu"></i>
                    <span class="navbar-badge">0</span>
                </a>
                <ul id="notification-menu" class="dropdown-menu notification-menu">
                    <div class="dropdown-menu-header">
                        <span>Thông báo</span>
                    </div>
                    <div class="dropdown-menu-content overlay-scrollbar scrollbar-hover">
                        <li class="dropdown-menu-item">
                            <a href="" class="dropdown-menu-link">
                                <div>
                                    <i class="fas fa-gift"></i>
                                </div>
                                <span>Lorem ipsum dolor sit amet consecteturitate aesse, molestiue eaqu rerum!
                                    <br>
                                    <span>10/12/2020</span>
                                </span>
                            </a>
                        </li>
                        <li class="dropdown-menu-item">
                            <a href="" class="dropdown-menu-link">
                                <div>
                                    <i class="fas fa-gift"></i>
                                </div>
                                <span>Lorem ipsum dolor sit amet consecteturitate aesse, molestiue eaqu rerum!
                                    <br>
                                    <span>10/12/2020</span>
                                </span>
                            </a>
                        </li>
                        <li class="dropdown-menu-item">
                            <a href="" class="dropdown-menu-link">
                                <div>
                                    <i class="fas fa-gift"></i>
                                </div>
                                <span>Lorem ipsum dolor sit amet consecteturitate aesse, molestiue eaqu rerum!
                                    <br>
                                    <span>10/12/2020</span>
                                </span>
                            </a>
                        </li>
                        <li class="dropdown-menu-item">
                            <a href="" class="dropdown-menu-link">
                                <div>
                                    <i class="fas fa-gift"></i>
                                </div>
                                <span>Lorem ipsum dolor sit amet consecteturitate aesse, molestiue eaqu rerum!
                                    <br>
                                    <span>10/12/2020</span>
                                </span>
                            </a>
                        </li>
                        <li class="dropdown-menu-item">
                            <a href="" class="dropdown-menu-link">
                                <div>
                                    <i class="fas fa-gift"></i>
                                </div>
                                <span>Lorem ipsum dolor sit amet consecteturitate aesse, molestiue eaqu rerum!
                                    <br>
                                    <span>10/12/2020</span>
                                </span>
                            </a>
                        </li>
                        <li class="dropdown-menu-item">
                            <a href="" class="dropdown-menu-link">
                                <div>
                                    <i class="fas fa-gift"></i>
                                </div>
                                <span>Lorem ipsum dolor sit amet consecteturitate aesse, molestiue eaqu rerum!
                                    <br>
                                    <span>10/12/2020</span>
                                </span>
                            </a>
                        </li>
                        <li class="dropdown-menu-item">
                            <a href="" class="dropdown-menu-link">
                                <div>
                                    <i class="fas fa-gift"></i>
                                </div>
                                <span>Lorem ipsum dolor sit amet consecteturitate aesse, molestiue eaqu rerum!
                                    <br>
                                    <span>10/12/2020</span>
                                </span>
                            </a>
                        </li>
                    </div>
                    <div class="dropdown-menu-footer">
                        <span><a href="<?php echo homeurl();?>publisher/notification">Xem tất cả</a></span>
                    </div>
                </ul>
            </li>
            <li class="nav-item avt-wrapper">
                <div class="avatar dropdown">
                    <img src="<?php echo homeurl();?>/public/a0.png" alt="" class="dropdown-toggle" data-toggle="user-menu">
                    <ul id="user-menu" class="dropdown-menu">
                        <li class="dropdown-menu-item">
                            <a href="<?php echo homeurl();?>publisher/profile" class="dropdown-menu-link">
                                <div>
                                    <i class="fas fa-user-tie"></i>
                                </div>
                                <span>Profile</span>
                            </a>
                        </li>
                        <li class="dropdown-menu-item">
                            <a href="<?php echo homeurl();?>publisher/change-password" class="dropdown-menu-link">
                                <div>
                                    <i class="fas fa-exchange-alt"></i>
                                </div>
                                <span>Đổi mật khẩu</span>
                            </a>
                        </li>
                        <?php
                        if($rights == 9)
                        {
                            ?>
                            <li class="dropdown-menu-item">
                                <a href="<?php echo homeurl();?>master" target="_blank" class="dropdown-menu-link">
                                    <div>
                                        <i class="fas fa-cog"></i>
                                    </div>
                                    <span>Quản trị hệ thống</span>
                                </a>
                            </li>
                            <?php
                        }
                        ?>
                        <li class="dropdown-menu-item">
                            <a href="<?php echo homeurl();?>dang-xuat.html" class="dropdown-menu-link">
                                <div>
                                    <i class="fas fa-sign-out-alt"></i>
                                </div>
                                <span>Đăng xuất</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
        <!-- end navbar right -->
    </div>
    <!-- end navbar -->
     <!-- Side bar -->
     <div class="sidebar-overlay"></div>
     <div class="sidebar">
         <div class="navbar-header">
             <a href="<?php echo homeurl();?>"><img src="<?php echo homeurl();?>public/logo2.png"></a>
             <button class="navbar-btn"><i class="fas fa-times"></i></button>
         </div>
        <ul class="sidebar-nav">
            <li class="sidebar-nav-item">
                <a href="<?php echo homeurl();?>" class="sidebar-nav-link">
                    <span>Trang chủ</span>
                </a>
            </li>
            <li class="sidebar-nav-item">
                <a href="<?php echo homeurl();?>news.html" class="sidebar-nav-link">
                    <span>Tin tức</span>
                </a>
            </li>
            <li class="sidebar-nav-item dropdown-index">
				<a href="#" class="sidebar-nav-link">
					<span>Công cụ <b class="caret"></b></span>
                </a>
                <ul class="dropdown-menu-index">
                    <li class="">
                        <a href="<?php echo homeurl();?>publisher/tool/money">Link vay tiền</a>
                    </li>
                    <li class="">
                        <a href="<?php echo homeurl();?>publisher/tool/cong-tac-vien">Link giới thiệu CTV</a>
                    </li>
                </ul>
			</li>
			<li class="sidebar-nav-item dropdown-index">
				<a href="#" class="sidebar-nav-link">
					<span>Báo cáo <b class="caret"></b></span>
                </a>
                <ul class="dropdown-menu-index">
                    <li class="">
                        <a href="<?php echo homeurl();?>publisher/overview">Tổng quan</a>
                    </li>
                    <li class="">
                        <a href="<?php echo homeurl();?>publisher/bao-cao">Đơn vay</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-nav-item dropdown-index">
				<a href="#" class="sidebar-nav-link">
					<span>Thanh toán <b class="caret"></b></span>
                </a>
                <ul class="dropdown-menu-index">
                    <li class="">
                        <a href="<?php echo homeurl();?>publisher/doanh-thu">Doanh thu của tôi</a>
                    </li>
                    <li class="">
                        <a href="<?php echo homeurl();?>publisher/lich-su">Lịch sử thanh toán</a>
                    </li>
                    <li class="">
                        <a href="<?php echo homeurl();?>publisher/thong-tin-thanh-toan">Thông tin thanh toán</a>
                    </li>
                    <li class="">
                        <a href="<?php echo homeurl();?>chinh-sach">Chính sách thanh toán</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-nav-item dropdown-index">
				<a href="#" class="sidebar-nav-link">
					<span>Đổi quà <b class="caret"></b></span>
                </a>
                <ul class="dropdown-menu-index">
                    <li>
                        <a href="<?php echo homeurl();?>publisher/doi-the-cao">Đổi thẻ cào</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-nav-item dropdown-index">
				<a href="#" class="sidebar-nav-link">
					<span>Trợ giúp <b class="caret"></b></span>
                </a>
                <ul class="dropdown-menu-index">
                    <li class="">
                        <a href="<?php echo homeurl();?>huong-dan-su-dung">Hướng dẫn sử dụng</a>
                    </li>
                    <li class="">
                        <a href="<?php echo homeurl();?>cau-hoi-thuong-gap">Câu hỏi thường gặp</a>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <!-- End sidebar -->
    <!-- Main content -->
    <div class="wrapper">