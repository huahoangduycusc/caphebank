<?php
sleep(1);
define('IN_SITE',true);
$rootpath = "../../../";
require_once('../../../lib/core.php');
$type = isset($_POST['type']) ? abs(intval($_POST['type'])) : 0;
$tu = isset($_POST['tu']) ? htmlspecialchars($_POST['tu']) : false;
$den = isset($_POST['den']) ? htmlspecialchars($_POST['den']) : false;
$out = "";
$regexDate = "/[0-9]{4}-[0-9]{2}-[0-9]{2}/";
if(preg_match($regexDate,$tu) && preg_match($regexDate,$den)){
    $list = Loan::getListReport($type,$tu,$den);
    foreach($list as $loan){
        $out .='<tr id="row'.$loan['loan_id'].'">
            <td><a href="?m=orders&a=details&id='.$loan['loan_id'].'">#'.$loan['loan_id'].'</a></td>
            <td>'.$loan['l_fullname'].'</td>
            <td>'.$loan['l_phone'].'</td>
            <td>'.number_format($loan['l_money']).' VND</td>
            <td><a href="" class="text-orange">'.nick($loan['a_id']).'</a></td>
            <td>'.showStatus($loan['l_status']).'</td>
            <td>
                <a href="?m=orders&a=details&id='.$loan['loan_id'].'" class="btn-sm btn-info">Xem</a>
                <a href="'.$loan['loan_id'].'" data-id="'.$loan['loan_id'].'" class="btn-sm btn-danger">Xóa</a>
            </td>
        </tr>';
    }
    echo $out;
}
else{
    echo "lỗi";
}
?>