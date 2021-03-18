<?php
$for = isset($_GET['for']) ? htmlspecialchars($_GET['for']) : false;
$type = isset($_GET['type']) ? abs(intval($_GET['type'])) : 0;
?>
<div class="row">
    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-1">
            <div class="card-body">
                <div class="card-left pt-1 float-left">
                    <h3 class="mb-0 fw-r">
                        <span class="count"><?php echo db_count('loan','loan_id');?></span>
                    </h3>
                    <p class="text-light mt-1 m-0">Tất cả đơn</p>
                </div><!-- /.card-left -->

                <div class="card-right float-right text-right">
                    <i class="icon fade-5 icon-lg pe-7s-cart"></i>
                </div><!-- /.card-right -->

            </div>

        </div>
    </div>
    <!--/.col-->

    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-6">
            <div class="card-body">
                <div class="card-left pt-1 float-left">
                    <h3 class="mb-0 fw-r">
                        <span class="count"><?php echo db_count('loan','loan_id',array('l_status' => 2));?></span>
                    </h3>
                    <p class="text-light mt-1 m-0">Đơn thành công</p>
                </div><!-- /.card-left -->

                <div class="card-right float-right text-right">
                    <i class="icon fade-5 icon-lg fa fa-check-square-o"></i>
                </div><!-- /.card-right -->

            </div>

        </div>
    </div>
    <!--/.col-->

    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-3">
            <div class="card-body">
                <div class="card-left pt-1 float-left">
                    <h3 class="mb-0 fw-r">
                        <span class="count"><?php echo db_count('loan','loan_id',array('l_status' => 1));?></span>
                    </h3>
                    <p class="text-light mt-1 m-0">Đơn đã hủy</p>
                </div><!-- /.card-left -->

                <div class="card-right float-right text-right">
                    <i class="icon fade-5 icon-lg fa fa-times"></i>
                </div><!-- /.card-right -->

            </div>

        </div>
    </div>
    <!--/.col-->

    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-2">
            <div class="card-body">
                <div class="card-left pt-1 float-left">
                    <h3 class="mb-0 fw-r">
                        <span class="count"><?php echo db_count('loan','loan_id',array('l_status' => '0'));?></span>
                    </h3>
                    <p class="text-light mt-1 m-0">Chờ xử lý</p>
                </div><!-- /.card-left -->

                <div class="card-right float-right text-right">
                    <i class="icon fade-5 icon-lg fa fa-spinner"></i>
                </div><!-- /.card-right -->

            </div>

        </div>
    </div>
    <!--/.col-->
</div>
<!-- row -->
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link <?php echo ($type == 0 ? 'active' : '');?>" href="?m=orders&a=overview&type=0">Tất cả</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo ($type == 3 ? 'active' : '');?>" href="?m=orders&a=overview&type=3">Thành công</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo ($type == 1 ? 'active' : '');?>" href="?m=orders&a=overview&type=1">Chờ</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo ($type == 2 ? 'active' : '');?>" href="?m=orders&a=overview&type=2">Hủy</a>
    </li>
</ul>
<!-- Orders -->
<div class="orders">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title">Danh sách </h4>
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
                                $loans = Loan::getListPagin($type);
                                foreach($loans as $loan){
                                    ?>
                                    <tr id="row<?php echo $loan['loan_id'];?>">
                                        <td><a href="?m=orders&a=details&id=<?php echo $loan['loan_id'];?>">#<?php echo $loan['loan_id'];?></a></td>
                                        <td><?php echo $loan['l_fullname'];?></td>
                                        <td><?php echo $loan['l_phone'];?></td>
                                        <td><?php echo number_format($loan['l_money']);?> VND</td>
                                        <td><a href="?m=users&a=details&id=<?php echo $loan['a_id'];?>" class="text-orange"><?php echo nick($loan['a_id']);?></a></td>
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
            <?php
            if($type == 0){
                $demtrang = db_count('loan','loan_id');
            }
            else if($type == 1){
                $demtrang = db_count('loan','loan_id',array('l_status' => '0'));
            }
            else if($type == 2){
                $demtrang = db_count('loan','loan_id',array('l_status' => 1));
            }
            else if($type == 3){
                $demtrang = db_count('loan','loan_id',array('l_status' => 2));
            }
            $config = [
                'total' => $demtrang,
                'querys' => $id,
                'limit' => $limit,
                'url' => 'master/?m=orders&a=overview&type='.$type.'&'
            ];
            $page1 = new Pagination($config);
            if($demtrang > $limit)
            {
                echo'<div><center><ul class="pagination">'.$page1->getPagination().'</ul></center></div>';
            }
            ?>
        </div>  <!-- /.col-lg-8 -->
    </div>
</div>
<!-- /.orders -->
<script src="modules/orders/app.js"></script>