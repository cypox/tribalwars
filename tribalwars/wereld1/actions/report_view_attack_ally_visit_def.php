<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != 'sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL'){
	exit;
}

$result = $db->query("SELECT `name`,`x`,`y`,`continent` FROM `villages` WHERE `id`='".$report['to_village']."'");
$arr = $db->fetch($result);
$report['to_villagename'] = entparse($arr['name']);
$report['to_x'] = $arr['x'];
$report['to_y'] = $arr['y'];
$report['to_continent'] = $arr['continent'];
$result = $db->query("SELECT `username` FROM `users` WHERE `id`='".$report['from_user']."'");
$arr = $db->fetch($result);
$report['from_username'] = entparse($arr['username']);
?>
