<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}
$result = $db->query("SELECT `to_hidden`,`wood`,`stone`,`iron`,`from_village`,`to_village`,`units`,`to_userid`,`from_userid`,`type`,`start_time`,`end_time`,`die`,`send_from_user`,`send_to_user`,`send_from_village`,`send_to_village` FROM `movements` WHERE `id`=".parse($_GET['id'])."");
$row = $db->fetch($result);
if(empty($error) && empty($row['type'])){
	$error = "Desculpe, más não encontramos o comando desejado!";
}
if(empty($error) && ($row['send_from_user'] != $village['userid'] && $row['send_to_user'] != $village['userid'] && $row['send_from_village'] != $village['id'])){
	$error = "Desclpe, más você não tem permissão para ver este comando!";
}
if(empty($error) && isset($_GET['type']) && $_GET['type'] == "own" && ($row['send_from_user'] == $village['userid'])){
    $type = "own";
}else{
	if(empty($error) && ($row['send_from_village'] == $village['id'])){
		$type = 'other';
	}
}
if(empty($error) && isset($_GET['type']) && $_GET['type'] == "other" && ($row['send_to_user'] == $village['userid'] && $row['to_hidden'] != "1")){
	$type = "other";
}
if(empty($_GET['type']) || ($_GET['type'] != 'own' && $_GET['type'] != 'other')){
	$error = "Desculpe, más não foi possivel acessar o comando!";
}
if(empty($type)){
	$error = "Desculpe, más não encontramos o comando desejado!";
}
if(empty($error)){
	if($type == "own"){
		$result = $db->query("SELECT `name`,`x`,`y`,`continent` FROM `villages` where id='".$row['send_to_village']."'");
		$v_row = $db->fetch($result);
        $mov['to_villagename'] = entparse($v_row['name']);
		$mov['to_x'] = $v_row['x'];
		$mov['to_y'] = $v_row['y'];
		$mov['to_continent'] = $v_row['continent'];
		$mov['to_village'] = $row['send_to_village'];
		$result = $db->query("SELECT `username` FROM `users` WHERE `id`='".$row['send_to_user']."'");
		$v_row = $db->fetch($result);
		$mov['to_username'] = entparse($v_row['username']);
		$mov['to_userid'] = $row['send_to_user'];

		$result = $db->query("SELECT `name`,`x`,`y`,`id`,`continent` FROM `villages` WHERE `id`='".$row['send_from_village']."'");
		$v_row = $db->fetch($result);
		$mov['from_villagename'] = entparse($v_row['name']);
		$mov['from_x'] = $v_row['x'];
		$mov['from_y'] = $v_row['y'];
		$mov['from_continent'] = $v_row['continent'];
		$mov['from_village'] = $row['send_from_village'];
		$mov['units'] = explode(";", $row['units']);
		$mov['wood'] = $row['wood'];
		$mov['stone'] = $row['stone'];
		$mov['iron'] = $row['iron'];
		$mov['message'] = get_movement_message($row['type'], $mov['to_villagename']." (".$mov['to_x']."|".$mov['to_y'].") K".$mov['to_continent'], $type);
	}else{
		$result = $db->query("SELECT `name`,`x`,`y`,`continent` FROM `villages` WHERE `id`='".$row['send_from_village']."'");
		$v_row = $db->fetch($result);
		$mov['from_villagename'] = entparse($v_row['name']);
		$mov['from_x'] = $v_row['x'];
		$mov['from_y'] = $v_row['y'];
		$mov['from_continent'] = $v_row['continent'];
		$mov['from_village'] = $row['send_from_village'];

		$result = $db->query("SELECT `username` FROM `users` WHERE `id`='".$row['send_from_user']."'");
		$v_row = $db->fetch($result);
		$mov['from_username'] = entparse($v_row['username']);
		$mov['from_userid'] = $row['send_to_user'];
		$mov['message'] = $row['type'] == "attack" ? "Ataque" : "Apoio";
	}
	$mov['duration'] = format_time($row['end_time']-$row['start_time']);
    $mov['arrival'] = format_date($row['end_time']);
    $mov['arrival_in'] = format_time($row['end_time']-time());
	$mov['cancel'] = (($row['start_time']+($config['cancel_movement']*60))>=time() && ($row['type'] == "attack" || $row['type'] == "support") && $row['die'] != 1) ? true : false;
	$mov['id'] = $_GET['id'];
	$tpl->assign("mov", $mov);
	$tpl->assign("type", $type);
	$tpl->assign("cl_units", $cl_units);
}
$tpl->assign("error", $error);
?>