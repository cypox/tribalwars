<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}
if(isset($_GET['action']) && $_GET['action'] == "send"){
	$error = "";
	$c = new do_action($user['id']);
	$c->close();
	if($session['hkey'] != $_GET['h']){
		$error = "Desculpe, más o código de segurança está invalido!";
	}
	if(empty($error) && ((int)$_POST['wood']) > $village['r_wood'] || ((int)$_POST['stone']) > $village['r_stone'] || ((int)$_POST['iron']) > $village['r_iron']){
		$error = "Desculpe, más você não tem recursos suficientes!";
	}
	if(empty($error) && (int)$_POST['wood'] < 1 && (int)$_POST['stone'] < 1 && (int)$_POST['iron'] < 1){
		$error = "Desculpe, más a quantidade deve ser maior que 0 unidades!";
    }
    $dealers = ceil(((int)$_POST['wood']+(int)$_POST['stone']+(int)$_POST['iron'])/1000);
	if(empty($error) && $inside_dealers < $dealers){
		$error = "Desculpe, más você não tem ".$dealers." mercadores necessários para o envio!";
	}
	if(empty($error) && $village['id'] == @$_POST['target_id']){
		$error = "Desculpe, más você indicou uma aldeia inválida!";
	}
	$result = $db->query("SELECT COUNT(`id`) AS `count`,`userid`,`x`,`y` FROM `villages` WHERE `id`='".parse(@$_POST['target_id'])."' GROUP BY `userid`,`x`,`y`");
	$row = $db->fetch($result);
	if(empty($error) && $row['count'] < 1){
		$error = "Desculpe, más você indicou uma aldeia inválida!";
    }
	if(empty($error)){
        send_dealers($village['id'],$village['userid'],$_POST['target_id'],$row['userid'],$village['x'],$village['y'],$row['x'],$row['y'],(int)$_POST['wood'],(int)$_POST['stone'],(int)$_POST['iron'],0);
		$c->open();
		header("LOCATION: game.php?village=".$village['id']."&screen=market");
	}
    $c->open();
}
if(isset($_GET['action']) && $_GET['action'] == "cancel"){
	if($session['hkey'] != $_GET['h']){
		$error = "Desculpe, más o código de segurança está invalido!";
	}
	$err = false;
	$result = $db->query("SELECT `type`,`from_village`,`is_offer`,`start_time`,COUNT(`id`) AS `count` FROM `dealers` WHERE `id`='".parse(@$_GET['id'])." GROUP BY `type`,`from_userid`,`is_offer`,`start_time`");
	$row = $db->fetch($result);
	if(empty($error) && $row['count'] == 0){
		$err = true;
	}
	if(empty($error) && $row['from_village'] != $village['id']){
		$err = true;
	}
	$cancel_time = $config['cancel_dealers']*60;
	if(empty($error) && !$err && !(($row['start_time']+$cancel_time) >= time() && $row['type'] != 'back' && $row['is_offer'] != 1)){
		$error = "Desculpe, más não é possivel cancelar o movimento!";
	}
	if(empty($error) && !$err){
		$start_time = time();
		$end_time = $start_time+($start_time - $row['start_time']);
		$db->query("UPDATE `dealers` SET `start_time`='".$start_time."',`end_time`='".$end_time."',`type`='back' WHERE `id`='".parse($_GET['id'])."'");
		$db->query("UPDATE `events` SET `event_time`='".$end_time."' WHERE `event_id`='".parse($_GET['id'])."' AND `event_type`='dealers'");
		header("game.php?village=".$village['id']."&screen=market");
	}
}
if(isset($_GET['try']) || $_GET['try'] == "confirm_send"){
	$error = "";
	if(empty($error) && ((int)$_POST['wood']) > $village['r_wood'] || ((int)$_POST['stone']) > $village['r_stone'] || ((int)$_POST['iron']) > $village['r_iron']){
		$error = "Desculpe, más você não tem recursos suficientes!";
	}
	if(empty($error) && (int)$_POST['wood'] < 1 && (int)$_POST['stone'] < 1 && (int)$_POST['iron'] < 1){
		$error = "Desculpe, más a quantidade deve ser maior que 0 unidades!";
	}
	$dealers = ceil(((int)$_POST['wood']+(int)$_POST['stone']+(int)$_POST['iron'])/1000);
	if(empty($error) && $inside_dealers < $dealers){
		$error = "Desculpe, más você não tem ".$dealers." mercadores necessários para o envio!";
	}
	if(empty($error) && $village['x'] == $_POST['x'] && $village['y'] == $_POST['y']){
        $error = "Desculpe, más você indicou uma aldeia inválida!";
	}
	$result = $db->query("SELECT COUNT(`id`) AS `count`,`id` FROM `villages` WHERE `x`='".parse($_POST['x'])."' AND `y`='".parse($_POST['y'])."' GROUP BY `id`");
	$row = $db->fetch($result);
	if(empty($error) && $row['count'] < 1){
		$error = "Desculpe, más você indicou uma aldeia inválida!";
	}
	if(empty($error)){
		$result = $db->query("SELECT `name`,`x`,`y`,`continent`,`userid` FROM `villages` WHERE `id`='".$row['id']."'");
		$arr = $db->fetch($result);
		$confirm['to_villagename'] = entparse($arr['name']);
		$confirm['to_x'] = $arr['x'];
		$confirm['to_y'] = $arr['y'];
		$confirm['to_continent'] = $arr['continent'];
		$confirm['to_userid'] = $arr['userid'];
		$confirm['to_villageid'] = $row['id'];

		$confirm['wood'] = (int)$_POST['wood'];
		$confirm['stone'] = (int)$_POST['stone'];
		$confirm['iron'] = (int)$_POST['iron'];

		$confirm['dealers'] = $dealers;

		$confirm['dealer_running'] = format_time(unit_running($village['x'],$village['y'],$confirm['to_x'],$confirm['to_y'],($config['dealer_time']*60)));

		$time = time();
		$confirm['time_to'] = format_date($time+$confirm['dealer_running']);

		$confirm['time_back'] = format_date($time+$confirm['dealer_running']+$confirm['dealer_running']);

		$result = $db->query("SELECT `username` FROM `users` WHERE `id`='".$confirm['to_userid']."'");
		$arr = $db->fetch($result);
		$confirm['to_username'] = entparse($arr['username']);		
		
		$_GET['screen'] = "market_confirm_send";
		$tpl->assign("confirm", $confirm);
	}
}
$villages = array();
$i = 0;
$result = $db->query("SELECT `id`,`name`,`x`,`y`,`continent` FROM `villages` WHERE `userid`='".$user['id']."' ORDER BY `name`");
while ($row = $db->fetch($result)){
	if($village['id']!=$row['id']){
		$villages[$i]['name'] = entparse($row['name']);
		$villages[$i]['x'] = entparse($row['x']);
		$villages[$i]['y'] = entparse($row['y']);
		$villages[$i]['continent'] = entparse($row['continent']);
		$i++;
	}
}
if(isset($_GET['target'])){
	$result = $db->query("SELECT `x`,`y` FROM `villages` WHERE `id`='".parse($_GET['target'])."'");
	$row = $db->fetch($result);
}
$coords = array();
if(isset($row['x'])){
	$coords['x'] = $row['x'];
}
if(isset($row['y'])){
	$coords['y'] = $row['y'];
}
if(isset($_POST['x'])){
	$coords['x'] = $_POST['x'];
}
if(isset($_POST['y'])){
	$coords['y'] = $_POST['y'];
}

$max['wood'] = ($village['r_wood']>($inside_dealers*1000))?$inside_dealers*1000:$village['r_wood'];
$max['stone'] = ($village['r_stone']>($inside_dealers*1000))?$inside_dealers*1000:$village['r_stone'];
$max['iron'] = ($village['r_iron']>($inside_dealers*1000))?$inside_dealers*1000:$village['r_iron'];

$own = array();
$time = time();
$villagenames = array();
$cancel_time = $config['cancel_dealers']*60;
$result = $db->query("SELECT `type`,`id`,`to_village`,`wood`,`stone`,`iron`,`start_time`,`end_time`,`dealers`,`is_offer` FROM `dealers` WHERE `from_village`='".$village['id']."'");
while($row = $db->fetch($result)){
	$own[$row['id']]['villageid'] = $row['to_village'];
	$own[$row['id']]['type'] = $row['type'];
	$own[$row['id']]['wood'] = $row['wood'];
	$own[$row['id']]['stone'] = $row['stone'];
	$own[$row['id']]['iron'] = $row['iron'];
	$own[$row['id']]['dealers'] = $row['dealers'];
	$own[$row['id']]['duration'] = format_time($row['end_time']-$row['start_time']);
	$own[$row['id']]['arrival'] = format_date($row['end_time']);
	$own[$row['id']]['arrival_in_sek'] = $row['end_time'] - $time;
	$own[$row['id']]['arrival_in'] = format_time($row['end_time'] - $time);
	$own[$row['id']]['can_cancel'] = (($row['start_time']+$cancel_time)>=$time && $row['type']!='back' && $row['is_offer']!=1)?true:false;
	if(!array_key_exists($row['to_village'], $villagenames)){
		$res = $db->query("SELECT `name`,`x`,`y`,`continent` FROM `villages` WHERE `id`='".$row['to_village']."'");
		$villrow = $db->fetch($res);
		$villagenames[$row['to_village']] = entparse($villrow['name'])." (".$villrow['x']."|".$villrow['y'].") K".$villrow['continent'];
	}
	$own[$row['id']]['villagename'] = $villagenames[$row['to_village']];
}

$others = array();
$others_see_ress = false;
$result = $db->query("SELECT `type`,`id`,`from_userid`,`to_userid`,`from_village`,`wood`,`stone`,`iron`,`start_time`,`end_time`,`dealers`,`is_offer` FROM `dealers` WHERE `to_village`='".$village['id']."' AND `type`='to'");
while($row = $db->fetch($result)){
	$others[$row['id']]['villageid'] = $row['from_village'];
	$others[$row['id']]['wood'] = $row['wood'];
	$others[$row['id']]['stone'] = $row['stone'];
	$others[$row['id']]['iron'] = $row['iron'];
	$others[$row['id']]['duration'] = format_time($row['end_time']-$row['start_time']);
	$others[$row['id']]['arrival'] = format_date($row['end_time']);
	$others[$row['id']]['arrival_in_sek'] = $row['end_time'] - $time;
	$others[$row['id']]['arrival_in'] = format_time($row['end_time'] - $time);
	if($row['from_userid'] == $row['to_userid'] || $row['is_offer'] == 1){
		$others[$row['id']]['see_ress'] = true;
		$others_see_ress = true;
	}else{
		$others[$row['id']]['see_ress'] = false;
	}
	if(!array_key_exists($row['from_village'], $villagenames)){
		$res = $db->query("SELECT `name`,`x`,`y`,`continent` FROM `villages` WHERE `id`='".$row['from_village']."'");
		$villrow = $db->fetch($res);
		$villagenames[$row['from_village']] = entparse($villrow['name'])." (".$villrow['x']."|".$villrow['y'].") K".$villrow['continent'];
	}
	$others[$row['id']]['villagename'] = $villagenames[$row['from_village']];
}

$tpl->assign("others_see_ress", $others_see_ress);
$tpl->assign("own", $own);
$tpl->assign("others", $others);
$tpl->assign("villages", $villages);
$tpl->assign("coords", $coords);
$tpl->assign("error", @$error);
$tpl->assign("max", $max);
?>