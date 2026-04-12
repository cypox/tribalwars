<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}

$error = "";
if(isset($_GET['action']) && $_GET['action'] == "change_passwd"){
	if($session['hkey'] != $_GET['h']){
		$error = "Desculpe, más o código de segurança está invalido!";
	}
	if(md5($_POST['old_passwd']) == $user['password']){
		if(empty($error) && $_POST['new_passwd'] != $_POST['new_passwd_rpt']){
			$error = "Desculpe, más a nova senha e a confirmação devem ser iguais!";
		}
		if(empty($error) && isset($_POST['new_passwd']) && strlen($_POST['new_passwd']) < 4){
			$error = "Desculpe, más a nova senha deve ter entre 4 e 16 caracteres!";
		}
		if(empty($error) && isset($_POST['new_passwd']) && strlen($_POST['new_passwd']) > 16){
			$error = "Desculpe, más a nova senha deve ter entre 4 e 16 caracteres!";
		}
		if(empty($error)){
			$md5 = md5($_POST['new_passwd']);
			$db->query("UPDATE `users` SET `password`='".$md5."' WHERE `id`='".$user['id']."'");
			header("LOCATION: game.php?village=".$village['id']."&screen=settings&mode=change_passwd&changed");
		}
	}else{
		$error = "Desculpe, más a senha atual está invalida!";
	}
}
if(isset($_GET['changed'])){
	$changed = true;
}else{
	$changed = false;
}
$tpl->assign("changed", $changed);
?>