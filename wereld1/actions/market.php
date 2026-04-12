<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}

$show_build = ($cl_builds->check_needed('market',$village) && $village['market']>0)?true:false;
if (!isset($_GET['mode'])) $_GET['mode'] = "send";

$links = array(
	"Enviar recursos" => "send",
	"Suas ofertas" => "own_offer",
	"Outras ofertas" => "other_offer",
);
$allow_mods = array("send","own_offer","other_offer");
if($show_build){
	$max_dealers = get_dealers($village['market']);
	$inside_dealers = $max_dealers - $village['dealers_outside'];
	if(in_array($_GET['mode'], $allow_mods)){
        include("market_".$_GET['mode'].".php");
	}
	$tpl->assign("max_dealers", $max_dealers);
	$tpl->assign("inside_dealers", $inside_dealers);
}
$tpl->assign("allow_mods", $allow_mods);
$tpl->assign("mode", $_GET['mode']);
$tpl->assign("links", $links);
$tpl->assign("description", $cl_builds->get_description_bydbname('market'));
$tpl->assign("show_build", $show_build);
$tpl->register_modifier("stage", "stage");
?>