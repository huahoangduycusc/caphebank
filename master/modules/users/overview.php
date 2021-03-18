<div class="box-title">Danh sách</div>
<div class="orders">
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
                            <th>Username</th>
                            <th>Họ tên</th>
                            <th>SDT</th>
                            <th>Email</th>
                            <th>Số dư (VNĐ)</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $list = Account::getList();
                        foreach($list as $item){
                            ?>
                        <tr id="row<?php echo $item['account_id'];?>">
                            <td><?php echo $item['account_id'];?></td>
                            <td><a href="?m=users&a=details&id=<?php echo $item['account_id'];?>"
                                    class="text-orange"><?php echo nick($item['account_id']);?></a></td>
                            <td><?php echo $item['a_fullname'];?></td>
                            <td><?php echo $item['a_phone'];?></td>
                            <td><?php echo $item['a_email'];?></td>
                            <td><?php echo number_format($item['a_point']);?> Point</td>
                            <td>
                                <a href="?m=users&a=details&id=<?php echo $item['account_id'];?>"
                                    class="btn-sm btn-info">Xem</a>
                                <a href="<?php echo $item['account_id'];?>" data-id="<?php echo $item['account_id'];?>"
                                    class="btn-sm btn-danger">Xóa</a>
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
    $demtrang = db_count('account','account_id');
    $config = [
        'total' => $demtrang,
        'querys' => $id,
        'limit' => $limit,
        'url' => 'master/?m=users&a=overview&'
    ];
    $page1 = new Pagination($config);
    ?>
    <?php
    if($demtrang > $limit)
    {
        echo'<div><center><ul class="pagination">'.$page1->getPagination().'</ul></center></div>';
    }
    ?>
</div>
<script src="modules/users/app.js"></script>