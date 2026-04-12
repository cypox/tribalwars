<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}

if(!isset($_GET['mode'])) $_GET['mode'] = "profile";

$links = array(
	"Perfil" => "profile",
	"Minha conta" => "settings",
	"Modo de férias" => "vacation",
	"Acessos" => "logins",
	"Trocar senha" => "change_passwd"
);
if(in_array($_GET['mode'], $links)){
	include("settings_".$_GET['mode'].".php");
}
$tpl->assign("allow_mods", $allow_mods);
$tpl->assign("mode", $_GET['mode']);
$tpl->assign("links", $links);
$tpl->assign("error", $error);
?>