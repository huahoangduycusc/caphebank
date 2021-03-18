<div class="box-title">Danh sách câu hỏi</div>
<div class="container">
    <div class="row">
    <a href="?m=question&a=create" class="btn btn-primary">Thêm mới</a>
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
                            <th>Câu hỏi</th>
                            <th>Trả lời</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $list = Question::getList();
                        foreach($list as $item){
                            ?>
                        <tr id="row<?php echo $item['question_id'];?>">
                            <td><?php echo $item['question_name'];?></td>
                            <td><?php echo $item['question_answer'];?></td>
                            <td>
                                <a href="?m=question&a=edit&id=<?php echo $item['question_id'];?>"
                                    class="btn-sm btn-warning">Sửa</a>
                                <a href="<?php echo $item['question_id'];?>" data-id="<?php echo $item['question_id'];?>"
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
<script src="modules/question/app.js"></script>