<div class="box-title">Danh sách liên hệ</div>
<div class="container">
    <div class="row">
    <a href="?m=contact&a=create" class="btn btn-primary">Thêm mới</a>
    <br/>
    </div>
    <br/>
</div>
<div class="orders">
    <div class="card">
        <div class="card-body">
            <h4 class="box-title">Danh sách</h4>
        </div>
        <div class="card-body--">
            <div class="table-stats order-table">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tên</th>
                            <th>SDT</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $list = Contact::getList();
                        foreach($list as $item){
                            ?>
                        <tr id="row<?php echo $item['contact_id'];?>">
                            <td><?php echo $item['contact_name'];?></td>
                            <td><?php echo $item['contact_phone'];?></td>
                            <td>
                                <a href="?m=contact&a=edit&id=<?php echo $item['contact_id'];?>"
                                    class="btn-sm btn-warning">Sửa</a>
                                <a href="<?php echo $item['contact_id'];?>" data-id="<?php echo $item['contact_id'];?>"
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
</div>
<script src="modules/contact/app.js"></script>