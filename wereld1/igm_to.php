<?php
require_once("./include.inc.php");

$sid = new sid();
$session = $sid->check_sid($_COOKIE['session']);
if(!$session['userid']){
	header("LOCATION: sid_wrong.php");
	exit;
}

$userdatas = new GetUserData();
$usersql = array("villages","username","ally","points","rang","villages_mode","attacks","new_report","new_mail","ally_found","ally_lead","ally_invite","ally_diplomacy","ally_mass_mail");
$user = $userdatas->getbyid($session['userid'],$usersql,false);
$user['id'] = $session['userid'];
if($user['ally'] == '-1'){
    exit("Desculpe, más não foi possivel carregar a lista!");
}
if($user['ally_mass_mail'] != '1'){
    exit("Desculpe, más não foi possivel carregar a lista!");
}
if(isset($_GET['insert']) && $_GET['insert'] == "ally"){
	$result = $db->query("SELECT `id`,`username` FROM `users` WHERE `ally`='".$user['ally']."'");
	while($row = $db->fetch($result)){
		if($row['id'] != $user['id']){
			$user[$users] = entparse($row['username']);
		}
	}
	$userlist = implode(";", $users);
}
if(isset($_GET['clear'])){
    $clear = true;
}else{
	$clear = false;
}

$tpl = new TWLan_Smarty();
$tpl->assign("userlist", $userlist);
$tpl->assign("clear", $clear);
$tpl->display("igm_to.tpl");
?>