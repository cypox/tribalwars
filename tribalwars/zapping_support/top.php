<?php
 #########################################
 ### Desenvolvido por: Caique Portella ###
 ###  Email: caiqueportella@gmail.com  ###
 ########  Skype: caique-portela  ########
 ## MSN: caiqueportella@hotmail.com.br  ##
 #########################################
 
if (isset($_GET['action']) && $_GET['action'] == 'config') {
	if (isset($_POST['lang']) && $_POST['lang'] != '0') {
		$find = $db->query("SELECT id FROM configs WHERE ip = '".$_SERVER['REMOTE_ADDR']."'");
		$findy = $db->numrows($find);
			if ($findy == '0') {
				$lang = $db->query("INSERT INTO configs (ip, support_lang) VALUES ('".$_SERVER['REMOTE_ADDR']."', '".$_POST['lang']."')");
			} else {
				$lang = $db->query("UPDATE configs SET support_lang = '".$_POST['lang']."' WHERE ip = '".$_SERVER['REMOTE_ADDR']."'");
			}	
		header ("Location: ?");
	}
}

	
	
	
	
$lang = $db->query("SELECT * FROM configs WHERE ip = '". $_SERVER['REMOTE_ADDR']."'");
$langy = $db->fetch($lang);

switch ($langy['support_lang']) {
	case '1':
		$langused = 'pt';
		break;
	case '2':
		$langused = 'en';
		break;
	default:
		$langused = 'en';
		break;
}

require ("files/lang/$langused.php");
require ("config/config.php");

?>