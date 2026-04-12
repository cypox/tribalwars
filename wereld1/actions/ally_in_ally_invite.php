<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}
if(isset($_GET['action']) && $_GET['action'] == "invite"){
	if($session['hkey'] != $_GET['h']){
		$error = "Desculpe, más o código de segurança está invalido!";
	}
	if(!$config['leave_ally']) $error = "Desculpe, más está ação não está permitida!";

	$username = parse($_POST['name']);
    $result = $db->query("SELECT `id`,`username`,`ally` FROM `users` WHERE `username`='".$username."'");
	$row = $db->fetch($result);
	if($user['ally'] == $row['ally']){
		$error = "Desulpe más este jogador já pertence à tribo!";
	}
	if(empty($error) && empty($row['id'])){
		$error = "Desculpe más não encontramos nenhum jogador com este nome!";
    }

    $result = $db->query("SELECT COUNT(`id`) AS `count` FROM `ally_invites` WHERE `to_userid`='".$row['id']."' AND `from_ally`='".$user['ally']."'");
	$invite_row = $db->fetch($result);
	if($invite_row['count'] > 0){
		$error = "Desculpe, más este jogador já foi convidado!";
	}
	if(empty($error)){
        $db->query("INSERT INTO `ally_invites` (`time`,`from_ally`,`to_userid`,`to_username`) VALUES ('".time()."','".$user['ally']."','".$row['id']."','".$row['username']."')" );
		$cl_reports->ally_invite(entparse($user['username']), $user['id'], $row['id'], $user['ally'], $ally['name']);
		add_allyevent($user['ally'], "<a href=\"game.php?village=;&screen=info_player&id=".$row['id']."\">".entparse($row['username'])."</a> foi convidado por <a href=\"game.php?village=;&screen=info_player&id=".$user['id']."\">".entparse($user['username'])."</a>.");
        $d->open();
        header("LOCATION: game.php?village=".$village['id']."&screen=ally&mode=invite");
        exit;
    }
    $d->open();
}
if(isset($_GET['action']) && $_GET['action'] == "invite_id"){
	if($session['hkey'] != $_GET['h']){
		$error = "Desculpe, más o código de segurança está invalido!";
	}
	if(!$config['leave_ally']) $error = "Desculpe, más está ação não está permitida!";

	$id = (int)parse($_GET['id']);
	$result = $db->query("SELECT `id`,`username`,`ally` FROM `users` WHERE `id`='".$id."'");
	$row = $db->fetch($result);
	if($user['ally'] == $row['ally']){
		$error = "Desulpe más este jogador já pertence à tribo!";
	}
	if(empty($error) && empty($row['id'])){
		$error = "Desculpe más não encontramos nenhum jogador com este nome!";
    }

    $result = $db->query("SELECT COUNT(`id`) AS `count` FROM `ally_invites` WHERE `to_userid`='".$row['id']."' AND `from_ally`='".$user['ally']."'");
	$invite_row = $db->fetch($result);
	if($invite_row['count'] > 0){
		$error = "Desculpe, más este jogador já foi convidado!";
	}
	if(empty($error)){
        $db->query("INSERT INTO `ally_invites` (`time`,`from_ally`,`to_userid`,`to_username`) VALUES ('".time()."','".$user['ally']."','".$row['id']."','".$row['username']."')" );
		$cl_reports->ally_invite(entparse($user['username']), $user['id'], $row['id'], $user['ally'], $ally['name']);
		add_allyevent($user['ally'], "<a href=\"game.php?village=;&screen=info_player&id=".$row['id']."\">".entparse($row['username'])."</a> foi convidado por <a href=\"game.php?village=;&screen=info_player&id=".$user['id']."\">".entparse($user['username'])."</a>.");
        $d->open();
        header("LOCATION: game.php?village=".$village['id']."&screen=ally&mode=invite");
        exit;
    }
    $d->open();
}
if(isset($_GET['action']) && $_GET['action'] == "cancel_invitation"){
	if($session['hkey'] != $_GET['h']){
		$error = "Desculpe, más o código de segurança está invalido!";
	}

	$id = (int)parse($_GET['id']);
    $result = $db->query("SELECT `from_ally`,`to_userid` FROM `ally_invites` WHERE `id`='".$id."'");
	$row = $db->fetch($result);
	if(empty($error) && $row['from_ally'] != $user['ally']){
		$error = "Desculpe, más este convite não pertence a sua tribo!";
	}
	if(empty($error)){
		$db->query("DELETE FROM `ally_invites` WHERE `id`='".$id."'");
        if($db->affectedrows() == 0){
			$error = "Desculpe, más a ação não pode ser executada!";
		}else{
            $cl_reports->ally_cancel_invite($user['id'], $row['to_userid'], $user['ally'], $ally['name']);
			$result = $db->query("SELECT `username` FROM `users` WHERE `id`='".$row['to_userid']."'");
            $user_to = $db->fetch($result);
            add_allyevent($user['ally'], "O convite para <a href=\"game.php?village=;&screen=info_player&id=".$row['to_userid']."\">".entparse($user_to['username'])."</a> foi cancelado por <a href=\"game.php?village=;&screen=info_player&id=".$user['id']."\">".entparse($user['username'])."</a>.");
            $d->open();
            header("LOCATION: game.php?village=".$village['id']."&screen=ally&mode=invite");
            exit;
		}
	}
	$d->open();
}
$invites = array();
$result = $db->query("SELECT `id`,`to_username`,`to_userid`,`time` FROM `ally_invites` WHERE `from_ally`='".$user['ally']."' ORDER BY `time`");
while($row = $db->fetch($result)){
	$invites[$row['id']]['to_username'] = entparse($row['to_username']);
	$invites[$row['id']]['to_userid'] = $row['to_userid'];
	$invites[$row['id']]['time'] = format_date($row['time']);
}
$tpl->assign("invites", $invites);
?>