<?php
class Loan{
    // get list pagination
    static function getListPagin($type = 0){
        global $limit;
        global $start;
        $sql = "";
        if($type == 0){ // get all
            $sql = "SELECT `loan_id`,`l_fullname`,`l_address`,`l_phone`,`l_birthday`,`l_cmnd`,
        `l_major`,`l_money`,`l_date`,`a_id`,`l_status`,`l_update` FROM `loan` ORDER BY `loan_id` DESC LIMIT $start,$limit";
        }
        else if($type == 1){ // order in process
            $sql = "SELECT `loan_id`,`l_fullname`,`l_address`,`l_phone`,`l_birthday`,`l_cmnd`,
        `l_major`,`l_money`,`l_date`,`a_id`,`l_status`,`l_update` FROM `loan` WHERE `l_status` = '0' ORDER BY `loan_id` DESC LIMIT $start,$limit";
        }
        else if($type == 2){ // order canceled
            $sql = "SELECT `loan_id`,`l_fullname`,`l_address`,`l_phone`,`l_birthday`,`l_cmnd`,
        `l_major`,`l_money`,`l_date`,`a_id`,`l_status`,`l_update` = '1' FROM `loan` WHERE `l_status` = '1' ORDER BY `loan_id` DESC LIMIT $start,$limit";
        }
        else if($type == 3){ // order successed
            $sql = "SELECT `loan_id`,`l_fullname`,`l_address`,`l_phone`,`l_birthday`,`l_cmnd`,
        `l_major`,`l_money`,`l_date`,`a_id`,`l_status`,`l_update` FROM `loan` WHERE `l_status` = '2' ORDER BY `loan_id` DESC LIMIT $start,$limit";
        }
        $rows = db_get_list($sql);
        return $rows;
    }
    // get list
    static function getList($type = 0){
        global $start;
        global $limit;
        $sql = '';
        if($type == 0){
            $sql = "SELECT `loan_id`,`l_fullname`,`l_address`,`l_phone`,`l_birthday`,`l_cmnd`,
            `l_major`,`l_money`,`l_date`,`a_id`,`l_status`,`l_update` FROM `loan` ORDER BY `loan_id` DESC LIMIT $start,$limit";
        }
        else{
            $sql = "SELECT `loan_id`,`l_fullname`,`l_address`,`l_phone`,`l_birthday`,`l_cmnd`,
            `l_major`,`l_money`,`l_date`,`a_id`,`l_status`,`l_update` FROM `loan`
            WHERE `a_id` = '$type' ORDER BY `loan_id` DESC LIMIT $start,$limit";
        }
        $rows = db_get_list($sql);
        return $rows;
    }
    // get list report
    static function getListReport($type,$from,$to){
        $sql = "";
        if($type == 0){ // get all
            $sql = "SELECT `loan_id`,`l_fullname`,`l_address`,`l_phone`,`l_birthday`,`l_cmnd`,
        `l_major`,`l_money`,`l_date`,`a_id`,`l_status`,`l_update` FROM `loan` 
        WHERE Date(`l_date`) >= '$from' AND Date(`l_date`) <= '$to'
        ORDER BY `loan_id` DESC";
        }
        else if($type == 1){ // order in process
            $sql = "SELECT `loan_id`,`l_fullname`,`l_address`,`l_phone`,`l_birthday`,`l_cmnd`,
        `l_major`,`l_money`,`l_date`,`a_id`,`l_status`,`l_update` FROM `loan` WHERE `l_status` = '0'
        AND Date(`l_date`) >= '$from' AND Date(`l_date`) <= '$to'
        ORDER BY `loan_id` DESC";
        }
        else if($type == 2){ // order canceled
            $sql = "SELECT `loan_id`,`l_fullname`,`l_address`,`l_phone`,`l_birthday`,`l_cmnd`,
        `l_major`,`l_money`,`l_date`,`a_id`,`l_status`,`l_update` = '1' FROM `loan` WHERE `l_status` = '1'
        AND Date(`l_date`) >= '$from' AND Date(`l_date`) <= '$to'
        ORDER BY `loan_id` DESC";
        }
        else if($type == 3){ // order successed
            $sql = "SELECT `loan_id`,`l_fullname`,`l_address`,`l_phone`,`l_birthday`,`l_cmnd`,
        `l_major`,`l_money`,`l_date`,`a_id`,`l_status`,`l_update` FROM `loan` WHERE `l_status` = '2'
        AND Date(`l_date`) >= '$from' AND Date(`l_date`) <= '$to'
        ORDER BY `loan_id` DESC";
        }
        $rows = db_get_list($sql);
        return $rows;
    }
    // get row
    static function getRow($id){
        $sql = "SELECT `loan_id`,`l_fullname`,`l_address`,`l_phone`,`l_birthday`,`l_cmnd`,
        `l_major`,`l_money`,`l_date`,`a_id`,`c_id`,`l_status`,`l_update` FROM `loan` WHERE `loan_id` = '{$id}' LIMIT 1";
        $row = db_get_row($sql);
        return $row;
    }
    // get collaboration
    static function getCTV($id){
        $out = "N/A";
        $sql = "SELECT `a_username` FROM `account` WHERE `account_id` = '{$id}' LIMIT 1";
        $row = db_get_row($sql);
        $out = $row['a_username'];
        return $out;
    }
    // loan get status
    static function getStatus($id){
        $sql = "SELECT `status_id`,`loan_id`,`user_id`,`status_text`,`created_at` FROM `loan_status` WHERE `loan_id` = '{$id}' ORDER BY `status_id` DESC";
        $rows = db_get_list($sql);
        return $rows;
    }
    // loan create status
    static function loanStatus($order_id,$status){
        global $user_id;
        $msg = "";
        if($status == 1){
            $msg = 'cập nhật trạng thái từ <span class="badge badge-warning">Đang xử lý</span> sang <span class="badge badge-danger">Đã hủy</span>';
        }
        else if($status == 2){
            $msg = 'cập nhật trạng thái từ <span class="badge badge-warning">Đang xử lý</span> sang <span class="badge badge-success">Đã duyệt</span>';
        }
        $table = "loan_status";
        $data = array(
            'status_id' => NULL,
            'loan_id' => $order_id,
            'user_id' => $user_id,
            'status_text' => $msg,
            'created_at' => date("Y-m-d H:m:s")
        );
        db_insert($table,$data);
    }
    // delete loan
    static function deleteLoan($id){
        $sql = "SELECT `l_status` FROM `loan` WHERE `loan_id` = '{$id}' LIMIT 1";
        $row = db_get_row($sql);
        if($row){ // neu da duyet thi khong the xoa
            if($row['l_status'] != 2){
                $sqll = "DELETE FROM `loan` WHERE `loan_id` = '{$id}' LIMIT 1";
                return db_execute($sqll);
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }
    // get list loan of user
    static function myLoan($month,$year){
        global $user_id;
        $sql = "SELECT `loan_id`,`l_fullname`,`l_address`,`l_phone`,`l_birthday`,`l_cmnd`,
        `l_major`,`l_money`,`l_date`,`a_id`,`l_status`,`l_update` FROM `loan` 
        WHERE `a_id` = '{$user_id}' AND MONTH(`l_date`) = '$month' AND YEAR(`l_date`) = '$year'
        ORDER BY `loan_id` DESC";
        $rows = db_get_list($sql);
        return $rows;
    }
    // get list loan to day
    static function myLoanToday(){
        $today = date("d");
        $month = date("m");
        $year = date("Y");
        global $user_id;
        $sql = "SELECT `loan_id`,`l_fullname`,`l_address`,`l_birthday`,
        `l_money`,`l_date`,`a_id`,`l_status`,`l_update` FROM `loan` 
        WHERE `a_id` = '{$user_id}' AND DAY(`l_date`) = '$today' AND MONTH(`l_date`) = '$month' AND YEAR(`l_date`) = '$year'
        ORDER BY `loan_id` DESC";
        $rows = db_get_list($sql);
        return $rows;
    }
    // so don
    static function revenu($month,$year,$type = 0){
        global $user_id;
        $sql = "";
        if($type == 0){
            $sql = "SELECT `loan_id` FROM `loan` WHERE `a_id` = '{$user_id}'
            AND MONTH(`l_date`) = '$month' AND YEAR(`l_date`) = '$year' AND `l_status` = '2'";
        }
        else{
            $sql = "SELECT `loan_id` FROM `loan` WHERE `c_id` = '{$user_id}'
            AND MONTH(`l_date`) = '$month' AND YEAR(`l_date`) = '$year' AND `l_status` = '2'";
        }
        return mysqli_num_rows(db_execute($sql));
    }

    // hoa hong cua toi
    static function hoahong($month,$year){
        global $user_id;
        $sql = "SELECT SUM(`l_money`) as 'total' FROM `loan` WHERE `a_id` = '{$user_id}'
        AND MONTH(`l_date`) = '$month' AND YEAR(`l_date`) = '$year' AND `l_status` = '2'";
        $total = db_get_row($sql);
        return $total['total']*0.1;
    }
    

    // hoa hong cong tac vien
    static function congtacvien($month,$year){
        global $user_id;
        $sql = "SELECT SUM(`l_money`) as 'total' FROM `loan` WHERE `c_id` = '{$user_id}'
        AND MONTH(`l_date`) = '$month' AND YEAR(`l_date`) = '$year' AND `l_status` = '2'";
        $total = db_get_row($sql);
        $conlai = $total['total']*0.1;
        $conlai = $conlai*0.05;
        return $conlai;
    }

    // report
    static function reportToFrom($from,$to){
        global $user_id;
        $from = Generic::secure($from);
        $to = Generic::secure($to);
        $sql = "SELECT `loan_id`,`l_fullname`,`l_address`,`l_phone`,`l_birthday`,`l_cmnd`,
        `l_major`,`l_money`,`l_date`,`a_id`,`l_status`,`l_update` FROM `loan` 
        WHERE `a_id` = '{$user_id}' AND Date(`l_date`) >= '$from' AND Date(`l_date`) <= '$to'
        ORDER BY `loan_id` DESC";
        $rows = db_get_list($sql);
        return $rows;
    }

    

}
?>