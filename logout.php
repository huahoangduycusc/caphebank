<?php
error_reporting(0);
$rootpath = '';
define('IN_SITE',true);
require_once('lib/core.php');
session_delete($_SESSION['uid']);
session_destroy();
redirect(homeurl());
?>