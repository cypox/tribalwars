<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}

$error = "";
if(isset($_GET['action']) && $_GET['action'] == "change_passwd"){
	if($session['hkey'] != $_GET['h']){
		$error = "Sorry, but the security code is invalid!";
	}
	if(md5($_POST['old_passwd']) == $user['password']){
		if(empty($error) && $_POST['new_passwd'] != $_POST['new_passwd_rpt']){
			$error = "Sorry, but the new password and confirmation must match!";
		}
		if(empty($error) && isset($_POST['new_passwd']) && strlen($_POST['new_passwd']) < 4){
			$error = "Sorry, but the new password must be between 4 and 16 characters!";
		}
		if(empty($error) && isset($_POST['new_passwd']) && strlen($_POST['new_passwd']) > 16){
			$error = "Sorry, but the new password must be between 4 and 16 characters!";
		}
		if(empty($error)){
			$md5 = md5($_POST['new_passwd']);
			$db->query("UPDATE `users` SET `password`='".$md5."' WHERE `id`='".$user['id']."'");
			header("LOCATION: game.php?village=".$village['id']."&screen=settings&mode=change_passwd&changed");
		}
	}else{
		$error = "Sorry, but the current password is invalid!";
	}
}
if(isset($_GET['changed'])){
	$changed = true;
}else{
	$changed = false;
}
$tpl->assign("changed", $changed);
?>