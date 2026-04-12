<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}

if($_GET['action'] == 'set_visual'){
	if($session['hkey']!=$_GET['h']){
		exit("Desculpe, más o código de segurança está invalido!");
	}
	$visual = (int)$_GET['visual'];
	$valid = array(0, 1);
	if(!in_array($visual, $valid)){
		exit("Desculpe, más não foi possivel executar a ação!");
	}
	$db->query("UPDATE `users` SET `graphical_overview`='".$visual."' WHERE `id`='".$user['id']."'");
	header("LOCATION: game.php?village=".$village['id']."&screen=overview");
	exit;
}

$builds = $cl_builds->get_array("dbname");
$built_builds = array();
foreach($builds as $id => $dbname){
	$needed = $cl_builds->get_needed($id);
	$needed_done = true;
	if($village[$dbname] > 0){
		foreach($needed as $dbname2 => $needed_stage){
			if($village[$dbname2] < $needed_stage){
				$needed_done = false;
			}
		}
	}else{
		$needed_done = false;
	}
	if($needed_done){
		$built_builds[$id] = $dbname;
	}
}

$units = $cl_units->read_units("",$village['id']);
$in_village_units = array();
foreach($units as $dbname => $num){
    if($num != "0"){
		$in_village_units[$dbname] = $num;
	}
}

$village['agreement'] = calc_agreement($village);

$wood_prod_overview = $arr_production[$village['wood']]*$config['speed']/60 ? floor($arr_production[$village['wood']]*$config['speed']/60) : floor($arr_production[$village['wood']]*$config['speed']);
$stone_prod_overview = $arr_production[$village['stone']]*$config['speed']/60 ? floor($arr_production[$village['stone']]*$config['speed']/60) : floor($arr_production[$village['stone']]*$config['speed']);
$iron_prod_overview = $arr_production[$village['iron']]*$config['speed']/60 ? floor($arr_production[$village['iron']]*$config['speed']/60) : floor($arr_production[$village['iron']]*$config['speed']);

$my_movements = array();
$saved_villageNames = array();
$i = 0;
$cancel_time = $config['cancel_movement']*60;
$result = $db->query("SELECT `id`,`from_village`,`to_village`,`type`,`start_time`,`end_time`,`die` FROM `movements` WHERE `send_from_village`='".$village['id']."' ORDER BY `end_time`");
while($row = $db->fetch($result)){
	$my_movements[$i]['id'] = $row['id'];
	$my_movements[$i]['to_village'] = $row['to_village'];
	$my_movements[$i]['type'] = $row['type'];
	$my_movements[$i]['start_time'] = $row['start_time'];
	$my_movements[$i]['end_time'] = $row['end_time'];
	$my_movements[$i]['arrival_in'] = $row['end_time']-time();
	$my_movements[$i]['can_cancel'] = (($row['start_time']+$cancel_time)>=time() && ($row['type']=="attack" || $row['type']=="support") && $row['die']!=1)?true:false;

	if(!array_key_exists($row['to_village'], $saved_villageNames)){
		if($row['type']!="return"){
			$result2 = $db->query("SELECT `name`,`x`,`y`,`continent` FROM `villages` WHERE `id`='".$row['to_village']."'");
		}else{
			$result2 = $db->query("SELECT `name`,`x`,`y`,`continent` FROM `villages` WHERE `id`='".$row['from_village']."'");
		}
		$villagedata = $db->fetch($result2);
		$my_movements[$i]['to_villagename'] = entparse($villagedata['name']).' ('.$villagedata['x'].'|'.$villagedata['y'].') K'.$villagedata['continent'];
		$saved_villageNames[$row['to_village']] = $villagedata['name'];
	}else{
	    $my_movements[$i]['to_villagename'] = entparse($saved_villageNames[$row['to_village']]);
	}
	$my_movements[$i]['message'] = get_movement_message($row['type'],$my_movements[$i]['to_villagename'],'own');
	$i++;
}

$other_movements = array();
$i = 0;
$result = $db->query("SELECT `id`,`from_village`,`type`,`start_time`,`end_time` FROM `movements` WHERE `send_to_village`='".$village['id']."' AND `to_hidden`='0' ORDER BY `end_time`");
while($row = $db->fetch($result)){
	$other_movements[$i]['id'] = $row['id'];
	$other_movements[$i]['from_village'] = $row['from_village'];
	$other_movements[$i]['type'] = $row['type'];
	$other_movements[$i]['start_time'] = $row['start_time'];
	$other_movements[$i]['end_time'] = $row['end_time'];
	$other_movements[$i]['arrival_in'] = $row['end_time']-time();
	if(!array_key_exists($row['from_village'], $saved_villageNames)){
		$result2 = $db->query("SELECT `name`,`x`,`y`,`continent` FROM `villages` WHERE `id`='".$row['from_village']."'");
		$villagedata = $db->fetch($result2);
		$other_movements[$i]['from_villagename'] = entparse($villagedata['name']).' ('.$villagedata['x'].'|'.$villagedata['y'].') K'.$villagedata['continent'];
		$saved_villageNames[$row['from_village']] = $villagedata['name'];
	}else{
	    $other_movements[$i]['from_villagename'] = entparse($saved_villageNames[$row['from_village']]);
	}
	$other_movements[$i]['message'] = $other_movements[$i]['from_villagename'];
	$i++;
}

if(empty($error)) $error = "";

if($user["graphical_overview"] != 0){
	$villageOverviewDatas = new villageOverviewDatas('graphic');
}else{
	$villageOverviewDatas = new villageOverviewDatas('table');
}

$query = $db->query("SELECT `building`,`end_time` FROM `build` WHERE `villageid`='".$village['id']."' GROUP BY `building`");
$constructing = array();
$now = time();
if($query && $db->numrows($query)){
	while($res = $db->fetch($query)){
		$constructing[$res['building']] = $res['end_time']-$now;
	}
}

  $hour = date("H");
   if($config['night_start'] > $config['night_end']){
    if($hour >= $config['night_start'] || $hour <= $config['night_end']){
     $graphic = "visual_night/";
    }else{
     $graphic = "visual/";
    }
   }else{
    if($hour >= $config['night_start'] && $hour <= $config['night_end']){
     $graphic = "visual_night/";
    }else{
     $graphic = "visual/";
    }
   }

$tpl->assign('constructing', $constructing);
$tpl->assign("visual", $graphic);
$tpl->assign('villageOverviewDatas', $villageOverviewDatas);
$tpl->assign("my_movements", $my_movements);
$tpl->assign("other_movements", $other_movements);
$tpl->assign("built_builds", $built_builds);
$tpl->assign("speed", $config['speed']);
$tpl->assign("cl_builds", $cl_builds);
$tpl->assign("cl_units", $cl_units);
$tpl->assign("in_village_units", $in_village_units);
$tpl->assign("wood_prod_overview", $wood_prod_overview);
$tpl->assign("stone_prod_overview", $stone_prod_overview);
$tpl->assign("iron_prod_overview", $iron_prod_overview);
?>