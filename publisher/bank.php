<?php
error_reporting(0);
define('IN_SITE',true);
require_once('../lib/core.php');
$title = "Thông tin cá nhân";
if(!$user_id){
    redirect(homeurl());
}
$bank = AccountBank::getInfo();
require_once('../lib/publisher.php');
?>
<div class="inner">
    <ul class="breadcrumb">
        <li><a href="">Trang chủ</a></li>
        <li><a href="">Profile</a></li>
        <li><a href="" class="active">Thông tin thanh toán</a></li>
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
                        $table = 'account_bank';
                        $bank_name = input_post('bankname');
                        $bank_chinhanh = input_post('cn');
                        $bank_user = input_post('ttk');
                        $bank_number = input_post('stk');
                        $bank_cmnd = input_post('cmnd');
                        $momo = input_post('momo');
                        if(preg_match($regex,$bank_number)){
                            $error['result'] = 'Số tài khoản không hợp lệ';
                        }
                        else if(preg_match($regex,$bank_cmnd)){
                            $error['result'] = 'Chứng minh nhân dân không hợp lệ .';
                        }
                        else if(empty($bank_name)){
                            $error['result'] = 'Vui lòng nhập tên ngân hàng';
                        }
                        else if(empty($bank_chinhanh)){
                            $error['result'] = 'Vui lòng nhập chi nhánh ngân hàng';
                        }
                        else if(empty($bank_user)){
                            $error['result'] = 'Vui lòng nhập tên tài khoản sở hữu';
                        }
                        else if(empty($bank_number)){
                            $error['result'] = 'Vui lòng nhập số tài khoản';
                        }
                        else if(empty($bank_cmnd)){
                            $error['result'] = 'Vui lòng nhập số chứng minh nhân dân';
                        }
                        if(empty($error)){
                            $data = array(
                                'bank_name' => $bank_name,
                                'bank_chinhanh' => $bank_chinhanh,
                                'bank_user' => $bank_user,
                                'bank_number' => $bank_number,
                                'bank_cmnd' => $bank_cmnd,
                                'momo' => $momo
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
                            <label for="bn">Tên ngân hàng</label>
                            <div class="info-text"><input name="bankname" id="bn" type="text" value="<?php echo $bank['bank_name'];?>" class="form-control" required></div>
                        </div>
                        <div class="form-group">
                            <label for="cn">Chi nhánh ngân hàng</label>
                            <div class="info-text"><input name="cn" id="cn" value="<?php echo $bank['bank_chinhanh'];?>" type="text" class="form-control" required></div>
                        </div>
                        <div class="form-group">
                            <label for="ttk">Tên tài khoản</label>
                            <div class="info-text">
                                <input name="ttk" id="ttk" value="<?php echo $bank['bank_user'];?>" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="stk">Số tài khoản</label>
                            <div class="info-text">
                                <input name="stk" id="stk" value="<?php echo $bank['bank_number'];?>" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cmnd">Chứng minh nhân dân</label>
                            <div class="info-text"><input name="cmnd" id="cmnd" value="<?php echo $bank['bank_cmnd'];?>" type="text" class="form-control"></div>
                        </div>
                        <div class="form-group">
                            <label for="momo">SDT MOMO</label>
                            <div class="info-text"><input name="momo" id="momo" value="<?php echo $bank['momo'];?>" type="text" class="form-control"></div>
                        </div>
                    </div>
                </div>
                    </form>
                    <?php
                    break;
                    case '':
                    ?>
                    <div class="box_header">
                    <h3 class="box_title">Thông tin thanh toán</h3>
                    <a href="?do=edit" class="btn btn-complete bg-orange">Chỉnh sửa</a>
                </div>
                <hr>
                <div class="box_body">
                    <div class="personal_box">
                        <div class="form-group">
                            <label for="fullname">Tên ngân hàng</label>
                            <div class="info-text"><?php echo $bank['bank_name'];?></div>
                        </div>
                        <div class="form-group">
                            <label for="fullname">Chi nhánh ngân hàng</label>
                            <div class="info-text"><?php echo $bank['bank_chinhanh'];?></div>
                        </div>
                        <div class="form-group">
                            <label for="fullname">Tên tài khoản</label>
                            <div class="info-text"><?php echo $bank['bank_user'];?></div>
                        </div>
                        <div class="form-group">
                            <label for="fullname">Số tài khoản</label>
                            <div class="info-text"><?php echo $bank['bank_number'];?></div>
                        </div>
                        <div class="form-group">
                            <label for="fullname">Chứng minh nhân dân</label>
                            <div class="info-text"><?php echo $bank['bank_cmnd'];?></div>
                        </div>
                        <div class="form-group">
                            <label for="fullname">SDT MOMO</label>
                            <div class="info-text"><?php echo $bank['momo'];?></div>
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
                            <span><?php echo thoigian($datauser['a_online']);?> trước</span>
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