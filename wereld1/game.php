<?php
if(isset($_GET['acvila'])){
	setcookie("session", $_GET['acvila'], 0);
	header("Location: game.php");
	exit;
}
function msec(){
    list($msec, $sec) = explode(' ', microtime());
    return ($sec%3600)*1000+$msec*1000;
}
function gets_ms($a){
	global $load_msec;
	echo "$a: ".(msec()-$load_msec)."<br />";
}

$load_msec = msec();

$serverconfigANCassdksdklALJKS = $_SERVER;
$sicherABCdkd8338dJK = "skjdjhsdudJJJSHdndnjJJSHJKSAHDKJASHDjhz984z45tdshfpsd";

require_once("./include.inc.php");


$ACTIONS_MASSIVKEY_HIGHAAASSDD = 'sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL';

$sid = new sid();
$session = $sid->check_sid($_COOKIE['session']);
if(!$session['userid']){
	header ("Location: sid_wrong.php");
	exit;
}

$userdatas = new GetUserData();
$usersql = array("villages","username","ally","points","rang","villages_mode","attacks","new_report","new_mail","ally_found","ally_lead","ally_invite","ally_diplomacy","ally_mass_mail","image","window_width","show_toolbar","dyn_menu","confirm_queue","map_size","vacation_name","vacation_id","vacation_accept","memo","killed_units_def_rank","killed_units_altogether_rank","killed_units_att_rank","graphical_overview","do_action","medc","join_actions","knightname");
$user = $userdatas->getbyid($session['userid'], $usersql, false);
$user['id'] = $session['userid'];

if($user['medc'] == 0){
	$db->query("INSERT INTO `medal` (`userid`,`username`) VALUES ('".$user['id']."','".$user['username']."')");
	$add_sql = ",`medc`='1'";
}
$db->query("UPDATE `users` SET `last_activity`='".time()."'".$add_sql." WHERE `id`='".$user['id']."'");
$cl_awards->reload_medal_user($user['id']);
$db->query("UPDATE `".$config['global_db']."`.`users` SET `last_activity`='".time()."' WHERE `id`='".$user['id']."'");

if(!$sid->is_vacation() && $user['vacation_accept'] == '1'){
	if(isset($_GET['action']) && $_GET['action'] == "logout"){
		require("actions/logout.php");
    }
    if(isset($_GET['action']) && $_GET['action'] == 'end'){
		$c = new do_action($user['id']);
		$c->close();

		if(@$session['hkey'] != $_GET['h']){
		    $error = "Sorry! Er is een fout opgetreden.";
		}
		if(empty($error) && $user['vacation_accept'] == 0){
	    	$error = "Fout! Het was niet mogelijk om je vakantie aanvraag te voltooien, probeer het opnieuw";
		}
		if (empty($error)) {
		    $db->query("UPDATE `users` SET `vacation_name`='',`vacation_id`='-1',`vacation_accept`='0' WHERE `id`='".$user['id']."'");
	    	header("LOCATION: game.php?village=".$village['id']."");
		}
		$c->open();
    }

    $tpl = new Smarty();
    $tpl->assign("vacation_name", entparse($user['vacation_name']));
    $tpl->assign("hkey", $session['hkey']);
    $tpl->display('vacation_window.tpl');
    exit;
}

if($user['villages'] < $config['min_villages']){
	if($config['not_more_villages']){
		header("LOCATION: not_more_villages.php");
		exit;
	}
	header("LOCATION: create_village.php");
	exit;
}

if(!empty($_GET['action'])){
	for($i = 0; $i <= 2; $i++){
		$result = $db->query("SELECT `do_action` FROM `users` WHERE `id`='".$user['id']."'");
		$row = $db->fetch($result);
		if(empty($row['do_action'])){
			break;
		}
		if($row['do_action']+1 < time()){
			$db->query("UPDATE `users` SET `do_action`='' WHERE `id`='".$user['id']."'");
			break;
		}
		sleep(1);
	}
	$d = new do_action($user['id']);
	$d->close_new();
}

$villagedatas = new GetVillageData();
if(empty($_GET['village'])){
	$_GET['village'] = getfirstvillage($user['id']);
	if(isset($_GET['mode']) && !empty($_GET['mode'])){
		header("LOCATION: game.php?village=".$_GET['village']."&screen=".$_GET['screen']."&mode=".$_GET['mode']."");
	}else{
		header("LOCATION: game.php?village=".$_GET['village']."&screen=".$_GET['screen']."");
	}
}
$villagesql = array("userid","id","name","x","y","continent","r_wood","r_stone","r_iron","last_prod_aktu","r_bh","control_villages","recruited_snobs","attacks","agreement","agreement_aktu","dealers_outside","create_time","main_build","smith_tec","points");
foreach($cl_builds->get_array("dbname") as $dbname){
	array_push($villagesql, $dbname);
}
foreach($cl_techs->get_array("dbname") as $dbname){
	array_push($villagesql, 'unit_'.$dbname."_tec_level");
}

$village = $villagedatas->getbyid($_GET['village'], $villagesql);
if($village['exist_village'] == 0 || $village['userid'] != $user['id']){
	$villageid = getfirstvillage($user['id'], $user['group']);
	header("LOCATION: game.php?village=".$villageid."&screen=overview");	
	exit;
}

$ress = ressis($village);
$village['r_wood'] = $ress['r_wood'];
$village['r_stone'] = $ress['r_stone'];
$village['r_iron'] = $ress['r_iron'];
$village['r_wood_comma'] = $ress['r_wood_comma'];
$village['r_stone_comma'] = $ress['r_stone_comma'];
$village['r_iron_comma'] = $ress['r_iron_comma'];

$village_array = array();
$result = $db->query("SELECT `id` FROM `villages` WHERE `userid` = '".$village['userid']."' AND ((`name` = '".$village['name']."' AND `id`<'".$village['id']."') OR (`name`<'".$village['name']."')) AND `id`!='".$village['id']."' ORDER BY `name` DESC,`id` DESC LIMIT 1");
$row = $db->fetch($result);
$village_array['last'] = $row['id'];
$village_array['last_link'] = 'game.php?village='.$row['id'].'&amp;';
if(!(empty($_GET['screen']))){
	$village_array['last_link'] .= 'screen='.$_GET['screen'].'&amp;';
}else{
	$village_array['last_link'] .= '';
}
if(!(empty($_GET['mode']))){
	$village_array['last_link'] .= 'mode='.$_GET['mode'].'&amp;';
}else{
	$village_array['last_link'] .= '';
}

if(!(empty($_GET['id']))){
	$village_array['last_link'] .= 'id='.$_GET['id'].'&amp;';
}else{
	$village_array['last_link'] .= '';
}
if(!(empty($_GET['target']))){
	$village_array['last_link'] .= 'target='.$_GET['target'].'&amp;';
}else{
	$village_array['last_link'] .= '';
}
$result = $db->query("SELECT `id` FROM `villages` WHERE `userid` = '".$village['userid']."' AND ((`name` = '".$village['name']."' AND `id`>'".$village['id']."') OR (`name`>'".$village['name']."')) AND `id`!='".$village['id']."' ORDER BY `name` ASC,`id` ASC LIMIT 1");
$row = $db->fetch($result);
$village_array['next'] = $row['id'];
$village_array['next_link'] = 'game.php?village='.$row['id'].'&amp;';

if(!(empty($_GET['screen']))){
	$village_array['next_link'] .= 'screen='.$_GET['screen'].'&amp;';
}else{
	$village_array['next_link'] .= '';
}

if(!(empty($_GET['mode']))){
	$village_array['next_link'] .= 'mode='.$_GET['mode'].'&amp;';
}else{
	$village_array['next_link'] .= '';
}

if(!(empty($_GET['id']))){
	$village_array['next_link'] .= 'id='.$_GET['id'].'&amp;';
}else{
	$village_array['next_link'] .= '';
}

if(!(empty($_GET['target']))){
	$village_array['next_link'] .= 'target='.$_GET['target'].'&amp;';
}else{
	$village_array['next_link'] .= '';
}

$tpl = new Smarty();
if(isset($_GET['action']) && $_GET['action'] == "logout"){
	require("actions/logout.php");
}

if($confif['no_actions'] && @$_GET['screen'] != "ally"){
	$_GET['action'] = '';
	$_POST['action'] = '';
}

$allow_screens = array("place_units_try_back","report","place_confirm","info_village","place","smith","snob","map","overview","main","overview_villages","settings","barracks","wood","stone","iron","farm","storage","hide","wall","stable","garage","info_command","ranking","market","market_confirm_send","mail","ally","info_player","info_ally","info_member","memo","train","friends","statue");
if(!isset($_GET['screen']))
	header("LOCATION: game.php?village=".$_GET['village']."&screen=overview");

if(in_array(@$_GET['screen'], $allow_screens)){
	require_once("actions/".$_GET['screen'].".php");
}

$village['name'] = entparse($village['name']);

if(isset($_GET['intro'])){
	$tpl->assign("intro", true);
}

if($config['noob_protection'] > 0){
	$all = ($config['noob_protection']*60)+time();
	if($user['protection'] == '0'){
		$db->query("UPDATE `users` SET `protection` = '".$all."' WHERE `id` = '".$user['id']."'");
		header("Location: ".$_SERVER['REQUEST_URI']."");
	}
}

if($user['join_actions'] == "n"){
	$title = parse("Welkom bij ".$config['name']."!");
	$db->query("INSERT INTO `mail_subject` (`subject`,`last_post`,`from_id`,`to_id`,`from_username`,`to_username`,`post_num`,`status_from`,`status_to`,`delete_from`,`delete_to`) VALUES ('".$title."', '".time()."', '-1', '".	    $user['id']."', 'Equipe ".$config['name']."', '".$user['username']."', '1', 'answered', 'new', 'n', 'n')");
	$text = parse("Welkom bij ".$config['world_name']." [player]".entparse($user['username'])."[/player]!

    We hopen dat je veel plezier hebt tijdens dit nieuwe avontuur!
	
	Als je vragen of problemen hebt met spel, neem dan contact op met de support
	
	Meld je aan op het forum, en blijf op de hoogte van het laatste nieuws :)!

	Gegroet, 
	Het team");
	$db->query("INSERT INTO `mail_in` (`from_id`,`from_username`,`to_id`,`to_username`,`subject`,`text`,`time`) VALUES ('-1','Equipe ".$config['name']."','".$user['id']."' ,'".entparse($user['username'])."','".$title ."','".$text."','".time()."')");
	$db->query("UPDATE `users` SET `new_mail`='1',`join_actions`='y' WHERE `id`='".$user['id']."' LIMIT 1");
	header("LOCATION: game.php?village=".$_GET['village']."&screen=overview");
	exit;
}

require_once("configs.php");
$lang = new aLang("game", "PT");
$tpl->assign("lang", $lang);
$tpl->assign("servertime", date("G:i:s"));
$tpl->assign("serverdate", date("d/m/Y"));
$tpl->assign("load_msec", round(msec()-$load_msec));
$tpl->assign("hkey", $session['hkey']);
$tpl->assign("village", $village);
$tpl->assign("user", $user);
$tpl->assign("now", time());
$tpl->assign("screen", @$_GET['screen']);
$tpl->assign("config", $config);
$tpl->assign("allow_screens", $allow_screens);
$tpl->assign("wood_per_hour", floor($arr_production[$village['wood']]*$config['speed']));
$tpl->assign("stone_per_hour", floor($arr_production[$village['stone']]*$config['speed']));
$tpl->assign("iron_per_hour", floor($arr_production[$village['iron']]*$config['speed']));
$tpl->assign("max_storage", $arr_maxstorage[$village['storage']]);
$tpl->assign("max_bh", $arr_farm[$village['farm']]);
$tpl->assign("village_array", $village_array);
$tpl->assign("sid", $sid);

$tpl->display("game.tpl");
?>