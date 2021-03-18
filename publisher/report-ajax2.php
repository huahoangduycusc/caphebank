<?php
error_reporting(0);
define('IN_SITE',true);
require_once('../lib/core.php');
if(!$user_id){
    die("Bad request");
}
$data = "";
$today = date("Y-m-d");
$from = isset($_POST['from']) ? trim(htmlspecialchars($_POST['from'])) : $today;
$to = isset($_POST['to']) ? trim(htmlspecialchars($_POST['to'])) : $today;
if($from && $to){
    $rows = Loan::reportToFrom($from,$to);
    foreach($rows as $loan){
        $data .= "<tr>
        <td>".$loan['loan_id']."</td>
        <td>".$loan['l_fullname']."</td>
        <td>".$loan['l_birthday']."</td>
        <td>".number_format($loan['l_money'])." VND</td>
        <td>".number_format($loan['l_money']*0.1)." VND</td>
        <td>".$loan['l_date']."</td>
        <td>".showStatus($loan['l_status'])."</td>
    </tr>";
    }
    echo $data;
}
?>