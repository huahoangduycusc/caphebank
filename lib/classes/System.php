<?php
class System{
     static function getInfo(){
         $sql = "SELECT `system_id`,`title`,`email`,`address`,`phone`,`copyright`,
         `chinhsach`,`dieukhoan`,`keyword`,`description`,`huongdan` FROM `tb_system`
         WHERE `system_id` ORDER BY `system_id` DESC LIMIT 1";
         $row = db_get_row($sql);
         return $row;
     }
}
?>