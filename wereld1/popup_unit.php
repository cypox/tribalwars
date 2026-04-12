<?php
require_once("./include.inc.php");

$unit = @$_GET['unit'];
if(!in_array($unit, $cl_units->get_array("dbname"))){
	exit("Desculpe, más não encontramos está unidade!");
}

$tpl = new TWLan_Smarty();
$tpl->assign("unit", $unit);
$tpl->assign("cl_units", $cl_units);
$tpl->assign("cl_builds", $cl_builds);
$tpl->assign("config", $config);
$tpl->display("popup_unit.tpl");
?>