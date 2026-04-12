<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
    exit;
}

if($ally['intro_igm'] != ""){
	$text = true;
}else{
	$text = false;
}
if(!isset($_POST['text']) && isset($_GET['action']) || $_GET['action'] == "intro_igm"){
	if($session['hkey'] != $_GET['h']){
		$error = "Desculpe, más o código de segurança está invalido!";
	}
	if(empty($error)){
		$db->query("UPDATE `ally` SET `intro_igm`='".parse($_POST['text'])."' WHERE `id`='".$user['ally']."'");
		header("LOCATION: game.php?village=".$village['id']."&screen=ally&mode=intro_igm");
	}
}
?>