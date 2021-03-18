<?php
// get method
$id = isset($_GET['id']) ? abs(intval($_GET['id'])) : false;
$do = isset($_GET['do']) ? trim(htmlspecialchars($_GET['do'])) : false;
$homeurl = 'https://capphebank.herokuapp.com/';
// create url
function homeurl($url = ''){
    return 'https://capphebank.herokuapp.com/'.$url;
}
// redirect
function redirect($url){
    header("Location:{$url}");
    exit();
}
// get value from POST
function input_post($key){
    return isset($_POST[$key]) ? trim($_POST[$key]) : false;
}
// get value from GET
function input_get($key){
    return isset($_GET[$key]) ? trim($_GET[$key]) : false;
}
// show error
function showError($error,$key){
    echo '<div class="text-danger">'.(empty($error[$key]) ? "" : $error[$key]).'</div>';
}
// show status bar
function showStatus($type){
    $out = '';
    if($type == 0){
        $out = '<span class="badge badge-warning">Đang chờ</span>';
    }
    else if($type == 1){
        $out = '<span class="badge badge-danger">Đã hủy</span>';
    }
    else if($type == 2){
        $out ='<span class="badge badge-success">Đã duyệt</span>';
    }
    return $out;
}
// get user name
function nick($id){
    $sql = "SELECT `a_username` FROM `account` WHERE `account_id` = '{$id}' LIMIT 1";
    $out = "N/A";
    if($row = db_get_row($sql)){
        $out = $row['a_username'];
    }
    return $out;
}
// lay url hien tai cua nguoi dung
function getCurURL()
{
    if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
        $pageURL = "https://";
    } else {
      $pageURL = 'http://';
    }
    if (isset($_SERVER["SERVER_PORT"]) && $_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}
// gender
function gender($type){
    $out = '';
    if($type == 1){
        $out = 'Nam';
    }
    else if($type == 2){
        $out = 'Nữ';
    }
    else{
        $out = 'Không xác định';
    }
    return $out;
}
?>