<?php
class AccountLog{
    // get list
    static function getList($id,$type = 0){
        global $limit;
        global $start;
        $sql = "SELECT `log_text`,`created_at` FROM `account_log` WHERE `user_id` = '{$id}'
        AND `log_type` = '$type'
        ORDER BY `log_id` DESC LIMIT $start,$limit";
        $rows = db_get_list($sql);
        return $rows;
    }
    // insert log
    static function insertLog($user_id,$text,$type = 0){
        $table = "account_log";
        $data = array(
            'log_id' => NULL,
            'user_id' => $user_id,
            'log_text' => $text,
            'log_type' => $type,
            'created_at' => date("Y-m-d H:m:s")
        );
        return db_insert($table,$data);
    }
}
?>