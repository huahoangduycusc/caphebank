<?php
class LoanMoney{

    // get list money
    static function getListOfMoney(){
        $sql = "SELECT `money_id`, `money_value` FROM `loan_money` ORDER BY `money_value` ASC";
        $result = db_get_list($sql);
        return $result;
    }
    // check if exists money id
    static function checkMoney($id){
        $sql = "SELECT `money_id` FROM `loan_money` WHERE `money_id` = '{$id}'";
        if(!db_get_row($sql)){
            return false;
        }
        return true;
    }
    // get money value
    static function getValue($id){
        $sql = "SELECT `money_value` FROM `loan_money` WHERE `money_id` = '{$id}'";
        $row = db_get_row($sql);
        if($row){
           return $row['money_value'];
        }
        return 0;
    }
}
?>