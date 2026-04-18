<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}
if(isset($_GET['action']) && $_GET['action'] == "edit"){
	if($session['hkey'] != $_GET['h']){
		$error = "Sorry, but the security code is invalid!";
	}
	if(empty($error) && strlen($_POST['memo']) > 10000){
		$error = "Sorry, but you cannot exceed 10000 characters!";
	}
	if(empty($error)){
		$memo = parse($_POST['memo']);
        $db->query("UPDATE `users` SET `memo`='".$memo."' WHERE `id`='".$user['id']."'");
		header("LOCATION: game.php?village=".$village['id']."&screen=memo");
		exit;
	}
}
$memo = array();
$memo['output'] = nl2br(entparse($user['memo']));
$memo['output_textarea'] = parse($user['memo']);
$tpl->assign("memo", $memo);
?>