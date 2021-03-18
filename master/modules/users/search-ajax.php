<?php
sleep(1);
define('IN_SITE',true);
$rootpath = "../../../";
require_once('../../../lib/core.php');
$type = isset($_GET['type']) ? abs(intval($_GET['type'])) : 1;
$name = isset($_GET['user']) ? Generic::secure($_GET['user']) : false;
$out = "";
if($type && $name){
    if($type == 1){
        $item = Account::getRow($name);
        if($item){
            $out = '<tr id="'.$item['account_id'].'">
            <td>'.$item['account_id'].'</td>
            <td><a href="?m=users&a=details&id='.$item['account_id'].'" class="text-orange">'.nick($item['account_id']).'</a></td>
            <td>'.$item['a_fullname'].'</td>
            <td>'.$item['a_phone'].'</td>
            <td>'.$item['a_email'].'</td>
            <td>'.number_format($item['a_point']).'</td>
            <td>
            <a href="?m=users&a=details&id='.$item['account_id'].'" class="btn-sm btn-info">Xem</a>
            <a href="'.$item['account_id'].'" data-id="'.$item['account_id'].'" class="btn-sm btn-danger">Xóa</a>
            </td>
            </tr>';
        }
    }
    else{
        $list = Account::searchByUsername($name);
        foreach($list as $item){
            $out .= '<tr id="'.$item['account_id'].'">
            <td>'.$item['account_id'].'</td>
            <td><a href="?m=users&a=details&id='.$item['account_id'].'" class="text-orange">'.nick($item['account_id']).'</a></td>
            <td>'.$item['a_fullname'].'</td>
            <td>'.$item['a_phone'].'</td>
            <td>'.$item['a_email'].'</td>
            <td>'.number_format($item['a_point']).'</td>
            <td>
            <a href="?m=users&a=details&id='.$item['account_id'].'" class="btn-sm btn-info">Xem</a>
            <a href="'.$item['account_id'].'" data-id="'.$item['account_id'].'" class="btn-sm btn-danger">Xóa</a>
            </td>
            </tr>';
            }
    }
    echo $out;
}
else{
    echo 'Lỗi';
}
?>