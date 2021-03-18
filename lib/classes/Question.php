<?php
class Question{
    // get row
    static function getRow($id){
        $sql = "SELECT `question_id`,`question_name`,`question_answer` FROM
        `tb_question` WHERE `question_id` = '{$id}' LIMIT 1";
        $rows = db_get_row($sql);
        return $rows;
    }
    // get list
    static function getList(){
        $sql = "SELECT `question_id`,`question_name`,`question_answer` FROM
        `tb_question` ORDER BY `question_id` DESC";
        $rows = db_get_list($sql);
        return $rows;
    }

    // delete question
    static function delQuestion($id){
        $sql = "DELETE FROM `tb_question` WHERE `question_id` = '{$id}'";
        return db_execute($sql);
    }

}
?>