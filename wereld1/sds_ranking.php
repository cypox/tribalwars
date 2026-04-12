<?php
require_once("./include.inc.php");

$result = $db->query("SELECT `id`,`name` FROM `save_rounds` WHERE `id`='".parse($_GET['round_id'])."'");
$round = $db->fetch($result);
if(!isset($round['id'])){
	exit("Desculpe, más não encontramos os dados deste round!");
}
$players = array();
$result = $db->query("SELECT `id`,`username`,`rank`,`points`,`villages`,`ally` FROM `save_players` WHERE `round_id`='".$round['id']."' ORDER BY `rank`");
while($row = $db->fetch($result)){
	$players[$row['id']]['username'] = entparse($row['username']);
	$players[$row['id']]['rank'] = $row['rank'];
	$players[$row['id']]['points'] = format_number($row['points']);
	$players[$row['id']]['villages'] = $row['villages'];
	$players[$row['id']]['ally'] = entparse($row['ally']);
}

$tpl = new TWLan_Smarty();
$tpl->assign("round", $round);
$tpl->assign("players", $players);
$tpl->display("sds_ranking.tpl");
?>