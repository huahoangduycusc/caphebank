<?php
define('IN_SITE',true);
require_once('../lib/core.php');
if($rights <9){
    redirect(homeurl());
}
// get module and action on url
$module = input_get('m');
$action = input_get('a');
// neu khong truyen action va module
// thi set mac dinh duong dan den trang
// quan ly mac dinh
if(!$module || !$action){
    $module = "common";
    $action = "dashbroad";
}
require_once('widgets/header.php');
// tao duong dan va luu vao bien path
$path = 'modules/'.$module.'/'.$action.'.php';
if(file_exists($path)){
    include($path);
}
else{
    include('modules/common/404.php');
}
require_once('widgets/footer.php');
?>