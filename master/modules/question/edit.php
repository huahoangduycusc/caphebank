<?php
if(!defined("IN_SITE")) die("The request not found");
$q = Question::getRow($id);
if(!$q){
    exit;
}
?>
<div class="container">
    <div class="row">
    <a href="?m=question&a=overview" class="btn btn-primary">Trở về danh sách</a>
    <br/>
    </div>
    <br/>
</div>
<?php
if(isset($_POST['create'])){
    $name = input_post('cquestion');
    $des = input_post('description');
    $data = array(
        'question_name' => $name,
        'question_answer' => $des
    );
    if(db_update('tb_question',$data,array('question_id' => $id))){
        echo'
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            <span class="badge badge-pill badge-success">Success</span>
            Cập nhật mới thành công</b></a>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button></div>';
    }
    else{
        echo '<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
        <span class="badge badge-pill badge-danger">Error</span>
       Có lỗi xảy ra cập nhật câu hỏi.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>';
    }
}
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"><strong>Tạo câu hỏi mới</strong></div>
            <div class="card-body card-block">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="cquestion" class=" form-control-label">Tên câu hỏi</label>
                        <input type="text" id="cquestion" name="cquestion" placeholder="Nhập vào tên" value="<?php echo $q['question_name'];?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="description" class=" form-control-label">Nội dung trả lời</label>
                        <textarea id="description" name="description" class="form-control" placeholder="Nhập vào nội dung" reuired><?php echo $q['question_answer'];?></textarea>
                    </div>
                    <button type="submit" name="create" value="create" class="btn btn-primary btn-lg btn-block">Tạo mới</button>
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