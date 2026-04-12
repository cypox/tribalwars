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
		$error = "Desculpe, más não encontramos nenhuma tribo com a TAG '".$_POST['tag']."'!";
	}else{
		if($ally['short'] == $tag){
			$error = "Desculpe, más você não pode estabelecer uma relação diplomática com sua própria tribo!";
		}else{
			$getContract = $db->query("SELECT * FROM `ally_contracts` WHERE `short`='".$tag."' AND `from_ally`='".$user['ally']."'");
			if($db->numrows($getContract) != 0){
				$error = "Desulpe, más já existe uma relação diplomática com está tribo!";
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