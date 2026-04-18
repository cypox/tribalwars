<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}

if(isset($_GET['action']) && isset($_GET['building_id']) && $_GET['action'] == "destroy"){
	$building_destroy = $_GET['building_id'];
	$dbname_array = $cl_builds->get_array('dbname');
	$id_array = array_flip($cl_builds->get_array('dbname'));
	if(!in_array($_GET['building_id'], $dbname_array)){
		$error = "Sorry, but this building does not exist!";
	}
	if($session['hkey'] != $_GET['h'])
		$error = "Sorry, but the security code is invalid!";

	if(($destroy_village[$building_destroy] <= 15) && ($building_destroy == 'main') || ($destroy_village[$building_destroy] <= 1) && (in_array($building_destroy, $arr_builds_starts_by_one)) || ($destroy_village[$building_destroy] <= 0))
		$error = "Sorry, but Headquarters cannot be demolished!";
	if($village['agreement'] < 100)
		$error = "Sorry, but to demolish, loyalty must be at 100%!";
	if(empty($error)){
		$bh = $cl_builds->get_bh($building_destroy,$destroy_village[$building_destroy]);
		$time = $cl_builds->get_time($village['main'],$building_destroy,$destroy_village[$building_destroy]+1);
		$onlytime = $cl_builds->get_time($village['main'],$building_destroy,$destroy_village[$building_destroy]+1);
		$result = $db->query("SELECT `end_time` FROM `build` WHERE `villageid`='".$village['id']."' ORDER BY `id` DESC LIMIT 1");
		$row = $db->Fetch($result);
		if($db->affectedrows() == "0"){
  			$time += time();
		}else{
			$time += $row['end_time'];
		}
		$db->query("INSERT INTO `build` (`building`,`villageid`,`end_time`,`build_time`,`mode`) VALUES ('".$building_destroy."','".$village['id']."','".$time."','".$onlytime."','destroy')");
		$destroyid = $db->getlastid();
		$db->query("INSERT INTO `events` (`event_time`,`event_type`,`event_id`,`user_id`,`villageid`) VALUES ('".$time."','destroy','".$destroyid."','".$user['id']."','".$village['id']."')");
		$d->open();
		header("LOCATION: game.php?screen=main&village=".$village['id']."&mode=destroy");
		exit();
	}
}
?>