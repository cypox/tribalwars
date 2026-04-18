<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != 'sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL'){
	exit;
}

$show_build = ($cl_builds->check_needed('smith',$village) && $village['smith'] > 0) ? true : false;
if($show_build){
	foreach($cl_techs->get_array("dbname") as $id=>$dbname){
		$group_techs[$cl_techs->get_group($dbname)][] = $dbname;
	}

	$maxNum_groupTech = 0;
	foreach($group_techs as $name=>$array){
		if(count($group_techs[$name]) > $maxNum_groupTech){
			$maxNum_groupTech = count($group_techs[$name]);
		}
	}

	$is_researches = false;
	$result = $db->query("SELECT COUNT(`id`) AS `count_research`,`id`,`research`,`end_time` FROM `research` WHERE `villageid`='".$village['id']."' GROUP BY `id`,`research`,`end_time`");
	$research = $db->fetch($result);
	if(!is_array($research)){
		$research = array('id' => 0, 'research' => '', 'end_time' => 0, 'count_research' => 0);
	}
	if(isset($research['count_research']) && $research['count_research'] == "1"){
		$is_researches = true;
	}
	$research['reminder_time'] = isset($research['end_time']) ? ($research['end_time']-time()) : 0;
	if($is_researches && isset($research['id']) && isset($research['end_time']) && (int)$research['end_time'] <= time()){
		check_tech($research['id']);
		$db->query("DELETE FROM `events` WHERE `event_id`='".$research['id']."' AND `event_type`='research'");
		header("LOCATION: game.php?village=".$village['id']."&screen=smith");
		exit;
	}

	if(isset($_GET['action']) && $_GET['action'] == "research_all"){
		if(isset($_GET['h']) && $session['hkey'] == $_GET['h']){
			$sql = $db->query("SELECT * FROM villages WHERE id = $village[id]");
			$information = mysqli_fetch_object($sql);

			$spear = $information->unit_spear_tec_level;
			$sword = $information->unit_sword_tec_level;
			$axe = $information->unit_axe_tec_level;
			$light = $information->unit_light_tec_level;
			$heavy = $information->unit_heavy_tec_level;
			$archer = $information->unit_archer_tec_level;
			$marcher = $information->unit_marcher_tec_level;
			$ram = $information->unit_ram_tec_level;
			$catapult = $information->unit_catapult_tec_level;

			if($user['premium_active'] == 0){
				$error = "Please activate premium features.";
			}elseif($spear == "1" AND $sword == "1" AND $axe == "1" AND $light == "1" AND $heavy == "1" AND $archer == "1" AND $marcher == "1" AND $ram == "1" AND $catapult == "1"){
				$error = "You have already researched everything!";
			}elseif($information->smith <= "15"){
				$error = "Your Smithy must be at least level 15";
			}elseif($information->stable <= "10"){
				$error = "Your Stable must be at least level 10!";
			}elseif($information->barracks <= "10"){
				$error = "Your Barracks must be at least level 10!";
			}elseif($information->garage <= "2"){
				$error = "Your Workshop must be at least level 2!";
			}elseif($information->storage < "16"){
				$error = "Your Warehouse must be at least level 15!";
			}elseif($information->r_wood <= "16182" AND $information->r_stone <= "18846" AND $information->r_iron <= "12490"){
				$error = "You do not have enough resources! You need at least 16,182 Wood, 18,846 Clay and 12,490 Iron.";
			}else{
				$aendern = $db->query("UPDATE villages Set unit_spear_tec_level='1', unit_sword_tec_level='1', unit_axe_tec_level='1', unit_archer_tec_level='1' WHERE id LIKE $village[id]");
				$aendern = $db->query("UPDATE villages Set unit_spy_tec_level='1', unit_light_tec_level='1', unit_marcher_tec_level='1', unit_heavy_tec_level='1' WHERE id LIKE $village[id]");
				$aendern = $db->query("UPDATE villages Set unit_ram_tec_level='1', unit_catapult_tec_level='1' WHERE id LIKE $village[id]");
				                 
				$wood = $information->r_wood - 16182;
				$stone = $information->r_stone - 18846;
				$iron = $information->r_iron - 12490;
				$update = $db->query("UPDATE villages Set r_wood='$wood', r_stone='$stone', r_iron='$iron' WHERE id = '$village[id]'");
				$tpl->assign("succes", "Success, all technologies were researched!");
			}
		}else{
			$error = "Invalid HKEY!";
		}
	}

	if(isset($_GET['action']) && $_GET['action'] == "research"){
		$c = new do_action($user['id']);
		$c->close();
		if(isset($_GET['h']) && $session['hkey'] == $_GET['h']){
			if($is_researches){
			    $error = "Sorry, but there is a research already in progress.";
			}
			if(empty($error)){
				if(empty($_GET['id'])){
				    $_GET['id'] = "";
				}
				$cl_techs->check_tech($_GET['id'],$village);
				switch($cl_techs->get_last_error()){
					case "tech_not_found":	$error = "Sorry, but we could not find this technology!";	break;
					case "max_stage":	$error = "Sorry, but this research has already reached its maximum level!";	break;
					case "not_fulfilled":	$error = "Sorry, but the required levels are not met!";	break;
					case "not_enough_storage":	$error = "Sorry, but the warehouse is too small!";	break;
					case "not_enough_ress" :	$error = "Sorry, but not enough resources are available!";	break;
				}
			}
			if(empty($error)){
				$cl_techs->research($_GET['id'],$village);
				$c->open();
			    header("LOCATION: game.php?village=".$village['id']."&screen=smith");
			    exit;
			}
		}else{
			$error = "Sorry, but the security code is invalid!";
		}
		$c->open();
	}
	if(isset($_GET['action']) && $_GET['action'] == "cancel"){
		if(isset($_GET['h']) && $session['hkey'] == $_GET['h']){
			if(!$is_researches){
			    $error = "Sorry, but there is no research in progress.";
			}
			if(empty($error)){
				while(true){
					$result = $db->query("SELECT COUNT(`id`) AS `count` FROM `events` WHERE `event_id`='".$research['id']."' AND `event_type`='research'");
					$row = $db->fetch($result);
					if($row['count'] != 1){
						$error = "Sorry, but this research has already been completed!";
						break;
					}
					$result = $db->query("UPDATE `events` SET `cid`='1' WHERE `event_id`='".$research['id']."' AND `event_type`='research' AND `cid`='0'");
					if($db->affectedrows() == 1){
						break;
					}
				}
			}
			if(empty($error)){
  				$db->query("DELETE FROM `events` WHERE `event_id`='".$research['id']."' AND `event_type`='research'");
   				$db->query("DELETE FROM `research` WHERE `id`='".$research['id']."'");

   				$wood = round($cl_techs->get_wood($research['research'],$village['unit_'.$research['research'].'_tec_level']+1));
				$stone = round($cl_techs->get_stone($research['research'],$village['unit_'.$research['research'].'_tec_level']+1));
				$iron = round($cl_techs->get_iron($research['research'],$village['unit_'.$research['research'].'_tec_level']+1));

				$db->query("UPDATE `villages` SET `r_wood`=`r_wood`+'".$wood."',`r_stone`=`r_stone`+'".$stone."',`r_iron`=`r_iron`+'".$iron."',`smith_tec`=''");	
				header("LOCATION: game.php?village=".$village['id']."&screen=smith");
				exit;
			}
		}else{
			$error = "Sorry, but the security code is invalid!";
		}
	}
	if(!isset($error)) $error = "";

	$tpl->assign("maxNum_groupTech", $maxNum_groupTech);
	$tpl->assign("table_width", ceil(100/count($group_techs)));
	$tpl->assign("group_techs", $group_techs);
	$tpl->assign("error", $error);
	$tpl->assign("research", $research);
	$tpl->assign("is_researches", $is_researches);
}

$techs = array();
foreach($cl_techs->get_array("dbname") as $dbname){
	$techs[$dbname] = $village["unit_".$dbname."_tec_level"];
}

$tpl->assign("show_build",$show_build);
$tpl->assign("cl_techs", $cl_techs);
$tpl->assign("time", time());
$tpl->assign("techs", $techs);
$tpl->assign("description", $cl_builds->get_description_bydbname('smith'));
$tpl->register_modifier("format_date", "format_date");
$tpl->register_modifier("format_time", "format_time");
?>