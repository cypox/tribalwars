<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}
if(!($user['ally_lead'] == 1)){
	exit("Desculpe, más você não tem permissão para acessar está página!");
}

$playerid = trim(parse((int)$_GET['player_id']));
$result = $db->query("SELECT `ally`,`ally_found`,`id`,`username` FROM `users` WHERE `id`='".$playerid."'");
$rights = $db->fetch($result);

$result = $db->query("SELECT COUNT(`id`) AS `count`,`ally_titel`,`ally_found`,`ally_lead`,`ally_invite`,`ally_diplomacy`,`ally_mass_mail`,`ally` FROM `users` WHERE `id`='".$playerid."' GROUP BY `ally_titel`,`ally_found`,`ally_lead`,`ally_invite`,`ally_diplomacy`,`ally_mass_mail`,`ally`");
$row = $db->fetch($result);
if($row['count'] == 0){
    header("LOCATION: game.php?village=".$village['id']."&screen=ally&mode=members");
    exit;
}
if($user['ally_found'] == 0 && $row['ally_found'] == 1){
	exit("Desculpe, más você não pode alterar o cargo de um fundador!");
}
if($row['ally'] != $user['ally']){
	exit("Desculpe, más este jogador não pertence a está aliança!!");
}
if(isset($_GET['action']) || $_GET['action'] == "edit_rights"){
	$found = $_POST['found'] == "on" ? 1 : 0;
	$lead = $_POST['lead'] == "on" ? 1 : 0;
	$diplomacy = $_POST['diplomacy'] == "on" ? 1 : 0;
	$invite = $_POST['invite'] == "on" ? 1 : 0;
	$mass_mail = $_POST['mass_mail'] == "on" ? 1 : 0;
	$title = parse(substr($_POST['title'], 0, 24));
    if($row['ally_found'] == 1 && $found == 0){
        $result = $db->query("SELECT COUNT(`id`) AS `count` FROM `users` WhERE `ally`='".$user['ally']."' AND `ally_found`='1'");
		$row_c = $db->fetch($result);
		if($row_c['count'] == 1){
			$error = "Desculpe, más você é o unico fundador, não pode ignorar estes direitos!";
		}
	}
	if($user['ally_found'] == 0 && $found == 1){
		$error = "Desculpe, más você não pode nomear um fundador!!";
	}
	if(empty($error)){
		if($found == 1){
			$lead = 1;
			$diplomacy = 1;
			$invite = 1;
			$mass_mail = 1;
		}
		if($lead == 1){
			$diplomacy = 1;
			$invite = 1;
			$mass_mail = 1;
		}
		$db->query("UPDATE `users` SET `ally_titel`='".$title."',`ally_found`='".$found."',`ally_lead`='".$lead."',`ally_diplomacy`='".$diplomacy."',`ally_invite`='".$invite."',`ally_mass_mail`='".$mass_mail."' WHERE `id`='".$playerid."'");
		add_allyevent($user['ally'], "<a href=\"game.php?village=;&screen=info_player&id=".$user['id']."\">".entparse($user['username'])."</a> alterou titulos e permissões de <a href=\"game.php?village=;&screen=info_player&id=".$rights['id']."\">".entparse($rights['username'])."</a>.");
		header("LOCATION: game.php?village=".$village['id']."&screen=ally&mode=rights");
	}
}
$rights['username'] = entparse($rights['username']);
$rights['ally_titel'] = entparse($row['ally_titel']);
$rights['ally_lead'] = $row['ally_lead'];
$rights['ally_invite'] = $row['ally_invite'];
$rights['ally_diplomacy'] = $row['ally_diplomacy'];
$rights['ally_mass_mail'] = $row['ally_mass_mail'];
$rights['id'] = $playerid;
$tpl->assign("rights", $rights);
?>