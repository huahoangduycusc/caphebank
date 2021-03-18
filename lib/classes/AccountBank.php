<?php
class AccountBank{
    public static function getInfo($id = 0){
        global $user_id;
        $table = 'account_bank';
        $sql = "";
        if($id == 0){
            $sql = "SELECT `bank_name`,`bank_chinhanh`,`bank_user`,`bank_number`,`bank_cmnd`,`momo`
            FROM `{$table}` WHERE `account_id` = '{$user_id}' LIMIT 1";
        }
        else{
            $sql = "SELECT `bank_name`,`bank_chinhanh`,`bank_user`,`bank_number`,`bank_cmnd`,`momo`
            FROM `{$table}` WHERE `account_id` = '{$id}' LIMIT 1";
        }
        $row = db_get_row($sql);
        return $row;
    }
    // create new one
    public static function createNew($id){
        $table = 'account_bank';
        $data = array(
            'bank_id' => NULL,
            'account_id' => $id,
            'bank_name' => '',
            'bank_chinhanh' => '',
            'bank_user' => '',
            'bank_number' => '',
            'bank_cmnd' => '',
            'momo' => ''
        );
        db_insert($table,$data);
    }
}
?>