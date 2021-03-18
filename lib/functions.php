<?php
if(!defined('IN_SITE')) die('The request not found');
// get user
function db_user_get_by_username($username){
    $username = htmlspecialchars($username);
    $sql = "SELECT `account_id`,`a_username`, `a_password` FROM `account` WHERE `a_username` = '{$username}' LIMIT 1";
    return db_get_row($sql);
}
// get email
function db_get_email($email){
    $sql = "SELECT count(`account_id`) as counter FROM `account` WHERE `a_email`='{$email}'";
    $row = db_get_row($sql);
    if($row['counter'] > 0){
        return '1';
    }
    return '0';
}
// check user id
function db_check_exist_account($id){
    $sql = "SELECT `account_id` FROM `account` WHERE `account_id` = '{$id}'";
    $row = db_get_row($sql);
    if($row){
        return true;
    }
    else{
        return false;
    }
}
//// thoigian forum ////
function thoigian($from, $to = '') {
    if (empty($to))
    $to = time();
    $diff = (int) abs($to - $from);
    if ($diff <= 60) {
    $since = sprintf('Vừa mới đây');
    } elseif ($diff <= 3600) {
    $mins = round($diff / 60);
    if ($mins <= 1) {
    $mins = 1;
    }
    $since = sprintf('%s phút', $mins);
    } else if (($diff <= 86400) && ($diff > 3600)) {
    $hours = round($diff / 3600);
    if ($hours <= 1) {
    $hours = 1;
    }
    $since = sprintf('%s giờ', $hours);
    } elseif (($diff >= 86400) && ($diff < 604800)){
    $days = round($diff / 86400);
    if ($days <= 1) {
    $days = 1;
    }
    $since = sprintf('%s ngày', $days);
    }
    elseif (($diff >= 604800) && ($diff < 2592000)) {
    $tuans = round($diff / 604800);
    if ($tuans <= 1) {
    $tuans = 1;
    }
    $since = sprintf('%s tuần', $tuans);
    }
    elseif (($diff >= 2592000) && ($diff < 31092000)) {
    $tuanss = round($diff / 2592000);
    if ($tuanss <= 1) {
    $tuanss = 1;
    }
    $since = sprintf('%s tháng', $tuanss);
    }
    elseif (($diff >= 31092000) && ($diff < 31092000000000)) {
    $tuanss = round($diff / 31092000);
    if ($tuansss <= 1) {
    $tuansss = 1;
    }
    $since = sprintf('%s năm', $tuansss);
    }
    return $since;
}
// slug
function to_slug($str, $options = array()) {
	// Make sure string is in UTF-8 and strip invalid UTF-8 characters
	$str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
	
	$defaults = array(
		'delimiter' => '-',
		'limit' => null,
		'lowercase' => true,
		'replacements' => array(),
		'transliterate' => true,
	);
	
	// Merge options
	$options = array_merge($defaults, $options);
	
	// Lowercase
	if ($options['lowercase']) {
		$str = mb_strtolower($str, 'UTF-8');
	}
	
	$char_map = array(
		// Latin
		'á' => 'a', 'à' => 'a', 'ả' => 'a', 'ã' => 'a', 'ạ' => 'a', 'ă' => 'a', 'ắ' => 'a', 'ằ' => 'a', 'ẳ' => 'a', 'ẵ' => 'a', 'ặ' => 'a', 'â' => 'a', 'ấ' => 'a', 'ầ' => 'a', 'ẩ' => 'a', 'ẫ' => 'a', 'ậ' => 'a', 'đ' => 'd', 'é' => 'e', 'è' => 'e', 'ẻ' => 'e', 'ẽ' => 'e', 'ẹ' => 'e', 'ê' => 'e', 'ế' => 'e', 'ề' => 'e', 'ể' => 'e', 'ễ' => 'e', 'ệ' => 'e', 'í' => 'i', 'ì' => 'i', 'ỉ' => 'i', 'ĩ' => 'i', 'ị' => 'i', 'ó' => 'o', 'ò' => 'o', 'ỏ' => 'o', 'õ' => 'o', 'ọ' => 'o', 'ô' => 'o', 'ố' => 'o', 'ồ' => 'o', 'ổ' => 'o', 'ỗ' => 'o', 'ộ' => 'o', 'ơ' => 'o', 'ớ' => 'o', 'ờ' => 'o', 'ở' => 'o', 'ỡ' => 'o', 'ợ' => 'o', 'ú' => 'u', 'ù' => 'u', 'ủ' => 'u', 'ũ' => 'u', 'ụ' => 'u', 'ư' => 'u', 'ứ' => 'u', 'ừ' => 'u', 'ử' => 'u', 'ữ' => 'u', 'ự' => 'u', 'ý' => 'y', 'ỳ' => 'y', 'ỷ' => 'y', 'ỹ' => 'y', 'ỵ' => 'y'
	);
	
	// Make custom replacements
	$str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
	
	// Transliterate characters to ASCII
	if ($options['transliterate']) {
		$str = str_replace(array_keys($char_map), $char_map, $str);
	}
	
	// Replace non-alphanumeric characters with our delimiter
	$str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
	
	// Remove duplicate delimiters
	$str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
	
	// Truncate slug to max. characters
	$str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
	
	// Remove delimiter from ends
	$str = trim($str, $options['delimiter']);
	
	return $str;
}
?>