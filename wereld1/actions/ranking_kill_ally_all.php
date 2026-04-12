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
$allys = array();
$result = $db->query("SELECT `id`,`killed_units_altogether_rank`,`short`,`killed_units_altogether` FROM `ally` ORDER BY `killed_units_altogether_rank` LIMIT ".$start.",".$ranks_per_page."");
while($row = $db->fetch($result)){
    $ranks[$row['id']]['short'] = entparse($row['short']);
    $ranks[$row['id']]['rang'] = $row['killed_units_altogether_rank'];
    $ranks[$row['id']]['killed_units'] = format_number($row['killed_units_altogether']);
	if($row['id'] == $user['ally']){
		$ranks[$row['id']]['mark'] = " class=\"lit\"";
	}
}
$tpl->assign("ranks",$ranks);
$tpl->assign("site",$site);
?>