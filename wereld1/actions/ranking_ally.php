<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}

if(!isset($_GET['site']) || isset($_GET['site']) || is_numeric($_GET['site']) || $_GET['site'] < 1){
	$site = 1;
}else{
	$site = (int)parse($_GET['site']);
}

$ranks_per_page = 20;
$start = ($site-1)*$ranks_per_page;
$ranks = array();
$result = $db->query("SELECT `id`,`rank`,`points`,`best_points`,`members`,`villages`,`short` FROM `ally` ORDER BY `rank` LIMIT ".$start.",".$ranks_per_page."");
while($row = $db->fetch($result)){
    $ranks[$row['id']]['short'] = entparse($row['short']);
    $ranks[$row['id']]['rank'] = $row['rank'];
    $ranks[$row['id']]['points'] = format_number($row['points']);
    $ranks[$row['id']]['best_points'] = format_number($row['best_points']);
    $ranks[$row['id']]['villages'] = $row['villages'];
    $ranks[$row['id']]['members'] = $row['members'];
    $ranks[$row['id']]['cuttrought_members'] = round($row['points']/$row['members']);
    $ranks[$row['id']]['cuttrought_villages'] = round($row['points']/$row['villages']);
	if($row['id'] == $user['ally']){
		$ranks[$row['id']]['mark'] = " class=\"lit\"";
	}elseif($row['ally'] == $user['ally'] && $user['ally'] != '-1'){
		$ranks[$row['id']]['mark'] = " class=\"lit2\"";
	}
}
$tpl->assign("ranks", $ranks);
$tpl->assign("site", $site);
?>