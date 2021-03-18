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
    $status = input_post('status');
    $extension = array("jpeg","jpg","png");
    if($_FILES['thumbnail']['name'] != ''){
        $path = $_FILES['thumbnail']['name'];
        $ext = pathinfo($path,PATHINFO_EXTENSION);
        if(in_array($ext,$extension)){
            $filename = '../public/slide/'.time().'.'.$ext;
            move_uploaded_file($_FILES['thumbnail']['tmp_name'],$filename);
            $data = array(
                'slide_name' => "public/slide/".time().".$ext",
                'status' => $status,
            );
            if(db_insert('tb_slides',$data)){
                $rid = db_get_insert_id();
                echo'
                <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                    <span class="badge badge-pill badge-success">Success</span>
                    Thêm thành công
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button></div>';
            }
            else{
                echo '<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                <span class="badge badge-pill badge-danger">Error</span>
               Có lỗi xảy ra khi thêm slide...
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
            <div class="card-header"><strong>Thêm slide mới</strong></div>
            <div class="card-body card-block">
                <form action="" method="post" enctype="multipart/form-data">
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