<?php
class Payment{
    static $table = 'tb_payment';
    // create payment
    static function createPayment($payment,$method = 0){
        global $user_id;
        $data = array(
            'payment_id' => NULL,
            'money' => $payment,
            'user_id' => $user_id,
            'status' => '0',
            'created_at' => date("Y-m-d H:m:s"),
            'p_update' => '0',
            'p_method' => $method,
            'p_admin' => '0',
            'p_reason' => ''
        );
        $table = self::$table;
        update_point("minus",$user_id,$payment);
        $text = "Yêu cầu rút ".number_format($payment)." Point";
        AccountLog::insertLog($user_id,$text,1);
        echo db_insert($table,$data);
    }
    // get list pagination
    static function getListPagin($type = 0){
        global $limit;
        global $start;
        $sql = "";
        if($type == 0){ // get all
            $sql = "SELECT `payment_id`,`money`,`user_id`,`status`,`created_at`,`p_method`
            FROM `tb_payment` ORDER BY `payment_id` DESC LIMIT $start,$limit";
        }
        else if($type == 1){ // order in process
            $sql = "SELECT `payment_id`,`money`,`user_id`,`status`,`created_at`,`p_method`
            FROM `tb_payment` WHERE `status` = '0' ORDER BY `payment_id` DESC LIMIT $start,$limit";
        }
        else if($type == 2){ // order canceled
            $sql = "SELECT `payment_id`,`money`,`user_id`,`status`,`created_at`,`p_method`
            FROM `tb_payment` WHERE `status` = '1' ORDER BY `payment_id` DESC LIMIT $start,$limit";
        }
        else if($type == 3){ // order successed
            $sql = "SELECT `payment_id`,`money`,`user_id`,`status`,`created_at`,`p_method`
            FROM `tb_payment` WHERE `status` = '2' ORDER BY `payment_id` DESC LIMIT $start,$limit";
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
            $sql = "SELECT `payment_id`,`money`,`user_id`,`status`,`created_at`
            FROM `tb_payment` ORDER BY `payment_id` DESC LIMIT $start,$limit";
        }
        else{
            $sql = "SELECT `payment_id`,`money`,`user_id`,`status`,`created_at`
            FROM `tb_payment` WHERE `user_id` = '{$type}' ORDER BY `payment_id` DESC LIMIT $start,$limit";
        }
        $rows = db_get_list($sql);
        return $rows;
    }
    // get row
    static function getRow($id){
        $sql = "SELECT `payment_id`,`money`,`user_id`,`status`,`created_at`,`p_update`,`p_admin`,`p_method`,`p_reason`
        FROM `tb_payment` WHERE `payment_id` = '{$id}' LIMIT 1";
        $row = db_get_row($sql);
        return $row;
    }
    // get my all payment
    static function myPayment(){
        global $user_id;
        $sql = "SELECT `payment_id`,`money`,`user_id`,`status`,`created_at`,`p_method`,`p_reason`
        FROM `tb_payment` WHERE `user_id` = '{$user_id}' ORDER BY `payment_id` DESC";
        $row = db_get_list($sql);
        return $row;
    }
    // status of payment
    static function statusPayment($type){
        $out = "";
        if($type == 0){
            $out = '<font color="blue">Đang chờ duyệt</font>';
        }
        else if($type == 1){
            $out = '<font color="red">Bị từ chối</font>';
        }
        else if($type == 2){
            $out = '<font color="green">Đã chuyển khoản</font>';
        }
        return $out;
    }
    // delete payment
    
    
}
?>