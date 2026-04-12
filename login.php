<?php
require_once("./include.inc.php");
ob_start();
session_start();

$tpl = new TWLan_Smarty();
$world = $db->fetch($db->query("SELECT * FROM `worlds` WHERE `db`='".parse($_GET['world'])."'"));
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
			if($db->numrows($quser) != 0){
				$check_session = $db->numrows($db->query("SELECT * FROM `$world[db]`.`sessions` WHERE `userid`='".$user['id']."' AND `username`='".$user['username']."'"));
				if($User['banned'] != 'Y'){
					if($check_session != 1){
						$db->query("INSERT INTO `$world[db]`.`sessions` (`userid`, `hkey`,`sid`, `username`) VALUES ('".$user['id']."','".$session['sid']."','".$hkey."','".$user['username']."')");
						$db->query("INSERT INTO `$world[db]`.`logins` (`username`, `time`,`ip`,`userid`) VALUES ('".$user['username']."','".$time."','".$ip."','".$user['id']."')");
					}else{
						$db->query("UPDATE `$world[db]`.`sessions` SET `sid`='".$session['sid']."',`hkey`='".$hkey."'  WHERE `userid`='".$user['id']."'");
						$db->query("INSERT INTO `$world[db]`.`logins` (`username`, `time`,`ip`,`userid`) VALUES ('".$user['username']."','".$time."','".$ip."','".$user['id']."')");
					}
					
						header('Location: /'.$world['dir'].'/game.php?acvila='.$_COOKIE['session']);
						exit;
				}
			}else{
				if($_GET['action'] == 'create' && $_GET['h'] == $hkey){
					$db->query("INSERT INTO `$world[db]`.`users` (`id`,`username`) VALUES ('".$user['id']."', '".$user['username']."')");
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