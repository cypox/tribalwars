<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}

if(!isset($_GET['site']) || !is_numeric($_GET['site']) || $_GET['site'] < 1){
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
	$ranks[$row['id']]['mark'] = "";
	$ranks[$row['id']]['cuttrought_members'] = ((int)$row['members'] > 0) ? round($row['points']/$row['members']) : 0;
	$ranks[$row['id']]['cuttrought_villages'] = ((int)$row['villages'] > 0) ? round($row['points']/$row['villages']) : 0;
	if($row['id'] == $user['ally']){
		$ranks[$row['id']]['mark'] = " class=\"lit\"";
	}
}
$tpl->assign("ranks", $ranks);
$tpl->assign("site", $site);
?>