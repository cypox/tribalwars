<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}

$wood_datas['wood_production'] = floor($arr_production[$village['wood']]*$config['speed'])/60;

if($village['wood'] == $cl_builds->get_maxstage("wood")){
 $wood_datas['wood_production_next'] = false;
}else{
 $wood_datas['wood_production_next'] = floor($arr_production[$village['wood']+1]*$config['speed'])/60;
}

$tpl->assign("wood_datas", $wood_datas);
$tpl->assign("description", $cl_builds->get_description_bydbname('wood'));
$tpl->register_modifier("stage", "stage");
?>