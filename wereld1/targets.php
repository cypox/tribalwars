<?php
require_once("include.inc.php");

$sid = new sid();
$session = $sid->check_sid($_COOKIE['session']);
if(!$session['userid']){
	header("LOCATION: sid_wrong.php");
	exit;
}

$getUser = $db->query("SELECT `userid` FROM `villages` WHERE `id`='".parse($_GET['village'])."'");
$check = $db->fetch($getUser);
if($check['userid'] != $session['userid']){
    exit("Desculpe, más não foi possivel localizar aldeias!");
}
$userId = $session['userid'];
$getVillages = $db->query("SELECT * FROM `villages` WHERE `userid`='".$userId."' AND `id`!='".parse($_GET['village'])."'");
$villages = array();
while($village = $db->fetch($getVillages)){
	$village['name'] = entparse($village['name']);
	$villages[] = $village;
}

$tpl = new TWLan_Smarty();
$tpl->assign("villages", $villages);
$tpl->assign("village", @$_GET['village']);
$tpl->display("targets.tpl");
?>