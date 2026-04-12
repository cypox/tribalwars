<?php
if(isset($_GET['done'])){
	$is_send = true;
}else{
	$is_send = false;
}

if(empty($_POST['start'])){
	$result = $db->query("SELECT `login_locked`,`start` FROM `login`");
	$row_login = $db->fetch($result);
	$start = $row_login['start'];
}else{
	$start = $_POST['start'];
}

if(empty($_POST['end'])){
	$end = date("j.n.Y H:i");
}else{
	$end = $_POST['end'];
}

if(empty($_POST['description'])){
	$description = "";
}else{
	$description = $_POST['description'];
}

if(empty($_POST['name'])){
	$name = "USDS";
}else{
	$name = $_POST['name'];
}

if(isset($_GET['action']) && $_GET['action'] == 'send'){
	if($config['moral_activ']){
		$moral = "1";
	}else{
		$moral = "0";
	}
	$db->query("INSERT INTO `save_rounds` (`name`,`start`,`end`,`description`,`speed_units`,`moral`,`speed`,`map`) VALUES ('".parse($name)."','".parse($_POST['start'])."','".parse($_POST['end'])."','".parse($_POST['description'])."','".parse($config['movement_speed'])."','".$moral."','".parse($config['speed'])."','".$config['map_design']."')");
	$id = $db->getlastid();

	$allys = array();
	$result = $db->query("SELECT `username`,`ally`,`rang`,`points`,`villages` FROM `users` ORDER BY `rang` LIMIT 50");
	while($row = $db->fetch($result)){
		if($row['ally'] != '-1'){
			if(!array_key_exists($row['ally'],$allys)){
				$res = $db->query("SELECT `short` FROM `ally` WHERE `id`='".$row['ally']."'");
				$r = $db->fetch($res);

				$allys[$row['ally']] = entparse($r['short']);
				$ally = $r['short'];
			}else{
				$ally = $allys[$row['ally']];
			}
		}else{
			$ally = "";
		}
		$db->query("INSERT INTO `save_players` (`round_id`,`username`,`rank`,`points`,`ally`,`villages`) VALUES ('".$id."','".$row['username']."','".$row['rang']."','".$row['points']."','".$ally."','".$row['villages']."')");
	}
	header("LOCATION: index.php?screen=save_round&done");
}

$tpl->assign("start",$start);
$tpl->assign("name",$name);
$tpl->assign("end",$end);
$tpl->assign("description",$description);
$tpl->assign("is_send",$is_send);
$tpl->assign("error",@$error);
?>