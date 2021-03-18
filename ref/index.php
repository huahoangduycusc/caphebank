<?php
error_reporting(0);
define('IN_SITE',true);
require_once('../lib/core.php');
$ctv = 0;
if(db_check_exist_account($id)){
    LoanStatistic::checkExist($id);
    $row = Account::getCTV($id);
    $ctv = $row['a_ctv'];
}
$error = array();
if(isset($_POST['sm_loan'])){
    $regexPhone = "/[^0-9]/";
    $fullname = input_post('fullname');
    $address = input_post('address');
    $phone = input_post('phone');
    $birthday = input_post('birthday');
    $cmnd = input_post('cmnd');
    $major = input_post('major');
    $money = input_post('money');
    $token = input_post('token');
    // check username
    if(empty($fullname)){
        $error['result'] = 'Bạn chưa nhập họ tên';
    }
    else if(empty($address)){
        $error['result'] = 'Bạn chưa chọn địa chỉ';
    }
    else if(empty($phone)){
        $error['result'] = 'Bạn chưa nhập số điện thoại';
    }
    else if(empty($birthday)){
        $error['result'] = 'Bạn chưa nhập ngày tháng năm sinh';
    }
    else if(empty($cmnd)){
        $error['result'] = 'Bạn chưa nhập số chứng minh nhân dân';
    }
    else if(empty($major)){
        $error['result'] = 'Bạn chưa nhập nghề nghiệp';
    }
    else if(empty($money)){
        $error['result'] = 'Bạn chưa nhập số tiền cần vay';
    }
    else if(preg_match($regexPhone,$phone)){
        $error['result'] = 'Số điện thoại bạn nhập không hợp lệ';
    }
    else if(preg_match($regexPhone,$cmnd)){
        $error['result'] = 'Chứng mình nhân dân bạn nhập không hợp lệ';
    }
    else if(preg_match($regexPhone,$money)){
        $error['result'] = 'Số tiền bạn nhập không hợp lệ';
    }
    else if(!LoanMoney::checkMoney($money)){
        $error['result'] = 'Chúng tôi phát hiện bạn đang cố phá hệ thống.';
    }
    else if(!csrf::validate_token($token)){
        $error['result'] = 'The request is not valid';
    }
    if(!$error){
        $data = array(
            'loan_id' => null,
            'l_fullname' => $fullname,
            'l_address' => $address,
            'l_phone' => $phone,
            'l_birthday' => "$birthday",
            'l_cmnd' => $cmnd,
            'l_major' => $major,
            'l_money' => LoanMoney::getValue($money),
            'l_date' => date("Y/m/d H:m:s"),
            'a_id' => $id,
            'c_id' => $ctv,
            'l_status' => 0,
            'l_update' => 0,
        );
        if(db_insert('loan',$data)){ 
            redirect(homeurl()."ref/thanh-cong.html");
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo homeurl();?>js/moment.min.js"></script>
    <script type="text/javascript" src="<?php echo homeurl();?>js/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo homeurl();?>js/daterangepicker.css" />
</head>
<body>
    <div class="signup">
        <img src="<?php echo homeurl();?>public/money.png" alt="" style="width: 70px;display: block;margin: 0 auto;">
        <h1 class="signup-heading">Vay tiền online</h1>
        <form method="POST" autocomplete="off">
            <?php
            if($error){
                showError($error,'result');
            }
            ?>
            <label for="fullname" class="signup-label">Họ và tên</label>
            <input type="text" id="fullname" name="fullname" class="signup-input" value="<?php echo isset($fullname) ? $fullname : ''?>">
            <label for="address" class="signup-label">Nơi ở hiện tại</label>
            <select name="address" id="address" class="signup-input">
                <option value="1">Cần thơ</option>
                <option value="2">Kiên Giang</option>
                <option value="3">Hậu Giang</option>
            </select>
            <label for="phone" class="signup-label">Số điện thoại</label>
            <input type="text" id="phone" name="phone" class="signup-input" value="<?php echo isset($phone) ? $phone : ''?>">
            <label for="birthday" class="signup-label">Ngày tháng năm sinh (Ví dụ: 22/10/2000)</label>
            <input type="date" id="birthday" name="birthday" class="signup-input" value="<?php echo isset($birthday) ? $birthday : ''?>" required>
            <label for="cmnd" class="signup-label">Số chứng minh thư (CMND)</label>
            <input type="text" id="cmnd" name="cmnd" class="signup-input" value="<?php echo isset($cmnd) ? $cmnd : ''?>">
            <label for="major" class="signup-label">Nghề nghiệp</label>
            <input type="text" id="major" name="major" class="signup-input" value="<?php echo isset($major) ? $major : ''?>">
            <label for="money" class="signup-label">Số tiền cần vay (Tối thiểu 5,000,000 VND)</label>
            <select name="money" id="money" class="signup-input">
                <?php
                $loan = LoanMoney::getListOfMoney();
                foreach($loan as $item){
                    ?>
                    <option value="<?php echo $item['money_id'];?>" <?php echo (isset($money) && $money == $item['money_id']) ? 'selected' : ''?>><?php echo number_format($item['money_value']);?> VND</option>
                    <?php
                }
                ?>
            </select>
            <?php csrf::create_token(); ?>
            <button class="submit danger" type="submit" name="sm_loan">Gửi yêu cầu</button>
        </form>
        <p class="signup-already">
            <span>Bạn đã đọc điều lệ vay tiền ?</span>
            <a href="" class="signup-login-link">Xem tại đây</a>
        </p>
    </div>
</body>
</html>