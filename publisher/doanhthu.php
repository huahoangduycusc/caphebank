<?php
error_reporting(0);
define('IN_SITE',true);
require_once('../lib/core.php');
if(!$user_id){
    redirect(homeurl());
}
if(isset($_POST['btn_wr'])){
    if($user_id && $datauser['a_point'] > 0)
    {
        $ruttien = abs(intval($datauser['a_point']));
        $method = isset($_POST['method']) ? abs(intval($_POST['method'])) : 0;
        if(PaymentMethod::checkExist($method)){
            Payment::createPayment($ruttien,$method);
            redirect(homeurl().'publisher/doanhthu.php');
        }
        else{
            redirect(homeurl().'publisher/doanhthu.php?error');
        }
        
    }
}
$pending = db_sum('tb_payment','money',array('status' => '0','user_id' => $user_id));
$total_withdrawn = db_sum('tb_payment','money',array('status' => '2','user_id' => $user_id));
require_once('../lib/publisher.php');
?>
<div class="inner">
    <ul class="breadcrumb">
        <li><a href="">Trang chủ</a></li>
        <li><a href="">Thanh toán</a></li>
        <li><a href="" class="active">Doanh thu của tôi</a></li>
    </ul>
</div>

<div class="bg-white">
    <div class="box-content">
        <div style="margin-bottom:20px;">     
            <a href="" class="publiser"><i class="far fa-gem"></i> Doanh thu của tôi</a>
            <a href="<?php echo homeurl();?>publisher/lich-su" class="publiser"><i class="far fa-gem"></i> Lịch sử thanh toán</a>
            <a href="<?php echo homeurl();?>publisher/thong-tin-thanh-toan" class="publiser"><i class="far fa-gem"></i> Thông tin thanh toán</a>
            </div>
        </div>
        <div class="box">
            <div class="box_header"><h3 class="box_title">Doanh thu của tôi</h3></div>
            <div class="box_body">
                <div class="row">
                    <div class="col-sm-6 col-m-4">
                        <div class="small-box bg-green">
                            <div class="small-box-inner">
                                <h3><?php echo number_format($datauser['a_point']);?> Point</h3>
                                <p>Số điểm hiện có</p>
                            </div>
                        <div class="small-box-icon">
                            <i class="far fa-money-bill-alt"></i>
                        </div>
                        </div>
                    </div>
                    <!-- item -->
                    <div class="col-sm-6 col-m-4">
                        <div class="small-box bg-red">
                            <div class="small-box-inner">
                                <h3><?php echo number_format($pending);?> Point</h3>
                                <p>Đang thanh toán</p>
                            </div>
                        <div class="small-box-icon">
                            <i class="fas fa-share"></i>
                        </div>
                        </div>
                    </div>
                    <!-- item -->
                    <div class="col-sm-6 col-m-4">
                        <div class="small-box bg-purple">
                            <div class="small-box-inner">
                                <h3><?php echo number_format($total_withdrawn);?> Point</h3>
                                <p>Tổng thanh toán</p>
                            </div>
                        <div class="small-box-icon">
                            <i class="fas fa-hand-holding-usd"></i>
                        </div>
                        </div>
                    </div>
                    <!-- item -->
                </div>
                <div class="text-center">
                   <form action="?" method="POST">
                   <div class="center select-statistic" style="margin-bottom: 30px;">
                        <select name="method" class="seclect-option">
                            <?php
                            $methods = PaymentMethod::getList();
                            foreach($methods as $mt)
                            {
                                ?>
                                <option value="<?php echo $mt['method_id'];?>"><?php echo $mt['method_name'];?></option>
                                <?php
                            }
                            ?>
                        </select>
                   </div>
                    <button type="submit" name="btn_wr" class="btn btn-complete bg-green lg-text" value="widthraw">
                        Rút tiền
                    </button>
                   </form>
                </div>
                <div class="padding"></div>
                <hr>
                <div class="padding"></div>
                <div class="notes">
                    <ul class="pin">
                    <li><p style="font-weight:bold;">1 Point tương ứng với 1.000 VND</p></li>
                    <li>
                    <span class="bold">Số tiền rút phải bằng hoặc lớn hơn 50 Point (50.000 VND).</span>
                    </li>
                    <li>
                    <p>Để nhận được thanh toán, bạn cần điền thông tin thanh toán 
                    <a href="<?php echo homeurl();?>publisher/thong-tin-thanh-toan" style="font-weight:bold;color:red;">tại đây</a> 
                    (nếu bạn đã làm rồi thì bỏ qua).</p>
                    </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php
require_once('../lib/end.php');
?>