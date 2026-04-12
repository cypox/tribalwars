<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD!='sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL'){
	exit;
}

$usersql = array("id","username","points","rang","killed_units_altogether","killed_units_altogether_rank","ally","b_day","b_month","b_year","sex","home","image","personal_text");
$info_user = $userdatas->getbyid(parse($_GET['id']), $usersql, true);
if($info_user['exist_user'] != 1)
	exit("Desculpe, más este jogador não existe!");
$info_user['username'] = entparse(@$info_user['username']);

$result = $db->query("SELECT `short`,`id` FROM `ally` WHERE `id`='".@$info_user['ally']."'");
$info_ally = $db->fetch($result);
$info_ally['short'] = entparse($info_ally['short']);

$check = $db->numrows($db->query("SELECT * FROM `friends` WHERE `from_userid`='".$user['id']."' AND `to_userid`='".$info_user['id']."' OR `to_userid`='".$user['id']."' AND `from_userid`='".$info_user['id']."' LIMIT 1"));
if($check != 1){
	$friend_invite = true;
}else{
	$friend_invite = false;
}

$villages = array();
$result = $db->query("SELECT `name`,`id`,`points`,`x`,`y` FROM `villages` WHERE `userid`='".$info_user['id']."' ORDER BY `name`,`id`");
while($row = $db->fetch($result)){
	$villages[$row['id']]['name'] = entparse($row['name']);
	$villages[$row['id']]['x'] = $row['x'];
	$villages[$row['id']]['y'] = $row['y'];
	$villages[$row['id']]['points'] = format_number($row['points']);
}

if($user['ally_invite'] == 1){
	if($info_user['ally'] != $user['ally']){
		$Ally = $db->fetch($db->query("SELECT `members` FROM `ally` WHERE `id`='".$user['ally']."' LIMIT 1"));
		$count = $db->numrows($db->query("SELECT `id` FROM `ally_invites` WHERE `from_ally`='".$user['ally']."'"));
		if(($Ally['members']+$count) >= $config['members_ally']){
			$can_invite = false;
		}else{
			$result = $db->query("SELECT COUNT(`id`) AS `count` FROM `ally_invites` WHERE `to_userid`='".$info_user['id']."' AND `from_ally`='".$user['ally']."'");
			$invite_row = $db->fetch($result);
			if($invite_row['count'] == 1){
				$can_invite = false;
			}else{
				$can_invite = true;
			}
		}
	}else{
		$can_invite = false;
	}
}else{
	$can_invite = false;
}

if($info_user['b_day'] > 0){
	$age = date("Y")-$info_user['b_year']-1;
	if(date("m") >= $info_user['b_month']){
		if(date("m") == $info_user['b_month']){
			if(date("d") >= $info_user['b_day'])
				$age++;
		}else
			$age++;
	}
}else
	$age = -1;

if($info_user['sex'] == 'm'){
	$sex = "Masculino";
}elseif($info_user['sex'] == 'f'){
	$sex = "Feminino";
}else{
	$sex = -1;
}

$info_user['home'] = entparse(@$info_user['home']);
$info_user['personal_text'] = nl2br(entparse(@$info_user['personal_text']));

$array = array();
foreach($cl_awards->dbname as $dbname=>$name){
	$array[] = $dbname;
	$array[] = $dbname."_stage";			
}

$ordermedal = array();
$result = $db->query("SELECT ".implode(',',$array).",userid,total_stage FROM medal WHERE userid='".$info_user['id']."'");
$row = $db->fetch($result);

foreach($cl_awards->dbname as $dbname=>$name){	
	$stage = $dbname."_stage";
	$ordermedal[$row[$stage]][$dbname]['title'] = $row[$dbname];
	$ordermedal[$row[$stage]][$dbname]['id'] = $row[$stage];
}

$medalhas = array();
$medalof = array();
krsort($ordermedal);
foreach($ordermedal as $id=>$key){
	foreach($key as $dbname=>$valor){
		if($id > 0){
			$medalhas[$dbname]['title'] = $valor['title'];
			$medalhas[$dbname]['id'] = $valor['id'];
		}else{
			$medalof[$dbname]['title'] = $valor['title'];
			$medalof[$dbname]['id'] = $valor['id'];
		}
	}
}

$tpl->assign("medalhas", $medalhas);
$tpl->assign("medalof", $medalof);
$tpl->assign("cl_awards", $cl_awards);
$tpl->assign("info_user", $info_user);
$tpl->assign("villages", $villages);
$tpl->assign("info_ally", $info_ally);
$tpl->assign("age", $age);
$tpl->assign("sex", $sex);
$tpl->assign("can_invite", $can_invite);
$tpl->assign("friend_invite", $friend_invite);
?>