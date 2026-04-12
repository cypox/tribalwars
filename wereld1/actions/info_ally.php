<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}
$result = $db->query("SELECT `image`,`id`,`irc`,`homepage`,`name`,`short`,`points`,`rank`,`best_points`,`members`,`villages`,`description` FROM `ally` WHERE `id`='".parse($_GET['id'])."'");
$info = $db->fetch($result);
if(empty($info['id'])){
	exit("Desculpe, más está tribo não existe!");
}
$info['homepage'] = entparse($info['homepage']);
$info['irc'] = entparse($info['irc']);
$info['name'] = entparse($info['name']);
$info['short'] = entparse($info['short']);
$info['description'] = nl2br(entparse($info['description']));
$info['cutthroungt'] = round($info['points']/$info['members']);
$tpl->assign("info", $info);
?>