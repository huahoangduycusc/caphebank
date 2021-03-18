<?php
if(!defined('IN_SITE')) die('Error: restricted access');
// timezone
date_default_timezone_set('Asia/Ho_Chi_Minh');
// start session
session_start();
$rootpath = isset($rootpath) ? $rootpath : '../';
// title website
$title = 'Vay tiền online với lãi suất cực hấp dẫn';
$page = isset($_GET['page']) ? abs(intval($_GET['page'])) : 1;
// limit
$limit = 10;
$start = abs(intval($limit*$page)-$limit);
// include file
include_once('helper.php');
include_once('database.php');
include_once('session.php');
include_once('functions.php');
// autoload class
spl_autoload_register('autoload');
function autoload($name){
    global $rootpath;
    $file = $rootpath.'lib/classes/'.$name.'.php';
    if(file_exists($file)){
        require_once($file);
    }
}
// authorize
$core = new authenticate() or die('Error: Core System');
unset($core);
$user_id = authenticate::$user_id;
$datauser = authenticate::$get_user;
$rights = authenticate::$rights;
$sys = System::getInfo();
?>