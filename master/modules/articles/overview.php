<?php
if(!defined("IN_SITE")) die("The request not found");
switch($do){
    case 'delete':
        if(Article::delete($id) == true){
            $message = "<div class='success'>Xóa bài viết thành công !</div>";
        }
        else{
            $message = "<div class='error'>Xảy ra lỗi khi xóa !</div>";
        }
        break;
        exit;
}
?>
<div class="box-title">Danh sách</div>
<div class="orders">
    <div class="card">
        <div class="card-body">
            <h4 class="box-title">Danh sách bài viết</h4>
        </div>
        <div class="card-body--">
            <div class="table-stats order-table">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Ảnh đại diện</th>
                            <th>Tiêu đề</th>
                            <th>Tác giả</th>
                            <th>Lượt xem</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $list = Article::getList();
                        foreach($list as $item){
                            ?>
                        <tr id="row<?php echo $item['article_id'];?>">
                            <td style="width:120px;">
                                <a href="<?php echo Article::rewriteUrl($item['article_id']);?>">
                                <img src="<?php echo homeurl().$item['thumbnail'];?>" style="width:100%" /></a>
                            </td>
                            <td style="width:30%">
                                <a href="<?php echo Article::rewriteUrl($item['article_id']);?>"><?php echo $item['article_name'];?></a>
                            </td>
                            <td>
                                <a href="<?php echo homeurl();?>user/?id=<?php echo $item['account_id'];?>"><?php echo nick($item['account_id']);?></a>
                            </td>
                            <td><?php echo $item['view'];?></td>
                            <td>
                                <?php
                                if($item['status'] == 0){
                                    echo '<font color="green">Hiển thị</font>';
                                }
                                else if($item['status'] == 1){
                                    echo '<font color="red">Đã ẩn</font>';
                                }
                                ?>
                            </td>
                            <td><?php echo $item['created_at'];?></td>
                            <td>
                                <a href="<?php echo homeurl();?>news.php?id=<?php echo $item['article_id'];?>"
                                    class="btn-sm btn-info">Xem</a>
                                <a href="?m=articles&a=edit&id=<?php echo $item['article_id'];?>"
                                class="btn-sm btn-warning">Sửa</a>
                                <a href="<?php echo $item['article_id'];?>" data-id="<?php echo $item['article_id'];?>"
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
    $demtrang = db_count('tb_article','article_id');
    $config = [
        'total' => $demtrang,
        'querys' => $id,
        'limit' => $limit,
        'url' => 'master/?m=articles&a=overview&'
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
<script src="modules/articles/app.js"></script>