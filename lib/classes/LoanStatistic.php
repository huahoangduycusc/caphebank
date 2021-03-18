<?php
class LoanStatistic{
     // statistic view of new day
     static function checkExist($id){
        $date = date("Y-m-d");
        $sql = "SELECT `link_id`,`link_click` FROM `loan_link` WHERE `user_id` = '{$id}' AND `link_date` = '$date' LIMIT 1";
        $row = db_get_row($sql);
        if($row){ // neu ton tai
            $sql2 = "UPDATE `loan_link` SET `link_click` = `link_click` + '1' WHERE `link_id` = '".$row['link_id']."' LIMIT 1";
            db_execute($sql2);
        }
        else{ // neu khong
            $table = 'loan_link';
            $data = array(
                'link_id' => null,
                'user_id' => $id,
                'link_date' => $date,
                'link_click' => '1'
            );
            db_insert($table,$data);
        }
    }
    // get click number
    static function getNumberClick($month,$year){
        global $user_id;
        $sql = "SELECT SUM(`link_click`) as 'total' FROM `loan_link`
        WHERE MONTH(`link_date`) = '$month' AND YEAR(`link_date`) = '$year'
        AND `user_id` = '{$user_id}'";
        $row = db_get_row($sql);
        if($row){
            return $row['total'];
        }
        return 0;
    }
    // check if statistic
    static function checkCreateMonth(){
        global $user_id;
        $month = date("m");
        $year = date("Y");
        $sql = "SELECT `link_id` FROM `loan_link` WHERE MONTH(`link_date`) = '$month' 
        AND YEAR(`link_date`) = '$year' AND `user_id` = '{$user_id}' LIMIT 1";
        $row = db_get_row($sql);
        if(!$row){
            $table = "loan_link";
            $data = array(
                'link_id' => NULL,
                'user_id' => $user_id,
                'link_date' => date("Y-m-d"),
                'link_click' => '0'
            );
            db_insert($table,$data);
        }
    }
    // loop statistic month, year
    static function loopMonthYear(){
        global $user_id;
        $year = date("Y");
        $sql = "SELECT MONTH(`link_date`) as 'month', YEAR(`link_date`) as 'year' FROM `loan_link`
        WHERE YEAR(`link_date`) = '$year' AND `user_id` = '$user_id'
        GROUP BY MONTH(`link_date`)";
        $rows = db_get_list($sql);
        return $rows;
    }
}
?>