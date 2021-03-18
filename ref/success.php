<?php
error_reporting(0);
define('IN_SITE',true);
require_once('../lib/core.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo homeurl();?>theme/style.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="signup">
        <img src="<?php echo homeurl();?>public/success.svg" alt="" style="width: 70px;display: block;margin: 0 auto;">
        <h1 class="signup-heading">Đăng ký vay tiền thành công</h1>
        <p style="font-size:16px;text-align:center;">
            Thông tin đăng ký vay tiền của bạn đã được gửi đến hệ thống, vui lòng giữ liên lạc điện thoại bên mình để nhân viên bên chúng tôi
            xác nhận thông tin với quý khách để hoàn tất thủ tục.
        </p>
        <center><a href="<?php echo homeurl();?>" class="back">Quay về trang chủ</a></center>
    </div>
</body>
</html>