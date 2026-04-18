<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}

if(!isset($_GET['id'])) $_GET['id'] = "";
$villagesql = array("userid","id","name","x","y","continent","points");
$info_village = $villagedatas->getbyid(parse($_GET['id']), $villagesql);
$info_village['name'] = entparse(@$info_village['name']);

if(!isset($info_village['exist_village']) || $info_village['exist_village'] == "0"){
	exit("Sorry, but this village does not exist!");
}

$info_user = array(
	'id' => 0,
	'username' => '',
	'ally' => 0,
);
$info_ally = array(
	'id' => 0,
	'short' => '',
);

if(isset($info_village['userid']) && $info_village['userid'] > 0){
	$result = $db->query("SELECT `id`,`username`,`ally` FROM `users` WHERE `id`='".(int)$info_village['userid']."' LIMIT 1");
	$user_row = $db->fetch($result);
	if(is_array($user_row)){
		$info_user = array_merge($info_user, $user_row);
		$info_user['username'] = entparse(@$info_user['username']);
		if(!empty($info_user['ally'])){
			$result = $db->query("SELECT `short`,`id` FROM `ally` WHERE `id`='".(int)$info_user['ally']."' LIMIT 1");
			$ally_row = $db->fetch($result);
			if(is_array($ally_row)){
				$info_ally = array_merge($info_ally, $ally_row);
				$info_ally['short'] = entparse(@$info_ally['short']);
			}
		}
	}
}

$can_send_ress = ($cl_builds->check_needed('market',$village) && $village['market']>0)?true:false;

$tpl->assign("info_village", $info_village);
$tpl->assign("info_user", $info_user);
$tpl->assign("info_ally", $info_ally);
$tpl->assign("can_send_ress", $can_send_ress);
?>