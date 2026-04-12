<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("include/config.php");

require_once("./include.inc.php");
require_once("./configs.php");

function msec(){
	list($msec, $sec) = explode(' ', microtime());
	return ($sec%3600)*1000+$msec*1000;
}
function gets_ms($a){
	global $load_msec;
	echo "$a: ".(msec()-$load_msec)."<br />";
}
$load_msec = msec();

$sid = new sid();
$session = $sid->check_sid(isset($_COOKIE['session']) ? $_COOKIE['session'] : '');
$worlds = array();
if(isset($session['userid']) && $session['userid']){
	$logged_in = true;
	$hkey = $session['hkey'];

	$userdatas = new GetUserData();
	$usersql = array("username","join_date","email","premium_points","rank","wins","administration");
	$user = $userdatas->getbyid($session['userid'], $usersql, false);
	$user['id'] = $session['userid'];

	$result = $db->query("SELECT * FROM `worlds` ORDER BY `id` ASC, `order` ASC");
	while($row = $db->fetch($result)){
		$worlds[$row['id']]['name'] = entparse($row['name']);
		$worlds[$row['id']]['db'] = entparse($row['db']);
		$worlds[$row['id']]['class'] = '';

		$sql = $db->fetch($db->query("SELECT `id`, `banned` FROM `$row[db]`.`users` WHERE `id`='".$user['id']."' LIMIT 1"));
		$sql['exist'] = ($sql === null || $sql === false) ? 0 : 1;
		
		if($row['active'] == '0')
			$worlds[$row['id']]['class'] = ' gray';
		if(isset($sql['exist']) && $sql['exist'] == 1)
			$worlds[$row['id']]['class'] = ' green';
		if(isset($sql['banned']) && $sql['banned'] == 'Y')
			$worlds[$row['id']]['class'] = ' red';
		$worlds[$row['id']][] = $row;
	}
}


$players = $db->numrows($db->query("SELECT * FROM `users`"));
$tempo = time()-300;
$online = $db->numrows($db->query("SELECT * FROM `users` WHERE `last_activity`>='".$tempo."'"));


$title = isset($user['rank']) ? $db->fetch($db->query("SELECT * FROM ranks WHERE id = '".$user['rank']."'")) : null;
$announcement = array();
$result = $db->query("SELECT `id`,`text`,`graphic`,`link`,`time` from `announcement` order by `id`");
while ($row = $db->Fetch($result)) {
    $announcement[$row['id']]['text'] = entparse($row['text']);
    $announcement[$row['id']]['graphic'] = entparse($row['graphic']);
    $announcement[$row['id']]['link'] = entparse($row['link']);
    $announcement[$row['id']]['time'] = format_date($row['time']);
    $announcement[$row['id']]['id'] = $row['id'];
}

$allow_screens = array("home","rules","team","support");
$lang = new aLang("index", "PT");
$tpl = new TWLan_Smarty();
$tpl->assign("screen", isset($_GET['screen']) ? $_GET['screen'] : 'home');
$tpl->assign('allow_screens', $allow_screens);
$tpl->assign("announcement", $announcement);
$tpl->assign("worlds", $worlds);
$tpl->assign("ip", $_SERVER["REMOTE_ADDR"]);
$tpl->assign("title", isset($title['name']) ? $title['name'] : '');
$tpl->assign("rank", "Em breve!");
$tpl->assign("config", $config);
$tpl->assign("players", $players);
$tpl->assign("online", $online);
$tpl->assign("session", $session);
$tpl->assign("error", isset($error) ? $error : '');
$tpl->assign("lang", $lang);
$tpl->assign("servertime", date("G:i:s"));
$tpl->assign("serverdate", date("d/m/Y"));
$tpl->assign("load_msec", round(msec()-$load_msec)); 
if(!isset($user) || !is_array($user)) $user = array();
if(!isset($user['window_width'])) $user['window_width'] = 950;
$tpl->assign("user", $user);
$tpl->assign("logged_in", isset($logged_in) ? $logged_in : false);
$tpl->assign("cookie", isset($_COOKIE['session']) ? $_COOKIE['session'] : '');
$tpl->display("index.tpl");
?>