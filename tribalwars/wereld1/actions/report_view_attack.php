<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != 'sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL'){
	exit;
}

$result = $db->query("SELECT `username` FROM `users` WHERE `id`='".$report['from_user']."'");
$arr = $db->fetch($result);
$report['from_username'] = entparse($arr['username']);

$result = $db->query("SELECT `username` FROM `users` WHERE `id`='".$report['to_user']."'");
$arr = $db->fetch($result);
$report['to_username'] = entparse($arr['username']);

$result = $db->query("SELECT `name`,`x`,`y`,`continent` FROM `villages` WHERE `id`='".$report['from_village']."'");
$arr = $db->fetch($result);
$report['from_villagename'] = entparse($arr['name']);
$report['from_x'] = $arr['x'];
$report['from_y'] = $arr['y'];
$report['from_continent'] = $arr['continent'];

$result = $db->query("SELECT `name`,`x`,`y`,`continent` FROM `villages` WHERE `id`='".$report['to_village']."'");
$arr = $db->fetch($result);
$report['to_villagename'] = entparse($arr['name']);
$report['to_x'] = $arr['x'];
$report['to_y'] = $arr['y'];
$report['to_continent'] = $arr['continent'];

$report_units['units_a'] = explode(";", $report['a_units']);
$report_units['units_b'] = explode(";", $report['b_units']);
$report_units['units_c'] = explode(";", $report['c_units']);
$report_units['units_d'] = explode(";", $report['d_units']);
$report_units['units_e'] = explode(";", $report['e_units']);

$ex = explode(";", $report['hives']);
$report_ress['wood'] = $ex['0'];
$report_ress['stone'] = $ex['1'];
$report_ress['iron'] = $ex['2'];
$report_ress['sum'] = $ex['3'];
$report_ress['max'] = $ex['4'];

$ex = explode(";", $report['ram']);
$report_ram['from'] = $ex['0'];
$report_ram['to'] = $ex['1'];

$ex = explode(";", $report['catapult']);
$report_catapult['from'] = $ex['0'];
$report_catapult['to'] = $ex['1'];
$report_catapult['building'] = $ex['2'];

$ex = explode(";", $report['agreement']);
$report_agreement['from'] = $ex['0'];
$report_agreement['to'] = $ex['1'];

$see_def_units = ($report['see_def_units'] == 1) ? true : false;

if($user['id'] == $report['from_user']){
	if($report_agreement['to'] <= 0){
		$report['image'] = 'image_village_won';
	}elseif($report['title_image'] == 'graphic/dots/blue.png'){
		$report['image'] = 'image_scouting_own';
	}elseif($report_agreement['to'] > 0){
		$report['image'] = 'image_attack_won';
	}
}else{
	if($report_agreement['to'] <= 0){
		$report['image'] = 'image_village_lost';
	}elseif($report['title_image'] == 'graphic/dots/blue.png'){
		$report['image'] = 'image_scouting_enemy';
	}elseif($report_agreement['to'] > 0){
		$report['image'] = 'image_attack_lost';
	}
}

$tpl->assign("cl_units", $cl_units);
$tpl->assign("cl_builds", $cl_builds);
$tpl->assign("moral_activ", $config['moral_activ']);
$tpl->assign("report_units", $report_units);
$tpl->assign("see_def_units", $see_def_units);
$tpl->assign("report_ress", $report_ress);
$tpl->assign("report_ram", $report_ram);
$tpl->assign("report_catapult", $report_catapult);
$tpl->assign("report_agreement", $report_agreement);
?>