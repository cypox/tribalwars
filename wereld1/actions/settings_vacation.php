<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != 'sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL'){
	exit;
}

if(isset($_GET['action']) && $_GET['action'] == 'sitter_offer'){
	$c = new do_action($user['id']);
	$c->close();

	if(@$session['hkey'] != $_GET['h']){
		$error = "Desculpe, más o código de segurança está invalido!";
	}

	$username = parse(trim(@$_POST['sitter']));
	$result = $db->query("SELECT `id`,`username` FROM `users` WHERE `username`='".$username."'");
	$row = $db->fetch($result);
	if(empty($error) && empty($row['id'])){
		$error = "Desculpe, más não encontramos nennhum jogador com este nome!";
	}
	if(!empty($user['vacation_name'])){
		$error = "Desculpe, más você ja tem uma solicitação de férias em aberto!";
	}
	if(empty($error) && $row['id'] == $user['id']){
 		$error = "Desculpe, más você não pode ser seu próprio substituto!";
	}
	if(empty($error)){
		$cl_reports->inquires_uv($user['username'],$user['id'],$row['id']);
		$db->query("UPDATE `users` SET `vacation_name`='".$row['username']."',`vacation_id`='".$row['id']."' WHERE `id`=".$user['id']."");
		header("LOCATION: game.php?village=".$village['id']."&screen=settings&mode=vacation");
	}
	$c->open();
}
if(isset($_GET['action']) && $_GET['action'] == 'sitter_offer_cancel' && !$sid->is_vacation()){
	$c = new do_action($user['id']);
	$c->close();

	if(@$session['hkey'] != $_GET['h']){
		$error = "Desculpe, más o código de segurança está invalido!";
	}

	if(empty($error) && $user['vacation_accept'] == 1){
		$error = "Desculpe, más não foi possivel cancelar a solicitação de férias!";
	}
	if(empty($error)){
		$db->query("UPDATE `users` SET `vacation_name`='',`vacation_id`='-1',`vacation_accept`='0' WHERE `id`='".$user['id']."'");
		header("LOCATION: game.php?village=".$village['id']."&screen=settings&mode=vacation");
	}
	$c->open();
}
if(isset($_GET['action']) && $_GET['action'] == 'end_vacation' && $sid->is_vacation()){
	$c = new do_action($user['id']);
	$c->close();

	if(@$session['hkey'] != $_GET['h']){
		$error = "Desculpe, más o código de segurança está invalido!";
	}
	if(empty($error) && $user['vacation_accept'] == '0'){
		$error = "Desculpe, más não é possível terminar a substituição de férias!!";
	}
	if(empty($error)){
		$cl_reports->cancel_uv($user['vacation_name'],$user['vacation_id'],$user['id']);
		$db->query("UPDATE `users` SET `vacation_name`='',`vacation_id`='-1',`vacation_accept`='0' WHERE `id`='".$user['id']."'");
		header("LOCATION: game.php?village=".$village['id']."&screen=settings&mode=vacation");
	}
	$c->open();
}

$vacations = array();
$result = $db->query("SELECT `username`,`id` FROM `users` WHERE `vacation_id`='".$user['id']."'");
while($row = $db->fetch($result)){
	$vacation[$row['id']]['username'] = entparse($row['username']);
}

if(isset($_GET['action']) && $_GET['action']=='sitter_reject' && !$sid->is_vacation()){
	$c = new do_action($user['id']);
	$c->close();

	if(@$session['hkey'] != $_GET['h']){
		$error = "Desculpe, más o código de segurança está invalido!";
	}

	$playerid = trim(parse(@$_GET['player_id']));
	$result = $db->query("SELECT `vacation_id`,`vacation_accept` FROM `users` WHERE `id`='".$playerid."'");
	$row = $db->fetch($result);
	if(empty($error) && empty($row['vacation_id'])){
		$error = "Desculpe, más houve um erro inesperado ao executar está ação!";
	}
	if(empty($error) && $row['vacation_id'] != $user['id']){
		$error = "Desculpe, más está solicitação não pertence a você!";
	}
	if(empty($error) && $row['vacation_accept'] == 1){
		$error = "Desculpe, más não é possível executar está ação!";
	}
	if(empty($error)){
		$cl_reports->reject_uv($user['username'],$user['id'],$playerid);
		$db->query("UPDATE `users` SET `vacation_name`='',`vacation_id`='-1',`vacation_accept`='0' WHERE `id`='".$playerid['id']."'");
		header("LOCATION: game.php?village=".$village['id']."&screen=settings&mode=vacation");
	}
	$c->open();
}
if(isset($_GET['action']) && $_GET['action'] == 'sitter_accept' && !$sid->is_vacation()){
	$c = new do_action($user['id']);
	$c->close();

	if(@$session['hkey'] != $_GET['h']){
		$error = "Desculpe, más o código de segurança está invalido!";
	}

	$playerid = trim(parse(@$_GET['player_id']));
	$result = $db->query("SELECT `vacation_id`,`vacation_accept` FROM `users` WHERE id='".$playerid."'");
	$row = $db->fetch($result);
	if(empty($error) && empty($row['vacation_id'])){
		$error = "Desculpe, más houve um erro inesperado ao executar está ação!";
	}
	if(empty($error) && $row['vacation_id'] != $user['id']){
		$error = "Desculpe, más está solicitação não pertence a você!";
	}
	if(empty($error) && $row['vacation_accept'] == 1){
		$error = "Desculpe, más não é possível executar está ação!";
	}
	if(empty($error)){
		$cl_reports->accept_uv($user['username'],$user['id'],$playerid);
		$db->query("UPDATE `users` SET `vacation_accept`='1' WHERE `id`='".$playerid['id']."'");
		header("LOCATION: game.php?village=".$village['id']."&screen=settings&mode=vacation");
		exit;
	}
	$c->open();
}

$vacation = array();
$vacation_accept = array();
$result = $db->query("SELECT `username`,`id`,`vacation_accept` FROM `users` WHERE `vacation_id`='".$user['id']."'");
while($row = $db->fetch($result)){
	if($row['vacation_accept'] == 1){
		$vacation_accept[$row['id']]['username'] = entparse($row['username']);
	}else{
		$vacation[$row['id']]['username'] = entparse($row['username']);
	}
}
$user['vacation_name'] = entparse($user['vacation_name']);

$tpl->assign("vacation",$vacation);
$tpl->assign("vacation_accept",$vacation_accept);
?>