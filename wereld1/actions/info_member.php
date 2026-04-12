<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}

$result = $db->query("SELECT `id`,`short` FROM `ally` WHERE `id`='".parse($_GET['id'])."'");
$ally = $db->fetch($result);
if(empty($ally['id'])){
	exit("Desculpe, más está tribo não existe!");
}
$ally['short'] = entparse($ally['short']);
$members = array();
$rank = 1;
$result = $db->query("SELECT `username`,`ally_titel`,`id`,`points`,`villages` FROM `users` WHERE `ally`='".$ally['id']."' ORDER BY `points` DESC");
while($row = $db->fetch($result)){
	$members[$row['id']]['username'] = entparse($row['username']);
	$members[$row['id']]['rank'] = $rank;
	$members[$row['id']]['titel'] = entparse($row['ally_titel']);
	$members[$row['id']]['points'] = format_number($row['points']);
	$members[$row['id']]['villages'] = $row['villages'];
	++$rank;
}
$tpl->assign("ally", $ally);
$tpl->assign("members", $members);
?>