<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}

$logins = array();
$result = $db->query("SELECT `id`,`time`,`ip`,`uv` FROM `logins` WHERE `userid`='".$user['id']."' ORDER BY `id` DESC LIMIT 15");
while($row = $db->fetch($result)){
    $logins[$row['id']]['time'] = format_date($row['time']);
    $logins[$row['id']]['ip'] = $row['ip'];
    $logins[$row['id']]['uv'] = entparse($row['uv']);
}
$tpl->assign("logins", $logins);
?>