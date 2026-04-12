<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}
if(isset($_GET['action']) && $_GET['action'] == "edit"){
	if($session['hkey'] != $_GET['h']){
		$error = "Desculpe, más o código de segurança está invalido!";
	}
	if(empty($error) && strlen($_POST['memo']) > 10000){
		$error = "Desculpe, más você não pode exeder 10000 caracteres!";
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