<?php
define('IN_SITE',true);
$rootpath = "../../../";
require_once('../../../lib/core.php');
$result = array();
if(Slide::update($id)){
    $result['msg'] = "success";
}
else{
    $result['msg'] = "error";
}
die(json_encode($result));
?>