<?php
define('IN_SITE',true);
$rootpath = "../../../";
require_once('../../../lib/core.php');
$result = array();
if(Loan::deleteLoan($id)){
    $result['msg'] = "success";
}
else{
    $result['msg'] = "error";
}
die(json_encode($result));
?>