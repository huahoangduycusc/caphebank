<?php
if(!Account::getRow($id)){
     exit;
}
$user = Account::getRow($id);
?>
<div class="box-title">Chi tiết</div>
<div class="row">
    <div class="col-md-4">
        <aside class="profile-nav alt">
            <section class="card">
                <div class="card-header user-header alt bg-dark">
                    <div class="media">
                        <a href="#">
                            <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="images/admin.jpg">
                        </a>
                        <div class="media-body">
                            <h2 class="text-light display-6"><?php echo $user['a_username'];?></h2>
                            <p><?php echo $user['a_fullname'];?></p>
                        </div>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                    Số dư : <?php echo number_format($user['a_point']);?> Point
                    </li>
                    <li class="list-group-item">
                    Địa chỉ : <?php echo $user['a_address'];?>
                    </li>
                    <li class="list-group-item">
                        Điện thoại : <?php echo $user['a_phone'];?>
                    </li>
                    <li class="list-group-item">
                        Email : <?php echo $user['a_email'];?>
                    </li>
                    <li class="list-group-item">
                        Giới tính : <?php echo gender($user['a_gender']);?>
                    </li>
                </ul>

            </section>
        </aside>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-dark">
                <strong class="card-title text-light">Lịch sử hoạt động</strong>
                <a href="" class="pull-right text-light">Xem thêm</a>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <?php
                    $log = AccountLog::getList($id);
                    foreach($log as $item)
                    {
                        ?>
                            <li class="list-group-item">
                            <span><?php echo $item['log_text'];?></span>
                            <span class="pull-right"><?php echo $item['created_at'];?></span>
                        </li>
                        <?php
                    }
                    if(count($log) == 0){
                        echo '<div class="alert alert-warning">Chưa có dữ liệu nào!</div>';
                    }
                    ?>
                </ul>
            </div>
        </div> <!-- .card -->
    </div><!--/.col-->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-dark">
                <strong class="card-title text-light">Lịch sử rút tiền</strong>
                <a href="" class="pull-right text-light">Xem thêm</a>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <?php
                    $log = AccountLog::getList($id,1);
                    foreach($log as $item)
                    {
                        ?>
                            <li class="list-group-item">
                            <span><?php echo $item['log_text'];?></span>
                            <span class="pull-right"><?php echo $item['created_at'];?></span>
                        </li>
                        <?php
                    }
                    if(count($log) == 0){
                        echo '<div class="alert alert-warning">Chưa có dữ liệu nào!</div>';
                    }
                    ?>
                </ul>
            </div>
        </div> <!-- .card -->
    </div><!--/.col-->
</div>
<div class="orders">
<div class="card">
    <div class="card-body">
        <h4 class="box-title">Danh sách đơn đã giới thiệu </h4>
    </div>
    <div class="card-body--">
        <div class="table-stats order-table">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Họ tên</th>
                        <th>SDT</th>
                        <th>Số tiền</th>
                        <th>Cộng tác viên</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $loans = Loan::getList($id);
                    foreach($loans as $loan){
                        ?>
                        <tr id="row<?php echo $loan['loan_id'];?>">
                            <td><a href="?m=orders&a=details&id=<?php echo $loan['loan_id'];?>">#<?php echo $loan['loan_id'];?></a></td>
                            <td><?php echo $loan['l_fullname'];?></td>
                            <td><?php echo $loan['l_phone'];?></td>
                            <td><?php echo number_format($loan['l_money']);?> Tr</td>
                            <td><a href="" class="text-orange"><?php echo nick($loan['a_id']);?></a></td>
                            <td><?php echo showStatus($loan['l_status']);?></td>
                            <td>
                            <a href="?m=orders&a=details&id=<?php echo $loan['loan_id'];?>" class="btn-sm btn-info">Xem</a>
                            <a href="<?php echo $loan['loan_id'];?>" data-id="<?php echo $loan['loan_id'];?>" class="btn-sm btn-danger">Xóa</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div> <!-- /.table-stats -->
    </div>
</div> <!-- /.card -->
</div>