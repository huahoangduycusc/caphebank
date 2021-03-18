<?php
error_reporting(0);
define('IN_SITE',true);
require_once('../lib/core.php');
$title = "Tool công cụ";
if(!$user_id){
    redirect(homeurl());
}
require_once('../lib/publisher.php');
?>
<div class="inner">
    <ul class="breadcrumb">
        <li><a href="">Trang chủ</a></li>
        <li><a href="">Thanh toán</a></li>
        <li><a href="" class="active">Lịch sử thanh toán</a></li>
    </ul>
</div>
<div class="bg-white">
    <div class="box-content">
        <div class="box">
            <div class="box_header"><h3 class="box_title">Lịch sử thanh toán</h3></div>
            <div class="box_body">
                <table id="frmLoan" class="display table-data" style="width:100%">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Số tiền rút</th>
                            <th>Ngày rút</th>
                            <th>Phương thức chuyển khoản</th>
                            <th>Trạng thái</th>
                            <th>Lý do</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $payments = Payment::myPayment();
                        foreach($payments as $pay)
                        {
                            ?>
                            <tr>
                                <td><?php echo $pay['payment_id'];?></td>
                                <td><?php echo number_format($pay['money']);?> Point</td>
                                <td><?php echo $pay['created_at'];?></td>
                                <td><?php echo PaymentMethod::getName($pay['p_method']);?></td>
                                <td><?php echo Payment::statusPayment($pay['status']);?></td>
                                <td><?php echo $pay['p_reason'];?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#frmLoan').DataTable({
            "order": [[ 0, "desc" ]]
        });
    });
</script>
<?php
require_once('../lib/end.php');
?>