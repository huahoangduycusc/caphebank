<?php
error_reporting(0);
define('IN_SITE','TRUE');
$rootpath = '';
require_once('lib/core.php');
if($user_id){
    redirect(homeurl());
}
$error = array();
$ctv = 0;
if($id && Account::checkExist($id)){
    $ctv = $id;
}
if(isset($_POST['register'])){
    $regex = "/[^a-zA-Z0-9]+/";
    $regexPhone = "/[^0-9]/";
    $username = input_post('username');
    $password = input_post('password');
    $fullname = input_post('fullname');
    $email = input_post('email');
    $phone = input_post('phone');
    $username = addslashes($username);
    $password = addslashes($password);
    $fullname = addslashes($fullname);
    $email = addslashes($email);
    $phone = addslashes($phone);
    $token = input_post('token');
    // check username
    if(empty($username)){
        $error['result'] = 'Bạn chưa nhập tên đăng nhập';
    }
    if(empty($password)){
        $error['result'] = 'Bạn chưa nhập mật khẩu';
    }
    if(empty($fullname)){
        $error['result'] = 'Bạn chưa nhập họ tên';
    }
    if(empty($email)){
        $error['result'] = 'Bạn chưa nhập email';
    }
    if(empty($phone)){
        $error['result'] = 'Bạn chưa nhập số điện thoại';
    }
    if(preg_match($regex,$username)){
        $error['result'] = 'Tên tài khoản không hợp lệ, phải là chữ cái hoặc số và không chứa ký tự đặc biệt.';
    }
    if(strlen($username) < 6 || strlen($username) > 16){
        $error['result'] = 'Chiều dài của tài khoản phải từ 6 đến 16 ký tự ';
    }
    if(preg_match($regexPhone,$phone)){
        $error['result'] = 'Số điện thoại không hợp lệ, vui lòng nhập lại';
    }
    if(isset($email) && filter_var($email,FILTER_VALIDATE_EMAIL) == false){
        $error['result'] = 'Địa chỉ email không hợp lệ !';
    }
    if(!csrf::validate_token($token)){
        $error['result'] = 'The request is not valid';
    }
    if(!$error){
        $user = db_user_get_by_username($username);
        // if empty
        if(!empty($user)){
            $error['result'] = 'Tên tài khoản đã được đăng ký, vui lòng sử dụng tên khác !';
        }
        $emailCheck = db_get_email($email);
        if($emailCheck != 0){
            $error['result'] = 'Email này đã được đăng ký cho 1 tài khoản khác.';
        }
        // if no error
        if(!$error){
            $data = array(
                'account_id' => null,
                'a_username' => $username,
                'a_password' => password_hash($password,PASSWORD_DEFAULT),
                'a_email' => $email,
                'a_fullname' => $fullname,
                'a_gender' => 0,
                'a_address' => '',
                'a_phone' => $phone,
                'a_point' => 0,
                'a_online' => time(),
                'a_avatar' => 'public/profile/default.png',
                'a_intro' => '',
                'a_ctv' => $ctv,
                'a_right' => 0,
            );
            if(db_insert('account',$data)){ 
                $_SESSION['uid'] = db_get_insert_id();
                AccountBank::createNew($_SESSION['uid']);
                redirect(homeurl().'publisher');
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo homeurl();?>theme/style.css" type="text/css">
</head>
<body>
    <div class="signup">
        <h1 class="signup-heading">Đăng ký</h1>
        <form action="" method="post" autocomplete="off">
            <?php
            if($error){
                showError($error,'result');
            }
            ?>
            <label for="username" class="signup-label">Tên tài khoản</label>
            <input type="text" id="username" name="username" class="signup-input" value="<?php echo (isset($username)) ? $username : '';?>" required>
            <label for="password" class="signup-label">Mật khẩu</label>
            <input type="password" id="password" name="password" class="signup-input" value="<?php echo (isset($password)) ? $password : '';?>" required>
            <label for="fullname" class="signup-label">Họ tên</label>
            <input type="text" id="fullname" name="fullname" class="signup-input" value="<?php echo (isset($fullname)) ? $fullname : '';?>" required>
            <label for="email" class="signup-label">Email</label>
            <input type="email" id="email" name="email" class="signup-input" value="<?php echo (isset($email)) ? $email : '';?>" required>
            <label for="phone" class="signup-label">Số điện thoại</label>
            <input type="text" id="phone" name="phone" class="signup-input" value="<?php echo (isset($phone)) ? $phone : '';?>" required>
            <?php csrf::create_token(); ?>
            <button class="submit primary" name="register" type="submit">Đăng ký</button>
        </form>
        <p class="signup-already">
            <span>Bạn đã có tài khoản ?</span>
            <a href="<?php echo homeurl();?>dang-nhap.html" class="signup-login-link">Đăng nhập</a>
        </p>
    </div>
</body>
</html>