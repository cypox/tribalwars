<?php
include("include.inc.php");

function check_recruit($id,$time){
	global $db;

	$result = $db->query("SELECT * FROM `recruit` WHERE `id` = '".$id."'");
	while($row = $db->Fetch($result)){
	    $diff_time = $time - $row['time_start'];
	    $units_finished = (floor($diff_time/$row['time_per_unit']))-$row['num_finished'];

		if($units_finished+$row['num_finished'] > $row['num_unit'])
		    $units_finished = $row['num_unit']-$row['num_finished'];

	    $db->unb_query("UPDATE `unit_place` SET `".$row['unit']."` = `".$row['unit']."`+'".$units_finished."' WHERE `villages_from_id` = '".$row['villageid']."' AND `villages_to_id` = '".$row['villageid']."'");
	    $db->unb_query("UPDATE `villages` SET `all_".$row['unit']."` = `all_".$row['unit']."`+'".$units_finished."' WHERE `id` = '".$row['villageid']."'");

		if($units_finished+$row['num_finished'] == $row['num_unit']){
	        $db->unb_query("DELETE FROM `recruit` WHERE `id` = '".$id."'");
	        return true;
	    }else{
	        $db->unb_query("UPDATE `recruit` SET `num_finished` = `num_finished`+'".$units_finished."' WHERE `id` = '".$id."'");
	        return $row['time_start']+(($units_finished+$row['num_finished'])*$row['time_per_unit'])+$row['time_per_unit'];
	    }
	}

}
function check_builds($id){
	global $db;

	$done = false;
	$reload_village = array();
	$reload_player = array();
	$result = $db->query("SELECT * FROM `build` WHERE (`id` = '".$id."' AND `mode` = 'build')");
	while($row = $db->fetch($result)){
		$db->query("DELETE FROM `build` WHERE `id` = '".$id."'");
		if($db->affectedrows() == 1){
			$result2 = $db->query("SELECT COUNT(*) AS `build_count` FROM `build` WHERE `villageid` = '".$row['villageid']."'");
			$row2 = $db->fetch($result2);
			if($row2['build_count'] == '0')
				$add_sql = ",`main_build`='' ";
			else{
				$result2 = $db->query("SELECT `building`,`end_time` FROM `build` WHERE `villageid` = '".$row['villageid']."' ORDER BY `end_time` LIMIT 1");
				$next_build = $db->Fetch($result2);
				$add_sql=",`main_build`='".$next_build['building'].",".$next_build['end_time']."' ";
			}

			if($row['building'] == 'storage' || $row['building'] == 'wood' || $row['building'] == 'stone' || $row['building'] == 'iron'){
				$res = $db->query("SELECT last_prod_aktu,wood,stone,iron,r_wood,r_stone,r_iron,storage from villages where id=".$row['villageid']."");
	        	ressis($villagedata, $row['end_time']);
			}
			$db->unb_query("UPDATE `villages` SET `".$row['building']."` = `".$row['building']."`+'1' ".$add_sql." WHERE `id` = '".$row['villageid']."'");
			return $row['villageid'];
		}
	}
}
function check_destroy($id){
	global $db;
	global $cl_builds;

	$done = false;
	$reload_village = array();
	$reload_player = array();
	$result = $db->query("SELECT * FROM `build` WHERE (`id` = '".$id."' AND `mode` = 'destroy')");
	while($row = $db->fetch($result)){
		$db->query("DELETE FROM `build` WHERE `id` = '".$id."'");

		if($db->affectedrows() == 1){
			$result2 = $db->query("SELECT COUNT(*) AS `build_count` FROM `build` WHERE `villageid` = '".$row['villageid']."'");
			$row2 = $db->Fetch($result2);
			if($row2['build_count'] == "0")
				$add_sql = ",`main_build`='' ";
			else{
				$result2 = $db->query("SELECT `building`,`end_time` FROM `build` WHERE `villageid` = '".$row['villageid']."' ORDER BY `end_time` LIMIT 1");
				$next_build = $db->Fetch($result2);

				$add_sql=",`main_build`='".$next_build['building'].",".$next_build['end_time']."' ";
			}
			
			if($row['building'] == 'storage' || $row['building'] == 'wood' || $row['building'] == 'stone' || $row['building'] == 'iron'){
				$res = $db->query("SELECT last_prod_aktu,wood,stone,iron,r_wood,r_stone,r_iron,storage from villages where id=".$row['villageid']."");
	        	ressis($villagedata, $row['end_time']);
			}
			$building_destroy = $row['building'];
			$Village = $db->fetch($db->query("SELECT * FROM `villages` WHERE `id`='".$row['villageid']."'"));
			$builds = $cl_builds->get_array("dbname");
			foreach($builds as $key=>$value)
				$destroy_village[$value] = $Village[$value];
			$bh = $cl_builds->get_bh($building_destroy, $destroy_village[$building_destroy]);
			$db->unb_query("UPDATE `villages` SET `".$row['building']."`=`".$row['building']."`-'1',`r_bh`=`r_bh`-'".$bh."' ".$add_sql." WHERE `id`='".$row['villageid']."'");
			return $row['villageid'];
		}
	}
}
function check_tech($id){
	global $db;

	$return = array();
	$result = $db->query("SELECT * FROM `research` WHERE `id` = '".$id."'");
	while($row = $db->Fetch($result)){
		$db->unb_query("DELETE FROM research WHERE `id` = '".$id."'");
		$db->unb_query("UPDATE `villages` SET `unit_".$row['research']."_tec_level` = `unit_".$row['research']."_tec_level`+'1',`smith_tec` ='' where id='".$row['villageid']."'");
	}
}
function check_dealers($id,$event_id){
	global $db;
	global $cl_reports;

	$result = $db->query("SELECT * FROM `dealers` WHERE `id` = '".$id."'");
	$row=$db->Fetch($result);

	$also_back = false;
	if($row['type'] == 'to'){
		$db->unb_query("UPDATE `villages` SET `r_wood`=`r_wood`+'".$row['wood']."',`r_stone`=`r_stone`+'".$row['stone']."',`r_iron`=`r_iron`+'".$row['iron']."' WHERE `id` = '".$row['to_village']."'");

		$start_time = $row['end_time'];
		$end_time = $row['end_time'] + ($row['end_time'] - $row['start_time']);

		if($end_time <= time())
			$also_back = true;

		$db->unb_query("UPDATE `dealers` SET `wood`='0',`stone`='0',`iron`='0',`start_time`='".$start_time."',`end_time`='".$end_time."',`type`='back' WHERE `id` = '".$id."'");
		$db->unb_query("UPDATE `events` SET `can_knot`='0',`event_time`='".$end_time."',`cid`='0' WHERE `event_id` = '".$id."' AND `event_type` = 'dealers'");

		$result = $db->query("SELECT `name` FROM `villages` WHERE `id` = '".$row['from_village']."'");
		$from_village = $db->Fetch($result);

		$result = $db->query("SELECT `username` FROM `users` WHERE `id` = '".$row['to_userid']."'");
		$to_user = $db->fetch($result);

		$cl_reports->sendRess($row['from_userid'],$row['from_village'],entparse($from_village['name']),$row['to_userid'],entparse($to_user['username']),$row['to_village'],$row['wood'],$row['stone'],$row['iron'],$row['end_time']);
		
		if(!$also_back){
			$db->unb_query("DELETE FROM `run_events` WHERE `id` = '".$event_id."dealers'");
			return false;
		}
	}
	if($row['type'] == 'back' || $also_back){
 		$db->unb_query("UPDATE `villages` SET `dealers_outside`=`dealers_outside`-'".$row['dealers']."',`r_wood`=`r_wood`+'".$row['wood']."',`r_stone`=`r_stone`+'".$row['stone']."',`r_iron`=`r_iron`+'".$row['iron']."' WHERE `id`='".$row['from_village']."'");
 		$db->unb_query("DELETE FROM `dealers` WHERE `id` = '".$id."'");
 		return true;
	}
}

function do_movement($id,$event_id,$time){
	global $db;
	global $logging;

	$logging .= msec().": Lese query mov<br />";
	$result = $db->query("SELECT * FROM `movements` WHERE `id` = '".$id."'");
	$row = $db->Fetch($result);
	$row['id'] = $id;

	if(!isset($row['type'])){
		$row['type']='';
	}
	switch($row['type']){
	    case 'attack':
	    	global $session;
	    	global $conf;

	    	$logging .= msec().": Gehe in do_mov_attack<br />";
	        return do_movement_attack($row,$event_id,$time);
	    break;
	    case 'support':
	    	if($row['die'] == "1"){
	    		$db->query("DELETE FROM `movements` WHERE `id`='".$row['id']."'");
	    		return true;
	    	}
	        return do_movement_support($row);
	    break;
	    case 'return':
	    	if($row['die'] == "1"){
	    		$db->query("DELETE FROM `movements` WHERE `id`='".$row['id']."'");
	    		return true;
	    	}
	        return do_movement_return($row);
	    break;
	    case 'back':
	    	if($row['die'] == "1"){
	    		$db->query("DELETE FROM `movements` WHERE `id`='".$row['id']."'");
	    		return true;
	    	}
	        return do_movement_back($row);
	    break;
	    case 'cancel':
	    	if($row['die'] == "1"){
	    		$db->query("DELETE FROM `movements` where `id`='".$row['id']."'");
	    		return true;
	    	}
	        return do_movement_back($row);
	    break;
	}
}
function do_movement_back($row){
	global $cl_units;
	global $db;

	$sql = "UPDATE `unit_place` SET ";
	$first = true;
	$i = 0;
	$ex_units = explode(";", $row['units']);
	foreach($cl_units->get_array('dbname') as $dbname){
		if($first){
		    $sql .= "$dbname=$dbname+'".$ex_units[$i]."'";
		    $first = false;
		}else
		    $sql .= ",$dbname=$dbname+'".$ex_units[$i]."'";
		$i++;
	}
	$sql .= " WHERE `villages_from_id`='".$row['from_village']."' AND `villages_to_id`='".$row['from_village']."'";
	$db->unb_query($sql);

	$db->unb_query("DELETE FROM `movements` WHERE `id`='".$row['id']."'");
	return true;
}
function do_movement_return($row){
	global $cl_units;
	global $db;

	$sql = "UPDATE `unit_place` SET ";
	$first = true;
	$i = 0;
	$ex_units = explode(";", $row['units']);
	foreach($cl_units->get_array('dbname') as $dbname){
		if($first){
		    $sql .= "$dbname=$dbname+'".$ex_units[$i]."'";
		    $first = false;
		}else
		    $sql .= ",$dbname=$dbname+'".$ex_units[$i]."'";
		$i++;
	}
	$sql .= " WHERE `villages_from_id`='".$row['to_village']."' AND `villages_to_id`='".$row['to_village']."'";
	$db->query($sql);
	if($row['wood'] > 0 || $row['stone'] > 0 || $row['iron'] > 0)
	    $db->unb_query("UPDATE `villages` SET `r_wood`=`r_wood`+'".$row['wood']."',`r_stone`=`r_stone`+'".$row['stone']."',`r_iron`=`r_iron`+'".$row['iron']."' WHERE `id`='".$row['to_village']."'");

	$db->unb_query("DELETE FROM `movements` WHERE `id`='".$row['id']."'");
	return true;
}

function do_movement_support($row){
	global $cl_units;
	global $db;
	global $cl_reports;

	$result = $db->query("SELECT COUNT(villages_to_id) AS `count` FROM `unit_place` WHERE `villages_from_id`='".$row['from_village']."' AND `villages_to_id`='".$row['to_village']."'");
	$exist_support = $db->fetch($result);

	if($exist_support['count'] == "0"){
		$sql = "INSERT INTO `unit_place` (";
		$first = true;
		foreach($cl_units->get_array('dbname') as $dbname){
			if($first){
			    $sql .= "$dbname";
			    $first = false;
			}else
			    $sql .= ",$dbname";
		}
		$sql .=",`villages_from_id`,`villages_to_id`) VALUES (";
		$first = true;
		$i = 0;
		$ex_units = explode(";", $row['units']);
		foreach($cl_units->get_array('dbname') as $dbname){
			if($first){
			    $sql .= "'".$ex_units[$i]."'";
			    $first=false;
			}else
			    $sql .= ",'".$ex_units[$i]."'";
			$i++;
		}
		$sql .= ",'".$row['from_village']."','".$row['to_village']."')";
	}else{
	    $sql = "UPDATE `unit_place` SET ";
		$first = true;
		$i = 0;
		$ex_units = explode(";", $row['units']);
		foreach($cl_units->get_array('dbname') as $dbname){
			if($first){
			    $sql .= "$dbname=$dbname+'".$ex_units[$i]."'";
			    $first=false;
			}else
			    $sql .= ",$dbname=$dbname+'".$ex_units[$i]."'";
			$i++;
		}
		$sql .= " WHERE `villages_from_id`='".$row['from_village']."' AND `villages_to_id`='".$row['to_village']."'";
	}
	$db->unb_query($sql);

	$result = $db->query("SELECT `username` FROM `users` WHERE `id`='".$row['to_userid']."'");
	$arr = $db->fetch($result);
	$row['to_username'] = entparse($arr['username']);

	$result = $db->query("SELECT `name` FROM `villages` WHERE `id`='".$row['from_village']."'");
	$arr=$db->Fetch($result);
	$row['from_villagename'] = entparse($arr['name']);

	$cl_reports->support($row['from_userid'],$row['from_village'],$row['from_villagename'],$row['to_userid'],$row['to_username'],$row['to_village'],$row['units'],$row['end_time']);

	$db->unb_query("DELETE FROM `movements` WHERE `id`='".$row['id']."'");
	return true;
}
function do_movement_attack($row,$event_id,$event_time,$var=""){
	global $db;
	global $cl_units;
	global $cl_builds;
	global $conf;
	global $arr_maxhide;
	global $cl_reports;
	global $logging;

	$result = $db->query("SELECT `ally`,`username` FROM `users` WHERE `id`='".$row['from_userid']."'");
	$from_user = $db->fetch($result);

	if($from_user['ally'] != '-1'){
		$result = $db->query("SELECT `ally` FROM `users` WHERE `id`='".$row['to_userid']."'");
		$to_user = $db->fetch($result);
        if($to_user['ally'] == $from_user['ally'] && $to_user['ally'] != '-1' && $row['to_userid'] != $row['from_userid']){
			$return_end = $row['end_time']+($row['end_time']- $row['start_time']);
            $db->query("UPDATE `movements` SET `type`='return',`to_hidden`='1',`from_village`='".$row['to_village']."', `from_userid`='".$row['to_userid']."',`to_village`='".$row['from_village']."',`to_userid`='".$row['from_userid']."',`start_time`=".$row['end_time'].",`end_time`='".$return_end."' WHERE `id`='".$row['id']."'");
			$db->unb_query("UPDATE `events` SET `event_time`='".$return_end."',`can_knot`='0',`cid`='0' WHERE `event_id`='".$row['id']."' AND `event_type`='movement'");
			$db->unb_query("DELETE FROM `run_events` WHERE `id`='".$event_id."movement'");
			$db->unb_query("UPDATE `users` SET `attacks`=`attacks`-'1' where `id`='".$row['to_userid']."'");
			$db->unb_query("UPDATE `villages` SET `attacks`=`attacks`-'1' where `id`='".$row['to_village']."'");

			$result = $db->query("SELECT `name` FROM `villages` WHERE `id`='".$row['to_village']."'");
			$vil_to = $db->fetch($result);
			$cl_reports->attack_ally_visit($row['from_userid'],entparse($from_user['username']),$row['to_userid'],$row['to_village'],entparse($vil_to['name']));
            return false;
        }
    }

	$reload_allys = array();

	$del_event = false;

	$att_ex_units = explode(";", $row['units']);
	$i = 0;
	foreach($cl_units->get_array('dbname') as $dbname){
		$att[$dbname] = $att_ex_units[$i];
		$i++;
	}

	$first = true;
	$techs = "";
	foreach($cl_units->get_array('dbname') as $dbname){
		if($first){
			$techs .= $dbname."_tec_level AS ".$dbname;
			$first = false;
		}else
			$techs .= ",".$dbname."_tec_level AS ".$dbname;
	}
	$result = $db->query("SELECT $techs FROM `villages` WHERE `id` = '".$row['from_village']."'");
	$att_tech = $db->fetch($result);

	$first = true;
	$units = "";
	foreach($cl_units->get_array('dbname') as $dbname){
		if($first){
			$units .= "SUM($dbname) AS ".$dbname;
			$first = false;
		}else
			$units .= ",SUM($dbname) AS ".$dbname;
	}
	$result = $db->query("SELECT $units FROM `unit_place` WHERE `villages_to_id`='".$row['to_village']."'");
	$def = $db->fetch($result);

	$first = true;
	$techs = "";
	foreach($cl_units->get_array('dbname') as $dbname){
		if($first){
			$techs .= $dbname."_tec_level AS ".$dbname;
			$first = false;
		}else
			$techs .= ",".$dbname."_tec_level AS ".$dbname;
	}
	if(!empty($row['building']) && ($row['building'] != "storage" && $row['building'] != "hide" && $row['building'] != "wall" && $row['building'] != "wood" && $row['building'] != "stone" && $row['building'] != "iron"))
		$techs .= ",".$row['building'];

	$result = $db->query("SELECT $techs,`wall`,`r_wood`,`r_stone`,`r_iron`,`last_prod_aktu`,`storage`,`hide`,`wood`,`stone`,`iron`,`agreement`,`agreement_aktu`,`attacks`,`snobed_by` FROM `villages` WHERE `id`='".$row['to_village']."'");
	$def_tech = $db->fetch($result);

	$others['def_wall'] = $def_tech['wall'];
	if($row['building'] != "wall")
		unset($def_tech['wall']);

	$def_ress['r_wood'] = $def_tech['r_wood'];
	unset($def_tech['r_wood']);
	$def_ress['r_stone'] = $def_tech['r_stone'];
	unset($def_tech['r_stone']);
	$def_ress['r_iron'] = $def_tech['r_iron'];
	unset($def_tech['r_iron']);

	$def_ress['wood'] = $def_tech['wood'];
	if($row['building'] != "wood")
		unset($def_tech['wood']);
	$def_ress['stone'] = $def_tech['stone'];
	if($row['building'] != "stone")
		unset($def_tech['stone']);
	$def_ress['iron'] = $def_tech['iron'];
	if($row['building'] != "iron")
		unset($def_tech['iron']);

	$def_ress['hide'] = $def_tech['hide'];
	if($row['building'] != "hide")
		unset($def_tech['hide']);
	$def_ress['storage'] = $def_tech['storage'];
	if($row['building'] != "storage")
		unset($def_tech['storage']);

	$def_ress['last_prod_aktu'] = $def_tech['last_prod_aktu'];
	unset($def_tech['last_prod_aktu']);
	$def_ress['id'] = $row['to_village'];
	
	$def_agreement['agreement'] = $def_tech['agreement'];

	unset($def_tech['agreement']);
	$def_agreement['agreement_aktu'] = $def_tech['agreement_aktu'];
	unset($def_tech['agreement']);
	$def_agreement['id'] = $row['to_village'];
	
	$def_attacks = $def_tech['attacks'];
	unset($def_tech['attacks']);
	
	$def_snobed_by = $def_tech['snobed_by'];
	unset($def_tech['snobed_by']);

	if(!empty($row['building'])){
		$others['def_building'] = $def_tech[$row['building']];
		$others['cata_building'] = $row['building'];
		unset($def_tech[$row['building']]);
	}else{
		$others['def_building'] = 0;
		$others['cata_building'] = "";
	}

	$others['luck'] = mt_rand(-25,25);

	if($config['moral_activ']){
		if($row['to_userid'] == "-1")
			$others['moral'] = 100;
		else{
			$result = $db->query("SELECT `points` FROM `users` WHERE `id`='".$row['from_userid']."'");
			$att_player = $db->fetch($result);

			$result = $db->query("SELECT `points` FROM `users` WHERE `id`='".$row['to_userid']."'");
			$def_player = $db->fetch($result);

			$others['moral'] = calc_moral($def_player['points'],$att_player['points']);
		}
	}else
		$others['moral'] = 100;

	$simulate = simulate($att,$att_tech,$def,$def_tech,$others);

	if($row['building'] == "storage")
		$def_ress['storage'] = $simulate['others']['new_building'];

	$max_booty = 0;
	foreach($cl_units->get_array('dbname') as $dbname)
		$max_booty += $cl_units->get_booty($dbname)*($simulate['att'][$dbname]-$simulate['att_lose'][$dbname]);

	$ress_calc = ressis($def_ress,$event_time);

	$ress_calc['r_wood'] -= $arr_maxhide[$def_ress['hide']];
	$ress_calc['r_stone'] -= $arr_maxhide[$def_ress['hide']];
	$ress_calc['r_iron'] -= $arr_maxhide[$def_ress['hide']];

	$ress_calc['r_wood'] = ($ress_calc['r_wood'] < 0) ? 0 : $ress_calc['r_wood'];
	$ress_calc['r_stone'] = ($ress_calc['r_stone'] < 0) ? 0 : $ress_calc['r_stone'];
	$ress_calc['r_iron'] = ($ress_calc['r_iron'] < 0) ? 0 : $ress_calc['r_iron'];

	$ress_calc['all_ress'] = $ress_calc['r_wood']+$ress_calc['r_stone']+$ress_calc['r_iron'];
	$ress_calc['procent_wood'] = ($ress_calc['all_ress']=="0")?0:(100/$ress_calc['all_ress']) * $ress_calc['r_wood'];
	$ress_calc['procent_stone'] = ($ress_calc['all_ress']=="0")?0:(100/$ress_calc['all_ress']) * $ress_calc['r_stone'];
	$ress_calc['procent_iron'] = ($ress_calc['all_ress']=="0")?0:(100/$ress_calc['all_ress']) * $ress_calc['r_iron'];

	$max_ress_booty = floor($max_booty*($ress_calc['procent_wood']/100));
	$booty['wood'] = ($max_ress_booty>$ress_calc['r_wood'])?$ress_calc['r_wood']:$max_ress_booty;

	$max_ress_booty = floor($max_booty*($ress_calc['procent_stone']/100));
	$booty['stone'] = ($max_ress_booty>$ress_calc['r_stone'])?$ress_calc['r_stone']:$max_ress_booty;

	$max_ress_booty = floor($max_booty*($ress_calc['procent_iron']/100));
	$booty['iron'] = ($max_ress_booty>$ress_calc['r_iron'])?$ress_calc['r_iron']:$max_ress_booty;

	$stolen_booty = $booty['wood'] + $booty['stone'] + $booty['iron'];

	$not_enough_wood = false;
	$not_enough_stone = false;
	$not_enough_iron = false;
	while($stolen_booty < $max_booty){
		if($stolen_booty < $max_booty && $ress_calc['r_wood']-$booty['wood'] > 0){
		    $booty['wood']++;
		    $stolen_booty++;
		}else
		    $not_enough_wood = true;
		if($stolen_booty < $max_booty && $ress_calc['r_stone']-$booty['stone'] > 0){
		    $booty['stone']++;
		    $stolen_booty++;
		}else
		    $not_enough_stone = true;
		if($stolen_booty < $max_booty && $ress_calc['r_iron']-$booty['iron'] > 0){
		    $booty['iron']++;
		    $stolen_booty++;
		}else
		    $not_enough_iron = true;

		if($not_enough_wood && $not_enough_stone && $not_enough_iron)
			break;
	}

	$market_ress['wood'] = 0;
	$market_ress['stone'] = 0;
	$market_ress['iron'] = 0;
	if($stolen_booty < $max_booty){
		$result = $db->query("SELECT `sell`,`sell_ress`,`id` FROM `offers` WHERE `from_village`='".$row['to_village']."'");
		while($offers = $db->fetch($result)){
			if($stolen_booty >= $max_booty)
				break;
			$ress = $max_booty-$stolen_booty;
			$offers_num = ceil($ress/$offers['sell']);
			$db->query("DELETE FROM `offers_multi` WHERE `id`=".$offers['id']." LIMIT $offers_num");
			$num = $db->affectedrows();
			$offers_ress = $num*$offers['sell'];
			if($ress < $offers_ress){
				$booty[$offers['sell_ress']] += $ress;
				$market_ress[$offers['sell_ress']] += $ress;
				$stolen_booty += $ress;
				$ress_to_village = $offers_ress-$ress;
				$db->query("UPDATE `villages` SET `r_".$offers['sell_ress']."`=`r_".$offers['sell_ress']."`+'".$ress_to_village."' WHERE `id`='".$row['to_village']."'");
			}else{
				$booty[$offers['sell_ress']] += $offers_ress;
				$market_ress[$offers['sell_ress']] += $offers_ress;
				$stolen_booty += $offers_ress;
			}

			if($db->numrows($db->query("SELECT `id` FROM `offers_multi` WHERE `id`='".$offers['id']."'")) == 0)
				$db->unb_query("DELETE FROM `offers` WHERE `id`='".$offers['id']."'");
			else
				$db->unb_query("UPDATE `offers` SET `multi`=`multi`-'".$num."' WHERE `id`='".$offers['id']."'");

			$db->unb_query("UPDATE `villages` SET `dealers_outside`=`dealers_outside`-'".(ceil($offers['sell']/1000)*$num)."' WHERE `id`='".$row['to_village']."'");
		}
	}
	$rows_query = array();
	$sql = "UPDATE `villages` SET ";
	$bh_profit = 0;
	if($others['def_wall'] != $simulate['others']['new_wall']){
		$rows_query[] = "`wall`='".$simulate['others']['new_wall']."'";
		for($n=$simulate['others']['new_wall']+1;$n<=$others['def_wall'];$n++)
			$bh_profit += $cl_builds->get_bh('wall', $n);
	}
	if($others['def_building'] != $simulate['others']['new_building']){
 		$rows_query[] = $others['cata_building']."='".$simulate['others']['new_building']."'";
		for($n=$simulate['others']['new_building']+1;$n<=$others['def_building'];$n++)
			$bh_profit += $cl_builds->get_bh($others['cata_building'], $n);
	}
	if($booty['wood'] != "0")
		$rows_query[] = "`r_wood`=`r_wood`-'".($booty['wood']-$market_ress['wood'])."'";
	if($booty['stone'] != "0")
		$rows_query[] = "`r_stone`=`r_stone`-'".($booty['stone']-$market_ress['stone'])."'";
	if($booty['iron'] != "0")
		$rows_query[] = "`r_iron`=`r_iron`-'".($booty['iron']-$market_ress['iron'])."'";
	if($bh_profit > 0)
		$rows_query[] = "`r_bh`=`r_bh`-'$bh_profit'";

	$insert_snobed_def = false;
	if($simulate['att']['unit_snob']-$simulate['att_lose']['unit_snob'] != 0){
		$agreement_abzug = mt_rand($config['agreement_min'],$config['agreement_max']);
		$def_agreement['agreement'] = calc_agreement($def_agreement,$event_time);
		$agreement = $def_agreement['agreement'].";";
		$def_agreement['agreement'] -= $agreement_abzug;
		$agreement .= $def_agreement['agreement'];
		$rows_query[] = "`agreement_aktu`='".$event_time."'";
		if($def_agreement['agreement'] <= 0){
			$rows_query[] = "`agreement`='25'";
			foreach($cl_units->get_array('dbname') as $dbname)
				$u_querys[] = "$dbname";
			$result = $db->query("SELECT ".implode(",",$u_querys)." FROM `unit_place` WHERE `villages_from_id`='".$row['to_village']."' AND `villages_to_id`='".$row['to_village']."'");
			$in_village_units = $db->fetch($result);

			$querys = array();
			foreach($cl_units->get_array('dbname') as $dbname)
				$querys[] = "all_".$dbname."";
			$result = $db->query("SELECT ".implode(",", $querys)." FROM `villages` WHERE `id`='".$row['to_village']."'");
			$outside_units_row = $db->fetch($result);
			$outside_units = array();
			$bh_outside = 0;
			$units_in_village = array();

			foreach($cl_units->get_array('dbname') as $dbname){
				$outside_units[] = $outside_units_row['all_'.$dbname]-$simulate['def'][$dbname];
				$bh_outside += ($outside_units_row['all_'.$dbname]-$in_village_units[$dbname])*$cl_units->get_bhprice($dbname);
				$rows_query[] = "all_".$dbname."=0";
			}

			$outside_deff_village = implode(";",$outside_units);
			$del_event = true;
			$db->query("DELETE FROM `movements` WHERE `id`='".$row['id']."'");
			$res = $db->query("SELECT SUM(`unit_snob`) AS `snob_count` FROM `unit_place` WHERE `villages_from_id`='".$row['to_village']."' AND `villages_from_id`!=`villages_to_id`");
			$res = $db->fetch($res);
			if($res['snob_count'] != 0)
				$db->query("UPDATE villages SET `recruited_snobs`=`recruited_snobs`-'".$res['snob_count']."' WHERE `id`='".$row['to_village']."'");
			$db->query("DELETE FROM `unit_place` WHERE `villages_from_id`='".$row['to_village']."' AND `villages_from_id`!=`villages_to_id`");

			$result = $db->query("SELECT `id`,`units`,`type` FROM `movements` WHERE `send_from_village`='".$row['to_village']."'");
			while($mov = $db->fetch($result)){
				$units = explode(";", $mov['units']);
				$i = 0;
				foreach($cl_units->get_array('dbname') as $dbname){
					if($dbname == 'unit_snob' && $units[$i] != 0){
					    $db->unb_query("UPDATE `villages` SET `recruited_snobs`=`recruited_snobs`-'".$units[$i]."' WHERE `id`='".$row['to_village']."'");
					}
				    $i++;
				}
				if($mov['type'] != 'attack'){
					$db->unb_query("DELETE FROM `events` WHERE `event_id`='".$mov['id']."' AND `event_type`='movement'");
					$db->unb_query("DELETE FROM `movements` WHERE `id`='".$mov['id']."'");
				}
			}

			$db->unb_query("UPDATE `events` SET `user_id`='".$row['from_userid']."' WHERE `villageid`='".$row['to_village']."'");
			$db->unb_query("UPDATE `movements` SET `die`='1', `from_userid`='".$row['from_userid']."' WHERE `send_from_village`='".$row['to_village']."'");
			$db->unb_query("UPDATE `movements` SET `to_userid`='".$row['from_userid']."' WHERE `to_village`='".$row['to_village']."' AND `type`='attack'");

			$rows_query[] = "`userid`='".$row['from_userid']."'";
			$rows_query[] = "`r_bh`=`r_bh`-'".$bh_outside."'";
			$rows_query[] = "`snobed_by`='".$row['from_village']."'";

			if($def_snobed_by != '-1')
				$db->query("UPDATE `villages` SET `control_villages`=`control_villages`-'1' WHERE `id`='".$def_snobed_by."'");

			$db->unb_query("UPDATE `villages` SET `control_villages`=`control_villages`+'1',`recruited_snobs`=`recruited_snobs`-'1',`all_unit_snob`=`all_unit_snob`-'1',`r_bh`=`r_bh`-".$cl_units->get_bhprice('unit_snob')." where `id`='".$row['from_village']."'");

			if(!in_array($row['to_userid'],$reload_allys))
				$reload_alllys[] = $row['to_userid'];
			if(!in_array($row['from_userid'],$reload_allys))
				$reload_alllys[] = $row['from_userid'];
			$def_attacks--;

			$result = $db->query("SELECT `username` FROM `users` WHERE `id`='".$row['from_userid']."'");
			$att_player = $db->fetch($result);			

			$db->unb_query("UPDATE `users` SET `villages`=`villages`-'1',`attacks`=`attacks`-'$def_attacks',`ennobled_by`='".$att_player['username']."' WHERE `id`='".$row['to_userid']."'");
			$db->unb_query("UPDATE `offers` SET `userid`=".$row['from_userid']." WHERE `from_village`=".$row['to_village']."");
			$db->unb_query("UPDATE `users` SET `villages`=`villages`+'1',`attacks`=`attacks`+'$def_attacks' WHERE `id`='".$row['from_userid']."'");
			$db->unb_query("UPDATE `dealers` SET `from_userid`='".$row['from_userid']."' WHERE `from_village`='".$row['to_village']."'");
			$db->unb_query("UPDATE `dealers` SET `to_userid`='".$row['from_userid']."' WHERE `to_village`='".$row['to_village']."'");

			$insert_snobed_def = true;
		}else{
			$rows_query[] = "`agreement`=`agreement`-'".$agreement_abzug."'";
			$outside_deff_village = "";
		}
	}else{
		$agreement = "100;100";
		$outside_deff_village = "";
	}
	$rows_query[] = "`attacks`=`attacks`-'1'";
	$sql .= implode(",", $rows_query);
	$sql .= " WHERE `id`='".$row['to_village']."'";
	if(count($rows_query) > 0)
		$db->query($sql);
    if($insert_snobed_def){
        reload_player_points($row['from_userid']);
        reload_player_points($row['to_userid']);
        reload_player_rangs();
    }
    if($others['def_wall'] != $simulate['others']['new_wall'] || $others['def_building'] != $simulate['others']['new_building']){
        reload_village_points($row['to_village']);
        reload_player_points($row['to_userid']);
        reload_player_rangs();
		if(!in_array($row['to_userid'],$reload_allys))
			$reload_alllys[] = $row['to_userid'];
    }
	$new_att_units = array();
	$att_bh_profit = 0;
	$all_units_died_att = true;
	foreach($simulate['att'] as $unit=>$num){
		$new_att_units[] = $num-$simulate['att_lose'][$unit];
		$att_bh_profit += $simulate['att_lose'][$unit]*$cl_units->get_bhprice($unit);
		if($num-$simulate['att_lose'][$unit] != "0")
			$all_units_died_att = false;
	}

	$return_end = $row['end_time']+($row['end_time']-$row['start_time']);

	$do_return_try = true;
	if($all_units_died_att || $row['die'] == 1){
		$logging .= msec().": Lösche Bewegung mov<br />";
		$db->query("DELETE FROM `movements` where `id`='".$row['id']."'");
		$del_event = true;
		$do_return_try = false;
	}else{
		$logging .= msec().": Update mov<br />";
		$db->query("UPDATE `movements` SET `wood`='".$booty['wood']."',`stone`='".$booty['stone']."',`iron`='".$booty['iron']."',`units`='".implode(";", $new_att_units)."',`type`='return',`to_hidden`='1',`from_village`='".$row['to_village']."',`from_userid`='".$row['to_userid']."',`to_village`='".$row['from_village']."',`to_userid`='".$row['from_userid']."',`start_time`=".$row['end_time'].",`end_time`='".$return_end."' WHERE `id`='".$row['id']."'");
	}
	$db->query("UPDATE `users` SET `attacks`=`attacks`-'1' WHERE `id`='".$row['to_userid']."'");

	$units_accounteFor = array();
	$abzug = array();
	$max_abzug = array();
	$result = $db->query("SELECT ".implode(",", $cl_units->get_array('dbname')).",`villages_from_id` FROM `unit_place` WHERE `villages_to_id`='".$row['to_village']."'");
	while($row_unitplace = $db->fetch($result)){
		foreach($cl_units->get_array('dbname') as $dbname){
		    if(!isset($units_accounteFor[$dbname]))
		        $units_accounteFor[$dbname] = 0;
			if($row_unitplace[$dbname] != 0 && $simulate['def_lose'][$dbname] != 0)
				$v_abzug = $simulate['def_lose'][$dbname]*(((100/$simulate['def'][$dbname])*$row_unitplace[$dbname])/100);
			else
			    $v_abzug = 0;

			$abzug[$row_unitplace['villages_from_id']][$dbname] = round($v_abzug);
			$max_abzug[$row_unitplace['villages_from_id']][$dbname] = $row_unitplace[$dbname];
			$units_accounteFor[$dbname] += $abzug[$row_unitplace['villages_from_id']][$dbname];
		}
	}

	while(true){
		foreach($abzug as $id=>$arr){
			foreach($cl_units->get_array('dbname') as $dbname){
				if($units_accounteFor[$dbname] != $simulate['def_lose'][$dbname] && $abzug[$id][$dbname] != 0 && $abzug[$id][$dbname] != $max_abzug[$id][$dbname]){
					if($units_accounteFor[$dbname] > $simulate['def_lose'][$dbname]){
						$abzug[$id][$dbname]--;
						$units_accounteFor[$dbname]--;
					}else{
						$abzug[$id][$dbname]++;
						$units_accounteFor[$dbname]++;
					}
				}
			}	
		}
		break;
	}
	if($insert_snobed_def){
		$sqlq = "INSERT INTO `unit_place` (`villages_from_id`,`villages_to_id`,".implode(",", $cl_units->get_array('dbname')).") VALUES ('".$row['from_village']."','".$row['to_village']."'";
		foreach($cl_units->get_array('dbname') as $dbname){
        	if($dbname == "unit_snob")
				$sqlq .= ",'".($simulate['att'][$dbname] - $simulate['att_lose'][$dbname] - 1)."'";
			else
				$sqlq .= ",'".($simulate['att'][$dbname] - $simulate['att_lose'][$dbname])."'";
		}
		$sqlq .= ")";
		$db->unb_query($sqlq);
	}

	$result = $db->query("SELECT `name`,`x`,`y`,`continent` FROM `villages` WHERE `id`='".$row['to_village']."'");
	$arr = $db->fetch($result);
	$row['to_villagename'] = entparse($arr['name']).' ('.$arr['x'].'|'.$arr['y'].') K'.$arr['continent'];

	$result = $db->query("SELECT `name` FROM `villages` WHERE `id`='".$row['from_village']."'");
	$arr = $db->fetch($result);
	$row['from_villagename'] = entparse($arr['name']);
	
	$bh_def = 0;
	foreach($abzug as $id=>$arr){
		$sql = "UPDATE `unit_place` SET ";
		$row_query = array();
		foreach($abzug[$id] as $dbname=>$num)
			$row_query[] = "$dbname=$dbname-'$num'";
		$sql .= implode(",", $row_query);
		$sql .= " WHERE `villages_from_id`='".$id."' AND `villages_to_id`='".$row['to_village']."'";
		$db->query($sql);

		$bh = 0;
		foreach($abzug[$id] as $dbname=>$num)
		    $bh += $cl_units->get_bhprice($dbname)*$num;
			
		$bh_def += $bh;

		$sql = "UPDATE `villages` SET ";
		$row_query = array();
		if(!($def_agreement['agreement'] < 0 && $id == $row['to_village'])){
			foreach($abzug[$id] as $dbname=>$num)
				$row_query[] = "`all_".$dbname."`=`all_".$dbname."`-'".$num."'";
		}

		if($abzug[$id]['unit_snob'] != 0)
		    $row_query[] = "`recruited_snobs`=`recruited_snobs`-".$abzug[$id]['unit_snob']."";

		$row_query[] = "`r_bh`=`r_bh`-'$bh'";
		$sql .= implode(",", $row_query);
		$sql .= " WHERE `id`='".$id."'";
		$db->query($sql);

		$all_units_died = true;
		$no_units_died = true;
		foreach($abzug[$id] as $dbname=>$num){
			if($max_abzug[$id][$dbname]-$num != 0)
				$all_units_died = false;
			if($max_abzug[$id][$dbname] != $num)
				$no_units_died = false;
		}
		if($id != $row['to_village']){
           	if($all_units_died)
                $color = "red";
            elseif($no_units_died)
           	    $color = "green";
           	else
                $color = "yellow";

			$result = $db->query("SELECT `name`,`userid` FROM `villages` WHERE `id`='".$id."'");
			$arr = $db->fetch($result);
			$support_villagename = entparse($arr['name']);

			$result = $db->query("SELECT `id` FROM `users` WHERE `id`='".$arr['userid']."'");
			$arr = $db->fetch($result);
			$support_userid = $arr['id'];

           	$cl_reports->support_attack($support_userid,$id,$support_villagename,$row['to_userid'],$row['to_village'],$row['to_villagename'],$color,$event_time,implode(";", $max_abzug[$id]),implode(";", $abzug[$id]));
			if($all_units_died)
				$db->query("DELETE FROM `unit_place` WHERE `villages_from_id`='".$id."' AND `villages_to_id`='".$row['to_village']."'");
		}
	}

	$db->unb_query("UPDATE `users` SET `killed_units_att`=`killed_units_att`+".$bh_def.",`killed_units_altogether`=`killed_units_altogether`+".$bh_def." WHERE `id`=".$row['from_userid']."");
	if($from_user['ally'] != '-1'){
		$db->unb_query("UPDATE `ally` SET `killed_units_att`=`killed_units_att`+".$bh_def.",`killed_units_altogether`=`killed_units_altogether`+".$bh_def." WHERE `id`=".$from_user['ally']."");
	}

	$row_querys = array();
	if($row['die'] != 1)
		$row_querys[] = "`r_bh`=`r_bh`-'$att_bh_profit'";	

	$db->unb_query("UPDATE `users` SET `killed_units_def`=`killed_units_def`+".$att_bh_profit.",`killed_units_altogether`=`killed_units_altogether`+".$att_bh_profit." WHERE `id`=".$row['to_userid']."");
	if($to_user['ally'] != '-1'){
		$db->unb_query("UPDATE `ally` SET `killed_units_def`=`killed_units_def`+".$att_bh_profit.",`killed_units_altogether`=`killed_units_altogether`+".$att_bh_profit." WHERE `id`=".$to_user['ally']."");
	}

	if($simulate['att_lose']['unit_snob'] != 0 && $row['die'] != 1)
	    $row_querys[] = "`recruited_snobs`=`recruited_snobs`-".$simulate['att_lose']['unit_snob'];
	if($row['die'] != 1){
		foreach($cl_units->get_array('dbname') as $dbname)
			$row_querys[] = "`all_".$dbname."`=`all_".$dbname."`-'".$simulate['att_lose'][$dbname]."'";
	}
	if(count($row_querys)){
		$db->unb_query("UPDATE `villages` SET ".implode(",", $row_querys)." WHERE `id`='".$row['from_village']."'");
	}
	$result = $db->query("SELECT `username` FROM `users` WHERE `id`='".$row['from_userid']."'");
	$arr = $db->fetch($result);
	$row['from_username'] = entparse($arr['username']);
	
	$ram = $others['def_wall'].";".$simulate['others']['new_wall'];
	$catapult = $others['def_building'].";".$simulate['others']['new_building'].";".$others['cata_building'];
	$booty = $booty['wood'].";".$booty['stone'].";".$booty['iron'].";".$stolen_booty.";$max_booty";
	
	$cl_reports->attack($row['from_userid'],$row['from_username'],$row['from_village'],$row['from_villagename'],$row['to_userid'],$row['to_village'],$row['to_villagename'],$simulate['others']['wins'],$simulate['others']['att_color'],$simulate['others']['def_color'],$row['end_time'],implode(";", $simulate['att']),implode(";", $simulate['att_lose']),implode(";", $simulate['def']),implode(";", $simulate['def_lose']),$outside_deff_village,$agreement,$ram,$catapult,$booty,$others['luck'],$others['moral'],$simulate['others']['see_def_units']);

	if(!($all_units_died_att || $row['die'] == 1)){
		$logging .= msec().": Event updaten<br />";
		$db->query("UPDATE `events` SET `event_time`='".$return_end."',`can_knot`='0',`cid`='0' WHERE `event_id`='".$row['id']."' AND `event_type`='movement'");
		$db->query("DELETE FROM `run_events` WHERE `id`='".$event_id."movement'");
	}
	$reloaded = array();
	foreach($reload_allys as $id){
		$result = $db->query("SELECT `ally` FROM `users` WHERE `id`='".$id."'");
		$r = $db->fetch($result);
		if(!in_array($r['ally'],$reloaded))
			reload_ally_points($r['ally']);
		$reloaded[] = $r['ally'];
	}
	reload_ally_rangs();
	if($do_return_try && !$del_event && $return_end <= time()){
		$logging .= msec().": gleich zurÃ¼ck<br />";
		$del_event = do_movement($row['id'], $event_id,$event_time);
	}
	return $del_event;
}
function check_events(){
	global $user;
	global $village;
	global $session;
	global $logging;
	global $db;
	global $conf;

	$time = (empty($time)) ? time() : $time;
	$reload_village_points = array();
	$cid = generate_key();

	$event_ids = array();
	$do_event=true;
	$i = 0;
	$do_mov = false;

	$reload_allys = array();
	$result = $db->query("SELECT `id`,`user_id`,`event_type`,`event_id`,`knot_event` FROM `events` WHERE `event_time` < '".$time."'");
	while($row = $db->fetch($result)){
		$delete_event=false;
		$do_event = true;
		if($row['event_type'] == 'movement' && $do_event)
  			$logging = msec().": Angriff: ".$row['id']."<br />";
		if(in_array($row['event_type']."_".$row['event_id'], $event_ids)){
			$delete_event = true;
			$do_event = false;
		}

		@$event_ids[$i] = $row['event_type']."_".$row['event_id'];

		if($do_event){
			switch($row['event_type']){
				case 'build':
					$villageid = check_builds($row['event_id']);
					if(isset($villageid)){
						$reload_village_points[$villageid] = "";
						$delete_event = true;
					}
				break;
				case 'destroy':
					$villageid = check_destroy($row['event_id']);
					if(isset($villageid)){
						$reload_village_points[$villageid] = "";
						$delete_event = true;
					}
				break;
				case 'movement':
					$do_mov = true;
					$logging .= msec().": Gehe in do_mov().<br />";
					$movement_return = do_movement($row['event_id'],$row['id'],$time);
					if($movement_return){
						$delete_event = true;
					}
				break;
				case 'recruit':
					$rekruit = check_recruit($row['event_id'],$time);
					if(!is_numeric($rekruit)){
						$delete_event = true;
					}else{
					    $delete_event = false;
					    $db->query("UPDATE `events` SET `event_time`='".$rekruit."',`cid`='0' WHERE `id`='".$row['id']."'");
					    $db->query("DELETE FROM `run_events` WHERE `id`='".$row['id'].$row['event_type']."'");
					}
				break;
				case 'research':
					check_tech($row['event_id']);
					$delete_event=true;
				break;
				case 'dealers':
					$delete_event = check_dealers($row['event_id'],$row['id']);
				break;
			}
		}
		if($delete_event){
			$db->query("DELETE FROM `events` WHERE `id`='".$row['id']."'");
			$logging .= msec().": Lï¿½sche event main<br />";
		}else{
			$db->unb_query("UPDATE `events` SET `is_locked`='0' WHERE `id`=".$row['id']." AND `is_locked`='1'");
			$logging .= msec().": update event main<br />";
		}
		if($row['event_type'] == 'movement' && $do_event){
  			logging($row['event_id'],$logging,'movement');
  			$logging  = "";
		}
		$i++;
	}
	foreach($reload_village_points as $id=>$value){
        reload_village_points($id);
        $re = $db->query("SELECT userid from villages where id=".$id);
		$row = $db->fetch($re);
        $playerid = $row['userid'];
        reload_player_points($playerid);
        reload_player_rangs();
		$re = $db->query("SELECT `ally` FROM `users` WHERE `id`='".$playerid."'");
		$row = $db->fetch($re);
		if(!in_array($row['ally'],$reload_allys))
			$reload_allys[] = $row['ally'];
    }
    foreach($reload_allys as $id)
        reload_ally_points($id);
    if(count($reload_allys) > 0)
		reload_ally_rangs($id);
    if($do_mov){
        reload_kill_player();
		reload_kill_ally();
	}
	$auto_build = $config['auto_build'];
	if($auto_build['active'])
		grow_vill();
}
check_events();
?>
