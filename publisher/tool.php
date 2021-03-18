<?php
error_reporting(0);
define('IN_SITE',true);
require_once('../lib/core.php');
$title = "Tool công cụ";
if(!$user_id){
    redirect(homeurl());
}
require_once('../lib/publisher.php');
switch($do){
    case 'money':
        ?>
        <div class="inner">
            <ul class="breadcrumb">
                <li><a href="">Trang chủ</a></li>
                <li><a href="">Công cụ</a></li>
                <li><a href="" class="active">Liên kết vay tiền</a></li>
            </ul>
        </div>
        <div class="box">
            <div class="box_header">
                <h3 class="box_title">Liên kết vay tiền của bạn</h3>
            </div>
            <div class="box_body">
                <div class="row">
                    <div class="col-sm-6">
                        <form>
                            <input type="text" name="frmLoan" class="form-control" value="<?php echo homeurl();?>ref/<?php echo $user_id;?>" id="url"
                                readonly />
                        </form>
                    </div>
                </div>
            </div>
            <div class="box_footer">
                <button class="btn btn-complete" onclick="copyLink();">
                    Sao chép
                </button>
            </div>
        </div>
        <?php
        break;
        case 'congtacvien':
            ?>
            <div class="inner">
                <ul class="breadcrumb">
                    <li><a href="">Trang chủ</a></li>
                    <li><a href="">Công cụ</a></li>
                    <li><a href="" class="active">Liên kết giới thiệu cộng tác viên</a></li>
                </ul>
            </div>
            <div class="box">
                <div class="box_header">
                    <h3 class="box_title">Liên kết giới thiệu cộng tác viên của bạn</h3>
                </div>
                <div class="box_body">
                    <div class="row">
                        <div class="col-sm-6">
                            <form>
                                <input type="text" name="frmLoan" class="form-control" value="<?php echo homeurl();?>register/<?php echo $user_id;?>" id="url"
                                    readonly />
                            </form>
                        </div>
                    </div>
                </div>
                <div class="box_footer">
                    <button class="btn btn-complete" onclick="copyLink();">
                        Sao chép
                    </button>
                </div>
            </div>
            <?php
            break;
        }
        ?>
<div class="pop-up">
    <span>Đã copy đường dẫn vào bộ nhớ tạm</span>
</div>
<script src="<?php echo homeurl();?>publisher/app.js"></script>
<?php
require_once('../lib/end.php');
?>