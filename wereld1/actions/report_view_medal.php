<?php 
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}

$exp = explode(";",$report['message']);
$report['m_dbname'] = $exp[0];
$report['m_stage'] = $exp[1];
$tpl->assign("cl_awards", $cl_awards);
?>
