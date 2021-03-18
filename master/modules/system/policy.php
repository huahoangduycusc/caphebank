<?php
if(!defined("IN_SITE")) die("The request not found");
$system = System::getInfo();
?>
<?php
if(isset($_POST['create'])){
    $description = input_post('description');
    $data = array(
        'chinhsach' => $description,
    );
    $where = array('system_id' => $system['system_id']);
    if(db_update('tb_system',$data,$where)){
        echo'
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            <span class="badge badge-pill badge-success">Success</span>
            Cập nhật thành công
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button></div>';
    }
    else{
        echo '<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
        <span class="badge badge-pill badge-danger">Error</span>
       Có lỗi xảy ra khi cập nhật thông tin.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>';
    }
    $system = System::getInfo();
}
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"><strong>Chính sách</strong></div>
            <div class="card-body card-block">
                <form action="" method="post">
                    <div class="form-group">
                        <textarea id="description" name="description" class="form-control" placeholder="Nhập vào nội dung" reuired >
                            <?php echo $system['chinhsach'];?>
                        </textarea>
                    </div>
                    <button type="submit" name="create" value="create" class="btn btn-primary btn-lg btn-block">Cập nhật</button>
                </form>
            </div>
        </div>
        <!-- card -->
    </div>
    <!-- col -->
</div>
<!-- end row -->
<script src="<?php echo homeurl();?>/js/ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description');
</script>