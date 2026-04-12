<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}

if(!isset($_GET['id'])) $_GET['id'] = "";
$villagesql = array("userid","id","name","x","y","continent","points");
$info_village = $villagedatas->getbyid($_GET['id'], $villagesql);
$info_village['name'] = entparse(@$info_village['name']);

$result = $db->query("SELECT `username`,`ally` FROM `users` WHERE `id`='".$info_village['userid']."'");
$info_user = $db->fetch($result);
$info_user['username'] = entparse($info_user['username']);

$result = $db->query("SELECT `short`,`id` FROM `ally` WHERE `id`='".$info_user['ally']."'");
$info_ally = $db->fetch($result);
$info_ally['short'] = entparse($info_ally['short']);

if($info_village['exist_village'] == "0"){
	exit("Desculpe, más está aldeia não existe!");
}

$can_send_ress = ($cl_builds->check_needed('market',$village) && $village['market']>0)?true:false;

$tpl->assign("info_village", $info_village);
$tpl->assign("info_user", $info_user);
$tpl->assign("info_ally", $info_ally);
$tpl->assign("can_send_ress", $can_send_ress);
?>