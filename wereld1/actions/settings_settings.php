<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != 'sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL'){
	exit;
}

$w = '';
$has_winter_column = false;
$winter_column_result = $db->query("SHOW COLUMNS FROM `users` LIKE 'winter'");
if($db->numrows($winter_column_result) > 0){
	$has_winter_column = true;
	$winter_result = $db->query("SELECT `winter` FROM `users` WHERE `id`='".$user['id']."' LIMIT 1");
	$winter_row = $db->fetch($winter_result);
	if(is_array($winter_row) && isset($winter_row['winter'])){
		$w = $winter_row['winter'];
	}
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
	$winter = isset($_POST['winter']) ? 'winter' : '';
	if(empty($error)){
		$sql = "UPDATE `users` SET `dyn_menu`='".$dyn_menu."',`window_width`='".$window_width."',`show_toolbar`='".$show_toolbar."',`map_size`='".$map_size."',`confirm_queue`='".$confirm_queue."'";
		if($has_winter_column){
			$sql .= ",`winter`='".$winter."'";
		}
		$sql .= " WHERE `id`='".$user['id']."'";
		$db->query($sql);
		header("LOCATION: game.php?village=".$village['id']."&screen=settings&mode=settings");
		$c->open();
		exit;
	}
	$c->open();
}

$tpl->assign("w", $w);
?>