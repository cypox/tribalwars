<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}
if(isset($_GET['action']) && $_GET['action'] == "mod" && $user['ally_lead'] == 1){
	if($session['hkey'] != $_GET['h']){
		$error = "Desculpe, más o código de segurança está invalido!";
	}

	$playerid = trim(parse((int)$_POST['player_id']));
	$result = $db->query("SELECT COUNT(`id`) AS `count`,`ally_found`,`ally` FROM `users` WHERE `id`='".$playerid."' GROUP BY `ally_found`,`ally`");
	$row = $db->fetch($result);
	if($row['count'] == 0){
		header("LOCATION: game.php?village=".$village['id']."&screen=ally&mode=members");
		exit;
    }
	if(empty($error) && $user['ally_found'] == 0 && $row['ally_found'] == 1){
		$error = "Desculpe, más você não pode expulsar um fundador!";
	}
	if(empty($error) && $row['ally'] != $user['ally']){
		$error = "Desculpe, más este jogador não pertence à esta aliança!";
	}
	if(empty($error)){
		if(isset($_POST['action']) && $_POST['action'] == "rights"){
            header("LOCATION: game.php?village=".$village['id']."&screen=ally&mode=rights&player_id=".$playerid);
		}
		if(isset($_POST['action']) && $_POST['action'] == "kick"){
			$result = $db->query("SELECT `ally`,`ally_found`,`username` FROM `users` WHERE `id`='".$playerid."'");
			$row = $db->fetch($result);
			if(empty($error) && $playerid == $user['id']){
				$error = "Desculpe, más você não pode se expulsar!";
            }
			if(!$config['leave_ally']) $error = "Desculpe, más está ação não está permitida!";
			if(empty($error)){
				add_allyevent($user['ally'], "<a href=\"game.php?village=".$village['id']."&amp;screen=info_player&amp;id=".$playerid."\">".entparse($row['username'])."</a> wurde von <a href=\"game.php?village=".$village['id']."&amp;screen=info_player&amp;id=".$user['id']."\">".entparse($user['username'])."</a> entlassen.");
				$db->query("UPDATE `users` SET `ally`='-1' WHERE `id`='".$playerid."'");
				reload_ally_points($user['ally']);
				reload_ally_rangs();
				reload_kill_ally();
				header("LOCATION: game.php?village=".$village['id']."&screen=ally&mode=members");
			}
		}
	}
}
$rank = 1;
$members = array();
$result = $db->query("SELECT `banned`,`vacation_id`,`vacation_name`,`b_day`,`b_month`,`b_year`,`last_activity`,`id`,`username`,`points`,`villages`,`ally_titel`,`ally_found`,`ally_lead`,`ally_invite`,`ally_diplomacy`,`ally_mass_mail` FROM `users` WHERE `ally`='".$user['ally']."' ORDER BY `points` DESC");
while($row = $db->fetch($result)){
	$members[$row['id']]['username'] = entparse($row['username']);
	$members[$row['id']]['rank'] = $rank;
	$members[$row['id']]['points'] = format_number($row['points']);
	$members[$row['id']]['villages'] = $row['villages'];
	$members[$row['id']]['ally_titel'] = entparse($row['ally_titel']);
	if($user['ally_lead'] == 1){
		$members[$row['id']]['ally_found'] = $row['ally_found'];
		$members[$row['id']]['ally_lead'] = $row['ally_lead'];
		$members[$row['id']]['ally_invite'] = $row['ally_invite'];
		$members[$row['id']]['ally_diplomacy'] = $row['ally_diplomacy'];
		$members[$row['id']]['ally_mass_mail'] = $row['ally_mass_mail'];
		$members[$row['id']]['vacation_id'] = $row['vacation_id'];
		$members[$row['id']]['vacation_name'] = $row['vacation_name'];

		$row['bday'] = $row['b_day'].'.'.$row['b_month'];
		$time_inactiv = time()-$row['last_activity'];
		if($row['banned'] == 'Y'){
     		$members[$row['id']]['icons'][] = 'banned';
		}elseif($row['banned'] == "Y"){
			$members[$row['id']]['icons'] = "banned";
		}elseif($time_inactiv >= 604800){
			$members[$row['id']]['icons'] = "red";
		}elseif($time_inactiv >= 172800){
			$members[$row['id']]['icons'] = "yellow";
		}elseif($row['vacation_id'] != '-1'){
			$members[$row['id']]['icons'] = "blue";
		}elseif(date("j.n") == $row['bday']){
			$members[$row['id']]['icons'] = "birthday";
		}else{
			$members[$row['id']]['icons'] = "green";
		}
	}
	++$rank;
}
$tpl->assign("members", $members);
?>