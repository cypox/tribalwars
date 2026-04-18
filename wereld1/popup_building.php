<?php
require_once("./include.inc.php");

$building = @$_GET['building'];
if(!in_array($building, $cl_builds->get_array("dbname"))){
	exit("Sorry, we could not find this building!");
}

$tpl = new TWLan_Smarty();
$tpl->assign("building", $building);
$tpl->assign("cl_builds", $cl_builds);
$tpl->assign("config", $config);
$tpl->display("popup_building.tpl");
?>