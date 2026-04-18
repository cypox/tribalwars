<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}
if(isset($_GET['action']) && $_GET['action'] == "exit"){
	if($session['hkey'] != $_GET['h']){
		$error = "Sorry, but the security code is invalid!";
	}
	if(!$config['leave_ally']) $error = "Sorry, but this action is not permitted!";

	if($user['ally_found'] == 1){
		$result = $db->query("SELECT COUNT(`id`) AS `count` FROM `users` WHERE `ally`='".$user['ally']."' AND `ally_found`='1'");
		$row = $db->fetch($result);
		if($row['count'] < 2 && empty($error)){
			$error = "Sorry, but you are the only founder and cannot leave!";
		}
	}
	if(empty($error)){
		$db->query("UPDATE `users` SET `ally`='-1' WHERE `id`='".$user['id']."'");
        reload_ally_points($user['ally']);
        reload_ally_rangs();
		reload_kill_ally();
        add_allyevent($user['ally'], "<a href=\"game.php?village=;&screen=info_player&id=".$user['id']."\">".entparse($user['username'])."</a> left the tribe.");
		$d->open();
		header("LOCATION: game.php?village=".$village['id']."&screen=ally");
		exit;
	}
	$d->open();
}
if(isset($_GET['action']) && $_GET['action'] == "edit_intern" && $user['ally_found'] == 1){
	if($session['hkey'] != $_GET['h']){
		$error = "Sorry, but the security code is invalid!";
	}

	if(empty($error) && strlen($_POST['intern']) > 10000){
		$error = "Sorry, but you cannot exceed 10000 characters!";
	}
	if(empty($error)){
		if(isset($_POST['preview'])){
			$preview = htmlspecialchars(nl2br($_POST['intern']));
			$ally['edit_intern_text'] = htmlspecialchars($_POST['intern']);
            $ally['intern_text'] = nl2br(htmlspecialchars($_POST['intern']));
		}
		if(isset($_POST['edit'])){
			$text = parse($_POST['intern']);
			$db->query("UPDATE ally SET intern_text='".$text."' where id=".$user['ally']."");
			add_allyevent($user['ally'], "<a href=\"game.php?village=;&screen=info_player&id=".$user['id']."\">".entparse($user['username'])."</a> modified the announcement board." );
            $d->open();
            header("LOCATION: game.php?village=".$village['id']."&screen=ally");
            exit;
        }
    }
    $d->open();
}
if(!isset($_GET['site']) || (isset($_GET['site']) && (!is_numeric($_GET['site'])))){
	$site = 1;
}else{
    $site = parse($_GET['site']);
}
$events_per_page = 10;
$num_rows = $db->numrows($db->query("SELECT `id` FROM `ally_events` WHERE `ally`='".$user['ally']."'"));
$num_pages = (($num_rows%$events_per_page)==0) ? $num_rows/$events_per_page : ceil($num_rows/$events_per_page);
$start = ($site-1)*$events_per_page;

$events = array();
$result = $db->query("SELECT `id`,`time`,`message` FROM `ally_events` WHERE `ally`='".$user['ally']."' ORDER BY `time` DESC LIMIT ".$start.",".$events_per_page."");
while($row = $db->fetch($result)){
	$events[$row['id']]['time'] = date("d.m.", $row['time'])."<br />".date("H:i", $row['time']);
	$events[$row['id']]['message'] = preg_replace("/village=;/","village=".$village['id'],urldecode($row['message']));
}
$tpl->assign("preview", $preview);
$tpl->assign("num_pages", $num_pages);
$tpl->assign("events", $events);
$tpl->assign("site", $site);
?>