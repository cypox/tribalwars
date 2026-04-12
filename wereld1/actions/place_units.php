<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}

if(isset($_GET['action']) && $_GET['action'] == "command_other"){
	if($session['hkey'] != $_GET['h']){
		exit("Desculpe, más o código de segurança está invalido!");
	}

	foreach($_POST as $id => $value){
		if(substr($id, 0,3) == 'id_' && $value == 'on'){
			$id = array_pop(explode("_", $id));
			if($village['id'] == $id){
				exit("Desculpe, más você não pode devolver as topas da mesma aldeia!");
			}
			$result = $db->query("SELECT ".implode(",", $cl_units->get_array('dbname'))." FROM `unit_place` WHERE `villages_from_id`='".$id."' AND `villages_to_id`='".$village['id']."'");
			$arr_units = $db->fetch($result);
			if(count($arr_units) <= 1 || !is_numeric(count($arr_units))){
				exit("Desculpe, más está ação não pode ser cumprida!");
			}
			$result = $db->query("SELECT `userid`,`x`,`y` FROM `villages` WHERE `id`='".$id."'");
			$village_row = $db->fetch($result);
			$start_time = time();
			$end_time = $start_time+unit_running($village['x'], $village['y'], $village_row['x'], $village_row['y'], $cl_units->get_lowest_unit($arr_units));
			add_movement($village_row['userid'],$id,$village['userid'],$village['id'],implode(";", $arr_units),'back',$start_time,$end_time,true,'');
			$db->query("DELETE FROM `unit_place` WHERE `villages_from_id`='".$id."' AND `villages_to_id`='".$village['id']."'");
			$d->open();
			header("LOCATION: game.php?village=".$village['id']."&screen=place&mode=units");
		}
	}
}
if(isset($_GET['action']) && $_GET['action'] == "back"){
	$unit_id = parse(@$_GET['unit_id']);
	if($session['hkey'] != $_GET['h']){
		$error = "Desculpe, más o código de segurança está invalido!";
	}

	if(empty($error) && $village['id'] == $unit_id){
		$error = "Desculpe, más você não pode devolver as topas da mesma aldeia!";
	}
	$result = $db->query("SELECT ".implode(",", $cl_units->get_array('dbname'))." FROM `unit_place` WHERE `villages_from_id`='".$village['id']."' AND `villages_to_id`='".$unit_id."'");
	$arr_units = $db->fetch($result);
	if(empty($error) && count($arr_units) <= 1 || !is_numeric(count($arr_units))){
		$error = "Desculpe, más está ação não pode ser cumprida!";
	}
	$send_units = array();
	$to_many_units = false;
	$units_chossed = false;
	foreach($cl_units->get_array('dbname') as $dbname){
		if(empty($_POST[$dbname])){
			$send_units[$dbname] = 0;
		}elseif(((int)$_POST[$dbname]) < 0){
			$send_units[$dbname] = 0;
		}elseif(((int)$_POST[$dbname]) > $arr_units[$dbname]){
			$to_many_units = true;
			break;
		}else{
			$send_units[$dbname] = (int)$_POST[$dbname];
			$units_chossed = true;
		}
	}
	if(empty($error) && $to_many_units){
		$error = "Desculpe, más não existe unidades suficientes!";
	}
	if(empty($error) && !$units_chossed){
		$error = "Desculpe, más você não selecionou nenhuma unidade!";
	}
	if(empty($error)){
		$result = $db->query("SELECT `userid`,`x`,`y` FROM `villages` WHERE `id`='".$unit_id."'");
		$village_row = $db->fetch($result);
		$start_time = time();
		$end_time = $start_time+unit_running($village['x'], $village['y'], $village_row['x'], $village_row['y'], $cl_units->get_lowest_unit($send_units));
		add_movement($village['userid'],$village['id'],$village_row['userid'],$unit_id,implode(";", $send_units),'back',$start_time,$end_time,true,'');
		$querys = array();
		foreach($cl_units->get_array('dbname') as $dbname){
			$querys[] = "$dbname=$dbname-".$send_units[$dbname];
		}
		$db->query("UPDATE `unit_place` SET ".implode(",", $querys)." WHERE `villages_to_id`='".$unit_id."' AND `villages_from_id`='".$village['id']."'");
        $result = $db->query("SELECT * FROM `unit_place` WHERE `villages_to_id`='".$unit_id."' AND `villages_from_id`='".$village['id']."'");
        while($row = $db->fetch($result)){
            $sum = 0;
            foreach($cl_units->get_array('dbname') as $dbname){
                $sum += $row[$dbname];
            }
            if($sum == 0){
                $db->query("DELETE FROM `unit_place` WHERE `villages_to_id`='".$row['villages_to_id']."' AND `villages_from_id`='".$row['villages_from_id']."'");
            }
        }
		$all_units_away = true;
		foreach($cl_units->get_array('dbname') as $dbname){
			if($arr_units[$dbname]-$send_units[$dbname] != 0){
				$all_units_away = false;
			}
		}
		if($all_units_away){
			$db->query("DELETE FROM `unit_place` WHERE `villages_from_id`='".$id."' AND `villages_to_id`='".$village['id']."'");
		}
		$d->open();
		header("LOCATION: game.php?village=".$village['id']."&screen=place&mode=units");		
	}
}
if(isset($_GET['action']) && $_GET['action'] == 'all_back'){
	$unit_id = parse(@$_GET['unit_id']);
	if($session['hkey'] != $_GET['h']){
		$error = "Desculpe, más o código de segurança está invalido!";
	}

	if(empty($error) && $village['id'] == $unit_id){
		$error = "Desculpe, más você não pode devolver as topas da mesma aldeia!";
	}
	$result = $db->query("SELECT ".implode(",", $cl_units->get_array('dbname'))." FROM `unit_place` WHERE `villages_from_id`='".$village['id']."' AND `villages_to_id`='".$unit_id."'");
	$arr_units = $db->fetch($result);
	if(empty($error) && count($arr_units) <= 1 || !is_numeric(count($arr_units))){
		$error = "Desculpe, más está ação não pode ser cumprida!";
	}
	if(empty($error)){
		$result = $db->query("SELECT `userid`,`x`,`y` FROM `villages` WHERE `id`='".$unit_id."'");
		$village_row = $db->fetch($result);
		$start_time = time();
		$end_time = $start_time+unit_running($village['x'], $village['y'], $village_row['x'], $village_row['y'], $cl_units->get_lowest_unit($arr_units));
		add_movement($village['userid'],$village['id'],$village_row['userid'],$unit_id,implode(";", $arr_units),'back',$start_time,$end_time,true,'');
		$db->query("DELETE FROM `unit_place` WHERE `villages_to_id`='".$unit_id."' AND `villages_from_id`='".$village['id']."'");
		$d->open();
		header("LOCATION: game.php?village=".$village['id']."&screen=place&mode=units");
	}
}
if(isset($_GET['try']) || $_GET['try'] == "back"){
	$unit_id = parse(@$_GET['unit_id']);
	if($village['id'] == $unit_id){
        exit("Desculpe, más você não pode devolver as topas da mesma aldeia!");
	}
	$result = $db->query("SELECT ".implode(",", $cl_units->get_array('dbname'))." FROM `unit_place` WHERE `villages_from_id`='".$village['id']."' AND `villages_to_id`='".$unit_id."'");
	$arr_units = $db->fetch($result);
	if(count($arr_units) <= 1 || !is_numeric(count($arr_units))){
		exit("Desculpe, más está ação não pode ser cumprida!");
	}
	foreach($cl_units->get_array("dbname") as $dbname){
		$group_units[$cl_units->get_col($dbname)][] = $dbname;
	}
	$_GET['screen'] = "place_units_try_back";
	$tpl->assign("group_units",$group_units);
	$tpl->assign("arr_units",$arr_units);
	$tpl->assign("unit_id",$unit_id);
}else{
	$own_units = array();
	$in_my_village_units = array();
	$all_units = array();
	$result = $db->query("SELECT ".implode(",", $cl_units->get_array('dbname')).",`villages_from_id` FROM `unit_place` WHERE `villages_to_id`='".$village['id']."'");
	while($row = $db->fetch($result)){
		if($village['id'] == $row['villages_from_id']) {
			foreach($cl_units->get_array('dbname') as $dbname){
				$own_units[$dbname] = $row[$dbname];
			}
		}else{
			foreach($cl_units->get_array('dbname') as $dbname){
				$in_my_village_units[$row['villages_from_id']][$dbname] = $row[$dbname];
			}
			$res = $db->query("SELECT `name`,`x`,`y`,`continent` FROM `villages` WHERE `id`='".$row['villages_from_id']."'");
			$vname = $db->Fetch($res);
			$in_my_village_units[$row['villages_from_id']]['villagename'] = entparse($vname['name']);
			$in_my_village_units[$row['villages_from_id']]['x'] = $vname['x'];
			$in_my_village_units[$row['villages_from_id']]['y'] = $vname['y'];
			$in_my_village_units[$row['villages_from_id']]['continent'] = $vname['continent'];
		}
		foreach($cl_units->get_array('dbname') as $dbname){
		    if(!isset($all_units[$dbname])){
		        $all_units[$dbname] = 0;
			}
			$all_units[$dbname] += $row[$dbname];
		}
	}
	$outside_village_units = array();
	$result = $db->query("SELECT ".implode(",", $cl_units->get_array('dbname')).",`villages_to_id` FROM `unit_place` WHERE `villages_from_id`='".$village['id']."'");
	while($row = $db->fetch($result)){
		if($village['id'] != $row['villages_to_id']){
			foreach($cl_units->get_array('dbname') as $dbname){
				$outside_village_units[$row['villages_to_id']][$dbname] = $row[$dbname];
			}
			$res = $db->query("SELECT `name`,`x`,`y`,`continent` FROM `villages` WHERE `id`='".$row['villages_to_id']."'");
			$vname = $db->fetch($res);
			$outside_village_units[$row['villages_to_id']]['villagename'] = entparse($vname['name']);
			$outside_village_units[$row['villages_to_id']]['x'] = $vname['x'];
			$outside_village_units[$row['villages_to_id']]['y'] = $vname['y'];
			$outside_village_units[$row['villages_to_id']]['continent'] = $vname['continent'];
		}
	}
	if(!isset($error)){
		$error = "";
	}

	$tpl->assign("outside_village_units",$outside_village_units);
	$tpl->assign("cl_units",$cl_units);
	$tpl->assign("own_units",$own_units);
	$tpl->assign("in_my_village_units",$in_my_village_units);
	$tpl->assign("all_units",$all_units);
	$tpl->assign("error",$error);
}
?>