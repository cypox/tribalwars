<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}

if(!isset($_GET['mode']))
	$_GET['mode'] = "all";

$links = array(
	"Todos" => "all",
	"Ataques" => "attack",
	"Defesas" => "defense",
	"Apoio" => "support",
	"Mercado" => "trade",
	"Outros" => "other"
);
$allow_mods = array("all","attack","defense","support","trade","other");

if(isset($_POST['del'])){
	if($session['hkey'] != $_GET['h']){
		exit("Desculpe, más o código de segurança está invalido!");
	}
	foreach($_POST as $id=>$value){
		if(substr($id, 0, 3)=="id_"){
			$id = parse(array_pop(explode("id_", $id)));
			$result = $db->query("SELECT `receiver_userid` FROM `reports` WHERE `id`='".$id."'");
			$del = $db->fetch($result);
			if(!$del['receiver_userid'] == $user['id']){
				exit("Desculpe, más houve erro ao apagar os relatórios!");
			}else{
				$db->query("DELETE FROM `reports` WHERE `id`='".$id."'");
			}
		}
	}
	header("LOCATION: game.php?village=".$village['id']."&screen=report&mode=".$_GET['mode']."");
}

if(isset($_GET['action']) && $_GET['action'] == "del_one"){
	if($session['hkey'] != $_GET['h']){
		exit("Desculpe, más o código de segurança está invalido!");
	}

	$id = parse($_GET['id']);
	$result = $db->query("SELECT `receiver_userid` FROM `reports` WHERE `id`='".$id."'");
	$del = $db->fetch($result);
	if(!$del['receiver_userid'] == $user['id']){
		exit("Desculpe, más houve erro ao apagar o relatório!");
	}else{
		$db->query("DELETE FROM `reports` WHERE `id`='".$id."'");
	}
	header("LOCATION: game.php?village=".$village['id']."&screen=report&mode=".$_GET['mode']);
}

if(!isset($_GET['view'])){
	if($user['new_report']){
		$db->query("UPDATE `users` SET `new_report`='0' WHERE `id`='".$user['id']."'");
	}

	if(!isset($_GET['site']) || (isset($_GET['site']) && (!is_numeric($_GET['site'])))){
		$site = 1;
	}else{
	    $site = parse($_GET['site']);
	}
	$reports_per_page = 10;
	$num_rows = $db->numrows($db->query("SELECT `id` FROM `reports` WHERE `receiver_userid`='".$user['id']."'"));
	$num_pages = (($num_rows%$reports_per_page)==0) ? $num_rows/$reports_per_page : ceil($num_rows/$reports_per_page);
	$start = ($site-1)*$reports_per_page;

	$reports = array();
	if($_GET['mode'] != "all"){
		$sql_add = " AND `in_group`='".parse($_GET['mode'])."' ";
	}else{
		$sql_add = "";
	}
	$result = $db->query("SELECT `title`,`title_image`,`time`,`id`,`is_new` FROM `reports` WHERE `receiver_userid`='".$user['id']."' ".$sql_add." ORDER BY `id` DESC LIMIT ".$start.",".$reports_per_page."");
	while($row = $db->fetch($result)){
		$reports[$row['id']]['id'] = $row['id'];
		$reports[$row['id']]['time'] = $row['time'];
		$reports[$row['id']]['is_new'] = $row['is_new'];
		$reports[$row['id']]['title'] = (!empty($row['title_image']))?"<img src=\"".$row['title_image']."\"> ".entparse($row['title']):entparse($row['title']);
		$reports[$row['id']]['date'] = date("d.m.Y H:i:s", $row['time']);
	}

	$tpl->assign("reports", $reports);
	$tpl->assign("num_pages", $num_pages);
	$tpl->assign("site", $site);
	$tpl->assign('do', 'overview');
}else{
	$result = $db->query("SELECT `from_username`,`ally`,`allyname`,`id`,`title`,`title_image`,`time`,`type`,`a_units`,`b_units`,`c_units`,`d_units`,`e_units`,`agreement`,`hives`,`ram`,`catapult`,`message`,`to_user`,`from_user`,`to_village`,`from_village`,`is_new`,`wins`,`receiver_userid`,`luck`,`moral`,`see_def_units` FROM `reports` WHERE `id`='".parse($_GET['view'])."'");
	$report = $db->fetch($result);
	$report['title'] = (!empty($report['title_image'])) ? "<img src=\"".$report['title_image']."\"> ".entparse($report['title']) : entparse($report['title']);
	$report['date'] = date("d.m.Y H:i:s", @$report['time']);

	if($user['id'] != @$report['receiver_userid']){
		exit("Desculpe, más houve erro ao abrir o relatório!");
	}

	if($report['is_new'] == "1"){
		$db->query("UPDATE `reports` SET `is_new`='0' WHERE `id`='".parse($_GET['view'])."'");
	}
	include("report_view_".$report['type'].".php");
	$tpl->assign('do', 'view');
	$tpl->assign('report', $report);
}
$tpl->assign("allow_mods", $allow_mods);
$tpl->assign("mode", $_GET['mode']);
$tpl->assign("links", $links);
?>