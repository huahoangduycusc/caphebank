<?php
class Article{
    // get row
    static function getRow($id,$type = 0){
        $sql = "SELECT `article_id`,`article_name`,`description`,`account_id`,`created_at`,`thumbnail`,`view`,`status` FROM `tb_article`
        WHERE `article_id` = '{$id}' LIMIT 1";
        $rows = db_get_row($sql);
        if($type == 1){
            $sqll = "UPDATE `tb_article` SET `view` = `view` + '1' WHERE `article_id` = '{$id}' LIMIT 1";
            db_execute($sqll);
        }
        return $rows;
    }
    /// get list
    static function getList($type = 0){
        global $limit;
        global $start;
        $sql = "";
        if($type == 0){
            $sql = "SELECT `article_id`,`article_name`,`description`,`account_id`,`created_at`,`thumbnail`,`view`,`status` FROM `tb_article`
        ORDER BY `article_id` DESC LIMIT $start,$limit";
        }
        else{
            $sql = "SELECT `article_id`,`article_name`,`description`,`account_id`,`created_at`,`thumbnail`,`view`,`status` FROM `tb_article`
        ORDER BY `article_id` DESC LIMIT 3";
        }
        $rows = db_get_list($sql);
        return $rows;
    }
     // rewrite url
     public static function rewriteUrl($id){
        $out = '';
        $sql = "SELECT `article_id`,`article_name` FROM `tb_article` WHERE `article_id` = '$id' LIMIT 1";
        $row = db_get_row($sql);
        if($row){
            $out = homeurl().'news/'.to_slug($row['article_name']).'/'.$row['article_id'];
        }
        return $out;
    }
    // delete article
    public static function delete($id){
        $exist = "SELECT `article_id` FROM `tb_article` WHERE `article_id` = '{$id}'";
        $row = db_get_row($exist);
        if($row){
            $sql = "DELETE FROM `tb_article` WHERE `article_id` = '{$id}'";
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
}
?>