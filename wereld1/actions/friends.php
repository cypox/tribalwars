<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}

if(isset($_GET['action']) && $_GET['action'] == "approve_buddy" && !empty($_GET['id'])){
	$buddy_id = parse($_GET['id']);

	$sql = $db->query("SELECT * FROM `friends` WHERE `to_userid`='".$user['id']."' AND `id`='".$buddy_id."'");
	$check = $db->numrows($sql);
	$row = $db->fetch($sql);
	if($check == 1){
		$db->query("UPDATE `friends` SET `status`='activ' WHERE `id`='".$buddy_id."'");
		$db->query("UPDATE `medal` SET `friends`=`friends`+'1' WHERE `userid`='".$user['id']."'");
		$db->query("UPDATE `medal` SET `friends`=`friends`+'1' WHERE `userid`='".$row['from_userid']."'");
		$cl_reports->approve_buddy($user['username'],$user['id'],$row['from_userid']);
		header("LOCATION: game.php?village=".$village['id']."&screen=friends");
		exit;
	}else{
		$error = "Desculpe, más você não pode adicionar a si mesmo!";
	}
}
if(isset($_GET['action']) && $_GET['action'] == "reject_buddy" && !empty($_GET['id'])){
	$buddy_id = parse($_GET['id']);

	$sql = $db->query("SELECT * FROM `friends` WHERE `to_userid`='".$user['id']."' AND `id`='".$buddy_id."'");
	$check = $db->numrows($sql);
	$row = $db->fetch($sql);
	if($check == 1){
		$db->query("DELETE FROM `friends` WHERE `id`='".$buddy_id."'");
		$cl_reports->reject_buddy($user['username'],$user['id'],$row['from_userid']);
		header("LOCATION: game.php?village=".$village['id']."&screen=friends");
		exit;
	}else{
		$error = "Desculpe, más você não pode adicionar a si mesmo!";
	}
}
if(isset($_GET['action']) && $_GET['action'] == "add_buddy" && !empty($_POST['name'])){
	$name = parse($_POST['name']);

	$sql = $db->query("SELECT * FROM `users` WHERE `username`='".$name."' LIMIT 1");
	$check = $db->numrows($sql);
	if($check != 1){
		$error = "Desculpe, más não encontramos um jogador com este nome!";
	}elseif($check == 1){
		$row = $db->fetch($sql);
		if($row['id'] != $user['id']){
			$sql = $db->query("SELECT * FROM `friends` WHERE `from_userid`='".$user['id']."' AND `to_userid`='".$row['id']."' OR `to_userid`='".$user['id']."' AND `from_userid`='".$row['id']."' LIMIT 1");
			$check = $db->numrows($sql);
			if($check != 1){
				$db->query("INSERT INTO `friends` (`from_userid`,`to_userid`,`status`) VALUES ('".$user['id']."','".$row['id']."','pending')");
				$cl_reports->add_buddy($user['username'],$user['id'],$row['id']);
				header("LOCATION: game.php?village=".$village['id']."&screen=friends");
				exit;
			}else{
				$error = "Desculpe, más o jogador ".entparse($name)." já está em sua lista de amigos";
			}
		}else{
			$error = "Desculpe, más você não pode adicionar a si mesmo!";
		}
	}
}
if(isset($_GET['action']) && $_GET['action'] == "add_buddy_id" && !empty($_GET['id'])){
	$id = parse($_GET['id']);

	$sql = $db->query("SELECT * FROM `users` WHERE `id`='".$id."' LIMIT 1");
	$check = $db->numrows($sql);
	if($check != 1){
		$error = "Desculpe, más não encontramos este jogador!";
	}elseif($check == 1){
		$row = $db->fetch($sql);
		if($row['id'] != $user['id']){
			$sql = $db->query("SELECT * FROM `friends` WHERE `from_userid`='".$user['id']."' AND `to_userid`='".$row['id']."' OR `to_userid`='".$user['id']."' AND `from_userid`='".$row['id']."' LIMIT 1");
			$check = $db->numrows($sql);
			if($check != 1){
				$db->query("INSERT INTO `friends` (`from_userid`,`to_userid`,`status`) VALUES ('".$user['id']."','".$row['id']."','pending')");
				$cl_reports->add_buddy($user['username'],$user['id'],$row['id']);
				header("LOCATION: game.php?village=".$village['id']."&screen=friends");
				exit;
			}else{
				$error = "Desculpe, más o jogador ".entparse($row['username'])." já está em sua lista de amigos";
			}
		}else{
			$error = "Desculpe, más você não pode adicionar a si mesmo!";
		}
	}
}
if(isset($_GET['action']) && $_GET['action'] == "delete_buddy" && !empty($_GET['id'])){
	$buddy_id = parse($_GET['id']);

	$sql = $db->query("SELECT * FROM `friends` WHERE (`to_userid`='".$user['id']."' OR `from_userid`='".$user['id']."') AND `status`='activ' AND `id`='".$buddy_id."' LIMIT 1");
	$check = $db->numrows($sql);
	$row = $db->fetch($sql);
	if($check == 1){
		$db->query("DELETE FROM `friends` WHERE `id`='".$buddy_id."'");
		if($row['to_userid'] == $user['id']){
			$id_all = $row['from_userid'];
		}elseif($row['from_userid'] == $user['id']){
			$id_all = $row['to_userid'];
		}
		$cl_reports->delete_buddy($user['username'],$user['id'],$id_all);
		header("LOCATION: game.php?village=".$village['id']."&screen=friends");
		exit;
	}else{
		$error = "Desculpe, más não foi possivel executar está ação!";
	}
}
if(isset($_GET['action']) && $_GET['action'] == "cancel_buddy" && !empty($_GET['id'])){
	$buddy_id = parse($_GET['id']);

	$sql = $db->query("SELECT * FROM `friends` WHERE `from_userid`='".$user['id']."' AND `id`='".$buddy_id."'");
	$check = $db->numrows($sql);
	$row = $db->fetch($sql);
	if($check == 1){
		$db->query("DELETE FROM `friends` WHERE `id`='".$buddy_id."'");
		$cl_reports->cancel_buddy($user['username'],$user['id'],$row['to_userid']);
		header("LOCATION: game.php?village=".$village['id']."&screen=friends");
		exit;
	}else{
		$error = "Desculpe, más não foi possivel executar está ação!";
	}
}


$getFriendsA = $db->query("SELECT `id`,`from_userid`,`to_userid` FROM `friends` WHERE (`to_userid`='".$user['id']."' OR `from_userid`='".$user['id']."') AND `status`='activ'");
$getFriendsP = $db->query("SELECT `id`,`to_userid` FROM `friends` WHERE `from_userid`='".$user['id']."' AND `status`='pending'");
$getFriendsR = $db->query("SELECT `id`,`from_userid` FROM `friends` WHERE `to_userid`='".$user['id']."' AND `status`='pending'");
$friends = array();
while($getFriendsRowA = $db->fetch($getFriendsA)){
	if($getFriendsRowA['from_userid'] == $user['id']){
		$getFriendsRowA['id_all'] = $getFriendsRowA['to_userid'];
	}else{
		$getFriendsRowA['id_all'] = $getFriendsRowA['from_userid'];
	}
	$User = $db->fetch($db->query("SELECT * FROM `users` WHERE `id`='".$getFriendsRowA['id_all']."'"));
	$getFriendsRowA['name'] = entparse($User['username']);
	$getFriendsRowA['uid'] = $User['id'];
	if($User['last_activity'] >= (time()-300)){
		$getFriendsRowA['status'] = true;
	}else{
		$getFriendsRowA['status'] = false;
	}
	$friends['activ'][] = $getFriendsRowA;
}
while($getFriendsRowP = $db->fetch($getFriendsP)){
	$User = $db->fetch($db->query("SELECT * FROM `users` WHERE `id`='".$getFriendsRowP['to_userid']."'"));
	$getFriendsRowP['name'] = entparse($User['username']);
	$getFriendsRowP['uid'] = $User['id'];
	$friends['pending'][] = $getFriendsRowP;
}
while($getFriendsRowR = $db->fetch($getFriendsR)){
	$User = $db->fetch($db->query("SELECT * FROM `users` WHERE `id`='".$getFriendsRowR['from_userid']."'"));
	$getFriendsRowR['name'] = entparse($User['username']);
	$getFriendsRowR['uid'] = $User['id'];
	$friends['request'][] = $getFriendsRowR;
}

$tpl->assign("error", $error);
$tpl->assign("friends", $friends);
?>