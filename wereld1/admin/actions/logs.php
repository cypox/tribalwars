<?php
if(!isset($_GET['site']) || (isset($_GET['site']) && (!is_numeric($_GET['site'])))){
	$site = 1;
}else{
    $site = parse($_GET['site']);
}
$reports_per_page = 500;

$num_rows = $db->fetch($db->query("SELECT COUNT(*) AS `count` FROM `logs`"));
$num_rows = $num_rows['count'];

$num_pages = (($num_rows%$reports_per_page) == 0) ? $num_rows/$reports_per_page : ceil($num_rows/$reports_per_page);
$start = ($site-1)*$reports_per_page;

$logs = array();
$count = array();
$count_time = array();
$result = $db->query("SELECT `id`,`user`,`village`,`time`,`log`,`event_id`,`event_type` FROM `logs` ORDER BY `event_id` DESC LIMIT ".$start.",".$reports_per_page);
while($row = $db->fetch($result)){
    $logs[$row['id']]['user'] = entparse($row['user']);
    $logs[$row['id']]['village'] = entparse($row['village']);
    $logs[$row['id']]['time'] = format_date($row['time'], true);
    $logs[$row['id']]['event_id'] = $row['event_id'];
    $logs[$row['id']]['event_type'] = $row['event_type'];
    $logs[$row['id']]['log'] = entparse($row['log']);
}
$tpl->assign("logs",$logs);
$tpl->assign("site",$site);
$tpl->assign("num_pages",$num_pages);
?>