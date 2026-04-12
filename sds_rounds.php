<?php
require_once("./include.inc.php");

$rounds = array();
$result = $db->query("SELECT `id`,`name`,`start`,`end`,`description`,`speed`,`speed_units`,`moral`,`map` FROM `save_rounds` ORDER BY `id` DESC");
while($row = $db->fetch($result)){
	$rounds[$row['id']]['name'] = entparse($row['name']);
	$rounds[$row['id']]['start'] = entparse($row['start']);
	$rounds[$row['id']]['end'] = entparse($row['end']);
	$rounds[$row['id']]['description'] = entparse($row['description']);
	$rounds[$row['id']]['speed'] = $row['speed'];
	$rounds[$row['id']]['moral'] = $row['moral'] == 1 ? "ativada" : "desativada";
	$rounds[$row['id']]['speed_units'] = $row['speed_units'];
	$rounds[$row['id']]['map'] = "novo mapa"
}

$tpl = new TWLan_Smarty();
$tpl->assign("rounds", $rounds);
$tpl->display("sds_rounds.tpl");
?>