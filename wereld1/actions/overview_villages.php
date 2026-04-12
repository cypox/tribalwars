<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}

$links = array(
	"Combinado" => "combined",
	"Produção" => "prod",
	"Tropas" => "units",
	"Comandos" => "commands",
	"Chegando" => "incomings"
);
if(isset($_GET['mode']) && $user['villages_mode'] != $_GET['mode'] && in_array($_GET['mode'], $links)){
	$db->query("UPDATE `users` SET `villages_mode`='".parse($_GET['mode'])."' WHERE `id`='".$user['id']."'");
    $user['villages_mode'] = $_GET['mode'];
}
if($user['villages_mode'] == "prod"){
	$villages = array();
	$result = $db->query("SELECT `smith_tec`,`attacks`,`id`,`main_build`,`wood`,`stone`,`iron`,`farm`,`last_prod_aktu`,`storage`,`r_bh`,`r_wood`,`r_stone`,`r_iron`,`points`,`name`,`points`,`x`,`y`,`continent` FROM `villages` WHERE `userid`='".$user['id']."' ORDER BY `name`,`id`");
	while($row = $db->fetch($result)){
		$ress = ressis($row);
		$villages[$row['id']]['r_wood'] = $ress['r_wood'];
		$villages[$row['id']]['r_stone'] = $ress['r_stone'];
		$villages[$row['id']]['r_iron'] = $ress['r_iron'];
		$villages[$row['id']]['r_bh'] = $row['r_bh'];
		$villages[$row['id']]['name'] = entparse($row['name']);
		$villages[$row['id']]['x'] = $row['x'];
		$villages[$row['id']]['y'] = $row['y'];
		$villages[$row['id']]['continent'] = $row['continent'];
		$villages[$row['id']]['points'] = $row['points'];
		$villages[$row['id']]['max_storage'] = $arr_maxstorage[$row['storage']];
		$villages[$row['id']]['max_farm'] = $arr_farm[$row['farm']];
		$villages[$row['id']]['attacks'] = $row['attacks'];
		if($row['id'] == $_GET['village']){ $villages[$row['id']]['lit'] = 'lit '; }

		if(!empty($row['main_build'])){
			list($first_build,$first_time) = explode(",", $row['main_build']);
			$villages[$row['id']]['first_build']['buildname'] = $cl_builds->Get_Name($first_build);
			$villages[$row['id']]['first_build']['end_time'] = format_date($first_time);
		}
		if(!empty($row['smith_tec'])){
			list($first_tec,$first_time) = explode(";", $row['smith_tec']);
			$villages[$row['id']]['first_tec']['tecname'] = $cl_techs->get_name($first_tec);
			$villages[$row['id']]['first_tec']['end_time'] = format_date($first_time);
		}

		$i = 0;
		$res = $db->query("SELECT `unit`,`num_unit`,`num_finished` FROM `recruit` WHERE `villageid`='".$row['id']."' ORDER BY `time_finished`");
		while($r = $db->fetch($res)){
			$num = $r['num_unit']-$r['num_finished'];
			$villages[$row['id']]['recruits'][$i]['unit'] = $cl_units->get_name($r['unit']);
			$villages[$row['id']]['recruits'][$i]['num'] = $num;
			$villages[$row['id']]['recruits'][$i]['dbname'] = $r['unit'];
			$i++;
		}
	}
	$tpl->assign("villages", $villages);
}
if($user['villages_mode'] == "combined"){
    $villages = array();
    $result = $db->query("SELECT `dealers_outside`,`smith_tec`,`id`,`main_build`,`farm`,`attacks`,`main`,`garage`,`stable`,`barracks`,`smith`,`market`,`trader_away`,`farm`,`r_bh`,`name`,`x`,`y`,`continent` FROM `villages` WHERE `userid`='".$user['id']."' ORDER BY `name`,`id`");
    while($row = $db->fetch($result)){
        $villages[$row['id']]['r_bh'] = $row['r_bh'];
        $villages[$row['id']]['name'] = entparse($row['name']);
        $villages[$row['id']]['x'] = $row['x'];
        $villages[$row['id']]['y'] = $row['y'];
		$villages[$row['id']]['continent'] = $row['continent'];
        $villages[$row['id']]['max_farm'] = $arr_farm[$row['farm']];
        $villages[$row['id']]['trader_away'] = $row['trader_away'];
        $villages[$row['id']]['market'] = $row['market'];
        $villages[$row['id']]['barracks'] = $row['barracks'];
        $villages[$row['id']]['stable'] = $row['stable'];
        $villages[$row['id']]['garage'] = $row['garage'];
        $villages[$row['id']]['smith'] = $row['smith'];
        $villages[$row['id']]['farm'] = $row['farm'];
		$villages[$row['id']]['attacks'] = $row['attacks'];
		if($row['id'] == $_GET['village']){ $villages[$row['id']]['lit'] = 'lit '; }

        if(!empty($row['main_build'])){
        	list($first_build,$first_time) = explode(",", $row['main_build']);
			$villages[$row['id']]['first_build']['buildname'] = $cl_builds->Get_Name($first_build);
			$villages[$row['id']]['first_build']['end_time'] = format_date($first_time);
		}
        if(!empty($row['smith_tec'])){
        	list($first_tec,$first_time) = explode(";", $row['smith_tec']);
			$villages[$row['id']]['first_tec']['tecname'] = $cl_techs->get_name($first_tec);
			$villages[$row['id']]['first_tec']['end_time'] = format_date($first_time);
		}	

		$unit = $cl_units->get_array("name");
		foreach($unit as $key => $value){
			$villages[$row['id']][$key] = 0;	
		}

		$sql = "SELECT ";
		$i=0;
		foreach ($unit as $key=>$value){
			$i++;
			if(count($unit) == $i){
  				$sql .= "$key";
  			}else{
  				$sql .= "$key,";
  			}
  		}
  		$sql .= " FROM `unit_place` WHERE `villages_to_id`='".$row['id']."'";
		$result2 = $db->query($sql);
        while($units = $db->fetch($result2)){
            foreach($unit as $key => $value){
                $villages[$row['id']][$key] += $units[$key];
            }
        }

        $villages[$row['id']]['dealers']['max_dealers'] = get_dealers($row['market']);
		$villages[$row['id']]['dealers']['in_village'] = get_dealers($row['market'])-$row['dealers_outside'];

		$res = $db->query("SELECT `time_finished`,`unit` FROM `recruit` WHERE `villageid`='".$row['id']."' AND `building`='barracks' ORDER BY `id` DESC LIMIT 1");
		$r = $db->fetch($res);
		if(!empty($r['unit'])){
			$villages[$row['id']]['barracks_prod']['unit'] = $cl_units->get_name($r['unit']);
			$villages[$row['id']]['barracks_prod']['time'] = format_date($r['time_finished']);
		}
		$res = $db->query("SELECT `time_finished`,`unit` FROM `recruit` WHERE `villageid`='".$row['id']."' AND `building`='stable' ORDER BY `id` DESC LIMIT 1");
		$r = $db->fetch($res);
		if(!empty($r['unit'])){
			$villages[$row['id']]['stable_prod']['unit'] = $cl_units->get_name($r['unit']);
			$villages[$row['id']]['stable_prod']['time'] = format_date($r['time_finished']);
		}
		$res = $db->query("SELECT `time_finished`,`unit` FROM `recruit` WHERE `villageid`='".$row['id']."' AND `building`='garage' ORDER BY `id` DESC LIMIT 1");
		$r = $db->fetch($res);
		if (!empty($r['unit'])) {
			$villages[$row['id']]['garage_prod']['unit'] = $cl_units->get_name($r['unit']);
			$villages[$row['id']]['garage_prod']['time'] = format_date($r['time_finished']);
		}
	}
	$tpl->assign("villages", $villages);
	$tpl->assign("unit", $unit);
}
if($user['villages_mode'] == "units"){
	$unit = $cl_units->get_array("name");
	$sql = "";
	$i = 0;
	foreach($unit as $key=>$value){
		++$i;
		if(count($unit) == $i){
            $sql .= "all_".$key;
			continue;
		}else{
			$sql .= "all_".$key.",";
		}
	}
	$result = $db->query("SELECT `id`,`attacks`,`farm`,`main`,`garage`,`stable`,`barracks`,`smith`,`market`,`trader_away`,`farm`,`r_bh`,`name`,`x`,`y`,`continent`,".$sql." FROM `villages` WHERE `userid`='".$user['id']."' ORDER BY `name`,`id`");
	while($row = $db->fetch($result)){
		$villages[$row['id']]['name'] = entparse($row['name']);
		$villages[$row['id']]['x'] = $row['x'];
		$villages[$row['id']]['y'] = $row['y'];
		$villages[$row['id']]['continent'] = $row['continent'];
		$villages[$row['id']]['attacks'] = $row['attacks'];
		foreach($unit as $key=>$value){
			$all_units[$row['id']][$key] = 0;
		}
		foreach($unit as $key=>$value){
			$own_units[$row['id']][$key] = 0;
		}
		$sql = "SELECT `villages_from_id`,`villages_to_id`,";
		$i = 0;
		foreach($unit as $key=>$value){
			++$i;
			if(count($unit) == $i){
				$sql .= $key;
				continue;
			}else{
				$sql .= $key.",";
			}
		}
		$sql .= " FROM `unit_place` WHERE `villages_to_id`='".$row['id']."'";
		$result2 = $db->query($sql);
		while($units = $db->fetch($result2)){
			foreach($unit as $key=>$value){
				$all_units[$row['id']][$key] += $units[$key];
			}
			if($units['villages_from_id'] == $units['villages_to_id']){
				foreach($unit as $key=>$value){
					$own_units[$row['id']][$key] += $units[$key];
				}
			}
		}
		foreach($unit as $key=>$value){
			$villages[$row['id']]['outward'][$key] = $row["all_".$key]-$own_units[$row['id']][$key];
		}
		if($row['id'] == $_GET['village']){ $villages[$row['id']]['lit'] = 'lit '; }
	}
	$tpl->assign("own_units", $own_units);
	$tpl->assign("villages", $villages);
	$tpl->assign("all_units", $all_units);
	$tpl->assign("unit", $unit);
}
if($user['villages_mode'] == "commands"){
	$my_movements = array();
	$saved_villageNames = array();
	$i = 0;
    $result = $db->query("SELECT `id`,`from_village`,`to_village`,`type`,`start_time`,`end_time`,`die`,`send_from_village`,`units` FROM `movements` WHERE `send_from_user`='".$user['id']."' ORDER BY `end_time`");
	while($row = $db->fetch($result)){
		$my_movements[$i]['id'] = $row['id'];
		$my_movements[$i]['units'] = explode(";",$row['units']);
		$my_movements[$i]['to_village'] = $row['to_village'];
		$my_movements[$i]['type'] = $row['type'];
		$my_movements[$i]['start_time'] = $row['start_time'];
		$my_movements[$i]['end_time'] = $row['end_time'];
		$my_movements[$i]['arrival_in'] = $row['end_time'] - time();
		$my_movements[$i]['can_cancel'] = (($row['start_time']+$cancel_time)>=time() && ($row['type']=="attack" || $row['type']=="support") && $row['die']!=1)?true:false;
		if(!array_key_exists($row['to_village'], $saved_villageNames)){
			if($row['type'] != "return"){
				$result2 = $db->query("SELECT `name` FROM `villages` WHERE `id`='".$row['to_village']."'");
			}else{
				$result2 = $db->query("SELECT `name` FROM `villages` WHERE `id`='".$row['from_village']."'");
			}
			$villagedata = $db->fetch($result2);
			$my_movements[$i]['to_villagename'] = entparse($villagedata['name']);
			$saved_villageNames[$row['to_village']] = $villagedata['name'];
		}else{
		    $my_movements[$i]['to_villagename'] = entparse($saved_villageNames[$row['to_village']]);
		}
		if(!array_key_exists($row['from_village'], $saved_villageNames)){
			if($row['type'] != "return"){
				$result2 = $db->query("SELECT `name` FROM `villages` WHERE `id`='".$row['to_village']."'");
				$my_movements[$i]['homevillageid'] = $row['from_village'];
			}else{
				$result2 = $db->query("SELECT `name` FROM `villages` WHERE `id`='".$row['from_village']."'");
				$my_movements[$i]['homevillageid'] = $row['to_village'];
			}
			$villagedata = $db->fetch($result2);
			$my_movements[$i]['homevillagename'] = entparse($villagedata['name']);
			$saved_villageNames[$row['to_village']] = $villagedata['name'];
		}else{
		    $my_movements[$i]['homevillagename'] = entparse($saved_villageNames[$row['to_village']]);
		}
		$my_movements[$i]['message'] = get_movement_message($row['type'],$my_movements[$i]['to_villagename'],'own');
		$i++;
	}
	$tpl->assign('my_movements',$my_movements);
	$tpl->assign('cl_units',$cl_units);
}
if($user['villages_mode'] == "incomings"){
	$other_movements = array();
	$saved_villageNames = array();
	$saved_userNames = array();
	$i = 0;
	$result = $db->query("SELECT `id`,`from_village`,`type`,`start_time`,`end_time`,`to_village`,`send_from_user` FROM `movements` WHERE `send_to_user`='".$user['id']."' AND `to_hidden`='0' ORDER BY `end_time`");
	while($row = $db->fetch($result)){
		$other_movements[$i]['id'] = $row['id'];
		$other_movements[$i]['to_village'] = $row['to_village'];
		$other_movements[$i]['type'] = $row['type'];
		$other_movements[$i]['start_time'] = $row['start_time'];
		$other_movements[$i]['end_time'] = $row['end_time'];
		$other_movements[$i]['send_from_user'] = $row['send_from_user'];
		$other_movements[$i]['arrival_in'] = $row['end_time']-time();
		if(!array_key_exists($row['to_village'], $saved_villageNames)){
			$result2 = $db->query("SELECT `name` FROM `villages` WHERE `id`='".$row['to_village']."'");
			$villagedata = $db->fetch($result2);
			$other_movements[$i]['to_villagename'] = entparse($villagedata['name']);
			$saved_villageNames[$row['to_village']] = $villagedata['name'];
		}else{
		    $other_movements[$i]['to_villagename'] = entparse($saved_villageNames[$row['to_village']]);
		}
		if(!array_key_exists($row['send_from_user'], $saved_userNames)){
			$result2 = $db->query("SELECT `username` FROM `users` WHERE `id`='".$row['send_from_user']."'");
			$villagedata = $db->fetch($result2);
			$other_movements[$i]['send_from_username'] = entparse($villagedata['username']);
			$saved_villageNames[$row['from_username']] = $villagedata['username'];
		}else{
		    $other_movements[$i]['send_from_username'] = entparse($saved_villageNames[$row['send_from_user']]);
		}
		$other_movements[$i]['message'] = get_movement_message_only_type($row['type']);
		$i++;
	}
	$tpl->assign('other_movements',$other_movements);
}
$tpl->assign("mode", $user['villages_mode']);
$tpl->assign("links", $links);
?>