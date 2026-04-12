<?php

$find = $db->query("SELECT * FROM configs WHERE ip = '".$_SERVER['REMOTE_ADDR']."'");
$find = $db->fetch($find);

switch ($find ? $find['lang'] : null) {
	case 'PT':
		$lang = 'PT'; 
		break;
	case 'EN':
		$lang = 'EN';
		break;
	default:
		$lang = 'EN';
		break;
}





?>