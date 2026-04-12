<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != 'sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL'){
	exit;
}

if(isset($_GET['action']) && $_GET['action'] == 'change_settings'){
	$c = new do_action($user['id']);
	$c->close();
	
	if(@$session['hkey'] != $_GET['h']){
		$error = "Desculpe, más o código de segurança está invalido!";
	}

	$window_width = parse((int)$_POST['screen_width']);
	if(isset($_POST['show_toolbar'])){
		$show_toolbar = 1;
	}else{
		$show_toolbar = 0;
	}
	if(isset($_POST['dyn_menu'])){
		$dyn_menu = 1;
	}else{
		$dyn_menu = 0;
	}
	if($_POST['map_size'] != 7 && $_POST['map_size'] == 9 && $_POST['map_size'] == 11 && $_POST['map_size'] == 13){
		$map_size = 9;
	}else{
		$map_size = parse($_POST['map_size']);
	}
	if(isset($_POST['confirm_queue'])){
		$confirm_queue = 1;
	}else{
		$confirm_queue = 0;
	}
	if(empty($error)){
		$db->query("UPDATE `users` SET `dyn_menu`='".$dyn_menu."',`window_width`='".$window_width."',`show_toolbar`='".$show_toolbar."',`map_size`='".$map_size."',`confirm_queue`='".$confirm_queue."' WHERE `id`='".$user['id']."'");
		header("LOCATION: game.php?village=".$village['id']."&screen=settings&mode=settings");
		$c->open();
		exit;
	}
	$c->open();
}
?>