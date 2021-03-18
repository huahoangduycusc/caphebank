<?php
class PaymentMethod{
    static $table = "tb_method_payment";
    public static function getName($id){
        $sql = "SELECT `method_id`,`method_name` FROM `".self::$table."` WHERE `method_id` = '{$id}' LIMIT 1";
        $row = db_get_row($sql);
        if($row){
            return $row['method_name'];
        }
        return "N/A";
    }
    // list payment method
    public static function getList(){
        $sql = "SELECT `method_id`,`method_name` FROM  `".self::$table."`";
        $rows = db_get_list($sql);
        return $rows;
    }
    // check id method
    public static function checkExist($id){
        $sql = "SELECT `method_id` FROM `".self::$table."` WHERE `method_id` = '{$id}' LIMIT 1";
        $row = db_get_row($sql);
        if($row){
            return true;
        }
        return false;
    }
}
?>