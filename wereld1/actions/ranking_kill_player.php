<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}

if(empty($_GET['type'])) $_GET['type'] = "att";

$links_kill = array(
	"Como atacante" => "att",
	"Como defensor" => "def",
	"Total" => "all"
);
$allow_mods_kill = array("att","def","all");
if(in_array($_GET['type'], $allow_mods_kill)){
	require_once("ranking_kill_player_".$_GET['type'].".php");
}
$tpl->assign("allow_mods_kill", $allow_mods_kill);
$tpl->assign("type", $_GET['type']);
$tpl->assign("links_kill", $links_kill);
?>