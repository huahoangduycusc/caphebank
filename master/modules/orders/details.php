<?php
$loan = Loan::getRow($id);
if(!$loan){
    exit;
}
if(isset($_POST['frmOrder'])){
    $select = isset($_POST['select']) ? abs(intval($_POST['select'])) : 0;
    if($loan['l_update'] != 1){
        $table = 'loan';
        $filter = array('loan_id' => $id);
        $money = ($loan['l_money']*0.1)/1000; // tỉ lệ 10% của đơn
        $moneyCTV = $money*0.05; // 5% của 10%
        if($select == 1){
            $data = array(
                'l_status' => 1
            );
            $msg = "Cập nhật trạng thái của đơn #$id sang đã hủy";
        }
        else if($select == 2){
            $data = array(
                'l_status' => 2,
                'l_update' => 1
            );
            $msg = "Cập nhật trạng thái của đơn #$id sang dã duyệt";
            if($loan['a_id'] != 0){
                $text = "Nhận ".number_format($money)." Point hoa hồng từ đơn #$id";
                AccountLog::insertLog($loan['a_id'],$text);
            }
            // update hoa hong
            if(db_check_exist_account($loan['a_id'])){
                update_point("plus",$loan['a_id'],$money);
            }
            if(db_check_exist_account($loan['c_id'])){
                update_point("plus",$loan['c_id'],$moneyCTV);
            }
           
        }
        Loan::loanStatus($id,$select); // update log status of loan
        db_update($table,$data,$filter); // update loan
        AccountLog::insertLog($user_id,$msg); // log activities of account
        echo '<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
        <span class="badge badge-pill badge-success">Success</span>
        Cập nhật trạng thái của đơn thành công !
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>';
    }
    else{
        echo'<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
        <span class="badge badge-pill badge-danger">Error</span>
        Đơn này đã được duyệt trước đó, bạn không thể chỉnh sửa tiếp tục.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>';
    }
}
?>
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Thông tin đơn vay</strong> <?php echo showStatus($loan['l_status']);?>
            </div>
            <div class="card-body">
                <!-- Credit Card -->
                <div id="pay-invoice">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center">Chi tiết đơn vay tiền</h3>
                        </div>
                        <hr>
                        <form action="" method="post">
                            <div class="row form-group">
                                <div class="col col-md-4"><label class=" form-control-label">ID Đơn vay</label></div>
                                <div class="col-12 col-md-8">
                                    <p class="form-control-static"><?php echo $loan['loan_id'];?></p>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-4"><label class=" form-control-label">Họ và tên</label></div>
                                <div class="col-12 col-md-8">
                                    <p class="form-control-static"><?php echo $loan['l_fullname'];?></p>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-4"><label class=" form-control-label">Số tiền cần vay</label></div>
                                <div class="col-12 col-md-8">
                                    <span class="badge badge-danger text-lg"><?php echo number_format($loan['l_money']);?> VND</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-4"><label class=" form-control-label">Ngày tháng năm sinh</label></div>
                                <div class="col-12 col-md-8">
                                    <p class="form-control-static"><?php echo date('d-m-Y',strtotime($loan['l_birthday']));?></p>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-4"><label class=" form-control-label">Chứng minh thư</label></div>
                                <div class="col-12 col-md-8">
                                    <p class="form-control-static"><?php echo $loan['l_cmnd'];?></p>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-4"><label class=" form-control-label">Số điện thoại</label></div>
                                <div class="col-12 col-md-8">
                                    <p class="form-control-static"><?php echo $loan['l_phone'];?></p>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-4"><label class=" form-control-label">Địa chỉ</label></div>
                                <div class="col-12 col-md-8">
                                    <p class="form-control-static"><?php echo $loan['l_address'];?></p>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-4"><label class=" form-control-label">Nghề nghiệp</label></div>
                                <div class="col-12 col-md-8">
                                    <p class="form-control-static"><?php echo $loan['l_major'];?></p>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-4"><label class=" form-control-label">Người giới thiệu</label></div>
                                <div class="col-12 col-md-8">
                                    <p class="form-control-static">
                                        <?php
                                        if(db_check_exist_account($loan['a_id']))
                                        {
                                            echo '<a href="?m=users&a=details&id='.$loan['a_id'].'" class="text-orange">'.Loan::getCTV($loan['a_id']).'</a>';
                                        }
                                        else{
                                            echo 'N/A';
                                        }
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-4"><label class=" form-control-label">Hoa hồng</label></div>
                                <div class="col-12 col-md-8">
                                <span class="badge badge-info text-lg">+<?php echo number_format($loan['l_money']*0.1);?> VND</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-4"><label class=" form-control-label">Ngày gửi</label></div>
                                <div class="col-12 col-md-8">
                                <p class="form-control-static"><?php echo $loan['l_date'];?></p>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-4"><label for="select" class=" form-control-label">Trạng thái</label></div>
                                <div class="col-12 col-md-8">
                                    <?php
                                    if($loan['l_update'] == 0)
                                    {
                                        ?>
                                        <select name="select" id="select" class="form-control" required="required">
                                            <option value="">Vui lòng chọn</option>
                                            <option value="1">Hủy</option>
                                            <option value="2">Xác nhận</option>
                                        </select>
                                        <?php
                                    }
                                    else
                                    {
                                        echo showStatus($loan['l_status']);
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                            if($loan['l_update'] == 0)
                            {
                                ?>
                                <div>
                                    <button name="frmOrder" value="btn" type="submit" class="btn btn-lg btn-info btn-block" >
                                        <span id="payment-button-amount">Cập nhật</span>
                                    </button>
                                </div>
                                <?php
                            }
                            ?>
                        </form>
                    </div>
                </div>

            </div>
        </div> <!-- .card -->
    </div><!--/.col-->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Lịch sử cập nhật</strong>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <?php
                    $status = Loan::getStatus($id);
                    foreach($status as $item)
                    {
                        ?>
                         <li class="list-group-item">
                            <strong><?php echo nick($item['user_id']);?></strong> 
                            <span><?php echo html_entity_decode($item['status_text']);?></span>
                            <span class="pull-right"><?php echo $item['created_at'];?></span>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div> <!-- .card -->
    </div><!--/.col-->
</div>