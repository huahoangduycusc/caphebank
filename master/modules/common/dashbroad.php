 <?php
 $thongke = new Statistic();
 ?>
 <!-- Widgets  -->
 <div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-1">
                        <i class="pe-7s-cash"></i>
                    </div>
                    <div class="stat-content">
                        <div class="text-left dib">
                            <div class="stat-text"><span class="count"><?php echo $thongke->getMoneys();?></span> Tr</div>
                            <div class="stat-heading">Khoản vay</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-2">
                        <i class="pe-7s-cart"></i>
                    </div>
                    <div class="stat-content">
                        <div class="text-left dib">
                            <div class="stat-text"><span class="count"><?php echo $thongke->getOrders();?></span></div>
                            <div class="stat-heading">Đơn vay</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-3">
                        <i class="pe-7s-browser"></i>
                    </div>
                    <div class="stat-content">
                        <div class="text-left dib">
                            <div class="stat-text"><span class="count"><?php echo $thongke->getArticles();?></span></div>
                            <div class="stat-heading">Bài viết</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-4">
                        <i class="pe-7s-users"></i>
                    </div>
                    <div class="stat-content">
                        <div class="text-left dib">
                            <div class="stat-text"><span class="count"><?php echo $thongke->getAccounts();?></span></div>
                            <div class="stat-heading">Cộng tác viên</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Widgets -->
<!-- Orders -->
<div class="orders">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title">Đơn vay mới </h4>
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
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $loans = Loan::getList();
                                foreach($loans as $loan){
                                    ?>
                                    <tr>
                                        <td><a href="?m=orders&a=details&id=<?php echo $loan['loan_id'];?>">#<?php echo $loan['loan_id'];?></a></td>
                                        <td><?php echo $loan['l_fullname'];?></td>
                                        <td><?php echo $loan['l_phone'];?></td>
                                        <td><?php echo number_format($loan['l_money']);?> VND</td>
                                        <td>tjnhloo33</td>
                                        <td><?php echo showStatus($loan['l_status']);?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div> <!-- /.table-stats -->
                </div>
            </div> <!-- /.card -->
            <div class="center">
            <a href="?m=orders&a=overview" class="btn btn-info">Xem thêm</a>
            </div>
        </div>  <!-- /.col-lg-8 -->
    </div>
</div>
<!-- /.orders -->