<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}

$error = "";
if(isset($_GET['screen']) && $_GET['screen'] == "ally" && isset($_GET['mode']) && $_GET['mode'] == "contracts"){
	$getContractsP = $db->query("SELECT * FROM `ally_contracts` WHERE `from_ally`='".$user['ally']."' AND `type`='partner'");
	$getContractsN = $db->query("SELECT * FROM `ally_contracts` WHERE `from_ally`='".$user['ally']."' AND `type`='nap'");
	$getContractsE = $db->query("SELECT * FROM `ally_contracts` WHERE `from_ally`='".$user['ally']."' AND `type`='enemy'");
    $contracts = array();
	while($getContractsRowP = $db->fetch($getContractsP)){
		$contracts['partner'][] = $getContractsRowP;
	}
	while($getContractsRowN = $db->fetch($getContractsN)){
		$contracts['nap'][] = $getContractsRowN;
	}
	while($getContractsRowE = $db->fetch($getContractsE)){
		$contracts['enemy'][] = $getContractsRowE;
	}
	$tpl->assign("contracts", $contracts);
}
if(isset($_GET['action']) && $_GET['action'] == "add_contract" && !empty($_POST['tag'])){
	$tag = parse($_POST['tag']);
	$getTribe = $db->query("SELECT * FROM `ally` WHERE `short` = '".$tag."'");
	$getTribeRow = $db->fetch($getTribe);

	if($db->numrows($getTribe) == 0){
		$error = "Sorry, but we could not find any tribe with the TAG '".$_POST['tag']."'!";
	}else{
		if($ally['short'] == $tag){
			$error = "Sorry, but you cannot establish a diplomatic relation with your own tribe!";
		}else{
			$getContract = $db->query("SELECT * FROM `ally_contracts` WHERE `short`='".$tag."' AND `from_ally`='".$user['ally']."'");
			if($db->numrows($getContract) != 0){
				$error = "Sorry, but a diplomatic relation with this tribe already exists!";
			}
		}
	}
	if(empty($error)){
		$db->query("INSERT INTO `ally_contracts` (`from_ally`,`to_ally`,`type`,`short`) VALUES ('".$user['ally']."','".$getTribeRow['id']."','".parse($_POST['type'])."','".$tag."')");
		header("LOCATION: game.php?village=".$village['id']."&screen=ally&mode=contracts");
	}
}
if(isset($_GET['action']) && $_GET['action'] == "cancel_contract" && isset($_GET['id']) && is_numeric($_GET['id'])){
	$db->query("DELETE FROM `ally_contracts` WHERE `id`='".parse($_GET['id'])."'");
	header("LOCATION: game.php?village=".$village['id']."&screen=ally&mode=contracts");
}

$tpl->assign("error", $error);
?>