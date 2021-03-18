<?php
error_reporting(0);
define('IN_SITE',true);
require_once('../lib/core.php');
if(!$user_id){
    redirect(homeurl());
}
require_once('../lib/publisher.php');
?>
<div class="container">
    <div class="row justify1">
        <div class="col-7 col-m-8">
            <div class="box-noti">
                <div class="box-noti-body">
                    <div class="control-title">
                        <h4>Thông báo</h4>
                        <table class="table-noti" id="message_box">
                            <tbody>
                                <tr>
                                    <td style="width: 10%;"><i class="fas fa-bell"></i></td>
                                    <td style="width: 75%;" class="last_reply">
                                        <a href="" class="link_text ng-binding">
                                            MB Bank đã chính thức ra mắt tính năng chọn số tài khoản giống số điện thoại
                                        </a>
                                    </td>
                                    <td style="width: 15%;" class="text-right"><span
                                            class="ng-binding">15/03/2021</span></td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;"><i class="fas fa-bell"></i></td>
                                    <td style="width: 75%;" class="last_reply">
                                        <a href="" class="link_text ng-binding">
                                            MB Bank đã chính thức ra mắt tính năng chọn số tài khoản giống số điện thoại
                                        </a>
                                    </td>
                                    <td style="width: 15%;" class="text-right"><span
                                            class="ng-binding">15/03/2021</span></td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;"><i class="fas fa-bell"></i></td>
                                    <td style="width: 75%;" class="last_reply">
                                        <a href="" class="link_text ng-binding">
                                            MB Bank đã chính thức ra mắt tính năng chọn số tài khoản giống số điện thoại
                                        </a>
                                    </td>
                                    <td style="width: 15%;" class="text-right"><span
                                            class="ng-binding">15/03/2021</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
</div>
<?php
require_once('../lib/end.php');
?>