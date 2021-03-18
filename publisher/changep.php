<?php
error_reporting(0);
define('IN_SITE',true);
require_once('../lib/core.php');
$title = "Thông tin cá nhân";
if(!$user_id){
    redirect(homeurl());
}
require_once('../lib/publisher.php');
$error = array();
if(isset($_POST['update'])){
    $old_pass = input_post('op');
    $new_pass = input_post('np');
    $confirm_pass = input_post('cfp');
    if(empty($old_pass)){
        $error['old'] = "Vui lòng nhập mẩu khẫu cũ ";
    }
    if(empty($new_pass)){
        $error['new'] = "Vui lòng nhập mật khẩu mới";
    }
    if(empty($confirm_pass)){
        $error['confirm'] = 'Vui lòng nhập lại mật khẩu xác nhận';
    }
    if(strlen($new_pass) < 6 || strlen($new_pass) > 20){
        $error['new'] = "Mật khẩu phải dài ít nhất từ 6 đến 20 ký tự";
    }
    if(!empty($new_pass) && $new_pass != $confirm_pass){
        $error['confirm'] = 'Mật khẩu xác nhận không trùng khớp';
    }
    if(empty($error)){
        if(Account::changePassword($old_pass,$new_pass)){
            $msg = "Thay đổi mật khẩu mới thành công !";
        }
        else{
            $error['old'] = "Mật khẩu cũ không chính xác !";
        }
    }
}
?>
<div class="inner">
    <ul class="breadcrumb">
        <li><a href="<?php echo homeurl();?>">Trang chủ</a></li>
        <li><a href="">Profile</a></li>
        <li><a href="" class="active">Thay đổi mật khẩu</a></li>
    </ul>
</div>
<div class="container">
    <div class="row justify center">
        <div class="col-7 col-m-7">
            <div class="box_body">
                <form method="POST">
                    <div class="personal_box">
                        <div class="center">
                        <?php
                        if(isset($msg)){
                            echo '<div class="alert-success">'.$msg.'</div>';
                        }
                        ?>
                        </div>
                        <div class="form-group">
                            <label for="op">Mật khẩu cũ</label>
                            <div class="info-text"><input name="op" id="op" type="password" class="form-control" value="<?php echo isset($old_pass) ? $old_pass : '';?>" required></div>
                            <?php echo showError($error,'old');?>
                        </div>
                        <div class="form-group">
                            <label for="np">Mật khẩu mới</label>
                            <div class="info-text"><input name="np" id="np" type="password" class="form-control" value="<?php echo isset($new_pass) ? $new_pass : '';?>" required></div>
                            <?php echo showError($error,'new');?>
                        </div>
                        <div class="form-group">
                            <label for="cfp">Xác nhận lại mật khẩu</label>
                            <div class="info-text"><input name="cfp" id="cfp" type="password" class="form-control" required></div>
                            <?php echo showError($error,'confirm');?>
                        </div>
                        <div class="form-group">
                        <input type="submit" name="update" value="Cập nhật" class="btn btn-complete bg-orange">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
require_once('../lib/end.php');
?>