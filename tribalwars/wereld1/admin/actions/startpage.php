<?php
if(isset($_GET['action']) && $_GET['action'] == "add"){
	if(empty($_POST['text']) && empty($error)){
		$error = "Kein Text eingetragen.";
	}
	if(empty($_POST['graphic']) && empty($error)){
		$error = "Keine Grafik ausgewählt.";
    }
	if(empty($_POST['link'])) $_POST['link'] = "";
	if(empty($error)){
		$db->query("INSERT INTO `announcement` (`text`,`link`,`graphic`,`time`) VALUES ('".parse($_POST['text'])."','".parse($_POST['link'])."','".parse($_POST['graphic'])."','".time()."')");
		header("LOCATION: index.php?screen=startpage");
	}
}
if(isset($_GET['action']) && $_GET['action'] == "drop"){
	$db->query("DELETE FROM `announcement` WHERE `id`='".parse($_GET['id'])."'");
	header("LOCATION: index.php?screen=startpage");
}
if(isset($_GET['action']) && $_GET['action'] == "locked_login"){
	if(isset($_POST['login_locked']) && ($_POST['login_locked'] == "yes" || $_POST['login_locked'] == "no")){
		$db->query("UPDATE `login` SET `login_locked`='".parse($_POST['login_locked'])."'");
		$db->query("DELETE from `sessions`");
		header("LOCATION: index.php?screen=startpage");
	}else{
		$error = "Es wurde nichts ausgewählt!";
	}
}

$announcement = array();
$result = $db->query("SELECT `id`,`text`,`graphic`,`link`,`time` FROM `announcement` ORDER BY `time` DESC");
while($row = $db->fetch($result)){
	$announcement[$row['id']]['text'] = entparse($row['text']);
	$announcement[$row['id']]['graphic'] = entparse($row['graphic']);
	$announcement[$row['id']]['link'] = entparse($row['link']);
	$announcement[$row['id']]['time'] = format_date($row['time']);
	$announcement[$row['id']]['id'] = $row['id'];
}
$result = $db->query("SELECT `login_locked` FROM `login`");
$login = $db->fetch($result);

if(!isset($error)) $error = "";

$tpl->assign("announcement", $announcement);
$tpl->assign("error", $error);
$tpl->assign("login", $login);
?>