<?php
require_once("./include.inc.php");
if(!isset($_GET['mode']))
	$_GET['mode'] = "intro";

$links = array(
	"First steps" => "intro",
	"Starting late" => "late_start",
	"Buildings" => "buildings",
	"Units" => "units",
	"Battles" => "fight",
	"Points" => "points",
	"Map" => "map",
	"Reports" => "reports",
	"BB codes" => "bb",
	"Banners" => "banner",
	"Information" => "server_info"
);

$tpl = new TWLan_Smarty();
if($_GET['mode'] == "points"){
	$max_stage = $cl_builds->get_highest_stage();
	$builds = $cl_builds->get_array("dbname");
	$tpl->assign("max_stage", $max_stage);
	$tpl->assign("builds", $builds);
	$tpl->assign("cl_builds", $cl_builds);
}
if($_GET['mode'] == "units"){
	$tpl->assign("cl_units", $cl_units);
}
if($_GET['mode'] == "server_info"){
	$tpl->assign("config", $config);
}
if($_GET['mode'] == "buildings"){
	$tpl->assign("cl_builds", $cl_builds);
}
$allow_mods = array("intro","late_start","map","reports","points","buildings","units","fight","bb","banner","server_info");
$tpl->assign("allow_mods", $allow_mods);
$tpl->assign("mode", @$_GET['mode']);
$tpl->assign("links", $links);
$tpl->display("help.tpl");
?>