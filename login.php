<?php
error_reporting(0);
$rootpath = '';
define('IN_SITE',true);
require_once('lib/core.php');
if($user_id){
    redirect(homeurl());
}
$error = array();
if(isset($_POST['login'])){
    $username = input_post('username');
    $password = input_post('password');
    $username = addslashes($username);
    $password = addslashes($password);
    $token = input_post('token');
    // check username
    if(empty($username)){
        $error['result'] = 'Bạn chưa nhập tên đăng nhập';
    }
    if(empty($password)){
        $error['result'] = 'Bạn chưa nhập mật khẩu';
    }
    if(!csrf::validate_token($token)){
        $error['result'] = 'The request is not valid';
    }
    if(!$error){
        $user = db_user_get_by_username($username);
        // if empty
        if(empty($user)){
            $error['result'] = 'Tên đăng nhập không tồn tại';
        }
        else if(password_verify($password,$user['a_password']) == false){
            $error['result'] = 'Mật khẩu không chính xác!';
        }
        // if no error
        if(!$error){
            $_SESSION['uid'] = $user['account_id'];
            redirect(homeurl().'publisher');
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
    <link rel="stylesheet" href="./theme/style.css" type="text/css">
</head>
<body>
    <div class="signup">
        <h1 class="signup-heading">Đăng nhập</h1>
        <form action="" method="post" autocomplete="off">
            <?php
            if($error){
                showError($error,'result');
            }
            ?>
            <label for="username" class="signup-label">Tài khoản</label>
            <input type="text" id="username" name="username" class="signup-input" value="<?php echo (isset($username) ? $username : ''); ?>">
            <label for="password" class="signup-label">Mật khẩu</label>
            <input type="password" id="password" name="password" class="signup-input" value="<?php echo (isset($password) ? $password : ''); ?>">
            <?php csrf::create_token(); ?>
            <button class="submit success" type="submit" name="login">Đăng nhập</button>
        </form>
        <p class="signup-already">
            <span>Bạn chưa có tài khoản ?</span>
            <a href="<?php echo homeurl();?>register" class="signup-login-link">Đăng ký</a>
        </p>
    </div>
</body>
</html>