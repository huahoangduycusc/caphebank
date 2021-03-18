<?php
if(!defined("IN_SITE")) die("The request not found");
?>
<div class="row">
    <div class="col-6"><a href="?m=system&a=createSlide" class="btn btn-primary">Thêm mới</a></div>
</div>
<br>
<!-- row -->
<div class="orders">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title">Danh sách slide trang web </h4>
                </div>
                <div class="card-body--">
                    <div class="table-stats order-table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Hỉnh ảnh</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $loans = Slide::getList();
                                foreach($loans as $loan){
                                    ?>
                                    <tr id="row<?php echo $loan['slide_id'];?>">
                                        <td style="width:150px;">
                                            <img src="<?php echo homeurl().$loan['slide_name'];?>" style="width:100%" /></a>
                                        </td>
                                        <td>
                                        <?php
                                        if($loan['status'] == 0){
                                            echo '<font color="green">Hiển thị</font>';
                                        }
                                        else if($loan['status'] == 1){
                                            echo '<font color="blue">Đã ẩn</font>';
                                        }
                                        ?>
                                        </td>
                                        <td>
                                        <a href="" data-slide="<?php echo $loan['slide_id'];?>" class="btn-sm btn-info">Ẩn/Hiện</a>
                                        <a href="<?php echo $loan['slide_id'];?>" data-id="<?php echo $loan['slide_id'];?>" class="btn-sm btn-danger">Xóa</a>
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
            $demtrang = db_count('tb_slides','slide_id');
            $config = [
                'total' => $demtrang,
                'querys' => $id,
                'limit' => $limit,
                'url' => 'master/?m=system&a=slide&'
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
<script src="modules/system/app.js"></script>