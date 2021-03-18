<?php
error_reporting(0);
define('IN_SITE',true);
require_once('../lib/core.php');
$title = "Thông tin cá nhân";
if(!$user_id){
    redirect(homeurl());
}
require_once('../lib/publisher.php');
?>
<div class="inner">
    <ul class="breadcrumb">
        <li><a href="<?php echo homeurl();?>">Trang chủ</a></li>
        <li><a href="">Profile</a></li>
        <li><a href="" class="active">Thông tin cá nhân</a></li>
    </ul>
</div>
<div class="container">
    <div class="row">
        <div class="col-9 col-m-8">
            <div class="box">
            <?php
            switch($do){
                case 'edit':
                    $error = array();
                    if(isset($_POST['update'])){
                        $regex = "/[^0-9]/";
                        $table = 'account';
                        $fullname = input_post('fullname');
                        $fullname = htmlspecialchars($fullname);
                        $gender = input_post('gender');
                        $gender = abs(intval($gender));
                        $phone = input_post('phone');
                        $address = input_post('address');
                        $intro = input_post('intro');
                        if(preg_match($regex,$gender)){
                            $error['result'] = 'Giới tính không hợp lệ .';
                        }
                        else if(preg_match($regex,$phone)){
                            $error['result'] = 'Số điện thoại bạn nhập không hợp lệ .';
                        }
                        else if($gender <= 1){
                            $gender = 1;
                        }
                        else if($gender >= 2){
                            $gender = 2;
                        }
                        if(empty($error)){
                            $data = array(
                                'a_fullname' => $fullname,
                                'a_gender' => intval($gender),
                                'a_address' => $address,
                                'a_phone' => $phone,
                                'a_intro' => $intro
                            );
                            $where = array('account_id' => $user_id);
                            if(db_update($table,$data,$where)){
                                echo '<div class="alert-success">Cập nhật dữ liệu mới thành công !</div>';
                            }
                            
                        }

                    }
                    ?>
                    <form action="" method="POST">
                    <div class="box_header">
                    <h3 class="box_title">Thông tin cá nhân</h3>
                    <input type="submit" name="update" value="Cập nhật" class="btn btn-complete bg-orange">
                </div>
                <hr>
                <div class="box_body">
                    <div class="personal_box">
                    <?php
                    if($error){
                        showError($error,'result');
                    }
                    ?>
                        <div class="form-group">
                            <label for="fullname">Họ và tên</label>
                            <div class="info-text"><input name="fullname" id="fullname" type="text" value="<?php echo $datauser['a_fullname'];?>" class="form-control" required></div>
                        </div>
                        <div class="form-group">
                            <label for="gender">Giới tính</label>
                            <div class="info-text">
                                <select name="gender" id="gender" class="form-control" style="width:90px;">
                                    <option value="1" <?php echo ($datauser['a_gender'] == 1) ? 'selected' : '';?>>Nam</option>
                                    <option value="2" <?php echo ($datauser['a_gender'] == 2) ? 'selected' : '';?>>Nữ</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone">Điện thoại</label>
                            <div class="info-text"><input name="phone" id="phone" value="<?php echo $datauser['a_phone'];?>" type="text" class="form-control" required></div>
                        </div>
                        <div class="form-group">
                            <label for="address">Địa chỉ</label>
                            <div class="info-text">
                                <textarea class="txt-control" name="address" id="address" rows="5"><?php echo $datauser['a_address'];?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="intro">Giới thiệu</label>
                            <div class="info-text">
                                <textarea class="txt-control" name="intro" id="intro" rows="5"><?php echo $datauser['a_intro'];?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <div class="info-text"><input name="email" value="<?php echo $datauser['a_email'];?>" type="text" class="form-control" readonly></div>
                        </div>
                    </div>
                </div>
                    </form>
                    <?php
                    break;
                    case '':
                    ?>
                    <div class="box_header">
                    <h3 class="box_title">Thông tin cá nhân</h3>
                    <a href="?do=edit" class="btn btn-complete bg-orange">Chỉnh sửa</a>
                </div>
                <hr>
                <div class="box_body">
                    <div class="personal_box">
                        <div class="form-group">
                            <label for="fullname">Tài khoản</label>
                            <div class="info-text"><?php echo $datauser['a_username'];?></div>
                        </div>
                        <div class="form-group">
                            <label for="fullname">Số dư</label>
                            <div class="info-text"><?php echo number_format($datauser['a_point']);?> VND</div>
                        </div>
                        <div class="form-group">
                            <label for="fullname">Họ và tên</label>
                            <div class="info-text"><?php echo $datauser['a_fullname'];?></div>
                        </div>
                        <div class="form-group">
                            <label for="fullname">Giới tính</label>
                            <div class="info-text"><?php echo gender($datauser['a_gender']);?></div>
                        </div>
                        <div class="form-group">
                            <label for="fullname">Điện thoại</label>
                            <div class="info-text"><?php echo $datauser['a_phone'];?></div>
                        </div>
                        <div class="form-group">
                            <label for="fullname">Địa chỉ</label>
                            <div class="info-text"><?php echo $datauser['a_address'];?></div>
                        </div>
                        <div class="form-group">
                            <label for="fullname">Số điện thoại</label>
                            <div class="info-text"><?php echo $datauser['a_phone'];?></div>
                        </div>
                    </div>
                </div>
                    <?php
                    break;
            }
            ?>
                
            </div>
            <!-- box -->
        </div>
        <!-- col 8 -->
        <div class="col-3 col-m-4">
            <div class="box box-at">
                <div class="box box-at box-widget">
                    <div class="widget-user-header bg-yellow">
                        <div style="width: 80%; float: left;">
                            <h3 class="widget-user-username text-white"><?php echo $datauser['a_fullname'];?></h3>
                            <h5 class="widget-user-desc text-white" style="margin-top: -10px;"><?php echo $datauser['a_email'];?></h5>
                        </div>
                    </div>
                    <div id="publisher_avatar" class="widget-user-image profile-user-img">
                        <div ng-hide="uploadingAvatar">
                            <img class="img-responsive img-circle" src="<?php echo homeurl();?>public/a0.png">
                        </div>
                    </div>
                </div>
                <div class="box-body box-profile" id="gift_box">
                    <div class="control-label title_label">
                            <label>Tham gia hệ thống: </label>
                        <br>
                            <span><?php echo thoigian($datauser['a_online']);?></span>
                    </div>
                    <br>
                    <div ng-if="publisher.description" id="publisher_description" class="control-label title_label ng-scope">
                        <label>Giới thiệu </label>
                        <br>
                        <p ng-bind="publisher.description" class="ng-binding"><?php echo $datauser['a_intro'];?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once('../lib/end.php');
?>