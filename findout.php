<?php
error_reporting(0);
define('IN_SITE',true);
$rootpath = '';
require_once('lib/core.php');
require_once('lib/header.php');
$system = System::getInfo();
?>
   <section class="h3-title">
        <div class="container">
            <div class="center"><h3>Chính sách thanh toán</h3></div>
        </div>
    </section>
    <div class="body-content">
        <div class="container">
        <div class="title-des"><?php echo $system['chinhsach'];?></div>
    </div>
<?php
require_once('lib/footer.php');
?>