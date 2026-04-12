<?php
require_once("./include.inc.php");
ob_start();
session_start();

$tpl = new TWLan_Smarty();
$world = $db->fetch($db->query("SELECT * FROM `worlds` WHERE `db`='".parse($_GET['world'])."'"));
$action = isset($_GET['action']) ? $_GET['action'] : '';
$action_h = isset($_GET['h']) ? $_GET['h'] : '';

if(!is_array($world) || !isset($world['db']) || $world['db'] == ''){
	header('Location: ./');
	exit;
}

if(!isset($world['start'])){
	$world['start'] = 0;
}
if(!isset($world['end'])){
	$world['end'] = 0;
}

$check_db = $db->query("SELECT * FROM `$world[db]`.`users`");
if(!$check_db){ 
	header('Location: ./'); 
	exit;
}else{
	$sid = new sid();
	$session = $sid->check_sid($_COOKIE['session']);
	if(!$session['userid']){
		header('Location: ./'); 
		exit;
	}else{
		$time = time();
		$ip = $_SERVER['REMOTE_ADDR'];
		$hkey = $session['hkey'];
		$userdatas = new GetUserData();
		$usersql = array("username");
		$user = $userdatas->getbyid($session['userid'], $usersql, false);
		$user['id'] = $session['userid'];

		if($world['active'] == 0){
			header('Location: ./'); 
			exit;
		}else{
			$quser = $db->query("SELECT * FROM `$world[db]`.`users` WHERE `id`='".$user['id']."' AND `username`='".$user['username']."'");
			$User = $db->fetch($quser);
			if(!is_array($User)){
				$User = array('banned' => 'N');
			}
			if($db->numrows($quser) != 0){
				$check_session = $db->numrows($db->query("SELECT * FROM `$world[db]`.`sessions` WHERE `userid`='".$user['id']."' AND `username`='".$user['username']."'"));
				if($User['banned'] != 'Y'){
					if($check_session != 1){
						$db->query("INSERT INTO `$world[db]`.`sessions` (`userid`, `sid`,`hkey`, `username`) VALUES ('".$user['id']."','".$session['sid']."','".$hkey."','".$user['username']."')");
						$db->query("INSERT INTO `$world[db]`.`logins` (`username`, `time`,`ip`,`userid`,`uv`) VALUES ('".$user['username']."','".$time."','".$ip."','".$user['id']."','".addslashes($_SERVER['HTTP_USER_AGENT'] ?? '')."')");
					}else{
						$db->query("UPDATE `$world[db]`.`sessions` SET `sid`='".$session['sid']."',`hkey`='".$hkey."'  WHERE `userid`='".$user['id']."'");
						$db->query("INSERT INTO `$world[db]`.`logins` (`username`, `time`,`ip`,`userid`,`uv`) VALUES ('".$user['username']."','".$time."','".$ip."','".$user['id']."','".addslashes($_SERVER['HTTP_USER_AGENT'] ?? '')."')");
					}
					
						header('Location: /'.$world['dir'].'/game.php?acvila='.$_COOKIE['session']);
						exit;
				}
			}else{
				if($action == 'create' && $action_h == $hkey){
					$now = time();
					$db->query("INSERT INTO `$world[db]`.`users` (`id`,`username`,`villages`,`points`,`ennobled_by`,`ally_titel`,`rang`,`killed_units_att`,`killed_units_att_rank`,`killed_units_def`,`killed_units_def_rank`,`killed_units_altogether`,`killed_units_altogether_rank`,`do_action`,`last_activity`,`birthday`,`vacation_name`,`b_day`,`b_month`,`b_year`,`home`,`image`,`personal_text`,`memo`,`map_reload`,`group`,`data_inregistrare`,`ip_inregistrare`,`premium_active`,`premium_active_until`,`premium_activated_at`) VALUES ('".$user['id']."','".$user['username']."','0','0','','','0','0','0','0','0','0','0','".$now."','".$now."','','','0','0','0','','','','','','','".$now."','".$_SERVER['REMOTE_ADDR']."','0','0','0')");
					header("Location: login.php?world=".$world['db']);
					exit;
				}
				$tpl->assign("world", $world);
				$tpl->assign("User", $User);
				$tpl->assign("configy", $config);
				include($world['dir']."/include/config.php");
				include($world['dir']."/include/configs/farm_limits.php");
				include($world['dir']."/include/configs/max_storage.php");
				$tpl->assign("config", $config);
				$tpl->assign('farm', $arr_farm);
				$tpl->assign("hkey", $hkey);
				$tpl->assign("storage", $arr_maxstorage);
			}
		}
	}
}
$tpl->display("login.tpl");
?>