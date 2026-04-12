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
$result = $db->query("SELECT `id`,`rang`,`username`,`villages`,`points`,`ally` FROM `users` ORDER BY `rang` LIMIT ".$start.",".$ranks_per_page."");
while($row = $db->fetch($result)){
    $ranks[$row['id']]['username'] = entparse($row['username']);
    $ranks[$row['id']]['rang'] = $row['rang'];
    $ranks[$row['id']]['points'] = format_number($row['points']);
    $ranks[$row['id']]['villages'] = $row['villages'];
    $ranks[$row['id']]['ally'] = $row['ally'];
    $ranks[$row['id']]['cuttrought'] = @round($row['points'] / $row['villages']);
	if($row['id'] == $village['userid']){
		$ranks[$row['id']]['mark'] = " class=\"lit\"";
	}elseif($row['ally'] == $user['ally'] && $user['ally'] != '-1'){
		$ranks[$row['id']]['mark'] = " class=\"lit2\"";
	}
	if($row['ally'] != '-1'){
		if(!array_key_exists($row['ally'], $allys)){
			$res = $db->query("SELECT `short` FROM `ally` WHERE `id`='".$row['ally']."'");
			$ally = $db->fetch($res);
			$allys[$row['ally']] = $ally['short'];
			$ranks[$row['id']]['allyname'] = entparse($ally['short']);
		}else{
			$ranks[$row['id']]['allyname'] = entparse($allys[$row['ally']]);
		}
	}
}
$tpl->assign("ranks",$ranks);
$tpl->assign("site",$site);
?>