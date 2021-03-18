<?php
define('IN_SITE',true);
$rootpath = '';
require_once('lib/core.php');
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <title>TeaMobi World | Trang bạn đang xem không có thật (404)</title>
  <style type="text/css">
    body { background-color: #efefef; color: #333; font-family: Georgia,Palatino,'Book Antiqua',serif;padding:0;margin:0;text-align:center; }
    p {font-style:italic;}
    div.dialog {
      width: 490px;
      margin: 4em auto 0 auto;
    }
    img { border:none; }
  </style>
</head>

<body>
  <!-- This file lives in public/404.html -->
  <div class="dialog">
    <a href="<?php echo homeurl();?>"><img src="<?php echo homeurl();?>public/404.png" /></a>
    <p>Trang bạn đang xem không có thật</p>
  </div>
</body>
</html>