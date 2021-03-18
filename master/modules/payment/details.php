<?php
$loan = Payment::getRow($id);
if(!$loan){
    exit;
}
if(isset($_POST['frmOrder'])){
    $select = isset($_POST['select']) ? abs(intval($_POST['select'])) : 0;
    $lydo = isset($_POST['lydo']) ? Generic::secure($_POST['lydo']) : "";
    $table = "tb_payment";
    $filter = array('payment_id' => $id);
    if($loan['p_update'] != 1){
        if($select == 1){
            $data = array(
                'status' => 1,
                'p_update' => 1,
                'p_reason' => $lydo,
                'p_admin' => $user_id
            );
            update_point("plus",$loan['user_id'],$loan['money']);
            $msg = "Hủy yêu cầu rút tiền #$id sang đã hủy";
        }
        else if($select == 2){
            $data = array(
                'status' => 2,
                'p_update' => 1,
                'p_reason' => $lydo,
                'p_admin' => $user_id
            );
            $msg = "Duyệt yêu cầu rút tiền #$id sang đã gửi";
            
        }
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
                <strong class="card-title">Yêu cầu rút tiền </strong> <?php echo showStatus($loan['status']);?>
            </div>
            <div class="card-body">
                <!-- Credit Card -->
                <div id="pay-invoice">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center">Thông tin giao dịch</h3>
                        </div>
                        <hr>
                        <form action="" method="post">
                            <div class="row form-group">
                                <div class="col col-md-4"><label class=" form-control-label">ID Giao dịch</label></div>
                                <div class="col-12 col-md-8">
                                    <p class="form-control-static"><?php echo $loan['payment_id'];?></p>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-4"><label class=" form-control-label">Người yêu cầu</label></div>
                                <div class="col-12 col-md-8">
                                    <a href="?m=users&a=details&id=<?php echo $loan['user_id'];?>" class="text-orange"><?php echo nick($loan['user_id']);?></a>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-4"><label class=" form-control-label">Số tiền rút</label></div>
                                <div class="col-12 col-md-8">
                                    <span class="badge badge-danger text-lg"><?php echo number_format($loan['money']);?> Point</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-4"><label class=" form-control-label">Hình thức chuyển khoản</label></div>
                                <div class="col-12 col-md-8">
                                    <span><?php echo PaymentMethod::getName($loan['p_method']);?></span>
                                </div>
                            </div>
                            <div class="row form-group">
                                
                                   <?php
                                   $bank = AccountBank::getInfo($loan['user_id']);
                                   if($loan['p_method'] == 1){
                                       ?>
                                       <div class="col col-md-4"><label class=" form-control-label">Tên ngân hàng</label></div>
                                        <div class="col-12 col-md-8">
                                            <span><?php echo $bank['bank_name'];?></span>
                                        </div>
                                        <div class="col col-md-4"><label class=" form-control-label">Chi nhánh</label></div>
                                        <div class="col-12 col-md-8">
                                            <span><?php echo $bank['bank_chinhanh'];?></span>
                                        </div>
                                        <div class="col col-md-4"><label class=" form-control-label">Tên chủ tài khoản</label></div>
                                        <div class="col-12 col-md-8">
                                            <span><?php echo $bank['bank_user'];?></span>
                                        </div>
                                        <div class="col col-md-4"><label class=" form-control-label">Số tài khoản</label></div>
                                        <div class="col-12 col-md-8">
                                            <span><?php echo $bank['bank_number'];?></span>
                                        </div>
                                        <div class="col col-md-4"><label class=" form-control-label">CMND</label></div>
                                        <div class="col-12 col-md-8">
                                            <span><?php echo $bank['bank_cmnd'];?></span>
                                        </div>
                                       <?php
                                   }
                                   else if($loan['p_method'] == 2)
                                   {
                                       ?>
                                       <div class="col col-md-4"><label class=" form-control-label">SDT Momo</label></div>
                                        <div class="col-12 col-md-8">
                                            <span><?php echo $bank['momo'];?></span>
                                        </div>
                                       <?php
                                   }
                                   ?>
                               
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-4"><label class=" form-control-label">Ngày gửi</label></div>
                                <div class="col-12 col-md-8">
                                <p class="form-control-static"><?php echo $loan['created_at'];?></p>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-4"><label for="select" class=" form-control-label">Trạng thái</label></div>
                                <div class="col-12 col-md-8">
                                    <?php
                                    if($loan['p_update'] == 0)
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
                                        echo showStatus($loan['status']);
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-4"><label class=" form-control-label">Lý do</label></div>
                                <div class="col-12 col-md-8">
                                    <textarea name="lydo" class="form-control"><?php echo $loan['p_reason'];?></textarea>
                                </div>
                            </div>
                            <?php
                            if($loan['p_update'] == 0)
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
                    <li class="list-group-item">
                        <strong><a href="?m=users&a=details&id=<?php echo $loan['p_admin'];?>" class="text-orange"><?php echo nick($loan['p_admin']);?></a></strong> 
                        <span>đã xử lý yêu cầu này.</span>
                    </li>
                     
                </ul>
            </div>
        </div> <!-- .card -->
    </div><!--/.col-->
</div>