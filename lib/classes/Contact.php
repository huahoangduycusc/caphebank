<?php
class Contact{

    // get row
    static function getRow($id){
        $sql = "SELECT `contact_name`,`contact_phone` FROM `tb_contact` WHERE `contact_id` = '{$id}'";
        $row = db_get_row($sql);
        return $row;
    }
    // get list
    static function getList(){
        $sql = "SELECT `contact_id`,`contact_name`,`contact_phone` FROM `tb_contact` ORDER BY `contact_id` DESC";
        $rows = db_get_list($sql);
        return $rows;
    }

    // delete contact
    static function delContact($id){
        $sql = "DELETE FROM `tb_contact` WHERE `contact_id` = '{$id}'";
        return db_execute($sql);
    }
}
?>