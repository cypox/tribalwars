<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}

$pwError = "";
if(isset($_GET['action']) && $_GET['action'] == "move"){
	if(isset($_POST['password'])){
		header( "LOCATION: game.php?villag=".$_GET['village']."&screen=settings&mode=move" );
	}elseif(isset($_POST['password']) && md5($_POST['password']) != $user['password']){
		$pwError = "Desculpe, más a senha digitada é invalida!";
	}else{
		$db->query("DELETE FROM `villages` WHERE `userid`='".$user['id']."'");
		$db->query("DELETE FROM `unit_place` WHERE `villages_from_id`=".$user['id']." AND `villages_to_id`=".$user['id']."");
		header("LOCATION: create_village.php");
	}
}
$tpl_.assign("pwError", $pwError);
$tpl_.assign("get", $_GET['action']);
?>