<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}

if(!isset($_GET['mode'])) $_GET['mode'] = "player";
$links = array(
	"Tribes" => "ally",
	"Players" => "player",
	"Battle points" => "kill_player",
	"Battle points (tribes)" => "kill_ally",
	"Medals" => "medal"
);
if($_GET['mode'] == "player"){
	include("ranking_player.php");
}elseif($_GET['mode'] == "kill_player"){
	include("ranking_kill_player.php");
}elseif($_GET['mode'] == "ally"){
	include("ranking_ally.php");
}elseif($_GET['mode'] == "kill_ally"){
	include("ranking_kill_ally.php");
}elseif($_GET['mode'] == "medal"){
	include("ranking_medal.php");
}
$allow_mods = array("ally","player","kill_player","kill_ally","medal");
$tpl->assign("allow_mods", $allow_mods);
$tpl->assign("mode", $_GET['mode']);
$tpl->assign("links", $links);
?>