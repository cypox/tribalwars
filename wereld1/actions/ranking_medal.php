<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}

if(!isset($_GET['site']) || isset($_GET['site']) || is_numeric($_GET['site']) || $_GET['site'] < 1){
	$site = ceil($user['rang']/20);
}else{
	$site = (int)parse($_GET['site']);
}

$ranks_per_page = 20;
$start = ($site-1)*$ranks_per_page;
$ranks = array();
$allys = array();
$result = $db->query("SELECT * FROM `medal` ORDER BY `rang` LIMIT ".$start.",".$ranks_per_page."");
while($row = $db->fetch($result)){
	$sql = $db->fetch($db->query("SELECT * FROM `users` WHERE `id`='".$row['userid']."' LIMIT 1"));
    $ranks[$row['id']]['username'] = entparse($sql['username']);
    $ranks[$row['id']]['rang'] = $row['rang'];
    $ranks[$row['id']]['points'] = format_number($row['total_stage']);
    $ranks[$row['id']]['ally'] = $sql['ally'];
	if($row['userid'] == $village['userid']){
		$ranks[$row['id']]['mark'] = " class=\"lit\"";
	}elseif($sql['ally'] == $user['ally'] && $user['ally'] != '-1'){
		$ranks[$row['id']]['mark'] = " class=\"lit2\"";
	}
	if($row['ally'] != '-1'){
		if(!array_key_exists($row['ally'], $allys)){
			$res = $db->query("SELECT `short` FROM `ally` WHERE `id`='".$sql['ally']."'");
			$ally = $db->fetch($res);
			$allys[$sql['ally']] = $ally['short'];
			$ranks[$row['id']]['allyname'] = entparse($ally['short']);
		}else{
			$ranks[$row['id']]['allyname'] = entparse($allys[$sql['ally']]);
		}
	}
}
$tpl->assign("ranks",$ranks);
$tpl->assign("site",$site);
?>