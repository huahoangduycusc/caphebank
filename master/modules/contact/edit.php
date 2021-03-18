<?php
if(!defined("IN_SITE")) die("The request not found");
$contact = Contact::getRow($id);
if(!$contact){
    exit;
}
?>
<div class="container">
    <div class="row">
    <a href="?m=contact&a=overview" class="btn btn-primary">Trở về danh sách</a>
    <br/>
    </div>
    <br/>
</div>
<?php
if(isset($_POST['create'])){
    $name = input_post('cname');
    $phone = input_post('cphone');
    $data = array(
        'contact_name' => $name,
        'contact_phone' => $phone
    );
    if(db_update('tb_contact',$data,array('contact_id' => $id))){
        echo'
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            <span class="badge badge-pill badge-success">Success</span>
            Chỉnh sửa liên hệ thành công</b></a>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button></div>';
    }
    else{
        echo '<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
        <span class="badge badge-pill badge-danger">Error</span>
       Có lỗi xảy ra khi chỉnh sửa liên hệ này .
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>';
    }
    $contact = Contact::getRow($id);
}
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"><strong>Chỉnh sửa liên hệ</strong></div>
            <div class="card-body card-block">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="cname" class=" form-control-label">Tên người liên hệ</label>
                        <input type="text" id="cname" name="cname" value="<?php echo $contact['contact_name'];?>" placeholder="Nhập vào tên" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="cphone" class=" form-control-label">Số điện thoại</label>
                        <input type="number" id="cphone" name="cphone" value="<?php echo $contact['contact_phone'];?>" placeholder="Nhập vào số điện thoại" class="form-control" required>
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