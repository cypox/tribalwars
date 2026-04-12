<?php
require_once("./include.inc.php");

$building = @$_GET['building'];
if(!in_array($building, $cl_builds->get_array("dbname"))){
	exit("Desculpe, más não encontramos este edifício!");
}

$tpl = new TWLan_Smarty();
$tpl->assign("building", $building);
$tpl->assign("cl_builds", $cl_builds);
$tpl->assign("config", $config);
$tpl->display("popup_building.tpl");
?>