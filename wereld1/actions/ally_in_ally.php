<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
    exit;
}

if(!isset($_GET['mode'])) $_GET['mode'] = "overview";

$links['Geral'] = "overview";
$links['Perfil'] = "profile";
$links['Membros'] = "members";
if($user['ally_diplomacy'] == 1) $links['Diplomacia'] = "contracts";
if($user['ally_invite'] == 1) $links['Convites'] = "invite";
if($user['ally_lead'] == 1) $links['Boas vindas'] = "intro_igm";
if($user['ally_diplomacy'] == 1) $links['Propriedades'] = "properties";

$result = $db->query("SELECT `id`,`image`,`name`,`short`,`intern_text`,`homepage`,`irc`,`description`,`intro_igm` FROM `ally` WHERE `id`='".$user['ally']."'");
$ally = $db->fetch($result);
$ally['edit_intern_text'] = entparse($ally['intern_text']);
$ally['intern_text'] = nl2br(entparse($ally['intern_text']));
$ally['edit_description'] = entparse($ally['description']);
$ally['description'] = nl2br(entparse($ally['description']));
$ally['name'] = entparse($ally['name']);
$ally['short'] = entparse($ally['short']);
$ally['homepage'] = entparse($ally['homepage']);
$ally['irc'] = entparse($ally['irc']);
$ally['intro_igm'] = entparse($ally['intro_igm']);

if(in_array($_GET['mode'], $links)){
	include("ally_in_ally_".$_GET['mode'].".php");
}
if($_GET['mode'] == "rights"){
	include("ally_in_ally_rights.php");
}
$tpl->assign("mode", $_GET['mode']);
$tpl->assign("links", $links);
$tpl->assign("ally", $ally);
$tpl->assign("error", @$error);
?>