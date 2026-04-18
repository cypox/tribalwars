<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}

if(!isset($_GET['site']) || !is_numeric($_GET['site']) || $_GET['site'] < 1){
	$site = ceil($user['rang']/20);
	if($site < 1){
		$site = 1;
	}
}else{
	$site = (int)parse($_GET['site']);
}

$ranks_per_page = 20;
$start = ($site-1)*$ranks_per_page;
$ranks = array();
$allys = array();
$result = $db->query("SELECT * FROM `medal` ORDER BY `rang` LIMIT ".$start.",".$ranks_per_page."");
while($row = $db->fetch($result)){
	$sql = $db->fetch($db->query("SELECT `id`,`username`,`ally` FROM `users` WHERE `id`='".$row['userid']."' LIMIT 1"));
	if(!is_array($sql)){
		continue;
	}

	$rank_id = (int)$sql['id'];
	$ranks[$rank_id]['username'] = entparse($sql['username']);
	$ranks[$rank_id]['rang'] = isset($row['rang']) ? $row['rang'] : 0;
	$ranks[$rank_id]['points'] = format_number(isset($row['total_stage']) ? $row['total_stage'] : 0);
	$ranks[$rank_id]['villages'] = format_number(isset($row['total_stage']) ? $row['total_stage'] : 0);
	$ranks[$rank_id]['ally'] = isset($sql['ally']) ? $sql['ally'] : '-1';
	$ranks[$rank_id]['allyname'] = '-';
	$ranks[$rank_id]['mark'] = '';

	if($row['userid'] == $village['userid']){
		$ranks[$rank_id]['mark'] = " class=\"lit\"";
	}elseif($ranks[$rank_id]['ally'] == $user['ally'] && $user['ally'] != '-1'){
		$ranks[$rank_id]['mark'] = " class=\"lit2\"";
	}

	if($ranks[$rank_id]['ally'] != '-1'){
		if(!array_key_exists($ranks[$rank_id]['ally'], $allys)){
			$res = $db->query("SELECT `short` FROM `ally` WHERE `id`='".$ranks[$rank_id]['ally']."'");
			$ally = $db->fetch($res);
			$allys[$ranks[$rank_id]['ally']] = is_array($ally) && isset($ally['short']) ? $ally['short'] : '-';
		}
		$ranks[$rank_id]['allyname'] = entparse($allys[$ranks[$rank_id]['ally']]);
	}
}
$tpl->assign("ranks",$ranks);
$tpl->assign("site",$site);
?>