<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}

$hide_datas['max_hide'] = $arr_maxhide[$village['hide']];
if($village['hide'] == $cl_builds->get_maxstage("hide")){
	$hide_datas['max_hide_next'] = false;
}else{
	$hide_datas['max_hide_next'] = $arr_maxhide[$village['hide']+1];
}
$tpl->assign("hide_datas", $hide_datas);
$tpl->assign("description", $cl_builds->get_description_bydbname('hide'));
$tpl->register_modifier("stage", "stage");
?>