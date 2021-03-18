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
                        <span class="count"><?php echo db_count('tb_payment','payment_id');?></span>
                    </h3>
                    <p class="text-light mt-1 m-0">Tất cả yêu cầu</p>
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
                        <span class="count"><?php echo db_count('tb_payment','payment_id',array('status' => 2));?></span>
                    </h3>
                    <p class="text-light mt-1 m-0">Đã xử lý</p>
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
                        <span class="count"><?php echo db_count('tb_payment','payment_id',array('status' => 1));?></span>
                    </h3>
                    <p class="text-light mt-1 m-0">Đã hủy</p>
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
                        <span class="count"><?php echo db_count('tb_payment','payment_id',array('status' => '0'));?></span>
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
        <a class="nav-link <?php echo ($type == 0 ? 'active' : '');?>" href="?m=payment&a=overview&type=0">Tất cả</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo ($type == 3 ? 'active' : '');?>" href="?m=payment&a=overview&type=3">Đã duyệt
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo ($type == 1 ? 'active' : '');?>" href="?m=payment&a=overview&type=1">Chờ</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo ($type == 2 ? 'active' : '');?>" href="?m=payment&a=overview&type=2">Hủy</a>
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
                                    <th>Cộng tác viên</th>
                                    <th>Số tiền</th>
                                    <th>Hình thức</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $loans = Payment::getListPagin($type);
                                foreach($loans as $loan){
                                    ?>
                                    <tr id="row<?php echo $loan['payment_id'];?>">
                                        <td><a href="?m=payment&a=details&id=<?php echo $loan['payment_id'];?>">#<?php echo $loan['payment_id'];?></a></td>
                                        <td><a href="?m=users&a=details&id=<?php echo $loan['user_id'];?>" class="text-orange"><?php echo nick($loan['user_id']);?></a></td>
                                        <td><?php echo number_format($loan['money']);?> VND</td>
                                        <td><?php echo PaymentMethod::getName($loan['p_method']);?></td>
                                        <td><?php echo showStatus($loan['status']);?></td>
                                        <td>
                                        <a href="?m=payment&a=details&id=<?php echo $loan['payment_id'];?>" class="btn-sm btn-info">Xem</a>
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
                $demtrang = db_count('tb_payment','payment_id');
            }
            else if($type == 1){
                $demtrang = db_count('tb_payment','payment_id',array('status' => '0'));
            }
            else if($type == 2){
                $demtrang = db_count('tb_payment','payment_id',array('status' => 1));
            }
            else if($type == 3){
                $demtrang = db_count('tb_payment','payment_id',array('status' => 2));
            }
            $config = [
                'total' => $demtrang,
                'querys' => $id,
                'limit' => $limit,
                'url' => 'master/?m=payment&a=overview&type='.$type.'&'
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