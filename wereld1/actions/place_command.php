<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}

if(isset($_GET['reportid'])){
	$result = $db->query("SELECT `a_units`,`b_units`,`c_units`,`d_units`,`receiver_userid`,`see_def_units`,`to_village` FROM `reports` WHERE `id`='".parse($_GET['reportid'])."'");
	$report = $db->fetch($result);
	if($user['id'] != @$report['receiver_userid'])
		exit("Desculpe, más a ação não pode ser executada!");
	$sql = $db->query("SELECT `x`,`y` FROM `villages` WHERE `id`='".$report['to_village']."' LIMIT 1");
	$row = $db->fetch($sql);
	$_POST['x'] = $row['x'];
	$_POST['y'] = $row['y'];
	$report_units['units_a'] = explode(";", $report['a_units']);
	$report_units['units_b'] = explode(";", $report['b_units']);
	$count = 0;
	foreach($cl_units->get_array('dbname') as $name=>$dbname){
		if($report_units['units_a'][$count] == 0)
			$report_units['units_a'][$count] = '';
		$_POST[$dbname] = ($report_units['units_a'][$count]);
		$count++;
	}
	$_GET['try'] = 'confirm';
	$_POST['attack'] = true;
}
if(isset($_GET['units']) && $_GET['units'] == 'all' && isset($_GET['coords'])){
	$ex_koords = explode('|',$_GET['coords']);
	$_POST['x'] = $ex_koords[0];
	$_POST['y'] = $ex_koords[1];
	$all_units = $cl_units->get_array('dbname');
	$sql = "SELECT * FROM `unit_place` WHERE `villages_from_id`='".$village['id']."' AND `villages_to_id`='".$village['id']."'";
	$res = $db->query($sql);
	$units_village = $db->fetch($res);
	foreach($all_units as $dbname){
		$_POST[$dbname] = $units_village[$dbname];
	}
	$_GET['try'] = 'confirm';
	$_POST['attack'] = true;
}

foreach($cl_units->get_array("dbname") as $id=>$dbname){
	$group_units[$cl_units->get_col($dbname)][] = $dbname;
}

$units = $cl_units->read_units($village['id'],$village['id']);
$values = array();
if(isset($_GET['target'])){
	$result = $db->query("SELECT `x`,`y` FROM `villages` WHERE `id`='".parse(@$_GET['target'])."'");
	$values = $db->fetch($result);
}
if(isset($_POST['x'])){
	$values['x'] = (int)$_POST['x'];
}
if(isset($_POST['y'])){
	$values['y'] = (int)$_POST['y'];
}
if(isset($_GET['try']) && $_GET['try'] == "confirm"){
    $error = "";
    $enougth_units = true;
    $units_choosed = false;
	foreach($cl_units->get_array("dbname") as $dbname){
		if(!empty($_POST[$dbname])){
			$values[$dbname] = (int)$_POST[$dbname];
		}
		if($_POST[$dbname] < 1){
		    $send_units[$dbname] = 0;
		}else{
			$send_units[$dbname] = (int)$_POST[$dbname];
			$units_choosed = true;
		}
		if($units[$dbname] < $_POST[$dbname]){
			$enougth_units = false;
		}
	}
	if(empty($error) && !$units_choosed){
        $error = "Desculpe, más você não selecionou nenhuma unidade!";
    }
    if(empty($error) && !$enougth_units){
        $error = "Desculpe, más você não tem unidades suficientes!";
	}
	if(empty($error) && (empty($_POST['x']) || empty($_POST['y']))){
        $error = "Desculpe, más você deve insirir as cordenadas!";
    }
	if(empty($error) && $_POST['x'] == $village['x'] && $_POST['y'] == $village['y']){
        $error = "Desculpe, más você não pode atacar sua própria aldeia!";
    }
	$result = $db->query("SELECT COUNT(`id`) AS `count`,`userid` FROM `villages` WHERE `x`='".parse($_POST['x'])."' AND `y`='".parse($_POST['y'])."' GROUP BY `userid`");
    $village_exist = $db->fetch($result);
	$v_user = $db->fetch($db->query("SELECT `protection` FROM `users` WHERE `id`='".$village_exist['userid']."'"));

	if(empty($error) && $village_exist['count'] == 0){
		$error = "Desculpe, más não localizamos nenhuma aldeia nestas coordenadas!";
    }
	if(empty($error) && !(isset($_POST['attack']) || isset($_POST['support']))){
        $error = "Desculpe, más a ação não pode ser executada!";
    }else{
	    if(isset($_POST['attack'])){
        	$type = "attack";
	    }else{
    	    $type = "support";
	    }
	}
	if($type == "attack" && $v_user['protection'] > time() && $village_exist['userid'] != '-1'){
		$error = "Este jogador está sob proteção de iniciantes. Você poderá ataca-lo apartir de ".format_date($v_user['protection']).".";
	}
	if(empty($error)){
		$result = $db->query("SELECT `id`,`name`,`continent`,`userid` FROM `villages` WHERE `x`='".parse($_POST['x'])."' AND `y`='".parse($_POST['y'])."'");
		$info_village = $db->fetch($result);
		$info_village['name'] = entparse($info_village['name']);
		$info_village['continent'] = $info_village['continent'];

		if($info_village['userid'] != '-1'){
			$result = $db->query("SELECT `username` FROM `users` WHERE `id`='".$info_village['userid']."'");
			$info_user = $db->fetch($result);
			$info_user['username'] = entparse($info_user['username']);
		}else{
			$info_user = array();	
		}
		$unit_runtime = unit_running($village['x'], $village['y'], $_POST['x'], $_POST['y'], $cl_units->get_lowest_unit($send_units));
		$arrival = time()+$unit_runtime;

		$_GET['screen'] = "place_confirm";

		$tpl->assign("type",$type);
		$tpl->assign("info_village",$info_village);
		$tpl->assign("unit_runtime",$unit_runtime);
		$tpl->assign("info_user",$info_user);
		$tpl->assign("arrival",$arrival);
		$tpl->assign("send_units",$send_units);
		$tpl->assign("cl_builds",$cl_builds);
	}
}
if(isset($_GET['action']) && $_GET['action'] == "command"){
    $error = "";

    $c = new do_action($user['id']);
    $c->close();

    if(empty($error) && $session['hkey'] != $_GET['h']){
        $error = "Desculpe, más o código de segurança está invalido!";
    }

    $enougth_units = true;
    $units_choosed = false;
	foreach($cl_units->get_array("dbname") as $dbname){
		if(!empty($_POST[$dbname])){
			$values[$dbname] = (int)$_POST[$dbname];
		}
		if($_POST[$dbname] < 1){
		    $send_units[$dbname] = 0;
		}else{
			$send_units[$dbname] = (int)$_POST[$dbname];
			$units_choosed = true;
		}
		if($units[$dbname] < $_POST[$dbname]){
			$enougth_units = false;
		}
	}
	if(empty($error) && !$units_choosed){
        $error = "Desculpe, más você não selecionou nenhuma unidade!";
    }
    if(empty($error) && !$enougth_units){
        $error = "Desculpe, más você não tem unidades suficientes!";
	}
	if(empty($error) && (empty($_POST['x']) || empty($_POST['y']))){
        $error = "Desculpe, más você deve insirir as cordenadas!";
    }
	if(empty($error) && $_POST['x'] == $village['x'] && $_POST['y'] == $village['y']){
        $error = "Desculpe, más você não pode atacar sua própria aldeia!";
    }

	$result = $db->query("SELECT COUNT(`id`) AS `count`,`userid`,`id` FROM `villages` WHERE `x`='".parse($_POST['x'])."' AND `y`='".parse($_POST['y'])."' GROUP BY `userid`");
    $village_exist = $db->fetch($result);
	$v_user = $db->fetch($db->query("SELECT `protection` FROM `users` WHERE `id`='".$village_exist['userid']."'"));

	if(empty($error) && $village_exist['count'] == 0){
		$error = "Desculpe, más não localizamos nenhuma aldeia nestas coordenadas!";
    }else{
        $to_village_id = $village_exist['id'];
        $to_user_id = $village_exist['userid'];
    }
	if(empty($error) && !(isset($_POST['attack']) || isset($_POST['support']))){
        $error = "Desculpe, más a ação não pode ser executada!";
    }else{
	    if(isset($_POST['attack'])){
        	$type = "attack";
	    }else{
    	    $type = "support";
	    }
	}
	if($type == "attack" && $v_user['protection'] > time() && $village_exist['userid'] != '-1'){
		$error = "Este jogador está sob proteção de iniciantes. Você poderá ataca-lo apartir de ".format_date($v_user['protection']).".";
	}
    if($send_units['unit_catapult'] > 0 && $type == "attack"){
		if(!(in_array($_POST['building'], $cl_builds->get_array("dbname")) && (!in_array("catapult_protection", $cl_builds->get_specials($_POST['building']))))){
        	$error = "Catapulta: Desculpe, más o alvo escolhido não está disponivel!";
        }
    }
	if(empty($error)){
		$start_time = time();
		$end_time = $start_time + unit_running($village['x'], $village['y'], $_POST['x'], $_POST['y'], $cl_units->get_lowest_unit($send_units));
        $send_units_implode = implode(";", $send_units);

        $type = $_POST['attack'] ? "attack" : "support";
        $cata_building = parse(@$_POST['building']);
        add_movement($village['userid'],$village['id'],$to_user_id,$to_village_id,$send_units_implode,$type,$start_time,$end_time,false,$cata_building);

        $sql = "";
        $sql = "UPDATE `unit_place` SET ";
        $is_first=true;
        foreach($cl_units->get_array("dbname") as $dbname){
        	if($is_first){
        		$sql .= $dbname."=".$dbname."-'".$send_units[$dbname]."'";
        		$is_first = false;
        	}else{
				$sql .= ",".$dbname."=".$dbname."-'".$send_units[$dbname]."'";
        	}
        }
        $sql .= " WHERE `villages_from_id`='".$village['id']."' AND `villages_to_id`='".$village['id']."'";
        $db->query($sql);
		if($type == "attack"){
			$db->query("UPDATE `medal` SET `wars`=`wars`+'1' WHERE `userid`='".$user['id']."'");
		}elseif($type == "support"){
			$db->query("UPDATE `medal` SET `refors`=`refors`+'1' WHERE `userid`='".$user['id']."'");
		}

        $c->open();
        header("LOCATION: game.php?village=".$village['id']."&screen=place");
        exit;
    }
    $c->open();
    unset($values);
    $values = array();
}
if(isset($_GET['action']) && $_GET['action'] == "cancel"){
	if($session['hkey'] != $_GET['h']){
		$error = "Desculpe, más o código de segurança está invalido!";
	}

	$result = $db->query("SELECT `type`,`from_village`,`to_village`,`from_userid`,`to_userid`,`die`,`start_time`,`type`,`send_from_user`,`die` FROM `movements` WHERE `id`='".parse($_GET['id'])."'");
	$mov = $db->fetch($result);
	if(!empty($mov['start_time'])){
		$b_error = false;
		if(empty($error) && $mov['send_from_user'] != $village['userid']){
			$error = "Desculpe, más houve um erro ao cancelar o comando!";
		}
		if(empty($error) && $mov['die'] == 1){
			$error = "Desculpe, más não é possivel cancelar o comando!";
		}
		if(empty($error) && ($mov['type'] != 'attack' && $mov['type'] != 'support')){
			$b_error = true;
		}
		$cancel_sec = $config['cancel_movement']*60;
		if(!(($mov['start_time']+$cancel_sec) >= time())){
			$b_error = true;
		}
		if(empty($error) || $b_error){
			$key = generate_key();
			$db->query("UPDATE `events` SET `cid`='".$key."' WHERE `event_type`='movement' AND `event_id`='".parse($_GET['id'])."' AND `cid`='0'");
			$time = time();
			$start_time = $time;
			$end_time = $time+($time-$mov['start_time']);
			$db->query("UPDATE `movements` SET `start_time`='".$start_time."',`end_time`='".$end_time."',`to_userid`='".$mov['from_userid']."',`from_userid`='".$mov['to_userid']."',`type`='cancel',`to_hidden`='1' WHERE `id`='".parse($_GET['id'])."'");
			$db->query("UPDATE `events` SET `event_time`='".$end_time."',`cid`='0' WHERE `event_type`='movement' AND `event_id`='".parse($_GET['id'])."'");

			if($mov['type'] == 'attack'){
				$db->query("UPDATE `users` SET `attacks`=`attacks`-'1' WHERE `id`='".$mov['to_userid']."'");
				$db->query("UPDATE `villages` SET `attacks`=`attacks`-'1' WHERE `id`='".$mov['to_village']."'");
				$db->query("UPDATE `medal` SET `wars`=`wars`-'1' WHERE `userid`='".$user['id']."'");
			}elseif($mov['type'] == "support"){
				$db->query("UPDATE `medal` SET `refors`=`refors`-'1' WHERE `userid`='".$user['id']."'");
			}
			$d->open();
			header("LOCATION: game.php?village=".$_GET['village']."&screen=place");
		}
	}else{
	    $error = "Desculpe, más o comando não existe mais!";
	}
}

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

if(!isset($error)) $error = "";

$tpl->assign("group_units",$group_units);
$tpl->assign("error",$error);
$tpl->assign("my_movements",$my_movements);
$tpl->assign("other_movements",$other_movements);
$tpl->assign("units",$units);
$tpl->assign("values",$values);
?>