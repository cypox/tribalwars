<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}

if(isset($_GET['action']) && $_GET['action'] == "block_name"){
	if($session['hkey'] != $_GET['h']){
		exit("Sorry, but the security code is invalid!");
	}

	$player = parse(@$_POST['tribe_name']);
	$result = $db->query("SELECT COUNT(`id`) AS `count`,`username`,`id` FROM `users` WHERE `username`='".$player."' GROUP BY `username`,`id`");
	$row = $db->fetch($result);
	if(empty($error) && $row['count'] == 0){
		$error = "Sorry, but we could not find this player!";
	}
	if(empty($error) && $row['id'] == $user['id']){
		$error = "Sorry, but you cannot block yourself!";
	}
	if(empty($error)){
		$result = $db->query("SELECT COUNT(`id`) AS `count` FROM `mail_block` WHERE `userid`='".$user['id']."' AND `blocked_id`='".$row['id']."'");
		$check = $db->fetch($result);
		if($check['count'] == 1){
			$error = "Sorry, but this player is already blocked!";
		}
	}
	if(empty($error)){
		$db->query("INSERT INTO `mail_block` (`userid`,`blocked_id`,`blocked_name`) VALUES ('".$user['id']."','".$row['id']."','".$row['username']."')");
		header("LOCATION: game.php?village=".$village['id']."&screen=mail&mode=block");
	}
}
if(isset($_GET['action']) && $_GET['action'] == "block_id"){
	if($session['hkey'] != $_GET['h']){
		exit("Sorry, but the security code is invalid!");
	}

	$id = (int)parse(@$_GET['id']);
	$result = $db->query("SELECT COUNT(`id`) AS `count`,`username` FROM `users` WHERE `id`='".$id."' GROUP BY `username`");
	$row = $db->fetch($result);
	if(empty($error) && $row['count'] == 0){
		$error = "Sorry, but we could not find this player!";
	}
	if(empty($error) && $row['id'] == $user['id']){
		$error = "Sorry, but you cannot block yourself!";
	}
	if(empty($error)){
		$result = $db->query("SELECT COUNT(`id`) AS `count` FROM `mail_block` WHERE `userid`='".$user['id']."' AND `blocked_id`='".$id."'");
		$check = $db->fetch($result);
		if($check['count'] == 1){
			$error = "Sorry, but this player is already blocked!";
		}
	}
	if(empty($error)){
		$db->query("INSERT INTO `mail_block` (`userid`,`blocked_id`,`blocked_name`) VALUES ('".$user['id']."','".$id."','".$row['username']."')");
		header("LOCATION: game.php?village=".$village['id']."&screen=mail&mode=block");
	}
}
if(isset($_GET['action']) && $_GET['action'] == "unblock"){
	if($session['hkey'] != $_GET['h']){
		exit("Sorry, but the security code is invalid!");
	}

	$id = (int)parse(@$_GET['from_id']);
	$db->query("DELETE FROM `mail_block` WHERE `userid`='".$user['id']."' AND `blocked_id`='".$id."'");
	header("LOCATION: game.php?village=".$village['id']."&screen=mail&mode=block");
}

$blocked = array();
$result = $db->query("SELECT `id`,`blocked_id`,`blocked_name` FROM `mail_block` WHERE `userid`='".$user['id']."'");
while($row = $db->fetch($result)){
	$blocked[$row['id']]['blocked_id'] = $row['blocked_id'];
	$blocked[$row['id']]['blocked_name'] = entparse($row['blocked_name']);
}

$tpl->assign("blocked",$blocked);
$tpl->assign("error",@$error);
?>