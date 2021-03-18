<?php
error_reporting(0);
define('IN_SITE',true);
header('Content-Encoding: UTF-8');
header('Content-type: text/csv; charset=UTF-8');
// The function header by sending raw excel
header("Content-type: application/vnd-ms-excel");
// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=codelution-export.xls");
echo "\xEF\xBB\xBF"; // UTF-8 BOM
$rootpath = '';
require_once('lib/core.php');
$type = isset($_GET['type']) ? abs(intval($_GET['type'])) : 0;
$from = isset($_GET['from']) ? htmlspecialchars($_GET['from']) : false;
$to = isset($_GET['to']) ? htmlspecialchars($_GET['to']) : false;
$regexDate = "/[0-9]{4}-[0-9]{2}-[0-9]{2}/";
if(preg_match($regexDate,$from) && preg_match($regexDate,$to)){
    $list = Loan::getListReport($type,$from,$to);
    // Add data table
    echo'    <table border="1">
    <tr>
        <th>NO.</th>
        <th>Họ và tên</th>
        <th>SĐT</th>
        <th>Năm sinh</th>
        <th>CMND</th>
        <th>Nghề nghiệp</th>
        <th>Đia chỉ</th>
        <th>Tiền vay</th>
        <th>Trạng thái</th>
    </tr>';
    foreach($list as $loan){
        ?>
        <tr>
            <td>#<?php echo $loan['loan_id'];?></td>
            <td><?php echo $loan['l_fullname'];?></td>
            <td><?php echo $loan['l_phone'];?></td>
            <td><?php echo $loan['l_birthday'];?></td>
            <td><?php echo $loan['l_cmnd'];?></td>
            <td><?php echo $loan['l_major'];?></td>
            <td><?php echo $loan['l_address'];?></td>
            <td><?php echo number_format($loan['l_money']);?></td>
            <td><?php echo showStatus($loan['l_status']);?></td>
        </tr>
        <?php
    }
    echo'</table>';
}
?>