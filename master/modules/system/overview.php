<?php
if(!defined("IN_SITE")) die("The request not found");
$system = System::getInfo();
?>
<?php
if(isset($_POST['create'])){
    $title = input_post('title');
    $email = input_post('email');
    $phone = input_post('phone');
    $address = input_post('address');
    $description = input_post('description');
    $keyword = input_post('keyword');
    $copyright = input_post('copyright');
    $data = array(
        'title' => $title,
        'email' => $email,
        'address' => $address,
        'phone' => $phone,
        'copyright' => $copyright,
        'description' => $description,
        'phone' => $phone,
        'keyword' => $keyword
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
            <div class="card-header"><strong>Thông tin chung</strong></div>
            <div class="card-body card-block">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title" class=" form-control-label">Tiêu đề trang web</label>
                        <input type="text" id="title" name="title" placeholder="Nhập vào tiêu đề" class="form-control" value="<?php echo $system['title'];?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email" class=" form-control-label">Email</label>
                        <input type="email" id="email" name="email" placeholder="Nhập vào email" class="form-control" value="<?php echo $system['email'];?>" required>
                    </div>
                    <div class="form-group">
                        <label for="phone" class=" form-control-label">Hotline</label>
                        <input type="text" id="phone" name="phone" placeholder="Nhập vào điện thoại" class="form-control" value="<?php echo $system['phone'];?>" required>
                    </div>
                    <div class="form-group">
                        <label for="address" class=" form-control-label">Địa chỉ</label>
                        <textarea id="address" name="address" class="form-control" placeholder="Nhập vào địa chỉ" reuired ><?php echo $system['address'];?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="description" class=" form-control-label">Mô tả trang web</label>
                        <textarea id="description" name="description" class="form-control" placeholder="Nhập vào nội dung" reuired ><?php echo $system['description'];?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="keyword" class=" form-control-label">Keywords</label>
                        <input type="text" id="keyword" name="keyword" placeholder="Từ khóa trang web" class="form-control" value="<?php echo $system['keyword'];?>" required>
                    </div>
                    <div class="form-group">
                        <label for="copyright" class=" form-control-label">Copyright</label>
                        <input type="text" id="copyright" name="copyright" placeholder="" class="form-control" value="<?php echo $system['copyright'];?>" required>
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