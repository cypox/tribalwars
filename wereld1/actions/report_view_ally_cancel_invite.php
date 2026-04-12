<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}

$result = $db->query("SELECT `username` FROM `users` WHERE `id`='".$report['from_user']."'");
$arr = $db->fetch($result);
$report['from_username'] = entparse($arr['username']);

$result = $db->query("SELECT COUNT(`id`) AS `count` FROM `ally` WHERE `id`='".$report['ally']."'" );
$arr = $db->fetch($result);
$report['ally_exist'] = $arr['count'];
$report['allyname'] = entparse($report['allyname']);
?>