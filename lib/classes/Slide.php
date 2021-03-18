<?php
class Slide{
    static function getList($type = 0){
        global $limit;
        global $start;
        $sql = "SELECT `slide_id`,`slide_name`,`status` FROM `tb_slides`
        ".($type == 0 ? "" : "WHERE `status` = '0'")."
        ORDER BY `slide_id` DESC LIMIT $start,$limit";
        $rows = db_get_list($sql);
        return $rows;
    }
    // delete article
    public static function delete($id){
        $exist = "SELECT `slide_id` FROM `tb_slides` WHERE `slide_id` = '{$id}'";
        $row = db_get_row($exist);
        if($row){
            $sql = "DELETE FROM `tb_slides` WHERE `slide_id` = '{$id}'";
            if(db_execute($sql)){
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }
    // update hide or display
    public static function update($id){
        $exist = "SELECT `slide_id`,`status` FROM `tb_slides` WHERE `slide_id` = '{$id}'";
        $row = db_get_row($exist);
        if($row){
           if($row['status'] == 0){
            $sql = "UPDATE `tb_slides` SET `status` = '1' WHERE `slide_id` = '{$id}' LIMIT 1";
            db_execute($sql);
           }
           else{
            $sql = "UPDATE `tb_slides` SET `status` = '0' WHERE `slide_id` = '{$id}' LIMIT 1";
            db_execute($sql);
           }
            return true;
        }
        return false;
    }
}
?>