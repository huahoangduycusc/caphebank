<?php
class Notification{
    // get row
    static function getRow($id){
        $sql = "SELECT `noti_id`,`noti_title`,`noti_msg`,`user_id`,`created_at` FROM `tb_notification`
        WHERE `noti_id` = '{$id}' LIMIT 1";
        $row = db_get_row($sql);
        return $row;
    }
    /// get list
    static function getList(){
        global $start;
        global $limit;
        $sql = "SELECT `noti_id`,`noti_title`,`noti_msg`,`created_at`,`noti_seen` FROM `tb_notification`
        ORDER BY `noti_id` DESC LIMIT $start,$limit";
        $rows = db_get_list($sql);
        return $rows;
    }
}
?>