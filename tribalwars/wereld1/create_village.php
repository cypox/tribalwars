<?php
require_once("./include.inc.php");
if($config['not_more_villages']){
    header("LOCATION: not_more_villages.php" );
    exit;
}
$sid = new sid();
$session = $sid->check_sid($_COOKIE['session']);
if(!$session['userid']){
	header("LOCATION: sid_wrong.php");
	exit;
}
$userdatas = new GetUserData();
$usersql = array("villages","username","ennobled_by");
$user = $userdatas->getbyid($session['userid'], $usersql, false);
$user['id'] = $session['userid'];
if(!$config['village_choose_direction']){
	$_GET['action'] = "create";
	$_POST['direction'] = "random";
}
if(isset($_GET['action']) && $_GET['action'] == "create" && $user['villages'] < $config['min_villages'] && isset($_POST['direction']) && ($_POST['direction'] == "no" || $_POST['direction'] == "nw" || $_POST['direction'] == "so" || $_POST['direction'] == "sw" || $_POST['direction'] == "random")){
	while($user['villages'] < $config['min_villages']){
		$villageid = create_village($user['id'], $user['username'], $_POST['direction']);
		create_village('-1', false, $_POST['direction']);
		create_village('-1', false, $_POST['direction']);
		++$user['villages'];
	}
	if(!empty($user['ennobled_by'])){
		$total = time()+(round($config['noob_protection']/100*(100-$config['ennobled_protection'])))*60;
		$db->query("UPDATE `users` SET `protection`='".$total."',`ennobled_by`='' WHERE `id`='".$user['id']."'");
	}
	header("LOCATION: game.php?village=".$villageid."&screen=overview");
    exit;
}
$tpl = new TWLan_Smarty();
$tpl->assign("ennobled_by", entparse($user['ennobled_by']));
$tpl->assign("config", $config);
$tpl->display("createvillage.tpl");
?>