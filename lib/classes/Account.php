<?php
class Account{
    // search
    static function searchByUsername($name){
        $sql = "SELECT `account_id`,`a_username`,`a_email`,`a_fullname`,`a_gender`,`a_phone`,`a_point`,`a_right`,`a_address` FROM `account`
        WHERE `a_username` LIKE '%$name%'";
        $rows = db_get_list($sql);
        return $rows;
    }
    // get row
    static function getRow($id){
        $sql = "SELECT `account_id`,`a_username`,`a_email`,`a_fullname`,`a_gender`,`a_phone`,`a_point`,`a_right`,`a_address` FROM `account`
        WHERE `account_id` = '{$id}' LIMIT 1";
        $row = db_get_row($sql);
        return $row;
    }
    /// get list
    static function getList(){
        global $limit;
        global $start;
        $sql = "SELECT `account_id`,`a_username`,`a_email`,`a_fullname`,`a_gender`,`a_phone`,`a_point`,`a_right` FROM `account`
        ORDER BY `account_id` DESC LIMIT $start,$limit";
        $rows = db_get_list($sql);
        return $rows;
    }
    // tien da rut
    // delete account
    static function deleteById($id){
        $row = self::getRow($id);
        $countLoan = db_count('loan','loan_id',array('a_id' => $id,'l_status' => '2'));
        if($row && $row['a_point'] == 0 && $row['a_right'] != 9 && $countLoan == 0){
            $sql = "DELETE FROM `account` WHERE `account_id` = '{$id}' LIMIT 1";
            return db_execute($sql);
        }
        else{
            return false;
        }
    }
    // check if exist
    static function checkExist($id){
        $id = trim($id);
        $id = abs(intval($id));
        $id = Generic::secure($id);
        $sql = "SELECT `account_id` FROM `account` WHERE `account_id` = '{$id}' LIMIT 1";
        $row = db_get_row($sql);
        return $row;
    }
    // get ctv
    static function getCTV($id){
        $sql = "SELECT `account_id`,`a_ctv` FROM `account`
        WHERE `account_id` = '{$id}' LIMIT 1";
        $row = db_get_row($sql);
        return $row;
    }
    // change password
    static function changePassword($old_pass,$new_pass){
        global $user_id;
        $table = "account";
        $filter = array('account_id' => $user_id);
        $newpass = password_hash($new_pass,PASSWORD_DEFAULT);
        $sql = "SELECT `a_password` FROM `account` WHERE `account_id` = '{$user_id}' LIMIT 1";
        $row = db_get_row($sql);
        if(password_verify($old_pass,$row['a_password']) == true){
            $data = array('a_password' => $newpass);
            return db_update($table,$data,$filter);
        }
        return false;
    }
}
?>