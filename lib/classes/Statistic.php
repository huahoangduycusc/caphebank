<?php
class Statistic{
    // khoan vay
    function getMoneys(){
       return db_sum('loan','l_money',array('l_status' => '2'))/1000000;
    }
    // so luong don vay
    function getOrders(){
        return db_count('loan','loan_id');
    }
    // dem so bai viet
    function getArticles(){
        return db_count('tb_article','article_id');
    }
    // dem account
    function getAccounts(){
        return db_count('account','account_id',array('a_right' => '0'));
    }

}
?>