<?php
if(!defined("IN_SITE")) die("The request not found");
?>
<style>
.preview-img{
    display: block;
    width: 150px;
    margin: 0 auto;
}
</style>
<?php
if(isset($_POST['create'])){
    $title = input_post('title');
    $description = input_post('description');
    $status = input_post('status');
    $extension = array("jpeg","jpg","png");
    if($_FILES['thumbnail']['name'] != ''){
        $path = $_FILES['thumbnail']['name'];
        $ext = pathinfo($path,PATHINFO_EXTENSION);
        if(in_array($ext,$extension)){
            $filename = '../public/thumbnail/'.time().'.'.$ext;
            move_uploaded_file($_FILES['thumbnail']['tmp_name'],$filename);
            $data = array(
                'article_name' => $title,
                'description' => $description,
                'thumbnail' => "public/thumbnail/".time().".$ext",
                'view' => 0,
                'status' => $status,
                'account_id' => $user_id,
                'created_at' => date('Y-m-d H:m:s')
            );
            if(db_insert('tb_article',$data)){
                $rid = db_get_insert_id();
                echo'
                <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                    <span class="badge badge-pill badge-success">Success</span>
                    Tạo chủ đề mới thành công <a href="'.homeurl('news.php?id='.$rid).'"><b>'.$title.'</b></a>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button></div>';
            }
            else{
                echo '<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                <span class="badge badge-pill badge-danger">Error</span>
               Có lỗi xảy ra khi tạo chủ đề này.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>';
            }
        }
    }
}
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"><strong>Tạo chủ đề mới</strong></div>
            <div class="card-body card-block">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title" class=" form-control-label">Tiêu đề</label>
                        <input type="text" id="title" name="title" placeholder="Nhập vào tiêu đề" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="description" class=" form-control-label">Nội dung</label>
                        <textarea id="description" name="description" class="form-control" placeholder="Nhập vào nội dung" reuired ></textarea>
                    </div>
                    <div class="form-group">
                        <label for="status" class=" form-control-label">Trạng thái</label>
                        <div class="col-5">
                            <select name="status" id="status" class="form-control">
                                <option value="0">Hiển thị</option>
                                <option value="1">Tạm ẩn</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="thumbnail" class=" form-control-label">Ảnh đại diện</label>
                        <input type="file" id="thumbnail" name="thumbnail" class="form-control" onchange="previewFile();" required>
                    </div>
                    <div class="form-group">
                        <img id="previewImg" src="/examples/images/transparent.png" alt="Placeholder" class="preview-img">
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
<script>
    function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];
 
        if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
                $("#previewImg").attr("src", reader.result);
            }
 
            reader.readAsDataURL(file);
        }
    }
</script>