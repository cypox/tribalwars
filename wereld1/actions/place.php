<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}

$show_build = $cl_builds->check_needed("place",$village);
if($show_build){
	if(!isset($_GET['mode'])) $_GET['mode'] = "command";

	$links = array(
		"Comandos" => "command",
		"Tropas" => "units",
		"Simulador" => "sim"
	);
	$allow_mods = array("command","units","sim");
	if(isset($_GET['mode']) && $_GET['mode'] == "command"){
		include("place_command.php");
	}
	if(isset($_GET['mode']) && $_GET['mode'] == "units"){
		include("place_units.php");
	}
	if(isset($_GET['mode']) && $_GET['mode'] == "sim"){
		include("place_sim.php");
	}
}
$tpl->assign("cl_units",$cl_units);
$tpl->assign("allow_mods", $allow_mods);
$tpl->assign("mode", $_GET['mode']);
$tpl->assign("links", $links);
$tpl->assign("show_build",$show_build);
$tpl->assign("description", $cl_builds->get_description_bydbname('place'));
$tpl->assign("config", $config);
?>