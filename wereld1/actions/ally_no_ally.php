<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}
$error = "";
if(isset($_GET['action']) && $_GET['action'] == "create"){
	$c = new do_action($user['id']);
	$c->close();
	if($session['hkey'] != $_GET['h']){
		$error = "Sorry, but the security code is invalid!";
	}
	if(!$config['create_ally']) $error = "Sorry, but this action is not permitted!";

    $_POST['name'] = trim($_POST['name']);
    $_POST['tag'] = trim($_POST['tag']);
	if(empty($error) && strlen($_POST['name']) < 4){
		$error = "Sorry, but the tribe name must be between 4 and 32 characters!";
	}
	if(empty($error) && strlen($_POST['name']) > 32){
		$error = "Sorry, but the tribe name must be between 4 and 32 characters!";
	}
	if(empty($error) && strlen($_POST['tag']) < 2){
		$error = "Sorry, but the tribe TAG must be between 2 and 6 characters!";
	}
	if(empty($error) && strlen($_POST['tag']) > 6){
		$error = "Sorry, but the tribe TAG must be between 2 and 6 characters!";
	}
	$result = $db->query("SELECT COUNT(`id`) AS `count` FROM `ally` WHERE `name`='".parse($_POST['name'])."'");
	$row = $db->fetch($result);
	if(empty($error) && $row['count'] > 0){
		$error = "Sorry, but the name '".$_POST['name']."' is already in use!";
	}
	$result = $db->query("SELECT COUNT(`id`) AS `count` FROM `ally` WHERE `short`='".parse($_POST['tag'])."'");
	$row = $db->fetch($result);
	if(empty($error) && $row['count'] > 0){
		$error = "Sorry, but the TAG '".$_POST['tag']."' is already in use!";
	}
	if($user['ally'] != '-1'){
			$error = "Sorry, but you already belong to a tribe!";
	}
	if(empty($error)){
		$intern_text = parse("Tribe founded by [player]".entparse($user['username'])."[/player]\n\nThis text can be edited by tribe administrators.");
		$description = parse("[ally]".$_POST['tag']."[/ally] was founded by [player]".entparse($user['username'])."[/player].\nFor questions please contact [player]".entparse($user['username'])."[/player]\n\nThis text can be edited by tribe diplomats.");
		$db->query("INSERT INTO `ally` (`short`,`name`,`intern_text`,`description`) VALUES ('".parse($_POST['tag'])."','".parse($_POST['name'])."','".$intern_text."','".$description."')");
		$id = $db->getlastid();
		$db->query("UPDATE `users` SET `ally`=".$id.",`ally_titel`='',`ally_found`='1',`ally_lead`='1',`ally_invite`='1',`ally_diplomacy`='1',`ally_mass_mail`='1' WHERE `id`='".$user['id']."'");
		reload_ally_points($id);
		reload_ally_rangs();
		reload_kill_ally();
        add_allyevent($id, "Tribe founded by <a href=\"game.php?village=;&screen=info_player&id=".$user['id']."\">".entparse($user['username'])."</a>.");
		header("LOCATION: game.php?village=".$village['id']."&screen=ally");
        $c->open();
	}
	$c->open();
}
if(isset($_GET['action']) && $_GET['action'] == "accept"){
	$c = new do_action($user['id']);
	$c->close();
	if($session['hkey'] != $_GET['h']){
		$error = "Sorry, but the security code is invalid!";
	}
	$id = (int)parse($_GET['id']);
	$result = $db->query("SELECT `to_userid`,`from_ally`,`id` FROM `ally_invites` WHERE `id`='".$id."'");
	$row = $db->fetch($result);
		if($user['id'] != $row['to_userid']){
			$c->open();
			exit("UNKNOWN ERROR!");
		}
	if(empty($error)){
		$db->query("DELETE FROM `ally_invites` WHERE `id`='".$id."'");
        if($db->affectedrows() != 0){
			$db->query("UPDATE `users` SET `ally`='".$row['from_ally']."',`ally_titel`='',`ally_found`='0',`ally_lead`='0',`ally_invite`='0',`ally_diplomacy`='0',`ally_mass_mail`='0' WHERE `id`='".$user['id']."'");
			$getIntro = $db->query("SELECT `short`,`name`,`intro_igm` FROM `ally` WHERE `id`='".$row['from_ally']."'");
			while($getIntroRow = $db->fetch($getIntro)){
				$allyIntro = $getIntroRow['intro_igm'];
				$allyShort = $getIntroRow['short'];
				$allyName = $getIntroRow['name'];
			}
			if(!empty($allyIntro)) send_mail(-1, "Tribe", $user['id'], $user['username'], "Welcome to ".$allyShort, $allyIntro, false);
			reload_ally_points($row['from_ally']);
			reload_ally_rangs();
			reload_kill_ally();
			$db->query("DELETE FROM `ally_invites` WHERE `to_userid`='".$user['id']."'");
			add_allyevent($row['from_ally'], "<a href=\"game.php?village=;&screen=info_player&id=".$user['id']."\">".entparse($user['username'])."</a> joined the tribe.");
			$c->open();
			header("LOCATION: game.php?village=".$village['id']."&screen=ally");
			exit;
		}
	}
	$c->open();
}
if(isset($_GET['action']) && $_GET['action'] == "reject" ){
	$c = new do_action($user['id']);
	$c->close();
	if($session['hkey'] != $_GET['h']){
		$error = "Sorry, but the security code is invalid!";
	}
	$id = (int)parse($_GET['id']);
	$result = $db->query("SELECT `to_userid`,`from_ally`,`id` FROM `ally_invites` WHERE `id`=".$id);
	$row = $db->query($result);
	if($user['id'] != $row['to_userid']){
		$c->open();
		exit("ERRO DESCONHECIDO!");
	}
	if(empty($error)){
		$db->query("DELETE FROM `ally_invites` WHERE `id`='".$id."'");
        if($affectedrows() != 0){
			add_allyevent($row['from_ally'], "<a href=\"game.php?village=;&screen=info_player&id=".$user['id']."\">".entparse($user['username'])."</a> rejected the invitation.");
			$c->open();
			header("LOCATION: game.php?village=".$village['id']."&screen=ally");
			exit;
		}
	}
	$c->open();
}
$invites = array();
$result = $db->query("SELECT `from_ally`,`id` FROM `ally_invites` WHERE `to_userid`='".$user['id']."'");
while($row = $db->fetch($result)){
	$invites[$row['id']]['from_ally'] = $row['from_ally'];
	$res = $db->query("SELECT `short` FROM `ally` WHERE `id`='".$row['from_ally']."'");
	$r = $db->fetch($res);
	$invites[$row['id']]['tag'] = entparse($r['short']);
}
$tpl->assign("invites", $invites);
$tpl->assign("error", $error);
?>